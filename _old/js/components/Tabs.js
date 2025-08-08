/*

    TABS

*/

class Tabs {
    constructor(el) {
        this.DOM = {
            widget: el,
            // ( document.querySelectorAll('[data-tab]') )
            tabs: Array.prototype.slice.call(el.querySelectorAll('[data-tab]')),
            container: el.querySelector('[data-pane-container]'),
            panes: el.querySelectorAll('[data-pane]'),
            nav: {}
            // loader: event.target.closest('[data-loader-control]')
        };

        this.context = el.getAttribute('data-context')

        this.DOM.nav = {
            prev: typeof this.DOM.widget.querySelectorAll('[data-tab-prev]') !== undefined ? this.DOM.widget.querySelectorAll('[data-tab-prev]') : null,
            next: typeof this.DOM.widget.querySelectorAll('[data-tab-next]') !== undefined ? this.DOM.widget.querySelectorAll('[data-tab-next]') : null,
        }

        this.data = {
            init: 0,
            prev: 0,
            active: 0,
            next: 0,
            to: 0,
        };

        this.touch = {
            start: 0,
            end: 0,
            distance: 0,
            threshold: 60
        };


        console.log('data-tab-widget = ' + this.DOM.widget.getAttribute('data-tab-widget'))
        this.data.init = this.DOM.widget.getAttribute('data-tab-widget').length > 0 ? (this.DOM.widget.getAttribute('data-tab-widget') - 1) : 0
        
        this.async = null,

        this.is_changing = false

        this.init()
        
    }

    init() {

        // console.log('First index: ' + this.data.init)
        console.log(this);

        this.DOM.widget.classList.add('--init')

        this.DOM.panes[this.data.init].classList.add('--active')
        this.DOM.tabs[this.data.init].classList.add('--active')

        this.data.active = this.data.init

        gsap.from(this.DOM.panes[this.data.active], .5, {
            xPercent: 110, 
            ease: Expo.easeOut
        });

        this.initEvents()

    }

    setActive(e) {

        if(!this.is_changing) {
            this.data.next = this.DOM.tabs.indexOf(e.target.closest('[data-tab]'))

            if (this.data.next != this.data.active) {
                gsap.from(this.DOM.panes[this.data.next], .5, {
                    xPercent: 110, 
                    ease: Expo.easeOut
                });

                this.change('next')              
            }
        }

    }

    next() {
        
        if(!this.is_changing) {
            this.DOM.nav.next.forEach(function(el) { el.classList.add('--loading') })
            if (this.data.active < (this.DOM.panes.length - 1)) {
                this.data.next = this.data.active + 1
                this.change('next')
            } else {
                // load next week
                var date = this.DOM.tabs[this.data.active].getAttribute('data-day')
                console.log('Loading next week ...', date)

                var today = this.DOM.panes[this.DOM.panes.length - 1].getAttribute('data-pane')

                var tomorrow = new Date(today.split('-')[0],today.split('-')[1],today.split('-')[2])
                this.context == 'week' ? tomorrow.setDate(tomorrow.getDate() + 1) : tomorrow.setMonth(tomorrow.getMonth() + 1)
                tomorrow = formatDate(tomorrow)

                // tomorrow = tomorrow.toISOString().split('T')[0]

                console.log(today)
                console.log(tomorrow)

                window.location.href = this.context + '.php' + '?d=' + tomorrow


                
            }
            // this.data.next = this.data.active < (this.DOM.panes.length - 1) ? this.data.active + 1 : 0 
        }

    }

    previous() {

        if(!this.is_changing) {
            this.DOM.nav.prev.forEach(function(el) { el.classList.add('--loading') })
            if (this.data.active > 0) {
                this.data.next = this.data.active - 1
                this.change('prev')
            } else {
                // load next week
                console.log('Loading previous week ...')
                var today = this.DOM.panes[0].getAttribute('data-pane')

                var yesterday = new Date(today.split('-')[0],today.split('-')[1],today.split('-')[2])
                this.context == 'week' ? yesterday.setDate(yesterday.getDate() - 1) : yesterday.setMonth(yesterday.getMonth() - 1)
                yesterday = formatDate(yesterday)

                // yesterday = yesterday.toISOString().split('T')[0]

                console.log(today)
                console.log(yesterday)

                window.location.href = this.context + '.php' + '?d=' + yesterday
            }


            // this.data.next = this.data.active > 0 ? this.data.active - 1 : (this.DOM.panes.length - 1)
        }

    }

    paneOut() {
        
        var _this = this
        // animate active out
        gsap.to(this.DOM.panes[this.data.prev], .5, {
            scale: 0.5, 
            opacity: 0,
            ease: Expo.easeOut,
            onComplete() {

              // reset previous
              gsap.set(_this.DOM.panes[_this.data.prev], { clearProps: 'all' });

            },
        });
    }

    paneIn() {
        var _this = this


        gsap.to(this.DOM.panes[this.data.active], .5, {
            xPercent: 0, 
            ease: Expo.easeOut,
            onComplete() {

              gsap.set(_this.DOM.panes[_this.data.active], { clearProps: 'all' });

              // reindex data
              // _this.data.active = _this.data.next
               _this.is_changing = false;

              //
            }
        });
    }

    change(dir) {

        this.is_changing = true

        this.data.prev = this.data.active
        this.data.active = this.data.next

        // change active tab
        this.DOM.tabs[this.data.prev].classList.remove('--active')
        this.DOM.tabs[this.data.active].classList.add('--active')
        
        // animate previous out
        this.DOM.panes[this.data.prev].classList.remove('--active')
        this.paneOut()
       
        // animate active in
        this.DOM.panes[this.data.active].classList.add('--active')
        this.paneIn()


        // // hide loading
        // this.DOM.nav.prev.forEach(function(el) { el.classList.remove('--loading') })
        // this.DOM.nav.next.forEach(function(el) { el.classList.remove('--loading') }) 
        //

        //
        this.onTabChange()
    }

    grab(e) {
        this.touch.distance = 0;
        this.touch.start = e.touches[0].clientX;
    }

    drag(e) {
        this.touch.end = e.changedTouches[0].clientX;
        this.touch.distance = this.touch.end - this.touch.start

        if(Math.abs(this.touch.distance) > 0) {
            // this.follow(e)
            this.touch.distance < 0 ? this.follow('next') : this.follow('prev')

        }
        // if(Math.abs(this.touch.distance) > this.touch.threshold) { 
            
        //     // change active tab
        //     this.touch.distance < 0 ? this.next() : this.previous()
        //     console.log('change')

        // }
    }

    release(e) {

        if(Math.abs(this.touch.distance) > this.touch.threshold) { 
            
            // change active tab
            this.touch.distance < 0 ? this.next() : this.previous()
            console.log('change')

        
        } else {

            // retreat back
            this.touch.distance < 0 ? this.retreat('next') : this.retreat('prev')
            // this.retreat()
            console.log('retreat')
        }
    }

    follow(dir) {
        // console.log(dir)
        if (!this.is_changing) {

            gsap.to(this.DOM.panes[this.data.active], 0, {
                // x: this.touch.distance, 
                scale: 1 - Math.abs(this.touch.distance)/1000,
                opacity: 1 - Math.abs(this.touch.distance)/200,
                ease: 'none'
            });


            if (dir == 'next') {
                this.to = this.data.active < (this.DOM.panes.length - 1) ? this.data.active + 1 : null 
                gsap.fromTo(this.DOM.panes[this.to], 
                {
                    xPercent: 110,
                    opacity: 1,
                },
                {
                    xPercent: 110 - Math.abs(this.touch.distance)/10,
                    opacity: 1,
                    duration: 0,
                    ease: 'none'
                });

            } else {
                this.to = this.data.active > 0 ? this.data.active - 1 : null
                gsap.fromTo(this.DOM.panes[this.to], 
                {
                    xPercent: -110,
                    opacity: 1,
                },
                {
                    xPercent: -110 + Math.abs(this.touch.distance)/10,
                    opacity: 1,
                    duration: 0, 
                    ease: 'none'
                });
            }
            // console.log(this.touch.distance)
        }
    }

    retreat(dir) {
        var _this = this

        gsap.to(this.DOM.panes[this.data.active], .5, {
            x: 0, 
            scale: 1,
            opacity: 1,
            ease: Expo.easeOut,
            onComplete() {
              gsap.set(_this.DOM.panes[_this.data.active], { clearProps: 'all' });

            }
        });
        if (dir == 'next') {
            gsap.to(this.DOM.panes[this.data.active + 1], .5, {
                xPercent: 110, 
                ease: Expo.easeOut,
                onComplete() {
                     gsap.set(_this.DOM.panes[_this.data.active + 1], { clearProps: 'all' });

                }
            });
        } else {
            gsap.to(this.DOM.panes[this.data.active - 1], .5, {
                xPercent: -110, 
                ease: Expo.easeOut,
                onComplete() {
                    gsap.set(_this.DOM.panes[_this.data.active - 1], { clearProps: 'all' });

                }
            });
        }
    }

    initEvents() {
        var _this = this

        this.DOM.tabs.forEach(function(el) {
            el.addEventListener("click", e => {
                e.preventDefault()
                !_this.is_changing ? _this.setActive(e) : null
            });
        })
        this.DOM.nav.prev.forEach(function(el) {
            el.addEventListener("click", e => {
                e.preventDefault()
                !_this.is_changing ? _this.previous(e) : null
            });
        })
        this.DOM.nav.next.forEach(function(el) {
            el.addEventListener("click", e => {
                e.preventDefault()
                !_this.is_changing ? _this.next(e) : null
            });
        })
        
        this.DOM.container.addEventListener("touchstart", e => {
            // e.preventDefault()
            this.grab(e)
        });
        this.DOM.container.addEventListener("touchmove", e => {
            // e.preventDefault()
            this.drag(e)
        });
        this.DOM.container.addEventListener("touchend", e => {
            this.release(e)
        });


        // var xDown = null;                                                        
        // var yDown = null;

        // function getTouches(e) {
        //   return e.touches ||             // browser API
        //          e.originalEvent.touches; // jQuery
        // }    

        // this.DOM.widget.addEventListener("touchstart", e => {
        //     // e.preventDefault()
        //     const firstTouch = getTouches(e)[0];                                      
        //     xDown = firstTouch.clientX;                                      
        //     yDown = firstTouch.clientY;
        // });

        // this.DOM.widget.addEventListener("touchmove", e => {
        //     // e.preventDefault()
        //     if ( ! xDown || ! yDown ) {
        //         return;
        //     }

        //     var xUp = e.touches[0].clientX;                                    
        //     var yUp = e.touches[0].clientY;

        //     var xDiff = xDown - xUp;
        //     var yDiff = yDown - yUp;

        //     // console.log(xDiff)
                                                                                 
        //     if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
        //         if ( xDiff > 0 ) {
        //             /* right swipe */ 
        //             console.log('right swipe')
        //             !_this.is_changing ? _this.next(e) : null
        //         } else {
        //             /* left swipe */
        //             console.log('left swipe')
        //             !_this.is_changing ? _this.previous(e) : null
        //         }                       
        //     } else {
        //         if ( yDiff > 0 ) {
        //             /* down swipe */ 
        //         } else { 
        //             /* up swipe */
        //         }                                                                 
        //     }
        //     /* reset values */
        //     xDown = null;
        //     yDown = null;
        // });



        this.after()
    
    }

    after() {

        // dispatch tabs event
        var detail = {
            tabs: this,
            context: this.DOM.widget.getAttribute('data-context') ? this.DOM.widget.getAttribute('data-context') : null,
            data: {
                league: this.DOM.widget.getAttribute('data-league') ? this.DOM.widget.getAttribute('data-league') : null,   
            }

        }
        var event = new CustomEvent('tabsReady', { detail: detail });
        window.dispatchEvent(event);

    }

    onTabChange() {

        console.log('Change active index: ' + this.data.next)

    }
  
}

class AsyncTabs extends Tabs {
   
    change() {

        // console.log('Change active tab. Index: ' + this.data.next)

        this.is_changing = true

        // fetch content
        this.async(this.data.next)
            .then((response) => {
                // console.log(response)
                const doc = new DOMParser().parseFromString(response, 'text/html')
                var node = document.createElement("div")
                node.innerHTML = doc.querySelector('body').innerHTML

                // return node
                return node

            })
            .then( node => {

                // append next content
                this.DOM.panes[this.data.next].append(node)

            })
            .then(() => {

                // animate in next pane
                this.DOM.tabs[this.data.active].classList.remove('--active')
                this.DOM.panes[this.data.active].classList.remove('--active')
                this.DOM.panes[this.data.active].classList.add('--inactive')

                this.DOM.panes[this.data.next].classList.remove('--inactive')
                this.DOM.panes[this.data.next].classList.add('--active')
                this.DOM.tabs[this.data.next].classList.add('--active')

            })
            .then(() => {

                // hide loading
                this.DOM.nav.prev.forEach(function(el) { el.classList.remove('--loading') })
                this.DOM.nav.next.forEach(function(el) { el.classList.remove('--loading') }) 
                //
                this.is_changing = false

                // remove previous content after animation complete
                let prev = this.data.active;
                setTimeout(() => {
                    this.DOM.panes[prev].classList.remove('--inactive')
                    this.DOM.panes[prev].innerHTML = ''
                },400)

                // reindex data
                this.data.active = this.data.next

                //
                this.onTabChange()


            })
    }
}


function initAsyncTabs(context) {
    var widget = context.querySelectorAll('[data-async-tabs]')

    widget ? widget.forEach(tabs => {
        tabs.querySelectorAll('[data-tab-widget]').forEach(el => {
            console.log('Init Async Tabs controls ...')
            var modalTabs = new AsyncTabs(el)
        })
    }) : null
   

}

function initTabs(context) {
    var widget = context.querySelectorAll('[data-tabs]')

    widget ? widget.forEach(tabs => {
        tabs.querySelectorAll('[data-tab-widget]').forEach(el => {
            console.log('Init Tabs controls ...')
            var modalTabs = new Tabs(el)
        })
    }) : null
}

