<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>HRIS Attendance</title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300" rel="stylesheet" type="text/css">

        <link href="<?php echo base_url(); ?>assets/css/index.css" rel="stylesheet" type="text/css">
        
        <style type="text/css">
         .formpeta{
           display: none;
            }
        </style>
    <body>
        <section id="wrapper">
            <header>
                <h1>Welcome HRIS Attendance Web Base Aplication</h1>
            </header>
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
            <article>
                <span id="button">
                    <a href="#" id="ahref">Clock Out</a>
                </span><br>
                <span id="status"></span>
            </article>  
            <script>
                $("#button").click(function() {
                    function success(position) {
                        var s = document.querySelector('#status');

                        if (s.className == 'success') {
                            // not sure why we're hitting this twice in FF, I think it's to do with a cached result coming back  

                            return;

                        }

                        s.innerHTML = "Lokasi telah ditemukan";
                        s.className = 'success';

                        var mapcanvas = document.createElement('div');
                        mapcanvas.id = 'mapcanvas';
                        mapcanvas.style.height = '400px';
                        mapcanvas.style.width = '100%';

                        document.querySelector('article').appendChild(mapcanvas);

                        var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

                        
                        $('.formpeta').show();
                        
                        var latz = position.coords.latitude;
                        var longz = position.coords.longitude;
                        $('#latz1').attr('value',latz);
                        $('#longz1').attr('value',longz);

                        var myOptions = {
                            zoom: 18,
                            center: latlng,
                            mapTypeControl: false,
                            navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        var map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);
                        //info windows
                        var infowindow = new google.maps.InfoWindow({
                            content:'Latitude :'+position.coords.latitude+'<br>longitude :'+position.coords.longitude
                          });

                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            title: 'Anda ada di latitude ' + position.coords.latitude + ' dan longitude' + position.coords.longitude + ')'
                        });

                        //alert
                        marker.addListener('click', function() {
                            infowindow.open(map, marker);
                          });

                        //ad circle
                        var cityCircle = new google.maps.Circle({
                          strokeColor: '#FF0000',
                          strokeOpacity: 0.8,
                          strokeWeight: 2,
                          fillColor: '#FF0000',
                          fillOpacity: 0.35,
                          map: map,
                          center: {lat: -6.165650599999999, lng:106.8418792},
                          radius:18
                        });


                        function CalculateDistance(lat1, long1, lat2, long2) {
                            // Translate to a distance
                            var distance =
                              Math.sin(lat1 * Math.PI) * Math.sin(lat2 * Math.PI) +
                              Math.cos(lat1 * Math.PI) * Math.cos(lat2 * Math.PI) * Math.cos(Math.abs(long1 - long2) * Math.PI);

                            // Return the distance in miles
                            //return Math.acos(distance) * 3958.754;

                            // Return the distance in meters
                            return Math.acos(distance) *199;
                            var a=Math.acos(distance)*100;
                            alert ('tes'+a);
                        } // CalculateDistance
                        // The target longitude and latitude
                        var targetlong =106.8418792;
                        var targetlat =-6.165650599999999;

                        // Start an interval every 1s
                        var OurInterval = setInterval(OnInterval, 1000);
                        // Call this on an interval
                        function OnInterval() {
                          // Get the coordinates they are at
                          var lat = position.coords.latitude;
                          var long = position.coords.longitude;
                          var distance = CalculateDistance(targetlat, targetlong, lat, long);

                          // Is it in the right distance? (50m)
                          if (distance <= 50) {
                            // Stop the interval
                            stopInterval(OurInterval);
                            //didalam lokasi pt drife
                            //alert('didalam');
                          }else{
                            //diluar lokasi pt drife
                            //alert('diluar');
                            window.alert('Diluar !!!');
                            owindow.location.href="<?php echo base_url() ?>index.php/test/out";
                          }
                        }

                    } 
                    function error(msg) {
                        var s = document.querySelector('#status');
                        s.innerHTML = typeof msg == 'string' ? msg : "failed";
                        s.className = 'fail';

                        // console.log(arguments);
                    }
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(success, error);
                    } else {
                        error('not supported');
                    }
                });
            </script>
            <br><br>
            <div style="margin-left:160px;">
                
                <?php 
                    $attributes = array('class' => 'formpeta');
                    echo form_open_multipart('test/act_clockout',$attributes);
                ?>
                <table width="100%">
                    <tr>
                        <td>Your Email</td><td>:</td>
                        <td><input size="30" name="email" type="text"value="<?php echo $email; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Longitude</td><td>:</td>
                        <td><input size="30" name="long" type="text" id="longz1" readonly></td>
                    </tr>
                    <tr>
                        <td>Latitude</td><td>:</td>
                        <td><input size="30" name="lat" type="text" id="latz1" readonly></td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="submit" value="Clock Out"></td>
                    </tr>
                </table>
                
                <?php 
                echo form_close();
                ?>

            </div>
    </body>
</html>