<?php
include 'db.php';
include 'check_login.php';

$matric = $_GET['matric'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $role, $matric);
    if ($stmt->execute()) {
        echo "Record updated successfully";
        header("Location: display.php"); 
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
} else {
    $sql = "SELECT name, role FROM users WHERE matric = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Update User</title>
</head>
<body>
<div class="container">
    <h1>Update User</h1>
    <form method="POST">
    <div class="form-input">
        Name: <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>">
    </div>
    <div class="form-input">
        Role: <input type="text" name="role" value="<?= htmlspecialchars($user['role']) ?>">
    </div>
    <div class="button-container">
        <input type="submit" value="Update" class="button submit">
        <input type="button" value="Cancel" onclick="window.history.back();" class="button cancel">
    </div>
</form>

</div>
</body>
</html>
