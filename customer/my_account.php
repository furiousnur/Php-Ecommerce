<?php
@session_start();
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
        <a href="../index.php"><img src="images/logo1.gif" style="float:left; height: 100px; width: 300px;"></a>
        <img src="images/banner.png" alt="" style="float:left; width: 700px; height: 100px;">
      </div>
      <!-- end header part -->

      <!-- Navigation Bar -->
      <div id="navbar">
        <ul id="menu">
          <li><a href="../index.php">Home</a></li>
          <li><a href="../all_products.php">All Products</a></li>
          <li><a href="#">My Accounts</a></li>
          <?php
            if (isset($_SESSION['customer_email'])) {
              echo "<span style='display:none;'><li><a href='../customer_register.php'>Sign Up</a></li></span>";
            }else{
              echo "<li><a href='../customer_register.php'>Sign Up</a></li>";
            }
            ?>
          <li><a href="../customer_register.php">Sign Up</a></li>
          <li><a href="../cart.php">Shopping Cart</a></li>
          <!-- <li><a href="../contact.php">Contact Us</a></li> -->
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

          <div id="sidebar_title">Manage Account:</div>
          <ul id="cats">
            <li id="img">
            <?php
              $customer_session = $_SESSION['customer_email'];
              $get_customer_pic = "select * from customers where customer_email = '$customer_session'";
              $run_customer = mysqli_query($con, $get_customer_pic);
              $row_customer = mysqli_fetch_array($run_customer);
              $customer_pic = $row_customer['customer_image'];
              if (!isset($_SESSION['customer_email'])) {
                echo "No Photo";
              }else{
                echo "<img src='customer_photos/$customer_pic' width='130' height='170'>";
              }
              // echo "<img src='customer_photos/$customer_pic' width='130' height='170'>";
            ?>
          </li>

            <li><a href="my_account.php?my_orders">My Orders</a></li>
            <li><a href="my_account.php?edit_account">Edit Account</a></li>
            <li><a href="my_account.php?change_pass">Change Password</a></li>
            <li><a href="my_account.php?delete_account">Delete Account</a></li>
            <li><a href="logout.php">logout</a></li>
          
          </ul>
        </div>
        <!--end Left sidebar -->


        <!-- right content -->
        <div id="right_content">
          <?php cart(); ?>
          <div id="headline">
            <div id="headline_content">
                <?php
                  if (isset($_SESSION['customer_email'])) {
                    echo "<b>Welcome:"."</b> &nbsp;" ."<b style='color:yellow;'>" . $_SESSION['customer_email'] . "</b>";
                  }
                  if (!isset($_SESSION['customer_email'])) {
                    echo "<a href='../checkout.php' style='color:#F93;'>&nbsp;Login</a>";
                  }else {
                    echo "<a href='logout.php' style='color:#F93;'>&nbsp;Logout</a>";
                  }
                ?>
              </span>
            </div>
          </div>

          <div>
           <h2 style="background: #000; color: #FC9; padding: 20px; text-align: center; border-top:2px solid #FFF;">Manage Your Account Here</h2>

           <!-- //getting the default for customers -->
           <?php getDefault(); ?>

           <?php 

            if (isset($_GET['my_orders'])) {
              include ('my_orders.php');
            }

            if (isset($_GET['edit_account'])) {
              include ('edit_account.php');
            }

             if (isset($_GET['change_pass'])) {
              include ('change_pass.php');
            }

             if (isset($_GET['delete_account'])) {
              include ('delete_account.php');
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
