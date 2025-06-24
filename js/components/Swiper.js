var root = document.documentElement;

var swiper_options = {
    
    'menu' : {
      init: true,
      slidesPerView: 'auto',
      speed: 200,
      initialSlide: 0,
      // centeredSlides: true,
      centeredSlides: true,
      centeredSlidesBounds: true,

      slideActiveClass: 'active',
      slideNextClass: 'is-next',
      slidePrevClass: 'is-prev',
      draggable: false,
      // freeMode: true,

      // mousewheel: {
        
      //   releaseOnEdges: true,
      // },
      keyboard: {
          enabled: true,
          onlyInViewport: false,
        },

      navigation: {
        nextEl: '.menu__swiper__nav__next',
        prevEl: '.menu__swiper__nav__prev',
      },

      on: {
        activeIndexChange: function () {
          // document.querySelector('[data-menu-progress]').style.setProperty('--progress', this.progress)
          
        },
        progress: function() {
          document.querySelector('[data-menu-progress]').style.setProperty('--progress', this.progress)

        }
      },
    },

    'admin' : {
      init: true,
      slidesPerView: 'auto',
      speed: 200,
      initialSlide: 0,

      slideActiveClass: 'is-active',
      slideNextClass: 'is-next',
      slidePrevClass: 'is-prev',
      draggable: false,

      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },

      on: {
        activeIndexChange: function () {
          
        },
      },
    },
    
  }


function initSwiper() {
  console.log('Initialize swipers ...')
  $('[data-swiper]').each(function (index) {
    var options = $(this).attr('data-swiper')
    console.log(options)
    // console.log(options)
    var swiper = new Swiper($(this)[0],swiper_options[options]);
    // init Swiper
    swiper.init();
        // console.log('swiper '+options)
  });

} 

