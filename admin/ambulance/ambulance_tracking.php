<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>CHMC Ambulance Tracking</title>
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.js"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.0/mapbox-gl-directions.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.0/mapbox-gl-directions.css" rel="stylesheet">
    <style>
        body { margin: 0; padding: 0; }
        #map { position: absolute; top: 0; bottom: 0; width: 100%; }
        .buttons-container { position: absolute; bottom: 50px; left: 50%; transform: translateX(-50%); background-color: white; padding: 10px; border-radius: 5px; display: flex; gap: 10px; }
        .button { padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div id="map"></div>
    <div class="buttons-container">
    <button class="button" id="listAmbulances">List CHMC ambulances</button>
    <button class="button" id="listAlternativeHospitals">(Data Mining) List hospitals</button>
    </div>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiamF6ejQxamF6ejA0IiwiYSI6ImNsdGtydGVodzExM3oya3FvbXQ4aGh1dXEifQ.CWci4RgLdQT2B0QHzHIw5Q';

        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v12',
            center: [121.06061512815785, 14.73342751148865], // Starting at CHMC Hospital
            zoom: 14 // Default zoom level
        });

        map.on('load', () => {
            // Add a marker for the CHMC Hospital
            new mapboxgl.Marker({ color: 'red' })
                .setLngLat([121.06061512815785, 14.73342751148865])
                .setPopup(new mapboxgl.Popup().setText('CHMC Hospital'))
                .addTo(map);

            if ("geolocation" in navigator) {
                console.log("geolocation available");
                navigator.geolocation.getCurrentPosition((position) => {
                    const clientLat = position.coords.latitude;
                    const clientLon = position.coords.longitude;

                    // Add a marker for the client's current location
                    new mapboxgl.Marker({ color: 'blue' })
                        .setLngLat([clientLon, clientLat])
                        .setPopup(new mapboxgl.Popup().setText('Your Location'))
                        .addTo(map);

                    // Draw a route from CHMC Hospital to the client's current location
                    const directions = new MapboxDirections({
                        accessToken: mapboxgl.accessToken,
                        unit: 'metric',
                        profile: 'mapbox/driving'
                    });

                    map.addControl(directions, 'top-left');

                    directions.setOrigin([121.06061512815785, 14.73342751148865]); // CHMC Hospital
                    directions.setDestination([clientLon, clientLat]); // Client's location
                });
            } else {
                console.log("geolocation not available");
            }
        });

    // Button event listeners

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
