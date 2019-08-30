<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Payment_Options</title>
  </head>
  <body>

<?php
  include 'includes/db.php';
 ?>

<div class="" align="center" style="padding:20px;">
  <h2>Payment Options for you</h2>

  <?php
    $ip = getRealIpAddr();
    $get_customer = "select * from customers where customer_ip = '$ip'";
    $run_customer = mysqli_query($con, $get_customer);
    $customer = mysqli_fetch_array($run_customer);
    $customer_id = $customer['customer_id'];
   ?>
<b>Pay with</b>&nbsp; <a href="customer/my_orders_bkash.php"><img src="images/bkash2.jpg" alt="" width="80"></a><a href="customer/my_orders_rocket.php"><img src="images/card_dbbl1.png" alt="" width="80"></a><br> <br>
<!-- <p>
<b>If you selected "Pay Offline" option then please check your email or account to find the Invoice No for your order.</b>
</p> -->
</div>
