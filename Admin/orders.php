<?php
include '../db.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: index.php?error=" . urlencode("Please login to continue"));
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin - Orders</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .nav-link.active {
      background-color: #198754;
      color: white !important;
      border-radius: 5px;
    }

    .custom-sidebar {
      width: 250px;
    }

    @media (max-width: 768px) {
      .custom-sidebar {
        width: 80% !important;
      }
    }
  </style>
</head>
<body>


<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand text-warning" href="#"><b>Orders Management</b></a>
  </div>
</nav>


<div class="offcanvas offcanvas-start custom-sidebar" tabindex="-1" id="sidebar">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title"><b>ElectroShop Admin</b></h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="nav flex-column">
      <li class="nav-item"><a class="nav-link text-dark" href="products.php"><i class="bi bi-box-fill me-2"></i><b>Products</b></a></li>
      <li class="nav-item"><a class="nav-link text-dark active" href="orders.php"><i class="bi bi-clipboard-check me-2"></i><b>Orders</b></a></li>
      <li class="nav-item"><a class="nav-link text-dark" href="index.php"><i class="bi bi-box-arrow-right me-2"></i><b>Logout</b></a></li>
    </ul>
  </div>
</div>


<div class="container mt-5">
  <h3 class="mb-4"><b>All Orders</b></h3>

  <?php
  $sql = "SELECT orders.id, products.name AS product_name, products.price, products.image,
                 orders.quantity, orders.order_date, orders.status,
                 orders.name, orders.email, orders.mobile, orders.pincode, orders.address
          FROM orders
          JOIN products ON orders.product_id = products.id
          ORDER BY orders.order_date DESC";

  $result = mysqli_query($conn, $sql);

  if (!$result) {
    echo "<div class='alert alert-danger'>Query Error: " . mysqli_error($conn) . "</div>";
  } elseif (mysqli_num_rows($result) > 0) {
    echo "<div class='table-responsive'><table class='table table-bordered align-middle'>
            <thead class='table-dark'>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Pincode</th>
                <th>Address</th>
                
              </tr>
            </thead>
            <tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>
              <td>{$row['id']}</td>
              <td><img src='../seller/uploads/{$row['image']}' width='60'></td>
              <td>{$row['product_name']}</td>
              <td>₹{$row['price']}</td>
              <td>{$row['quantity']}</td>
              <td>{$row['order_date']}</td>
              <td>{$row['name']}</td>
              <td>{$row['email']}</td>
              <td>{$row['mobile']}</td>
              <td>{$row['pincode']}</td>
              <td>{$row['address']}</td>
              
            </tr>";
    }

    echo "</tbody></table></div>";
  } else {
    echo "<div class='alert alert-warning'>No orders found.</div>";
  }
  ?>
</div>

</body>
</html>
