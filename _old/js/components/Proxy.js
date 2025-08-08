// PROXI ANIMATIONS

class Proxy {
    constructor(el) {
        console.log('Proxi animations ...')
        this.DOM = {
            control: el
        };
        // array of Image objs, one per image element
        this.items = [];
        [...this.DOM.control.querySelectorAll('[data-proxi-item]')].forEach(item => this.items.push(item));

        // image deafult styles
        this.opt = {
            amount: 0.25
        };

        // get sizes/position
        this.getRect();

        // init/bind events
        if(!isMobile) {
            this.initEvents();
        }
    }

    getRect() {
        this.rect = this.DOM.control.getBoundingClientRect();
    }

    getPos(el) {
        this.getRect()
        var relativeX = (mousePos.x - this.rect.left - this.rect.width/2);
        var relativeY = (mousePos.y - this.rect.top - this.rect.height/2);
        return { x: relativeX, y: relativeY }
    }

    initEvents() {
        this.DOM.control.addEventListener("mousemove", e => {
            this.follow(e)
        });
        this.DOM.control.addEventListener("mouseleave", e => {
            this.retreat()
        });
    }

    follow(e) {
        gsap.to(this.items, 0.5, {
            x: this.getPos(e.target).x * this.opt.amount , 
            y: this.getPos(e.target).y * this.opt.amount ,
            ease: Expo.easeOut
        });
    }

    retreat() {
        gsap.to(this.items, 1, {
            x: 0, 
            y: 0,
            ease: Expo.easeOut
        });
    }

}

function initProxy() {
    console.log('Initialize proxi controlers ...')
    document.querySelectorAll('[data-proxi-control]').forEach(function(el) {
        new Proxy(el);
    })
}