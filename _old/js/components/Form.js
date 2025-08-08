class Form {
    constructor(el) {

        this.DOM = {
            form: el,
            id: el.getAttribute('id')
        };

        this.action = this.DOM.form.getAttribute('action')
        this.method = this.DOM.form.getAttribute('method')
        this.forceClose = this.DOM.form.hasAttribute('data-close') ? true : false

        this.data = {}
        this.returndata = []

        this.initEvents()

        console.log(this)

    }

    async load(url = '', data = {}) {

        // fetch
        let response = await ajax(url, data)

        return response
    }

    submit(event) {

        this.data = new FormData(this.DOM.form);

        // load modal content
        this.load(this.action, this.data)

            .then((response) => {
              console.log(response)
              var response = JSON.parse(response);
              this.returndata = response
              return response.error
            })
            .then((error) => {
              if(!error) {
                MODAL.modal.history.length > 1 && !this.forceClose ? MODAL.back() : MODAL.close()
              } else {

                
              }
            }).then(() => {
              this.after()
            })
          
    }

    
    initEvents() {
        var _this = this

        // form submit
        this.DOM.form.addEventListener("submit", e => {
            // e.preventDefault()
            // _this.submit()
        });

    }

    after() {
        // dispatch form event
        var event = new CustomEvent('formSubmit', { detail: { context: this.DOM.id, valid: !this.returndata.error, data: this.returndata } });
        window.dispatchEvent(event);
    }

}

// // bind modal events
// var MODAL = new Modal()

function initForms() {
  console.log('Init Form controls ...')

   var forms = document.querySelectorAll('form')

   forms ? forms.forEach(el => {
       new Form(el)
   }) : null

}