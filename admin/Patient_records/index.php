    <!-- Patient input form -->
    <form method="POST" action="" class="mb-4">
        <div class="form-group">
            <label for="patientCode">Patient Code:</label>
            <input type="text" name="patientCode" id="patientCode" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
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
            die("<div class='alert alert-danger'>Connection failed: " . $conn->connect_error . "</div>");
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
            echo "<hr>";
            // Display patient records
            if ($result->num_rows > 0) {
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
                            echo "<p><strong>Admission ID:</strong> " . $admissionHistoryRow["room_id"] . "</p>";
                            echo "<p><strong>Patient ID:</strong> " . $admissionHistoryRow["patient_id"] . "</p>";
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
            $historyStmt->close();
        }

        // Close the database connection
        $conn->close();
        echo "<hr>";
    ?>
</div>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
