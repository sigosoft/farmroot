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



$place           = $_POST['place'];

$district          = $_POST['district'];
$latitude          = $_POST['latitude'];
$longitude            = $_POST['longitude'];
$avail            = $_POST['avail'];
$date = date('Y-m-d');

$sql="INSERT INTO delivery_locations(place_name,district,latitude, longitude, date,dflag) VALUES ('$place','$district','$latitude', '$longitude',  '$date','$dflag')";

if (mysqli_query($conn, $sql))
 {

    echo "<script> alert('location Added Successfully');window.location.href = 'manage_location.php';</script>";
 } 

else 
{
  
    echo "<script> alert('Error');window.location.href = 'add_locations.php';</script>";
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
    
    <title>Farmroot | Admin</title>

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
	<script type="text/javascript" src="http://www.google.com/jsapi"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

 
  </head>

  <body class="nav-md">




 <?php require 'partials/sidebar.php'; ?>




  

        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add Delivery Locations</h3>
              </div>

          
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Delivery Location</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
					
					<script type="text/javascript" src="http://www.google.com/jsapi"></script>
 





                    <form id="demo-form2" method="POST" class="form-horizontal form-label-left">
                        

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ProductName"> Place Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 googleTranslateElementInit">
                          <input id="place" class="form-control col-md-7 col-xs-12" name="place" placeholder="Enter Place" required="required" type="text">
                        </div>
                      
                      </div>
                  
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ProductMRP">District<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="district" class="form-control col-md-7 col-xs-12" name="district" placeholder="Enter District" type="text">
                        </div>
                      </div>
                      
					   <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ProductMRP">Latitude<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="latitude" class="form-control col-md-7 col-xs-12" name="latitude" placeholder="Enter Latitude" type="text">
                        </div>
                      </div>
					  
					    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ProductMRP">Longitude<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="longitude" class="form-control col-md-7 col-xs-12" name="longitude" placeholder="Enter Longitude" type="text">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ProductMRP">Availability<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="avail" class="form-control col-md-7 col-xs-12" name="avail">
                                <option value="0">YES</option>
                                 <option value="1">NO</option>
                            </select>
                          
                        </div>
                      </div>
					  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                           <a href="add_locations.php"><button type="button" class="btn btn-primary" o>Cancel</button></a>
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
	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	
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
  
  <script type="text/javascript">
/*function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}*/

google.load("language", "1");

function initialize() {
    var content = document.getElementById('ProductName');
    content.innerHTML = '<div id="text">Hola, me alegro mucho de verte.<\/div><div id="translation"/>';
    var text = document.getElementById("text").innerHTML;
    google.language.translate(text, 'es', 'en', function(result) {
        var translated = document.getElementById("translation");
        if (result.translation) {
            translated.innerHTML = result.translation;
        }
    });
}
google.setOnLoadCallback(initialize);
</script>

  </body>
</html>
