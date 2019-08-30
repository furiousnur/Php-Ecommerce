<?php
session_start();
include 'includes/db.php';
include 'functions/functions.php';

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My Shop</title>
    <link rel="stylesheet" href="styles/style.css" media="all">
  </head>
  <body>
    <!-- main container starts -->
    <div class="main_wrapper">
      <!-- Header part start -->
      <div class="header_wrapper">
        <a href="index.php"><img src="images/logo1.gif" style="float:left; height: 100px; width: 300px;"></a>
        <img src="images/banner.png" alt="" style="float:left; width: 700px; height: 100px;">
      </div>
      <!-- end header part -->

      <!-- Navigation Bar -->
      <div id="navbar">
        <ul id="menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="all_products.php">All Products</a></li>
          <li><a href="customer/my_account.php">My Accounts</a></li>
          <li><a href="customer_register.php">Sign Up</a></li>
          <li><a href="cart.php">Shopping Cart</a></li>
          <!-- <li><a href="contact.php">Contact Us</a></li> -->
        </ul>

        <div id="form">
          <form  method="get" action="results.php" enctype="multipart/form-data">
             <input type="text" name="user_query" placeholder="Search a Product"/>
             <input type="submit" name="search" value="Search"/>
          </form>
        </div>

      </div>
      <!-- End Navigation Bar -->

      <!-- Content Area -->
      <div class="content_wrapper">

        <!-- Left sidebar -->
        <div id="left_sidebar">

          <div id="sidebar_title">Categories</div>
          <ul id="cats">
            <?php getCat(); ?>
          </ul>

          <div id="sidebar_title">Brands</div>
          <ul id="cats">
            <?php getBrand(); ?>
          </ul>
        </div>
        <!--end Left sidebar -->


        <!-- right content -->
        <div id="right_content">
          <?php cart(); ?>
          <div id="headline">
            <div id="headline_content">
              <?php
              if (!isset($_SESSION['customer_email'])) {
                echo "<b>Welcome Guest!</b> " . " <b style='color:yellow'>Shoping Cart - </b>";
              }else {
                echo "<b>Welcome:"."<span style='color:skyblue'>".$_SESSION['customer_email']."</span>". "</b> " . "<b style='color:yellow'>Your Shoping Cart - </b>";
              }
               ?>
              <span>- Total Items: <?php items(); ?> - Total Price: <?php totalPrice(); ?> - <a href="cart.php" style="color:#ff0;">Go to Cart</a>
                <?php
                  if (!isset($_SESSION['customer_email'])) {
                    echo "<a href='checkout.php' style='color:#F93;'>&nbsp;Login</a>";
                  }else {
                    echo "<a href='logout.php' style='color:#F93;'>&nbsp;Logout</a>";
                  }
                ?>
                <!-- <a href="logout.php" style="color:#F93;">&nbsp;Logout</a> -->
              </span>
            </div>
          </div>

          <div>
            <form class="" action="customer_register.php" method="post" enctype="multipart/form-data">
              <table width="750" align="center">
                <tr>
                  <h2 align="center">Create an Account</h2><br>
                </tr>
                <tr>
                  <td align="right"><b>Customer Name:</b></td>
                  <td><input type="text" name="c_name" required /></td>
                </tr>
                <tr>
                  <td align="right"><b>Customer Email:</b></td>
                  <td><input type="text" name="c_email" required /></td>
                </tr>
                <tr>
                  <td align="right"><b>Customer Password:</b></td>
                  <td><input type="password" name="c_pass" required /></td>
                </tr>
                <tr>
                  <td align="right"><b>Customer Country:</b></td>
                  <td>
                    <select name="c_country">
                      <option>Select a Country</option>
                      <option>Afganistan</option>
                      <option>Bangladesh</option>
                      <option>Australia</option>
                      <option>India</option>
                      <option>England</option>
                      <option>Pakistan</option>
                      <option>Srilanka</option>
                      <option>Nepal</option>
                      <option>United State</option>
                      <option>South Africa</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td align="right"><b>Customer City:</b></td>
                  <td><input type="text" name="c_city" required /></td>
                </tr>
                <tr>
                  <td align="right"><b>Customer Mobile No:</b></td>
                  <td><input type="text" name="c_contact" required /></td>
                </tr>
                <tr>
                  <td align="right"><b>Customer Address:</b></td>
                  <td><input type="text" name="c_address" required /></td>
                </tr>
                <tr>
                  <td align="right"><b>Customer Image:</b></td>
                  <td><input type="file" name="c_image" required /></td>
                </tr>
                <tr>
                  <td></td>
                  <td align="left"><input type="submit" name="register" value="Submit"></td>
                </tr>
              </table>
            </form>
          </div>
        </div>
        <!-- end right content -->


      </div>
      <!-- End Content Area -->
      <!-- Footer Area -->
      <div class="footer">
        <h1 style="color:#000; padding-top:30px; text-align:center;">&copy 2018 - By Moon</h1>
      </div>
      <!-- End Footer Area -->

    </div>
    <!-- end main container -->
  </body>
</html>


<?php
  if (isset($_POST['register'])) {
    $c_name=$_POST['c_name'];
    $c_email=$_POST['c_email'];
    $c_pass=$_POST['c_pass'];
    $c_country=$_POST['c_country'];
    $c_city=$_POST['c_city'];
    $c_contact=$_POST['c_contact'];
    $c_address=$_POST['c_address'];
    $c_image=$_FILES['c_image']['name'];
    $c_image_tmp=$_FILES['c_image']['tmp_name'];


    $c_ip = getRealIpAddr();

    $insert_customer = "INSERT INTO customers (customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, customer_address, customer_image, customer_ip) values('$c_name', '$c_email', '$c_pass', '$c_country', '$c_city', '$c_contact', '$c_address', '$c_image', '$c_ip')";

    $run_customer = mysqli_query($con, $insert_customer);

    move_uploaded_file($c_image_tmp, "customer/customer_photos/$c_image");

    //checking cart
    $sell_cart = "select * from cart where ip_add='$c_ip'";
    $run_cart = mysqli_query($con, $sell_cart);
    $check_cart = mysqli_num_rows($run_cart);
    //end of checking cart

    if ($check_cart>0) {
      $_SESSION['customer_email'] = $c_email;
      echo "<script>alert('Account Created Successfully, Thank you!')</script>";
      echo "<script>window.location.href='checkout.php'</script>";
    }else {
      $_SESSION['customer_email'] = $c_email;
      echo "<script>alert('Account Created Successfully, Thank you!')</script>";
      echo "<script>window.location.href='index.php'</script>";
    }
  }
 ?>
