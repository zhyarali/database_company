<?php
ob_start();
session_start();
require_once('../server/helper.php') ;
if (isset($_SESSION['adm_id']) && isset($_SESSION['adm_token'])) {
  $token =$_SESSION['adm_token'];
  $user_id = $_SESSION['adm_id'];
  }
  else {
  $token ='';
  $user_id = '';
  }
  $check = countdata(" SELECT * FROM user_tokens WHERE user_id='$user_id' AND token='$token'  ");
  if($check > 0 ) {
  $getuser = getdata(" SELECT * FROM admin WHERE id='$user_id'  ");
  $uname = $getuser['uname'];
  $username = $getuser['name'];
  }
  else {
  execute(" DELETE FROM user_tokens WHERE id='$user_id' ");
  }
  ?>
<!DOCTYPE html>
<html dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- <link rel="icon" type="image/png" href="../assets/img/favicon.png"> -->
  <title>
        Management system 
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <!-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> -->
  <link href="../assets/font-awesome/all.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3"  rel="stylesheet" />
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" media="print" rel="stylesheet" />

  <!-- custom css Files -->
  <link id="pagestyle" href="../assets/css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/datatables.css">
  <link rel="stylesheet" href="../assets/css/datatables.min.css">
  <script src="../assets/js/core/alert.js"></script>
 
  
</head>

<body>


<style>
    .table tbody tr:last-child td {
  border-width: 1px !important;
}
.table{
    border-radius:10px !important;
}
.table th{
    /* background:red !important; */
    /* font-size:12px !important; */
}
</style>



<div class="container-fluid  mt-3 d-flex justify-content-around">

        <div class="btn  btn-dark " id="print"><i class="fas fa-print" style="font-size:18px"></i> پرنتکردن</div>
</div>

<div class="container-fluid mt-2 d-flex flex-wrap" id="print_area">


<div class="col-lg-12 col-12  p-4 d-flex justify-content-between" style="border:1px solid black">

<div>
<p>سیستەمی کۆمپانیای هۆگر</p>
    <p>07501234567</p>
    <p>ڕانیە</p>
</div>



<div>
    <p>بەروار و کات : <?PHP echo date("Y-m-d H:i:s");?></p>
    <p>پسولەی کڕین</p>
</div>


</div>



    <div class="row col-lg-12 col-12 m-auto p-4 table-responsive">

      


    <?php

if (isset($_POST['submit'])){
    $report_type=$_POST['report_type'];

    if ($report_type=="buy") {
        echo "hasjha";
    }


    if ($report_type=="sale") {
        
    }


    if ($report_type=="return_buy") {
        
    }


    if ($report_type=="return_sale") {
        
    }


    if ($report_type=="debt") {
        
    }

    if ($report_type=="xarjy") {
        
    }





 

}
?>






    </div>
</div>


<br><br>





    



<!--   Core JS Files   -->

<script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/bootstrap.bundle.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  
  <script src="../assets/js/core/jquery.dataTables.js"></script>
  <script src="../assets/js/core/jquery.dataTables.min.js"></script>
  
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>


  <script src="../assets/js/core/alert.js"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
  <script src="../assets/js/printthis.js"></script>

   
</script>
        <script>
      $(document).ready(function() {
          var table = $('#example').DataTable( {
          } );
       
          $('input[type="search"]').addClass("search-input");

      } );

      $('#client').click(function() {
        $('.client_name').removeClass("d-none");
        $('.another').addClass("d-none");
     });

     $('#another').click(function() {
        $('.another').removeClass("d-none");
        $('.client_name').addClass("d-none");
     });



 $('#print').click(function() {
    window.print();
});

     </script>
</body>
</html>



