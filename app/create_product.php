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



$CategoryID            = $_POST['CategoryID'];

$ProductName           = $_POST['ProductName'];
$ProductPrice          = $_POST['ProductPrice'];
$ProductMRP            = $_POST['ProductMRP'];
$BrandID               = $_POST['BrandID'];
//$ProductUnit           = $_POST['ProductUnit'];

$subcategoryid           = $_POST['SubCategoryID'];
//$netweight               = $_POST['Netweight'];
$farmrootprice           = $_POST['Farmrootprice'];
$unit                    = $_POST['Unit'].$_POST['Unit1'];
$mal_name                = $_POST['ProductName1'];
$available               = $_POST['available'];
$product_type               = $_POST['producttype'];
$desc              = $_POST['desc'];
//$stock                   = $_POST['stock'];


$GetBrand=mysqli_query($conn,"SELECT * FROM brands WHERE BrandID='$BrandID'");
$GetBrandRow=mysqli_fetch_assoc($GetBrand);
$BrandName=$GetBrandRow['BrandName'];



$PsearchName=$BrandName." ".$ProductName." ".$unit;



$validate=mysqli_query($conn,"SELECT * FROM products WHERE ProductName='$ProductName' AND BrandID='$BrandID' AND ProductUnit='$ProductUnit'");


if(mysqli_num_rows($validate)<=0)
{


$target_dir = "../uploads/product/"; //directory details
    
    $imageFileType = pathinfo($_FILES["ProductImage"]["name"],PATHINFO_EXTENSION); //image type(png or jpg etc)
    $target=$target_dir.time().'.'.$imageFileType;
    $ProductImage = time().'.'.$imageFileType; //full path
    if(move_uploaded_file($_FILES["ProductImage"]["tmp_name"], $target))

    {

$sql="INSERT INTO products(ProductName, malayalam_name, ProductMRP,ProductUnit,CategoryID,BrandID,Subcategory_ID,Farmrootprice,	Unit,PsearchName,ProductStatus,ProductImage,pflag,product_type,description) VALUES ('$ProductName', '$mal_name',  '$ProductMRP ', '$unit ','$CategoryID','$BrandID','$subcategoryid','$farmrootprice','$unit','$PsearchName','Active','$ProductImage','$available','$product_type','$desc')";

if (mysqli_query($conn, $sql))
 {

    echo "<script> alert('Products Added Successfully');window.location.href = 'manage_products.php';</script>";
 } 

else 
{
  
    echo "<script> alert('Error');window.location.href = 'create_product.php';</script>";
}

}

else
{

echo "<script> alert('Upload Error');window.location.href = 'create_product.php';</script>";

}

}

else
{

 echo "<script> alert('Product Already Exist');window.location.href = 'create_product.php';</script>";

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
                <h3>Add Products</h3>
              </div>

          
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Product Details</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
					
					<script type="text/javascript" src="http://www.google.com/jsapi"></script>
 
<script type="text/javascript">
google.load("elements", "1", {packages: "transliteration"});
</script> 
 
<script>
function OnLoad() {
var currValue = document.getElementById("ProductName1");
 
var options = {
sourceLanguage:
google.elements.transliteration.LanguageCode.ENGLISH,
destinationLanguage:
[google.elements.transliteration.LanguageCode.MALAYALAM],
shortcutKey: 'ctrl+g',
transliterationEnabled: true
};
 
 
var control = new
 
google.elements.transliteration.TransliterationControl(options);
control.makeTransliteratable(["ProductName1"]);
var postValue = document.getElementById("ProductName1");
 
}
 
google.setOnLoadCallback(OnLoad);
 
</script> 



                    <form id="demo-form2" method="POST" enctype="multipart/form-data"  class="form-horizontal form-label-left" onkeypress="return event.keyCode != 13;">
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CategoryID"> Category Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            
 
<select name="CategoryID" id="CategoryID" class="form-control col-md-7 col-xs-12" required>
    <option value="">Select Category</option> 
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Sub Category <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            
 
<select name="SubCategoryID" id="SubCategoryID" class="form-control col-md-7 col-xs-12" >
    <option value="">Select Sub Category</option> 
<?php 
$result = mysqli_query($conn,"SELECT * from subcategory WHERE Status='active'");
while ($row = mysqli_fetch_array($result))
{
    echo "<option value=".$row['subcategory_id'].">".$row['subcategory_title']."</option>";
}
?>        
</select> 
                        </div>
                      </div>
					  
					  
					  
					   <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Brand Name <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            
 
<select name="BrandID" id="BrandID" class="form-control col-md-7 col-xs-12" >
    <option value="">Select Brand</option> 
<?php 
$result = mysqli_query($conn,"SELECT * from brands WHERE BStatus='Active'");
while ($row = mysqli_fetch_array($result))
{
    echo "<option value=".$row['BrandID'].">".$row['BrandName']."</option>";
}
?>        
</select> 
                        </div>
                      </div>
                      
                              <!--  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""> Brand Name <span >*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            
 
<select name="BrandID" id="BrandID" class="form-control col-md-7 col-xs-12" required>
    <option value="">Select Brand</option> 
<?php 
$result = mysqli_query($conn,"SELECT * from brands WHERE BStatus='Active'");
while ($row = mysqli_fetch_array($result))
{
    echo "<option value=".$row['BrandID'].">".$row['BrandName']."</option>";
}
?>        
</select> 
                        </div>
                      </div> -->



           
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ProductName"> Product Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 googleTranslateElementInit">
                          <input id="ProductName" class="form-control col-md-7 col-xs-12" name="ProductName" placeholder="ProductName" required="required" type="text">
                        </div>
                      
                      </div>

                       
                      
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ProductName"> <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                          <input id="ProductName1" class="form-control col-md-7 col-xs-12" name="ProductName1" placeholder="Product Name in Malayalam(Press Enter)"  type="text">
                        </div>
                      
                      </div>
                  
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ProductName"> Product Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 googleTranslateElementInit">
                            <select id="producttype" class="form-control col-md-7 col-xs-12" name="producttype">
                                <option value="fresh">Fresh</option>
                                <option value="dry">Dry</option>
                            </select>
                         
                        </div>
                      
                      </div>
                      
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ProductMRP">Product MRP<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="ProductMRP" class="form-control col-md-7 col-xs-12" name="ProductMRP" placeholder="Product MRP" type="number">
                        </div>
                      </div>
                      
					   <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ProductMRP">Farmroot Price<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="Farmrootprice" class="form-control col-md-7 col-xs-12" name="Farmrootprice" placeholder="Farmroot price" type="number">
                        </div>
                      </div>
					  
                       <!-- <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ProductUnit">Product Unit<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="ProductUnit" class="form-control col-md-7 col-xs-12" name="ProductUnit" placeholder="Product Unit" type="text">
                        </div>
                      </div> -->

					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ProductUnit">Unit<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                          <input id="Unit" class="form-control col-md-7 col-xs-12" name="Unit" placeholder="Unit" type="text">
						  
                        </div>
						<div class="col-md-3 col-sm-6 col-xs-6">
						  <select id="Unit1" class="form-control col-md-7 col-xs-12" name="Unit1" >
							<option value="gram">GRAM</option>
							<option value="KG">KG</option>
							<option value="liter">LITRE</option>
						  </select>
						  
                        </div>
                      </div>
					  
					  <div class="item form-group">
					  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ProductUnit">Net Weight<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="Netweight" class="form-control col-md-7 col-xs-12" name="Netweight" placeholder="Net weight" type="text">
                        </div>
                      </div>
					  
					  <div class="item form-group">
					  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Productavailability">Description<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea class="form-control col-md-7 col-xs-12" name="desc"></textarea>
                        </div>
                      </div>
					
					<div class="item form-group">
					  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Productavailability">Availability<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="available" class="form-control col-md-7 col-xs-12" name="available">
                                <option value="1">YES</option>
                                <option value="0">NO</option>
                            </select>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ProductImage">Product Image<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="ProductImage" class="form-control col-md-7 col-xs-12" name="ProductImage" placeholder="Product Image" type="file">
                        </div>
                      </div>
   
									

                     
 

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <a href="create_product.php"><button type="button" class="btn btn-primary" >Cancel</button></a>
                          <input type="submit" name="submit" class="btn btn-success" value="Add Product">
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
