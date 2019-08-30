<?php 

include 'includes/db.php';

	if (isset($_GET['delete_brands'])) {
		$delete_id = $_GET['delete_brands'];

		$delete_brand = "DELETE FROM brands WHERE brand_id = '$delete_id'";

		$run_delete = mysqli_query($con, $delete_brand);

		if ($run_delete) {
			echo "<script>alert('One Brand has been deleted!')</script>";

			echo "<script>window.location.href='index.php?view_brands'</script>";
		}
	}

 ?>