<?php 

include 'includes/db.php';

	if (isset($_GET['delete_pro'])) {
		$delete_id = $_GET['delete_pro'];

		$delete_pro = "DELETE FROM products WHERE product_id = '$delete_id'";

		$run_delete = mysqli_query($con, $delete_pro);

		if ($run_delete) {
			echo "<script>alert('One Procuct has been deleted!')</script>";

			echo "<script>window.location.href='index.php?view_products'</script>";
		}
	}

 ?>