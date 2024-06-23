<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Prescriptions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Enter Your Patient Code</h2>
    <form method="get" action="" class="mb-4">
        <div class="form-group">
            <label for="patient_code">Patient Code</label>
            <input type="text" class="form-control" id="patient_code" name="patient_code" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <?php
    if (isset($_GET['patient_code'])) {
        $patientCode = $_GET['patient_code'];

        try {
            // Connect to patient_list.db and find the user_id
            $patientDb = new PDO('sqlite:patient_list.db');
            $patientDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $patientDb->prepare('SELECT id FROM patient_list WHERE code = :code');
            $stmt->bindParam(':code', $patientCode);
            $stmt->execute();
            $patient = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($patient) {
                $userId = $patient['id'];

                // Connect to prescriptions.db and fetch prescriptions for the user_id
                $prescriptionDb = new PDO('sqlite:prescriptions.db');
                $prescriptionDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $prescriptionDb->prepare('SELECT * FROM prescriptions WHERE user_id = :user_id');
                $stmt->bindParam(':user_id', $userId);
                $stmt->execute();
                $prescriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($prescriptions) {
                    echo '<h3 class="mb-4">Prescriptions for Patient Code: ' . htmlspecialchars($patientCode) . '</h3>';
                    echo '<table class="table table-bordered">';
                    echo '<thead><tr><th>Medication Name</th><th>Dosage</th><th>Start Date</th><th>End Date</th><th>Interval (Hours)</th><th>Doctor ID</th><th>Notes</th></tr></thead>';
                    echo '<tbody>';
                    foreach ($prescriptions as $prescription) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($prescription['medication_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($prescription['dosage']) . '</td>';
                        echo '<td>' . htmlspecialchars($prescription['start_date']) . '</td>';
                        echo '<td>' . htmlspecialchars($prescription['end_date']) . '</td>';
                        echo '<td>' . htmlspecialchars($prescription['interval_hours']) . '</td>';
                        echo '<td>' . htmlspecialchars($prescription['doctor_id']) . '</td>';
                        echo '<td>' . htmlspecialchars($prescription['notes']) . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody></table>';
                } else {
                    echo '<p>No prescriptions found for the given patient code.</p>';
                }
            } else {
                echo '<p>Invalid patient code.</p>';
            }
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
    ?>
</div>
</body>
</html>
