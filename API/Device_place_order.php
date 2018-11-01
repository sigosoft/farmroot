
<?php

include 'Device_connection.php';

$BillingDet_Phone=$_POST['BillingDet_Phone'];
$BillingDet_Name=$_POST['BillingDet_Name'];
$BillingDet_Land=$_POST['BillingDet_Land'];
$BillingDet_City=$_POST['BillingDet_City'];
$BillingDet_Address=$_POST['BillingDet_Address'];


$BillingDet_UserId=$_POST['BillingDet_UserId'];

$UserType="User";


$GrandTotal=$_POST['GrandTotal'];;

$CartData=$_POST['CartData'];

$delevery_date=$_POST['delevery_time'];


$OrderNO='APP'.time();
$InvoiceNO='A'.time();



$query="INSERT INTO app_orders(OrderNO, InvoiceNO, GrandTotal, BillingDet_UserId, UserType, BillingDet_Name,  BillingDet_Phone, BillingDet_Land, BillingDet_City,BillingDet_Address,status,delivery_date) VALUES ('$OrderNO', '$InvoiceNO', '$GrandTotal', '$BillingDet_UserId', '$UserType', '$BillingDet_Name', '$BillingDet_Phone', '$BillingDet_Land', '$BillingDet_City', '$BillingDet_Address', 'Order Placed','$delevery_date')";

if(mysqli_query($conn,$query))
{

  
 $OrderID=mysqli_insert_id($conn);

// $save_address=mysqli_query($conn,"INSERT INTO address_table(BillingDet_Land, BillingDet_City,BillingDet_Address, UserID) VALUES ('$BillingDet_Land', '$BillingDet_City', '$BillingDet_Address', '$BillingDet_UserId')");

 $json = json_decode($CartData, true);

$elementCount  = count($json);





for ($i=0;$i < $elementCount; $i++) 
 {
 

    $ProductName=$json[$i]['ProductName'];
    $Product_Id=$json[$i]['Product_Id'];


    $Quantity=$json[$i]['Quantity'];
    $Product_MRP=$json[$i]['Product_MRP'];
    $Total=$json[$i]['Total'];

    $GetImage=mysqli_query($conn,"SELECT * FROM products WHERE ProductID='$Product_Id'");
    $GetImage_row=mysqli_fetch_assoc($GetImage);
 

    $ProductImage=$GetImage_row['Product_Image'];

  

 $sql=mysqli_query($conn,"INSERT INTO app_order_items(OrderID, ProductID, ProductName, 	ProductImage, 	Quantity, ProductPrice, Total, OrderNo, InvoiceNO) VALUES ('$OrderID', '$Product_Id', '$ProductName', '$ProductImage', '$Quantity', '$Product_MRP', '$Total', '$OrderNO', '$InvoiceNO')");

 $stock=mysqli_query($conn,"UPDATE products SET ProductStock=ProductStock-'$Quantity' WHERE ProductID='$Product_Id'");


 }

$pass['Status']="Success";


}
else
{

$pass['Status']="Failed";

}



print_r(json_encode($pass));



?>