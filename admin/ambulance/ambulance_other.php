<!DOCTYPE html>
<html>
<head>
    <title>Embedded Google Map</title>
    <style>
        body { margin: 0; padding: 0; font-family: Arial, sans-serif; }
        .intro-text-container { display: flex; justify-content: center; background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .intro-text { text-align: center; background-color: #007bff; padding: 20px; border-radius: 10px; color: white; }
        .intro-text p { font-size: 18px; line-height: 1.6; margin: 0; }
        .intro-text p:first-of-type { font-size: 20px; font-weight: bold; margin-bottom: 10px; }
        .intro-text p:last-of-type { font-style: italic; font-size: 14px; margin-top: 10px; }
        .buttons-container { position: absolute; bottom: 50px; left: 50%; transform: translateX(-50%); background-color: white; padding: 10px; border-radius: 5px; display: flex; gap: 10px; }
        .button { padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="intro-text-container">
        <div class="intro-text">
            <p>CHMC Emergency Services Data-mining Module</p>
            <p>Here is a list of nearby hospitals with capacity for emergency and ambulatory services<br>(Made with CHMC Data-mining algorithm v1.0, powered by Google Maps Open API)</p>
        </div>
    </div>
    <div style="width: 100%; height: 500px;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d51924.67054024454!2d121.02035716419246!3d14.694247666544815!3m2!1i1024!2i768!4f13.1!2m1!1shostpitals%20near%20me%20with%20emergency%20services!5e0!3m2!1sen!2sph!4v1719278298651!5m2!1sen!2sph" width="2200" height="800" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="buttons-container">
        <button class="button" id="needAmbulance">Need an ambulance</button>
        <button class="button" id="listAmbulances">List CHMC ambulances</button>
    </div>
    <script>
        // Button event listeners
        document.getElementById('needAmbulance').addEventListener('click', () => {
            // Code to handle when "Need an ambulance" button is clicked
            alert('Your request for a dedicated CHMC ambulance has been sent. Hang tight! If you are in a dangerous/life-threatening situation or involved in a crime scene, please call QCPD at 0917-840-3925.');
            // Navigate to index.html within the same website structure
            window.location.href = "index.php?page=ambulance/ambulance_tracking";
        });

        document.getElementById('listAmbulances').addEventListener('click', () => {
            // Code to handle when "List CHMC ambulances" button is clicked
            alert('A list of available dedicated CHMC ambulances will be displayed. ETA to your exact location is provided for each ambulance.');
            // Navigate to ambulance_chmc within the same website structure
            window.location.href = "index.php?page=ambulance/ambulance_chmc";
        });
    </script>
</body>
</html>
