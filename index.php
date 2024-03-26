<?php
$servername = "thh2lzgakldp794r.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "qxbwl337s3n8evk7";
$password = "ww5cb0qkh2wg8xuv";
$dbname = "ctozpdl8y7s01bqu";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT v.year, m.make_name, v.model, t.type_name, c.class_name, v.price 
        FROM vehicles v
        JOIN makes m ON v.make_id = m.make_id
        JOIN types t ON v.type_id = t.type_id
        JOIN classes c ON v.class_id = c.class_id";


$filters = [];
if (isset($_GET['make_id']) && $_GET['make_id'] !== '') {
    $filters[] = "v.make_id = '" . $_GET['make_id'] . "'";
}
if (isset($_GET['type_id']) && $_GET['type_id'] !== '') {
    $filters[] = "v.type_id = '" . $_GET['type_id'] . "'";
}
if (isset($_GET['class_id']) && $_GET['class_id'] !== '') {
    $filters[] = "v.class_id = '" . $_GET['class_id'] . "'";
}


if (!empty($filters)) {
    $sql .= " WHERE " . implode(" AND ", $filters);
}

if (isset($_GET['sort']) && $_GET['sort'] === 'year') {
    $sql .= " ORDER BY v.year DESC";
} else {
    $sql .= " ORDER BY v.price DESC";
}

// Execute the SQL query
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zippy Used Autos</title>
<link rel="stylesheet" type="text/css" href="View/styles.css">
</head>
<body>
  <h1>Zippy Used Autos Inventory</h1>
  
  <!-- Sorting Form -->
  <form method="get">
    <label for="sort">Sort by:</label>
    <select name="sort" id="sort">
      <option value="price">Price</option>
      <option value="year">Year</option>
    </select>
    <button type="submit">Sort</button>
  </form>

  <!-- Filtering Form -->
  <form method="get">
    <label for="make_id">Make:</label>
    <select name="make_id" id="make_id">
      <option value="">All Makes</option>
      <?php
      $makesResult = $conn->query("SELECT * FROM makes");
      while ($row = $makesResult->fetch_assoc()) {
          echo "<option value='".$row["make_id"]."'>".$row["make_name"]."</option>";
      }
      ?>
    </select>
    
    <label for="type_id">Type:</label>
    <select name="type_id" id="type_id">
      <option value="">All Types</option>
      <!-- Populate options dynamically from the database -->
      <?php
      $typesResult = $conn->query("SELECT * FROM types");
      while ($row = $typesResult->fetch_assoc()) {
          echo "<option value='".$row["type_id"]."'>".$row["type_name"]."</option>";
      }
      ?>
    </select>
    
    <label for="class_id">Class:</label>
    <select name="class_id" id="class_id">
      <option value="">All Classes</option>
      <!-- Populate options dynamically from the database -->
      <?php
      $classesResult = $conn->query("SELECT * FROM classes");
      while ($row = $classesResult->fetch_assoc()) {
          echo "<option value='".$row["class_id"]."'>".$row["class_name"]."</option>";
      }
      ?>
    </select>
    
    <button type="submit">Filter</button>
  </form>

  <!-- Display Inventory -->
  <div>
    <?php
    if ($result->num_rows > 0) {
        echo "<table><tr><th>Year</th><th>Make</th><th>Model</th><th>Type</th><th>Class</th><th>Price</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["year"]."</td><td>".$row["make_name"]."</td><td>".$row["model"]."</td><td>".$row["type_name"]."</td><td>".$row["class_name"]."</td><td>".$row["price"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>
  </div>
</body>
</html>
