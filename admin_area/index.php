<?php 
	session_start();

	if (!isset($_SESSION['admin_email'])) {
		echo "<script>window.location.href='admin_login.php'</script>";
	}else{


 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Admin Area</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css" media="all">
</head>
<body>
	<div class="wrapper">
		<div class="header">
			
		</div>

		<div class="right">
			<h2>Manage Content</h2>
			<a href="index.php?insert_product">Insert New Product</a>
			<a href="index.php?view_products">View All Product</a>
			<a href="index.php?insert_cat">Insert New Category</a>
			<a href="index.php?view_cats">View All Category</a>
			<a href="index.php?insert_brands">Insert New Brand</a>
			<a href="index.php?view_brands">View All Brand</a>
			<a href="index.php?view_customers">View Customers</a>
			<a href="index.php?view_orders">View Orders</a>
			<!-- <a href="index.php?view_payments">View Payments</a> -->
			<a href="index.php?view_bkash_payments">View Bkash Payments</a>
			<a href="index.php?view_rocket_payments">View Rocket Payments</a>
			<a href="admin_logout.php">Admin Logout</a>
		</div>

		<div class="left">

		<h2 style="color: red; text-align: center; padding: 10px;"><?php echo @$_GET['logged_in']; ?></h2>

			<?php 
				include 'includes/db.php';

				if (isset($_GET['insert_product'])) {
					include 'insert_product.php';
				}
				
				if (isset($_GET['view_products'])) {
					include 'view_products.php';
				}

				if (isset($_GET['edit_pro'])) {
					include 'edit_pro.php';
				}

				if (isset($_GET['insert_cat'])) {
					include 'insert_cat.php';
				}

				if (isset($_GET['view_cats'])) {
					include 'view_cats.php';
				}

				if (isset($_GET['edit_cat'])) {
					include 'edit_cat.php';
				}

				if (isset($_GET['delete_cat'])) {
					include 'delete_cat.php';
				}


				if (isset($_GET['insert_brands'])) {
					include 'insert_brands.php';
				}

				if (isset($_GET['view_brands'])) {
					include 'view_brands.php';
				}

				if (isset($_GET['edit_brand'])) {
					include 'edit_brand.php';
				}

				if (isset($_GET['delete_brands'])) {
					include 'delete_brands.php';
				}

				if (isset($_GET['view_customers'])) {
					include 'view_customers.php';
				}

				if (isset($_GET['delete_c'])) {
					include 'delete_cusotmer.php';
				}

				if (isset($_GET['view_orders'])) {
					include 'view_orders.php';
				}

				if (isset($_GET['view_payments'])) {
					include 'view_payments.php';
				}

				if (isset($_GET['view_bkash_payments'])) {
					include 'view_bkash_payments.php';
				}

				if (isset($_GET['view_rocket_payments'])) {
					include 'view_rocket_payments.php';
				}
			 ?>
		</div>

	</div>
</body>
</html>

<?php 
	} 

 ?>