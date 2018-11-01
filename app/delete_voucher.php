<?php 

session_start();


require 'db/config.php';

$CashVoucherID=$_GET['id'];




$sql="DELETE FROM cash_voucher WHERE CashVoucherID=$CashVoucherID";
 mysqli_query($conn,$sql);
 
 header("location:manage_cash_vouchers.php");

?>