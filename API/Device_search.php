<?php

include 'Device_connection.php';
$pro_id = $_POST['prod_id'];


$sql="SELECT * FROM products WHERE 	ProductID='$pro_id'";
$result=mysqli_query($conn,$sql);


if(mysqli_num_rows($result)>0)
{

while($row=mysqli_fetch_assoc($result))
{
    $list[]=$row;
}


}
else
{
   $list[]="no data";
}



$output['list']=$list;

$pass=$output;
print_r(json_encode($pass));



?>
