<?php
session_start();

$Store=$_SESSION['store'];
$StoreName=$Store['StoreName'];
$StoreImage=$Store['StoreImage'];
$StoreID=$Store['StoreID'];
$EmployeeID=$Store['EmployeeID'];

require 'db/config.php';


$message='Employee Logged Out From Store: '.$StoreName;

$track_employee=mysqli_query($conn,"INSERT INTO employee_track(EmployeeID, Description, EventType) VALUES ('$EmployeeID','$message', 'Logged Out')");

unset($_SESSION['store']);

header('location:index.php');

?>