<?php

session_start();

if(!isset($_SESSION['store']))
 {
   header('location:index.php');
 };


$current = date('Y-m-d');


include "db/config.php";

$view=mysqli_query($conn,"SELECT * FROM delivery_time");
$row=mysqli_fetch_assoc($view);

if(isset($_POST['submit']))
{




$deliverytime1=$_POST['deliverytime1'];
$deliverytime2=$_POST['deliverytime2'];
/*$deliverytime3=$_POST['deliverytime3'];*/


$query="UPDATE delivery_time SET 	delivery_time1='$deliverytime1',	delivery_time2='$deliverytime2' WHERE time_id='1'";




     if (mysqli_query($conn, $query))
     {

       echo "<script> alert('Delivery Time updated Successfully');window.location.href = 'delivery_time.php';</script>";

     }

     else
     {

       echo "<script> alert('Error Please Try Again');window.location.href = 'delivery_time.php';</script>";

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

    <title>FarmRoot | ADMIN</title>


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
                    <h2>Edit Delivery Time</h2>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CategoryName"> Delivery Time 1 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="deliverytime1" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="deliverytime1" placeholder="Delivery Time" required="required" value="<?php echo $row['delivery_time1']; ?>" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CategoryName"> Delivery Time 2 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="deliverytime2" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="deliverytime2" placeholder="Delivery Time" required="required"  value="<?php echo $row['delivery_time2']; ?>" type="text">
                        </div>
                      </div>
                     








                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancel</button>
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
             Powered By <a href="">FarmRoot</a>
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

  </body>
</html>
