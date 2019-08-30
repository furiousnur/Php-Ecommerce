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
	<title>view category</title>

	<style type="text/css">
		
		th,tr{
			border: 3px groove #000;
		}
	</style>
</head>
<body>
<table width="794" align="center" bgcolor="#FFCCCC">

	<tr align="center">
		<td colspan="8"><h2>View all categories</h2><br></td>
	</tr>

	<tr>
		<th>Category Id</th>
		<th>Category Title</th>
		<th>Delete</th>
		<th>Edit</th>
	</tr>

	<?php 
		
		include 'includes/db.php';

		$get_cats = "SELECT * FROM categories";
		$run_cats = mysqli_query($con, $get_cats);

		while ($row_cats = mysqli_fetch_array($run_cats)) {
			$cat_id = $row_cats['cat_id'];
			$cat_title = $row_cats['cat_title'];
			
		


	 ?>

	<tr align="center">
		<td><?php echo $cat_id; ?></td>
		<td><?php echo $cat_title; ?></td>
		<td><a href="index.php?edit_cat=<?php echo $cat_id; ?>">Edit</a></td>
		<td><a href="index.php?delete_cat=<?php echo $cat_id; ?>">Delete</a></td>
	</tr>

	<?php } ?>
</table>
</body>
</html>

<?php } ?>