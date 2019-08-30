<!DOCTYPE html>
<html>
<head>
	<title>insert brand</title>
</head>
<body>
	<form action="" method="post" align="center">
		<br><b>Insert New Brand</b>

		<input type="text" name="brand_title">
		<input type="submit" name="insert_brands" value="Insert Brand">
	</form>

	<?php 

		include 'includes/db.php';

		if (isset($_POST['insert_brands'])) {
			
			$brand_title = $_POST['brand_title'];

			if ($brand_title == '') {
				echo "<script>alert('Please fill all the input field!')</script>";
      			exit();
			}else{

				$insert_brand = "INSERT INTO brands(brand_title) VALUES('$brand_title')";
				
				$run_brand = mysqli_query($con, $insert_brand) or die ('can not insert brand in database. '.mysqli_error($con));
			      
			      if ($run_brand) {
			        echo "<script>alert('Brand inserted successfully.')</script>";

			        echo "<script>window.location.href='index.php?view_brands'</script>";
			      }
				}
		}


	 ?>
</body>
</html>