<?php

include 'Device_connection.php';



$query="SELECT * FROM testimonial";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $testimonial[]=$row;

}

}
else
{
   $testimonial[]="No Testimonials";
}




$output['testimonial']=$testimonial;





$pass=$output;


print_r(json_encode($pass));





?>
