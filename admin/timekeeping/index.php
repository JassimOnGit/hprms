<?php 
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1 class='mb-4'>CHMC Timekeeping</h1>";
echo "<hr>"; // Add a strong horizontal line here

// Database connection function
function connect_db() {
    $db = new mysqli('localhost', 'root', '', 'hprms_db');
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    return $db;
}

// Function to handle clock in
function clock_in($db, $user_id) {
    $time_in = date('Y-m-d H:i:s'); // Get current system time
    $stmt = $db->prepare("INSERT INTO timekeeping (user_id, time_in) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $time_in);
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Clocked in at $time_in</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }
}

// Function to handle clock out
function clock_out($db, $user_id) {
    $time_out = date('Y-m-d H:i:s'); // Get current system time
    $stmt = $db->prepare("UPDATE timekeeping SET time_out = ? WHERE user_id = ? AND time_out IS NULL");
    $stmt->bind_param("si", $time_out, $user_id);
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Clocked out at $time_out</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }
}

// Function to display timekeeping data
function display_timekeeping_data($db, $user_id) {
    $stmt = $db->prepare("SELECT * FROM timekeeping WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<table class='table table-striped'>";
    echo "<thead class='thead-dark'><tr><th>Time In</th><th>Time Out</th></tr></thead>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['time_in'] . "</td>";
        echo "<td>" . $row['time_out'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form was submitted - validate user ID
    if (isset($_POST['user_id']) && is_numeric($_POST['user_id'])) {
        $user_id = intval($_POST['user_id']);
        
        // Connect to database
        $db = connect_db();

        // Handle clock in or clock out
        if (isset($_POST['clock_in'])) {
            clock_in($db, $user_id);
        } else if (isset($_POST['clock_out'])) {
            clock_out($db, $user_id);
        }

        // Display timekeeping data for this user
        display_timekeeping_data($db, $user_id);
    } else {
        echo "<div class='alert alert-danger'>Invalid User ID</div>";
    }
} else {
    // Form was not submitted - display form
    echo '<form method="post" class="mb-4">
        <div class="form-group">
            <label for="user_id">Employee ID:</label>
            <input type="number" class="form-control" id="user_id" name="user_id" required>
            <small class="form-text text-muted">Please Enter your HRIS Employee I.D.</small>
        </div>
        <button type="submit" name="clock_in" class="btn btn-primary">Clock In</button>
        <button type="submit" name="clock_out" class="btn btn-primary ml-2">Clock Out</button>
    </form>';
    echo "<hr>"; // Add a strong horizontal line here
}

// Add a button that links to the attendance history page
echo '<a href="index.php?page=timekeeping/attendance_history" class="btn btn-secondary mt-4">View Attendance History</a>';
echo "<hr>"; // Add a strong horizontal line here
?>
