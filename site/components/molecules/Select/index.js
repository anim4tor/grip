/*

    SELECT

*/
class Select {
    constructor(el, parent = document) {

        this.DOM = {
            widget: el,
            select: el.querySelector('[data-select-scroller]'),
            options: el.querySelectorAll('[data-select-option]'),
        };

        this.widget = el
        this.context = parent
        this.bind = this.widget.getAttribute('data-select')
        this.items = Array.from(this.DOM.options).map(el => ({el}))
        this.current = {}
        this.init()
    }

    init() {
        console.log('Init Select controls ...')
        console.log(this.DOM)
        this.initEvents()
        this.storeBounds()
    }

    storeBounds() {
        this.bounds = this.DOM.select.getBoundingClientRect() // triggers reflow
        // Store the bounds of the container
        // Store the bounds of each item
        this.items.forEach((item, i)=>{
            item.bounds = item.el.getBoundingClientRect() // triggers reflow
            item.offsetY = item.bounds.top - this.bounds.top // store item offset distance from container
        })
        this.height = this.items[0].bounds.height
    }

    detectCurrent() {
        const scrollY = this.DOM.select.scrollTop // Container scroll position
        const goal = this.bounds.height / 2 - this.height // Where we want the current item to be, 0 = top of the container

        // Find item closest to the goal
        let currentItem = this.items.reduce((prev, curr) => {
            return (Math.abs(curr.offsetY - scrollY - goal) < Math.abs(prev.offsetY - scrollY - goal) ? curr : prev); // return the closest to the goal
        });

        // Do stuff with currentItem
        this.current = currentItem
        this.output()
    }

    output() {
        let value = this.current.el.getAttribute('data-value')
        let label = this.current.el.getAttribute('data-label')
        this.updateContext(value, label)
    }

    updateContext(value, label) {
        label ??= value
        console.log('Update context: ', this.context, value, label)
        let outputValue = this.context.querySelector('input[data-select-bind='+this.bind+']')
        let outputLabel = this.context.querySelector('[data-select-output='+this.bind+']')
        outputValue ? outputValue.value = value : null;
        outputLabel ? outputLabel.innerHTML = label : null;
    }

    initEvents() {
        var _this = this
        // Timer, used to detect whether horizontal scrolling is over
        var timer = null;
        // Scrolling event start
        this.DOM.select.addEventListener('scroll', function () {
            console.log('Select scrolled')
            clearTimeout(timer);
            // Renew timer
            timer = setTimeout(function () {
                console.log('Select snap:')
                _this.detectCurrent()
                // No scrolling event triggered. It is considered that
                // scrolling has stopped do what you want to do, such
                // as callback processing
            }, 100);
        });
    }

}
function initSelects(container = document, context = null) {
    context ??= container
    const selects  = container.querySelectorAll('[data-select]');
    selects.forEach(el => {
        new Select(el, context)
    })
    
}
