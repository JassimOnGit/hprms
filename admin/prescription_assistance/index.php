<div>
    <iframe id="printFrame" style="display:none;"></iframe>
    <script>
        function printPrescriptions() {
            var printContents = document.getElementById("prescriptions").innerHTML;
            var printFrame = document.getElementById("printFrame").contentWindow;
            
            printFrame.document.open();
            printFrame.document.write('<html><head><title>Print Prescriptions</title>');
            printFrame.document.write('<link rel="stylesheet" href="path/to/your/css/file.css" type="text/css" />');
            printFrame.document.write('</head><body>');
            printFrame.document.write(printContents);
            printFrame.document.write('</body></html>');
            printFrame.document.close();
            printFrame.focus();
            printFrame.print();
        }
    </script>
    <?php
    echo "<h1 class='mb-4'>CHMC Prescription Assistance</h1>";
    echo "<hr>"; // Add a strong horizontal line here
    ?>
    <!-- Patient input form -->
    <form method="POST" action="" class="mb-4">
        <div class="form-group">
            <label for="patientCode">Patient Code:</label>
            <input type="text" name="patientCode" id="patientCode" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <?php
    echo "<hr>"; // Add a strong horizontal line here
    ?>

    <?php
    // Establish database connection (replace with your own connection details)
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "hprms";

    // Create connection
    $conn = new mysqli('localhost', 'root', '', 'hprms_db');
    // Check connection
    if ($conn->connect_error) {
        die("<div class='alert alert-danger'>Connection failed: " . $conn->connect_error . "</div>");
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the patient code from the form
        $patientCode = $_POST["patientCode"];
        
        // Query to fetch patient id and name from patient_list based on the patient code
        $sql = "SELECT id, fullname FROM patient_list WHERE code = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $patientCode);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch the patient id and name
            $row = $result->fetch_assoc();
            $patientId = $row['id'];
            $patientName = $row['fullname'];

            // Query and display prescriptions
            $prescriptionsSql = "SELECT medication_name, dosage, start_date, end_date, interval_hours, notes 
                                 FROM prescriptions 
                                 WHERE user_id = ?";
            $prescriptionsStmt = $conn->prepare($prescriptionsSql);
            $prescriptionsStmt->bind_param("i", $patientId);
            $prescriptionsStmt->execute();
            $prescriptionsResult = $prescriptionsStmt->get_result();

            if ($prescriptionsResult->num_rows > 0) {
                echo "<div id='prescriptions' class='prescriptions'>";
                echo "<h3>Prescriptions for $patientName</h3>";
                while ($prescriptionRow = $prescriptionsResult->fetch_assoc()) {
                    echo "<p><strong>Medication Name:</strong> " . $prescriptionRow["medication_name"] . "</p>";
                    echo "<p><strong>Dosage:</strong> " . $prescriptionRow["dosage"] . "</p>";
                    echo "<p><strong>Start Date:</strong> " . $prescriptionRow["start_date"] . "</p>";
                    echo "<p><strong>End Date:</strong> " . $prescriptionRow["end_date"] . "</p>";
                    echo "<p><strong>Interval Hours:</strong> " . $prescriptionRow["interval_hours"] . "</p>";
                    echo "<p><strong>Notes:</strong> " . $prescriptionRow["notes"] . "</p>";
                    echo "<hr>"; // Adding a horizontal line between prescriptions
                }
                echo "</div>";
                echo "<button onclick='printPrescriptions()' class='btn btn-success'>Print Prescriptions</button>";
            } else {
                echo "<p>No prescriptions found for $patientName.</p>";
            }
            $prescriptionsStmt->close();
        } else {
            echo "<p>No patient found with the provided code.</p>";
        }

        $stmt->close();
    }

    // Close the database connection
    $conn->close();
    ?>
</div>
