window.addEventListener('load', (event) => {


  var timer = document.querySelector('[data-duration]');
  var phpstart = timer ? timer.getAttribute('data-duration') : null

  function tick(){
    var start = new Date(parseInt(phpstart) * 1000),
        now = new Date(),
        duration = new Date(Math.abs(start - now)),
        h = duration.getHours() - 1 > 0 ? + duration.getHours() - 1 + ':' : '',
        m = duration.getMinutes() < 10 ? '0'+duration.getMinutes() : duration.getMinutes(),
        s = duration.getSeconds()  < 10 ? '0'+duration.getSeconds() : duration.getSeconds(),
        now_formated = h + m + ':' + s
    document.querySelectorAll('[data-duration]').forEach(el => { el.innerHTML = now_formated });
  }
  // console.log(t)
  //the runner
  if(timer) {
      t = setInterval( tick, 1000);
  } else {
      clearInterval(t)
  }

});

