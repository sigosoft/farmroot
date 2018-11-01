<?php

header('Content-Type: application/json');

include "db/config.php";


$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); 

$ProductName=$input['ProductName'];


$sql="SELECT * FROM products WHERE PsearchName='$ProductName'";
$result=mysqli_query($conn,$sql);
$list = mysqli_fetch_array($result);
$pass['Product']=$list;

// $pass['sas']=$tester;

$tempData = $pass;

$cleanData =  json_encode($tempData);
print_r($cleanData);



?>