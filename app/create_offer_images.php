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
$category=$_POST['category'];
$subcategory=$_POST['subcategory'];
$product=$_POST['product'];
$from=$_POST['from'];
$to=$_POST['to'];
$perc=$_POST['perc'];
$date=date('Y-m-d');

$q=mysqli_query($conn,"select * from products where ProductID='$product'");
while ($r = mysqli_fetch_array($q))
{
 $sum = $r['ProductMRP']-($r['ProductMRP']*$perc)/100;
}

$query="UPDATE products SET offer_price='$sum',period_from='$from',period_to='$to',percentage='$perc' WHERE ProductID='$product'";
if (mysqli_query($conn, $query))
 {
    echo "<script> alert('Offer  Added Successfully');window.location.href = 'create_offer_images.php';</script>";
 } 

else 
{


    echo "<script> alert('Error');window.location.href = 'create_offer_images.php';</script>";
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

    <title>Farmroot| Store</title>

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
  </head>

  <body class="nav-md">


  <?php require 'partials/sidebar.php'; ?>

     


<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add Offer Image</h3>
              </div>

          
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" method="POST" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">



                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="OfferImage"> Category<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control col-md-7 col-xs-12" name="category" id="category">
							<?php 
							$result = mysqli_query($conn,"SELECT * from category WHERE CStatus='Active'");
							while ($row = mysqli_fetch_array($result))
							{
								echo "<option value=".$row['Category_Id'].">".$row['Category_Title']."</option>";
							}
							?>    
							</select>
                        </div>
                      </div>
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="OfferImage">Sub Category<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control col-md-7 col-xs-12" name="subcategory" id="subcategory">
							<?php 
							$result1 = mysqli_query($conn,"SELECT * from subcategory ");
							while ($row1 = mysqli_fetch_array($result1))
							{
								echo "<option value=".$row1['subcategory_id'].">".$row1['subcategory_title']."</option>";
							}
							?>    
							</select>
                        </div>
                      </div>
					   <!--<select name="type1" id="type1" class="form-control col-md-7 col-xs-12"> </select>-->
					  
                         <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="OfferImage"> Product<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control col-md-7 col-xs-12" name="product" id="product" >
							<?php 
							$result2 = mysqli_query($conn,"SELECT * from products ");
							while ($row2 = mysqli_fetch_array($result2))
							{
								echo "<option value=".$row2['ProductID'].">".$row2['ProductName']."</option>";
							}
							?>    
							</select>                        </div>
                      </div>
					  
					  
					  
                         <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="OfferImage"> Period<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input id="from" class="form-control col-md-7 col-xs-12" name="from" placeholder="From" required="required" type="date">
                        </div>
						<div class="col-md-3 col-sm-6 col-xs-12">
                          <input id="to" class="form-control col-md-7 col-xs-12" name="to" placeholder="To" required="required" type="date">
                        </div>
                      </div>
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="OfferImage"> Percentage<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="perc" class="form-control col-md-7 col-xs-12" name="perc" placeholder="Percentage" required="required" type="text">
                        </div>
						
                      </div>




                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="submit" onClick="window.location.reload()" class="btn btn-primary">Cancel</button>
                          <input type="submit" name="submit" class="btn btn-success" value="Submit">
                        </div>
                      </div>
                    </form>

                 
                  </div>
                </div>
              </div>
            </div>

 


           
           


     
          </div>
        </div>



        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Powered By <a href="">Farmroot</a>
          </div>
          <div class="clearfix"></div>
        </footer>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>

	<script type="text/javascript">


$(document).ready(function(){
    $('#category').on("change",function () {
        var Category_Id = $(this).find('option:selected').val();
        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: "Category_Id="+Category_Id,
            success: function (response) {
                console.log(response);
                $("#type1").html(response);
            },
        });
    }); 

});


 
</script>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
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
