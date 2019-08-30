<?php 

	include 'includes/db.php';
	// session_start();

	if (!isset($_SESSION['admin_email'])) {
		echo "<script>window.location.href='admin_login.php'</script>";
	}else{


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>view customers</title>

	<style type="text/css">
		
		th,tr{
			border: 3px groove #000;
		}
	</style>
</head>
<body>
<table width="794" align="center" bgcolor="#FFCCCC">

	<tr align="center">
		<td colspan="8"><h2>View All Oreders</h2><br></td>
	</tr>

	<tr align="center">
		<th>Oreder No</th>
		<th>Customer</th>
		<th>Invoice No</th>
		<th>Order ID</th>
		<th>Quantity</th>
		<th>Status</th>
	</tr>

	<?php 
		
		include 'includes/db.php';

		$get_orders = "SELECT * FROM customers_orders";
		$run_orders = mysqli_query($con, $get_orders);

		$i=0;

		while ($row_orders = mysqli_fetch_array($run_orders)) {

			$order_id = $row_orders['order_id'];
			$c_id = $row_orders['customer_id'];
			$invoice = $row_orders['invoice_no'];
			$p_id = $row_orders['order_id'];
			$qty = $row_orders['total_products'];
			$status = $row_orders['order_status'];
		
			$i++;

	 ?>

	<tr align="center">  
		<td><?php echo $i; ?></td>
		<td>
			<?php 
				$get_customer = "SELECT * FROM customers WHERE customer_id='$c_id'";
				$run_customer = mysqli_query($con, $get_customer);
				$row_customer = mysqli_fetch_array($run_customer);

				$customer_email = $row_customer['customer_email'];
				echo $customer_email;
			 ?>
		</td>
		<td bgcolor="#FF99CC"><?php echo $invoice; ?></td>
		<td><?php echo $p_id; ?></td>
		<td><?php echo $qty; ?></td>
		<td><?php 

			if ($status=='Pending') {
				echo $status = 'Pending';
			}else{
				echo $status = 'Complete';
			}

		 ?>
		 </td>
	</tr>

	<?php } ?>
</table>
</body>
</html>

<?php } ?>