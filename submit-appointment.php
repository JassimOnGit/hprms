<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hprms_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$firstName = $_POST['first_name'] ?? '';
$lastName = $_POST['last_name'] ?? '';
$email = $_POST['email'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$sex = $_POST['sex'] ?? '';
$doctor_schedule = $_POST['doctor_schedule'] ?? '';
$doctor_schedule_appointment_date = $_POST['doctor_schedule_appointment_date'] ?? '';
$appointmentDate = $_POST['appointment_date'] ?? '';
$message = $_POST['message'] ?? '';

// Create fullname
$fullname = $firstName . ' ' . $lastName;

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO message_list (fullname, first_name, last_name, email, mobile, sex, doctor_schedule, doctor_schedule_appointment_date, appointment_date, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssss", $fullname, $firstName, $lastName, $email, $mobile, $sex, $doctor_schedule, $doctor_schedule_appointment_date, $appointmentDate, $message);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #007BFF;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .container h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .container p {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .container button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Check if email already exists in the appointments table
        $checkEmailQuery = "SELECT id FROM message_list WHERE email = ?";
        $checkEmailStmt = $conn->prepare($checkEmailQuery);
        if (!$checkEmailStmt) {
            die("Error: " . $conn->error);
        }
        $checkEmailStmt->bind_param("s", $email);
        $checkEmailStmt->execute();
        $checkEmailResult = $checkEmailStmt->get_result();

        if ($checkEmailResult->num_rows > 0) {
            // Email already exists, update the existing appointment
            $existingAppointment = $checkEmailResult->fetch_assoc();
            $existingReferenceNumber = $existingAppointment['id'];
            echo "<h1>Error! Duplicate Appointment</h1>";
            echo "<p>An appointment with this email already exists.</p>";
            echo "<p>Please update your existing appointment with reference number: $existingReferenceNumber</p>";
            echo "<button onclick=\"window.location.href = './update-appointment.php';\">Update Appointment</button>";
        } else {
            // Email does not exist, proceed with inserting the new appointment
            if ($stmt->execute()) {
                echo "<h1>Success!</h1>";
                // Get the auto-generated reference number
                $referenceNumber = $stmt->insert_id;
                echo "<p>Appointment successfully submitted</p>";
                echo "<p>Your reference number is: $referenceNumber</p>";
                echo "<p>We will send your schedule confirmation</p>"; 
                echo "<p>To your email: $email</p>";
                echo "<p>Within 24HRS.</p>";
            } else {
                echo "<h1>Error!</h1>";
                echo "<p>Error: " . $stmt->error . "</p>";
            }
        }

        $stmt->close();
        $checkEmailStmt->close();
        $conn->close();
        ?>
        <button onclick="window.location.href = './index-home.php';">Back to Home</button>
    </div>
</body>
</html>
