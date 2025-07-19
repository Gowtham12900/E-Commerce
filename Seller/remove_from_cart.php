<?php
session_start();

if (isset($_GET['id'])) {
  $productIdToRemove = $_GET['id'];

  if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $index => $item) {
      if ($item['product_id'] == $productIdToRemove) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        break;
      }
    }
  }
}

header("Location: ../cart.php");
exit;
