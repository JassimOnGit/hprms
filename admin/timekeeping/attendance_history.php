<?php
// attendance_history.php
echo "<h1 class='mb-4'>Attendance History</h1>";
echo "<hr>"; // Add a strong horizontal line here

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form was submitted - fetch data from database
    $user_id = $_POST['user_id'];

    // Connect to database
    $db = new mysqli('localhost', 'root', '', 'hprms_db');

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Prepare and execute SQL statement
    $stmt = $db->prepare("SELECT * FROM timekeeping WHERE user_id = ? ORDER BY time_in DESC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display attendance history in a table format
    echo "<table class='table table-striped'>";
    echo "<thead class='thead-dark'><tr><th>Time In</th><th>Time Out</th></tr></thead>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['time_in'] . "</td>";
        echo "<td>" . $row['time_out'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    // Form was not submitted - display form
    echo '<form method="post" class="mb-4">
        <div class="form-group">
        <label for="user_id">Employee ID:</label>
            <input type="number" class="form-control" id="user_id" name="user_id" required>
            <small class="form-text text-muted">Please Enter your HRIS Employee I.D.</small>
        </div>
        <button type="submit" class="btn btn-primary">View Attendance History</button>
    </form>';
    echo "<hr>"; // Add a strong horizontal line here
}

// Add a button that links back to the timekeeping page
echo '<a href="index.php?page=timekeeping" class="btn btn-secondary mt-4">Back to Timekeeping</a>';
echo "<hr>"; // Add a strong horizontal line here
?>
