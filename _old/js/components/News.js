// PROXI ANIMATIONS

class News {
    constructor(el) {
        console.log('Init news widget ...')
        this.DOM = {
            control: el,
        };
        this.class = {
            open: '--news-open',
            close: '--news-closing'
        }
        this.DOM.trigger = this.DOM.control.querySelector('[data-news-open]')
        this.DOM.close = this.DOM.control.querySelectorAll('[data-news-close]')
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
            this.DOM.header.classList.add('--news-open');

        });
        this.DOM.trigger.addEventListener("mouseleave", e => {
            e.preventDefault()
            this.DOM.header.classList.remove('--news-open');

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
            this.DOM.header.classList.add('--news-open');
        } 
    }

    close() {
        this.DOM.control.classList.add(this.class.close)
        var _this = this
        setTimeout(function() {
            _this.DOM.control.classList.remove(_this.class.open)
            _this.DOM.control.classList.remove(_this.class.close)
           
            if (bgChange) {
                 _this.DOM.header.classList.add('--news-open');
            }
        },600)
        this.isOpen = false

    }

}

new News(document.querySelector('body'));