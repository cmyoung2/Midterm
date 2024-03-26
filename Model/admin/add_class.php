<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zippyusedautos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$class_name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_name = mysqli_real_escape_string($conn, $_POST['class_name']);
    
    // Insert new class name into the classes table
    $sql = "INSERT INTO classes (class_name) VALUES ('$class_name')";

    if ($conn->query($sql) === TRUE) {
        echo "New class added successfully";
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
<title>Add New Class</title>
<link rel="stylesheet" href="View/styles.css">
</head>
<body>
  <div class="container">
    <h2>Add New Class</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="class_name">Class Name:</label>
      <input type="text" name="class_name" required><br><br>
      <button type="submit">Add Class</button>
    </form>
  </div>
</body>
</html>