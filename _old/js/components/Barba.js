
// Default duration
var duration = 0.5


// Index to page transitions

// Function to index transition out
function indexTransitionOut(container) {
  var page = container
  
  return gsap.to(page, duration, { 
      opacity: 0,
      scale: 1.1,
      y: window.innerHeight,
      ease: Expo.easeInOut 
    }) 
   
}

// Function to index transition in
function indexTransitionIn(container) {
  var page = container
  
  gsap.fromTo(page, duration, { 
    opacity: 0, 
    scale: 1.1,
    y: window.innerHeight,
  },{
    opacity: 1, 
    scale: 1,
    y: 0,
    ease: Expo.easeInOut 
  }) 
}


// Page to page transitions

// Function to page transition 
function pageTransitionOut(container) {
  
  var page = container.querySelector('.page__content')
  var page_card = page.querySelector('.page__card')
  var page_inner = page.querySelectorAll('.page__section')
  var page_fake = page.querySelector('.page__fake')

  // document.scrollY = 0;
  // Locomotion.scrollTo(0, 0, null, 800)

  return gsap.timeline()
      .to(page, duration, { 
        // opacity: 0,
        scale: 0.9,
        y: -30,
        ease: Power3.easeInOut 
      },0)
      .to(page_card, duration, { 
        opacity: 0,
        background: '#dfdfdf',
        ease: Power3.easeInOut 
      },0)
      .to( page_inner, duration, { 
        opacity: 0,
        ease: Power3.easeInOut 
      },0)
      .to( page_fake, duration, { 
        opacity: 0,
        ease: Power3.easeInOut 
      },0)
    
}

// Function to page transition 
function pageTransitionIn(container) {

  var page = container.querySelector('.page__content')
  var page_card = page.querySelector('.page__card')
  var page_inner = page.querySelectorAll('.page__section')
  var page_fake = page.querySelector('.page__fake')
  
  gsap.timeline()
      .fromTo(page_card, duration, {  
        scale: 1.4,
        y: window.innerHeight,
      },{
        opacity: 1, 
        scale: 1,
        y: 0,
        ease: Expo.easeInOut 
      },0)
      .fromTo( page_fake, duration, { 
        opacity: 0,
        y: 30,
        scale: 1,
        ease: Power3.easeInOut 
      },{
        opacity: 1, 
        y: 0,
        scale: 0.9,
        ease: Expo.easeInOut 
      },0)
}

window.addEventListener('load', (event) => {

  barba.init({
    debug: true,
    preventRunning: true,
    cacheIgnore: true,
    prefetchIgnore: true,
    timeout: 10000000,
    prevent: ({ el }) => (el.hasAttribute('data-modal-open')),
    views: [{
      namespace: 'index',
      beforeEnter(data) {
        var page = data.next.container.getAttribute('data-page')
        document.querySelectorAll('[data-nav]').forEach(el => { el.classList.remove('--active') })
        document.querySelector('[data-nav="'+page+'"]').classList.add('--active')
      },
      afterEnter(data) {
        initEvents()
        initFeed()
        initInnerScroll()
        initAsyncTabs(data.next.container)
        initTabs(data.next.container)
        initLocomotion(data.next.container)
      }
      
    },
    {
      namespace: 'page',
      beforeEnter(data) {
        var page = data.next.container.getAttribute('data-page')
        document.querySelectorAll('[data-nav]').forEach(el => { el.classList.remove('--active') })
        document.querySelector('[data-nav="'+page+'"]').classList.add('--active')
      },
      afterEnter(data) {
        // initWidgets()
        initEvents()
        initFeed()
        initInnerScroll()
        initAsyncTabs(data.next.container)
        initTabs(data.next.container)
        initLocomotion(data.next.container)
      }
      
    }],

    // We don't want "synced transition"
    // because both content are not visible at the same time
    // and we don't need next content is available to start the page transition
    // sync: true,

    transitions: [{
      name: 'index-to-page',
      sync: true,
      from: { 
        custom: ({trigger}) => {

            return trigger.getAttribute('data-modal-open') == null ? true : false
        },
        namespace: [ 'index' ]
      },
      to: { namespace: [ 'page' ]},
      leave(data) {
        return indexTransitionOut(data.current.container)
      },
      enter(data) {
        // data.next.container.style.opacity = 0;
        indexTransitionIn(data.next.container)
      },
    },
    {
      name: 'page-to-index',
      sync: true,
      from: { namespace: [ 'page' ]},
      to: { namespace: [ 'index' ]},
      leave(data) {
        return indexTransitionOut(data.current.container)
      },
      enter(data) {
        // data.next.container.style.opacity = 0;
        indexTransitionIn(data.next.container)
      },
    },
    {
      name: 'page-to-page',
      sync: true,
      from: { namespace: [ 'page' ]},
      to: { namespace: [ 'page' ]},
      leave(data) {
        return pageTransitionOut(data.current.container)
      },
      enter(data) {
        // data.next.container.style.opacity = 0;
        pageTransitionIn(data.next.container)
      },
    }]

  });

});