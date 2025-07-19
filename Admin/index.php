<?php
session_start();
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login - ElectroShop</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #000134ff, #2575fc);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-box {
      background: #fff;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
    }
  </style>
</head>
<body>
 
  <div class="login-box">
    <h4 class="text-center mb-4"><b>Admin Login</b></h4>
    <form action="login_process.php" method="POST">
      <div class="form-floating mb-3">
  <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
  <label for="username"><b>Username</b></label>
</div>


      <div class="form-floating mb-3">
  <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
  <label for="password"><b>Password</b></label>
</div>


      

      <div class="d-grid">
        <button type="submit" class="btn btn-primary"><b>Login</b></button>
      </div>
      <br>
      <div class="text-center mb-3">
  <a href="forgot_password.php" class="text-decoration-none"><b>Forgot Password?</b></a>
</div>

    </form>
  </div>
<script>
  const urlParams = new URLSearchParams(window.location.search);
  const error = urlParams.get('error');

  if (error) {
    alert(decodeURIComponent(error));
    window.history.replaceState({}, document.title, window.location.pathname);
  }
</script>



</body>
</html>
