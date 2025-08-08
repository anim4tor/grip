
/*

    SELECT

*/

class Select {
    constructor() {


        // modal
        this.DOM = {
            modal: document.querySelector('[data-modal-widget]'),
            container: document.querySelector('[data-modal-container]'),
            inner: document.querySelector('[data-modal-scroll]'),
            card: {},
            close: {},
            loader: {}
        };

        // select widget
        this.widget = {
            el: {},
            output: {},
            value: '',
            model: ''
        }

        // custom select
        this.select = {
            el: {},
            data: {},
            options: {},
            model: '',
        }


        // collection vars
        this.options = []
        this.selected = []

        this.multiple = false
        this.redirect = false
        this.dialog = false
        is_open: false
    }

    async load(url = '', data = {}) {
        // read our JSON
        console.log('Fetching select ...')
        console.log(url, data)

        
        // preprocess data
        var sendData = new FormData()
        sendData.append('data',JSON.stringify(data))

        // fetch
        let response = await ajax(url, sendData)

        return response
    }

    parseData(data) {

        // var urlArray = url.split('/')

        var data = {
            template: this.select.url,
            selected: data,
            output: {}
        }

        // console.log(data)
        return data
    }

    add(el, url, preselect, post) {

        // move this into own method
        //

        // get select widget
        this.widget.el = el
        this.widget.open = this.widget.el.querySelector('[data-select-open]')

        // get mods
        this.multiple = this.widget.el.hasAttribute('data-select-multiple')
        this.redirect = this.widget.el.hasAttribute('data-redirect')
        this.dialog = this.widget.el.hasAttribute('data-dialog')

        // get output
        this.widget.output = this.widget.el.querySelector('[data-select-output]')
        this.widget.outputHtml = this.widget.el.querySelector('[data-select-output-html]')
        this.widget.value = this.widget.output.getAttribute('value')
        // this.select.collector = this.widget.el.querySelector('[data-select-collector]')

        // preselect
        this.selected = this.multiple ? JSON.parse(this.widget.value) : this.widget.value

        //
        //


        this.select.url = url
        this.select.data = {
            template: this.select.url,
            selected: preselect,
            post: post
        }
        this.template = this.widget.open.getAttribute('data-select-open') ? this.widget.open.getAttribute('data-select-open') : null

        // show loader
        // this.select.loader = event.target.closest('[data-loader-control]')
        // this.select.loader.classList.add('--loading')
        
        // load select content
        this.load('template/ajax/select_' + this.select.url + '.php', this.select.data)

            // .then((response) => response.text())
            .then((text) => {
                // console.log(text)
                const doc = new DOMParser().parseFromString(text, 'text/html')
                var el = document.createElement("div")
                el.innerHTML = doc.querySelector('body').innerHTML
                const node = el.firstChild
                return node
            })
            .then((node) => {

                // if card open
                this.closeNext()

                // replace select
                this.DOM.card = node
                this.append(this.DOM.card)

            })
            .then(() => {
                this.initEvents()

                if(this.is_open) {
                    this.openNext()
                } else {
                    this.open(this.DOM.card)
                }
            })
    }

    append(el) {

        // get custom select
        el.setAttribute('data-select', null);
        this.DOM.container.append(el);
        this.DOM.close = el.querySelectorAll('[data-modal-close]')

        this.select.el = el


        this.select.options = this.select.el.querySelectorAll('[data-select-option]')

        // populate options arrays
        this.options = []
        this.select.options.forEach(el => {
            this.options.push(el.getAttribute('data-select-option'))
        })
        console.log(this.options)

        // scroll to selected
        var index = this.options.indexOf(this.selected)
        var oh = this.select.options[0].getBoundingClientRect().height
        var wh = el.getBoundingClientRect().height
        var ot = index*oh
        var t = ot - wh/2 + oh
        this.select.el.scrollTop = t

        // console.log(this.select)
        // var scalable = document.querySelector('[data-scalable-viewport]')
        // var scrollCenter = {
        //     x: window.innerWidth/2,
        //     y: Locomotion.scroll.instance.delta.y + window.innerHeight/2
        // }
        // scalable.style.setProperty('--originX', scrollCenter.x);
        // scalable.style.setProperty('--originY', scrollCenter.y);

    }

    open(card) {

        // hide loading
        // this.select.loader.classList.remove('--loading')
        this.DOM.card.classList.add('--active')

        // Locomotion.stop();
        document.documentElement.classList.add('no-scroll');
        document.documentElement.classList.add('has-modal');
        // gsap
        // .from(target, 0.8, {
        //     xPercent: 110, 
        //     ease: Expo.easeOut,
        //     onComplete: function() {

        //         // initTabs()
                
        //         // hide loading
        //     }
        // })

        this.is_open = true

    }

    close() {

        document.documentElement.classList.remove('has-modal');
        var target = this.DOM.card
        gsap
        .to(target, 0.8, {
            // xPercent: 0, 
            // ease: Expo.easeOut,
            onComplete: function() {
                target.remove()
                // Locomotion.start();
                document.documentElement.classList.remove('no-scroll');
            }
        })
        this.is_open = false
        this.selected = []

    }

    closeNext() {

        if(this.is_open) {

            // toggle animations
            this.DOM.card.classList.add('--next-out')
            this.DOM.card.classList.remove('--active')

            // fake delayed call
            var target = this.DOM.card
            gsap
            .to(target, 0.8, {
                // xPercent: 0, 
                // ease: Expo.easeOut,
                onComplete: function() {
                    target.remove()
                }
            })
        }

    }

    openNext() {

        this.DOM.inner.scrollTop = 0
        this.DOM.card.classList.add('--next-in','--active')

    }

    initEvents() {
        var _this = this

        this.DOM.close.forEach(function(el) {
            el.addEventListener("click", e => {
                // console.log(e.target)
                e.preventDefault()
                _this.close()
            });
        })

        // click outside select content
        this.DOM.modal.addEventListener("click", e => {
            // console.log(e.target.closest('[data-select]'))
            e.target.closest('[data-select]') === null ? _this.close() : null
        });

        this.select.options.forEach(el => {
            // console.log('Init Async Tabs controls ...')
            // TABS.push(new AsyncTabs(el))
            // console.log(TABS)
            var _this = this
            el.addEventListener('click', function (e) {
                _this.selectOption(this)
                // output.querySelector('[data-select-option='+index+']').classList.toggle('selected')
            });

        })
        


        this.DOM.card.querySelectorAll('[data-select-sub]').forEach(el => {
            // console.log('Init Async Tabs controls ...')
            // TABS.push(new AsyncTabs(el))
            var _this = this
            el.addEventListener('click', function (e) {
                var id = this.getAttribute('data-select-sub')
                console.log('subselect: ', id)
                e.target.closest('[data-select-group]').querySelector('[data-subselect="'+id+'"]').classList.toggle('active')
                e.target.closest('[data-select-group]').classList.toggle('open')
                // e.target.closest('[data-select]').classList.toggle('is-subselect')
                // e.target.closest('[data-select]').scrollTop = 0

                
            });

        })

        this.DOM.card.querySelectorAll('[data-select-back]').forEach(el => {
            // console.log('Init Async Tabs controls ...')
            // TABS.push(new AsyncTabs(el))
            var _this = this
            el.addEventListener('click', function (e) {
                e.target.closest('[data-select-group]').classList.toggle('open')
                e.target.closest('[data-subselect]').classList.toggle('active')
                e.target.closest('[data-select-group]').scrollTop = 0
                
            });

        })



        this.after()
    }

    selectOption(option) {
      console.log(option)

      // get option index
      var index = option.getAttribute('data-select-option')

      // add into selected
      if (!this.multiple) {
        this.selected = []
      } 
      this.selected.indexOf(index) === -1 ? this.selected.push(index) : this.selected.splice(this.selected.indexOf(index),1);
      // console.log(this.selected)


      //
      // change DOM styles
      //

      // toggle selected option
      if(!this.multiple) {
        this.select.options.forEach(el => {
            el.classList.remove('selected')
        })
      }
      option.classList.toggle('selected')

      // if any selected, change select widget style
      this.selected.length === 0 ?  this.DOM.card.classList.remove('is-selected') : this.DOM.card.classList.add('is-selected')




      // update collection

      // place in event emitor


      // console.log(this.selected)
        if(!this.redirect && !this.dialog) {

          var update = this.multiple ? JSON.stringify(this.selected) : this.selected
          var label = option.hasAttribute('data-select-label') ? option.getAttribute('data-select-label') : null
          this.widget.output.setAttribute('value',update)
          // var bind = document.querySelector('[data-bind='+this.widget.el.getAttribute('data-bind')+']')
          // console.log(bind)
          // bind.setAttribute('value',update)
          this.widget.value = update


          if (label) { this.widget.el.querySelector('[data-select-label]').innerHTML = label }
          

          // display selected values
          if (this.multiple) {
              this.widget.outputHtml.querySelectorAll('[data-option]').forEach(el => {
                el.remove()
              })
              console.log(this.widget.output)
              this.selected.forEach(index => {
                var el = document.createElement("div")
                el.setAttribute('data-option',index)
                el.innerHTML = '<span class="tag">'+index+'</span>'
                // console.log(this.widget.output)
                this.widget.outputHtml.append(el)
              })
          }

          this.close()
      }

      if (this.redirect) {
        console.log(this.selected)
          var url = this.widget.el.getAttribute('href')
          window.location.href = url + '&data=' + this.selected
      }

      if (this.dialog) {
          var url = this.widget.el.getAttribute('href')
          if ( this.selected == 1 ) {
              window.location.href = url
          } else {
            this.close()
          }
      }

      if (this.menu) {

          this.close()
      }

      // this.close()
      // dispatch select event
        var event = new CustomEvent('selectSelected', { detail: { select: this, context: this.template, data: this.select.data } });
        window.dispatchEvent(event);

    }


    after() {

        // dispatch select event
        var event = new CustomEvent('selectReady', { detail: { select: this, context: this.template, data: this.select.data } });
        window.dispatchEvent(event);

    }

}

// bind select events
var SELECT = new Select()

function initSelects() {
    console.log('Init Select controls ...')

    document.addEventListener('click', e => {
        e.stopPropagation()
        var el = e.target.closest('[data-select-open]')
        // console.log(el)
        if (el !== null) {
            e.preventDefault();

            // get preselect
            var selected = el.querySelector('[data-select-output]') ? el.querySelector('[data-select-output]').getAttribute('value') : null 

            // get post data
            var post = typeof post !== 'undefined' ? post : el.getAttribute('data-select-post');

            // get url
            var url = typeof url !== 'undefined' ? url : el.getAttribute('data-select-open');

            // test data if json or string
            var dataArr = []
            if (isJSON(selected)) {
                dataArr = JSON.parse(selected)
            } else {
                dataArr[0] = selected
            }  
            console.log(dataArr)
            SELECT.add(e.target.closest('[data-select-widget]'), url, dataArr, post)  
        }
    })
}

function isJSON(str) {
    try {
        return (JSON.parse(str) && !!str);
    } catch (e) {
        return false;
    }
}