/* 

	DRAGGABLE 
	CANBAN

*/

var draggable

function initDraggable() {

if(!isMobile) {
  // console.log('Init draggable triggers')
  draggable = new Draggable.create("[data-draggable-item]",{
   type:"x,y",
   onDragStart: grabItem,
   onRelease: dropItem,
   onDrag: dragItem,
  });

} else {
	draggable = new Draggable.create("[data-draggable-item]",{
	 type:"x",
	 onDragStart: grabItem,
	 onRelease: dropItem,
	 onDrag: dragItem,
	});
}

}

function dropItem() {

  var target = this.target
  var boundsBefore, boundsAfter;


  if (this.hitTest("[data-drop-viewed]","51%") && !this.target.closest('[data-drop-viewed]')){
      var container = document.querySelector('[data-drop-viewed]')
      container.classList.remove('--dropping')

      // change itme status
      var data = target.getAttribute('data-order-item');
      if (confirm('Opravdu si přejete odbavit objednávku ' + data + '?')) {
        viewOrder(data, false);
        drop(target, container, 'viewed')
      } else {
        retreat(target)
      }

  } else if (this.hitTest("[data-drop-shipped]","51%") && !this.target.closest('[data-drop-shipped]')) {
      var container = document.querySelector('[data-drop-shipped]')
      container.classList.remove('--dropping')

      // change itme status
      var data = target.getAttribute('data-order-item');
      if (confirm('Opravdu si přejete expedovat objednávku ' + data + '?')) {
        shipOrder(data, false);
        drop(target, container, 'shipped')
      } else {
        retreat(target)
      }

  } else if (this.hitTest("[data-drop-archived]","51%") && !this.target.closest('[data-drop-archived]')) {
      var container = document.querySelector('[data-drop-archived]')
      container.classList.remove('--dropping')

      // change itme status
      var data = target.getAttribute('data-order-item');
      if (confirm('Opravdu si přejete dokončit objednávku ' + data + '?')) {
        archiveOrder(data, false);
        remove(target, container)
      } else {
        retreat(target)
      }

  // } else if (this.hitTest("[data-drop-received]","51%") && !this.target.closest('[data-drop-received]')) {
  //     var container = document.querySelector('[data-drop-received]')
  //     container.classList.remove('--dropping')

  //     // change itme status
  //     var data = target.getAttribute('data-order-item');
  //     if (confirm('Opravdu vrátit objednávku ' + data + ' mezi přijaté?')) {
  //       receiveOrder(data, false);
  //       drop(target, container, 'received')
  //     } else {
  //       retreat(target)
  //     }

  } else {
      retreat(target)
  }

  document.querySelectorAll('[data-drop-container]').forEach(container => {
    container.classList.remove('--grabbed')
  })

}

function retreat(target) {
  TweenMax.to(target,0.2,{
    x:0,
    y:0,
    scale: 1.0,
    boxShadow: "rgba(0,0,0,0.0) 0px 0px 0px 0px",
    onComplete: function(){
      target.classList.remove('--grabbed')
    }
  });
  document.querySelector('main').classList.remove('--archive-enabled')
  document.querySelectorAll('[data-drop-container]').forEach(el => {el.classList.remove('--dropping')})
}

function remove(target, container) {
  var boundsBefore, boundsAfter;
  var target_id = target.getAttribute('data-order-item')

  boundsBefore = target.getBoundingClientRect();
  $(target).prependTo(container);
  boundsAfter = target.getBoundingClientRect();

  TweenMax.fromTo(target, 0.4, {
    x:"+=" + (boundsBefore.left - boundsAfter.left), 
    y:"+=" + (boundsBefore.top - boundsAfter.top),
    scale: 1.1,
    opacity: 1,
  }, {
    x:0,
    y:0,
    opacity: 0,
    scale: 0.8,
    boxShadow: "rgba(0,0,0,0.0) 0px 0px 0px 0px",
    onComplete: function(){
      target.remove()
    }
  },
  );
  document.querySelector('main').classList.remove('--archive-enabled')
  
}

function drop(target, container, filter = 'received') {
  var boundsBefore, boundsAfter;
  var target_id = target.getAttribute('data-order-item')

  boundsBefore = target.getBoundingClientRect();
  $(target).prependTo(container);
  boundsAfter = target.getBoundingClientRect();

  TweenMax.fromTo(target, 0.2, {
    x:"+=" + (boundsBefore.left - boundsAfter.left), 
    y:"+=" + (boundsBefore.top - boundsAfter.top),
    scale: 1.1
  }, {
    x:0,
    y:0,
    scale: 1.0,
    boxShadow: "rgba(0,0,0,0.0) 0px 0px 0px 0px",
    onComplete: function(){
      target.classList.remove('--grabbed')
    }
  },
  );

  document.querySelector('main').classList.remove('--archive-enabled')

}

function grabItem() {
  this.target.classList.add('--grabbed')
  this.target.closest('[data-drop-container]').classList.add('--grabbed')
  this.target.classList.remove('--new')

  
  // var context = this.target.closest('[data-drop-container]').getAttribute('data-filter')
  // console.log(context)
  // if(context == 'shipped') {
  // 	document.querySelector('main').classList.add('--archive-enabled')
  // }
  
  TweenMax.to(this.target, 0.3, {
    scale: 1.1
  });
}

function dragItem() {

	
  document.querySelectorAll('[data-drop-container]').forEach(container => {
    if (this.hitTest(container,'51%')/* && this.target.closest('[data-drop-container]') != container*/) {
      container.classList.add('--dropping')
    }
    else {
      container.classList.remove('--dropping')
    }

    if (this.hitTest(container,'51%') && container.getAttribute('data-filter') == 'archived') {
  		document.querySelector('main').classList.add('--archive-enabled')
    }

  })
}



