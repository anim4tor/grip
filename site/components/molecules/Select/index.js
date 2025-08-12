/*

    SELECT

*/
class Select {
    constructor() {

        this.DOM = {
            widget: document.querySelector('[dialog-widget]'),
            load: document.querySelector('[dialog-load]'),
            loaderer: {}
        };

        
        this.is_open = false
        this.url = null
        this.openClass = 'has-dialog'
        this.init()
    }

    init() {
        this.initEvents()
    }

    
}
function initSelects(container = document) {
    console.log('Init Select controls ...')
    const dialogOpen  = container.querySelectorAll('[data-select]');
    dialogOpen.forEach(function(el) {
        el.addEventListener("click", (e) => {
          e.preventDefault()
          DIALOG.fetch(e)
        })
    })
}
