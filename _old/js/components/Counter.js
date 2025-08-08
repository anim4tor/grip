/*

    COUNTER

*/

class Counter {
  constructor(el) {

    this.inbox = []

    this.DOM = {
        widget: el,
        control: el.querySelectorAll('[data-operator]'),
        input: el.querySelector('input')
    };

    this.min = this.DOM.input.getAttribute('min')
    this.output = this.DOM.input.value

    this.active = false;
    this.update = this.DOM.input.hasAttribute('data-update');

    this.initEvents()
  
  }

  increment(dir) {
    var inc = parseInt(this.DOM.input.value) + parseInt(dir)
    this.output = (inc > this.min) ? inc : this.min
    this.DOM.input.value = this.output
    // this.DOM.input.change();
    this.DOM.input.dispatchEvent(new Event('change'))
  }

  toggleActive() {
    if(this.output > this.min) {
      this.active = true
      this.DOM.input.setAttribute('data-active', true)

    } else {
      this.active = false
      this.DOM.input.removeAttribute('data-active')
    }
  }

  change(e) {
    console.log('change')
    this.toggleActive()

    //    update counts and totals if update counter
    //    maybe under cart item class ??
    if (this.update) {
      updateCount(this.output,e);
    }

  }

  updateTotals() {

  }

  initEvents() {
    const _this = this
    this.DOM.input.addEventListener("change", e => {
      this.change(e)
    });
    this.DOM.control.forEach(function(control) {
      control.addEventListener("click", e => {
       _this.increment(e.target.getAttribute('data-operator'))
      });
    })
  }

}

class IngredientCounter extends Counter {
  
}

class CartCounter extends Counter {
  init() {

  }
  change() {

  }

  initEvents() {
    
  }
}

function initCounters() {
  var counters = document.querySelectorAll('[data-counter]')
  counters.forEach(function(el) {
    new Counter(el)
  })
}

initCounters()

// $('body').on('click','.input-ctrl', function(event) {
//     var counter = $(this).closest('.counter-widget'),
//         model = counter.find('.input-model'),
//         dir = $(this).attr('data-operator'),
//         out = parseInt(model.val()) + parseInt(dir),
//         min = model.attr('min');

//         // console.log('updateCount');

//     model.val(out < min ? min : out);
//     model.change();
//     model[0].dispatchEvent(new Event('change'));
//     counter.removeClass('--activated');
//     // updateCount(out < min ? min : out,event);
// })

$('body').on('change', '[data-cart-update]', function(e) {
  updateCount($(this).val(),e);
  console.log('updateCount');
})

// $('body').on('change', '.js-ing-quantity', function(event) {
//   updateIngredientCount($(this).val(),event);
//   // console.log('updateCount');
// })

function updateCount(val,event) {
  console.log('updateCount: ' + val);

  var loader = event.target.closest('[data-loader-control]')
  
  var item = $(event.target).closest('[data-cart-item]'),
      cart_id  = item.attr('data-cart-id'),
      input = item.find('.js-item-quantity'),
      thisInput = $(event.target).closest('.js-cart-item').find('.input-model');

  $.ajax({ 
      type: "POST",
      url: 'update_count.php',
      data: { 'cart_id' : cart_id , 'new_count' : val },
      dataType: 'json', 

      beforeSend: function(){
        // document.documentElement.classList.add('is-loading');
        loader.classList.add('--loading');
      },

      success: function( returndata ){

          // update item total
          $('[data-cart-id=' + cart_id + ']').find('.js-item-total').text(returndata.new_item_total);

          // update cart total
          $('.js-cart-total').text(returndata.new_cart_total);

          console.log(returndata);

          // // update total price
          // $('#total').find('.total-price').remove().end().prepend('<span class="total-price">'+update.total+'</span>');

          // // update price
          // $('#cart-open').find('#cart-count').remove().end().prepend('<span id="cart-count">'+update.count+'</span>');

      },
      complete: function( returndata ) {
        $(event.target).closest('.counter-widget').addClass('--activated');
        console.log(returndata.responseText);
        // document.documentElement.classList.remove('is-loading');
        loader.classList.remove('--loading');
      }
  });
}

// function updateIngredientCount(val,event) {
//   console.log('updateIngredientCount: ' + val);

//   var item = $(event.target).closest('[data-cart-item]').attr('data-cart-id'),
//       ing = $(event.target).closest('[data-ingredient-item]').attr('data-ingredient-item'),
//       // input = item.find('.js-item-quantity'),
//       thisInput = $(event.target).closest('.js-cart-item').find('.input-model');

//   $.ajax({ 
//       type: "POST",
//       url: 'update_ingredient.php',
//       data: { 'item_id' : item , 'ing_id' : ing, 'new_count' : val },
//       dataType: 'json', 

//       beforeSend: function(){
//         document.documentElement.classList.add('is-loading');
//       },

//       success: function( returndata ){

//           // update item total
//           $('[data-cart-id=' + item + ']').find('.js-item-total').text(returndata.new_item_total);

//           // update cart total
//           $('.js-cart-total').text(returndata.new_cart_total);

//           console.log(returndata);

//           // // update total price
//           // $('#total').find('.total-price').remove().end().prepend('<span class="total-price">'+update.total+'</span>');

//           // // update price
//           // $('#cart-open').find('#cart-count').remove().end().prepend('<span id="cart-count">'+update.count+'</span>');

//       },
//       complete: function( returndata ) {
//         document.documentElement.classList.remove('is-loading');
//         $(event.target).closest('.counter-widget').addClass('--activated');
//         console.log(returndata.responseText);
//       }
//   });
// }

