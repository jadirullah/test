<style type="text/css">
.error{
    color: red;
}
</style>
<script src="<?php echo base_url(); ?>assets/js/calendergoogle.js"></script>        
<script src="https://apis.google.com/js/client.js?onload=checkAuth"></script>
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
                                <h3>Clock In On Site</h3>
                            </div>
                            <div class="widget-content">
                                <div class="table_responsive">
                                        <div class="top-search">
                                            <article align="center">
                                                <span id="button" style="margin:auto;">
                                                    <a href="#" id="ahref" class="btn btn-info btn-large">Clock In On Site</a>
                                                </span><br>
                                                <span id="status"></span>
                                                <br>
                                                <div id="authorize-div" style="display: none">
                                                  <button id="authorize-button" class="btn btn-primary" onclick="handleAuthClick(event)">
                                                    Authorize
                                                  </button>
                                                </div>
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
								                    $attributes = array('class' => 'formpeta','id'=>'myform');
								                    echo form_open_multipart('employe/onsite/act_clockin',$attributes);								        
                                            ?>
                                                    <div class="control-group">                     
                                                        <label class="control-label" for="level">Your Email :</label>
                                                        <div class="controls">                                                          
                                                            <input size="30" name="email" class="span3" type="text"value="<?php echo $email; ?>" readonly>
                                                        </div> <!-- /controls -->       
                                                    </div> <!-- /control-group -->   

                                                    <div class="control-group">                     
                                                        <label class="control-label" for="meeting">Event ? :</label>
                                                        <div class="controls">                                                          
                                                            <select id='events' name="reason_onsite" required>
                                                                <option value>None</option>
                                                            </select>
                                                        </div> <!-- /controls -->       
                                                    </div>                             
                                                   
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
                                                            <button type="submit" class="btn btn-primary">Clock In</button> 
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

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
<script>
// just for the demos, avoids form submit
// jQuery.validator.setDefaults({
//   debug: true,
//   success: "valid"
// });
$( "#myform" ).validate({
  rules: {
    userfile1: {
      required: true,
      accept: "image/*"
    }
  }
  
});
</script>