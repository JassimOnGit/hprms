<?php
echo "<h1 class='mb-4'>CHMC Patient Records</h1>";
echo "<hr>"; // Add a strong horizontal line here
?>
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
// Establish database connection (replace with your own connection details)
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
    // Get the patient identifier (either name or code) from the form
    $patientIdentifier = $_POST["patientIdentifier"];

    // Determine if the input is a code or fullname
    $is_name_search = false;
    if (preg_match('/^[a-zA-Z\s]+$/', $patientIdentifier)) {
        $is_name_search = true;
    }

    // Query to fetch patient records from patient_list based on the patient code or fullname
    if ($is_name_search) {
        $sql = "SELECT * FROM patient_list WHERE fullname = ?";
    } else {
        $sql = "SELECT * FROM patient_list WHERE code = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $patientIdentifier);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display patient records
    if ($result->num_rows > 0) {
        echo "<button onclick='printRecords()' class='btn btn-secondary mb-4'>Print Patient Records</button>";
        echo "<hr>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='patient-record'>";
            echo "<h2>Patient Information</h2>";
            echo "<p><strong>Patient Name:</strong> " . $row["fullname"] . "</p>";

            // Query patient history based on the patient ID
            $patientId = $row["id"];
            $historySql = "SELECT * FROM patient_history WHERE patient_id = ?";
            $historyStmt = $conn->prepare($historySql);
            $historyStmt->bind_param("i", $patientId);
            $historyStmt->execute();
            $historyResult = $historyStmt->get_result();
            echo "<hr>";
            // Display patient history
            if ($historyResult->num_rows > 0) {
                echo "<div class='patient-history'>";
                echo "<h3>Patient History and Records</h3>";
                while ($historyRow = $historyResult->fetch_assoc()) {
                    echo "<p><strong>Illness:</strong> " . $historyRow["illness"] . "</p>";
                    echo "<p><strong>Diagnosis:</strong> " . $historyRow["diagnosis"] . "</p>";
                    echo "<p><strong>Treatment:</strong> " . $historyRow["treatment"] . "</p>";
                    echo "<p><strong>Remarks:</strong> " . $historyRow["remarks"] . "</p>";

                    // Query patient details based on the patient ID
                    $detailsSql = "SELECT * FROM patient_details WHERE patient_id = ?";
                    $detailsStmt = $conn->prepare($detailsSql);
                    $detailsStmt->bind_param("i", $patientId);
                    $detailsStmt->execute();
                    $detailsResult = $detailsStmt->get_result();
                    echo "<hr>";
                    // Display patient details
                    if ($detailsResult->num_rows > 0) {
                        echo "<div class='patient-details'>";
                        echo "<h3>Patient Details</h3>";
                        while ($detailsRow = $detailsResult->fetch_assoc()) {
                            echo "<p><strong>" . $detailsRow["meta_field"] . ":</strong> " . $detailsRow["meta_value"] . "</p>";
                        }
                        echo "</div>";
                    } else {
                        echo "<p>No patient details found.</p>";
                    }
                    echo "<hr>";
                    // Close statement
                    $detailsStmt->close();

                    // Get doctor information based on doctor_id
                    $doctorId = $historyRow["doctor_id"];
                    $doctorSql = "SELECT * FROM doctor_list WHERE id = ?";
                    $doctorStmt = $conn->prepare($doctorSql);
                    $doctorStmt->bind_param("i", $doctorId);
                    $doctorStmt->execute();
                    $doctorResult = $doctorStmt->get_result();
                    
                    // Display doctor information
                    if ($doctorResult->num_rows > 0) {
                        echo "<div class='doctor-info'>";
                        echo "<h3>Assigned Doctor</h3>";
                        while ($doctorRow = $doctorResult->fetch_assoc()) {
                            echo "<p><strong>Doctor Name:</strong> " . $doctorRow["fullname"] . "</p>";
                            echo "<p><strong>Specialization:</strong> " . $doctorRow["specialization"] . "</p>";
                            echo "<p><strong>Email:</strong> " . $doctorRow["email"] . "</p>";
                            echo "<p><strong>Contact Number:</strong> " . $doctorRow["contact"] . "</p>";
                        }
                        echo "</div>";
                    } else {
                        echo "<p>No doctor information found.</p>";
                    }
                    $doctorStmt->close();
                }
                echo "</div>";
            } else {
                echo "<p>No patient history found.</p>";
            }
            echo "<hr>";
            // Query and display admission history
            $admissionHistorySql = "SELECT * FROM admission_history WHERE patient_id = ?";
            $admissionHistoryStmt = $conn->prepare($admissionHistorySql);
            $admissionHistoryStmt->bind_param("i", $patientId);
            $admissionHistoryStmt->execute();
            $admissionHistoryResult = $admissionHistoryStmt->get_result();

            if ($admissionHistoryResult->num_rows > 0) {
                echo "<div class='admission-history'>";
                echo "<h3>Admission History</h3>";
                while ($admissionHistoryRow = $admissionHistoryResult->fetch_assoc()) {
                    // Fetch room name from room_list based on room_id
                    $roomId = $admissionHistoryRow["room_id"];
                    $roomSql = "SELECT name FROM room_list WHERE id = ?";
                    $roomStmt = $conn->prepare($roomSql);
                    $roomStmt->bind_param("i", $roomId);
                    $roomStmt->execute();
                    $roomResult = $roomStmt->get_result();
                    
                    if ($roomResult->num_rows > 0) {
                        while ($roomRow = $roomResult->fetch_assoc()) {
                            echo "<p><strong>Room Information:</strong> " . $roomRow["name"] . "</p>";
                        }
                    } else {
                        echo "<p><strong>Room Information:</strong> No room information found.</p>";
                    }
                    $roomStmt->close();
                    
                    echo "<p><strong>Admission Date:</strong> " . $admissionHistoryRow["date_admitted"] . "</p>";
                    echo "<p><strong>Discharge Date:</strong> " . $admissionHistoryRow["date_discharged"] . "</p>";
                }
                echo "</div>";
            } else {
                echo "<p>No admission history found.</p>";
            }
            $admissionHistoryStmt->close();

            echo "</div>"; // End of patient-record
        }
    } else {
        echo "<div class='alert alert-warning'>No patient records found.</div>";
    }
    
    // Close statements
    $stmt->close();
}

// Close the database connection
$conn->close();
echo "<hr>";
?>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- JavaScript function to print patient records -->
<script>
function printRecords() {
    window.print();
}
</script>
