<?php
@session_start();
include 'includes/db.php';
// include 'functions/functions.php';
?>

      <div>
				<form action="checkout.php" method="post">
					<span class="login100-form-title">
						<h2> <b>Login Or Register</b> </h2>
            <br>
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter Email">
						<input class="input100" type="email" name="c_email" placeholder="Email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Please enter password">
						<input class="input100" type="password" name="c_pass" placeholder="Password">
						<span class="focus-input100"></span>
					</div>

					<div class="text-right p-t-13 p-b-23">
						<span class="txt1">
							Forgot
						</span>

						<a href="forgot_password.php" class="txt2">
							 Password?
						</a>
					</div>

					<div class="container-login100-form-btn">
            <input type="submit" name="c_login" value="Login">
					</div>

					<div class="flex-col-c p-t-170 p-b-40">
						<span class="txt1 p-b-9">
							Don’t have an account?
						</span>

						<a href="customer_register.php" class="txt3">
							Sign up now
						</a>
					</div>
				</form>
			</div>

<?php
  if (isset($_POST['c_login'])) {
  	
    $customer_email = $_POST['c_email'];
    $customer_pass = $_POST['c_pass'];

    $sel_customer = "SELECT * FROM customers WHERE customer_email = '$customer_email' AND customer_pass = '$customer_pass'";
    $run_customer = mysqli_query($db, $sel_customer);

    $check_customer = mysqli_num_rows($run_customer);
    $get_ip = getRealIpAddr(); 
    $sell_cart = "SELECT * FROM cart WHERE ip_add='$get_ip'";

    $run_cart = mysqli_query($con, $sell_cart);
    $check_cart = mysqli_num_rows($run_cart);
    if ($check_customer==0) {
      echo "<script>alert('Password Or Email address is not correct, Please try again!')</script>";
      exit();
    }

    // if ($check_customer==1 AND $check_cart==0) {
    if ($check_customer>0 AND $check_cart==0){
      $_SESSION['customer_email'] = $customer_email;
      echo "<script>window.location.href='customer/my_account.php'</script>";
    }else {
      $_SESSION['customer_email'] = $customer_email;
      echo "<script>alert('You successfully logged in, You can order now!')</script>";
      include 'payment_options.php';
    }
  }
?>
