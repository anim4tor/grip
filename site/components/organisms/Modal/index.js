/*

    MODAL

*/
const eq = (window.location.host.split('.').pop() == 'test') ? ';' : ':' 
class Modal {
    constructor() {

        this.DOM = {
            widget: document.querySelector('[data-modal-widget]'),
            load: document.querySelector('[data-modal-load]'),
            inner: document.querySelector('[data-modal-scroll]'),
            loader: {}
        };
        
        is_open: false
    }

    // async fetch(template = 'default', id = '') {
    async fetch(url = '') {
        // let url = `${window.location.protocol}//${window.location.host}${lang}/modals.json/template${eq}${template}/id${eq}${id}`;

        console.log('Fetching modal url:', url)
        try {
          const response = await fetch(url);
          const json = await response.json();
          // console.log(json)
          this.add(json.html)  
        } catch (error) {
          console.log('Fetch error: ', error);
        }
    }

    add(html) {
        this.DOM.load.innerHTML = html
        this.DOM.close = document.querySelectorAll('[data-modal-close]')
        this.initEvents()
        this.open()
    }

    open() {
        // hide loading
        // this.modal.loader.classList.remove('--loading')
        // this.modal.card.classList.add('--active')
        document.documentElement.classList.add('no-scroll');
        document.documentElement.classList.add('has-modal');
        this.is_open = true

        initModals(this.DOM.load)
    }

    close() {
        document.documentElement.classList.remove('has-modal');
        document.documentElement.classList.remove('no-scroll');
        setTimeout( () => {
            this.DOM.load.innerHTML = ''
        }, 600)
        this.is_open = false
    }

    initEvents() {
        var _this = this
        this.DOM.close.forEach(function(el) {
            el.addEventListener("click", e => {
                // console.log(e.target)
                e.preventDefault()
                _this.close()
                initScroll()
            });
        })
    }
}
// bind modal events
var MODAL = new Modal()

function initModals(container = document) {
    console.log('Init Modal controls ...')

    const modalOpen  = container.querySelectorAll('[modal-open]');
    const modalLoad = document.querySelector('[data-modal-load]')

    modalOpen.forEach(function(el) {
        el.addEventListener("click", (e) => {
          e.preventDefault()
          // var template = e.target.closest('[modal-open]').getAttribute('href').split('/')[1];
          // var id = e.target.closest('[modal-open]').getAttribute('href').split('/')[2];
          // console.log()
          // let template      = e.target.closest('[modal-open]').getAttribute('modal-template');
          // MODAL.fetch(template, id)
          MODAL.fetch(e.target.closest('[modal-open]').getAttribute('href'))
        })
    })
}
