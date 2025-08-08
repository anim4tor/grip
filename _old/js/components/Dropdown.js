/*

  DROPDOWN

*/

$('body').on('click','.js-root', function() {
  dropdownOpen($(this).closest('.js-dropdown-layout'));
})
$('body').on('click','.js-dropdown-close', function() {
  dropdownClose($(this).closest('.js-dropdown-layout'));
})
$('body').on('click','.js-dropdown-toggle', function() {

  dropdownToggle($(this).closest('.js-dropdown-layout'));
  // event.stopPropagation(); 
})
$('body').on('click','.js-dropdown-select:not(.disabled)', function() {
  dropdownSelect($(this));
})

function dropdownOpen(el) {
  el.addClass('active');
}
function dropdownClose(el) {
  el.addClass('closing').removeClass('active');
  setTimeout( function() {
    el.removeClass('closing');
  },300)
  
}
function dropdownToggle(el) {
  el.toggleClass('active');
}
function dropdownSelect(el) {
  el.addClass('active');
  el.closest('.js-dropdown-layout').find('.js-root').find('.js-dropdown-text').text(el.find('.js-dropdown-text').text());

  //
  console.log(el.find('.order-status').attr('data-status'));
  el.closest('.js-dropdown-layout').find('.js-root').attr('data-status',el.find('.order-status').attr('data-status'));
  

}