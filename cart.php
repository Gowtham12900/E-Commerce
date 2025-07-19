<?php
session_start();
include "db.php";
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}
$cart = $_SESSION['cart'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Cart - ElectroShop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php"><b>ElectroShop</b></a>
    <div class="ms-auto">
      <a href="index.php" class="btn btn-primary me-2"><i class="bi bi-house-fill me-2"></i><b>Home</b></a>
      <a href="orders.php" class="btn btn-success"><i class="bi bi-clipboard-check-fill me-2"></i><b>Orders</b></a>
    </div>
  </div>
</nav> 

<div class="container mt-5">
  <h3 class="mb-4"><i class="bi bi-cart-fill me-1"></i><b>My Cart</b></h3>

  <?php if (count($cart) === 0): ?>
    <div class="alert alert-warning">Your cart is empty!</div>
  <?php else: ?>
    <form action="seller/checkout.php" method="post">
      <?php
      $total = 0;
      foreach ($cart as $item):
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];
        $res = mysqli_query($conn, "SELECT * FROM products WHERE id = $product_id");
        if ($res && mysqli_num_rows($res) > 0):
          $product = mysqli_fetch_assoc($res);
          $subtotal = $product['price'] * $quantity;
          $total += $subtotal;
      ?>
      <div class="row border p-3 align-items-center mb-3">
        <div class="col-md-2">
          <img src="seller/uploads/<?= $product['image'] ?>" class="img-fluid" alt="<?= $product['name'] ?>" style="height: 80px;">
        </div>
        <div class="col-md-4">
          <h5><?= $product['name'] ?></h5>
          <p>₹<?= $product['price'] ?> × <?= $quantity ?> = ₹<?= $subtotal ?></p>
        </div>
        <div class="col-md-3">
          <input type="hidden" name="product_ids[]" value="<?= $product_id ?>">
          <input type="hidden" name="quantities[]" value="<?= $quantity ?>">
        </div>
        <div class="col-md-3 text-end">
          <a href="seller/remove_from_cart.php?id=<?= $product_id ?>" class="btn btn-danger">Remove</a>
        </div>
      </div>
      <?php endif; endforeach; ?>

      <div class="text-end">
        <h5>Total: ₹<?= $total ?></h5>
        <button class="btn btn-success" type="button" onclick="showCheckoutForm()">Proceed to Checkout</button>
      </div>
    </form>

    <div id="checkoutFormWrapper" class="container justify-content-center mt-4" style="display: none;">

      <div class="p-4 border rounded bg-light shadow" style="max-width: 600px; width: 100%;">
        <h5 class="mb-4 text-center">Enter Your Details to Confirm Order</h5>
        <form action="seller/checkout.php" method="POST">
  <div class="form-floating mb-3">
    <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" required>
    <label for="name">Full Name</label>
  </div>

  <div class="form-floating mb-3">
    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
    <label for="email">Email</label>
  </div>

  <div class="form-floating mb-3">
    <input type="number" name="mobile" id="mobile" class="form-control" placeholder="Mobile Number" required>
    <label for="mobile">Mobile</label>
  </div>

  <div class="form-floating mb-3">
    <input type="number" name="pincode" id="pincode" class="form-control" placeholder="Pincode" required>
    <label for="pincode">Pincode</label>
  </div>

  <div class="form-floating mb-3">
    <textarea name="address" id="address" class="form-control" placeholder="Address" style="height: 100px;" required></textarea>
    <label for="address">Address</label>
  </div>

  <div class="text-center">
    <button type="submit" class="btn btn-success w-100">Confirm Order</button>
  </div>
</form>

      </div>
    </div>
  <?php endif; ?>
</div>

<script>
  function showCheckoutForm() {
    const form = document.getElementById('checkoutFormWrapper');
    form.style.display = 'flex';
    form.classList.add('d-flex');
    form.scrollIntoView({ behavior: 'smooth' });
  }
</script>


</body>
</html>
