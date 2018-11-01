<?php

header('Content-Type: application/json');

include "db/config.php";


$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); 

$VBillingDet_Name=$input['VBillingDet_Name'];


$sql="SELECT * FROM vendors WHERE VendorName='$VBillingDet_Name'";
$result=mysqli_query($conn,$sql);
$list = mysqli_fetch_array($result);


$pass['vendor']=$list;










$tempData = $pass;

$cleanData =  json_encode($tempData);
print_r($cleanData);



?>