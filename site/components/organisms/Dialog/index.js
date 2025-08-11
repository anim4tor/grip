/*

    MODAL

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
        this.openClass = 'has-dialog'
        this.init()
    }

    init() {
        this.initEvents()
    }

    // async fetch(template = 'default', id = '') {
    async fetch(e) {
        // let url = `${window.location.protocol}//${window.location.host}${lang}/modals.json/template${eq}${template}/id${eq}${id}`;

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

    add(html) { 
        // console.log(this.next, this.back)
        if (this.next) {
            this.openNext(html)
        } else if(this.back) {
            this.openPrev(html)
        } else {
            console.log('Adding new dialog')
            this.renderCard(html)
            // this.initEvents()
            this.open()
        }
        
    }

    renderCard(html) {
        var card = document.createElement("div")
        card.classList.add('dialog')
        card.toggleAttribute('dialog')
        card.innerHTML = html
        this.DOM.load.appendChild(card)
    }

    open() {
        console.log('Opening dialog')
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
        console.log('Init Dialog events ...')
        var _this = this
        this.DOM.close = document.querySelectorAll('[close-dialog]')
        this.DOM.close.forEach(function(el) {
            el.addEventListener("click", e => {
                // console.log(e.target)
                e.preventDefault()
                _this.close()
                // initScroll()
            });
        })
    }

    after() {

    }
}
// bind modal events
var DIALOG = new Dialog()

function initDialogs(container = document) {
    console.log('Init Dialog controls ...')
    const dialogOpen  = container.querySelectorAll('[open-dialog]');
    dialogOpen.forEach(function(el) {
        el.addEventListener("click", (e) => {
          e.preventDefault()
          DIALOG.fetch(e)
        })
    })
}
