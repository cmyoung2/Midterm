<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zippyusedautos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if make ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare a SQL statement to delete the make
    $sql = "DELETE FROM makes WHERE make_id = $id";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Make deleted successfully";
    } else {
        echo "Error deleting make: " . $conn->error;
    }
} else {
    echo "Make ID not provided";
}

// Close the database connection
$conn->close();
?>