<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>CHMC Ambulance Tracking</title>
  </head>
  <body>
    <script>
      if ("geolocation" in navigator) {
        console.log("geolocation available");
        navigator.geolocation.getCurrentPosition((position) => {
          const lat = position.coords.latitude;
          const lon = position.coords.longitude;
          document.getElementById("latitude").textContent = lat;
          document.getElementById("longitude").textContent = lon;
          // console.log(position);

          const data = { lat, lon };
          const options = {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
          };
          fetch ('/api', options);  
        });
      } else {
        console.log("geolocation not available");
      }
    </script>

    <h1>CHMC Ambulance Tracking App</h1>
    <p>
      latitude: <span id="latitude"></span>&deg;<br />
      longitude: <span id="longitude"></span>&deg;
    </p>
  </body>
</html>