<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Add live realtime data</title>
<meta name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1,user-scalable=no">
<link href="https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.js"></script>
<style>
body { margin: 0; padding: 0; }
#map { position: absolute; top: 0; bottom: 10%; width: 100%; right: 0; }
.buttons-container { position: absolute; bottom: 50px; left: 50%; transform: translateX(-50%); background-color: white; padding: 10px; border-radius: 5px; display: flex; gap: 10px; }
.button { padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
.button:hover { background-color: #0056b3; }
</style>
</head>
<body>
<div id="map"></div>
<div class="buttons-container">
    <button class="button" id="needAmbulance">Need an ambulance</button>
    <button class="button" id="listAmbulances">List CHMC ambulances</button>
    <button class="button" id="listAlternativeHospitals">(Data Mining) List hospitals</button>
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
    // Get the initial location of the client.
    navigator.geolocation.getCurrentPosition(async (position) => {
        const { latitude, longitude } = position.coords;
        // Fly the map to the client's location.
        map.flyTo({
            center: [longitude, latitude],
            speed: 0.5
        });
        // Add a marker at the client's location.
        new mapboxgl.Marker()
            .setLngLat([longitude, latitude])
            .addTo(map);
    }, (error) => {
        console.error('Error getting location:', error);
    });
});

// Button event listeners
document.getElementById('needAmbulance').addEventListener('click', () => {
    // Code to handle when "Need an ambulance" button is clicked
    alert('Your request for a dedicated CHMC ambulance has been sent. Hang tight! If you are in a dangerous/life-threatening situation or involved in a crime scene, please call QCPD at 0917-840-3925. Please Note Your Reference #: CHF4F');
    // Navigate to index.html within the same website structure
    window.location.href = "index.php?page=ambulance/ambulance_tracking";
});

document.getElementById('listAmbulances').addEventListener('click', () => {
    // Code to handle when "List CHMC ambulances" button is clicked
    alert('A list of available dedicated CHMC ambulances will be displayed. ETA to your exact location is provided for each ambulance.');
    // Navigate to ambulance_chmc within the same website structure
    window.location.href = "index.php?page=ambulance/ambulance_chmc";
});

document.getElementById('listAlternativeHospitals').addEventListener('click', () => {
    // Code to handle when "List of alternative hospitals with ambulatory services" button is clicked
    alert('A comprehensive data-mined list of nearby alternative hospitals with emergency and ambulatory services will be displayed. Please Choose the nearest hospital from your location.');
    // Navigate to ambulance_other within the same website structure
    window.location.href = "index.php?page=ambulance/ambulance_other";
});
</script>

</body>
</html>
