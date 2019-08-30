<?php include 'includes/db.php'; ?>
<?php include 'functions/functions.php'; ?>
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
          <li><a href="my_account.php">My Accounts</a></li>
          <li><a href="customer_register.php">Sign Up</a></li>
          <li><a href="cart.php">Shopping Cart</a></li>
          <li><a href="contact.php">Contact Us</a></li>
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
          <div id="headline">
            <div id="headline_content">
              <b>Welcome Guest!</b>
              <b style="color:yellow;"> Shopping Cart:</b>
              <span>- Items: - Price:</span>
            </div>
          </div>
          <div id="products_box">
            <?php
            if (isset($_GET['search'])) {
                $user_keyword= $_GET['user_query']; //search box input field name user_query
                $get_products = "SELECT * FROM products where  product_keyword like '%$user_keyword%'";
                $run_products = mysqli_query($con, $get_products);
                $count = mysqli_num_rows($run_products);
                if ($count==0) {
                  echo "<h2>No Products found!</h2>";
                }
                while ($row_products=mysqli_fetch_array($run_products)) {
                  $pro_id = $row_products['product_id'];
                  $pro_title = $row_products['product_title'];
                  $pro_cat = $row_products['cat_id'];
                  $pro_brand = $row_products['brand_id'];
                  $pro_desc = $row_products['product_desc'];
                  $pro_price = $row_products['product_price'];
                  $pro_image = $row_products['product_img1'];

                  echo "
                  <div id='single_product'>
                    <h3  style='padding-bottom:3px;' >$pro_title</h3>
                    <img src='admin_area/product_images/$pro_image' width='180' height='180' /><br/>
                    <p><b>Price: $pro_price</b></p>
                    <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                    <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>
                  </div>
                  ";
                  }
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
