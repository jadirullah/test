<script type="text/javascript"
src="http://maps.google.com/maps/api/j…
</script>
<script type="text/javascript">
var map;
var marker;
var setmarker = false;
var infowindow = new google.maps.InfoWindow();
var geocoder;
function initialize() {
geocoder = new google.maps.Geocoder();
var myLatlng = new google.maps.LatLng(20.673263, -103.358688);
var myOptions = {
zoom: 10,
center: myLatlng,
disableDefaultUI: true,
mapTypeId: google.maps.MapTypeId.ROADMAP
}
//ubicacion = codeLatLng(myLatlng); <----------------when uncommented, page doesn't go beyond this point, just stays blank

map = new google.maps.Map(document.getElementById(… myOptions);

google.maps.event.addListener(map, 'click', function(event) {
placeMarker(event.latLng);
});

}

function codeLatLng(latlong) { //<----------- I think the problem is in this part of the code
var input = latlong
var latlngStr = input.split(",",2);
var lat = parseFloat(latlngStr[0]);
var lng = parseFloat(latlngStr[1]);
var latlng = new google.maps.LatLng(lat, lng);
geocoder.geocode({'latLng': latlng}, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
if (results[0]) {
ubic = results[0].formatted_address;
return ubic;
}
} else {
alert("Geocoder failed due to: " + status);
}
});
}

function placeMarker(location) {
var clickedLocation = new google.maps.LatLng(location);
marker = new google.maps.Marker({
position: location,
map: map
});
infowindow.setContent("Ubicación:"); //<----I inserted this comment to see if this part was working, the "ubicacion" variable should be here instead of this comment.
infowindow.open(map, marker);
map.setCenter(location);
}

</script>
</head>
<body onload="initialize()">
<div id="map_canvas" style="width:100%; height:100%"></div>
</body>