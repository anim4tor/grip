
// const Locomotion = new LocomotiveScroll({
// 	el: document.querySelector('[data-scroll-container]'),
//     smooth: true,
//     lerp: 0.2,
//     passive: true,
//     // smartphone: {
//     // 	smooth: true,
//     // },
//     // tablet: {
//     // 	smooth: true,
//     // }
//     // repeat: true
//     // multiplier: 1,
//     getDirection: true,
//     resetNativeScroll: false
// });


// var colors = {'dark':'#031f1c','light':'#e8e2e0','medium':'#d9e1cc','text':'#38524f'}

// Locomotion.on('call', (args) => {
// 	// console.log(args)
// 	if (args == 'dynamicBackgroundDark') {
// 		document.body.style.setProperty('--background', colors.dark);
// 		document.body.style.setProperty('--col', colors.medium);
// 	}
// 	if (args == 'dynamicBackgroundLight') {
// 		document.body.style.setProperty('--background', colors.light);
// 		document.body.style.setProperty('--col', colors.text);
// 	}
// })


var Locomotion;
var bgChange;

function initLocomotion(context, direction = 'vertical') {
	console.log('Init Locomotive scroll ...')

	var container = document.querySelector('[data-scroll-container]')
	var header = document.querySelector('[data-header]')

	// reset scroll position
	// container.scrollY = 0;

	// destroy previous instance
	if(Locomotion != undefined) { Locomotion.destroy() }

	// create new Locomotive scroll instance
	Locomotion = new LocomotiveScroll({
		el: container,
	    // smooth: true,
	    lerp: 0.1,
	    passive: true,
	    direction: direction
	    // smartphone: {
	    // 	smooth: true,
	    // },
	    // tablet: {
	    // 	smooth: true,
	    // }
	    // repeat: true
	    // multiplier: 1,
	    // getDirection: true,
	    // getSpeed: true,
	});
	setTimeout(function() {
		Locomotion.update()
	},100) 

	Locomotion.on('scroll', (args) => {
		locomotionY = args.scroll.y
		// console.log(Locomotion)
		for(el in args.currentElements) {
			args.currentElements[el].el.style.setProperty('--scroll-progress', args.currentElements[el].progress);
		}

	})
	bgChange = false;
	red = '218, 32, 62';
	black = '0,0,0';
	Locomotion.on('call', (args) => {
		console.log(args)
		if (args == 'dynamicBackground') {
			bgChange = !bgChange
			if (bgChange) {
				// header.style.setProperty('--background', darkgreen);
				header.classList.add('--aside-open');
			} else {
				// header.style.setProperty('--background', 'transparent');
				header.classList.remove('--aside-open');
			}
		}
		
	})

	document.querySelectorAll('[data-scroll-to]').forEach(function(el) {
		el.addEventListener("click", function(e) { 
			e.preventDefault()
			console.log('Internal link', e.target.closest('a').getAttribute('href'))
			Locomotion.scrollTo(e.target.closest('a').getAttribute('href'),{ duration: 100 })
			return false;
		});
	})


}


function initInnerScroll() {
 	// inner data-scroll-container
	document.querySelectorAll("[data-inner-scroll]").forEach(function(el) {
	    el.onmouseover = function(event) { Locomotion.stop(); };
	    el.onmouseout = function(event) { Locomotion.start(); };
	});
}


