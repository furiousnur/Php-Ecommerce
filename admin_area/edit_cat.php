<?php 

		include 'includes/db.php';

		if (isset($_GET['edit_cat'])) {
			
			$cat_id = $_GET['edit_cat'];

			$edit_cat = "SELECT * FROM categories WHERE cat_id='$cat_id'";

			$run_cat = mysqli_query($con, $edit_cat);

			$row_edit = mysqli_fetch_array($run_cat);

			$cat_edit_id = $row_edit['cat_id'];

			$cat_title = $row_edit['cat_title'];
		}


	 ?>

<!DOCTYPE html>
<html>
<head>
	<title>edit category</title>
</head>
<body>
	<form action="" method="post" align="center">
		<br><b>Edit Category</b>

		<input type="text" name="cat_title1" value="<?php echo $cat_title; ?>">
		<input type="submit" name="update_cat" value="Update Category">
	</form>
</body>
</html>

<?php 

	if (isset($_POST['update_cat'])) {
			$cat_title12 = $_POST['cat_title1'];

			$update_cat = "UPDATE categories SET cat_title='$cat_title12' WHERE cat_id = '$cat_edit_id'";

			$run_update = mysqli_query($con, $update_cat);

			if ($run_update) {
					echo "<script>alert('Category has been updated successfully.')</script>";

			        echo "<script>window.location.href='index.php?view_cats'</script>";
				}	
		}	

 ?>