<html>
<head>
	<title>Demo Geocode</title>
	<script src="http://maps.google.com/maps/api/js"></script>
	<script type="text/javascript">
		var geocoder;
		var map;
	function initialize() {  
		geocoder = new google.maps.Geocoder();
			var latlng = new google.maps.LatLng(-6.211544000000000000, 106.845172000000050000);
			var mapOptions = {
		    zoom: 8,
		    center: latlng
		  }
		  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		}

	function geocodeLokasi() {
		  var address = document.getElementById('alamat').value;
		  geocoder.geocode( { 'address': address}, function(results, status) {
		    if (status == google.maps.GeocoderStatus.OK) {
		      map.setCenter(results[0].geometry.location);
		      var marker = new google.maps.Marker({
		          map: map,
		          position: results[0].geometry.location      	  
		      });
		      var lat = results[0].geometry.location.lat();
		      var lng = results[0].geometry.location.lng();
		    } else {
		      alert('Geocode was not successful for the following reason: ' + status);
		    }
		      document.getElementById("lat").value = lat;      
		      document.getElementById('lng').value=lng;    
		  });
}

		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
</head>
<body>
<center>
	<h2>Demo Geocode<span style="font-size: 12px; font-style: italic; opacity: 0.7"> by @hasyemiraws</span></h2>
	<label>Alamat: </label><input type="text" onchange="geocodeLokasi()" id="alamat"><br><br>
	<label>Lat: </label><input type="text" id="lat"> <label>Long: </label><input type="text" id="lng">
	<div id="map-canvas" style="width: 500px; height: 500px; margin-top: 20px">
	</div>
</center>
</body>
</html>
