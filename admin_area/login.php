<?php 

include 'includes/db.php';
@session_start();
 
if(isset($_POST['submit'])){

    $uname=$_POST['username'];
    $password=$_POST['password'];
    
    $sql="SELECT * FROM wp_admin WHERE username='".$uname."'AND password='".md5($password)."' limit 1";
    
    $result=mysqli_query($con, $sql);
    $check_customer = mysqli_num_rows($result);

    if($check_customer>0){
        $_SESSION['username']=$uname;
        echo "<script>alert('You successfully loged in!')</script>";
        echo "<script>window.location.href='insert_product.php'</script>";

    }
    else{
        // echo " You Have Entered Incorrect Password";
        $_SESSION['username']=$uname;
        echo "<script>window.location.href='login.php'</script>";

    }
        
}
?>

<!DOCTYPE html>
<html>
    <head>
         <title> Login Form</title>
         <link rel="stylesheet" a href="css\style.css">
         <link rel="stylesheet" a href="css\font-awesome.min.css">
         <link rel="stylesheet" type="text/css" href="styles/loginStyle.css">
    </head>
<body>
     <div class="container">
         <img src="styles/login.png"/>
         <form method="POST" action="#">
             <div class="form-input">
                <input type="text" name="username" placeholder="Enter the User Name"/> 
             </div>
             <div class="form-input">
                <input type="password" name="password" placeholder="password"/>
             </div>
             <input name="submit" type="submit" value="LOGIN" class="btn-login"/>
         </form>
     </div>
</body>
</html>