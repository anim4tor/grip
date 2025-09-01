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
        this.form = this.widget.getAttribute('data-form') ? document.getElementById(this.widget.getAttribute('data-form')).getAttribute('id') : null
        this.items = Array.from(this.DOM.options).map(el => ({el}))
        this.current = {}
        this.output = {
            value: this.context.querySelector('input[data-select-bind='+this.bind+']'),
            label: this.context.querySelector('[data-select-output='+this.bind+']'),
        }
        this.init()
    }

    init() {
        console.log('Init Select controls ...')
        console.log(this)
        this.storeBounds()
        this.preselect()
        setTimeout(() => {
            this.initEvents()
        }, 300)
    }

    preselect() {
        this.current = this.DOM.select.querySelector('[data-value="'+this.output.value.value+'"]') ?? this.DOM.options[0]
        console.log('Preselect:', this.current)
        this.current ? this.DOM.select.scrollTop = this.current.offsetTop - (this.bounds.height / 2) + (this.height / 2) : null
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
        const goal = this.bounds.height / 2 - this.height/1.5 // Where we want the current item to be, 0 = top of the container

        // Find item closest to the goal
        let currentItem = this.items.reduce((prev, curr) => {
            return (Math.abs(curr.offsetY - scrollY - goal) < Math.abs(prev.offsetY - scrollY - goal) ? curr : prev); // return the closest to the goal
        });

        // Do stuff with currentItem
        this.current = currentItem
        this.renderOutput()
    }

    renderOutput() {
        let value = this.current.el.getAttribute('data-value')
        let label = this.current.el.getAttribute('data-label')
        this.updateContext(value, label)
    }

    updateContext(value, label) {
        label ??= value
        console.log('Update context: ', this.context, value, label)
        this.output.value ? this.output.value.value = value : null;
        this.output.label ? this.output.label.innerHTML = label : null;
        this.output.value.dispatchEvent(new Event("input", { bubbles: true }));
        // console.log(FORMS[this.form])
        this.form ? FORMS[this.form].submit() : null
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
