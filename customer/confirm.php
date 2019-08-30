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
				<td><h4>Bkash Agent No: 01700000000</h4></td>
				<td><h4>Rocket Agent No: 01700000000</h4></td>
			</tr>
			<tr>
				<td align="right">Invoice No:</td>
				<td><input type="text" name="invoice_no"></td>
			</tr>
			<tr>
				<td align="right">Amount Sent:</td>
				<td><input type="text" name="amount"></td>
			</tr>
			<tr>
				<td align="right">Select Payment Mode:</td>
				<td>
					<select name="payment_mode">
						<option>Select Payment</option>
						<option>Bkash</option>
						<option>Rocket</option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right">Transaction/Refferance ID:</td>
				<td><input type="text" name="tr"></td>
			</tr>
			<tr>
				<td align="right">Payment Date:</td>
				<td><input type="text" name="payment_date"></td>
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
		$payment_method = $_POST['payment_mode'];
		$ref_no = $_POST['tr'];
		$code = $_POST['code'];
		$date = $_POST['payment_date'];

		$complete = 'Complete';

		$insert_payment = "INSERT INTO payments(invoice_no, amount, payment_mode, ref_no, code, payment_date) values('$invoice', '$amount', '$payment_method', '$ref_no', '$code', '$date')";

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
