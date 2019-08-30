<form action="" method="post">
	<table width="500" align="center">
		<tr align="center">
		  <td colspan="4"><h2>Change Your Password: </h2></td>
		</tr>
		<tr>
			<td align="right">Enter Current Password:</td>
			<td><input type="password" name="old_pass"></td>
		</tr>
		<tr>
			<td align="right">Enter New Password:</td>
			<td><input type="password" name="new_pass"></td>
		</tr>
		<tr>
			<td align="right">Enter New Password Again:</td>
			<td><input type="password" name="cnfrm_pass"></td>
		</tr>

		<tr align="center">
			<td colspan="4"><input type="submit" name="change_pass" value="Change Password"></td>
		</tr>
	</table>
</form>

<?php 

	include 'includes/db.php';
	$c = $_SESSION['customer_email'];
	if (isset($_POST['change_pass'])) {
		
		$old_pass = $_POST['old_pass'];
		$new_pass = $_POST['new_pass'];
		$cnfrm_pass = $_POST['cnfrm_pass'];

		$get_real_pass = "SELECT * FROM customers WHERE customer_pass = '$old_pass'";
		$run_real_pass = mysqli_query($con, $get_real_pass);

		if (mysqli_num_rows($run_real_pass)==0) {
			echo"<script> alert('Your current password is not valid, try again!') </script>";
			exit();
		}

		if ($new_pass!=$cnfrm_pass) {
			echo"<script> alert('Your password did not match, try again!') </script>";
			exit();
		}else{
			$update_pass = "UPDATE customers SET customer_pass='$new_pass' WHERE customer_email='$c'";
			$run_pass = mysqli_query($con, $update_pass);

			echo"<script> alert('Your password has been successfully changed.') </script>";
			echo "<script>window.location.href='my_account.php'</script>";	
		}
	}

 ?>