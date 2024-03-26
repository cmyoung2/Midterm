<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zippyusedautos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type_name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type_name = mysqli_real_escape_string($conn, $_POST['type_name']);
    
    // Insert new type name into the types table
    $sql = "INSERT INTO types (type_name) VALUES ('$type_name')";

    if ($conn->query($sql) === TRUE) {
        echo "New type added successfully";
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
<title>Add New Type</title>
<link rel="stylesheet" href="View/styles.css">
</head>
<body>
  <div class="container">
    <h2>Add New Type</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="type_name">Type Name:</label>
      <input type="text" name="type_name" required><br><br>
      <button type="submit">Add Type</button>
    </form>
  </div>
</body>
</html>