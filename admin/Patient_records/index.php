<!DOCTYPE html>
<html>
<head>
    <title>Patient Records</title>
</head>
<body>
    <h1>Patient Records</h1>
    
    <!-- Patient input form -->
    <form method="POST" action="">
        <label for="patientCode">Patient Code:</label>
        <input type="text" name="patientCode" id="patientCode" required>
        <button type="submit">Submit</button>
    </form>
    
    <?php
        // Establish database connection (replace with your own connection details)
        $servername = "localhost";
        $username = "username";
        $password = "password";
        $dbname = "hprms";

        $conn = new mysqli('localhost', 'root', '', 'hprms_db');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the patient code from the form
            $patientCode = $_POST["patientCode"];
            
            // Query to fetch patient records from patient_list based on the patient code
            $sql = "SELECT * FROM patient_list WHERE code = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $patientCode);
            $stmt->execute();
            $result = $stmt->get_result();
            
            // Display patient records
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='patient-record'>";
                    echo "<h2>Patient Information</h2>";
                    echo "<p>Patient Name: " . $row["fullname"] . "</p>";

                    // Query patient history based on the patient ID
                    $patientId = $row["id"];
                    $historySql = "SELECT * FROM patient_history WHERE patient_id = ?";
                    $historyStmt = $conn->prepare($historySql);
                    $historyStmt->bind_param("i", $patientId);
                    $historyStmt->execute();
                    $historyResult = $historyStmt->get_result();
                    
                    // Display patient history
                    if ($historyResult->num_rows > 0) {
                        echo "<div class='patient-history'>";
                        echo "<h3>Patient History and Records</h3>";
                        while ($historyRow = $historyResult->fetch_assoc()) {
                            echo "<p>Illness: " . $historyRow["illness"] . "</p>";
                            echo "<p>Diagnosis: " . $historyRow["diagnosis"] . "</p>";
                            echo "<p>Treatment: " . $historyRow["treatment"] . "</p>";
                            echo "<p>Remarks: " . $historyRow["remarks"] . "</p>";
                            echo "<p>Date Created: " . $historyRow["date_created"] . "</p>";
                            echo "<p>Date Updated: " . $historyRow["date_updated"] . "</p>";

                            // Query patient details based on the patient ID
                            $detailsSql = "SELECT * FROM patient_details WHERE patient_id = ?";
                            $detailsStmt = $conn->prepare($detailsSql);
                            $detailsStmt->bind_param("i", $patientId);
                            $detailsStmt->execute();
                            $detailsResult = $detailsStmt->get_result();

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
                                    echo "<p>Doctor Name: " . $doctorRow["fullname"] . "</p>";
                                    echo "<p>Specialization: " . $doctorRow["specialization"] . "</p>";
                                    echo "<p>email: " . $doctorRow["email"] . "</p>";
                                    echo "<p>contact number: " . $doctorRow["contact"] . "</p>";
                                }
                                echo "</div>";
                            } else {
                                echo "<p>No doctor information found.</p>";
                            }
                        }
                        echo "</div>";
                    } else {
                        echo "<p>No patient history found.</p>";
                    }
                    
                    echo "</div>";
                }
            } else {
                echo "<p>No patient records found.</p>";
            }

            // Close statements
            $stmt->close();
            //$historyStmt->close(); - commented out to avoid error
            //$doctorStmt->close(); - commented out to avoid error
        }

        // Close the database connection
        $conn->close();
    ?>
</body>
</html>
