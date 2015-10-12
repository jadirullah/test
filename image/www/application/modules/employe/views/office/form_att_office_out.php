<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span6">
                    <!--isi kontent-->
                    <div class="container">
                        <div class="widget center">
                            <div class="widget-header">
                                <i></i>
                                <h3>Clock Out Page</h3>
                            </div>
                            <div class="widget-content">
                                <div class="table_responsive">
                                        <div class="top-search">
                                            <article align="center">
                                                <span id="button" style="margin:auto;">
                                                    <a href="#" id="ahref" class="btn btn-info btn-large">Clock Out Office</a>
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
                                                        mapcanvas.style.height = '250px';
                                                        mapcanvas.style.width = '70%';
                                                        mapcanvas.style.margin='auto';

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


                                                        //add marker position 
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
                                                          radius:55
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

                                                          // Is it in the right distance? (200m)
                                                          if (distance <= 10) {
                                                            // Stop the interval
                                                            //stopInterval(OurInterval);
                                                            //didalam lokasi pt drife
                                                            //alert('didalam');

                                                            // Do something here cause they reached their destination
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
                                            <?php                                             
								                    $attributes = array('class' => 'formpeta');
								                    echo form_open_multipart('employe/office/act_clockout',$attributes);								        
                                            ?>
                                                    <div class="control-group">                     
                                                        <label class="control-label" for="level">Your Email :</label>
                                                        <div class="controls">                                                          
                                                            <input size="30" name="email" class="span3" type="text"value="<?php echo $email; ?>" readonly>
                                                        </div> <!-- /controls -->       
                                                    </div> <!-- /control-group -->                               
                                                   
                                                    <div class="control-group">                     
                                                        <label class="control-label" for="reason">Longitude :</label>
                                                        <div class="controls"> 
                                                            <input size="30" name="long" type="text" id="longz1" readonly>                                                     
                                                        </div> <!-- /controls -->       
                                                    </div> <!-- /control-group -->
                                                    <div class="control-group">                     
                                                        <label class="control-label" for="reason">Latitude :</label>
                                                        <div class="controls"> 
                                                            <input size="30" name="lat" type="text" id="latz1" readonly>                                                     
                                                        </div> <!-- /controls -->       
                                                    </div> <!-- /control-group -->

                                                    <div class="control-group">
                                                        <div class="controls"> 
                                                            <button type="submit" class="btn btn-primary">Clock Out</button> 
                                                            <a href="<?php echo base_url(); ?>index.php/employe/home" class="btn">Cancel</a>
                                                        </div> <!-- /controls -->       
                                                    </div> <!-- /control-group -->
                                                <!-- Isi Form Clockin Late -->
                                                <?php 
                                                echo form_close();
                                                
                                             	?>
                                            
                                        </div>
                                </div>
                            </div>
                            <!--tutup isi kontent-->
                        </div>
                    </div>
                    <!-- /row --> 
                </div>
                <!-- /container --> 
            </div>
            <!-- /main-inner --> 
        </div>
        <!-- /main -->
    </div>
</div>
<div class="extra">

    <!-- /extra-inner --> 
</div>

