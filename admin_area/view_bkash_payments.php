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
		<th>Payment No</th>
		<th>Invoice No</th>
		<th>Amount</th>
		<th>Transaction No</th>
		<th>Customer bkash No</th>
		<th>Payment Date</th>
	</tr>

	<?php 
		
		include 'includes/db.php';

		$get_payments = "SELECT * FROM bkash_payment";
		$run_payments = mysqli_query($con, $get_payments);

		$i=0;

		while ($row_payments = mysqli_fetch_array($run_payments)) {

			
			$invoice = $row_payments['invoice_no'];
			$amount = $row_payments['amount'];
			$tr_id = $row_payments['trans_id'];
			$c_bkash_no = $row_payments['c_bkash_no'];
			$date = $row_payments['b_payment_date'];
		
			$i++;

	 ?>

	<tr align="center">  
		<td><?php echo $i; ?></td>
		<td bgcolor="#FF99CC"><?php echo $invoice; ?></td>
		<td><?php echo $amount; ?></td>
		<td><?php echo $tr_id; ?></td>
		<td><?php echo $c_bkash_no; ?></td>
		<td><?php echo $date; ?></td>
	</tr>

	<?php } ?>
</table>
</body>
</html>


<?php } ?>