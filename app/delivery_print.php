<?php

session_start();

if(!isset($_SESSION['store']))
 {
   header('location:index.php');
 };






require 'db/config.php';



if(isset($_POST['submit']))
{
$date=$_POST['d_date'];
//echo $date;
$sql1="select app_order_items.*,app_orders.* from app_order_items INNER JOIN app_orders on app_order_items.OrderNo=app_orders.OrderNO where delivery_date ='$date'";
$result1=mysqli_query($conn,$sql1);

}

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
    <!-- Datatables -->
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    




 <?php require 'partials/sidebar.php'; ?>




        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Print</h3>
              </div>

              
            </div>

            <div class="clearfix"></div>
            <div style="padding-bottom: 10px;">
            <form method="POST">
             <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CategoryName"> Select Delivery Date   : <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="CategoryName" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="d_date" placeholder="" required="required" type="date">
                        </div>
                      </div>
                      <button type="submit" name="submit" class="btn btn-success m-left">    SUBMIT    </button>
            </form>
            </div>


            <?php if(isset($result)){ ?>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Print</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Order No</th>
                          <th>Invoice No</th>
                          <th>Name</th>
                         
                          <th>Mobile</th>
                          <th>Grand Total</th>
                      
                        
                      

                        </tr>
                      </thead>


                      <tbody>

                      <?php while($row=mysqli_fetch_assoc($result))
                      {
                      ?>
                        
                        <tr>
                           <td><?php echo $row['OrderNO']; ?></td>
                           <td><?php echo $row['InvoiceNO']; ?></td>
                       
                          <td><?php echo $row['BillingDet_Name']; ?></td>
                          <td><?php echo $row['BillingDet_Phone']; ?></td>
                          <td><?php echo $row['GrandTotal']; ?></td>
                       
                           
                        </tr>

                       <?php }; ?> 
                      
                      
                      
                      
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>



        </div>
        
        <?php } ?>
        
        
        
        
        
        <?php if(isset($result1)){ ?>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Print</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Order No</th>
                          <th>Name</th>
                          <th>Mobile</th>
                          <th>Address</th>
                          <th>Locality</th>
                          <th>Delivery Date</th>
                         
                          <th>Product</th>
                          <th>Quantity</th>
                          <th>Product Price</th>
                        </tr>
                      </thead>


                      <tbody>

                      <?php while($row=mysqli_fetch_assoc($result1))
                      {
                      ?>
                        
                        <tr>
                           <td><?php echo $row['OrderNO']; ?></td>
                           <td><?php echo $row['BillingDet_Name']; ?></td>
                       
                          <td><?php echo $row['BillingDet_Phone']; ?></td>
                          <td><?php echo $row['BillingDet_Address']; ?></td>
                          <td><?php echo $row['BillingDet_Land']; ?></td>
                          <td><?php echo $row['delivery_date']; ?></td>
                         <!-- <td><?php echo $row['delivery_time']; ?></td> -->
                          <td><?php echo $row['ProductName']; ?></td>
                          <td><?php echo $row['Quantity']; ?></td>
                          <td><?php echo $row['ProductPrice']; ?></td>
                       
                           
                        </tr>

                       <?php }; ?> 
                      
                      
                      
                      
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>



        </div>
        
        <?php } ?>
        
        
        </div>
        </div>
              


 
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

   <script>

function updater(OrderID)
{
  

 document.getElementById('OrderID').value = OrderID;



}

   </script>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

  </body>
</html>