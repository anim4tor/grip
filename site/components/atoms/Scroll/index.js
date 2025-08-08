/*

    SCROLL

*/

class Scroll {
    constructor(container) {
       	this.engine = null;
       	this.container = container;
        this.init();
    }

    init() {
      console.log('Init Smooth scroll ...')
    	this.engine = new LocomotiveScroll({
    	  lenisOptions: {
    	    content: this.container,
    	    orientation: 'vertical',
    	    smoothWheel: true,
    	    lerp: 0.5,
    	    duration: 1,
    	    normalizeWheel: true,
    	  },
    	  scrollCallback: this.onScroll
    	});
    	console.log(this.engine)
    }

  	destroy() {
  		console.log('Destroy Smooth scroll ...')
	  	this.engine.destroy()
	  	this.engine = null;
  		console.log(this.engine)
  	}

  	stop() {
  		console.log('Stop Smooth scroll ...')
  		requestAnimationFrame(() => {
  			this.engine.stop()
  		})
  	}

  	start() {
  		console.log('Start Smooth scroll ...')
  		requestAnimationFrame(() => {
  			this.engine.start()
  		})
  	}

  	resize() {
  		console.log('Update Smooth scroll ...')
  		this.engine.resize()
  	}

    onScroll({ scroll, limit, velocity, direction, progress }) {
  	    // console.log(scroll, limit, velocity, direction, progress);
  			if (direction > 0) {
  				if(scroll > 100) {
  					document.querySelector('[data-header]').setAttribute('hide',true)
  					document.querySelector('[data-header]').setAttribute('collapsed',true)
  				}
  			} else {
  				document.querySelector('[data-header]').removeAttribute('hide')
  				if(scroll < 100) {
  					document.querySelector('[data-header]').removeAttribute('collapsed',true)
  				}

  			}
  	}

  	scrollTo(params) {
  	    const { target, options } = params;
  	    this.engine.scrollTo(target, options);
  	}
}

document.querySelectorAll('[data-scroll-call]').forEach( el => {
    el.setAttribute('data-back',el.getAttribute('theme'))
})
window.addEventListener('theme', (e) => {
    const { target, way, from } = e.detail;
    console.log(`target: ${target}`, `way: ${way}`, `from: ${from}`);
    var theme = target.getAttribute('data-theme');
    var back = target.getAttribute('data-back');
    if (way == "enter") {
       target.setAttribute('theme',theme);
    } else {
       target.setAttribute('theme',back);
    }
});

var SCROLL;
function initScroll() {
	SCROLL = new Scroll(document.querySelector('[data-scroll-container]'));
}