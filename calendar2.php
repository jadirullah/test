<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
</head>
<body>
 <!--Add a button for the user to click to initiate auth sequence -->
 <button id="authorize-button" style="visibility: hidden">Authorize</button>
 <button id="insert-button" style="visibility: hidden">Insert</button>
 <script type="text/javascript">
      
      var clientId = '912727436320-32dosbst52cealepdv4gus9lnan4fnvi.apps.googleusercontent.com';
      var apiKey = 'AIzaSyDvDqskury3LLEymjc0JH_nic_fUIgsGbA';

      // To enter one or more authentication scopes, refer to the documentation for the API.
      var scopes = 'https://www.googleapis.com/auth/calendar';
    
      // Use a button to handle authentication the first time.
      function handleClientLoad() {
        gapi.client.setApiKey(apiKey);
        window.setTimeout(checkAuth,1);
      }

      function checkAuth() {
        gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: true}, handleAuthResult);
      }


      function handleAuthResult(authResult) {
        var authorizeButton = document.getElementById('authorize-button');
        if (authResult && !authResult.error) {
          authorizeButton.style.visibility = 'hidden';
          makeApiCall();
          
        } else {
          authorizeButton.style.visibility = '';  
          authorizeButton.onclick = handleAuthClick;
        }
      }

      function handleAuthClick(event) {
        gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthResult);
        return false;
      }
    
      function makeApiCall() {
       gapi.client.load('calendar', 'v3', function() {
         var request = gapi.client.calendar.events.list({
           'calendarId': 'primary'
         });
              
         request.execute(function(resp) {
           for (var i = 0; i < resp.items.length; i++) {
             
             var option = document.createElement('option');
            
             option.appendChild(document.createTextNode(resp.items[i].summary));
             document.getElementById('events').appendChild(option);
           }
         });
       });
     }
    </script>
 <script
  src="https://apis.google.com/js/client.js?onload=handleClientLoad"></script>
 <div id='content'>
  <h1>Events</h1>
 

<select id='events'>

</select>
 <p>Connecting to Google Calendar with the Javascript Library.</p>
</body>
</html>