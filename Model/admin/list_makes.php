<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zippyusedautos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query the makes table
$sql = "SELECT * FROM makes";
$result = $conn->query($sql);

// Display make data in table format
if ($result->num_rows > 0) {
    echo "<h2>List of Makes</h2>";
    echo "<table><tr><th>ID</th><th>Name</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["make_name"]."</td>";
        echo "<td>";
        echo "<a href='delete_make.php?id=".$row["id"]."'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>