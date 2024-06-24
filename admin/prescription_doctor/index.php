<?php
// Create connection
$conn = new mysqli('localhost', 'root', '', 'hprms_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch patient codes for the dropdown
$patient_codes = [];
$sql = "SELECT id, code FROM patient_list";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $patient_codes[$row['id']] = $row['code'];
    }
}

// Fetch doctors for the dropdown
$doctors = [];
$sql = "SELECT id, fullname FROM doctor_list";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $doctors[$row['id']] = $row['fullname'];
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_code = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $medication_name = $_POST['medication_name'];
    $dosage = $_POST['dosage'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $interval_hours = $_POST['interval_hours'];
    $notes = $_POST['notes'];

    // Get patient id from patient_list based on code
    $sql_patient = "SELECT id FROM patient_list WHERE code = '$patient_code'";
    $result_patient = $conn->query($sql_patient);

    if ($result_patient) {
        if ($result_patient->num_rows > 0) {
            $row = $result_patient->fetch_assoc();
            $patient_id = $row['id'];

            // Insert prescription into prescriptions table
            $sql = "INSERT INTO prescriptions (user_id, doctor_id, medication_name, dosage, start_date, end_date, interval_hours, notes) 
                    VALUES ('$patient_id', '$doctor_id', '$medication_name', '$dosage', '$start_date', '$end_date', '$interval_hours', '$notes')";

            if ($conn->query($sql) === TRUE) {
                echo "New prescription added successfully";
            } else {
                echo "Error inserting prescription: " . $conn->error;
            }
        } else {
            echo "Patient not found";
        }
    } else {
        echo "Error: " . $sql_patient . "<br>" . $conn->error;
    }
}

$conn->close();

echo "<h1 class='mb-4'>CHMC Prescription Assistance (Doctor View)</h1>";
echo "<hr>"; // Add a strong horizontal line here

?>
<div>
    <form method="post" action="">
        <div class="form-group mb-4">
            <label for="patient_id">Patient Code:</label>
            <select id="patient_id" name="patient_id" class="form-control" required>
                <?php foreach ($patient_codes as $id => $code): ?>
                    <option value="<?php echo $code; ?>"><?php echo $code; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <hr>
        <div class="form-group mb-4">
            <label for="doctor_id">Doctor:</label>
            <select id="doctor_id" name="doctor_id" class="form-control" required>
                <?php foreach ($doctors as $id => $fullname): ?>
                    <option value="<?php echo $id; ?>"><?php echo $fullname; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <hr>
        <div class="form-group mb-4">
            <label for="medication_name">Medication Name:</label>
            <input type="text" id="medication_name" name="medication_name" class="form-control" required>
        </div>
        <hr>
        <div class="form-group mb-4">
            <label for="dosage">Dosage:</label>
            <input type="text" id="dosage" name="dosage" class="form-control" required>
        </div>
        <hr>
        <div class="form-group mb-4">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" class="form-control" required>
        </div>
        <hr>
        <div class="form-group mb-4">
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" class="form-control" required>
        </div>
        <hr>
        <div class="form-group mb-4">
            <label for="interval_hours">Interval Hours:</label>
            <input type="number" id="interval_hours" name="interval_hours" class="form-control" required>
        </div>
        <hr>
        <div class="form-group mb-4">
            <label for="notes">Notes:</label>
            <textarea id="notes" name="notes" class="form-control"></textarea>
        </div>
 
        <button type="submit" class="btn btn-primary">Add Prescription</button>
        <button type="button" class="btn btn-secondary" onclick="redirectToPatientView()">Patient View</button>

        <script>
         function redirectToPatientView() {
            var currentUrl = window.location.href; // Get current URL
            var baseUrl = currentUrl.split('?')[0]; // Split URL to get base URL (without query parameters)
            var newUrl = baseUrl + "?page=prescription_assistance"; // Construct new URL
            window.location.href = newUrl; // Redirect to new URL
        }
        </script>
    </form>
</div>
<hr>