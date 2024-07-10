<?php
echo "<h1 class='mb-4'>CHMC Emergency Room Status</h1>";
echo "<hr>"; // Add a strong horizontal line here
?>
<div class="row">
    <div class="col-md-12">
        <div class="card mt-4">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Room Number</th>
                            <th>Section</th>
                            <th>Capacity</th>
                            <th>Current Capacity</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Connect to the database (replace with your database credentials)
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

                        // Query rooms data
                        $sql = "SELECT room_number, section, capacity, current_capacity FROM rooms";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each room
                            while ($row = $result->fetch_assoc()) {
                                $room_number = $row['room_number'];
                                $section = $row['section'];
                                $capacity = $row['capacity'];
                                $current_capacity = $row['current_capacity'];
                                $available_capacity = $capacity - $current_capacity;
                                $status = $available_capacity > 0 ? "{$available_capacity} available" : "Full";

                                echo "<tr>";
                                echo "<td>{$room_number}</td>";
                                echo "<td>{$section}</td>";
                                echo "<td>{$capacity}</td>";
                                echo "<td>{$current_capacity}</td>";
                                echo "<td>{$status}</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No rooms found</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
echo "<hr>"; // Add a strong horizontal line here
?>
