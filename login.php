<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    $sql = "SELECT password, role FROM users WHERE matric = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['matric'] = $matric;
            $_SESSION['role'] = $row['role'];
            header("location: display.php");
        } else {
            echo "Invalid credentials";
        }
    } else {
        echo "No user found with that matric number";
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
    <title>Login</title>
</head>
<body>
<div class="container">
    <h1>Login</h1>
    <form action="login.php" method="post">
        Matric Number: <input type="text" name="matric"><br>
        Password: <input type="password" name="password"><br>
        <div class="register-prompt">
        Don't have an account? <a href="register.php">Register here</a>
    </div>
        <input type="submit" value="Login">
    </form>
</div>
</body>
</html>
