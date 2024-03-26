<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zippyusedautos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch vehicle data from the database
$sql = "SELECT * FROM vehicles";
$result = $conn->query($sql);

// Display vehicle data in a table
if ($result->num_rows > 0) {
    echo "<table><tr><th>Make</th><th>Model</th><th>Year</th><th>Price</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["make"]."</td><td>".$row["model"]."</td><td>".$row["year"]."</td><td>".$row["price"]."</td><td><a href='delete_vehicle.php?id=".$row["id"]."'>Delete</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>