<?php include 'includes/db.php'; ?>
<?php include 'functions/functions.php';
session_start();
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
              <span>- Total Items: <?php items(); ?> - Total Price: <?php totalPrice(); ?> - <a href="index.php" style="color:#ff0;">Back To Shopping</a>
                <?php
                  if (!isset($_SESSION['customer_email'])) {
                    echo "<a href='checkout.php' style='color:#F93;'>&nbsp;Login</a>";
                  }else {
                    echo "<a href='logout.php' style='color:#F93;'>&nbsp;Logout</a>";
                  }
                ?>
              </span>
            </div>
          </div>

          <div id="products_box"><br>
            <form class="" action="cart.php" method="post" enctype="multipart/form-data">
              <table width="740" align="center" bgcolor="#0099CC"><br><br>
                <tr align="center">
                  <td><b>Remove</b></td>
                  <td><b>Product (s)</b></td>
                  <td><b>Quantity</b></td>
                  <td><b>Total Price</b></td>
                </tr>

                <?php
                //getting the total price of the items from the cart
                  $ip_add=getRealIpAddr();
                  $total = 0;
                  $sel_price = "SELECT * FROM cart where ip_add = '$ip_add'";
                  $run_price = mysqli_query($db, $sel_price);
                  while ($record = mysqli_fetch_array($run_price)) {
                    $pro_id = $record['p_id'];
                    $pro_price = "SELECT * FROM products where product_id = '$pro_id'";
                    $run_pro_price = mysqli_query($con, $pro_price);
                    while ($p_price = mysqli_fetch_array($run_pro_price)) {
                      $product_price = array($p_price['product_price']);
                      $product_title = $p_price['product_title'];
                      $product_image = $p_price['product_img1'];
                      $only_price = $p_price['product_price'];
                      $values = array_sum($product_price);
                      $total += $values;

                 ?>

                <tr>
                  <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"></td>
                  <td><?php echo  $product_title; ?><br><img src="admin_area/product_images/<?php echo  $product_image; ?>" height="80" width="80"></td>
                  <td><input type="text" name="qty" value="1" size="3"></td>
                  <?php
                    if (isset($_POST['update'])) {
                      $qty = $_POST['qty'];
                      $insert_qty = "update cart set qty='$qty' where ip_add='$ip_add'";
                      $run_qty = mysqli_query($con, $insert_qty);
                      $total = $total * $qty;
                    }
                   ?>
                  <td><?php echo "$" . $only_price; ?></td>
                </tr>

              <?php }} ?>

              <tr>
                  <td colspan="3" align="right"><b>Sub Total</b></td>
                  <td><b><?php echo "$" . $total; ?></b></td>
              </tr>

                 <tr></tr>
              <tr align="center">
                <td colspan="2"><input type="submit" name="update" value="Update Cart"/></td>
                <td><input type="submit" name="continue" value="Continue Shopping"/></td>
                <td><button><a href="checkout.php" style="text-decoration:none; color:#000;">Checkout</a></button></td>
                <!-- <td><button><a href="customer/my_account.php" style="text-decoration:none; color:#000;">Checkout</a></button></td> -->
                <!-- <td><button><a href="my_account.php" style="text-decoration:none; color:#000;">Checkout</a></button></td> -->
              </tr>

              </table>
            </form>

            <?php
            function updateCart(){
              global $con;
              if (isset($_POST['update'])) {
                foreach ($_POST['remove'] as $remove_id) {
                  $delete_products = "DELETE FROM cart WHERE p_id = '$remove_id'";
                  $run_delete = mysqli_query($con, $delete_products);
                    if($run_delete){
                      echo "<script>window.open('cart.php', '_self')</script>";
                    }
                }

              }

              if (isset($_POST['continue'])) {
                echo "<script>window.open('index.php', '_self')</script>";
              }
          }

         echo @$up_cart = updateCart();
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
