<?php
session_start();
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM seller WHERE username='$username' AND password='$password' AND role='seller'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $_SESSION['seller'] = $row['username'];
        header("Location: seller.php");
        exit;
    } else {
        header("Location: seller.php?error=" . urlencode("Invalid seller credentials"));
        exit;
    }
}
?>
