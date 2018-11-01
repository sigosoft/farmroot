<?php

session_start();

if(!isset($_SESSION['store']))
 {
   header('location:index.php');
 };


$current = date('Y-m-d');


require 'db/config.php';

$dealID=$_GET['id'];




$sql="DELETE FROM todays_deal WHERE TodaysDeal_Id=$dealID";
 mysqli_query($conn,$sql);
 header("location:manage_deals.php");

?>