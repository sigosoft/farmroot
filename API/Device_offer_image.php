<?php 

include 'Device_connection.php';



$query="SELECT * FROM offer_image";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $offer_image[]=$row;

}

}
else
{
   $offer_image[]="No offer_image";
}




$output['offer_image']=$offer_image;





$pass=$output;


print_r(json_encode($pass));





?>