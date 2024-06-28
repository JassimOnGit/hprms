<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Add live realtime data</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link href="https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.js"></script>
<style>
body { margin: 0; padding: 0; }
#map { position: absolute; top: 0; bottom: 10%; width: 100%; right: 0; }
.buttons-container { position: absolute; bottom: 50px; left: 50%; transform: translateX(-50%); background-color: white; padding: 10px; border-radius: 5px; display: flex; gap: 10px; }
.button { padding: 10px 20px; color: white; border: none; border-radius: 5px; cursor: pointer; }
.button-red { background-color: #ff0000; }
.button-red:hover { background-color: #cc0000; }
.button-grey { background-color: #808080; }
.button-grey:hover { background-color: #666666; }
</style>
</head>
<body>
<div id="map"></div>
<div class="buttons-container">
    <button class="button button-red" id="needAmbulance">1 Emergency Call On Hold, Respond?</button>
    <button class="button button-grey" id="listAmbulances">Go Offline</button>
</div>

<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiamF6ejQxamF6ejA0IiwiYSI6ImNsdGtydGVodzExM3oya3FvbXQ4aGh1dXEifQ.CWci4RgLdQT2B0QHzHIw5Q';
const map = new mapboxgl.Map({
    container: 'map',
    // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
    style: 'mapbox://styles/mapbox/streets-v12',
    zoom: 12 // Default zoom level
});

map.on('load', async () => {
    // CHMC Hospital coordinates
    const chmcHospital = [121.06061512815785, 14.73342751148865];

    // Fly the map to the CHMC Hospital location.
    map.flyTo({
        center: chmcHospital,
        speed: 0.5
    });

    // Add a marker at the CHMC Hospital location.
    new mapboxgl.Marker()
        .setLngLat(chmcHospital)
        .addTo(map);
});

// Button event listeners
document.getElementById('needAmbulance').addEventListener('click', () => {
    // Code to handle when "Need an ambulance" button is clicked
    alert('Go Now! Save Lives! Note your emergency call reference # is: CHF4F');
    // Navigate to index.html within the same website structure
    window.location.href = "index.php?page=ambulance_doctor/ambulance_tracking_MD";
});

document.getElementById('listAmbulances').addEventListener('click', () => {
    // Code to handle when "List CHMC ambulances" button is clicked
    alert('You will now switch to offline mode, please be sure to go online when you are ready to respond to emergency calls.');
    // Navigate to ambulance_chmc within the same website structure
    window.location.href = "index.php?page=ambulance_doctor/ambulance_chmc_MD";
});

</script>

</body>
</html>
