// accordion
function initAcc() {
  console.log('Initialize accordions ...')
  // console.log('acc init');
  $('[data-acc]').each(function() {
    var acc = new jsAccordion($(this), false);
  })
  $('[data-acc-blank]').each(function() {
    let content = $(this).find('[data-acc-content]')[0];
    let h = content.getBoundingClientRect().height
    $(this)[0].style.setProperty('--acc-height', h+40+'px');
    $(content).addClass('--ready');
  })
}

var jsAccordion = function(el, multiple) {
  this.el = el || {};
  this.multiple = multiple || false;

  // Variables privadas
  var triggers = this.el.find('[data-acc-trigger]');
  // Evento
  triggers.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
}

jsAccordion.prototype.dropdown = function(e) {
  var $el = e.data.el;
    $this = $(this),
    $next = $this.next();

  // animate this
  $next.slideToggle(400, 'swing', function () {
        // Animation complete.
        Locomotion.update()
    });
  $this.parent().toggleClass('--opened').removeClass('--focus');

  if (!e.data.multiple) {
    $('[data-acc-content]').not($next).slideUp(200).parent().removeClass('--opened').removeClass('--focus');
  };
}