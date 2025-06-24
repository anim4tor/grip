/*

  ADD TO CART
  
*/

var debug = false;

// test if shop open
async function isOpen() {
 
    const is_open = await ajax('/is_open.php').then(data => {
      console.log('Raw data: ', data)
      data = data.replace(/<[^>]*>?/gm, ''); // JSON data parsed by `data.json()` call
      const obj = JSON.parse(data)
      return obj
    })
    .then(returndata => {
      console.log('Parsed data: ', returndata)
      return returndata 
      // is_open = returndata.open      
    })

  return is_open

}

// add to cart
$(document).on('submit','form[data-cart-add]',async function( event ){

  // prevent default
  event.preventDefault();

  // test if open
  await isOpen()
    .then(data => {
      if(data.open) {
        addCart($(this));
      } else {
        if(debug) addCart($(this));
        FEEDBACK.message('cart_disabled', 5000, data)
      }
  })
  
})

$(document).on('submit','form[data-cart-quick]',async function( event ){

  // prevent default
  event.preventDefault();

  // test if open
  await isOpen()
    .then(data => {
      if(data.open) {
        addCart($(this));
      } else {
        FEEDBACK.message('cart_disabled', 5000, data)
      }
  })

})

function addCart(form) {
  var form = form,
      loader = $('[data-loader]'),
      modal = $('[data-modal]')
      // feedback = $('[data-feedback]')

  var loader = form.find('[data-loader-control]')[0]

  var data = new FormData(form[0]);
  var object = {};
  data.forEach(function(value, key){
      object[key] = value;
  });
  var json = JSON.stringify(object);

    // submit = form.find('.js-checkout-review');
  $.ajax({  
      url: form.attr('action'),  
      type: form.attr('method'),
      context: $(this),
           
      // post data
      data: form.serialize(),
      dataType : 'json',

      beforeSend: function(){
        // document.documentElement.classList.add('is-loading');
        if(loader) loader.classList.add('--loading');
        console.log(json)
      },

      success: function( returndata ){
        if(debug) console.log(returndata)
        console.log(returndata)
          

        var item = returndata.item;

        // update cart count
        $('.js-cart-count').text(returndata.cart.count);
        $('.js-cart-total').text(returndata.cart.total);

        $('[data-cart-id=' + returndata.edited_id + ']').find('.js-item-per').text(returndata.item.per);
        $('[data-cart-id=' + returndata.edited_id + ']').find('.js-item-total').text(returndata.item.per * returndata.item.q);

        // show success feedback
        FEEDBACK.message('cart_add', 4000, { 'beauty': returndata.feedback })

        if(returndata.item.id == 'family-pizza' | returndata.item.id == 'party-pizza') {
          FEEDBACK.message('metro', 8000)
        }

      },
      error: function( returndata ){
         console.log(returndata.responseText)
      },
      complete: function( returndata ) {
        if(debug) console.log(returndata.responseText)
        // document.documentElement.classList.remove('is-loading')
        if(loader) loader.classList.remove('--loading');

        if(MODAL.is_open) MODAL.close()
      }
  });

}


/*

  DELETE FROM CART
  
*/
  $('[data-cart]').on('click','[data-cart-delete]',function() {
    deleteCart($(this));
  })

  function deleteCart(item) {
    var cartId = item.attr('data-cart-delete')
    var loader = item.closest('[data-loader-control]')[0]

    console.log('deleteCart: ' + cartId);

    $.ajax({ 
        type: "POST",
        url: 'cart_delete.php',
        data: { 'cartId' : cartId },
        dataType: 'json', 

        beforeSend: function(){
          // document.documentElement.classList.add('is-loading');
          loader.classList.add('--loading');
        },

        success: function(returndata){

            if(debug) console.log(returndata);
            
            var cart = returndata.cart;

            // delete item
            var deleteAll = $('[data-cart-id='+returndata.deletedId+']');
            
            deleteAll.addClass('deleting');
            setTimeout(function(){
                deleteAll.remove();
            },100)

            if(cart.count == 0) {
              window.location.replace("objednavka");
            } else {
              // show success feedback
              FEEDBACK.message('cart_delete',2000)

              // update cart count
              $('.js-cart-count').text(cart.count);

              // update cart total
              $('.js-cart-total').text(cart.total);
            }
              

        },

        complete: function( returndata ) {
          if(debug) console.log(returndata.responseText)
          // document.documentElement.classList.remove('is-loading');
          loader.classList.remove('--loading');
        }
    });

  }

  /*

    EDIT CART ITEM
    
  */
    $(document).on('submit','form[data-cart-edit]',function( event ){
      console.log('Editing cart item ...')
      
      // prevent default
      event.preventDefault();

      editCart($(this));
    })

    function editCart(form) {
      var form = form,
      loader = $('[data-loader]'),
      modal = $('[data-modal]'),
      feedback = $('[data-feedback]')

        // submit = form.find('.js-checkout-review');
      $.ajax({  
          url: form.attr('action'),  
          type: form.attr('method'),
          context: $(this),
               
          // post data
          data: form.serialize(),
          dataType : 'json',

          beforeSend: function(){
            document.documentElement.classList.add('is-loading');
          },

          success: function( returndata ){

            console.log(returndata)

            var item = returndata.item;

            // update cart count
            $('.js-cart-count').text(returndata.cart.count);
            $('.js-cart-total').text(returndata.cart.total);

            $('[data-cart-id=' + returndata.edited_id + ']').find('.js-item-per').text(returndata.item.per);
            $('[data-cart-id=' + returndata.edited_id + ']').find('.js-item-total').text(returndata.item.per * returndata.item.q);

            // show success feedback
            feedback.find('[data-feedback-message]').html('Úspěšně jste upravili položku košíku.');
            FEEDBACK.messageClass('--success');
            FEEDBACK.messageClass('--open');

            setTimeout(function(){
              closeFeedback()
            },3000)

          },
          error: function( returndata ){
             console.log(returndata)
          },
          complete: function( returndata ) {
            // console.log(returndata.responseText)
            document.documentElement.classList.remove('is-loading','has-modal');
            // document.documentElement.classList.remove('has-modal');
          }
      });


    }


  function initCart() {

    var cart__ingredients = document.querySelectorAll('[data-ingredient-bind]');
    cart__ingredients.forEach(function(el) {
      el.addEventListener('change', function(event) {
        console.log('Ingredient changed')
        // var value = event.target.value,
        //  name = event.target.getAttribute('data-name')
        // console.log(name + ': ' + value)
        updateCartItemTotal()
        
      })
    });

    function updateCartItemTotal() {

      
      var total = 0
      var ingredients = document.querySelectorAll('[data-ingredient-bind]')

      ingredients.forEach(function(el) {

        var value = el.value,
          price = el.getAttribute('data-ingredient-base'),
          modifier = el.getAttribute('data-ingredient-modifier')
        if (value > 0) {
          total += parseInt(price * modifier * value)
        }

      });

      var menu_price = document.querySelector('[data-checked]').getAttribute('data-value-bind')
      total += parseInt(menu_price)

      document.querySelectorAll('[data-menu-price]').forEach(function(el) { el.innerText = total })

     
    }


    function updatePizzaSize(item,size) {
      item.querySelector('.pizza__figure').setAttribute('data-size', size)
    }



    /* 
      Sizes widget
    */ 

    var cart__sizes = document.querySelectorAll('[data-value-bind]');
    cart__sizes.forEach(function(el) {
      el.addEventListener('click', function() {
        var total = 0

        document.querySelectorAll('[data-value-bind]').forEach(function(el){
          el.removeAttribute('data-checked')
        })

        el.setAttribute('data-checked', true)

        var cartItem = el.closest('[data-cart-item]')
        var price = el.getAttribute('data-value-bind')
        var measure = el.getAttribute('data-size')
        var size = el.getAttribute('value')

        console.log(size)
        document.querySelectorAll('[data-menu-price]').forEach(function(el) { el.innerText = price })
        // document.querySelector('[data-menu-size]').innerText = measure
        updatePizzaSize(cartItem,size)

        // modify ingredients
        var modifier = el.getAttribute('data-modifier')
        var ingredients = document.querySelectorAll('[data-ingredient-bind]')

        ingredients.forEach(function(el) {
          // el.value = 0
          el.setAttribute('data-ingredient-modifier', modifier)
          var price = el.getAttribute('data-ingredient-base')
          var priceNode = el.closest('[data-ingredient-item]').querySelectorAll('[data-ingredient-price]')
          priceNode.forEach(function(node){
            node.innerHTML =  parseInt(price * modifier)
            node.setAttribute('data-ingredient-price', parseInt(price * modifier))
          })
        });

        updateCartItemTotal()

      })
    });
  }