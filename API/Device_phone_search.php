<?php

include 'Device_connection.php';


$ph=$_POST['phone'];


if($ph != NULL){
$query="SELECT * from users where phone='$ph' OR email='$ph' ";

$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

  $search[]="success";



}
else
{
   $search[]="Failed";
}
}
else{
    $search[]="Failed";
}

$output['search']=$search;

$pass=$output;

print_r(json_encode($pass));

?>
