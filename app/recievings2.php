
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





$VBillingDet_Phone=$_POST['VBillingDet_Phone'];
$VBillingDet_Name=$_POST['VBillingDet_Name'];

$VBillingDet_City=$_POST['VBillingDet_City'];
$VBillingDet_State=$_POST['VBillingDet_State'];
$VBillingDet_PIN=$_POST['VBillingDet_PIN'];
$VBillingDet_Address=$_POST['VBillingDet_Address'];

$VBillingDet_Email=$_POST['Register_Email'];

$VBillingDet_VendorID=$_POST['VBillingDet_VendorID'];




$VGrandTotal=0;

for($i = 0; $i<count($_POST['ProductName']); $i++) 
{

 $Total=$_POST['Total'][$i]; 
 $VGrandTotal=$VGrandTotal+$Total;

};




$VInvoiceNO='VP'.time();



$query="INSERT INTO vendor_purchase(VInvoiceNO, VGrandTotal, VBillingDet_VendorID, VBillingDet_Name, VBillingDet_Email, VBillingDet_Phone, VBillingDet_City, VBillingDet_State, VBillingDet_PIN, VBillingDet_Address) VALUES ('$VInvoiceNO', '$VGrandTotal', '$VBillingDet_VendorID', '$VBillingDet_Name', '$VBillingDet_Email', '$VBillingDet_Phone', '$VBillingDet_City', '$VBillingDet_State', '$VBillingDet_PIN', '$VBillingDet_Address')";

if(mysqli_query($conn,$query))
{

  
 $VpurchaseID=mysqli_insert_id($conn);

 for($i = 0; $i<count($_POST['ProductName']); $i++)  
 {
 


  //$ProductName=$_POST['ProductName'][$i];
   $ProductName=$_POST['ProductName'][$i];
   $Product_Id=$_POST['Product_Id'][$i];
  


   $Quantity=$_POST['Quantity'][$i];
   $Product_price=$_POST['Product_MRP'][$i];
   $Total=$_POST['Total'][$i];

   

$sql=mysqli_query($conn,"INSERT INTO vendor_purchase_items(VpurchaseID, ProductID, ProductName, Quantity, ProductPrice, Total, InvoiceNO) VALUES ('$VpurchaseID', '$Product_Id', '$ProductName', '$Quantity', '$Product_price', '$Total', '$VInvoiceNO')");


 $stock=mysqli_query($conn,"UPDATE products SET ProductStock=ProductStock+'$Quantity' WHERE PsearchName='$ProductName'");

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
  <h4>Vendor Details </h4>
  <div class=" conatiner">
    <div class="row">
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-4">
             <input class="form-control" name="VBillingDet_Phone" placeholder="Phone" id="VBillingDet_Phone" onchange="GetVendors()" required="required" type="text">
          </div>
           <div class="col-md-4">
             <input class="form-control" name="VBillingDet_Name" id="VBillingDet_Name" placeholder="Vendor Name" required="required" type="text">
          </div>
           <div class="col-md-4">
             <input class="form-control" id="VBillingDet_City" name="VBillingDet_City" placeholder="City" required="required" type="text">
          </div>
        </div><br>
         <div class="row">
          <div class="col-md-4">
             <input class="form-control" id="VBillingDet_PIN" name="VBillingDet_PIN" placeholder="PIN Code" required="required" type="text">
          </div>
           <div class="col-md-4">
             <input class="form-control" id="VBillingDet_State" name="VBillingDet_State" placeholder="State" required="required" type="text">
          </div>
          
        </div><br>

            <div class="row">
          <div class="col-md-4">
             <input class="form-control" id="Register_Email" name="Register_Email" placeholder="Email"  type="text">

          
          </div>

          <div class="col-md-4">
             <input class="form-control" id="VBillingDet_GST" name="VBillingDet_GST" placeholder="GST No"  type="text">

              <input type="hidden" name="VBillingDet_VendorID" id="VBillingDet_VendorIDE">
          </div>
           
        </div><br>
       
      </div>
      <div class="col-md-3">
       <textarea cols="7" rows="6" id="VBillingDet_Address" name="VBillingDet_Address" class="form-control"></textarea>
      </div>
    </div>
  </div><br>




     <table>

     <div class="p-0 col-md-3 col-sm-12 col-xs-12">
      <input class="typeahead" name="ProductName" placeholder="Product Name" type="text" id="typeahead" onblur="Getproduct()">

      <input type="hidden" name="ProductID" id="Product_Id">
      </div>



      <div class="p-0 col-md-2 col-sm-12 col-xs-12">
      <input class="form-control " name="Product_MRP" placeholder="Product MRP" type="text" id="Product_MRP" onchange="GetPtotal()">
      </div>

     

    <div class="p-0 col-md-2 col-sm-12 col-xs-12">
      <input class="form-control" name="Quantity" placeholder="Quantity" type="text" id="Quantity" onchange="GetPtotal()">
      </div>


       <div class="p-0 col-md-2 col-sm-12 col-xs-12">
      <input class="form-control " name="Total" placeholder="Total" type="text" id="Total" onchange="">
      </div>



      <input type="button" class="btn btn-success m-l" name="submit" onclick="insertRow();" value="submit"></td>
            
    


        
       
        </table>

       <!-- VBill Data -->

   

        <table id="myTable" cellspacing="10">

        <tr>
            

        </tr><br>
        </table><br>


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
        

           }

           }
           };




   
       

          
       }


   </script>


      <script>
       function GetVendors()
       {

           var VBillingDet_Phone = document.getElementById('VBillingDet_Phone').value 

  


           xhr = new XMLHttpRequest();
           xhr.open('POST' , 'GetVendors.php' , true);

           xhr.setRequestHeader('Content-Type', 'application/json');
           xhr.send(JSON.stringify({
           VBillingDet_Phone:VBillingDet_Phone

           }));


           xhr.onreadystatechange = function() {
  
           if (this.readyState == 4 && this.status == 200) {


            console.log('-------------------------------111--------------------------->>>')
           
           var temp =xhr.responseText;
           if (temp) {
           
           temp= JSON.parse(temp);

           document.getElementById('VBillingDet_Name').value =temp.vendor.VendorName;
         
           document.getElementById('VBillingDet_City').value =temp.vendor.City;
           document.getElementById('VBillingDet_State').value =temp.vendor.State;
           document.getElementById('VBillingDet_PIN').value =temp.vendor.PINCode;
           document.getElementById('VBillingDet_Address').value =temp.vendor.Address;
           document.getElementById('VBillingDet_VendorIDE').value =temp.vendor.VendorID;
           document.getElementById('Register_Email').value =temp.vendor.Email;
           document.getElementById('VBillingDet_GST').value =temp.vendor.GSTNo;




         



       
          

           }

           }
           };




   
       

          
       }


   </script>

    <script type="text/javascript">  

    
    var index = 1;
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
                t1.id = "ProductName"+index;
                t1.value=ProductName;
                t1.name="ProductName[]";
                t1.className = "form-control col-md-7 col-xs-12";
                t1.style.marginTop = "10px"
              
                cell1.appendChild(t1);

            var cell2=row.insertCell(1);
            var t2=document.createElement("input");
                t2.id = "Product_MRP"+index;
                t2.value=Product_MRP;
                t2.name="Product_MRP[]";
                t2.className = "form-control col-md-7 col-xs-12";
                t2.style.marginTop = "10px"
                
                cell2.appendChild(t2);
            var cell3=row.insertCell(2);
            var t3=document.createElement("input");
                t3.id = "Quantity"+index;
                t3.value=Quantity;
                t3.name="Quantity[]";
                t3.className = "form-control col-md-7 col-xs-12";
                t3.style.marginTop = "10px"
                
                cell3.appendChild(t3);
            var cell4=row.insertCell(3);
            var t4=document.createElement("input");
                t4.id = "Total"+index;
                t4.value=Total;
                t4.name="Total[]";
                t4.className = "form-control col-md-7 col-xs-12";
                t4.style.marginTop = "10px"
                
                cell4.appendChild(t4);



                  var cell5=row.insertCell(4);
                  var t5=document.createElement("BUTTON");
                  var t = document.createTextNode("Remove");
                  t5.appendChild(t);
                  document.body.appendChild(t5);

                 
                
                t5.className = "btn btn-success m-l remove";
                t5.style.marginTop = "10px"
                


                cell5.appendChild(t5);


                var cell6=row.insertCell(5);
                var t6=document.createElement("input");
                t6.id = "Product_Id"+index;
                t6.value=Product_Id;
                t6.name="Product_Id[]";
                t6.type="Hidden";
                t6.className = "form-control col-md-7 col-xs-12";
                t6.style.marginTop = "10px"
                
                cell6.appendChild(t6);


      index++;

       
       document.getElementById('typeahead').value="";
       document.getElementById('Product_MRP').value="";
       document.getElementById('Quantity').value="";
       document.getElementById('Total').value="";
       document.getElementById('Product_Id').value="";

    }
   
           
}




$(function()  
{  
 
$('body').delegate('.remove','click',function()  
{  
$(this).parent().parent().remove();  
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
