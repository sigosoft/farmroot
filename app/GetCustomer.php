<?php

header('Content-Type: application/json');

include "db/config.php";


$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); 

$BillingDet_Phone=$input['BillingDet_Phone'];


$sql="SELECT * FROM billing_detail WHERE BillingDet_Phone='$BillingDet_Phone'";
$result=mysqli_query($conn,$sql);
$list = mysqli_fetch_array($result);
$BillingDet_UserId=$list['BillingDet_UserId'];

$pass['customer']=$list;


$query="SELECT * FROM verifed_register WHERE Register_Phone='$BillingDet_Phone' OR Register_Id='BillingDet_UserId'";
$res=mysqli_query($conn,$query);
$row = mysqli_fetch_array($res);
$pass['user']=$row;







$tempData = $pass;

$cleanData =  json_encode($tempData);
print_r($cleanData);



?>