<?php include 'includes/db.php'; ?>
<?php 
	// session_start();

	if (!isset($_SESSION['admin_email'])) {
		echo "<script>window.location.href='admin_login.php'</script>";
	}else{


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>view brands</title>

	<style type="text/css">
		
		th,tr{
			border: 3px groove #000;
		}
	</style>
</head>
<body>
<table width="794" align="center" bgcolor="#FFCCCC">

	<tr align="center">
		<td colspan="8"><h2>View all Brands</h2><br></td>
	</tr>

	<tr>
		<th>Brand Id</th>
		<th>Brand Title</th>
		<th>Delete</th>
		<th>Edit</th>
	</tr>

	<?php 
		
		include 'includes/db.php';

		$get_brands = "SELECT * FROM brands";
		$run_brands = mysqli_query($con, $get_brands);

		while ($row_brands = mysqli_fetch_array($run_brands)) {
			$brand_id = $row_brands['brand_id'];
			$brand_title = $row_brands['brand_title'];
			
		


	 ?>

	<tr align="center">
		<td><?php echo $brand_id; ?></td>
		<td><?php echo $brand_title; ?></td>
		<td><a href="index.php?edit_brand=<?php echo $brand_id; ?>">Edit</a></td>
		<td><a href="index.php?delete_brands=<?php echo $brand_id; ?>">Delete</a></td>
	</tr>

	<?php } ?>
</table>
</body>
</html>

<?php } ?>