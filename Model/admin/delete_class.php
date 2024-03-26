<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zippyusedautos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if class ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare a SQL statement to delete the class
    $sql = "DELETE FROM classes WHERE class_id = $id";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Class deleted successfully";
    } else {
        echo "Error deleting class: " . $conn->error;
    }
} else {
    echo "Class ID not provided";
}

// Close the database connection
$conn->close();
?>