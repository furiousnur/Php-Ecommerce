<?php 

include 'includes/db.php';

	if (isset($_GET['delete_c'])) {
		$delete_id = $_GET['delete_c'];

		$delete_customer = "DELETE FROM customers WHERE customer_id = '$delete_id'";

		$run_delete = mysqli_query($con, $delete_customer);

		if ($run_delete) {
			echo "<script>alert('One Customer has been deleted!')</script>";

			echo "<script>window.location.href='index.php?view_customers'</script>";
		}
	}

 ?>