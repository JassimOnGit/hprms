<?php
// Assuming you have a similar structure for connecting to the database as shown above

// Initialize variables
$room_numbers = [];
$sections = [];

// Fetch room numbers and sections for dropdowns
$sql_room_numbers = "SELECT DISTINCT room_number FROM rooms";
$result_room_numbers = $conn->query($sql_room_numbers);
if ($result_room_numbers->num_rows > 0) {
    while ($row = $result_room_numbers->fetch_assoc()) {
        $room_numbers[] = $row['room_number'];
    }
}

$sql_sections = "SELECT DISTINCT section FROM rooms";
$result_sections = $conn->query($sql_sections);
if ($result_sections->num_rows > 0) {
    while ($row = $result_sections->fetch_assoc()) {
        $sections[] = $row['section'];
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_number = $_POST['room_number'];
    $section = $_POST['section'];
    $current_capacity = $_POST['current_capacity'];

    // Update rooms table
    $sql = "UPDATE rooms 
            SET current_capacity = '$current_capacity' 
            WHERE room_number = '$room_number' AND section = '$section'";

    if ($conn->query($sql) === TRUE) {
        echo "Room capacity updated successfully";
    } else {
        echo "Error updating room capacity: " . $conn->error;
    }
    $conn->close();
}
?>

<!-- Form for updating room capacity -->
<form method="post" action="">
    <div class="form-group">
        <label for="room_number">Room Number:</label>
        <select id="room_number" name="room_number" class="form-control" required>
            <?php foreach ($room_numbers as $room): ?>
                <option value="<?php echo $room; ?>"><?php echo $room; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="section">Section:</label>
        <select id="section" name="section" class="form-control" required>
            <?php foreach ($sections as $sec): ?>
                <option value="<?php echo $sec; ?>"><?php echo $sec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="current_capacity">Current Capacity:</label>
        <input type="number" id="current_capacity" name="current_capacity" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Room Capacity</button>
    <button type="button" class="btn btn-secondary" onclick="redirectToPatientView()">Patient View</button>
</form>
<script>
function redirectToPatientView() {
        var currentUrl = window.location.href; // Get current URL
        var baseUrl = currentUrl.split('?')[0]; // Split URL to get base URL (without query parameters)
        var newUrl = baseUrl + "?page=emergency"; // Construct new URL
        window.location.href = newUrl; // Redirect to new URL
    }
</script>