<?php 
	include 'includes/db.php';
	if (isset($_GET['order_id'])) {
		$order_id = $_GET['order_id'];
	}


 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Confirm Order</title>
</head>
<body bgcolor="#000">
	<form action=" <?php $_SERVER['PHP_SELF'] ?>" method="post">
		<table width="500" align="center" border="2" bgcolor="#CCC">
			<tr align="center">
				<td colspan="5"><h2>Please confirm your payment</h2></td>
			</tr>

			<tr>
				<td align="right">Bkash Account No:</td>
				<td style="color: #f16e52">017100000000</td>
			</tr>

			<tr>
				<td align="right">Counter No:</td>
				<td style="color: #f16e52">05</td>
			</tr>

			<tr>
				<td align="right">Invoice No:</td>
				<td><input type="text" name="invoice_no" required=""></td>
			</tr>
			<tr>
				<td align="right">Amount Sent:</td>
				<td><input type="text" name="amount" required=""></td>
			</tr>
			<tr>
				<td align="right">Transaction ID:</td>
				<td><input type="text" name="tr" required=""></td>
			</tr>
			<tr>
				<td align="right">Your Bkash No:</td>
				<td><input type="text" name="bkash_no" required=""></td>
			</tr>
			<tr>
				<td align="right">Payment Date:</td>
				<td><input type="text" name="payment_date" required=""></td>
			</tr>
			<tr align="center">
				<td colspan="5"><input type="submit" name="confirm" value="Confirm Payment"></td>
			</tr>

		</table>
	</form>
</body>
</html>


<?php 

	if (isset($_POST['confirm'])) {
		$invoice = $_POST['invoice_no'];
		$amount = $_POST['amount'];
		$tr_no = $_POST['tr'];
		$c_bkash_no = $_POST['bkash_no'];
		$date = $_POST['payment_date'];

		$complete = 'Complete';

		$insert_payment = "INSERT INTO bkash_payment(invoice_no, amount, trans_id, c_bkash_no, b_payment_date) values('$invoice', '$amount', '$tr_no', '$c_bkash_no', '$date')";

		$run_payment = mysqli_query($con, $insert_payment) or die('Can not insert into database. '.mysqli_error($con));

		$update_order = "UPDATE customers_orders SET order_status='$complete' WHERE order_id='$update_id'";

		$run_order = mysqli_query($con, $update_order);

		$update_pending_orders = "UPDATE pending_orders SET order_status='$complete' WHERE order_id='$update_id'";

		$run_pending_orders = mysqli_query($con, $update_pending_orders);

		if ($run_payment) {
			echo "<h2 style='text-align:center; color:white;'>Payment received, Your order will be completed within 24 hours.</h2>";
		}

		$update_order = "UPDATE customers_orders SET order_status='Complete' WHERE order_id = '$order_id'";
		$run_order = mysqli_query($con, $update_order);

	}

 ?>
