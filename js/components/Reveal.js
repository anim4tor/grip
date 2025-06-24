
function initReveal() {
	console.log('Initialize reveal observer ...')
	var config = {
	  threshold: [0,1]
	};

	const revealItems = Array.prototype.slice.call(document.querySelectorAll('[data-reveal]'));

	const revealObserver = new IntersectionObserver((entries, observer) => {
	  entries.forEach(function(entry) {
	  	_item = entry.target
		let animImg = _item.querySelectorAll('[data-img-reveal]')
		let animLines = _item.querySelectorAll('[data-anim-lines]')
		let animLetters = _item.querySelectorAll('[data-anim-letters] > span')
		let animH = _item.querySelectorAll('[data-scale-h]')

		let headerItems = _item.querySelectorAll('[data-header-item]')

	    if (entry.isIntersecting) {
	      // console.log('in the view');
	      _item.classList.add('is-inview')
	       // gsap.kill()
	       gsap
		    .timeline()
		    .set(animImg, { scaleY: 1 })
		    .set(animLines, { translateY: '100%' })
		    .set(animLetters, { translateY: '100%' })
		    .set(animH, { scaleX: 0 })
		    .to(animImg, { duration: 1.5, scaleY: 0, transformOrigin: 'top left', ease: Expo.easeOut }, 0.2)
		    .to(animLines, { duration: 1.5, translateY: '0%', stagger: { amount: 0.4 }, ease: Expo.easeOut }, 0.2)
		    .to(animLetters, { duration: 1.5, translateY: '0%', stagger: { amount: 0.4 }, ease: Expo.easeOut }, 0.2)
    		.to(animH, { duration: 1.5, scaleX: 1, ease: Expo.easeInOut }, 0.2)


	      // console.log($(this).attr('data-delay'))
		    observer.unobserve(_item );
	    } else {
	    	_item.classList.remove('is-inview')
	    }

	  });
	}, config);
	
	revealItems.forEach(function(item) {
	  revealObserver.observe(item);
	});

}

function destroyReveal() {
	console.log('destroyReveal')
	observer.disconnect()
}

