var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
    isMobile = true;
}


//@prepros-append components/Ajax.js
//@prepros-append components/Modal.js
//@prepros-append components/Select.js
//@prepros-append components/Tabs.js
//@prepros-append components/Form.js

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