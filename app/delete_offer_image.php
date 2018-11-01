<?php

session_start();

if(!isset($_SESSION['store']))
 {
   header('location:index.php');
 };


$current = date('Y-m-d');


require 'db/config.php';

$OfferImageID=$_GET['id'];




//$sql="DELETE FROM special_offers WHERE id=$OfferImageID";
 //mysqli_query($conn,$sql);
// header("location:manage_offer_images.php");

$sql="UPDATE products SET offer_price='',period_from='',period_to='' WHERE ProductID='$OfferImageID' ";
mysqli_query($conn,$sql);
header("location:manage_offer_images.php");

?>