<?php 

		include 'includes/db.php';

		if (isset($_GET['edit_brand'])) {
			
			$brand_id = $_GET['edit_brand'];

			$edit_brand = "SELECT * FROM brands WHERE brand_id='$brand_id'";

			$run_brand = mysqli_query($con, $edit_brand);

			$row_edit = mysqli_fetch_array($run_brand);

			$brand_edit_id = $row_edit['brand_id'];

			$brand_title = $row_edit['brand_title'];
		}


	 ?>

<!DOCTYPE html>
<html>
<head>
	<title>edit brand</title>
</head>
<body>
	<form action="" method="post" align="center">
		<br><b>Edit Brand</b>

		<input type="text" name="brand_title1" value="<?php echo $brand_title; ?>">
		<input type="submit" name="update_brand" value="Update Brand">
	</form>
</body>
</html>

<?php 

	if (isset($_POST['update_brand'])) {
			$brand_title12 = $_POST['brand_title1'];

			$update_brand = "UPDATE brands SET brand_title='$brand_title12' WHERE brand_id = '$brand_edit_id'";

			$run_update = mysqli_query($con, $update_brand);

			if ($run_update) {
					echo "<script>alert('Brand has been updated successfully.')</script>";

			        echo "<script>window.location.href='index.php?view_brands'</script>";
				}	
		}	

 ?>