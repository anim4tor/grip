// PROXI ANIMATIONS

class Aside {
    constructor(el) {
        console.log('Init aside menu ...')
        this.DOM = {
            control: el,
        };
        this.class = {
            open: '--aside-open',
            close: '--aside-closing'
        }
        this.DOM.trigger = this.DOM.control.querySelector('[data-menu]')
        this.DOM.close = this.DOM.control.querySelectorAll('[data-menu-close]')
        this.DOM.menu = this.DOM.control.querySelectorAll('[data-aside]')
        this.DOM.header = this.DOM.control.querySelector('[data-header]')
        this.isOpen = false

        // init/bind events
        if(!isMobile) {
            this.initEvents();
        }

    }

    initEvents() {
        this.DOM.trigger.addEventListener("click", e => {
            e.preventDefault()
            if(this.isOpen) {
                this.close()
            } else {
                this.open()
            }
        });

        this.DOM.trigger.addEventListener("mouseover", e => {
            e.preventDefault()
            this.DOM.header.classList.add('--aside-open');

        });
        this.DOM.trigger.addEventListener("mouseleave", e => {
            e.preventDefault()
            this.DOM.header.classList.remove('--aside-open');

        });

        this.DOM.close.forEach((el) => { 
            el.addEventListener("click", e => {
                e.preventDefault()
                if(this.isOpen) {
                    this.close()
                }
            });
        })
    }

    open() {
        this.isOpen = true
        this.DOM.control.classList.add(this.class.open)

        if (bgChange) {
            this.DOM.header.classList.add('--aside-open');
        } 
    }

    close() {
        this.DOM.control.classList.add(this.class.close)
        var _this = this
        setTimeout(function() {
            _this.DOM.control.classList.remove(_this.class.open)
            _this.DOM.control.classList.remove(_this.class.close)
           
            if (bgChange) {
                 _this.DOM.header.classList.add('--aside-open');
            }
        },600)
        this.isOpen = false

    }

}

new Aside(document.querySelector('body'));