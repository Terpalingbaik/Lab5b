<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (matric, name, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $matric, $name, $password, $role);
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
<div class="container">
    <h1>Register New User</h1>
    <form action="register.php" method="post">
        Matric Number: <input type="text" name="matric"><br>
        Name: <input type="text" name="name"><br>
        Password: <input type="password" name="password"><br>
        Role: <select name="role">
            <option value="student">Student</option>
            <option value="lecturer">Lecturer</option>
        </select><br>
        <div class="login-prompt">
        Already have an account? <a href="login.php">Log in</a>
    </div>
        <input type="submit" value="Register">
    </form>
</div>
</body>
</html>
