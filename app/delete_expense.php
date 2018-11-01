<?php 

session_start();


require 'db/config.php';

$ExpenseID=$_GET['id'];




$sql="DELETE FROM expense_table WHERE ExpenseID=$ExpenseID";
 mysqli_query($conn,$sql);
 
 header("location:manage_expense.php");

?>