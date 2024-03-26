<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zippyusedautos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if type ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare a SQL statement to delete the type
    $sql = "DELETE FROM types WHERE type_id = $id";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Type deleted successfully";
    } else {
        echo "Error deleting type: " . $conn->error;
    }
} else {
    echo "Type ID not provided";
}

// Close the database connection
$conn->close();
?>