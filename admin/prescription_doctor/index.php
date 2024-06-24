<?php
// Create connection
$conn = new mysqli('localhost', 'root', '', 'hprms_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch patient codes and full names for the dropdown
$patient_codes = [];
$sql = "SELECT id, code, fullname FROM patient_list";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Fetch email and contact for each patient
        $patient_id = $row['id'];

        // Get patient email
        $sql_email = "SELECT meta_value FROM patient_details WHERE patient_id = '$patient_id' AND meta_field = 'email'";
        $result_email = $conn->query($sql_email);
        $email = ($result_email->num_rows > 0) ? $result_email->fetch_assoc()['meta_value'] : '';

        // Get patient contact
        $sql_contact = "SELECT meta_value FROM patient_details WHERE patient_id = '$patient_id' AND meta_field = 'contact'";
        $result_contact = $conn->query($sql_contact);
        $contact = ($result_contact->num_rows > 0) ? $result_contact->fetch_assoc()['meta_value'] : '';

        $patient_codes[$patient_id] = [
            'code' => $row['code'],
            'fullname' => $row['fullname'],
            'email' => $email,
            'contact' => $contact
        ];
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
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['get_patient_details'])) {
    $patient_code = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $medication_name = $_POST['medication_name'];
    $dosage = $_POST['dosage'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $interval_hours = $_POST['interval_hours'];
    $notes = $_POST['notes'];
    $patient_email = isset($_POST['patient_email']) ? $_POST['patient_email'] : null;
    $patient_contact = isset($_POST['patient_contact']) ? $_POST['patient_contact'] : null;

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

            // Update or insert email if provided
            if ($patient_email) {
                $sql_email = "SELECT * FROM patient_details WHERE patient_id = '$patient_id' AND meta_field = 'email'";
                $result_email = $conn->query($sql_email);
                if ($result_email->num_rows > 0) {
                    $sql_update_email = "UPDATE patient_details SET meta_value = '$patient_email' WHERE patient_id = '$patient_id' AND meta_field = 'email'";
                    $conn->query($sql_update_email);
                } else {
                    $sql_insert_email = "INSERT INTO patient_details (patient_id, meta_field, meta_value) VALUES ('$patient_id', 'email', '$patient_email')";
                    $conn->query($sql_insert_email);
                }
            }

            // Update or insert contact if provided
            if ($patient_contact) {
                $sql_contact = "SELECT * FROM patient_details WHERE patient_id = '$patient_id' AND meta_field = 'contact'";
                $result_contact = $conn->query($sql_contact);
                if ($result_contact->num_rows > 0) {
                    $sql_update_contact = "UPDATE patient_details SET meta_value = '$patient_contact' WHERE patient_id = '$patient_id' AND meta_field = 'contact'";
                    $conn->query($sql_update_contact);
                } else {
                    $sql_insert_contact = "INSERT INTO patient_details (patient_id, meta_field, meta_value) VALUES ('$patient_id', 'contact', '$patient_contact')";
                    $conn->query($sql_insert_contact);
                }
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
            <select id="patient_id" name="patient_id" class="form-control" required onchange="updatePatientDetails()">
                <?php foreach ($patient_codes as $id => $data): ?>
                    <option value="<?php echo $data['code']; ?>" 
                            data-id="<?php echo $id; ?>" 
                            data-fullname="<?php echo $data['fullname']; ?>"
                            data-email="<?php echo $data['email']; ?>"
                            data-contact="<?php echo $data['contact']; ?>">
                        <?php echo $data['code']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group mb-4">
            <label for="patient_fullname">Patient Full Name:</label>
            <input type="text" id="patient_fullname" name="patient_fullname" class="form-control" readonly>
        </div>
        <div class="form-group mb-4">
            <label for="patient_email">Patient Email:</label>
            <input type="email" id="patient_email" name="patient_email" class="form-control">
        </div>
        <div class="form-group mb-4">
            <label for="patient_contact">Patient Contact:</label>
            <input type="text" id="patient_contact" name="patient_contact" class="form-control">
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
    </form>
</div>
<hr>

<script>
    function updatePatientDetails() {
        var select = document.getElementById('patient_id');
        var fullname = select.options[select.selectedIndex].getAttribute('data-fullname');
        var email = select.options[select.selectedIndex].getAttribute('data-email');
        var contact = select.options[select.selectedIndex].getAttribute('data-contact');

        document.getElementById('patient_fullname').value = fullname;
        document.getElementById('patient_email').value = email || '';
        document.getElementById('patient_contact').value = contact || '';
    }

    function redirectToPatientView() {
        var currentUrl = window.location.href; // Get current URL
        var baseUrl = currentUrl.split('?')[0]; // Split URL to get base URL (without query parameters)
        var newUrl = baseUrl + "?page=prescription_assistance"; // Construct new URL
        window.location.href = newUrl; // Redirect to new URL
    }

    // Initialize the full name field on page load
    window.onload = function() {
        updatePatientDetails();
    };
</script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['get_patient_details'])) {
    $patient_id = $_POST['patient_id'];
    $response = [];

    // Get patient email
    $sql_email = "SELECT meta_value FROM patient_details WHERE patient_id = '$patient_id' AND meta_field = 'email'";
    $result_email = $conn->query($sql_email);
    if ($result_email->num_rows > 0) {
        $row_email = $result_email->fetch_assoc();
        $response['email'] = $row_email['meta_value'];
    }

    // Get patient contact
    $sql_contact = "SELECT meta_value FROM patient_details WHERE patient_id = '$patient_id' AND meta_field = 'contact'";
    $result_contact = $conn->query($sql_contact);
    if ($result_contact->num_rows > 0) {
        $row_contact = $result_contact->fetch_assoc();
        $response['contact'] = $row_contact['meta_value'];
    }

    echo json_encode($response);
    exit;
}
?>
