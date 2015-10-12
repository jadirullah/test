<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Directions service</title>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
      #panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
      }

      /**
       * Provide the following styles for both ID and class, where ID represents an
       * actual existing "panel" with JS bound to its name, and the class is just
       * non-map content that may already have a different ID with JS bound to its
       * name.
       */

      #panel, .panel {
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #panel select, #panel input, .panel select, .panel input {
        font-size: 15px;
      }

      #panel select, .panel select {
        width: 100%;
      }

      #panel i, .panel i {
        font-size: 12px;
      }
    </style>
    
  </head>
  <body>
    <div id="panel">
    <b>Start: </b>
    <select id="start" onchange="calcRoute();">
      <option value="Jakarta">Jakarta</option>
      <option value="Bekasi">Bekasi</option>
      <option value="Bandung">Bandung</option>
      <option value="Surabaya">Surabaya</option>
      <option value="Jogyakarta">Jogyakarta</option>
      <option value="Banten">Banten</option>
    </select>
    <b>End: </b>
    <select id="end" onchange="calcRoute();">
      <option value="Bekasi">Bekasi</option>
      <option value="Bandung">Bandung</option>
      <option value="Surabaya">Surabaya</option>
      <option value="Jogyakarta">Jogyakarta</option>
      <option value="Banten">Banten</option>
    </select>
    </div>
    <div id="map"></div>
    <script>
function initMap() {
  var directionsService = new google.maps.DirectionsService;
  var directionsDisplay = new google.maps.DirectionsRenderer;
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 7,
    center: {lat: 118.0148634, lng: -2.548926}
  });
  directionsDisplay.setMap(map);

  var onChangeHandler = function() {
    calculateAndDisplayRoute(directionsService, directionsDisplay);
  };
  document.getElementById('start').addEventListener('change', onChangeHandler);
  document.getElementById('end').addEventListener('change', onChangeHandler);
}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
  directionsService.route({
    origin: document.getElementById('start').value,
    destination: document.getElementById('end').value,
    travelMode: google.maps.TravelMode.DRIVING
  }, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?signed_in=true&callback=initMap"async defer></script>
  </body>
</html>