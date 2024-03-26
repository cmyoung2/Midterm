<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zippyusedautos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query the types table
$sql = "SELECT * FROM types";
$result = $conn->query($sql);

// Display type data in table format
if ($result->num_rows > 0) {
    echo "<h2>List of Types</h2>";
    echo "<table><tr><th>ID</th><th>Name</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["type_name"]."</td>";
        echo "<td>";
        echo "<a href='delete_type.php?id=".$row["id"]."'>Delete</a>";
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
