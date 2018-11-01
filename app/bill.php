
<?php

session_start();

if(!isset($_SESSION['store']))
 {
   header('location:index.php');
 };


$current = date('Y-m-d');



include "db/config.php";



if(isset($_POST['submit']))
{





$BillingDet_Phone=$_POST['BillingDet_Phone'];
$BillingDet_Name=$_POST['BillingDet_Name'];
$BillingDet_Land=$_POST['BillingDet_Land'];
$BillingDet_City=$_POST['BillingDet_City'];
$BillingDet_State=$_POST['BillingDet_State'];
$BillingDet_PIN=$_POST['BillingDet_PIN'];
$BillingDet_Address=$_POST['BillingDet_Address'];
$BillingDet_UserId=$_POST['BillingDet_UserId'];
$BillingDet_Email=$_POST['Register_Email'];

$BillingDet_UserId=$_POST['BillingDet_UserId'];

$BillingDet_date=$_POST['BillingDet_date'];
$BillingDet_time=$_POST['BillingDet_time'].$_POST['time1'];
$delivery_date=$_POST['d_date'];

$UserType="Guest";


$GrandTotal=0;

for($i = 0; $i<count($_POST['ProductName']); $i++) 
{

 $Total=$_POST['Total'][$i]; 
 $GrandTotal=$GrandTotal+$Total;

};



$OrderNO='APP'.time();
$InvoiceNO='A'.time();



$query="INSERT INTO app_orders(OrderNO, InvoiceNO, GrandTotal, BillingDet_UserId, UserType, BillingDet_Name, BillingDet_Email, BillingDet_Phone, BillingDet_Land, BillingDet_City, BillingDet_State, BillingDet_PIN, BillingDet_Address, status,billing_date,billing_time,delivery_date) VALUES ('$OrderNO', '$InvoiceNO', '$GrandTotal', '$BillingDet_UserId', '$UserType', '$BillingDet_Name', '$BillingDet_Email', '$BillingDet_Phone', '$BillingDet_Land', '$BillingDet_City', '$BillingDet_State', '$BillingDet_PIN', '$BillingDet_Address', 'Order Placed','$BillingDet_date','$BillingDet_time','$delivery_date')";

if(mysqli_query($conn,$query))
{

  
 $OrderID=mysqli_insert_id($conn);

 for($i = 0; $i<count($_POST['ProductName']); $i++)  
 {
 

   $ProductName=$_POST['ProductName'][$i];
   $Product_Id=$_POST['Product_Id'][$i];


   $Quantity=$_POST['Quantity'][$i];
   $Product_MRP=$_POST['Product_MRP'][$i];
   $Total=$_POST['Total'][$i];

   
   $ProductImage="aaa";

$sql=mysqli_query($conn,"INSERT INTO app_order_items(OrderID, ProductID, ProductName, ProductImage, Quantity, ProductPrice, Total, OrderNo, InvoiceNO) VALUES ('$OrderID', '$Product_Id', '$ProductName', '$ProductImage', '$Quantity', '$Product_MRP', '$Total', '$OrderNO', '$InvoiceNO')");


$sq="select * from purchase_table where item='$Product_Id' and d_date='$delivery_date'";
$s=mysqli_query($conn,$sq);
if(mysqli_num_rows($s)>0)
{
    mysqli_query($conn,"update purchase_table set item='$Product_Id',d_date='$delivery_date',quantity=quantity+'$Quantity' where item='$Product_Id' and d_date='$delivery_date'");
}
else
{
    mysqli_query($conn,"INSERT INTO purchase_table(item,d_date,quantity)VALUES('$Product_Id','$delivery_date','$Quantity')");
   //echo "oooook";
}

 }

}
else
{


}



};






?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Farmroot | Store</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    
    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 

<!-- Ajax Live Search  -->


<script src="typeahead.min.js"></script>
<script>
$(document).ready(function(){
$('input.typeahead').typeahead({
name: 'typeahead',
remote:'search.php?key=%QUERY',
limit : 10
});
});

</script>


<script>
$(document).ready(function(){
$('input.BillingDet_Name').typeahead({
name: 'BillingDet_Name',
remote:'search_customer.php?key=%QUERY',
limit : 10
});
});

</script>


<style type="text/css">

.typeahead, .tt-query, .tt-hint {
  border: 1px solid #CCCCCC;

  font-size: 18px;
  height: 35px;
  line-height: 30px;
  outline: medium none;
  padding: 8px 12px;
  width: 276px;
}
.typeahead {
  background-color: #FFFFFF;
}
.typeahead:focus {
  border: 1px solid #0097CF;
}
.tt-query {
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
  color: #999999;
}
.tt-dropdown-menu {
  background-color: #FFFFFF;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 8px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  margin-top: 12px;
  padding: 8px 0;
  width: 422px;
}
.tt-suggestion {
  font-size: 18px;
  line-height: 24px;
  padding: 3px 20px;
}
.tt-suggestion.tt-is-under-cursor {
  background-color: #0097CF;
  color: #FFFFFF;
}
.tt-suggestion p {
  margin: 0;
}
</style>


<!-- Ajax Live Search  -->


  </head>

  <body class="nav-md">


  <?php require 'partials/sidebar.php'; ?>

     <form method="POST">
<div class="right_col" role="main">
  <h4>Customer Details </h4>
  <div class=" conatiner">
    <div class="row">
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-4">
             <input class="form-control" name="BillingDet_Phone" placeholder="Phone" id="BillingDet_Phone" onchange="GetCustomer()" oninput="GetCustomer()" required="required" type="text">
          </div>
          
           <div class="col-md-4">
             <input class="form-control" name="BillingDet_Name" id="BillingDet_Name" placeholder="Customer Name" required="required" type="text">
          </div>
           <div class="col-md-4">
             <input class="form-control" id="BillingDet_City" name="BillingDet_City" placeholder="City" required="required" type="text">
          </div>
        </div><br>
         <div class="row">
          <div class="col-md-4">
             <input class="form-control" id="BillingDet_PIN" name="BillingDet_PIN" placeholder="PIN Code" required="required" type="text">
          </div>
           <div class="col-md-4">
             <input class="form-control" id="BillingDet_State" name="BillingDet_State" placeholder="State" required="required" type="text">
          </div>
           <div class="col-md-4">
             <input class="form-control" id="BillingDet_Land" name="BillingDet_Land" placeholder="Land Mark" required="required" type="text">
            
          </div>
        </div><br>

            <div class="row">
                
          <div class="col-md-4">
             <input class="form-control" id="Register_Email" name="Register_Email" placeholder="Email" required="required" type="text">

              <input type="hidden" name="BillingDet_UserId" id="BillingDet_UserId">
          </div>
          
          <div class="col-md-4">
             <input class="form-control" name="BillingDet_date" id="BillingDet_date" placeholder="Billing Date" value="<?php echo date('Y-m-d'); ?>" required="required" type="date">
          </div> 
          
          
          <div class="col-md-2">
             <input class="form-control" name="BillingDet_time" id="BillingDet_time" placeholder="Billing Time" required="required" type="time" value="now">
          </div>
          <div class="col-md-2">
             <select id="time1" name="time1"  required="required" class="form-control">
                 
                   <option value="PM">PM</option>
                   <option value="AM">AM</option>
               </select>
          </div>
          <br><br><br>
          
           <div class="col-md-4">
              <?php 
                $nextTuesday = strtotime('next tuesday');
                $weekNo = date('W');
                $weekNoNextTuesday = date('W', $nextTuesday);
                $d1 =  date('Y-M-d',$nextTuesday);
                $d11=date('Y-m-d',$nextTuesday);

                $nextfriday = strtotime('next friday');
                $weekNo = date('W');
                $weekNonextfriday = date('W', $nextfriday);
                $d2 =  date('Y-M-d',$nextfriday);
                $d22 =  date('Y-m-d',$nextfriday);
              ?>
               <select id="d_date" name="d_date" placeholder="Delivery_date" required="required" class="form-control">
                   <option value="0">Select Delivery Date</option>
                   <option value="<?php echo $d11; ?>"><?php echo $d1; ?></option>
                   <option value="<?php echo $d22; ?>"><?php echo $d2; ?></option>
               </select>
             

           
          </div>
           
        </div><br>
       
      </div>
      <div class="col-md-3">
       <textarea cols="7" rows="6" id="BillingDet_Address" name="BillingDet_Address" class="form-control" placeholder="Address"></textarea>
      </div>
    </div>
  </div><br>




     <table>

     <div class="p-0 col-md-3 col-sm-12 col-xs-12">
         <label>Product Name</label>
      <input class="typeahead" name="ProductName" placeholder="" type="text" id="typeahead" onblur="Getproduct()" >

      <input type="hidden" name="ProductID" id="Product_Id">
      </div>


        

      <div class="p-0 col-md-2 col-sm-12 col-xs-12">
          <label>Product MRP</label>
      <input class="form-control " name="Product_MRP" placeholder="" type="text" id="Product_MRP" onchange="GetPtotal()">
      </div>

     
     <div class="p-0 col-md-2 col-sm-12 col-xs-12">
        <label>Offer Price</label>
      <input class="form-control " name="offerprice" placeholder="" type="text" id="offerprice">
      </div>

    <div class="p-0 col-md-2 col-sm-12 col-xs-12">
        <label>Quantity</label>
      <input class="form-control" name="Quantity" placeholder="" type="text" id="Quantity" oninput="GetPtotal()">
      </div>


       <div class="p-0 col-md-2 col-sm-12 col-xs-12">
           <label>Total</label>
      <input class="form-control " name="Total" placeholder="" type="text" id="Total" onchange="GetPtotal()">
      </div>


      <br><label>        </label>
      <input type="button" class="btn btn-success m-l" name="submit" onclick="insertRow();" value="submit"></td>
            
    


        
       
        </table>


       <!-- Bill Data -->

   

        <table id="myTable" cellspacing="10"><br>
        <table id="myTable1" cellspacing="10">

        <tr>
            

        </tr><br>
        </table><br>

<div class="conatiner">
          <div class="row">
            <div class="p-0 col-md-2 col-sm-12 col-xs-12 col-md-push-9">
              <label>Sub total</label>
              <input class="form-control" type="text" id="subTotal" value="0">
          </div>
          </div>
        </div>


        <input type="submit" class="btn btn-success" name="submit" value="submit">


        </form>


        </div>


 






        </div>


        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Powered By <a href="">Farmroot</a>
          </div>
          <div class="clearfix"></div>
        </footer>
    

    <!-- jQuery -->
    <!-- <script src="vendors/jquery/dist/jquery.min.js"></script> -->
    <!-- <script src="build/jquery/jquery-migrate-1.2.1.min.js"></script>   -->
    <!-- <script src="build/jquery/jquery-migrate-1.2.1.min.js"></script> -->

<script>
    



</script>

   <script>


    function GetPtotal()
    {

    var Product_MRP = document.getElementById('Product_MRP').value;
    var Quantity = document.getElementById('Quantity').value;

    var ptotal = Product_MRP*Quantity;


    var ptotale = (ptotal).toFixed(2);

     document.getElementById('Total').value = ptotale;



    }








       function Getproduct()
       {



           var ProductName = document.getElementById('typeahead').value 




           xhr = new XMLHttpRequest();
           xhr.open('POST' , 'Getproduct.php' , true);

           xhr.setRequestHeader('Content-Type', 'application/json');
           xhr.send(JSON.stringify({
           ProductName:ProductName

           }));


           xhr.onreadystatechange = function() {
  
           if (this.readyState == 4 && this.status == 200) {


            console.log('-------------------------------111--------------------------->>>')
           
           var temp =xhr.responseText;
           if (temp) {
           
           temp= JSON.parse(temp);

      
           
           document.getElementById('Product_MRP').value =temp.Product.ProductMRP;
           document.getElementById('Product_Id').value =temp.Product.ProductID;
           document.getElementById('offerprice').value =temp.Product.offer_price;
        

           }

           }
           };




   
       

          
       }


   </script>


      <script>
       function GetCustomer()
       {

           var BillingDet_Phone = document.getElementById('BillingDet_Phone').value 

       //alert(BillingDet_Phone)


           xhr = new XMLHttpRequest();
           xhr.open('POST' , 'GetCustomer.php' , true);

           xhr.setRequestHeader('Content-Type', 'application/json');
           xhr.send(JSON.stringify({
           BillingDet_Phone:BillingDet_Phone

           }));


           xhr.onreadystatechange = function() {
  
           if (this.readyState == 4 && this.status == 200) {


            console.log('-------------------------------111--------------------------->>>')
           
           var temp =xhr.responseText;
           if (temp) {
           
           temp= JSON.parse(temp);

           
           document.getElementById('BillingDet_Name').value =temp.customer.BillingDet_Name;
           document.getElementById('BillingDet_Land').value =temp.customer.BillingDet_Land;
           document.getElementById('BillingDet_City').value =temp.customer.BillingDet_City;
           document.getElementById('BillingDet_State').value =temp.customer.BillingDet_State;
           document.getElementById('BillingDet_PIN').value =temp.customer.BillingDet_PIN;
           document.getElementById('BillingDet_Address').value =temp.customer.BillingDet_Address;
           document.getElementById('BillingDet_UserId').value =temp.customer.BillingDet_UserId;
           document.getElementById('Register_Email').value =temp.user.Register_Email;



       
          

           }

           }
           };




   
       

          
       }


   </script>

    <script type="text/javascript">  
   
      var list = []; 
    
    var index = 1;
    //var tot =0;
         function insertRow(){
           var ProductName = document.getElementById('typeahead').value;
           var Product_MRP = document.getElementById('Product_MRP').value;
           var Quantity = document.getElementById('Quantity').value;
           var Total = document.getElementById('Total').value;
           var Product_Id = document.getElementById('Product_Id').value;



            if(ProductName==null || ProductName=="")
           {

            alert("Fill the required Field")
           
           }
           else if( Product_MRP==null || Product_MRP=="")
           {

           alert("Fill the required Field")

           } 


           else
           {

       
            var table=document.getElementById("myTable");
            var row=table.insertRow(table.rows.length);
            var cell1=row.insertCell(0);

            var t1=document.createElement("input");
                t1.id = "index"+index;
                t1.value=index;
                t1.name="no[]";
                t1.className = "form-control col-md-3 col-xs-3";
                t1.style.marginTop = "10px"

                cell1.appendChild(t1);




            var cell2=row.insertCell(1);

            var t2=document.createElement("input");
                t2.id = "ProductName"+index;
                t2.value=ProductName;
                t2.name="ProductName[]";
                t2.className = "form-control col-md-7 col-xs-12";
                t2.style.marginTop = "10px"

                cell2.appendChild(t2);

            var cell3=row.insertCell(2);
            var t3=document.createElement("input");
                t3.id = "Product_MRP"+index;
                t3.value=Product_MRP;
                t3.name="Product_MRP[]";
                t3.className = "form-control col-md-7 col-xs-12";
                t3.style.marginTop = "10px"

                cell3.appendChild(t3);
            var cell4=row.insertCell(3);
            var t4=document.createElement("input");
                t4.id = "Quantity"+index;
                t4.value=Quantity;
                t4.name="Quantity[]";
                t4.className = "form-control col-md-7 col-xs-12";
                t4.style.marginTop = "10px"

                cell4.appendChild(t4);
            var cell5=row.insertCell(4);
            var t5=document.createElement("input");
                t5.id = "Total"+index;
                t5.value=Total;
                t5.name="Total[]";
                t5.className = "form-control col-md-7 col-xs-12";
                t5.style.marginTop = "10px"
                
                

                cell5.appendChild(t5);



                  var cell6=row.insertCell(5);
                  var t6=document.createElement("BUTTON");
                  var t = document.createTextNode("Remove");
                  t6.appendChild(t);
                  document.body.appendChild(t6);



                t6.className = "btn btn-success m-l remove";
                t6.style.marginTop = "10px"



                cell6.appendChild(t6);


                var cell7=row.insertCell(6);
                var t7=document.createElement("input");
                t7.id = "Product_Id"+index;
                t7.value=Product_Id;
                t7.name="Product_Id[]";
                t7.type="Hidden";
                t7.className = "form-control col-md-7 col-xs-12";
                t7.style.marginTop = "10px"

                cell7.appendChild(t7);


                
                
               
                

      index++;
              
       
       document.getElementById('typeahead').value="";
       document.getElementById('Product_MRP').value="";
       document.getElementById('Quantity').value="";
       document.getElementById('Total').value="";
       document.getElementById('Product_Id').value="";
       document.getElementById('offerprice').value="";
       
       
      
    }
               
    var arr = document.getElementsByName('Total[]');
    var totalLength = arr.length;
    var subTotal=0;
    for(i=0;i<totalLength;i++)
    {
     subTotal = subTotal+parseFloat(arr[i].value);
    }
    document.getElementById('subTotal').value=subTotal;            

}




$(function()  
{  
 
$('body').delegate('.remove','click',function()  
{  
$(this).parent().parent().remove();  
var arr = document.getElementsByName('Total[]');
    var totalLength = arr.length;
    var subTotal=0;
    for(i=0;i<totalLength;i++)
    {
     subTotal = subTotal+parseFloat(arr[i].value);
    }
    document.getElementById('subTotal').value=subTotal;
});  
}); 


$(function(){     
  var d = new Date(),        
      h = d.getHours(),
      m = d.getMinutes();
  if(h < 10) h = '0' + h; 
  if(m < 10) m = '0' + m; 
  $('input[type="time"][value="now"]').each(function(){ 
    $(this).attr({'value': h + ':' + m});
  });
});

    </script>










    
    <!-- <script src="build/jquery/jquery.min.js"></script> -->
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgres->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="vendors/Flot/jquery.flot.js"></script>
    <script src="vendors/Flot/jquery.flot.pie.js"></script>
    <script src="vendors/Flot/jquery.flot.time.js"></script>
    <script src="vendors/Flot/jquery.flot.stack.js"></script>
    <script src="vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
    
  </body>
</html>
