<?php
include 'db.php';
include 'check_login.php';

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    $sql = "DELETE FROM users WHERE matric = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matric);
    if ($stmt->execute()) {
        echo "Record deleted successfully";
        header("Location: display.php"); 
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
