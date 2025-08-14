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
              console.log(json)
              this.add(e,json.html)  
            } catch (error) {
              console.log('Fetch error: ', error);
            }
        }
    }

    add(e,html) { 
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
        // get dropdown dimensions
        var link = e.target.closest('[open-dropdown]').getBoundingClientRect()
        console.log(link)
        var widget = this.card.querySelector('[data-dropdown]').getBoundingClientRect()
        if(link.left + widget.width > window.innerWidth) {
            this.card.querySelector('[data-dropdown]').style.right = window.innerWidth - link.left - link.width + 'px'
            this.card.querySelector('[data-dropdown]').style.transformOrigin = "top right";
        } else {
            this.card.querySelector('[data-dropdown]').style.left = link.left + 'px' 
        }
        if(link.top + widget.height > window.innerHeight) {
            this.card.querySelector('[data-dropdown]').style.bottom = window.innerHeight - link.top - link.height + 'px'
            this.card.querySelector('[data-dropdown]').style.transformOrigin = "bottom right";
        } else {
            this.card.querySelector('[data-dropdown]').style.top = link.top + 'px'
        }
        
    }

    open() {
        if(!this.is_open) { 
            console.log('Opening dropdown')
            this.card.querySelector('[data-dropdown]').toggleAttribute('open')
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
            this.card.querySelector('[data-dropdown]').toggleAttribute('close')
            document.documentElement.classList.remove(this.openClass);
            document.documentElement.classList.remove('no-scroll');
            setTimeout( () => {
                this.card.remove()
                this.is_open = false
            }, 200)
        }
    }

    initEvents() {
        var _this = this
        // document.querySelectorAll('[open-dropdown]').forEach(function(el) {
            // el.addEventListener("click", e => {
        document.addEventListener("click", e => {
            e.stopPropagation()
            var el = e.target.closest('[open-dropdown]')
            // console.log(el)
            if (el !== null) {
                e.preventDefault()
                _this.fetch(e)
            }
        })
        // })
        document.addEventListener('click', e => {
            if(this.is_open) {
                if (!this.card.querySelector('[data-dropdown]').contains(e.target)) this.close();
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
