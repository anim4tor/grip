/*

    MODAL

*/
const eq = (window.location.host.split('.').pop() == 'test') ? ';' : ':' 
class Modal {
    constructor() {

        this.DOM = {
            widget: document.querySelector('[modal-widget]'),
            load: document.querySelector('[modal-load]'),
            next: document.querySelector('[modal-next]'),
            loaderer: {}
        };

        this.prev = 0
        this.current = 0
        
        this.is_open = false
        this.next = false
        this.back = false
        this.url = null
        this.openClass = 'has-modal'
        this.init()
    }

    init() {

    }

    // async fetch(template = 'default', id = '') {
    async fetch(e) {
        // let url = `${window.location.protocol}//${window.location.host}${lang}/modals.json/template${eq}${template}/id${eq}${id}`;

        this.url = e.target.closest('[modal-open]').getAttribute('href')
        this.next = e.target.closest('[modal-open]').getAttribute('modal-open') == 'next' ?? false
        this.back = e.target.closest('[modal-open]').getAttribute('modal-open') == 'prev' ?? false
        console.log('Fetching modal url:', this.url)
        try {
          const response = await fetch(this.url);
          const json = await response.json();
          // console.log(json)
          this.add(json.html)  
        } catch (error) {
          console.log('Fetch error: ', error);
        }
    }

    add(html) { 
        // console.log(this.next, this.back)
        if (this.next) {
            this.openNext(html)
        } else if(this.back) {
            this.openPrev(html)
        } else {
            console.log('Adding new modal')
            this.renderCard(html)
            // this.initEvents()
            this.open()
        }
        
    }

    renderCard(html) {
        var card = document.createElement("div")
        card.classList.add('modal')
        card.toggleAttribute('modal')
        if(this.is_open) {
            this.back ? card.toggleAttribute('open-prev') : card.toggleAttribute('open-next')
        }
        card.innerHTML = html
        // this.items.push(card)
        this.prev = this.current > 0 ? this.current - 1 : 0
        this.current++;
        this.DOM.load.appendChild(card)
    }

    openNext(html) {
        this.renderCard(html)
        console.log('Opening as next modal')
        this.DOM.load.firstElementChild.toggleAttribute('close-next')
        this.after()
        setTimeout(() => {
            this.DOM.load.removeChild(this.DOM.load.firstElementChild)
        }, 600)

    }

    openPrev(html) {
        this.renderCard(html)
        console.log('Opening as previous modal')
        this.DOM.load.firstElementChild.toggleAttribute('close-prev')
        this.after()
        setTimeout(() => {
            this.DOM.load.removeChild(this.DOM.load.firstElementChild)
        }, 600)

    }

    open() {
        console.log('Opening modal')
        document.documentElement.classList.add('no-scroll');
        document.documentElement.classList.add(this.openClass);
        this.is_open = true
        this.after()
    }

    close() {
        document.documentElement.classList.remove(this.openClass);
        document.documentElement.classList.remove('no-scroll');
        setTimeout( () => {
            this.DOM.load.innerHTML = ''
        }, 600)
        this.is_open = false
    }

    initEvents() {
        var _this = this
        this.DOM.close = document.querySelectorAll('[modal-close]')
        this.DOM.close.forEach(function(el) {
            el.addEventListener("click", e => {
                // console.log(e.target)
                e.preventDefault()
                _this.close()
                // initScroll()
            });
        })
        this.DOM.widget.querySelectorAll('[modal-open]').forEach(function(el) {
            el.addEventListener("click", e => {
                // console.log(e.target)
                e.preventDefault()
                _this.fetch(e)
                // initScroll()
            });
        })
    }

    after() {
        this.initEvents()
    }
}
// bind modal events
var MODAL = new Modal()

function initModals(container = document) {
    console.log('Init Modal controls ...')
    const modalOpen  = container.querySelectorAll('[modal-open]');
    modalOpen.forEach(function(el) {
        el.addEventListener("click", (e) => {
          e.preventDefault()
          MODAL.fetch(e)
        })
    })
}
