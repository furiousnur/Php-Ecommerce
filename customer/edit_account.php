<?php 
@session_start();
include 'includes/db.php';

	if (isset($_GET['edit_account'])) {
		$customer_email = $_SESSION['customer_email'];

		$get_customer = "SELECT * FROM customers WHERE customer_email = '$customer_email'";
		$query = mysqli_query($con, $get_customer);

		$row = mysqli_fetch_array($query);

		$id = $row['customer_id'];
		$name = $row['customer_name'];
		$email = $row['customer_email'];
		$pass = $row['customer_pass'];
		$country = $row['customer_country'];
		$city = $row['customer_city'];
		$contact = $row['customer_contact'];
		$address = $row['customer_address'];
		$image = $row['customer_image'];
		// $customer_ip = $row['customer_ip'];

	}

 ?>

   		<div>
            <form class="" action="" method="post" enctype="multipart/form-data">
              <table width="750" align="center">
                <tr>
                  <h2 align="center" colspan="8">Update Your Account</h2><br>
                </tr>
                <tr>
                  <td align="right"><b>Customer Name:</b></td>
                  <td><input type="text" name="c_name" value="<?php echo $name;?>" /></td>
                </tr>
                <tr>
                  <td align="right"><b>Customer Email:</b></td>
                  <td><input type="text" name="c_email" value="<?php echo $email;?>"  /></td>
                </tr>
                <tr>
                  <td align="right"><b>Customer Password:</b></td>
                  <td><input type="password" name="c_pass" value="<?php echo $pass;?>"  /></td>
                </tr>
                <tr>
                  <td align="right"><b>Customer Country:</b></td>
                  <td>
                    <select name="c_country" disabled="">
                      <option value="<?php echo '$country';?>" ><?php echo $country;?> </option>
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
                  <td><input type="text" name="c_city" value="<?php echo $city;?>" /></td>
                </tr>
                <tr>
                  <td align="right"><b>Customer Mobile No:</b></td>
                  <td><input type="text" name="c_contact" value="<?php echo $contact;?>" /></td>
                </tr>
                <tr>
                  <td align="right"><b>Customer Address:</b></td>
                  <td><input type="text" name="c_address" value="<?php echo $address;?>" /></td>
                </tr>
                <tr>
                  <td align="right"><b>Customer Image:</b></td>
                  <td><input type="file" name="c_image" size="100"/> <img src="customer_photos/<?php echo $image;?>" align="center" width="100" height="100"></td>
                </tr>
                <tr>
                  <td></td>
                  <td align="left"><input type="submit" name="update_account" value="Update Now"></td>
                </tr>
              </table>
            </form>
        </div>

<!-- update customer account -->
 <?php
  if (isset($_POST['update_account'])) {
  		
  	$update_id = $id;	

    $c_name=$_POST['c_name'];
    $c_email=$_POST['c_email'];
    $c_pass=$_POST['c_pass'];
    $c_country=$_POST['c_country'];
    $c_city=$_POST['c_city'];
    $c_contact=$_POST['c_contact'];
    $c_address=$_POST['c_address'];
    $c_image=$_FILES['c_image']['name'];
    $c_image_tmp=$_FILES['c_image']['tmp_name'];

    move_uploaded_file($c_image_tmp, "customer_photos/$c_image");


    $update_c = "UPDATE customers SET customer_name='$c_name', customer_email='$c_email', customer_pass='$c_pass', customer_country='$c_country', customer_city='$c_city', customer_contact='$c_contact', customer_address='$c_address', customer_image='$c_image' WHERE customer_id='$update_id'";

    $run_c = mysqli_query($con, $update_c);

	    if ($run_c) {
	    	echo "<script>alert('Your account has been updated!')</script>";
	    	echo "<script>window.location.href='my_account.php'</script>";	
	    }
	    
  }

 ?>
       