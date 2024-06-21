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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $medication_name = $_POST['medication_name'];
    $dosage = $_POST['dosage'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $interval_hours = $_POST['interval_hours'];

    $sql = "INSERT INTO prescriptions (user_id, medication_name, dosage, start_date, end_date, interval_hours) 
            VALUES ('$user_id', '$medication_name', '$dosage', '$start_date', '$end_date', '$interval_hours')";

    if ($conn->query($sql) === TRUE) {
        echo "New prescription added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Prescription</title>
</head>
<body>
    <h2>Add Prescription</h2>
    <form method="post" action="">
        <label for="user_id">User ID (Patient Code):</label><br>
        <select id="user_id" name="user_id" required>
            <?php
            foreach ($patient_codes as $id => $code) {
                echo "<option value='$id'>$code</option>";
            }
            ?>
        </select><br><br>

        <label for="medication_name">Medication Name:</label><br>
        <input type="text" id="medication_name" name="medication_name" required><br><br>

        <label for="dosage">Dosage:</label><br>
        <input type="text" id="dosage" name="dosage" required><br><br>

        <label for="start_date">Start Date:</label><br>
        <input type="date" id="start_date" name="start_date" required><br><br>

        <label for="end_date">End Date:</label><br>
        <input type="date" id="end_date" name="end_date" required><br><br>

        <label for="interval_hours">Interval Hours:</label><br>
        <input type="number" id="interval_hours" name="interval_hours" required><br><br>

        <input type="submit" value="Add Prescription">
    </form>
</body>
</html>
