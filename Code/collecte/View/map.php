<!DOCTYPE html>
   <html>
   <head>
        <meta charset='utf-8' />
        <title>Test</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.52.0/mapbox-gl.js'></script>
        <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.52.0/mapbox-gl.css' rel='stylesheet' />

       <style>
            body {
                margin: 0;
                padding: 0;
            }

            #map {
                position: absolute;
                top: 0;
                bottom: 0;
                width: 100%;
            }

            .marker {width:0; height:0;}

            .marker  span {
                display:flex;
                justify-content:center;
                align-items:center;
                box-sizing:border-box;
                width: 30px;
                height: 30px;
                color:#fff;
                background: #693;
                border:solid 2px;
                border-radius: 0 70% 70%;
                box-shadow:0 0 2px #000;
                cursor: pointer;
                transform-origin:0 0;
                transform: rotateZ(-135deg);
            }

            .marker b {transform: rotateZ(135deg)}

            .mapboxgl-popup {
                max-width: 200px;
            }

            .mapboxgl-popup-content {
                text-align: center;
                font-family: 'Open Sans', sans-serif;
            }
        </style>

   </head>
   <body>        

   <div id='map'>
        <script src="map.js"></script>
   </div>

   </body>
   </html>