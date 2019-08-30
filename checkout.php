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

          <div id="products_box">
            <?php
              if (!isset($_SESSION['customer_email'])) {
                include ('customer/customer_login.php');
              }else{
                include ('payment_options.php');
              }
            ?>
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
