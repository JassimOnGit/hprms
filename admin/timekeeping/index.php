<?php 
// timekeeping.php
echo "<h1 class='mb-4'>CHMC Timekeeping</h1>";
echo "<hr>"; // Add a strong horizontal line here
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form was submitted - save data to database
    $user_id = $_POST['user_id'];

    // Connect to database
    $db = new mysqli('localhost', 'root', '', 'hprms_db');

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Prepare and execute SQL statement
    if (isset($_POST['clock_in'])) {
        $time_in = date('Y-m-d H:i:s'); // Get current system time
        $stmt = $db->prepare("INSERT INTO timekeeping (user_id, time_in) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $time_in);
    } else if (isset($_POST['clock_out'])) {
        $time_out = date('Y-m-d H:i:s'); // Get current system time
        $stmt = $db->prepare("UPDATE timekeeping SET time_out = ? WHERE user_id = ? AND time_out IS NULL");
        $stmt->bind_param("si", $time_out, $user_id);
    }
    $stmt->execute();

    echo "<div class='alert alert-success'>Timekeeping data saved!</div>";

    // Query for timekeeping data for this user
    $stmt = $db->prepare("SELECT * FROM timekeeping WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display timekeeping data in a calendar format
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
            <label for="user_id">User ID:</label>
            <input type="number" class="form-control" id="user_id" name="user_id">
        </div>
        <button type="submit" name="clock_in" class="btn btn-primary">Clock In</button>
        <button type="submit" name="clock_out" class="btn btn-primary ml-2">Clock Out</button>
    </form>';
    echo "<hr>"; // Add a strong horizontal line here
}

// Add a button that links to the attendance history page
echo '<a href="index.php?page=timekeeping/attendance_history" class="btn btn-secondary mt-4">View Attendance History</a>';
echo "<hr>"; // Add a strong horizontal line here