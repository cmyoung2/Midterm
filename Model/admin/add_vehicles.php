<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zippyusedautos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$make = $model = $year = $price = $type = $class = "";

$types_query = "SELECT * FROM types";
$types_result = $conn->query($types_query);

$classes_query = "SELECT * FROM classes";
$classes_result = $conn->query($classes_query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $make = mysqli_real_escape_string($conn, $_POST['make']);
    $model = mysqli_real_escape_string($conn, $_POST['model']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $class = mysqli_real_escape_string($conn, $_POST['class']);
    
    // Insert new vehicle data into the vehicles table
    $sql = "INSERT INTO vehicles (make_id, model, year, price, type_id, class_id) VALUES ('$make', '$model', '$year', '$price', '$type', '$class')";

    if ($conn->query($sql) === TRUE) {
        echo "New vehicle added successfully";
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
<title>Add New Vehicle</title>
</head>
<body>
  <h2>Add New Vehicle</h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="make">Make:</label>
    <input type="text" name="make" required><br><br>
    <label for="model">Model:</label>
    <input type="text" name="model" required><br><br>
    <label for="year">Year:</label>
    <input type="text" name="year" required><br><br>
    <label for="price">Price:</label>
    <input type="text" name="price" required><br><br>
    <label for="type">Type:</label>
    <select name="type">
        <?php
        if ($types_result->num_rows > 0) {
            while ($row = $types_result->fetch_assoc()) {
                echo "<option value='" . $row["type_id"] . "'>" . $row["type_name"] . "</option>";
            }
        }
        ?>
    </select><br><br>
    <label for="class">Class:</label>
    <select name="class">
        <?php
        if ($classes_result->num_rows > 0) {
            while ($row = $classes_result->fetch_assoc()) {
                echo "<option value='" . $row["class_id"] . "'>" . $row["class_name"] . "</option>";
            }
        }
        ?>
    </select><br><br>
    <button type="submit">Add Vehicle</button>
  </form>
</body>
</html>