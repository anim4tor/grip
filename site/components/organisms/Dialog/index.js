/*

    DIALOG

*/
class Dialog {
    constructor() {

        this.DOM = {
            widget: document.querySelector('[dialog-widget]'),
            load: document.querySelector('[dialog-load]'),
            loaderer: {}
        };

        this.is_open = false
        this.url = null
        this.parent = null
        this.openClass = 'has-dialog'
    }

    init() {
        console.log('Init Dialog controls ...')
        this.initEvents()
    }

    // async fetch(template = 'default', id = '') {
    async fetch(e) {
        // let url = `${window.location.protocol}//${window.location.host}${lang}/modals.json/template${eq}${template}/id${eq}${id}`;
        this.parent = e.target.closest('[data-dialog-parent]')
        if(!this.is_open) { 
            this.context = e.target
            this.url = e.target.closest('[open-dialog]').getAttribute('href')
            console.log('Fetching dialog url:', this.url)
            try {
              const response = await fetch(this.url);
              const json = await response.json();
              // console.log(json)
              this.add(json.html)  
            } catch (error) {
              console.log('Fetch error: ', error);
            }
        }
    }

    add(html) { 
        console.log('Adding new dialog')
        this.renderCard(html)
        this.open()
    }

    renderCard(html) {
        var card = document.createElement("div")
        card.classList.add('dialog')
        card.toggleAttribute('dialog')
        card.innerHTML = html
        this.DOM.load.appendChild(card)
    }

    open() {
        if(!this.is_open) { 
            console.log('Opening dialog')
            document.documentElement.classList.add('no-scroll');
            document.documentElement.classList.add(this.openClass);
            this.is_open = true
            setTimeout( () => {
                this.after()
            }, 300)
        }
    }

    close() {
        if(this.is_open) { 
            document.documentElement.classList.remove(this.openClass);
            document.documentElement.classList.remove('no-scroll');
            setTimeout( () => {
                this.DOM.load.innerHTML = ''
                this.is_open = false
            }, 300)
        }
    }

    initEvents() {
        var _this = this
        document.addEventListener("click", e => {
            e.stopPropagation()
            var el = e.target.closest('[close-dialog]')
            if (el !== null) {
                e.preventDefault()
                _this.close()
            }
        })
        document.addEventListener("click", e => {
            e.stopPropagation()
            var el = e.target.closest('[open-dialog]')
            if (el !== null) {
                e.preventDefault()
                _this.fetch(e)
            }
        })
    }

    after() {
        console.log('After dialog:')
        initSelects(this.DOM.widget, this.parent)
    }
}
// bind modal events
var DIALOG = new Dialog()

function initDialogs(container = document) {
    DIALOG.init()
}
