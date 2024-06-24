
<?php
echo "<h1 class='mb-4'>CHMC Emergency Room</h1>";
echo "<hr>"; // Add a strong horizontal line here
?>
    <div class="row"></div>
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
                            // Sample data for demonstration
                            $rooms = [
                                ['number' => 404, 'section' => "1A", 'capacity' => 4, 'current capacity' => 4, 'status' => 'Full'],
                                ['number' => 404, 'section' => "2B", 'capacity' => 4, 'current capacity' => 4, 'status' => 'Full'],
                                ['number' => 404, 'section' => "3C", 'capacity' => 4, 'current capacity' => 4, 'status' => 'Full'],
                                ['number' => 404, 'section' => "4D", 'capacity' => 4, 'current capacity' => 4, 'status' => 'Full'],
                                ['number' => 404, 'section' => "5E", 'capacity' => 4, 'current capacity' => 3, 'status' => '1 Available'],
                                ['number' => 404, 'section' => "6F", 'capacity' => 4, 'current capacity' => 2, 'status' => '2 Available'],                                
                            ];

                            foreach ($rooms as $room) {
                                echo "<tr>";
                                echo "<td>{$room['number']}</td>";
                                echo "<td>{$room['section']}</td>";
                                echo "<td>{$room['capacity']}</td>";
                                echo "<td>{$room['current capacity']}</td>";
                                echo "<td>{$room['status']}</td>";
                                echo "</tr>";
                            }
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
