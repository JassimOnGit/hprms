<?php
echo "<h1 class='mb-4'>CHMC Prescription Assistance</h1>";
echo "<hr>"; // Add a strong horizontal line here
?>
<div>
    <!-- Patient input form -->
    <form method="POST" action="" class="mb-4">
        <div class="form-group">
            <label for="patientIdentifier">Patient Name or Code:</label>
            <input type="text" name="patientIdentifier" id="patientIdentifier" class="form-control" required>
            <small class="form-text text-muted">Enter either Patient Code or Patient Name (Last, First, M.I)</small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <?php
    echo "<hr>"; // Add a strong horizontal line here

    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hprms_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("<div class='alert alert-danger'>Connection failed: " . $conn->connect_error . "</div>");
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the patient identifier from the form
        $patientIdentifier = $_POST["patientIdentifier"];
        
        // Query to fetch patient id and name from patient_list based on the patient code or name
        $patientQuery = "SELECT id, fullname FROM patient_list WHERE code = ? OR fullname = ?";
        $stmt = $conn->prepare($patientQuery);
        $stmt->bind_param("ss", $patientIdentifier, $patientIdentifier);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch the patient id and name
            $row = $result->fetch_assoc();
            $patientId = $row['id'];

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
                echo "<h3>Prescriptions for " . $row['fullname'] . "</h3>";
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
                echo "<p>No prescriptions found for " . $row['fullname'] . ".</p>";
            }
            $prescriptionsStmt->close();
        } else {
            echo "<p>No patient found with the provided identifier.</p>";
        }

        $stmt->close();
    }

    // Close the database connection
    $conn->close();
    ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- JavaScript function to print prescriptions -->
<script>
function printPrescriptions() {
    window.print();
}
</script>
