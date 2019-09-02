mapboxgl.accessToken = 'pk.eyJ1IjoibmF0aGFzZW5zZWkiLCJhIjoiY2p3cWM3czRlMDFpbDQ1cDZpb2d4ZnY0NyJ9.tWZI8jmVY33ao20AauBnWA' ;

var geojson = {
  "type": "FeatureCollection",
  "features": [{
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [2.36877, 48.6102]
      },
      "properties": {
        "title": "Depot",
        "description": "Site de Bondoufle"
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [2.54, 48.61]
      },
      "properties": {
        "title": "1er point",
        "description": "C ma ville"
      }
    }
  ]
};

var map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/light-v9',
  center: [2.36877, 48.6102],
  zoom: 10
});

// add markers to map
geojson.features.forEach(function(marker, i) {
    var n = 0;
    // create a HTML element for each feature
    var el = document.createElement('div');
    el.className = 'marker';
    el.innerHTML = '<span><b>' + (i + n) + '</b></span>'

    // make a marker for each feature and add it to the map
    new mapboxgl.Marker(el)
        .setLngLat(marker.geometry.coordinates)
        .setPopup(new mapboxgl.Popup({
            offset: 25
        }) // add popups
        .setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
        .addTo(map);
    n++;
});

function $_GET(param) {
  var vars = {};
  window.location.href.replace( location.hash, '' ).replace( 
    /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
    function( m, key, value ) { // callback
      vars[key] = value !== undefined ? value : '';
    }
  );

  if ( param ) {
    return vars[param] ? vars[param] : null;	
  }
  return vars;
}