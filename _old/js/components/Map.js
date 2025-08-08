/* 

	MAP 

*/

String.prototype.toHHMMSS = function () {
    var sec_num = parseInt(this, 10); // don't forget the second param
    var hours   = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = hours;}
    if (minutes < 10) {minutes = minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}

    var time = ''
    var unit = 'min'

    if(hours > 0) {
    	time += hours+':'
    	unit = 'hod'
    }
    if(minutes > 0) {
    	time += minutes
    	unit = 'min'

    }
    if(seconds > 0) {
    	time += ':'+seconds
    }
 
 	time += ' '+unit
 
 	return time;
}



function renderOrderMaps(maps) {

  maps.forEach(function(map) {
  
    var smap = map.querySelector('[data-map]'),
        long = map.getAttribute('data-longitude'), 
        lat = map.getAttribute('data-latitude'), 
        query = map.getAttribute('data-query')
    
    var destination, data

    var shop = SMap.Coords.fromWGS84(16.4673086, 49.7576875 );

    if(long !== '' && lat !== '') {
      destination = SMap.Coords.fromWGS84(long, lat);

      // render map
      var m = new SMap(smap, destination, 17);
      m.addDefaultLayer(SMap.DEF_BASE).enable();

    } else {

      // geocode from address query
      // console.log('Unknow coordinates for query: ' + query)

      new SMap.Geocoder(query + ' Svitavy', function(geocoder) {
          var validated = geocoder.getResults()[0].results;
          // console.log(validated)

          destination = SMap.Coords.fromWGS84(validated[0].coords.x, validated[0].coords.y);
          
         // render route
          var coords = [
              shop,
              destination
          ]

          var renderRoute = function(route) {


              var coords = route.getResults().geometry;
              var lastCoords = coords[Object.keys(coords)[Object.keys(coords).length - 1]]
              // console.log(lastCoords)

              // render map
              var m = new SMap(smap, lastCoords, 18);
              m.addDefaultLayer(SMap.DEF_BASE).enable();
             
              var geometryLayer = new SMap.Layer.Geometry();
              m.addLayer(geometryLayer).enable();

              var lineOpts = {
                  color: "#FB4E23",
                  width: 5
              };
              var g = new SMap.Geometry(SMap.GEOMETRY_POLYLINE, null, coords, lineOpts);
              geometryLayer.addGeometry(g);



              var circleCoords = [
                  // shop,
                  lastCoords,
                  destination
              ];
              var circleOpts = {
                  color: "#FB4E23",
                  opacity: 0.1,
                  outlineColor: "#FB4E23",
                  outlineOpacity: 0.1,
                  outlineWidth: 2
              };
              var circle = new SMap.Geometry(SMap.GEOMETRY_CIRCLE, null, circleCoords, circleOpts);
              geometryLayer.addGeometry(circle);

              // // create marker layer
              // var markerLayer = new SMap.Layer.Marker();
              // m.addLayer(markerLayer).enable();
               
              // // create marker node
              // var marker = JAK.mel("div");
              // marker.classList.add('marker')

              // // add marker to markerLayer
              // var marker = new SMap.Marker(lastCoords, null, {url:marker});
              // markerLayer.addMarker(marker);

              var radius = SMap.Coords.fromWGS84(lastCoords.x, lastCoords.y + 0.000025);

              var circleCoords2 = [
                  // shop,
                  lastCoords,
                  radius
              ];
              var circleOpts2 = {
                  color: "#FB4E23",
                  opacity: 1,
              };
              var circle2 = new SMap.Geometry(SMap.GEOMETRY_CIRCLE, null, circleCoords2, circleOpts2);
              geometryLayer.addGeometry(circle2);

          }

          // console.log(coords)
          var route = new SMap.Route(coords, renderRoute);      

          // update order item
          // updateOrder()
          
      });

    }  

       

  })  
          
}

var routeCoords = [
  // shop,
]
var optimalRoute = []


function renderDeliveryRoute() {

  var shop = SMap.Coords.fromWGS84(16.4673086, 49.7576875 );
  var maps = document.querySelectorAll('[data-order-map]')
  var rmap = document.querySelector('[data-route-map]')

  // render route
  
  
  var i = 1
  maps.forEach(function(map) {
  	
	var smap = map.querySelector('[data-map]'),
	    query = map.getAttribute('data-query')

	new SMap.Geocoder(query + ' Svitavy', function(geocoder) {

 	  var maps = document.querySelectorAll('[data-order-map]')
	  var validated = geocoder.getResults()[0].results;

	  // console.log(validated)

	  routeCoords.push(SMap.Coords.fromWGS84(validated[0].coords.x, validated[0].coords.y))
	  // console.log(i, maps.lentgh, routeCoords)

	  if(i == Object.keys(maps).length) {

	  	// reorder coords to optimize route based on distance between stops
	  	// var refCoords = routeCoords	  	
	  	var refCoords = []	  	
	  	for (i = 0; i < routeCoords.length; i++) {
		  refCoords[i] = routeCoords[i];
		}
	  	optimalRoute.push(shop)
  		
	  	
	  	// console.log('Finding optimal route:', refCoords, 'First cycle ...')

	  	// find closest to last optimal route elet from remaining
	  	function findOptimalRoute() {

	  		var closest = SMap.Coords.fromWGS84(0, 0 )
	  		var closestDistance = getDistance(optimalRoute.at(-1), closest)
	  		var closestIndex = 0

		  	refCoords.forEach(coord => {
		  		var coordDistance = getDistance(optimalRoute.at(-1), coord)

		  		closestDistance = getDistance(optimalRoute.at(-1), closest)
		  		closest = closestDistance < coordDistance ? closest : coord
		  		closestIndex = refCoords.indexOf(closest)

		  		// console.log('Point:', coord, coordDistance)
		  	})

		  	// console.log('Closest:', closestIndex, closest, closestDistance)
		  	var next = refCoords.splice(closestIndex,1)
		  	// console.log(next)
		  	optimalRoute.push(next[0])
		  	console.log(optimalRoute)

		  	// repeat if reference array not empty
		  	if(refCoords.length > 0) {
	  			// console.log('Next cycle ...')
		  		findOptimalRoute()
		  	} else {
	  			// console.log('Route optimized.', optimalRoute)
		  	}

	  	}

	  	findOptimalRoute()
	  	optimalRoute.push(shop)

	  	// routeCoords.push(shop)
	  	var route = new SMap.Route(optimalRoute, renderRoute, { criterion: "fast" });  
	  }

	  i++;

	});
	

  }) 

  function getDistance(coord1, coord2) {
	return Math.sqrt( Math.pow((coord1.x-coord2.x), 2) + Math.pow((coord1.y-coord2.y), 2) );
	}


  // render route
  var renderRoute = function(route) {

  	  console.log('Rendering route map ...')

      var coords = route.getResults().geometry;
      var lastCoords = coords[Object.keys(coords)[Object.keys(coords).length - 1]]

      // render map
      var m = new SMap(rmap, lastCoords, 18);
      m.addDefaultLayer(SMap.DEF_BASE).enable();
      // m.addDefaultControls();
      var cz = m.computeCenterZoom(coords);
      m.setCenterZoom(cz[0], cz[1]);
      
      // add route line geometry layer
      var geometryLayer = new SMap.Layer.Geometry();
      m.addLayer(geometryLayer).enable();

      var lineOpts = {
          color: "#FB4E23",
          width: 4
      };
      var g = new SMap.Geometry(SMap.GEOMETRY_POLYLINE, null, coords, lineOpts);
      geometryLayer.addGeometry(g);

      // create marker layer
      var markerLayer = new SMap.Layer.Marker();
      m.addLayer(markerLayer).enable();
       
      // foo each stop add numeric marker...
      var markerRoute = []
      for (i = 0; i < optimalRoute.length; i++) {
		  markerRoute[i] = optimalRoute[i];
		}

	  markerRoute.shift()
	  markerRoute.pop()

      markerRoute.forEach((destCoords) => {

      	// create marker node
      	var marker = JAK.mel("div");
      	marker.classList.add('marker')
      	var index = markerRoute.indexOf(destCoords) + 1
      	marker.innerHTML = index;

      	// add marker to markerLayer
      	var marker = new SMap.Marker(destCoords, null, {url:marker});
      	markerLayer.addMarker(marker);

      	// create point
		// var radius = SMap.Coords.fromWGS84(destCoords.x, destCoords.y + 0.5/Math.pow(m.getZoom(),3));

		// var circleCoords2 = [
		//   // shop,
		//   destCoords,
		//   radius
		// ];
		// var circleOpts2 = {
		//   color: "#FB4E23",
		//   opacity: 1,
		// };
		
		// var circle2 = new SMap.Geometry(SMap.GEOMETRY_CIRCLE, null, circleCoords2, circleOpts2);
		// geometryLayer.addGeometry(circle2);

		// var radius = SMap.Coords.fromWGS84(destCoords.x, destCoords.y + 1.5/Math.pow(m.getZoom(),3));

		// var circleCoords2 = [
		//   // shop,
		//   destCoords,
		//   radius
		// ];
		// var circleOpts2 = {
  //         color: "#FB4E23",
  //         opacity: 0.1,
  //         outlineColor: "#FB4E23",
  //         outlineOpacity: 0.1,
  //         outlineWidth: 2
  //     	};
		// var circle2 = new SMap.Geometry(SMap.GEOMETRY_CIRCLE, null, circleCoords2, circleOpts2);
		// geometryLayer.addGeometry(circle2);
      
      })


      // add shop location marker
      var marker = JAK.mel("div");
      marker.classList.add('marker')
      marker.classList.add('--shop')

      // add marker to markerLayer
      var marker = new SMap.Marker(shop, null, {url:marker});
      markerLayer.addMarker(marker);

      // var radius = SMap.Coords.fromWGS84(shop.x, shop.y + 0.5/Math.pow(m.getZoom(),3));

      // var circleCoords2 = [
      //   // shop,
      //   shop,
      //   radius
      // ];
      // var circleOptsShop = {
      //   color: "#000",
      //   opacity: 1,
      // };
      // var circleShop = new SMap.Geometry(SMap.GEOMETRY_CIRCLE, null, circleCoords2, circleOptsShop);
      // geometryLayer.addGeometry(circleShop);


      // render route url
      var urlRoute = optimalRoute

      var smapUrl = new SMap.URL.Route().addStart(urlRoute.shift()).addDestination(urlRoute.pop())
       
      // foo each stop
      urlRoute.forEach((destCoords) => {

      	// create url waitpoint
      	smapUrl.addWaypoint(destCoords, {
      		'poi': 'muni'
      	})

      })

      // document.querySelector('[data-route-url]').setAttribute("href", smapUrl.toString());

      // render duration and distance

      var distance = (route.getResults().length / 1000).toFixed(2) + ' km'
      var duration = route.getResults().time.toString().toHHMMSS()

      document.querySelector('[data-route-distance]').innerHTML = distance;
      document.querySelector('[data-route-duration]').innerHTML = duration;


      // var circleCoords = [
      //     // shop,
      //     lastCoords,

      //     // destinations
      //     destination
      // ];
      // var circleOpts = {
      //     color: "#FB4E23",
      //     opacity: 0.1,
      //     outlineColor: "#FB4E23",
      //     outlineOpacity: 0.1,
      //     outlineWidth: 2
      // };
      // var circle = new SMap.Geometry(SMap.GEOMETRY_CIRCLE, null, circleCoords, circleOpts);
      // geometryLayer.addGeometry(circle);


  }

  // var routeCoords = [
  //     SMap.Coords.fromWGS84(14.434, 50.084),
  //     SMap.Coords.fromWGS84(16.600, 49.195)
  // ];

          
}

