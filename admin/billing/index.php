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
    $patient_name = mysqli_real_escape_string($conn, $_POST['patientName']);
    $patient_id = mysqli_real_escape_string($conn, $_POST['patientID']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['paymentMethod']);
    $payment_status = "Pending"; // Default status
    $payment_date = date('Y-m-d H:i:s'); // Current date and time

    // Insert data into the payments table
    $sql = "INSERT INTO payments (patient_id, patient_name, amount, payment_method, payment_status, payment_date) 
            VALUES ('$patient_id', '$patient_name', '$amount', '$payment_method', '$payment_status', '$payment_date')";

    if ($conn->query($sql) === TRUE) {
        $message = "New payment record created successfully";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
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
        <label for="patientName">Patient Name</label>
        <input type="text" class="form-control" id="patientName" name="patientName" required>
    </div>
    <hr>
    <div class="form-group">
        <label for="patientID">Patient ID</label>
        <input type="text" class="form-control" id="patientID" name="patientID" required>
    </div>
    <hr>
    <div class="form-group">
        <label for="amount">Amount</label>
        <input type="number" class="form-control" id="amount" name="amount" required>
    </div>
    <hr>
    <div class="form-group">
        <label for="paymentMethod">Payment Method</label>
        <select class="form-control" id="paymentMethod" name="paymentMethod" required>
            <option value="gcash">GCash</option>
            <option value="paymaya">PayMaya</option>
            <option value="credit_debit">Credit/Debit Card</option>
            <option value="bank_transfer">Bank Transfer</option>
            <option value="cash">Cash At the Counter</option>
        </select>
    </div>
    <hr>
    <button type="submit" class="btn btn-primary">Submit Payment</button>
</form>
<hr>

</body>
</html>
