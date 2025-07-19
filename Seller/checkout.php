<?php
session_start();
include "../db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
        die("Cart is empty!");
    }

    $cart = $_SESSION['cart'];
    $success = true;

    foreach ($cart as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];
        $order_date = date("Y-m-d H:i:s");
        $status = "Pending";

        $query = "INSERT INTO orders (product_id, quantity, order_date, status, name, email, mobile, pincode, address)
                  VALUES ('$product_id', '$quantity', '$order_date', '$status', '$name', '$email', '$mobile', '$pincode', '$address')";

        if (!mysqli_query($conn, $query)) {
            $success = false;
            break;
        }
    }

    if ($success) {
        unset($_SESSION['cart']);
        echo "<script>alert('Order placed successfully!'); window.location.href='../orders.php';</script>";
    } else {
        echo "<script>alert('Failed to place order.'); window.location.href='../cart.php';</script>";
    }
} else {
    echo "Invalid request.";
}
?>
