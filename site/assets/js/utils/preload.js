// Preload images
function preloadImages() {
    return new Promise((resolve, reject) => {
        
        var imgLoad = imagesLoaded(document.querySelectorAll('img'), { background: true }, function(){
    	    console.log('Images loaded ...')
          // document.querySelector('[data-cursor-counter]').classList.remove('--show')
          resolve()
        });
        var totalImg = document.querySelectorAll('img').length
        var loadedImg = 0
        var percentImg = 0
        console.log('Total images', totalImg)

        // var loading = setInterval(function() {
        //     percentImg++
        //     console.log( 'Loaded percentage: ', percentImg.toFixed(0) );
        //     document.querySelector('[data-cursor-counter]').innerHTML = percentImg.toFixed(0).padStart(3, '0')/* + '%'*/
        // },100)

        imgLoad.on( 'progress', function( instance, image ) {
          // var result = image.isLoaded ? 'loaded' : 'broken';
          loadedImg++
          percentImg = loadedImg / totalImg * 100
          progress = percentImg/100 * 360 
          // console.log( 'Loaded percentage: ', percentImg.toFixed(0) );
          // document.querySelector('[data-cursor-counter]').innerHTML = percentImg.toFixed(0).padStart(3, '0')/* + '%'*/
          // document.querySelector('[data-cursor]').style.setProperty('--progress', progress + 'deg')
        });

        // imgLoad.on( 'always', function( instance, image ) {
        //   clearInterval(loading);
        // });


        // setTimeout(function() {
        //   document.querySelector('[data-cursor-counter]').classList.add('--show')
        // },2000)

    });
};

/*
export function preload() {
  const paths = [...document.querySelectorAll('.item__img')].map(image => image.src);
  return Promise.all(paths.map(checkImage));
}

export const checkImage = path => new Promise(resolve => {
  const img = new Image();
  img.onload = () => resolve({ path, status: 'ok' });
  img.onerror = () => resolve({ path, status: 'error' });
  img.src = path;
});
*/