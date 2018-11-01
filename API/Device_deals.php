<?php 

include 'Device_connection.php';



$query="SELECT todays_deal.*, products.* FROM todays_deal INNER JOIN products ON todays_deal.TodaysDeal_ProductId=products.ProductID";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $Deals[]=$row;

}

}
else
{
   $Deals[]="No Deals";
}




$output['Deals']=$Deals;





$pass=$output;


print_r(json_encode($pass));





?>