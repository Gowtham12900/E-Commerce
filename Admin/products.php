<?php
session_start();
include '../db.php';
if (!isset($_SESSION['admin'])) {
    header("Location: index.php?error=" . urlencode("Please login to continue"));
    exit;
}

$product_sql = "SELECT * FROM products ORDER BY id ASC";
$product_result = mysqli_query($conn, $product_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin - Product Management</title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  
  <style>
    .nav-link.active {
      background-color: #198754;
      color: white !important;
      border-radius: 5px;
    }
    .table img {
      object-fit: cover;
      border-radius: 5px;
    }
    @media (max-width: 768px) {
      .offcanvas {
        width: 80% !important;
      }
    }


    
  </style>
</head>
<body>


<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid d-flex justify-content-between align-items-center">

    <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
 
    <a class="navbar-brand text-warning mb-0 h1" href="#"><b>Products Management</b></a>
  </div>
</nav>


<div class="offcanvas offcanvas-start custom-sidebar" tabindex="-1" id="sidebarMenu">

  <div class="offcanvas-header">
    <h5 class="offcanvas-title"><b>ElectroShop Admin</b></h5>
    <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link text-dark active" href="products.php">
          <i class="bi bi-box-fill me-2"></i><b>Products</b>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="orders.php">
          <i class="bi bi-clipboard-check me-2"></i><b>Orders</b>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="index.php">
          <i class="bi bi-box-arrow-right me-2"></i><b>Logout</b>
        </a>
      </li>
    </ul>
  </div>
</div>


<div class="container mt-4">

  <h4 class="mb-3"><b>All Products</b></h4>
  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
      <thead class="table-dark">
        <tr>
          <th>#ID</th>
          <th>Image</th>
          <th>Name</th>
          <th>Price</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($product_result)) { ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><img src="../seller/uploads/<?= $row['image'] ?>" width="60" height="60" alt="<?= $row['name'] ?>"></td>
            <td><?= $row['name'] ?></td>
            <td>₹<?= $row['price'] ?></td>
            <td><?= $row['description'] ?></td>
            
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
