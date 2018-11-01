<?php 

include 'Device_connection.php';



$query="SELECT * FROM category";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $Category[]=$row;

}

}
else
{
   $Category[]="No Category";
}




$output['Category']=$Category;





$pass=$output;


print_r(json_encode($pass));





?>