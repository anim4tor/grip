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
        
        this.card = {}
        this.is_open = false
        this.dir = null
        this.next = false
        this.back = false
        this.url = null
        this.openClass = 'has-modal'
    }

    init() {
        console.log('Init Modal controls ...')
        this.initEvents()
    }

    async force(url, dir = false) {
        this.url = url
        this.back = dir
        console.log('Fetching modal url:', this.url, this.dir)
        this.response(true)
    }

    async fetch(url, dir = null) {
        this.url = url
        this.dir = dir
        // this.url = e.target.closest('[modal-open]').getAttribute('href')
        // this.next = e.target.closest('[modal-open]').getAttribute('modal-open') == 'next' ?? false
        // this.back = e.target.closest('[modal-open]').getAttribute('modal-open') == 'prev' ?? false
        console.log('Fetching modal url:', this.url, this.dir)
        this.response()
    }

    async response(reload = false) {
        try {
          const response = await fetch(this.url);
          const json = await response.json();
          console.log(json)
          reload ? this.reload(json.html) : this.add(json.html)  
        } catch (error) {
          console.log('Fetch error: ', error);
        }
    }

    add(html) { 
        // console.log(this.next, this.back)
        if (this.dir == 'next') {
            this.openNext(html)
        } else if(this.dir == 'prev') {
            this.openPrev(html)
        } else {
            console.log('Adding new modal')
            this.renderCard(html)
            this.open()
        }
        
    }

    reload(html, dir) {
        console.log('Reloading modal')
        this.back ? this.openPrev(html) :
            this.renderCard(html)
            this.DOM.load.appendChild(this.card)
            this.DOM.load.removeChild(this.DOM.load.firstElementChild)
            this.is_open = true
            setTimeout(() => {
                this.after()
            }, 300)
    }

    renderCard(html) {
        var card = document.createElement("div")
        card.classList.add('modal')
        card.toggleAttribute('modal')
        card.innerHTML = html
        this.card = card        
    }

    change() {
        if(this.is_open) {
            this.dir == 'prev' ? this.card.toggleAttribute('open-prev') : this.card.toggleAttribute('open-next')
        }
        this.prev = this.current > 0 ? this.current - 1 : 0
        this.current++;
        this.DOM.load.appendChild(this.card)
    }

    openNext(html) {
        this.renderCard(html)
        this.change()
        console.log('Opening as next modal')
        this.DOM.load.firstElementChild.toggleAttribute('close-next')
        this.after()
        setTimeout(() => {
            this.DOM.load.removeChild(this.DOM.load.firstElementChild)
        }, 600)

    }

    openPrev(html) {
        this.renderCard(html)
        this.change()
        console.log('Opening as previous modal')
        this.DOM.load.firstElementChild.toggleAttribute('close-prev')
        this.after()
        setTimeout(() => {
            this.DOM.load.removeChild(this.DOM.load.firstElementChild)
        }, 600)

    }

    open() {
        this.change()
        console.log('Opening modal')
        document.documentElement.classList.add('no-scroll');
        document.documentElement.classList.add(this.openClass);
        this.is_open = true
        setTimeout(() => {
            this.after()
        }, 300)
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
        document.addEventListener("click", e => {
            e.stopPropagation()
            var el = e.target.closest('[modal-close]')
            if (el !== null) {
                e.preventDefault()
                _this.close()
            }
        })
        document.addEventListener("click", e => {
            e.stopPropagation()
            var el = e.target.closest('[modal-open]')
            if (el !== null) {
                e.preventDefault()
                _this.fetch(el.getAttribute('href'), el.getAttribute('modal-open'))
            }
        })
        // this.DOM.widget.querySelectorAll('[modal-open]').forEach(function(el) {
        //     el.addEventListener("click", e => {
        //         // console.log(e.target)
        //         e.preventDefault()
        //         _this.fetch(e)
        //     });
        // })
    }

    after() {
        initTabs()
        initNestedTabs()
        initCarousels()
        initForms()
        initSelects(this.DOM.widget)
    }
}
// bind modal events
var MODAL = new Modal()

function initModals(container = document) {
    MODAL.init()
}
