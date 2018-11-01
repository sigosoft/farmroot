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




$name=$_POST['name'];
$p1=$_POST['product1'];
$p2=$_POST['product2'];
$p3=$_POST['product3'];
$price=$_POST['price'];
$date=date('Y-m-d');

   $target_dir = "../uploads/package/"; //directory details
    
    $imageFileType = pathinfo($_FILES["CategoryImage"]["name"],PATHINFO_EXTENSION); //image type(png or jpg etc)
    $target=$target_dir.time().'.'.$imageFileType;
    $CategoryImage = time().'.'.$imageFileType; //full path
    if(move_uploaded_file($_FILES["CategoryImage"]["tmp_name"], $target))
      {
     $query="INSERT INTO package(name,product1,product2,product3,date,price,image) VALUES ('$name','$p1','$p2','$p3','$date','$price','$CategoryImage')";
     
       
     if (mysqli_query($conn, $query))
     {

       $package_id=mysqli_insert_id($conn);
       
           mysqli_query($conn,"update products set package_id='$package_id' where ProductID='$p1'");
            mysqli_query($conn,"update products set package_id='$package_id' where ProductID='$p2'");
             mysqli_query($conn,"update products set package_id='$package_id' where ProductID='$p3'");

       echo "<script> alert('package Added Successfully');window.location.href = 'create_package.php';</script>";

     } 
 
     else 
     {
  
       echo "<script> alert('Error Please Try Again');window.location.href = 'create_package.php';</script>";

     }


 }    
   
   else 
     {
  
       echo "<script> alert('Upload Error');window.location.href = 'create_package.php';</script>";

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
    
    <title>Farmroot | Admin </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    
    <link href="build/css/custom.min.css" rel="stylesheet">
	
	  <link href="bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
	  
	  
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  </head>

  <body class="nav-md">




 <?php require 'partials/sidebar.php'; ?>




  

        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3></h3>
              </div>

          
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Packages</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" method="POST"  enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left" >


                          <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CategoryImage"Package Name >Package Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12" required>
                        </div>
                      </div>

                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CategoryName"> Select First Product <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            
                              <select class="form-control selectpicker col-md-7 col-xs-12" data-live-search="true"  data-validate-length-range="6" data-validate-words="2" name="product1" id="product1"  required>
              <option value="">Select First Product</option>
                <?php 
                $result = mysqli_query($conn,"SELECT * from products");
                while ($row = mysqli_fetch_array($result))
                {
                    echo "<option value=".$row['ProductID'].">".$row['ProductName']."</option>";
                }
                ?>   
              </select> 
              
              
                        </div>
                      </div>
                      
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CategoryName"> Select Second Product <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            
                              <select class="form-control selectpicker col-md-7 col-xs-12" data-live-search="true"  data-validate-length-range="6" data-validate-words="2" name="product2" id="product2"  >
              <option value="">Select Second Product</option>
                <?php 
                $result = mysqli_query($conn,"SELECT * from products");
                while ($row = mysqli_fetch_array($result))
                {
                    echo "<option value=".$row['ProductID'].">".$row['ProductName']."</option>";
                }
                ?>   
              </select> 
              
              
                        </div>
                      </div>
                      
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CategoryName"> Select Third Product <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            
                              <select class="form-control selectpicker col-md-7 col-xs-12" data-live-search="true"  data-validate-length-range="6" data-validate-words="2" name="product3" id="product3"  >
              <option value="">Select Third Product</option>
                <?php 
                $result = mysqli_query($conn,"SELECT * from products");
                while ($row = mysqli_fetch_array($result))
                {
                    echo "<option value=".$row['ProductID'].">".$row['ProductName']."</option>";
                }
                ?>   
              </select> 
              
              
                        </div>
                      </div>
                      
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CategoryImage"Package Name >Package Price
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="price" name="price" required="required" class="form-control col-md-7 col-xs-12" required>
                        </div>
                      </div>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CategoryImage">Product Image <span class="required">(600*600 pixel)</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="CategoryImage" name="CategoryImage" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      
                        
                   


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <a href="add_category.php"> <button type="button" class="btn btn-primary">Cancel</button></a>
                          <button id="send" type="submit" class="btn btn-success" name="submit">Submit</button>
                        </div>
                      </div>
                    </form>


                 
                  </div>
                </div>
              </div>
            </div>

 


           
           


     
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Powered By <a href="">Farmroot</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
       <script src="bootstrap-select/bootstrap-select.min.js"></script>
  
  </body>
</html>
