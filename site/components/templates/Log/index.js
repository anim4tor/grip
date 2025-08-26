window.addEventListener('load', (event) => {

  var offset = document.querySelector('today').offsetTop;
  console.log(offset)

  document.querySelector('main').scrollTop = offset - window.innerHeight/7.75;
  
});
