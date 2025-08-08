
/*

    WIDGET

*/

class Widget {
    constructor(el = '', data = {}) {

        this.DOM = {
            widget: el,
            container: el.querySelector('[data-widget-load]'),
            control: '',
            loader: el.querySelector('[data-loader-control]')
        };

        // console.log(this.DOM)

        this.data = data
        this.template = this.DOM.widget.getAttribute('data-widget')

        this.create(this.template, this.data)

    }

    async load(url = '', data = {}) {
        // read our JSON
        // console.log(url, data)
        
        // preprocess data
        var sendData = new FormData()
        sendData.append('data',JSON.stringify(data))

        // fetch
        let response = await ajax(url, sendData)

        return response
    }

    create(template, data) {

        // show loader
        this.DOM.loader.classList.add('--loading')

        // load modal content
        this.load('template/ajax/widget_' + template + '.php', data)
            // .then(response => response.text())
            .then((text) => {
                // console.log(text)
                const doc = new DOMParser().parseFromString(text, 'text/html')
                var el = document.createElement("div")
                el.innerHTML = doc.querySelector('body').innerHTML
                const node = el.firstChild
                return node
            })
            .then((node) => this.append(node))
            .then(() => this.initEvents())
            .then(() => this.open())
    }

    append(el) {
        this.DOM.control = el
        // this.DOM.inner = el.querySelector('[data-modal-scroll]')
        // this.DOM.close = el.querySelectorAll('[data-modal-close]')
        this.DOM.container.append(this.DOM.control);
    }

    open() {

        // close previous 
        //
        //

        // hide loading
        this.DOM.loader.classList.remove('--loading')

        // Locomotion.stop();
        // document.documentElement.classList.add('no-scroll');
        // document.documentElement.classList.add('has-modal');
        // var target = this.DOM.control
        // gsap
        // .from(target, .5, {
        //     xPercent: 110, 
        //     ease: Power3.easeOut,
        //     onComplete: function() {
                
        //         // hide loading
        //     }
        // })
        this.is_open = true

    }

    close() {
        // document.documentElement.classList.remove('has-modal');
        // var target = this.DOM.control
        // gsap
        // .to(target, .5, {
        //     XPercent: 110, 
        //     ease: Power3.easeOut,
        //     onComplete: function() {
        //         target.remove()
        //         Locomotion.start();
        //         document.documentElement.classList.remove('no-scroll');
        //     }
        // })
        this.is_open = false

    }

    // grab(e) {
    //     this.touch.start = e.touches[0].clientY;
    //     this.draggable = (this.DOM.inner.scrollTop > 0) ? false : true
    //     console.log(this.draggable)
    // }

    // drag(e) {
    //     this.touch.end = e.changedTouches[0].clientY;
    //     this.touch.distance = this.touch.end - this.touch.start
    //     if(this.touch.distance > 0 && this.draggable) {
    //         this.follow(e)
    //     }
    // }

    // release(e) {
    //     if(this.touch.distance > this.touch.threshold) { 
    //         this.close(this.DOM.control)
    //     } else {
    //         this.retreat()
    //     }
    // }

    initEvents() {
        var _this = this


        // Dispatch the event.
        var event = new CustomEvent('widget', { template: this.template });
        window.dispatchEvent(event);


        // this.DOM.close.forEach(function(el) {
        //     el.addEventListener("click", e => {
        //         _this.close(_this.DOM.control)
        //     });
        // })

        // this.DOM.control.addEventListener("touchstart", e => {
        //     this.grab(e)
        // });
        // this.DOM.control.addEventListener("touchmove", e => {
        //     this.drag(e)
        // });
        // this.DOM.control.addEventListener("touchend", e => {
        //     this.release(e)
        // });

    }

    // follow() {
    //     gsap.to(this.DOM.control, 0, {
    //         y: this.touch.distance, 
    //         ease: 'none'
    //     });
    // }

    // retreat() {
    //     gsap.to(this.DOM.control, .5, {
    //         y: 0, 
    //         ease: Expo.easeOut
    //     });
    // }

}

// bind modal events
// var MODAL = {}
// document.querySelectorAll('[data-modal-open').forEach(function(el){
//     el.addEventListener('click',function(e) {
//         e.preventDefault();

//         var data = el.getAttribute('data-modal-post'),
//             url = typeof url !== 'undefined' ? url : el.getAttribute('data-modal-open');

//         MODAL = new Modal(url, JSON.parse(data))
//     })
// })

function initWidgets() {
    console.log('Init Agenda widget ...')
    document.querySelectorAll('[data-widget]').forEach(el => {
        // el.addEventListener('click',function(e) {
        //     e.preventDefault();

        //     var data = el.getAttribute('data-modal-post'),
        //         url = typeof url !== 'undefined' ? url : el.getAttribute('data-modal-open');

        // var data = el.getAttribute('data-widget-data')

        //     MODAL = new Modal(url, JSON.parse(data))
        // })
        new Widget(el)

    })
}
