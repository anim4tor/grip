/*

    DROPDOWN

*/
class Dropdown {
    constructor() {

        this.card = {}
        this.is_open = false
        this.url = null
        this.openClass = 'has-dropdown'
    }

    init() {
        console.log('Init Dropdown controls ...')
        this.initEvents()
    }

    // async fetch(template = 'default', id = '') {
    async fetch(e) {
        // let url = `${window.location.protocol}//${window.location.host}${lang}/modals.json/template${eq}${template}/id${eq}${id}`;
        if(!this.is_open) { 
            this.url = e.target.closest('[open-dropdown]').getAttribute('href')
            console.log('Fetching dropdown url:', this.url)
            try {
              const response = await fetch(this.url);
              const json = await response.json();
              // console.log(json)
              this.add(e, json.html)  
            } catch (error) {
              console.log('Fetch error: ', error);
            }
        }
    }

    add(e, html) { 
        console.log('Adding new dropdown')
        this.renderCard(html)
        this.position(e)
        this.open()
    }

    renderCard(html) {
        var card = document.createElement("dropdown")
        card.classList.add('dropdown')
        // card.toggleAttribute('dropdown')
        card.innerHTML = html
        this.card = card
        document.querySelector('body').appendChild(this.card)
    }

    position(e) {
        var touch = {
            x: 0,
            y: 0
        };
        touch.x = e.touches ? e.touches[0].clientX : e.clientX;
        touch.y = e.touches ? e.touches[0].clientY : e.clientY;
        console.log(touch)
    }

    open() {
        if(!this.is_open) { 
            console.log('Opening dropdown')
            document.documentElement.classList.add('no-scroll');
            document.documentElement.classList.add(this.openClass);
            this.is_open = true
            setTimeout( () => {
                this.after()
            }, 0)
        }
    }

    close() {
        if(this.is_open) { 
            document.documentElement.classList.remove(this.openClass);
            document.documentElement.classList.remove('no-scroll');
            setTimeout( () => {
                this.card.remove()
                this.is_open = false
            }, 0)
        }
    }

    initEvents() {
        var _this = this
        document.querySelectorAll('[open-dropdown]').forEach(function(el) {
            el.addEventListener("click", (e) => {
                e.preventDefault()
                _this.fetch(e)
            })
        })
        document.addEventListener('click', (e) => {
            if(this.is_open) {
                if (!this.card.contains(e.target)) this.close();
            }
        });
    }

    after() {

    }
}
// bind modal events
var DROPDOWN = new Dropdown()

function initDropdowns(container = document) {
    DROPDOWN.init()
}
