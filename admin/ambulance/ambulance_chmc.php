<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>CHMC Ambulance Route</title>
<meta name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1,user-scalable=no">
<link href="https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.js"></script>
<style>
body { margin: 0; padding: 0; }
#map { position: absolute; top: 0; bottom: 0; width: 100%; }
#eta {
  position: absolute;
  top: 50%; /* Move to the vertical center */
  left: 50%; /* Move to the horizontal center */
  transform: translate(-50%, -50%); /* Center horizontally and vertically */
  background: white;
  padding: 10px;
  border-radius: 5px;
  font-family: Arial, sans-serif;
}

.buttons-container {
  position: absolute;
  bottom: 50px; /* Keep the buttons 50px from the bottom */
  left: 50%; /* Center horizontally */
  transform: translateX(-50%);
  background-color: white;
  padding: 10px;
  border-radius: 5px;
  display: flex;
  gap: 10px;
}

.button {
  padding: 10px 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.button:hover {
  background-color: #0056b3;
}

</style>
</head>
<body>
<div id="map"></div>
<div id="eta">Calculating ETA...</div>
<div class="buttons-container">
    <button class="button" id="needAmbulance">Need an ambulance</button>
    <button class="button" id="listAlternativeHospitals">(Data Mining) List hospitals</button>
</div>
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiamF6ejQxamF6ejA0IiwiYSI6ImNsdGtydGVodzExM3oya3FvbXQ4aGh1dXEifQ.CWci4RgLdQT2B0QHzHIw5Q';
const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v12',
    zoom: 12 // Default zoom level
});

const chmcHospital = [121.06061512815785, 14.73342751148865]; // CHMC Hospital coordinates

map.on('load', async () => {
    // Add CHMC Hospital marker
    new mapboxgl.Marker()
        .setLngLat(chmcHospital)
        .addTo(map);

    // Get the client's location
    navigator.geolocation.getCurrentPosition(async (position) => {
        const { latitude, longitude } = position.coords;
        const clientLocation = [longitude, latitude];
        
        // Fly the map to the client's location
        map.flyTo({
            center: clientLocation,
            speed: 0.5
        });

        // Add client location marker
        new mapboxgl.Marker()
            .setLngLat(clientLocation)
            .addTo(map);

        // Fetch route from CHMC Hospital to client location
        const query = await fetch(`https://api.mapbox.com/directions/v5/mapbox/driving/${chmcHospital[0]},${chmcHospital[1]};${clientLocation[0]},${clientLocation[1]}?geometries=geojson&access_token=${mapboxgl.accessToken}`);
        const data = await query.json();
        const route = data.routes[0].geometry;
        const eta = data.routes[0].duration; // Duration in seconds

        // Convert ETA to minutes
        const etaMinutes = Math.round(eta / 60);

        // Display ETA
        document.getElementById('eta').innerText = `Estimated Time of Arrival: ${etaMinutes} minutes`;

        // Add the route as a source
        map.addSource('route', {
            'type': 'geojson',
            'data': {
                'type': 'Feature',
                'properties': {},
                'geometry': route
            }
        });

        // Add the route as a layer
        map.addLayer({
            'id': 'route',
            'type': 'line',
            'source': 'route',
            'layout': {
                'line-join': 'round',
                'line-cap': 'round'
            },
            'paint': {
                'line-color': '#888',
                'line-width': 6
            }
        });
    }, (error) => {
        console.error('Error getting location:', error);
        document.getElementById('eta').innerText = 'Error calculating ETA.';
    });
});

// Button event listeners
document.getElementById('needAmbulance').addEventListener('click', () => {
    alert('Your request for a dedicated CHMC ambulance has been sent. Hang tight! If you are in a dangerous/life-threatening situation or involved in a crime scene, please call QCPD at 0917-840-3925.');
    window.location.href = "index.php?page=ambulance/ambulance_tracking";
});

document.getElementById('listAlternativeHospitals').addEventListener('click', () => {
    alert('A comprehensive data-mined list of nearby alternative hospitals with emergency and ambulatory services will be displayed. Please Choose the nearest hospital from your location.');
    window.location.href = "index.php?page=ambulance/ambulance_other";
});
</script>

</body>
</html>
