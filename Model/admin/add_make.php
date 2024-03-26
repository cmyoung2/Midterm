<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zippyusedautos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$make_name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $make_name = mysqli_real_escape_string($conn, $_POST['make_name']);
    
    // Insert new make name into the makes table
    $sql = "INSERT INTO makes (make_name) VALUES ('$make_name')";

    if ($conn->query($sql) === TRUE) {
        echo "New make added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add New Make</title>
<link rel="stylesheet" href="View/styles.css">
</head>
<body>
  <div class="container">
    <h2>Add New Make</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="make_name">Make Name:</label>
      <input type="text" name="make_name" required><br><br>
      <button type="submit">Add Make</button>
    </form>
  </div>
</body>
</html>