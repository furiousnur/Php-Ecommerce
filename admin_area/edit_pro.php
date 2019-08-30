<?php 

  include 'includes/db.php'; 

  //Getting the specific product

  if (isset($_GET['edit_pro'])) {
    
    $edit_id = $_GET['edit_pro'];

    $get_edit = "SELECT * FROM products WHERE product_id='$edit_id'";
    $run_edit = mysqli_query($con, $get_edit);
    $row_edit = mysqli_fetch_array($run_edit);

    $update_id = $row_edit['product_id'];

    $p_title = $row_edit['product_title'];
    $cat_id = $row_edit['cat_id'];
    $brand_id = $row_edit['brand_id'];
    $p_img1 = $row_edit['product_img1'];
    $p_img2 = $row_edit['product_img2'];
    $p_img3 = $row_edit['product_img3'];
    $p_price = $row_edit['product_price'];
    $p_desc = $row_edit['product_desc'];
    $p_keyword = $row_edit['product_keyword'];
  }

  //Getting the product relevant category 
    $get_cat = "SELECT * FROM categories WHERE cat_id='$cat_id'";
    $run_cat = mysqli_query($con, $get_cat);
    $cat_row = mysqli_fetch_array($run_cat);

    $cat_edit_title = $cat_row['cat_title'];

  //Getting the product relevant brand 
    $get_brand = "SELECT * FROM brands WHERE brand_id='$brand_id'";
    $run_brand = mysqli_query($con, $get_brand);
    $brand_row = mysqli_fetch_array($run_brand);

    $brand_edit_title = $brand_row['brand_title'];

  ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>insert product</title>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
  </head>
  <body bgcolor="#999999">
    <form class="" action="" method="post" enctype="multipart/form-data">
      <table width="794" align="center" border="1" bgcolor="#1076a6">
        <tr align="center">
          <td colspan="2"><h1>Update Product:</h1></td>
        </tr>

        <tr>
          <td align="right"><b>Product Title</b></td>
          <td> <input type="text" name="product_title" value="<?php echo $p_title; ?>" size="50"> </td>
        </tr>

        <tr>
          <td align="right"><b>Product Category</b></td>
          <td>
            <select class="" name="product_cat">

              <option value="<?php echo $cat_id; ?>" ><?php echo $cat_edit_title; ?></option>

                <?php
                $get_cats="select * from categories";
                $run_cats=mysqli_query($con, $get_cats);
                while($row_cats=mysqli_fetch_array($run_cats)){
                 
                  $cat_id= $row_cats['cat_id'];
                  $cat_title= $row_cats['cat_title'];
                  
                  echo "<option value='$cat_id'>$cat_title</option>";

                }
                ?>
            </select>
          </td>
        </tr>

        <tr>
          <td align="right"><b>Product Brand</b></td>
          <td>
            <select class="" name="product_brand">
            <option value="<?php echo $brand_id; ?>" ><?php echo $brand_edit_title; ?></option>
              <?php
              $get_cats="select * from brands";
              $run_cats=mysqli_query($con, $get_cats);
              while($row_cats=mysqli_fetch_array($run_cats)){
                
                $brand_id= $row_cats['brand_id'];
                $brand_title= $row_cats['brand_title'];
                
                echo "<option value='$brand_id'>$brand_title</option>";
              }
              ?>
            </select>
          </td>
        </tr>

        <tr>
          <td align="right"><b>Product Image 1</b></td>
          <td> <input type="file" name="product_img1" value=""> <br><img src="product_images/<?php echo $p_img1; ?>" width="70" height="70"> </td>
        </tr>

        <tr>
          <td align="right"><b>Product Image 2</b></td>
          <td> <input type="file" name="product_img2" value=""><br><img src="product_images/<?php echo $p_img2; ?>" width="70" height="70"> </td>
        </tr>

        <tr>
          <td align="right"><b>Product Image 3</b></td>
          <td> <input type="file" name="product_img3" value=""><br> <img src="product_images/<?php echo $p_img3; ?>" width="70" height="70"></td>
        </tr>

        <tr>
          <td align="right"><b>Product Price</b></td>
          <td> <input type="text" name="product_price" value="<?php echo $p_price; ?>"> </td>
        </tr>

        <tr>
          <td align="right"><b>Product Description</b></td>
          <td> <textarea name="product_desc" cols="35" rows="10"><?php echo $p_desc; ?></textarea></td>
        </tr>

        <tr>
          <td align="right"><b>Product Keywords</b></td>
          <td> <input type="text" name="product_keywords" value="<?php echo $p_keyword; ?>" size="50"> </td>
        </tr>

        <tr align="center">
          <td colspan="2"> <input type="submit" name="update_product" value="Update Product"> </td>
        </tr>
      </table>
    </form>
  </body>
</html>

<?php
  //text data variable
  if ((isset($_POST['update_product']))) {
    $product_title=$_POST['product_title'];
    $product_cat=$_POST['product_cat'];
    $product_brand=$_POST['product_brand'];
    $product_price=$_POST['product_price'];
    $product_desc=$_POST['product_desc'];
    $status='on';
    $product_keywords=$_POST['product_keywords'];

    //images name
    $product_img1=$_FILES['product_img1']['name'];
    $product_img2=$_FILES['product_img2']['name'];
    $product_img3=$_FILES['product_img3']['name'];

    //images temp name
    $temp_name1=$_FILES['product_img1']['tmp_name'];
    $temp_name2=$_FILES['product_img2']['tmp_name'];
    $temp_name3=$_FILES['product_img3']['tmp_name'];

    // if ($product_title=='' OR $product_cat=='' OR $product_brand=='' OR $product_price=='' OR $product_desc=='' OR $product_keywords=='' OR $product_img1=='') {
    //   echo "<script>alert('Please fill all the input field!')</script>";
    //   exit();
    // }else{
      //uploading images to it's folder
      move_uploaded_file($temp_name1, "product_images/$product_img1");
      move_uploaded_file($temp_name2, "product_images/$product_img2");
      move_uploaded_file($temp_name3, "product_images/$product_img3");


       $update_product="UPDATE products SET cat_id='$product_cat', brand_id='$product_brand', date='NOW()', product_title='$product_title', product_img1 ='$product_img1', product_img2 ='$product_img2', product_img3 ='$product_img3', product_price ='$product_price', product_desc ='$product_desc', product_keywords ='$product_keywords' WHERE product_id='$update_id'";

      $run_update = mysqli_query($con, $update_product);

      // $run_update = mysqli_query($con, $update_product) or die ('can not update product in database. '.mysqli_error($con));
      if ($run_update) {
        echo "<script>alert('Product updated successfully.')</script>";

        echo "<script>window.location.href='index.php?view_products'</script>"; 
      }
    // }

  }
 ?>
