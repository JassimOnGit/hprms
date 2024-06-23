<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Room Capacity</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Emergency Room Capacity</h1>
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Room Number</th>
                                    <th>Capacity</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Sample data for demonstration
                                $rooms = [
                                    ['number' => 101, 'capacity' => 5, 'status' => 'Available'],
                                    ['number' => 102, 'capacity' => 3, 'status' => 'Full'],
                                    ['number' => 103, 'capacity' => 4, 'status' => 'Available'],
                                    ['number' => 104, 'capacity' => 2, 'status' => 'Full']
                                ];

                                foreach ($rooms as $room) {
                                    echo "<tr>";
                                    echo "<td>{$room['number']}</td>";
                                    echo "<td>{$room['capacity']}</td>";
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
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
