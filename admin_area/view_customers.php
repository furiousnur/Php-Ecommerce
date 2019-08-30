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
		<td colspan="8"><h2>View All Customers</h2><br></td>
	</tr>

	<tr align="center">
		<th>S.N</th>
		<th>Name</th>
		<th>Email</th>
		<th>Eamge</th>
		<th>Country</th>
		<th>Delete</th>
	</tr>

	<?php 
		
		include 'includes/db.php';

		$get_c = "SELECT * FROM customers";
		$run_c = mysqli_query($con, $get_c);

		$i=0;

		while ($row_c = mysqli_fetch_array($run_c)) {
			$c_id = $row_c['customer_id'];
			$c_name = $row_c['customer_name'];
			$c_email = $row_c['customer_email'];
			$c_img = $row_c['customer_image'];
			$c_country = $row_c['customer_country'];
		
			$i++;

	 ?>

	<tr align="center">  
		<td><?php echo $i; ?></td>
		<td><?php echo $c_name; ?></td>
		<td><?php echo $c_email; ?></td>
		<td><img src="../customer/customer_photos/<?php echo $c_img; ?>" width="60" height="60"></td>
		<td><?php echo $c_country; ?></td>
		<td><a href="delete_customer.php?delete_c=<?php echo $c_id; ?>">Delete</a></td>
	</tr>

	<?php } ?>
</table>
</body>
</html>

<?php } ?>