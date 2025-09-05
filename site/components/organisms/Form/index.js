class Form {
    constructor(el) {

        this.DOM = {
            form: el,
            id: el.getAttribute('id')
        };

        this.action = this.DOM.form.getAttribute('action')
        this.method = this.DOM.form.getAttribute('method')
        this.forceClose = this.DOM.form.hasAttribute('data-close') ? true : false

        this.data = null
        this.form = this.action.split('/')[1]
        this.returndata = []

        this.initEvents()

        console.log(this)

    }

    async load(url = '', data = {}) {

        // fetch
        let response = await ajax(url, data)

        return response
    }

    submit() {

        this.data = new FormData(this.DOM.form);
        this.data.append("form", this.form);

        // load modal content
        this.load('form.json', this.data)

            .then((response) => {
              var response = JSON.parse(response);
              console.log(response)
              this.returndata = response
              return response.error
            // })
            // .then((error) => {
            //   if(!error) {
            //     MODAL.modal.history.length > 1 && !this.forceClose ? MODAL.back() : MODAL.close()
            //   } else {

            //   }
            }).then(() => {
              this.after()
            })
          
    }

    
    initEvents() {
        var _this = this

        // form submit
        this.DOM.form.addEventListener("submit", e => {
            e.preventDefault()
            _this.submit()
        });
        this.DOM.form.querySelectorAll('input[submit]').forEach(el => {
            el.addEventListener("input", e => {
                console.log('Input submit')
                _this.submit()
            });
        });

        this.DOM.form.querySelectorAll('input[data-update]').forEach(el => {
            el.addEventListener("input", e => {
                var bind = el.getAttribute('data-update'),
                    value = el.value
                console.log('Bind input update: ', bind, value)
                document.querySelectorAll('[data-bind='+bind+']').forEach(el => {
                    el.innerHTML = value;
                    el.value = value;
                })
            });
        });

    }

    after() {
        // dispatch form event
        var event = new CustomEvent('formSubmit', { detail: { context: this.DOM.id, valid: !this.returndata.error, data: this.returndata } });
        window.dispatchEvent(event);

        // reload page
        this.DOM.form.hasAttribute('page-reload') ? window.location.reload() : null

        // reload modal
        this.DOM.form.hasAttribute('modal-close') ? MODAL.close() : null

        // reload modal
        this.DOM.form.getAttribute('modal-reload') ? MODAL.force(this.DOM.form.getAttribute('modal-reload')) : null

        // reload modal
        this.DOM.form.getAttribute('modal-close-reload') ? MODAL.force(this.DOM.form.getAttribute('modal-close-reload'), false, true) : null

        // reload back
        this.DOM.form.getAttribute('modal-back') ? MODAL.fetch(this.DOM.form.getAttribute('modal-back'), 'prev') : null

        // reload page
        this.DOM.form.getAttribute('reload') ? window.location.reload() : null

        // close dropdowns
        DROPDOWN.close()

    }

}

// // bind modal events
var FORMS = {}

function initForms(container = document) {
   console.log('Init Form controls ...')

   var forms = document.querySelectorAll('form')

   forms ? forms.forEach(el => {
       el.getAttribute('id') ? FORMS[el.getAttribute('id')] = new Form(el) : new Form(el)
   }) : null

}
