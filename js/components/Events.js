
/*

    EVENTS

*/

class Events {
    constructor(el = '', data = {}) {

        this.DOM = {
            widget: el,
            container: el.querySelector('[data-events-load]'),
            next: {},
            previous: {},
            items: [],
            loader: el
        };

        this.DOM.next = typeof this.DOM.widget.querySelector('[data-events-next]') !== undefined ? this.DOM.widget.querySelector('[data-events-next]') : null 
        this.DOM.previous = typeof this.DOM.widget.querySelector('[data-events-prev]') !== undefined ? this.DOM.widget.querySelector('[data-events-prev]') : null 

        this.data = {
            start: 0,
            per: this.DOM.widget.getAttribute('data-direction') !== null ? parseInt(this.DOM.widget.getAttribute('data-direction')) : 1
        }

        this.url = 'load_events.php'

        // init widget
        this.initWidget()

        // init events
        this.initEvents()

        // this.create(this.template, this.data)

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

    initWidget() {

        // loda first feed
        this.loadEvents()
        
    }

    loadEvents() {

        // show loader
        this.DOM.loader.classList.add('--loading')

        // console.log(this.data)

        // load modal content
        this.load('template/ajax/' + this.url, this.data)
            // .then(response => response.text())
            .then((text) => {

                // console.log(text)
                const doc = new DOMParser().parseFromString(text, 'text/html')

                var el = document.createElement("div")
                el.innerHTML = doc.querySelector('body').innerHTML
                
                return el
            })


            .then((node) => {
                // console.log(node.children) 

                for (var i = 0; i < node.children.length; i++) {

                  var m = node.children[i].getAttribute('data-month')

                  this.DOM.items.push(node.children[i])
                 
                  // Do stuff
                }

                // this.data.per < 0 ? this.append() : this.prepend()
                this.append()
                // node.children.forEach(y => {

                //     this.DOM.container.lastChild
                //     y.getAttribute('data-month')

                // })

            })
            .then(() => {

                // hide loader
                this.DOM.loader.classList.remove('--loading')

                // increment counter
                this.data.start += this.data.per

                // update
                this.update()

                
            })
            // .then(() => this.initEvents())
            // .then(() => this.open())

    }

    append() {
        // console.log('Months: ', this.DOM.items)

        this.DOM.container.innerHTML = ''
        this.DOM.items.forEach(el => {
            // console.log(el)
            this.DOM.container.append(el) 
        })
    }

    prepend() {
        // console.log('Months: ', this.DOM.items)

        this.DOM.container.innerHTML = ''
        this.DOM.items.forEach(el => {
            // console.log(el)
            this.DOM.container.prepend(el) 
        })
    }


    initEvents() {
        var _this = this

        // dispatch feed event.
        var event = new CustomEvent('feed');
        window.dispatchEvent(event);

        if(this.DOM.previous) {
            this.DOM.previous.addEventListener("click", e => {
                e.preventDefault()
                this.data.per = -1
                this.loadEvents()
            });
        }

        if(this.DOM.next) {
            this.DOM.next.addEventListener("click", e => {
                e.preventDefault()
                this.data.per = 1
                this.loadEvents()
            });
        }

        console.log(' ... widget ready')
        
        // this.DOM.next.addEventListener("click", e => {
        //     e.preventDefault()
        //     this.data.per = 1
        //     this.loadFeed()
        // });

    }

    update() {

        // update locomotion scroll positions
        Locomotion.update()

    }


}

class Feed extends Events {

    initWidget() {

        this.url = 'load_feed.php'

        // loda first feed
        this.loadEvents()
        
    }

}

function initEvents() {
    console.log('Init Events widget ...')
    document.querySelectorAll('[data-events-widget]').forEach(el => {

        new Events(el)

    })
}

function initFeed() {
    console.log('Init Feed widget ...')
    document.querySelectorAll('[data-feed-widget]').forEach(el => {

        new Feed(el)

    })
}


// function initEvents() {
//     console.log('Init Events widget ...')
//     document.querySelectorAll('[data-events]').forEach(el => {
//         // el.addEventListener('click',function(e) {
//         //     e.preventDefault();

//         //     var data = el.getAttribute('data-modal-post'),
//         //         url = typeof url !== 'undefined' ? url : el.getAttribute('data-modal-open');

//         // var data = el.getAttribute('data-widget-data')

//         //     MODAL = new Modal(url, JSON.parse(data))
//         // })
//         new Events(el)

//     })
// }