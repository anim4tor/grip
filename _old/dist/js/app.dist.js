var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
    isMobile = true;
}



window.addEventListener('load', (event) => {

	document.documentElement.classList.add('is-ready');

	// initLocomotion(document)
	
	// initWidgets()
	
	initModals()
	
	initSelects()

	// initEvents()

	// initFeed()

	// initInnerScroll()

	initForms()

	initTabs(document)
	
});

window.addEventListener('selectReady', (event) => {

	console.log(' ... select ready')
	console.log(event.detail)

	// initInnerScroll()

	switch (event.detail.context) {
		

		default:
			break;
	}

})

window.addEventListener('selectSelected', (event) => {

	console.log(' ... select selected')
	console.log(event.detail)

	var data = event.detail.data


	switch (event.detail.context) {
		case 'type': case 'weight': case 'reps': case 'rir': case 'goal':

			// collect data
			var action = 'template/forms/form_update_set.php';
			var send = {
		        action: action,
		        column: event.detail.context,
		        set: event.detail.select.widget.el.closest('[data-set]').getAttribute('data-set'),
		        value: event.detail.select.widget.output.value,
		    }
			
			// preprocess data
		    var sendData = new FormData()
		    sendData.append('data',JSON.stringify(send))

			// update set
		    ajax(action, sendData)
		    	.then((response) => {
		          console.log(response)
		        })

		    break;

		case 'mods':

			// collect data
			var action = 'template/forms/form_update_lift.php';
			var send = {
		        action: action,
		        column: event.detail.context,
		        lift: event.detail.select.widget.el.closest('[data-lift]').getAttribute('data-lift'),
		        value: event.detail.select.widget.output.value,
		    }
			
			// preprocess data
		    var sendData = new FormData()
		    sendData.append('data',JSON.stringify(send))

			// update set
		    ajax(action, sendData)
		    	.then((response) => {
		          console.log(response)
		        })

		    break;

		case 'exercise':

			// collect data
			var action = 'template/forms/form_update_lift.php';
			var send = {
		        action: action,
		        column: event.detail.context,
		        lift: event.detail.select.widget.el.closest('[data-lift]').getAttribute('data-lift'),
		        value: event.detail.select.widget.output.value,
		    }
			
			// preprocess data
		    var sendData = new FormData()
		    sendData.append('data',JSON.stringify(send))

			// update set
		    ajax(action, sendData)
		    	.then((response) => {
		          console.log(response)
            	  location.reload()
		        })



		    break;

		// case 'reps': 
		// 	var rirWidget = document.querySelector('[data-set="'+data.post+'"]').querySelector('[data-select-open="rir"]')
	    //     console.log(rirWidget)


	    //     if (rirWidget !== null) {

	    //     	var el = rirWidget

	    //         // get preselect
	    //         var selected = el.querySelector('[data-select-output]') ? el.querySelector('[data-select-output]').getAttribute('value') : null 

	    //         // get post data
	    //         var post = typeof post !== 'undefined' ? post : el.getAttribute('data-select-post');

	    //         // get url
	    //         var url = typeof url !== 'undefined' ? url : el.getAttribute('data-select-open');

	    //         // test data if json or string
	    //         var dataArr = []
	    //         if (isJSON(selected)) {
	    //             dataArr = JSON.parse(selected)
	    //         } else {
	    //             dataArr[0] = selected
	    //         }  
	    //         console.log(dataArr)
	    //         SELECT.add(el.closest('[data-select-widget]'), url, dataArr, post)   
	    //     }

			break;

		default:
			break;
	}

})

window.addEventListener('modalReady', (event) => {

	console.log(' ... modal ready')
	console.log(event.detail)

	// initInnerScroll()

	switch (event.detail.context) {
		case 'select':
    		var indexed = []

			var select = MODAL.DOM.container.querySelector('[data-select-widget]')
			select.querySelectorAll('[data-select-option]').forEach(el => {
            	// console.log('Init Async Tabs controls ...')
	            // TABS.push(new AsyncTabs(el))
            	// console.log(TABS)
            	el.addEventListener('click', function () {
    				this.classList.toggle('selected')
    				var index = this.getAttribute('data-select-option')
    				indexed.indexOf(index) === -1 ? indexed.push(index) : indexed.splice(indexed.indexOf(index),1);
    				console.log(index)
    				indexed.length === 0 ? select.classList.remove('is-selected') : select.classList.add('is-selected')
    				// output.querySelector('[data-select-option='+index+']').classList.toggle('selected')
	    		});

	        })
			// initAsyncTabs(MODAL.DOM.container)
			break;

		case 'table':
			// $has_tabs = ['mkl','vcs','vcp'];
			MODAL.DOM.container.querySelectorAll('[data-tab-widget]').forEach(el => {
            	console.log('Init Tabs controls ...')
	            TABS.push(new Tabs(el))
            	console.log(TABS)

	        })
			// initTabs(MODAL.DOM.container)
			// if ($has_tabs.includes(event.detail.data.league)) {
			// }
			break;

		case 'game':
		    initToggles()
		    break;

		case 'player':
			var chart = document.getElementsByClassName("distrib__chart")[0]
			console.log(chart.getAttribute('data-mean'))
			console.log(chart.getAttribute('data-stdD'))
		    GaussianSVG({
		      mean: parseFloat(chart.getAttribute('data-mean')),
		      // stdD: parseFloat(chart.getAttribute('data-stdD')),
		      parentElement: chart
		    });
		    initToggles()
			MODAL.DOM.container.querySelectorAll('[data-tab-widget]').forEach(el => {
            	console.log('Init Tabs controls ...')
	            TABS.push(new Tabs(el))
            	console.log(TABS)

	        })
		    break;

		case 'admin':
		    initForms()
		    break;

		case 'edit':
		    initForms()
		    break;

		case 'add':
			initForms()
			break;

		case 'delete':
		    initForms()
		    break;

		default:
			break;
	}

})

window.addEventListener('tabsReady', (event) => {

	console.log(' ... tabs ready')

	switch (event.detail.context) {
		case 'week':
			
			event.detail.tabs.async = async function(day) {

			    // preprocess data
			    var data = {
			        d: day
			    }
			    var url = 'template/ajax/load_week.php'
			    var sendData = new FormData()
			    sendData.append('data',JSON.stringify(data))

			    // fetch
			    let response = await ajax(url, sendData)

			    return response
			}

			event.detail.tabs.onTabChange = function() {

				// this.DOM.widget.querySelector('[data-round]').innerHTML = this.data.next + 1

			}

			break;

		case 'draw':
			
			event.detail.tabs.async = async function(next) {

			    // preprocess data
			    var data = {
			        id: next + 1,
			        league: event.detail.data.league
			    }
			    var url = 'template/ajax/load_draw.php'
			    var sendData = new FormData()
			    sendData.append('data',JSON.stringify(data))

			    // fetch
			    let response = await ajax(url, sendData)

			    return response
			}

			event.detail.tabs.onTabChange = function() {

				this.DOM.widget.querySelector('[data-round]').innerHTML = this.data.next + 1

			}

			break;

		default:
			break;
	}
	

})

window.addEventListener('formSubmit', (event) => {

	console.log(' ... form submitted')
	console.log(event)

	switch (event.detail.context) {
		case 'admin_login':
			event.detail.valid ? document.documentElement.classList.add('--admin') : null
			document.querySelector('[data-admin-name]').innerHTML = event.detail.data.login
			break;

		case 'admin_logout':
			event.detail.valid ? document.documentElement.classList.remove('--admin') : null
			break;

		case 'game_add':
		case 'game_update':
			// reload round
			reloadTabs()
			break;

		case 'game_delete':
			// reload round
			reloadTabs()
			MODAL.close()
			break;

		default:
			break;
	}
	

})

window.addEventListener('widget', (event) => {

	// console.log(event)
	console.log(' ... widget ready')

	// init agenda
	document.querySelectorAll('[data-agenda]').forEach(a => {
		new Agenda(a)
	})

})

function padTo2Digits(num) {
  return num.toString().padStart(2, '0');
}

function formatDate(date) {
  return [
    date.getFullYear(),
    padTo2Digits(date.getMonth()),
    padTo2Digits(date.getDate()),
  ].join('-');
}
/*

  VANILLA AJAX
  
*/

async function ajax(url = '', data = {}) {
  // Default options are marked with *
  const response = await fetch(url, {
    method: 'POST', // *GET, POST, PUT, DELETE, etc.
    // mode: 'cors', // no-cors, *cors, same-origin
    // cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
    // credentials: 'same-origin', // include, *same-origin, omit
    // headers: {
    //   'Content-Type': 'application/json'
    // //   // 'Content-Type': 'application/x-www-form-urlencoded',
    // },
    // redirect: 'follow', // manual, *follow, error
    // referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
    body: data // body data type must match "Content-Type" header
  });

  return response.text(); // parses JSON response into native JavaScript objects
}


/*

    MODAL

*/

const modalToken = {
    mkl: 'mkl',
    vysledky: 'round',
    select: 'select',
    zapas: 'game',
    tabulky: 'table',
    tabulka: 'table',
    soutez: 'league',
    souteze: 'league',
    vcp: 'vcp',
    vcs: 'vcs'
}

class Modal {
    constructor() {

        this.DOM = {
            widget: document.querySelector('[data-modal-widget]'),
            container: document.querySelector('[data-modal-container]'),
            inner: document.querySelector('[data-modal-scroll]'),
            loader: {}
        };

        this.modal = {
            template: null,
            loader: {},
            card: {},
            data: {},
            draggable: false,
        }
        
        is_open: false
    }

    async load(url = '', data = {}) {
        // read our JSON
        // console.log(url, data)
        console.log('Fetching modal ...')

        
        // preprocess data
        var sendData = new FormData()
        sendData.append('data',JSON.stringify(data))

        // fetch
        let response = await ajax(url, sendData)

        return response
    }

    parseURL(url) {

        var urlArray = url.split('/')

        this.modal.url = {
            league : modalToken[urlArray.shift()],
            template: modalToken[urlArray.shift()],
            id: urlArray.shift()
        }

        return this.modal.url
    }

    add(event, url, data) {

        this.modal.data = this.parseURL(url)
        this.modal.template = event.target.closest('[data-modal-open]').getAttribute('data-modal-open') ? event.target.closest('[data-modal-open]').getAttribute('data-modal-open') : null

        // show loader
        this.modal.loader = event.target.closest('[data-loader-control]')
        // this.modal.loader.classList.add('--loading')
        

        // load modal content
        this.load('template/ajax/modal_' + this.modal.template + '.php', this.modal.data)

            // .then(response => response.text())
            .then((text) => {
                // console.log(text)
                const doc = new DOMParser().parseFromString(text, 'text/html')
                var el = document.createElement("div")
                el.innerHTML = doc.querySelector('body').innerHTML
                const node = el.firstChild
                return node
            })
            .then((node) => {

                // if card open
                this.closeNext()

                // replace modal
                this.modal.card = node
                this.append(this.modal.card)

            })
            .then(() => {
                this.initEvents()

                if(this.is_open) {
                    this.openNext()
                } else {
                    this.open(this.modal.card)
                }
            })
    }

    append(el) {
        el.setAttribute('data-modal', null);
        this.DOM.container.append(el);
        this.DOM.close = el.querySelectorAll('[data-modal-close]')

        // var scalable = document.querySelector('[data-scalable-viewport]')
        // var scrollCenter = {
        //     x: window.innerWidth/2,
        //     y: Locomotion.scroll.instance.delta.y + window.innerHeight/2
        // }
        // scalable.style.setProperty('--originX', scrollCenter.x);
        // scalable.style.setProperty('--originY', scrollCenter.y);

    }

    open(card) {

        // hide loading
        // this.modal.loader.classList.remove('--loading')
        this.modal.card.classList.add('--active')

        // Locomotion.stop();
        document.documentElement.classList.add('no-scroll');
        document.documentElement.classList.add('has-modal');
        // gsap
        // .from(target, 0.8, {
        //     xPercent: 110, 
        //     ease: Expo.easeOut,
        //     onComplete: function() {

        //         // initTabs()
                
        //         // hide loading
        //     }
        // })

        this.is_open = true

    }

    close() {

        document.documentElement.classList.remove('has-modal');
        var target = this.modal.card
        gsap
        .to(target, 0.8, {
            // xPercent: 0, 
            // ease: Expo.easeOut,
            onComplete: function() {
                target.remove()
                Locomotion.start();
                document.documentElement.classList.remove('no-scroll');
            }
        })
        this.is_open = false

    }

    closeNext() {

        if(this.is_open) {

            // toggle animations
            this.modal.card.classList.add('--next-out')
            this.modal.card.classList.remove('--active')

            // fake delayed call
            var target = this.modal.card
            gsap
            .to(target, 0.8, {
                // xPercent: 0, 
                // ease: Expo.easeOut,
                onComplete: function() {
                    target.remove()
                }
            })
        }

    }

    openNext() {

        this.DOM.inner.scrollTop = 0
        this.modal.card.classList.add('--next-in','--active')

    }

    initEvents() {
        var _this = this

        this.DOM.close.forEach(function(el) {
            el.addEventListener("click", e => {
                // console.log(e.target)
                e.preventDefault()
                _this.close()
            });
        })

        // click outside modal content
        this.DOM.widget.addEventListener("click", e => {
            // console.log(e.target.closest('[data-modal]'))
            e.target.closest('[data-modal]') === null ? _this.close() : null
        });

        this.after()
    }


    after() {

        // dispatch modal event
        var event = new CustomEvent('modalReady', { detail: { modal: this, context: this.modal.template, data: this.modal.data } });
        window.dispatchEvent(event);

    }

}

// bind modal events
var MODAL = new Modal()

function initModals() {
    console.log('Init Modal controls ...')

    document.addEventListener('click', e => {
        e.stopPropagation()
        var el = e.target.closest('[data-modal-open]')
        // console.log(el)
        if (el !== null) {
            e.preventDefault();
            var data = el.getAttribute('data-modal-post'),
                url = typeof url !== 'undefined' ? url : el.getAttribute('href');
            MODAL.add(e, url, JSON.parse(data))  
        }
    })
}


/*

    SELECT

*/

class Select {
    constructor() {


        // modal
        this.DOM = {
            modal: document.querySelector('[data-modal-widget]'),
            container: document.querySelector('[data-modal-container]'),
            inner: document.querySelector('[data-modal-scroll]'),
            card: {},
            close: {},
            loader: {}
        };

        // select widget
        this.widget = {
            el: {},
            output: {},
            value: '',
            model: ''
        }

        // custom select
        this.select = {
            el: {},
            data: {},
            options: {},
            model: '',
        }


        // collection vars
        this.options = []
        this.selected = []

        this.multiple = false
        this.redirect = false
        this.dialog = false
        is_open: false
    }

    async load(url = '', data = {}) {
        // read our JSON
        console.log('Fetching select ...')
        console.log(url, data)

        
        // preprocess data
        var sendData = new FormData()
        sendData.append('data',JSON.stringify(data))

        // fetch
        let response = await ajax(url, sendData)

        return response
    }

    parseData(data) {

        // var urlArray = url.split('/')

        var data = {
            template: this.select.url,
            selected: data,
            output: {}
        }

        // console.log(data)
        return data
    }

    add(el, url, preselect, post) {

        // move this into own method
        //

        // get select widget
        this.widget.el = el
        this.widget.open = this.widget.el.querySelector('[data-select-open]')

        // get mods
        this.multiple = this.widget.el.hasAttribute('data-select-multiple')
        this.redirect = this.widget.el.hasAttribute('data-redirect')
        this.dialog = this.widget.el.hasAttribute('data-dialog')

        // get output
        this.widget.output = this.widget.el.querySelector('[data-select-output]')
        this.widget.outputHtml = this.widget.el.querySelector('[data-select-output-html]')
        this.widget.value = this.widget.output.getAttribute('value')
        // this.select.collector = this.widget.el.querySelector('[data-select-collector]')

        // preselect
        this.selected = this.multiple ? JSON.parse(this.widget.value) : this.widget.value

        //
        //


        this.select.url = url
        this.select.data = {
            template: this.select.url,
            selected: preselect,
            post: post
        }
        this.template = this.widget.open.getAttribute('data-select-open') ? this.widget.open.getAttribute('data-select-open') : null

        // show loader
        // this.select.loader = event.target.closest('[data-loader-control]')
        // this.select.loader.classList.add('--loading')
        
        // load select content
        this.load('template/ajax/select_' + this.select.url + '.php', this.select.data)

            // .then((response) => response.text())
            .then((text) => {
                // console.log(text)
                const doc = new DOMParser().parseFromString(text, 'text/html')
                var el = document.createElement("div")
                el.innerHTML = doc.querySelector('body').innerHTML
                const node = el.firstChild
                return node
            })
            .then((node) => {

                // if card open
                this.closeNext()

                // replace select
                this.DOM.card = node
                this.append(this.DOM.card)

            })
            .then(() => {
                this.initEvents()

                if(this.is_open) {
                    this.openNext()
                } else {
                    this.open(this.DOM.card)
                }
            })
    }

    append(el) {

        // get custom select
        el.setAttribute('data-select', null);
        this.DOM.container.append(el);
        this.DOM.close = el.querySelectorAll('[data-modal-close]')

        this.select.el = el


        this.select.options = this.select.el.querySelectorAll('[data-select-option]')

        // populate options arrays
        this.options = []
        this.select.options.forEach(el => {
            this.options.push(el.getAttribute('data-select-option'))
        })
        console.log(this.options)

        // scroll to selected
        var index = this.options.indexOf(this.selected)
        var oh = this.select.options[0].getBoundingClientRect().height
        var wh = el.getBoundingClientRect().height
        var ot = index*oh
        var t = ot - wh/2 + oh
        this.select.el.scrollTop = t

        // console.log(this.select)
        // var scalable = document.querySelector('[data-scalable-viewport]')
        // var scrollCenter = {
        //     x: window.innerWidth/2,
        //     y: Locomotion.scroll.instance.delta.y + window.innerHeight/2
        // }
        // scalable.style.setProperty('--originX', scrollCenter.x);
        // scalable.style.setProperty('--originY', scrollCenter.y);

    }

    open(card) {

        // hide loading
        // this.select.loader.classList.remove('--loading')
        this.DOM.card.classList.add('--active')

        // Locomotion.stop();
        document.documentElement.classList.add('no-scroll');
        document.documentElement.classList.add('has-modal');
        // gsap
        // .from(target, 0.8, {
        //     xPercent: 110, 
        //     ease: Expo.easeOut,
        //     onComplete: function() {

        //         // initTabs()
                
        //         // hide loading
        //     }
        // })

        this.is_open = true

    }

    close() {

        document.documentElement.classList.remove('has-modal');
        var target = this.DOM.card
        gsap
        .to(target, 0.8, {
            // xPercent: 0, 
            // ease: Expo.easeOut,
            onComplete: function() {
                target.remove()
                // Locomotion.start();
                document.documentElement.classList.remove('no-scroll');
            }
        })
        this.is_open = false
        this.selected = []

    }

    closeNext() {

        if(this.is_open) {

            // toggle animations
            this.DOM.card.classList.add('--next-out')
            this.DOM.card.classList.remove('--active')

            // fake delayed call
            var target = this.DOM.card
            gsap
            .to(target, 0.8, {
                // xPercent: 0, 
                // ease: Expo.easeOut,
                onComplete: function() {
                    target.remove()
                }
            })
        }

    }

    openNext() {

        this.DOM.inner.scrollTop = 0
        this.DOM.card.classList.add('--next-in','--active')

    }

    initEvents() {
        var _this = this

        this.DOM.close.forEach(function(el) {
            el.addEventListener("click", e => {
                // console.log(e.target)
                e.preventDefault()
                _this.close()
            });
        })

        // click outside select content
        this.DOM.modal.addEventListener("click", e => {
            // console.log(e.target.closest('[data-select]'))
            e.target.closest('[data-select]') === null ? _this.close() : null
        });

        this.select.options.forEach(el => {
            // console.log('Init Async Tabs controls ...')
            // TABS.push(new AsyncTabs(el))
            // console.log(TABS)
            var _this = this
            el.addEventListener('click', function (e) {
                _this.selectOption(this)
                // output.querySelector('[data-select-option='+index+']').classList.toggle('selected')
            });

        })
        


        this.DOM.card.querySelectorAll('[data-select-sub]').forEach(el => {
            // console.log('Init Async Tabs controls ...')
            // TABS.push(new AsyncTabs(el))
            var _this = this
            el.addEventListener('click', function (e) {
                var id = this.getAttribute('data-select-sub')
                console.log('subselect: ', id)
                e.target.closest('[data-select-group]').querySelector('[data-subselect="'+id+'"]').classList.toggle('active')
                e.target.closest('[data-select-group]').classList.toggle('open')
                // e.target.closest('[data-select]').classList.toggle('is-subselect')
                // e.target.closest('[data-select]').scrollTop = 0

                
            });

        })

        this.DOM.card.querySelectorAll('[data-select-back]').forEach(el => {
            // console.log('Init Async Tabs controls ...')
            // TABS.push(new AsyncTabs(el))
            var _this = this
            el.addEventListener('click', function (e) {
                e.target.closest('[data-select-group]').classList.toggle('open')
                e.target.closest('[data-subselect]').classList.toggle('active')
                e.target.closest('[data-select-group]').scrollTop = 0
                
            });

        })



        this.after()
    }

    selectOption(option) {
      console.log(option)

      // get option index
      var index = option.getAttribute('data-select-option')

      // add into selected
      if (!this.multiple) {
        this.selected = []
      } 
      this.selected.indexOf(index) === -1 ? this.selected.push(index) : this.selected.splice(this.selected.indexOf(index),1);
      // console.log(this.selected)


      //
      // change DOM styles
      //

      // toggle selected option
      if(!this.multiple) {
        this.select.options.forEach(el => {
            el.classList.remove('selected')
        })
      }
      option.classList.toggle('selected')

      // if any selected, change select widget style
      this.selected.length === 0 ?  this.DOM.card.classList.remove('is-selected') : this.DOM.card.classList.add('is-selected')




      // update collection

      // place in event emitor


      // console.log(this.selected)
        if(!this.redirect && !this.dialog) {

          var update = this.multiple ? JSON.stringify(this.selected) : this.selected
          var label = option.hasAttribute('data-select-label') ? option.getAttribute('data-select-label') : null
          this.widget.output.setAttribute('value',update)
          // var bind = document.querySelector('[data-bind='+this.widget.el.getAttribute('data-bind')+']')
          // console.log(bind)
          // bind.setAttribute('value',update)
          this.widget.value = update


          if (label) { this.widget.el.querySelector('[data-select-label]').innerHTML = label }
          

          // display selected values
          if (this.multiple) {
              this.widget.outputHtml.querySelectorAll('[data-option]').forEach(el => {
                el.remove()
              })
              console.log(this.widget.output)
              this.selected.forEach(index => {
                var el = document.createElement("div")
                el.setAttribute('data-option',index)
                el.innerHTML = '<span class="tag">'+index+'</span>'
                // console.log(this.widget.output)
                this.widget.outputHtml.append(el)
              })
          }

          this.close()
      }

      if (this.redirect) {
        console.log(this.selected)
          var url = this.widget.el.getAttribute('href')
          window.location.href = url + '&data=' + this.selected
      }

      if (this.dialog) {
          var url = this.widget.el.getAttribute('href')
          if ( this.selected == 1 ) {
              window.location.href = url
          } else {
            this.close()
          }
      }

      if (this.menu) {

          this.close()
      }

      // this.close()
      // dispatch select event
        var event = new CustomEvent('selectSelected', { detail: { select: this, context: this.template, data: this.select.data } });
        window.dispatchEvent(event);

    }


    after() {

        // dispatch select event
        var event = new CustomEvent('selectReady', { detail: { select: this, context: this.template, data: this.select.data } });
        window.dispatchEvent(event);

    }

}

// bind select events
var SELECT = new Select()

function initSelects() {
    console.log('Init Select controls ...')

    document.addEventListener('click', e => {
        e.stopPropagation()
        var el = e.target.closest('[data-select-open]')
        // console.log(el)
        if (el !== null) {
            e.preventDefault();

            // get preselect
            var selected = el.querySelector('[data-select-output]') ? el.querySelector('[data-select-output]').getAttribute('value') : null 

            // get post data
            var post = typeof post !== 'undefined' ? post : el.getAttribute('data-select-post');

            // get url
            var url = typeof url !== 'undefined' ? url : el.getAttribute('data-select-open');

            // test data if json or string
            var dataArr = []
            if (isJSON(selected)) {
                dataArr = JSON.parse(selected)
            } else {
                dataArr[0] = selected
            }  
            console.log(dataArr)
            SELECT.add(e.target.closest('[data-select-widget]'), url, dataArr, post)  
        }
    })
}

function isJSON(str) {
    try {
        return (JSON.parse(str) && !!str);
    } catch (e) {
        return false;
    }
}
/*

    TABS

*/

class Tabs {
    constructor(el) {
        this.DOM = {
            widget: el,
            // ( document.querySelectorAll('[data-tab]') )
            tabs: Array.prototype.slice.call(el.querySelectorAll('[data-tab]')),
            container: el.querySelector('[data-pane-container]'),
            panes: el.querySelectorAll('[data-pane]'),
            nav: {}
            // loader: event.target.closest('[data-loader-control]')
        };

        this.context = el.getAttribute('data-context')

        this.DOM.nav = {
            prev: typeof this.DOM.widget.querySelectorAll('[data-tab-prev]') !== undefined ? this.DOM.widget.querySelectorAll('[data-tab-prev]') : null,
            next: typeof this.DOM.widget.querySelectorAll('[data-tab-next]') !== undefined ? this.DOM.widget.querySelectorAll('[data-tab-next]') : null,
        }

        this.data = {
            init: 0,
            prev: 0,
            active: 0,
            next: 0,
            to: 0,
        };

        this.touch = {
            start: 0,
            end: 0,
            distance: 0,
            threshold: 60
        };


        console.log('data-tab-widget = ' + this.DOM.widget.getAttribute('data-tab-widget'))
        this.data.init = this.DOM.widget.getAttribute('data-tab-widget').length > 0 ? (this.DOM.widget.getAttribute('data-tab-widget') - 1) : 0
        
        this.async = null,

        this.is_changing = false

        this.init()
        
    }

    init() {

        // console.log('First index: ' + this.data.init)
        console.log(this);

        this.DOM.widget.classList.add('--init')

        this.DOM.panes[this.data.init].classList.add('--active')
        this.DOM.tabs[this.data.init].classList.add('--active')

        this.data.active = this.data.init

        gsap.from(this.DOM.panes[this.data.active], .5, {
            xPercent: 110, 
            ease: Expo.easeOut
        });

        this.initEvents()

    }

    setActive(e) {

        if(!this.is_changing) {
            this.data.next = this.DOM.tabs.indexOf(e.target.closest('[data-tab]'))

            if (this.data.next != this.data.active) {
                gsap.from(this.DOM.panes[this.data.next], .5, {
                    xPercent: 110, 
                    ease: Expo.easeOut
                });

                this.change('next')              
            }
        }

    }

    next() {
        
        if(!this.is_changing) {
            this.DOM.nav.next.forEach(function(el) { el.classList.add('--loading') })
            if (this.data.active < (this.DOM.panes.length - 1)) {
                this.data.next = this.data.active + 1
                this.change('next')
            } else {
                // load next week
                var date = this.DOM.tabs[this.data.active].getAttribute('data-day')
                console.log('Loading next week ...', date)

                var today = this.DOM.panes[this.DOM.panes.length - 1].getAttribute('data-pane')

                var tomorrow = new Date(today.split('-')[0],today.split('-')[1],today.split('-')[2])
                this.context == 'week' ? tomorrow.setDate(tomorrow.getDate() + 1) : tomorrow.setMonth(tomorrow.getMonth() + 1)
                tomorrow = formatDate(tomorrow)

                // tomorrow = tomorrow.toISOString().split('T')[0]

                console.log(today)
                console.log(tomorrow)

                window.location.href = this.context + '.php' + '?d=' + tomorrow


                
            }
            // this.data.next = this.data.active < (this.DOM.panes.length - 1) ? this.data.active + 1 : 0 
        }

    }

    previous() {

        if(!this.is_changing) {
            this.DOM.nav.prev.forEach(function(el) { el.classList.add('--loading') })
            if (this.data.active > 0) {
                this.data.next = this.data.active - 1
                this.change('prev')
            } else {
                // load next week
                console.log('Loading previous week ...')
                var today = this.DOM.panes[0].getAttribute('data-pane')

                var yesterday = new Date(today.split('-')[0],today.split('-')[1],today.split('-')[2])
                this.context == 'week' ? yesterday.setDate(yesterday.getDate() - 1) : yesterday.setMonth(yesterday.getMonth() - 1)
                yesterday = formatDate(yesterday)

                // yesterday = yesterday.toISOString().split('T')[0]

                console.log(today)
                console.log(yesterday)

                window.location.href = this.context + '.php' + '?d=' + yesterday
            }


            // this.data.next = this.data.active > 0 ? this.data.active - 1 : (this.DOM.panes.length - 1)
        }

    }

    paneOut() {
        
        var _this = this
        // animate active out
        gsap.to(this.DOM.panes[this.data.prev], .5, {
            scale: 0.5, 
            opacity: 0,
            ease: Expo.easeOut,
            onComplete() {

              // reset previous
              gsap.set(_this.DOM.panes[_this.data.prev], { clearProps: 'all' });

            },
        });
    }

    paneIn() {
        var _this = this


        gsap.to(this.DOM.panes[this.data.active], .5, {
            xPercent: 0, 
            ease: Expo.easeOut,
            onComplete() {

              gsap.set(_this.DOM.panes[_this.data.active], { clearProps: 'all' });

              // reindex data
              // _this.data.active = _this.data.next
               _this.is_changing = false;

              //
            }
        });
    }

    change(dir) {

        this.is_changing = true

        this.data.prev = this.data.active
        this.data.active = this.data.next

        // change active tab
        this.DOM.tabs[this.data.prev].classList.remove('--active')
        this.DOM.tabs[this.data.active].classList.add('--active')
        
        // animate previous out
        this.DOM.panes[this.data.prev].classList.remove('--active')
        this.paneOut()
       
        // animate active in
        this.DOM.panes[this.data.active].classList.add('--active')
        this.paneIn()


        // // hide loading
        // this.DOM.nav.prev.forEach(function(el) { el.classList.remove('--loading') })
        // this.DOM.nav.next.forEach(function(el) { el.classList.remove('--loading') }) 
        //

        //
        this.onTabChange()
    }

    grab(e) {
        this.touch.distance = 0;
        this.touch.start = e.touches[0].clientX;
    }

    drag(e) {
        this.touch.end = e.changedTouches[0].clientX;
        this.touch.distance = this.touch.end - this.touch.start

        if(Math.abs(this.touch.distance) > 0) {
            // this.follow(e)
            this.touch.distance < 0 ? this.follow('next') : this.follow('prev')

        }
        // if(Math.abs(this.touch.distance) > this.touch.threshold) { 
            
        //     // change active tab
        //     this.touch.distance < 0 ? this.next() : this.previous()
        //     console.log('change')

        // }
    }

    release(e) {

        if(Math.abs(this.touch.distance) > this.touch.threshold) { 
            
            // change active tab
            this.touch.distance < 0 ? this.next() : this.previous()
            console.log('change')

        
        } else {

            // retreat back
            this.touch.distance < 0 ? this.retreat('next') : this.retreat('prev')
            // this.retreat()
            console.log('retreat')
        }
    }

    follow(dir) {
        // console.log(dir)
        if (!this.is_changing) {

            gsap.to(this.DOM.panes[this.data.active], 0, {
                // x: this.touch.distance, 
                scale: 1 - Math.abs(this.touch.distance)/1000,
                opacity: 1 - Math.abs(this.touch.distance)/200,
                ease: 'none'
            });


            if (dir == 'next') {
                this.to = this.data.active < (this.DOM.panes.length - 1) ? this.data.active + 1 : null 
                gsap.fromTo(this.DOM.panes[this.to], 
                {
                    xPercent: 110,
                    opacity: 1,
                },
                {
                    xPercent: 110 - Math.abs(this.touch.distance)/10,
                    opacity: 1,
                    duration: 0,
                    ease: 'none'
                });

            } else {
                this.to = this.data.active > 0 ? this.data.active - 1 : null
                gsap.fromTo(this.DOM.panes[this.to], 
                {
                    xPercent: -110,
                    opacity: 1,
                },
                {
                    xPercent: -110 + Math.abs(this.touch.distance)/10,
                    opacity: 1,
                    duration: 0, 
                    ease: 'none'
                });
            }
            // console.log(this.touch.distance)
        }
    }

    retreat(dir) {
        var _this = this

        gsap.to(this.DOM.panes[this.data.active], .5, {
            x: 0, 
            scale: 1,
            opacity: 1,
            ease: Expo.easeOut,
            onComplete() {
              gsap.set(_this.DOM.panes[_this.data.active], { clearProps: 'all' });

            }
        });
        if (dir == 'next') {
            gsap.to(this.DOM.panes[this.data.active + 1], .5, {
                xPercent: 110, 
                ease: Expo.easeOut,
                onComplete() {
                     gsap.set(_this.DOM.panes[_this.data.active + 1], { clearProps: 'all' });

                }
            });
        } else {
            gsap.to(this.DOM.panes[this.data.active - 1], .5, {
                xPercent: -110, 
                ease: Expo.easeOut,
                onComplete() {
                    gsap.set(_this.DOM.panes[_this.data.active - 1], { clearProps: 'all' });

                }
            });
        }
    }

    initEvents() {
        var _this = this

        this.DOM.tabs.forEach(function(el) {
            el.addEventListener("click", e => {
                e.preventDefault()
                !_this.is_changing ? _this.setActive(e) : null
            });
        })
        this.DOM.nav.prev.forEach(function(el) {
            el.addEventListener("click", e => {
                e.preventDefault()
                !_this.is_changing ? _this.previous(e) : null
            });
        })
        this.DOM.nav.next.forEach(function(el) {
            el.addEventListener("click", e => {
                e.preventDefault()
                !_this.is_changing ? _this.next(e) : null
            });
        })
        
        this.DOM.container.addEventListener("touchstart", e => {
            // e.preventDefault()
            this.grab(e)
        });
        this.DOM.container.addEventListener("touchmove", e => {
            // e.preventDefault()
            this.drag(e)
        });
        this.DOM.container.addEventListener("touchend", e => {
            this.release(e)
        });


        // var xDown = null;                                                        
        // var yDown = null;

        // function getTouches(e) {
        //   return e.touches ||             // browser API
        //          e.originalEvent.touches; // jQuery
        // }    

        // this.DOM.widget.addEventListener("touchstart", e => {
        //     // e.preventDefault()
        //     const firstTouch = getTouches(e)[0];                                      
        //     xDown = firstTouch.clientX;                                      
        //     yDown = firstTouch.clientY;
        // });

        // this.DOM.widget.addEventListener("touchmove", e => {
        //     // e.preventDefault()
        //     if ( ! xDown || ! yDown ) {
        //         return;
        //     }

        //     var xUp = e.touches[0].clientX;                                    
        //     var yUp = e.touches[0].clientY;

        //     var xDiff = xDown - xUp;
        //     var yDiff = yDown - yUp;

        //     // console.log(xDiff)
                                                                                 
        //     if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
        //         if ( xDiff > 0 ) {
        //             /* right swipe */ 
        //             console.log('right swipe')
        //             !_this.is_changing ? _this.next(e) : null
        //         } else {
        //             /* left swipe */
        //             console.log('left swipe')
        //             !_this.is_changing ? _this.previous(e) : null
        //         }                       
        //     } else {
        //         if ( yDiff > 0 ) {
        //             /* down swipe */ 
        //         } else { 
        //             /* up swipe */
        //         }                                                                 
        //     }
        //     /* reset values */
        //     xDown = null;
        //     yDown = null;
        // });



        this.after()
    
    }

    after() {

        // dispatch tabs event
        var detail = {
            tabs: this,
            context: this.DOM.widget.getAttribute('data-context') ? this.DOM.widget.getAttribute('data-context') : null,
            data: {
                league: this.DOM.widget.getAttribute('data-league') ? this.DOM.widget.getAttribute('data-league') : null,   
            }

        }
        var event = new CustomEvent('tabsReady', { detail: detail });
        window.dispatchEvent(event);

    }

    onTabChange() {

        console.log('Change active index: ' + this.data.next)

    }
  
}

class AsyncTabs extends Tabs {
   
    change() {

        // console.log('Change active tab. Index: ' + this.data.next)

        this.is_changing = true

        // fetch content
        this.async(this.data.next)
            .then((response) => {
                // console.log(response)
                const doc = new DOMParser().parseFromString(response, 'text/html')
                var node = document.createElement("div")
                node.innerHTML = doc.querySelector('body').innerHTML

                // return node
                return node

            })
            .then( node => {

                // append next content
                this.DOM.panes[this.data.next].append(node)

            })
            .then(() => {

                // animate in next pane
                this.DOM.tabs[this.data.active].classList.remove('--active')
                this.DOM.panes[this.data.active].classList.remove('--active')
                this.DOM.panes[this.data.active].classList.add('--inactive')

                this.DOM.panes[this.data.next].classList.remove('--inactive')
                this.DOM.panes[this.data.next].classList.add('--active')
                this.DOM.tabs[this.data.next].classList.add('--active')

            })
            .then(() => {

                // hide loading
                this.DOM.nav.prev.forEach(function(el) { el.classList.remove('--loading') })
                this.DOM.nav.next.forEach(function(el) { el.classList.remove('--loading') }) 
                //
                this.is_changing = false

                // remove previous content after animation complete
                let prev = this.data.active;
                setTimeout(() => {
                    this.DOM.panes[prev].classList.remove('--inactive')
                    this.DOM.panes[prev].innerHTML = ''
                },400)

                // reindex data
                this.data.active = this.data.next

                //
                this.onTabChange()


            })
    }
}


function initAsyncTabs(context) {
    var widget = context.querySelectorAll('[data-async-tabs]')

    widget ? widget.forEach(tabs => {
        tabs.querySelectorAll('[data-tab-widget]').forEach(el => {
            console.log('Init Async Tabs controls ...')
            var modalTabs = new AsyncTabs(el)
        })
    }) : null
   

}

function initTabs(context) {
    var widget = context.querySelectorAll('[data-tabs]')

    widget ? widget.forEach(tabs => {
        tabs.querySelectorAll('[data-tab-widget]').forEach(el => {
            console.log('Init Tabs controls ...')
            var modalTabs = new Tabs(el)
        })
    }) : null
}


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