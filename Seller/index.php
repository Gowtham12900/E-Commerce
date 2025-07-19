<!DOCTYPE html>
<html>
<head>
  <title>Seller Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    body {
      background: linear-gradient(to right, #074519ff, #04b43fff);
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
    .login-card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    .form-floating > label {
      color: #6c757d;
    }
    .form-control:focus {
      border-color: #198754;
      box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
    }
  </style>
<body class="bg-light">
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-md-6 col-lg-4">
      <div class="card login-card">
        <div class="card-header text-white text-center bg-warning" style="border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
          <h5 class="mb-0 text-dark"><b>Seller Login</b></h5>
        </div>
        <div class="card-body p-4">
          <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?= $_GET['error']; ?></div>
          <?php endif; ?>

          <form action="valid.php" method="POST">
            <div class="form-floating mb-4">
              <input type="text" name="username" class="form-control" id="floatingUsername" placeholder="Username" required>
              <label for="floatingUsername"><b>Username</b></label>
            </div>

            <div class="form-floating mb-4">
              <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
              <label for="floatingPassword"><b>Password</b></label>
            </div>

            <button type="submit" class="btn btn-warning w-100 py-2"><b>Login as Seller</b></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>

  if (window.history && window.history.pushState) {
    window.history.pushState(null, null, window.location.href);
    window.onpopstate = function () {
      window.history.go(1);
    };
  }


  if (sessionStorage.getItem('seller_login_alert') === '1') {
    alert('Please login to access seller panel');
    sessionStorage.removeItem('seller_login_alert');
  }
</script>

</body>
</html>
