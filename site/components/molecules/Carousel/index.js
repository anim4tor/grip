/*

    CAROUSEL

*/

class Carousel {
    constructor(el) {
        this.DOM = {
            
        };
        this.carousel = el;
        this.navnext = this.carousel.querySelectorAll('[data-carousel-next]')
        this.navprev = this.carousel.querySelectorAll('[data-carousel-prev]')
        this.panes = this.carousel.querySelector('[data-carousel-slides]')
        this.items = this.panes ? this.panes.querySelectorAll('[data-slide]') : null
        this.tabs = document.querySelectorAll('[data-carousel-tab]')
        this.w = this.items[0].getBoundingClientRect().width
        this.per = this.carousel.getAttribute('data-per-page') != null ? parseInt(this.carousel.getAttribute('data-per-page')) : 1;
        this.max = (this.items.length + 1) * this.w - window.innerWidth 
        this.max = (this.items.length - this.per) * this.w
        this.active = 0
        this.height = this.panes.getBoundingClientRect().height
        this.dynamic = this.carousel.hasAttribute('dynamic') ? true : false;
        this.scroll
        this.isPressed = false
        this.isDragged = false
        this.isChanging = false
        this.touch = {
          start: 0,
          end: 0,
          distance: 0,
          threshold: 100
        }

        this.init()
    }

    init() {
      console.log('Init Carousel widget ...')
      this.initEvents()
      setTimeout(() => {
        this.change(this.active)
      }, 100)
    }

    initEvents() {

      if(this.navnext) this.navnext.forEach( el => { el.addEventListener("click", e => { this.next(e) }) });
      if(this.navprev) this.navprev.forEach( el => { el.addEventListener("click", e => { this.prev(e) }) });

      if(this.tabs) {  
        this.tabs.forEach(tab => {
          tab.addEventListener("click", e => { this.handleClick(e) });
          tab.addEventListener("touchstart", e => { this.handleTouch(e) });
        })
      }

      this.carousel.addEventListener("mousedown", e => { this.handleMouseTouchDown(e) });
      this.carousel.addEventListener("mousemove", e => { this.handleMouseTouchMove(e) });
      this.carousel.addEventListener("mouseup", e => { this.handleMouseTouchUp(e) });
      
      this.carousel.addEventListener("touchstart", e => { this.handleMouseTouchDown(e) });
      this.carousel.addEventListener("touchmove", e => { this.handleMouseTouchMove(e) });
      this.carousel.addEventListener("touchend", e => { this.handleMouseTouchUp(e) });

  }

  next(e) {
      e.preventDefault()
      this.isChanging = true
      if(this.active < this.items.length) {
        this.active != this.items.length - this.per ? this.active++ : this.active
        this.change(this.active)
      }
  }

  prev(e) {
    e.preventDefault()
    this.isChanging = true
    this.active > 0 ? this.active-- : this.active
    this.change(this.active)
  }

  change(active) {
    var _this = this
    console.log(active)
    this.w = (window.innerWidth - this.items[active].getBoundingClientRect().width)/2 - this.items[active].offsetLeft + 16
    console.log(this.items[active].offsetLeft, this.w)
    // var x = this.w * this.active * 1
    var x = this.w
    gsap.to(this.panes, .5, {
        x: this.w, 
        ease: Power3.easeOut,
    })    
    this.scroll = this.w
    setTimeout(function() {
      _this.items.forEach(el => {
        el.removeAttribute('data-active')
        
      })
      _this.items[active].setAttribute('data-active', true)
    },200)


    if( this.dynamic ) {
      // this.panes.style.height = this.items[active].getBoundingClientRect().height + 'px'
    } 

    this.carousel.style.setProperty('--active', this.active)

    this.onChange(active)
  }

  handleClick(e) {
    e.preventDefault()
    var target = e.target.closest('[data-carousel-tab]');
    var parent = target.parentNode;
    this.active = [].indexOf.call(parent.children, target);
    this.change(this.active) 
  }

  handleTouch(e) {
    // e.preventDefault()
    if(!isDragged) {
      var target = e.target.closest('[data-carousel-tab]');
      var parent = target.parentNode;
      this.active = [].indexOf.call(parent.children, target);
      this.change(this.active) 
      this.isDragged = false

    }
  }

  handleMouseTouchDown(e) {
    this.isPressed = true
    e.preventDefault()
    this.grab(e)
  }

  handleMouseTouchMove(e) {
    if (!this.isPressed) return;
    this.isDragged = true
    e.preventDefault();
    this.panes.classList.add('is-dragged')
    this.drag(e)

  }

  handleMouseTouchUp(e) {
    this.isPressed = false
    this.isDragged = false
    e.preventDefault();
    this.release(e)
    this.panes.classList.remove('is-dragged')

  }

  grab(e) {
    // if (isChanging) return;
      this.touch.distance = 0;
      this.touch.start = e.touches ? e.touches[0].clientX : e.clientX;
  }

  drag(e) {
    // if (isChanging) return;
      this.touch.end = e.changedTouches ? e.changedTouches[0].clientX : e.clientX;
      this.touch.distance = this.touch.end - this.touch.start
      this.carousel.style.cursor = "grab"
      if(Math.abs(this.touch.distance) > 1) {
        this.follow()
      }

  }

  release(e) {
    // if (isChanging) return;
    console.log(this.scroll)
    this.scroll = this.scroll + this.touch.distance
    console.log(this.scroll)
    if(Math.abs(this.touch.distance) > 100) {
      this.touch.distance < 0 ? this.next(e) : this.prev(e)
    } else {
      this.retreat()
    }
  }

  follow() {
    
    console.log(this.scroll + this.touch.distance)

    gsap.to(this.panes, 0, {
        x: this.scroll + this.touch.distance,
        ease: 'none'
    });

  }

  retreat() {
    console.log('Retreat:', this.touch.distance)
    this.scroll = this.scroll - this.touch.distance
    gsap.to(this.panes, .5, {
        x: this.scroll,
        ease: Power3.easeOut,
    })
  }

  onChange(active) {
    let output = this.items[this.active].getAttribute('data-slide')
    // this.carousel.setAttribute('data-value',output)
    this.carousel.querySelector('input').value = output
  }

}


function initCarousels() {
  document.querySelectorAll('[data-carousel]').forEach(el => {
    if (!el) return
    new Carousel(el)
  })
}
  

// function retreat(dir) {
//     var _this = this

//     gsap.to(this.DOM.panes[this.data.active], .5, {
//         x: 0, 
//         scale: 1,
//         opacity: 1,
//         ease: Expo.easeOut,
//         onComplete() {
//           gsap.set(_this.DOM.panes[_this.data.active], { clearProps: 'all' });

//         }
//     });
//     if (dir == 'next') {
//         gsap.to(this.DOM.panes[this.data.active + 1], .5, {
//             xPercent: 110, 
//             ease: Expo.easeOut,
//             onComplete() {
//                  gsap.set(_this.DOM.panes[_this.data.active + 1], { clearProps: 'all' });

//             }
//         });
//     } else {
//         gsap.to(this.DOM.panes[this.data.active - 1], .5, {
//             xPercent: -110, 
//             ease: Expo.easeOut,
//             onComplete() {
//                 gsap.set(_this.DOM.panes[_this.data.active - 1], { clearProps: 'all' });

//             }
//         });
//     }
// }
