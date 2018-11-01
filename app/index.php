<?php
session_start();

if(isset($_SESSION['store']))
 {
   header('location:dashboard.php');
 };

require 'db/config.php';

if(isset($_POST['submit']))
{
  

 $Username=$_POST['Username'];
 $Password=md5($_POST['Password']);



$sql="SELECT * FROM auth WHERE UserName='$Username' AND Password='$Password'";

$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
    
if(mysqli_num_rows($result)==1)
{


    $_SESSION['store']=$row;
    header('location:dashboard.php');

}

else
{

echo "<script language='javascript'>alert('login failed,try again')</script>";
}




};

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Farmroot | Store</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
              <img src="images/store.png">
            <form method="POST">
              <h1>Login</h1>
              <div>
                <input type="text" class="form-control" name="Username" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="Password" placeholder="Password" required="" />
              </div>
              <div>

                <button type="submit" class="btn btn-default submit" name="submit">Log In</button> 
               
              </div>

              <div class="clearfix"></div>

              <div class="separator">
               

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-shopping-bag"></i> Farmroot</h1>
                  <p>©2017 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>


      </div>
    </div>
    <style>
    .login {
    background: #2b482b;
}
        </style>
        
    </style>
  </body>
</html>
