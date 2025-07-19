<?php
require_once('tcpdf/tcpdf.php');
include 'db.php';

if (isset($_GET['order_id'])) {
  $order_id = intval($_GET['order_id']);

  $sql = "SELECT orders.id, products.name, products.price, products.image, orders.quantity, orders.order_date
          FROM orders
          JOIN products ON orders.product_id = products.id
          WHERE orders.id = $order_id";

  $result = mysqli_query($conn, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $pdf = new TCPDF();
    $pdf->AddPage();

  $html = "
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 14px;
      color: #333;
    }
    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }
    th, td {
      border: 1px solid #999;
      padding: 12px 15px;
      text-align: center;
    }
    th {
      background-color: #f2f2f2;
      font-weight: bold;
    }
    .summary {
      margin-bottom: 20px;
    }
    .summary td {
      padding: 10px;
      border: none;
    }
    .thankyou {
      text-align: center;
      position: absolute;
      bottom: 60px;
      width: 100%;
      font-size: 15px;
      font-weight: bold;
    }
  </style>

  <h2>ElectroShop Invoice</h2>

  <table class='summary'>
    <tr>
      <td><strong>Order ID:</strong></td>
      <td>{$row['id']}</td>
    </tr>
    <tr>
      <td><strong>Order Date:</strong></td>
      <td>{$row['order_date']}</td>
    </tr>
  </table>

  <table>
    <thead>
      <tr>
        <th><b>Product</b></th>
        <th><b>Price</b></th>
        <th><b>Quantity</b></th>
        <th><b>Total</b></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{$row['name']}</td>
        <td>{$row['price']}</td>
        <td>{$row['quantity']}</td>
        <td>" . ($row['price'] * $row['quantity']) . "</td>
      </tr>
    </tbody>
  </table>


";



    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output("Invoice_Order_{$row['id']}.pdf", 'D');
    exit;
  } else {
    echo "Order not found.";
  }
}
?>
