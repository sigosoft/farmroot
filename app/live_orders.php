<?php

session_start();

if(!isset($_SESSION['store']))
 {
   header('location:index.php');
 };






require 'db/config.php';

$sql="SELECT * FROM app_orders WHERE status='Order Placed' ORDER BY delivery_date DESC";
$result=mysqli_query($conn,$sql);


if(isset($_POST['update']))
{


  $status=$_POST['status'];
  $OrderID=$_POST['OrderID'];
  $update="UPDATE app_orders SET status='$status' WHERE OrderID='$OrderID'";
  
  if (mysqli_query($conn, $update))
  {

    echo "<script> alert('Order Updated');window.location.href = 'live_orders.php';</script>";

  } 

else 
 {


    echo "<script> alert('Upload Error');window.location.href = 'live_orders.php';</script>";
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
                <h3>Orders</h3>
              </div>

              
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Live Order List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Order No</th>
                          <th>Invoice No</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          <th>Delivery Date</th>
                          <th>Grand Total</th>
                          <th>Status</th>
                          <th>Order View</th>
                          <th>Action</th>

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
                          <td><?php echo $row['BillingDet_Email']; ?></td>
                          <td><?php echo $row['BillingDet_Phone']; ?></td>
                          <td><?php echo $row['delivery_date']; ?></td>
                          <td><?php echo $row['GrandTotal']; ?></td>
                              <td><?php echo $row['status']; ?></td>
                              

                        
                           <td><a href="view_orders.php?id=<?php echo $row['OrderID'];?>">View</a></td>  
                           <td><input type="submit" name="update" value="Update" class="btn btn-primary"  onclick="updater('<?php echo $row['OrderID']; ?>')" data-toggle="modal" data-target="#myModal"></td>  
                      
                        </tr>

                       <?php }; ?> 
                      
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>



        </div>
        </div>
        </div>
              


              <div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Orders</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

  <form method="POST">
  <input type="hidden" name="OrderID" id="OrderID">
        

      <select class="form-control" name="status">
      <option value="Delivered">Delivered</option>        
      <option value="Cancelled">Cancelled</option>        
          
      </select>  



      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="update">Update</button>
      </div>
</form>
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