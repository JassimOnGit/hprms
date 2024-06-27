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

$resultHTML = ""; // Initialize an empty string for result HTML
$error = ""; // Initialize an empty string for error message    

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        if (empty($_POST['selected_appointment'])) {
            $error = "Error updating! Please select an existing appointment first.";
        } else {
            // Update appointment details
            $selectedAppointment = $_POST['selected_appointment'];
            $newMessage = $_POST['new_message'];
            $newDateTime = $_POST['new_date_time'];

            $updateStmt = $conn->prepare("UPDATE message_list SET message = ?, appointment_date = ? WHERE id = ?");
            $updateStmt->bind_param("ssi", $newMessage, $newDateTime, $selectedAppointment);

            if ($updateStmt->execute()) {
                $resultHTML = "<p style='color: teal; font-weight: bold; margin-bottom: 10px;'>Congratulations! The appointment was updated successfully.</p>";
            } else {
                $resultHTML = "Error updating appointment: " . $updateStmt->error;
            }
            $updateStmt->close();
        }
    } elseif (isset($_POST['search'])) {
        // Search for appointments
        $email = $_POST['email'];
        $referenceNumber = $_POST['reference_number'];

        if (empty($email) && empty($referenceNumber)) {
            $resultHTML = "Please enter a valid email address or reference number.";
        } else {
            // Validate email format
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $resultHTML = "Invalid email address. Please enter a valid email.";
            } else {
                // Check if reference number exists in the database
                $stmt = $conn->prepare("SELECT * FROM message_list WHERE email = ? OR id = ?");
                $stmt->bind_param("ss", $email, $referenceNumber);

                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        // Display list of appointments in a table with radio buttons
                        $resultHTML = "<h2>Appointments:</h2>";
                        $resultHTML .= "<form method='post'>"; // Form to handle update
                        $resultHTML .= "<div class='table-container'>";
                        $resultHTML .= "<table border='1' style='width: 100%; margin-top: 20px;'>";
                        $resultHTML .= "<tr><th>Select</th><th>Full Name</th><th>Email</th><th>Reference Number</th><th>Message</th><th>Appointment Date</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            $resultHTML .= "<tr>";
                            $resultHTML .= "<td><input type='radio' name='selected_appointment' value='" . htmlspecialchars($row['id']) . "' onchange='checkSelection()'></td>";
                            $resultHTML .= "<td>" . htmlspecialchars($row['fullname']) . "</td>";
                            $resultHTML .= "<td>" . htmlspecialchars($row['email']) . "</td>";
                            $resultHTML .= "<td>" . htmlspecialchars($row['id']) . "</td>";
                            $resultHTML .= "<td>" . htmlspecialchars($row['message']) . "</td>";
                            $resultHTML .= "<td>" . htmlspecialchars($row['appointment_date']) . "</td>"; // Displaying appointment_date
                            $resultHTML .= "</tr>";
                        }
                        $resultHTML .= "</table>";
                        $resultHTML .= "</div>";
                        $resultHTML .= "<br>"; // Add a line break
                        $resultHTML .= "<label for='new_message'>New Message:</label>";
                        $resultHTML .= "<input type='text' id='new_message' name='new_message' required>";
                        $resultHTML .= "<br><br>";
                        $resultHTML .= "<label for='new_date_time'>New Date and Time:</label>";
                        $resultHTML .= "<input type='datetime-local' id='new_date_time' name='new_date_time' required>";
                        $resultHTML .= "<br><br>";
                        $resultHTML .= "<button type='submit' id='updateButton' name='update' disabled>Update Selected Appointment</button>";
                        $resultHTML .= "</form>";
                    } else {
                        $resultHTML = "Invalid email address or reference number. Please check and try again.";
                    }
                } else {
                    $resultHTML = "Error executing the query: " . $stmt->error;
                }
                $stmt->close();
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #007BFF;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 90%;
            margin: 0 auto;
            padding: 20px;
            width: 100%;
            text-align: left; /* Align content to the left */
        }
        .container h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .container label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .container input[type="text"],
        .container input[type="email"],
        .container input[type="datetime-local"] {
            width: 80%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
        .table-container {
            overflow-x: auto;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }
        table th {
            background-color: #f2f2f2;
        }
        .error {
            color: red;
            margin-bottom: 10px;
            font-weight: bold;
        }
    </style>
    <script> 
        function checkSelection() {
            // Get all radio buttons with name 'selected_appointment'
            const radioButtons = document.querySelectorAll('input[name="selected_appointment"]');
            
            // Check if any radio button is checked
            let isChecked = false;
            for (const radioButton of radioButtons) {
                if (radioButton.checked) {
                    isChecked = true;
                    break;
                }
            }

            // Enable or disable the update button based on the radio button selection
            document.getElementById('updateButton').disabled = !isChecked;
        }
    </script>
</head>
<body>
    <div class="container"> 
        <h1>Update Appointment Form</h1>
        <form method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <h3>or</h3>
            <label for="reference_number">Reference Number:</label>
            <input type="text" id="reference_number" name="reference_number">
            <br>
            <button type="submit" name="search">Search Appointment</button>
            <a href="index-home.php"><button type="button">Back to Home</button></a>
        </form>
        <br>
        <?php echo $resultHTML; // Display the result HTML here ?>
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
