//ticker function that will refresh our display every second
 function tick(){
  var now = new Date(),
  	  h = now.getHours(),
  	  m = now.getMinutes() < 10 ? '0'+now.getMinutes() : now.getMinutes(),
  	  s = now.getSeconds()  < 10 ? '0'+now.getSeconds() : now.getSeconds(),
  	  now_formated = h + ':' + m + ':' + s

  // console.log(now_formated)
  document.querySelector('[data-time-ticker]').innerHTML = now_formated;
 }
 

//the runner
var t = setInterval( tick, 1000);