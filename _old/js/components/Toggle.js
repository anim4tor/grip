
/*

    TOGGLE

*/

function initToggles() {
    console.log('Init Toggle controls ...')
    document.querySelectorAll('[data-toggle]').forEach(el => {
        el.addEventListener('click',function(e) {
            e.preventDefault()
            el.classList.toggle('--active')
            el.nextElementSibling.classList.toggle('--active')
        })
      
    })
}


