<?php
session_start();
include 'db.php';
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ElectroShop - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link rel="stylesheet" href="assets/css/electroshop.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><b>ElectroShop</b></a>
    <div class="d-flex">
      <a href="cart.php" class="btn btn-warning me-2 px-3 py-2"><i class="bi bi-cart-fill me-2"></i> <b>Cart</b></a>

      <a href="orders.php" class="btn btn-success"><i class="bi bi-clipboard-check-fill me-2"></i><b>Orders</b></a>
    </div>
  </div>
</nav>

<div id="heroCarousel" class="carousel slide carousel-fade mb-5" data-bs-ride="carousel" data-bs-interval="2000">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/img/electro-1.jpg" class="d-block w-100" alt="Slide 1" style="height: 400px; object-fit: cover;">
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>

    <div class="carousel-item">
      <img src="assets/img/electro-2.jpg" class="d-block w-100" alt="Slide 2" style="height: 400px; object-fit: cover;">
      <div class="carousel-caption d-none d-md-block">
        
      </div>
    </div>

    <div class="carousel-item">
      <img src="assets/img/electro-3.jpg" class="d-block w-100" alt="Slide 3" style="height: 400px; object-fit: cover;">
      <div class="carousel-caption d-none d-md-block">
        
      </div>
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<div class="container mt-4">
  <div class="row">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <img src="seller/uploads/<?= $row['image'] ?>" class="card-img-top p-3" style="height: 200px; object-fit: contain;" alt="<?= $row['name'] ?>">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= $row['name'] ?></h5>
            <p class="card-text"><?= $row['description'] ?></p>
            <p class="price-tag fw-bold">₹<?= $row['price'] ?></p>
            <form action="seller/add_to_cart.php" method="POST" class="mt-auto">
              <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
              <input type="number" name="quantity" class="form-control mb-3 quantity-input" value="1" min="1" required>
              <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
            </form>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

</body>
</html>
