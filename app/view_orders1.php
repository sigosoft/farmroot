<?php

session_start();

if(!isset($_SESSION['store']))
 {
   header('location:index.php');
 };




$OrderID=$_GET['id'];

require 'db/config.php';




$sql="SELECT * FROM app_orders WHERE OrderID='$OrderID'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$order_items=mysqli_query($conn,"SELECT * FROM app_order_items WHERE OrderID='$OrderID'");




//$distance=mysqli_query($conn,"SELECT * FROM distance");
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Farmroot | Store </title>

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
                <h3>Order Summary</h3>
              </div>


            </div>

            <div class="clearfix"></div>
            <div class="container " style="padding-top: 5%;">
            <div class="col-md-6">



            <table class="table" style="width: 50%;margin-left: 20%;">
  <thead>
    <tr>


    </tr>
  </thead>
  <tbody class="table-striped">
  <tr>
      <th scope="row"><strong>Name</strong></th>
      <td><?php echo $row['BillingDet_Name'];?></td>

    </tr>
    <tr>
      <th scope="row"><strong>Email</strong></th>
      <td><?php echo $row['BillingDet_Email'];?></td>

    </tr>
    <tr>
      <th scope="row"><strong>Mobile</strong></th>
      <td><?php echo $row['BillingDet_Phone'];?></td>

    </tr>

    <tr>
      <th scope="row"><strong>Status</strong></th>
      <td><?php echo $stat = $row['status'];?></td>

    </tr>
    <tr>
      <th scope="row"><strong>Order No</strong></th>
      <td><?php echo $row['OrderNO'];?></td>

    </tr>
    <tr>
      <th scope="row"><strong>Invoice No</strong></th>
      <td><?php echo $row['InvoiceNO'];?></td>

    </tr>

     <tr>
      <th scope="row"><strong>Grand Total</strong></th>
      <td><?php echo $row['GrandTotal'];?></td>

    </tr>

    <tr>
      <th scope="row"><strong>user Type</strong></th>
      <td><?php echo $row['UserType'];?></td>

    </tr>



  </tbody>
</table>
</div>
      <div class="col-md-6">



            <table class="table" style="width: 50%;margin-left: 20%;">
  <thead>
    <tr>


    </tr>
  </thead>
  <tbody class="table-striped">
  <tr>
      <th scope="row"><strong>City</strong></th>
      <td><?php echo $row['BillingDet_City'];?></td>

    </tr>
    <tr>
      <th scope="row"><strong>Landmark</strong></th>
      <td><?php echo $row['BillingDet_Land'];?></td>

    </tr>
    <tr>
      <th scope="row"><strong>State</strong></th>
      <td><?php echo $row['BillingDet_State'];?></td>

    </tr>

    <tr>
      <th scope="row"><strong>PIN Code</strong></th>
      <td><?php echo $row['BillingDet_PIN'];?></td>

    </tr>
    <tr>
      <th scope="row"><strong>Delivery Address</strong></th>
      <td><?php echo str_replace(',', '<br />', $row['BillingDet_Address']);?></td>
    </tr>
    <!--<tr>
      <th scope="row"><strong>Distance</strong></th>
      <td>
        <?php
        $total=0;
        while($data1=mysqli_fetch_assoc($distance))

        {?>
        <input type="text" id="distance" class="form-control" readonly onclick="calc_distance('<?php echo $data1['latitude']; ?>','<?php echo $data1['longitude']; ?>');" value=""></td>
      <?php } ?>
    </tr>-->

    </tr>




  </tbody>
</table>
</div>
</div>

<div class="container" style="padding: 5%;">
<div class="row">
    <table class="table">
    <thead>
      <tr>
        <th>Product Name</th>
          <th>Unit Price</th>
        <th>Quantity</th>

        <th>Total</th>
        <th>Delivery Date</th>
      </tr>
    </thead>
    <tbody>

     <?php
     $total=0;
     while($data=mysqli_fetch_assoc($order_items))

     {?>

      <tr>
        <td><?php echo $data['ProductName'];?></td>
        <td><?php echo $data['ProductPrice'];?></td>
        <td><?php echo $data['Quantity'];?></td>
        <td><?php echo $data['Total'];?></td>
        <td><?php
            if($stat!="Cancelled"){
                /*
                   $dt = date('Y-m-d',strtotime($data['timestamp']));
                   $dt3= date('D',strtotime($data['timestamp']));
                   if($dt3 == 'Mon' ){
                     //$dt2=date('d',strtotime($data['timestamp']))+4;
                     $dt2= date('Y-m-d', strtotime($dt ."+5 days"));
                     $dt1=date('d-M-Y',strtotime($dt2));
                     $dt4=date('D',strtotime($dt2));

                   }
                  elseif($dt3 == 'Tue' ){
                     //$dt2=date('d',strtotime($data['timestamp']))+4;
                     $dt2= date('Y-m-d', strtotime($dt ."+4 days"));
                     $dt1=date('d-M-Y',strtotime($dt2));
                     $dt4=date('D',strtotime($dt2));
                   }
                   elseif($dt3 == 'Wed' ){
                     //$dt2=date('d',strtotime($data['timestamp']))+4;
                     $dt2= date('Y-m-d', strtotime($dt ."+3 days"));
                     $dt1=date('d-M-Y',strtotime($dt2));
                     $dt4=date('D',strtotime($dt2));
                   }
                   elseif($dt3 == 'Thu' ){
                     //$dt2=date('d',strtotime($data['timestamp']))+4;
                     $dt2= date('Y-m-d', strtotime($dt ."+2 days"));
                     $dt1=date('d-M-Y',strtotime($dt2));
                     $dt4=date('D',strtotime($dt2));
                   }
                   elseif($dt3 == 'Fri' ){
                     //$dt2=date('d',strtotime($data['timestamp']))+4;
                     $dt2= date('Y-m-d', strtotime($dt ."+4 days"));
                     $dt1=date('d-M-Y',strtotime($dt2));
                     $dt4=date('D',strtotime($dt2));
                   }
                   elseif($dt3 == 'Sat' ){
                     //$dt2=date('d',strtotime($data['timestamp']))+4;
                     $dt2= date('Y-m-d', strtotime($dt ."+3 days"));
                     $dt1=date('d-M-Y',strtotime($dt2));
                     $dt4=date('D',strtotime($dt2));
                   }
                   elseif($dt3 == 'Sun' ){
                     //$dt2=date('d',strtotime($data['timestamp']))+4;
                     $dt2= date('Y-m-d', strtotime($dt ."+2 days"));
                     $dt1=date('d-M-Y',strtotime($dt2));
                     $dt4=date('D',strtotime($dt2));
                   }
                   echo $dt1." - $dt4 ";
                 //echo $dt3;echo $dt;
                 
                 */
                 <?php echo $data['delivery_date'];?>
               }
               else{
                 echo "Cancelled";
               }

        ?></td>
      </tr>
      <?php

          $total1= $data['Total'];
          $total=$total+$total1;
    }; ?>


    </tbody>
    <tfoot>
      <tr><td colspan="5" style="text-align:right">Sub Total:</td><td><?php echo $total; ?></td></tr>
      <tr><td colspan="5" style="text-align:right">Delivery Charge:</td><td><?php echo 20; ?></td></tr>
      <tr><td colspan="5" style="text-align:right">Grand Total:</td><td><?php echo $total+20; ?></td></tr>
    </tfoot>
  </table>


</div>

</div>




        <!-- </div> -->
        </div>
        </div>


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

<script>
        function calc_distance(lat,long){
          xhr = new XMLHttpRequest();
          xhr.open('POST' , 'get_distance.php' , true);

          xhr.setRequestHeader('Content-Type', 'application/json');
          xhr.send(JSON.stringify({
          lat:lat
          long:long

          }));


          xhr.onreadystatechange = function() {

          if (this.readyState == 4 && this.status == 200) {


           console.log('-------------------------------111--------------------------->>>')

          var temp =xhr.responseText;
          if (temp) {

          temp= JSON.parse(temp);


          document.getElementById('distance').value =temp.customer.BillingDet_Name;

          }

          }
          };


        }
</script>
  </body>
</html>
