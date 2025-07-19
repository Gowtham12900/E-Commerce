<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $update = "UPDATE orders SET status='$status' WHERE id=$order_id";
    mysqli_query($conn, $update);

    header("Location: seller_orders.php");
}
?>
