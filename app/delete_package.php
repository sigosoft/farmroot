<?php

session_start();

if(!isset($_SESSION['store']))
 {
   header('location:index.php');
 };


$current = date('Y-m-d');


include "db/config.php";

$Id=$_GET['id'];

$query="delete FROM package WHERE package_id='$Id'";

     if (mysqli_query($conn, $query))
     {

         //mysqli_query($conn,"update products set package_id='NULL' where ProductID='$Id'");
        
       echo "<script> alert('package deleted Successfully');window.location.href = 'manage_package.php';</script>";

     }

     else
     {

       echo "<script> alert('Error Please Try Again');window.location.href = 'manage_package.php';</script>";

     }

?>