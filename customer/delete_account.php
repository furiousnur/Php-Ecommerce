<form action="" method="POST">
	<table align="center" width="600">
		<tr align="center">
			<td colspan="2"> <h2>Do you really want to delete your account?</h2> </td>
		</tr>
		<tr align="center">
			<td>
				<input type="submit" name="yes" value="Yes, I Want to Delete">
				<input type="submit" name="no" value="No, I don't want to delete.">
			</td>
		</tr>
	</table>
</form>

<?php 
	
	// session_start();
	include 'includes/db.php';

	$c = $_SESSION['customer_email'];

	if (isset($_POST['yes'])) {
		$delete_customer = "DELETE FROM customers WHERE customer_email = '$c'";
		$run_delete = mysqli_query($con, $delete_customer);

		if($run_delete){

			session_destroy();
			
			echo "<script>alert('Your Account has been deleted, Good Bye!')</script>";
			echo "<script>window.location.href='../index.php'</script>";
		}
	}

		if (isset($_POST['no'])) {

			echo "<script>window.location.href='my_account.php'</script>";
		
	}
 ?>