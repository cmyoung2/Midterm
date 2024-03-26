<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zippyusedautos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if vehicle ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare a SQL statement to delete the vehicle
    $sql = "DELETE FROM vehicles WHERE id = $id";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Vehicle deleted successfully";
    } else {
        echo "Error deleting vehicle: " . $conn->error;
    }
} else {
    echo "Vehicle ID not provided";
}

// Close the database connection
$conn->close();
?>