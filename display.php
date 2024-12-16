<?php
include 'db.php';
include 'check_login.php';

$sql = "SELECT matric, name, role FROM users";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Display Users</title>
</head>
<body>
<div class="container">
    <h1>User List</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table><tr><th>Matric</th><th>Name</th><th>Role</th><th>Action</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . htmlspecialchars($row['matric']) . "</td><td>" . htmlspecialchars($row['name']) . "</td><td>" . htmlspecialchars($row['role']) . "</td>";
            echo "<td><a href='update.php?matric=" . htmlspecialchars($row['matric']) . "'>Update</a> | <a href='delete.php?matric=" . htmlspecialchars($row['matric']) . "' onclick='return confirm(\"Are you sure?\");'>Delete</a></td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    ?>
</div>
</body>
</html>
<?php
$conn->close();
?>
