<?php
session_start();

include '../db.php';
if (!isset($_SESSION['seller'])) {
    echo "<script>
        sessionStorage.setItem('seller_login_alert', '1');
        window.location.href = '../seller/index.php';
    </script>";
    exit;
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];
    $img_name = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp, "uploads/$img_name");

    mysqli_query($conn, "INSERT INTO products (name, price, description, image) VALUES ('$name', '$price', '$desc', '$img_name')");
    header("Location: seller.php");
}


if (isset($_POST['delete'])) {
    $id = $_POST['product_id'];

 
    $result = mysqli_query($conn, "SELECT image FROM products WHERE id=$id");
    $row = mysqli_fetch_assoc($result);
    $imageFile = $row['image'];


    $filePath = "uploads/" . $imageFile;
    if (file_exists($filePath)) {
        unlink($filePath);
    }


    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
    header("Location: seller.php");
}


if (isset($_POST['save'])) {
    $id = $_POST['product_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];
    $update = "UPDATE products SET name='$name', price='$price', description='$desc' WHERE id=$id";
    mysqli_query($conn, $update);
    header("Location: seller.php");
}

$products = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Seller - Product Dashboard</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    .nav-link.active {
      background-color: green;
      color: white !important;
      border-radius: 5px;
    }
    .table img {
      object-fit: cover;
      border-radius: 5px;
    }
    @media (max-width: 768px) {
      .offcanvas { width: 80% !important; }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-dark" style="background-color: #008000;">

  <div class="container-fluid d-flex justify-content-between align-items-center">
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <span class="navbar-brand"><b>Product Management</b></span>
  </div>
</nav>

<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title"><b>ElectroShop Seller</b></h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link active" href="seller.php"><i class="bi bi-box-fill"></i> <b>Products</b></a>
        <a class="nav-link text-dark" href="seller_orders.php"><i class="bi bi-cart-check-fill"></i> <b>Orders</b></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="logout.php"><i class="bi bi-box-arrow-right"></i> <b>Logout</b></a>
      </li>
    </ul>
  </div>
</div>

<div class="container mt-4">
  <h3 class="mb-4">Add New Product</h3>
  <form method="POST" enctype="multipart/form-data" class="row g-3">
    <input type="hidden" name="add" value="1">
    <div class="col-md-4">
      <input type="text" name="name" class="form-control" placeholder="Product Name" required>
    </div>
    <div class="col-md-4">
      <input type="number" name="price" class="form-control" placeholder="Price" required>
    </div>
    <div class="col-md-4">
      <input type="file" name="image" class="form-control" required>
    </div>
    <div class="col-12">
      <textarea name="description" class="form-control" placeholder="Description" required></textarea>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-success">Add Product</button>
    </div>
  </form>

  <hr class="my-4">
  <h4>Your Products</h4>

  <div class="table-responsive mt-3">
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Image</th>
          <th>Name</th>
          <th>Price</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($products)) { ?>
          <tr>
            <form method="POST">
              <td><?= $row['id'] ?></td>
              <td><img src="uploads/<?= $row['image'] ?>" width="60" height="60"></td>
              <td><input type="text" name="name" value="<?= $row['name'] ?>" class="form-control"></td>
              <td><input type="number" name="price" value="<?= $row['price'] ?>" class="form-control"></td>
              <td><textarea name="description" class="form-control"><?= $row['description'] ?></textarea></td>
              <td class="d-flex gap-2">
                <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                <button type="submit" name="save" class="btn btn-success btn-sm">Save</button>
            </form>
            <form method="POST" onsubmit="return confirm('Are you sure to delete this product?')">
                <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
            </form>
              </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
