<?php 
	session_start();
	include 'includes/db.php';
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="login.css" media="all">
</head>
<body>
	<div class="login">
	<h1>Admin Login</h1>
    <form method="post">
    	<input type="text" name="email" placeholder="Email" required="required" />
        <input type="password" name="pass" placeholder="Password" required="required" />
        <button type="submit" name="admin_login" class="btn btn-primary btn-block btn-large">Let me in.</button>
    </form>
</div>

	<h2 style="color: white; text-align: center; padding: 20px;"><?php echo @$_GET['logout']; ?></h2>
</body>
</html>


<?php 
	
	if (isset($_POST['admin_login'])) {
		$admin_email = $_POST['email'];
		$admin_pass = $_POST['pass'];

		$query = "SELECT * FROM admins WHERE admin_email='$admin_email' AND admin_pass='$admin_pass'";

		$con = mysqli_query($con, $query);

		$check_admin = mysqli_num_rows($con);

		if ($check_admin==1) {

			$_SESSION['admin_email'] = $admin_email;
			// echo "<script>alert('Your login successfull')</script>";
			echo "<script>window.location.href='index.php?logged_in=You successfully logged in!'</script>";
		}else{
			echo "<script>alert('Your Email or Password is incorrect, try again!')</script>";
			
		}

	}

 ?>