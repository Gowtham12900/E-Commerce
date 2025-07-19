<?php
session_start();
include "../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $security_answer = $_POST['security_answer'];
    $new_password = $_POST['new_password'];

    $check = mysqli_query($conn, "SELECT * FROM electro WHERE username = '$username' AND security_answer = '$security_answer'");
    
    if (mysqli_num_rows($check) === 1) {
        mysqli_query($conn, "UPDATE electro SET password = '$new_password' WHERE username = '$username'");
        $success = "Password reset successfully";
    } else {
        $error = "Invalid username or security answer";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <style>
    body
    {
       background: linear-gradient(to right, #000134ff, #2575fc);
    }
  </style>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  <div class="p-5 shadow rounded bg-white w-100" style="max-width: 500px;">
    <h4 class="mb-4 text-center"><b>Forgot Password</b></h4>

    <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="post">
      <div class="form-floating mb-3">
  <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
  <label for="username"><b>Username</b></label>
</div>


      <div class="form-floating mb-3">
  <input type="text" name="security_answer" id="security_answer" class="form-control" placeholder="What is your favorite color?" required>
  <label for="security_answer"><b>What is your favorite color?</b></label>
</div>


      <div class="form-floating mb-3">
  <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required>
  <label for="new_password"><b>New Password</b></label>
</div>


      <button type="submit" class="btn btn-primary w-100"><b>Reset Password</b></button>
      <div class="text-center mt-3">
        <a style="text-decoration:none;" href="index.php"><b>Back to Login</b></a>
      </div>
    </form>
  </div>
</div>
</body>
</html>
