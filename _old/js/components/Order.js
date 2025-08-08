/* 

     INPUTS 

*/

jQuery.each(jQuery('textarea[data-autoresize]'), function() {
  var offset = this.offsetHeight - this.clientHeight;
  var resizeTextarea = function(el) {
      jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
  };
  jQuery(this).on('keyup input', function() { resizeTextarea(this); }).removeAttr('data-autoresize');
});

/* 
  VALIDATION
*/


// $('body').on('change', '.js-validate-zipcode-input', function(event) {

//   if ( /^[0-9]{3} ?[0-9]{2}$/.test($(this).val()) ) {
//     $(this).closest('.input__layout').removeClass('--error --valid').addClass('valid');
//   } else {
//     $(this).closest('.input__layout').removeClass('--error --valid').addClass('error');
//   }
  
// });

$('body').on('change', '.js-validate-phone-input', function(event) {

  if ( /^(\+420)? ?[1-9][0-9]{2} ?[0-9]{3} ?[0-9]{3}$/.test($(this).val()) ) {
    $(this).closest('.input__layout').removeClass('--error --valid').addClass('--valid');
  } else {
    $(this).closest('.input__layout').removeClass('--error --valid').addClass('--error');
  }
  
});

$('body').on('change', '.js-validate-email-input', function(event) {

  if ( /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test($(this).val()) ) {
    $(this).closest('.input__layout').removeClass('--error --valid').addClass('--valid');
  } else {
    $(this).closest('.input__layout').removeClass('--error --valid').addClass('--error');
  }
  
});

/*

  CHECKOUT
  
*/
var debug = false;
var sending = true;

$('#order').submit(async function( event ){

  // prevent default
  event.preventDefault();

  // sending true
  if(sending) {

    // test if open
    await isOpen()
      .then(data => {
        if(data.open) {
          orderSend()
        } else {
          if(debug) orderSend()
          FEEDBACK.message('cart_disabled', 5000, data)
        }
      })

  }


})

var presend = document.querySelectorAll('[data-order-presend-check]')

presend.forEach((el) => { el.addEventListener('click', (e) => {

    e.preventDefault()

    // is street address?
    var addressInput = document.querySelector('[data-street-address]')
    console.log(addressInput)
    if (addressInput && addressInput.value) {
      console.log('Street address is set and valid. Send order.')
      $('#order').submit()
    } else {
      console.log('Street address is not set. Opening shipping modal ...')
      openShipping(event)
    }

  })

})


function orderSend(e) {
  
  var form = $('#order'),
      inputs = form.find('.input__layout'),
      // loader = $('[data-loader]'),
      modal = $('[data-modal]'),
      feedback = $('[data-feedback]'),
      // validate = $('input[name="'+errors[i]['field']+'"], textarea[name="'+errors[i]['field']+'"], select[name="'+errors[i]['field']+'"]').closest('.contact__input')
      validate = $('input, textarea, select').closest('.input__layout');

  var loader = form[0].querySelector('[data-loader-control]')

  function resetForm() {
    form.removeClass('--failure --success --error --loading');
    inputs.removeClass('--error --valid --invalid');
    modal.removeClass('--open');
  }

  function clearError(field) {
    field.removeClass('--error --valid --invalid');
  }

  $('body').on('focus', '.--error input, .--error textarea', function(event) {
    clearError($(event.target).closest('.--error'))
  })

    // submit = form.find('.js-checkout-review');
  $.ajax({  
    url: form.attr('action'),  
    type: form.attr('method'),
    context: $(this),
         
    // post data
    data: form.serialize(),
    dataType : 'json',

    beforeSend: function(){
      resetForm()
      sending = false
      // form.addClass('--loading')
      loader.classList.add('--loading');
      // document.documentElement.classList.add('is-loading');
    },

    // callback
    success: function( returndata ){
      console.log(returndata);

      // if error

      if(returndata.error) {

        // show error feedback
        form.addClass('--failure');
        var errors = returndata.error_msg;
        var feedback = ''
        // for(var i in errors) {
          //         console.log(errors[i]['field']);
          //         $('input#'+errors[i]['field']).closest('.input__layout').addClass('error').find('.validation .tooltip').html(errors[i]['feedback']);
          //       }

        for(var i in errors) {
          console.log(errors[i]['field']);
          if (errors[i]['field'] == 'form') {
            // feedback.html(errors[i]['feedback'])
          } else {
            validate.has('[name="order[account]['+errors[i]['field']+']"]').addClass('--error')
            feedback += '<br>' + errors[i]['feedback'];
          }
        }

        // show failure feedback
        FEEDBACK.message('order_failure', 5000, { 'error' : returndata.error_msg })

     
      } else {

        form.addClass('--success');

        // show success feedback
        FEEDBACK.message('order_send', 5000)

        // reset form
        setTimeout(function(){
          resetForm()
          form[0].reset()

          // redirect to succes page
          window.location.replace("/objednavka/dekujeme");

        },3000)
        // window.location.replace("odeslano.php");
    
      }

    },

    //
    error: function(returndata) {
      // console.log(returndata.responseText);
      form.addClass('--error');

      feedback.find('[data-feedback-message]').html('Ooops! Something went wrong while sending your inquiry.');
      feedback.addClass('--failure');
      feedback.addClass('--open');
    },

    complete: function(returndata) {
      console.log(returndata.responseText);
      form.removeClass('--loading');
      // document.documentElement.classList.remove('is-loading');
      loader.classList.remove('--loading');
      sending = true

    }

  });

}


// put under Ordr class
$('body').on('change', '[data-order-update]', function(e) {
  updateTotal(e);
})

function updateTotal(e) {
      
      // var loader = e.target.closest('[data-loader-control]')
      console.log('delivery: ' + $('.js-delivery-input:checked').val() + ', payment: ' + $('.js-payment-input:checked').val());

       $.ajax({ 
          type: "POST",
          url: '/update_total.php',
          dataType: 'json', 
          data: { 'd' : $('.js-delivery-input:checked').val() , 'p' : $('.js-payment-input:checked').val()},

          beforeSend: function(){
            // document.documentElement.classList.add('is-loading');
            // loader.classList.add('--loading');
            document.querySelectorAll('[data-loader-control]').forEach((el) => {el.classList.add('--loading')})

          },

          success: function( returndata ){
              
              update = returndata;
              console.log(update);

              // update total
              $('.js-order-total').text(update.total);

              // update delivery
              $('[data-delivery-name]').text(update.delivery.name);
              $('[data-delivery-tax]').text(update.delivery.price);

              // update payment
              $('[data-payment-name]').text(update.payment.name);
              $('[data-payment-tax]').text(update.payment.price);
              
          },
          complete: function( returndata ){
            // document.documentElement.classList.remove('is-loading');
            // loader.classList.remove('--loading');
            document.querySelectorAll('[data-loader-control]').forEach((el) => {el.classList.remove('--loading')})

              // console.log(returndata.responseText);
          }
      });

  }




/*

  ORDER 
  SHIPPING

*/


// SMap address geocoding returning valid/invalid
function geocode(query) {

  var address = new Array();
  address['valid'] = false;
  address['label'] = 'Tohle neznáme.';
  // console.log(query)  

  return new Promise((resolve, rej) => {
    new SMap.Geocoder(query, function(geocoder) {

        var validated = geocoder.getResults()[0].results,
            found = false

        if (validated.length) {

          for (let el of validated) {
            console.log(el);
            if (el.source == 'addr' && el.label.indexOf('Svitavy') !== -1) {
              address['valid'] = true
              address['label'] = query;

              // resolve
              resolve(address)
            } 
          }

          if (!address['valid']) {

            // insufficient address query
            address['valid'] = false
            address['label'] = 'Z tohodle nic nepozname.';

            // reject
            resolve(address)

          }          

        } else {
          
          // reject
          rej(null)
        }

    });

  })

}

// open and init shipping modal
function openShipping(e) {

  // open shipping form modal
  console.log('Opening shipping widget ...')
  MODAL = new Modal('order_shipping', {})

  setTimeout(function() {
    
    // focus search input
    document.querySelector('[data-suggest-address]').focus()
    
    // init smartform suggest
    smartform.rebindAllForms()

    document.querySelector('[data-modal-close]').addEventListener('click', (e) => {
      updateTotal(e)
    })

  },400)

}


function validShipping(result) {
  
  console.log('Valid address, then continue ...')

  // show valid feedback
  FEEDBACK.message('order_shipping_valid', 5000, {'valid_address': result['label']})

  // // close modal
  MODAL.close()

  // update option feedback
  document.querySelectorAll('[data-shipping-address]').forEach((el) => { el.innerHTML = result['label'] })
  document.querySelectorAll('[data-street-address]').forEach((el) => { el.value = result['label'] })

  $('.order__delivery__feedback')[0].classList.add('--active')
  $('.order__delivery__feedback')[1].classList.remove('--active')

  // show selected address in delivery widget
  // var order_widget = document.querySelector('[data-order-delivery-widget]')
  // order_widget ? order_widget.classList.add('--success') : ''

  // check delivery option
  var order_input = document.querySelector('[data-order-delivery="kuryr"] input')
  order_input ? order_input.checked = true : ''

}

function invalidShipping() {

  console.log('Invalid address, stop!')

  // show invalid feedback
  FEEDBACK.inline('order_shipping_invalid', 4000)

  // hide selected address in delivery widget
  // var order_widget = document.querySelector('[data-order-delivery-widget]')
  // order_widget ? order_widget.classList.remove('--success') : ''

  // uncheck delivery option and find defautl
  // var order_input = document.querySelector('[data-order-delivery="osobne"] input')
  // order_input ? order_input.checked = true : ''

}

function errorShipping() {

  console.log('Error address, stop!')

  // show invalid feedback
  FEEDBACK.inline('order_shipping_error', 4000)

  // hide selected address in delivery widget
  // var order_widget = document.querySelector('[data-order-delivery-widget]')
  // order_widget ? order_widget.classList.remove('--success') : ''

  // uncheck delivery option and find defautl
  // var order_input = document.querySelector('[data-order-delivery="osobne"] input')
  // order_input ? order_input.checked = true : ''

}

// submit shipping form
function updateShipping(event) {

  // get address
  var form = $('#shipping')
  var loader = event.target
  var address = document.querySelector('[data-suggest-address]').value


  loader.classList.add('--loading')

  // if address valid
  geocode(address)
    .then((result) => {

      console.log(result)

      if(result['valid'] == true) {

        // show valid shipping feedback
        validShipping(result)

        // update total
        updateTotal(event)

        // save delivery info
        $.ajax({ 
            type: "POST",
            url: '/update_address.php',
            dataType: 'json', 
            data: form.serialize(),

            beforeSend: function(){

            },

            success: function( returndata ){

              
             
            },
            complete: function( returndata ){

                // loader.classList.remove('--loading');

              // console.log(returndata.responseText);

            }
        });
        
      } else {

        // show invalid shipping feedback
        invalidShipping()

        // update total
        updateTotal(event)

      }

    })
    .catch(e => {

      console.log(e)

      // show error shipping feedback
      errorShipping()

      // update total
      updateTotal(event)

    })
    .then(() => {

      // hide loader
      loader.classList.remove('--loading');

    })

  

}

function clearShipping() {

}


const shippingModalTrigger = document.querySelectorAll('[data-modal-shipping]')
if(shippingModalTrigger) {
  shippingModalTrigger.forEach((el) => {
    el.addEventListener('click', function(e) {
      openShipping(e)
    })
  })

}

document.querySelectorAll('[data-order-delivery]').forEach(function(el){

  // select delivery option
  el.addEventListener('click', function(e) {

      // get delivery option
      var option = el.getAttribute('data-order-delivery')

      if (option == 'kuryr') {

        e.preventDefault();

        openShipping(e)
       
      } else if (option == 'osobne') {

        // toggle continues
        document.querySelector('[data-order-delivery-widget]').classList.remove('--success')

      } else {

        console.log('Unknown delivery option');

      }
      
  })

})


// $('body').on('change', '[data-suggest-address]', function(event) {
//   FEEDBACK.close(event.target.closest('[data-shipping-modal]').querySelector('[data-feedback]'))
  
// })

$('body').on('submit','#shipping',(function( event ){
  // prevent default
  event.preventDefault();

  updateShipping(event)

}))

  

/*

  ADMIN
  ORDER
  
*/

var debug = false;

$('body').on('click','[data-order-view]', function(event) {

  // prevent default
  event.stopPropagation();
  event.preventDefault();

  var data = $(event.target).closest('button').attr('data-order');

  if (confirm('Opravdu si přejete odbavit objednávku ' + data + '?')) viewOrder(data);

});

$('body').on('click','[data-order-shipped]', function(event) {

  // prevent default
  event.stopPropagation();
  event.preventDefault();

  var data = $(event.target).closest('button').attr('data-order');

  if (confirm('Opravdu si přejete expedovat objednávku ' + data + '?')) shipOrder(data);

});

$('body').on('click','[data-order-delete]', function(event) {

  // prevent default
  event.stopPropagation();
  event.preventDefault();

  var data = $(event.target).closest('button').attr('data-order');

  if (confirm('Opravdu si přejete odstranit objednávku ' + data + '?')) deleteOrder(data);

});

$('body').on('click','[data-order-archive]', function(event) {

  // prevent default
  event.stopPropagation();
  event.preventDefault();

  var data = $(event.target).closest('button').attr('data-order');

  if (confirm('Opravdu si přejete archivovat objednávku ' + data + '?')) archiveOrder(data);

});

$('body').on('click','[data-order-bake]', function(event) {

  // prevent default
  event.stopPropagation();
  event.preventDefault();

  var data = $(event.target).closest('button').attr('data-order'),
      loader = event.target.closest('[data-loader-control]')
      
  loader.classList.add('--loading')


  if (confirm('Opravdu si přejete uložit objednávku ' + data + ' do databáze?')) {
    bakeOrder(event, data);
  } else {
    loader.classList.remove('--loading')

  }

});

function receiveOrder(id, reload = true) {
  
  $.ajax({ 
      type: "GET",
      url: '/admin/order_receive.php',
      data: 'orderId='+id, 
      dataType: 'json', 
      success: function(returndata){

          if(!returndata.error)    //if no errors
          {
              FEEDBACK.message('canban_received', 2000, { 'id': id })
              reload ? autoReloadOrders() : '';        
          }

      },

      complete: function(returndata) {
        // console.log(returndata.responseText);
      }

  });

}

function viewOrder(id, reload = true) {
  
  $.ajax({ 
      type: "GET",
      url: '/admin/order_viewed.php',
      data: 'orderId='+id, 
      dataType: 'json', 
      success: function(returndata){

          if(!returndata.error)    //if no errors
          {
              FEEDBACK.message('canban_viewed', 2000, { 'id': id })
              reload ? autoReloadOrders() : '';        
          }

      },

      complete: function(returndata) {
        // console.log(returndata.responseText);
      }

  });

}

function shipOrder(id, reload = true) {
  
  $.ajax({ 
      type: "GET",
      url: '/admin/order_shipped.php',
      data: 'orderId='+id, 
      dataType: 'json', 
      success: function(returndata){

          if(!returndata.error)    //if no errors
          {
              FEEDBACK.message('canban_shipped', 2000, { 'id': id })
              reload ? autoReloadOrders() : '';        
          }

      },

      complete: function(returndata) {
        // console.log(returndata.responseText);
      }

  });

}


function deleteOrder(id, reload = true) {
  
  $.ajax({ 
      type: "GET",
      url: '/admin/order_delete.php',
      data: 'orderId='+id, 
      dataType: 'json', 
      success: function(returndata){

          if(!returndata.error)    //if no errors
          {
              FEEDBACK.message('canban_deleted', 2000, { 'id': id })
              reload ? autoReloadOrders() : '';        
          }

      },

      complete: function(returndata) {
        // console.log(returndata.responseText);
      }

  });

}

function bakeOrder(event, id, reload = true) {

  var loader = event.target.closest('[data-loader-control]')

  $.ajax({ 
      type: "GET",
      url: '/admin/order_bake.php',
      data: 'orderId='+id, 
      dataType: 'json', 
      beforeSend: function() {
        loader.classList.add('--loading')
      },
      success: function(returndata){

          if(!returndata.error)    //if no errors
          {
              FEEDBACK.message('canban_baked', 2000, { 'id': id })
          }

      },
      complete: function(returndata) {
        console.log(returndata.responseText);
        loader.classList.remove('--loading')
      }

  });

}

function archiveOrder(id, reload = true) {
  
  $.ajax({ 
      type: "GET",
      url: '/admin/order_archive.php',
      data: 'orderId='+id, 
      dataType: 'json', 
      success: function(returndata){

          if(!returndata.error)    //if no errors
          {
              FEEDBACK.message('canban_completed', 2000, { 'id': id })
              reload ? autoReloadOrders() : ''; 
              // console.log(returndata);  
          }

      },

      complete: function(returndata) {
        console.log(returndata.responseText);
      }

  });

}

function updateOrder(id, data) {
 
  $.ajax({  
      url: 'order_update.php',  
      type: 'GET',
      context: this,
           
      // post data
      data: {'id': id, 'data': data},
      dataType : 'json',

      beforeSend: function(){
        // document.documentElement.classList.add('is-loading');
      },

      success: function( returndata ){
        console.log(returndata)
          
      },
      error: function( returndata ){
        console.log(returndata)
      },
      complete: function( returndata ) {
        // console.log(returndata)
        
      }
  });

}

function loadOrders(filter, container = '[data-load-orders]', mode = 'default') {
  return new Promise((resolve, rej) => {
    $(container).load('/admin/load_orders.php?auto=true&filter=' + filter + '&mode=' + mode, function() { resolve() })
  })
}

function reloadOrders(filter) {

  console.log('Reloading orders ...');
  document.documentElement.classList.add('is-loading');

  $('[data-load-orders]').load('/admin/load_orders.php?filter=' + filter, function(){
    document.documentElement.classList.remove('is-loading');
  });
  

}

var activeOrders = new Array()

function autoReloadOrders() {
  
  // console.log('Automatic reloading orders ... list: ' + filter + ' ... mode: ' + mode);
  return new Promise((resolve, rej) => {
    
    var i = 1
    var last = document.querySelectorAll('[data-load-orders]').length

    document.querySelectorAll('[data-load-orders]').forEach(list => {
      var container = list,
          filter = container.getAttribute('data-filter'),
          mode = container.getAttribute('data-mode')

      loadOrders(filter, container, mode)
        .then(() => {
          // console.log(i)
          console.log('Filter: ' + filter + ' orders loaded.')          
          i == last ? ( resolve(), console.log('Last order load container loaded.') ) : ''

          i++;

          // document.querySelectorAll('[data-order-item]').forEach(function(order){
          //   if(!activeOrders.includes(order.getAttribute('data-id'))) {
          //     // activeOrders.push(order.getAttribute('data-id'))
          //     order.classList.add('--new')
          //     // sound notification
          //     var beep = document.getElementById("audio");
          //     // beep.muted = true;
          //     beep.play();

          //   }
          // })

        })


    })


  })
   
  // document.documentElement.classList.add('is-loading');


}

