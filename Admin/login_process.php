<?php
session_start();
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM electro WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $_SESSION['admin'] = $username;
        header("Location: products.php");
        exit;
    } else {
        echo "<script>alert('Invalid username or password'); window.location.href='index.php';</script>";
    }
}
?>
