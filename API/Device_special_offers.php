<?php 

include 'Device_connection.php';



//$query="SELECT * FROM special_offers";
//$query="SELECT * FROM products where period_from <= '$d' and period_to >= '$d'";
$query="SELECT * FROM products where offer_price!=''";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $images[]=$row;

}

}
else
{
   $images[]="No offer images";
}




$output['images']=$images;





$pass=$output;


print_r(json_encode($pass));





?>