<?php include 'includes/db.php'; ?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>insert product</title>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
  </head>
  <body bgcolor="#999999">
    <form class="" action="insert_product.php" method="post" enctype="multipart/form-data">
      <table width="794" align="center" border="1" bgcolor="#1076a6">
        <tr align="center">
          <td colspan="2"><h1>Insert New Product:</h1></td>
        </tr>

        <tr>
          <td align="right"><b>Product Title</b></td>
          <td> <input type="text" name="product_title" value="" size="50"> </td>
        </tr>

        <tr>
          <td align="right"><b>Product Category</b></td>
          <td>
            <select class="" name="product_cat">
              <option>Select a Category</option>
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
            <option>Select Brand</option>
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
          <td> <input type="file" name="product_img1" value=""> </td>
        </tr>

        <tr>
          <td align="right"><b>Product Image 2</b></td>
          <td> <input type="file" name="product_img2" value=""> </td>
        </tr>

        <tr>
          <td align="right"><b>Product Image 3</b></td>
          <td> <input type="file" name="product_img3" value=""> </td>
        </tr>

        <tr>
          <td align="right"><b>Product Price</b></td>
          <td> <input type="text" name="product_price" value=""> </td>
        </tr>

        <tr>
          <td align="right"><b>Product Description</b></td>
          <td> <textarea name="product_desc" value="" cols="39" rows="10"></textarea></td>
        </tr>

        <tr>
          <td align="right"><b>Product Keywords</b></td>
          <td> <input type="text" name="product_keywords" value="" size="50"> </td>
        </tr>

        <tr align="center">
          <td colspan="2"> <input type="submit" name="insert_product" value="Insert Product"> </td>
        </tr>
      </table>
    </form>
  </body>
</html>

<?php
  //text data variable
  if ((isset($_POST['insert_product']))) {
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

    if ($product_title=='' OR $product_cat=='' OR $product_brand=='' OR $product_price=='' OR $product_desc=='' OR $product_keywords=='' OR $product_img1=='') {
      echo "<script>alert('Please fill all the input field!')</script>";
      exit();
    }else{
      //uploading images to it's folder
      move_uploaded_file($temp_name1, "product_images/$product_img1");
      move_uploaded_file($temp_name2, "product_images/$product_img2");
      move_uploaded_file($temp_name3, "product_images/$product_img3");

      $insert_product="INSERT INTO products(cat_id, brand_id, date, product_title,product_img1, product_img2, product_img3, product_price, product_desc, product_keyword, status) values
      ('$product_cat','$product_brand',NOW(),'$product_title','$product_img1','$product_img2','$product_img3','$product_price','$product_desc', '$product_keywords','$status')";

      $run_product = mysqli_query($con, $insert_product) or die ('can not insert product in database. '.mysqli_error($con));
      if ($run_product) {
        echo "<script>alert('Product inserted successfully.')</script>";

        echo "<script>window.location.href='index.php?insert_product'</script>";
      }
    }

  }
 ?>
