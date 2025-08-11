/*

    MODAL

*/
class Dialog extends Modal {
    init() {

        this.DOM = {
            widget: document.querySelector('[dialog-widget]'),
            load: document.querySelector('[dialog-load]'),
            next: document.querySelector('[dialog-next]'),
            loaderer: {}
        };
        
    }
    initEvents() {
        var _this = this
        this.DOM.close = document.querySelectorAll('[dialog-close]')
        this.DOM.close.forEach(function(el) {
           el.addEventListener("click", e => {
               // console.log(e.target)
               e.preventDefault()
               _this.close()
               // initScroll()
           });
        })
        this.DOM.widget.querySelectorAll('[dialog-open]').forEach(function(el) {
           el.addEventListener("click", e => {
               // console.log(e.target)
               e.preventDefault()
               _this.fetch(e)
               // initScroll()
           });
        })
    }
}
// bind modal events
var DIALOG = new Dialog()

function initDialogs(container = document) {
    console.log('Init Dialog controls ...')
    const dialogOpen  = container.querySelectorAll('[dialog-open]');
    dialogOpen.forEach(function(el) {
        el.addEventListener("click", (e) => {
          e.preventDefault()
          DIALOG.fetch(e)
        })
    })
}
