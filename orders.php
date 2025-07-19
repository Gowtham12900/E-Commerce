<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Orders - ElectroShop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3 py-2">
  <div class="container-fluid d-flex justify-content-between align-items-center flex-wrap">

    <a class="navbar-brand mb-2 mb-sm-0" href="index.php" style="font-size: 1.2rem;">
      <b>ElectroShop</b>
    </a>

    <div class="d-flex gap-2 flex-wrap">
      <a href="cart.php" class="btn btn-warning btn-md px-2 py-1">
        <i class="bi bi-cart-fill me-1"></i><b>Cart</b>
      </a>
      <a href="index.php" class="btn btn-primary btn-md px-2 py-1">
        <i class="bi bi-house-fill me-1"></i><b>Shop</b>
      </a>
    </div>

  </div>
</nav>


<div class="container mt-5">
  <h3 class="mb-4">Your Orders</h3>

  <?php

  $sql = "SELECT orders.id, products.name, products.image, products.price, orders.quantity, orders.order_date, orders.status
          FROM orders
          JOIN products ON orders.product_id = products.id
          ORDER BY orders.order_date ASC";

  $order_result = mysqli_query($conn, $sql);

  if (!$order_result) {
    echo "<div class='alert alert-danger'>Query Error: " . mysqli_error($conn) . "</div>";
  } elseif (mysqli_num_rows($order_result) > 0) {
    echo "<div class='table-responsive'><table class='table table-bordered table-hover align-middle'>
            <thead class='table-dark'>
              <tr>
                <th>Order ID</th>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Date</th>
                <th>Status</th>
                <th>Invoice</th>
              </tr>
            </thead>
            <tbody>";

    while ($row = mysqli_fetch_assoc($order_result)) {
      $subtotal = $row['price'] * $row['quantity'];
      $status = $row['status'];

      $badgeClass = match($status) {
        'Delivered' => 'success',
        'Cancelled' => 'danger',
        'Pending' => 'warning',
        'Shipped' => 'primary'
      };

      echo "<tr>
              <td>{$row['id']}</td>
              <td><img src='seller/uploads/{$row['image']}' alt='{$row['name']}' height='60'></td>
              <td>{$row['name']}</td>
              <td>₹{$row['price']}</td>
              <td>{$row['quantity']}</td>
              <td>₹{$subtotal}</td>
              <td>{$row['order_date']}</td>
              <td><span class='badge bg-{$badgeClass}'>{$status}</span></td>
              <td>
                <a href='generate_invoice.php?order_id={$row['id']}' class='btn btn-sm btn-success'>Download</a>
              </td>
            </tr>";
    }

    echo "</tbody></table></div>";
  } else {
    echo "<div class='alert alert-warning'>No orders found.!</div>";
  }
  ?>
</div>

</body>
</html>
