<?php 

include 'Device_connection.php';

$package_id=$_POST['package_id'];

$query="SELECT * FROM products where package_id='$package_id'";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $packages[]=$row;

}

}
else
{
   $packages[]="No packages";
}




$output['packages']=$packages;





$pass=$output;


print_r(json_encode($pass));





?>