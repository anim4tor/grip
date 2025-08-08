/*

  ASIDE MENU
  
*/

class Aside {
    constructor(el) {
        console.log('Init Aside menu ...')
        this.DOM = {
            control: el,
            trigger: el.querySelectorAll('[data-aside-toggle]'),
            close: el.querySelectorAll('[data-aside-close]'),
            menu: el.querySelectorAll('[data-aside-menu]'),
            header: el.querySelector('[data-header]')
        };
        this.class = {
            open: 'aside-open',
            close: 'aside-closing'
        }
        
        this.isOpen = false

        // init/bind events
        // if(!isMobile) {
            this.initEvents();
        // }

    }

    open() {
        this.isOpen = true
        this.DOM.control.setAttribute(this.class.open, '')
        requestAnimationFrame(() => {
            SCROLL.stop();
        });
    }

    close() {
        this.DOM.control.removeAttribute(this.class.open)

        var _this = this
        setTimeout(function() {

        },0)
        this.isOpen = false
        requestAnimationFrame(() => {
            SCROLL.start();
        });

    }

    onMenu(e) {
        var index = Array.from(this.DOM.menu).indexOf(e.target)
        console.log('On menu enter: ', index)

        this.DOM.menu.forEach(el => { el.removeAttribute('data-active') })
        this.DOM.menu.item(index).setAttribute('data-active',true)
    }

    initEvents() {
        this.DOM.trigger.forEach((el) => { 
            el.addEventListener("click", e => {
                console.log('Trigger')
                e.preventDefault()
                if(this.isOpen) {
                    this.close()
                } else {
                    this.open()
                }
            });
        })

        this.DOM.close.forEach((el) => { 
            el.addEventListener("click", e => {
                e.preventDefault()
                if(this.isOpen) {
                    this.close()
                }
            });
        })

        this.DOM.menu.forEach((el) => { 
            el.addEventListener("mouseenter", e => {
                e.preventDefault()
                this.onMenu(e)
            });
        })
    }


}

function initAside() {
    new Aside(document.documentElement);
}