
var imgs = document.images,
    len = imgs ? imgs.length : 0,
    counter = 0;

if ( imgs.length == 0 ) {
  init()
} else {
  [].forEach.call( imgs, function( img ) {
      if(img.complete)
        setTimeout(function() {
          incrementCounter();
        },100)
      else
        img.addEventListener( 'load', incrementCounter, false );
  } );

}

function incrementCounter() {
    counter++;
    percentImg = counter / len * 100
    progress = percentImg/100
    console.log( 'Loaded percentage: ', percentImg.toFixed(0) );
    // document.querySelector('[data-counter]') ? document.querySelector('[data-counter]').innerHTML = percentImg.toFixed(0).padStart(1, '0') + '%'/* + '%'*/ : null
    // document.querySelector('[data-preloader]') ? document.querySelector('[data-preloader]').style.setProperty('--progress', progress ) : null

    if ( counter === len ) {
        init()
    }
}

function init() {
  console.log( 'All images loaded!' );

  setTimeout(function() {
    document.documentElement.setAttribute('data-init',true)
    initScroll()
  }, 100)
  
}

window.addEventListener('load', (event) => {


});

