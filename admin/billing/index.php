<?php
// Database connection details
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $patient_identifier = mysqli_real_escape_string($conn, $_POST['patientIdentifier']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['paymentMethod']);
    $payment_status = "Pending"; // Default status
    $payment_date = date('Y-m-d H:i:s'); // Current date and time
    $billing_reference = null;

    // Determine if the user provided patient name or patient code
    $is_name_search = false;
    if (preg_match('/^[a-zA-Z\s]+$/', $patient_identifier)) {
        $is_name_search = true;
    }

    // Find patient_id based on patient name or patient code
    if ($is_name_search) {
        $patient_query = "SELECT id FROM patient_list WHERE fullname = '$patient_identifier'";
    } else {
        $patient_query = "SELECT id FROM patient_list WHERE code = '$patient_identifier'";
    }

    $result = $conn->query($patient_query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $patient_id = $row['id'];

        // Generate unique billing reference for cash payments
        if ($payment_method == 'cash') {
            $billing_reference = uniqid('BR-');
        }

        // Insert data into the payments table
        $sql = "INSERT INTO payments (patient_id, patient_name, amount, payment_method, payment_status, payment_date, billing_reference) 
                VALUES ('$patient_id', '$patient_identifier', '$amount', '$payment_method', '$payment_status', '$payment_date', '$billing_reference')";

        if ($conn->query($sql) === TRUE) {
            if ($payment_method == 'cash') {
                $message = "<strong>Success, Please present your billing reference number $billing_reference at the counter. Thank you for your payment!</strong>";
            } else {
                // Integrate with PayMongo payment gateway for non-cash payments
                $paymongo_url = 'https://api.paymongo.com/v1/payment_intents';
                $data = [
                    'data' => [
                        'attributes' => [
                            'amount' => $amount * 100, // Amount in centavos
                            'payment_method_allowed' => ['card', 'paymaya', 'gcash', 'bank_transfer'],
                            'currency' => 'PHP',
                            'description' => 'Payment for patient ' . $patient_identifier
                        ]
                    ]
                ];
                $headers = [
                    'Content-Type: application/json',
                    'Authorization: Basic ' . base64_encode('sk_test_6jfUA9NuenwD4xgAtfMSEMrj:')
                ];

                $ch = curl_init($paymongo_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                
                $response = curl_exec($ch);
                $response_data = json_decode($response, true);

                if (isset($response_data['data']['id'])) {
                    $payment_intent_id = $response_data['data']['id'];
                    $message = "New payment record created successfully. Please complete your payment using this payment intent ID: $payment_intent_id. Thank you!";
                } else {
                    $message = "Error creating payment intent: " . $response_data['errors'][0]['detail'];
                }
                curl_close($ch);
            }
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $message = "Error: Invalid Patient Identifier";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHMC Billing</title>
    <link rel="stylesheet" href="path_to_your_css_file.css"> <!-- Add your CSS file here -->
</head>
<body>

<?php
echo "<h1 class='mb-4'>CHMC Billing</h1>";
echo "<hr>"; // Add a strong horizontal line here

if (!empty($message)) {
    echo "<p>$message</p>";
}
?>

<form action="" method="post">
    <div class="form-group">
        <label for="patientIdentifier">Patient Name or Code:</label>
        <input type="text" class="form-control" id="patientIdentifier" name="patientIdentifier" required>
    </div>
    <hr>
    <div class="form-group">
        <label for="amount">Amount:</label>
        <input type="number" class="form-control" id="amount" name="amount" required>
    </div>
    <hr>
    <div class="form-group">
        <label for="paymentMethod">Payment Method:</label>
        <select class="form-control" id="paymentMethod" name="paymentMethod" required>
            <option value="gcash">GCash</option>
            <option value="paymaya">Maya</option>
            <option value="credit_debit">Credit/Debit Card (Visa, Mastercard)</option>
            <option value="bank_transfer">Online Bank Transfer (BPI Online, UnionBank Online)</option>
            <option value="cash">Cash At the Counter</option>
        </select>
    </div>
    <hr>
    <button type="submit" class="btn btn-primary">Submit Payment</button>
</form>
<hr>

</body>
</html>
