<!DOCTYPE html>
<html>
<head>
	<title>insert category</title>
</head>
<body>
	<form action="" method="post" align="center">
		<br><b>Insert New Category</b>

		<input type="text" name="cat_title">
		<input type="submit" name="insert_cat" value="Insert Category">
	</form>

	<?php 

		include 'includes/db.php';



		if (isset($_POST['insert_cat'])) {
			
			$cat_title = $_POST['cat_title'];

			if ($cat_title == '') {
				echo "<script>alert('Please fill all the input field!')</script>";
      			exit();
			}else{

				$insert_cat = "INSERT INTO categories(cat_title) VALUES('$cat_title')";
				
				$run_cat = mysqli_query($con, $insert_cat) or die ('can not insert category in database. '.mysqli_error($con));
			      
			      if ($run_cat) {
			        echo "<script>alert('Category inserted successfully.')</script>";

			        echo "<script>window.location.href='index.php?view_cats'</script>";
			      }
				}
		}


	 ?>
</body>
</html>