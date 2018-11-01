
<?php

include 'Device_connection.php';

$user_id=$_POST['user_id'];
$invoice_no=$_POST['invoice_no'];

$query="UPDATE app_orders SET status='Cancelled' WHERE BillingDet_UserId='$user_id' and InvoiceNO='$invoice_no'";


if(mysqli_query($conn,$query))
{
    $pass['Status']="Success";
}
else
{
    $pass['Status']="Failed";
}

print_r(json_encode($pass));

?>