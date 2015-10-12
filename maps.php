<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>HTML5 Geolocation</title>
        <script type="text/javascript" src="jquery.min.js"></script></script>
        <script type="text/javascript" src="calendergoogle.js"></script>
        <script src="https://apis.google.com/js/client.js?onload=checkAuth"></script>
    </head>
    <body>
        <section id="wrapper">
            <header>
                <h1>Clock in Meeting</h1>
            </header>
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
            <article>
                <span id="button">
                    <a href="#" id="ahref">Clock In</a>
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
                        mapcanvas.style.width = '560px';

                        document.querySelector('article').appendChild(mapcanvas);

                        var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

                        
                        $('.formpeta').show();
                        var latz = position.coords.latitude;
                        var longz = position.coords.longitude;
                        $('#latz1').attr('value',latz);
                        $('#longz1').attr('value',longz);

                        var myOptions = {
                            zoom: 15,
                            center: latlng,
                            mapTypeControl: false,
                            navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        var map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);

                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            title: 'Anda ada di latitude ' + position.coords.latitude + ' dan longitude' + position.coords.longitude + ')'
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
            <br><br><br>
            <div id="authorize-div" style="display: none">
              <button id="authorize-button" onclick="handleAuthClick(event)">
                Authorize
              </button>
            </div><br>
            <form action="test.php" method="post" style="display:none;" class="formpeta">
            longitude :<input name="lat" type="text" id="latz1" readonly><br>
            latitude  :<input name="long" type="text" id="longz1" readonly><br>
            <!-- <form action="testcal.php" method="post" id="formcal"> -->
             <select id='events' name="even" required>
             </select><br>
            <input type="submit">
            </form>
    </body>
</html>