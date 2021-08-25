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


<div class="col-lg-12 col-12  p-4 d-flex justify-content-between bg-dark text-white" >

<div>
<p> سیستەمی کۆمپانیای هۆگر - ڕانیە</p>
    <p>07501234567</p>

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
    $date1=$_POST['date1'];
    $date2=$_POST['date2'];

    if ($report_type=="buy") { ?>



<table class="table table-bordered text-center" style="zoom:70%">
            <!-- <caption>List of users</caption> -->
            <thead>
                <tr>
                    <th scope="col">بەروار</th>
                    <th scope="col">ناوی شتوومەک</th>
                    <th scope="col">بڕ</th>
                    <th scope="col">جۆر</th>
                    <th scope="col">شوێن</th>
                    <th scope="col">نرخی تاک</th>
                    <th scope="col">نرخی واسڵکراو</th>
                    <th scope="col">نرخی داشکاندن</th>
                    <th scope="col">نرخی گشتی</th>
                    <th scope="col">نرخی ماوە</th>
                   
                    <th scope="col">فرۆشیار</th>


                </tr>
            </thead>
            <tbody>
<?php 
$sum_wasl=0;
$sum_discount=0;
$sum_gshty=0;
$sum_mawa=0;
$sum_maway_peshw=0;

$buys = show(" SELECT * FROM buy WHERE Date(date)>='$date1' AND Date(date)<='$date2' AND  `status`=1");
foreach ($buys as $buy) {
  $id = $buy['id'];
  $dealer_id = $buy['dealer_id'];
  $driver_id = $buy['driver_id'];
  $num = $buy['num'];
  $cost_t = $buy['cost_t'];
  $cost_co = $buy['cost_co'];
  $cost_wasl = $buy['cost_wasl'];
  $type = $buy['type'];
  $cost_mawa = $cost_co-$cost_wasl;
  $place = $buy['place'];
  $cost_froshtn = $buy['cost_fr'];
  $discount = $buy['discount'];
  $date = $buy['date'];
  $unit = $buy['unit'];
  $per=$buy['percentage'];
  $product_name=$buy['name_product'];
  $buy_type=$buy['buy_type'];
  $getdealer = getdata(" SELECT * FROM dealers WHERE id='$dealer_id' ");
  $dealer_name = $getdealer['name'];

//   koy gshty
$sum_wasl=$sum_wasl+$cost_wasl;
$sum_maway_peshw=$sum_maway_peshw+$cost_mawa;
$sum_gshty=$sum_gshty+$cost_co;
$sum_discount+=$discount;

?>
                <tr>
                <td><?=$date?></td>
                    <td>
                    <?php 
                    $buy_type_name='';
                    if ($buy_type=="qa3a") {
                        $buy_type_name='ئەشیای ناو قاعە';
                        echo $buy_type_name."<br>";
                        echo $product_name;
                    }

                    if ($buy_type=="asn") {
                        echo 'ئاسن';
                    }

                    if ($buy_type=="helka") {
                        echo 'هێلکە';
                    }

                    if ($buy_type=="3alaf") {
                        echo 'عەلەف';
                    }

                    
                    
                    ?> 

                    


                    </td>
                    
                    <td>
                        <?=$num?> <?=$unit?>
                        <?php
                        if ($buy_type=="3alaf") {
                            echo "<br>".$per." کیلۆگرام";
                        }
                        ?>
                    </td>
                    <td><?=$type?></td>
                    <td>
                        <?php
                            if (!empty($place)) {
                                echo $place;
                            }else{
                                echo "-";
                            }
                        ?>
                   </td>
                    <td><?=$cost_t?></td>
                    <td><?=$cost_wasl?></td>
                    <td><?=$discount?></td>
                    <td><?=$cost_co?></td>
                    <td><?=$cost_mawa?></td>
                    <td><?=$dealer_name?></td>
                
                </tr>
                <?php } ?>
                <tr class="bg-dark text-white">
                    <td class="bg-dark text-white">کۆی گشتی</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?=$sum_wasl?> دینار</td>
                    <td><?=$sum_discount?> دینار</td>
                    <td><?=$sum_gshty?> دینار</td>
                    <td><?=$sum_maway_peshw?> دینار</td>
                    <td></td>

                </tr>
            </tbody>
        </table>


        
  <?php  } ?>


  

   <?php 

    if ($report_type=="sale") { ?>


<table class="table table-bordered text-center" style="zoom:90%">
            <!-- <caption>List of users</caption> -->
            <thead>
                <tr>
                <th scope="col">بەروار</th>
                    <th scope="col">ناوی شتوومەک</th>
                    <th scope="col">بڕ</th>
                    <th scope="col">جۆر</th>
                    <th scope="col">شوێن</th>
                    <th scope="col">نرخی فرۆشتن</th>
                    <th scope="col">نرخی واسڵکراو</th>
                    <th scope="col">نرخی داشکاندن</th>
                    <th scope="col">نرخی گشتی</th>
                    <th scope="col">نرخی ماوە</th>
                   
                    <th scope="col">کڕیار</th>


                </tr>
            </thead>
            <tbody>
<?php 
$sum_wasl=0;
$sum_discount=0;
$sum_gshty=0;
$sum_mawa=0;
$sum_maway_peshw=0;

$sales = show(" SELECT * FROM sale WHERE Date(date)>='$date1' AND Date(date)<='$date2' AND `status`=1");
foreach ($sales as $sale) {
  $id = $sale['id'];
  $customer_id = $sale['customer_id'];
  $driver_id = $sale['driver_id'];
  $num = $sale['num'];
  $cost_t = $sale['cost_t'];
  $cost_co = $sale['cost_co'];
  $cost_wasl = $sale['cost_wasl'];
  $type = $sale['type'];
  $cost_mawa = $cost_co-$cost_wasl;
  $place = $sale['place'];
  $discount = $sale['discount'];
  $date = $sale['date'];
  $unit = $sale['unit'];
  $per=$sale['percentage'];
  $product_name=$sale['name_product'];
  $sale_type=$sale['sale_type'];

//   koy gshty
$sum_wasl=$sum_wasl+$cost_wasl;
$sum_maway_peshw=$sum_maway_peshw+$cost_mawa;
$sum_gshty=$sum_gshty+$cost_co;
$sum_discount+=$discount;


  $getcustomer = getdata(" SELECT * FROM customer WHERE id='$customer_id' ");
  $customer_name = $getcustomer['name'];



?>
                <tr>
                <td><?=$date?></td>
                    <td>
                    <?php 
                    $sale_type_name='';
                    if ($sale_type=="qa3a") {
                        $sale_type_name='ئەشیای ناو قاعە';
                        echo $sale_type_name."<br>";
                        echo $product_name;
                    }

                    if ($sale_type=="asn") {
                        echo 'ئاسن';
                    }

                    if ($sale_type=="helka") {
                        echo 'هێلکە';
                    }

                    if ($sale_type=="3alaf") {
                        echo 'عەلەف';
                    }

                    
                    
                    ?> 

                    


                    </td>
               
                    <td>
                        <?=$num?> <?=$unit?>
                        <?php
                        if ($sale_type=="3alaf") {
                            echo "<br>".$per." کیلۆگرام";
                        }
                        ?>
                    </td>
                    <td><?=$type?></td>
                    <td>
                        <?php
                            if (!empty($place)) {
                                echo $place;
                            }else{
                                echo "-";
                            }
                        ?>
                   </td>
                    <td><?=$cost_t?></td>
                    <td><?=$cost_wasl?></td>
                    <td><?=$discount?></td>
                    <td><?=$cost_co?></td>
                    <td><?=$cost_mawa?></td>
                    <td><?=$customer_name?></td>
                
                </tr>
                <?php } ?>
                <tr class="bg-dark text-white">
                    <td class="bg-dark text-white">کۆی گشتی</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?=$sum_wasl?> دینار</td>
                    <td><?=$sum_discount?> دینار</td>
                    <td><?=$sum_gshty?> دینار</td>
                    <td><?=$sum_maway_peshw?> دینار</td>
                    <td></td>

                </tr>
            </tbody>
        </table>

        
   <?php } ?>


  <?php 
   if ($report_type=="return_buy") { ?>

<table class="table table-bordered text-center" style="zoom:70%">
            <!-- <caption>List of users</caption> -->
            <thead>
                <tr>
                    <th scope="col">بەروار</th>
                    <th scope="col">ناوی شتوومەک</th>
                    <th scope="col">بڕ</th>
                    <th scope="col">جۆر</th>
                    <th scope="col">شوێن</th>
                    <th scope="col">نرخی تاک</th>
                    <th scope="col">نرخی واسڵکراو</th>
                    <th scope="col">نرخی داشکاندن</th>
                    <th scope="col">نرخی گشتی</th>
                    <th scope="col">نرخی ماوە</th>
                   
                    <th scope="col">فرۆشیار</th>


                </tr>
            </thead>
            <tbody>
<?php 
$sum_wasl=0;
$sum_discount=0;
$sum_gshty=0;
$sum_mawa=0;
$sum_maway_peshw=0;

$buys = show(" SELECT * FROM buy WHERE Date(date)>='$date1' AND Date(date)<='$date2' AND  `status`=-1");
foreach ($buys as $buy) {
  $id = $buy['id'];
  $dealer_id = $buy['dealer_id'];
  $driver_id = $buy['driver_id'];
  $num = $buy['num'];
  $cost_t = $buy['cost_t'];
  $cost_co = $buy['cost_co'];
  $cost_wasl = $buy['cost_wasl'];
  $type = $buy['type'];
  $cost_mawa = $cost_co-$cost_wasl;
  $place = $buy['place'];
  $cost_froshtn = $buy['cost_fr'];
  $discount = $buy['discount'];
  $date = $buy['date'];
  $unit = $buy['unit'];
  $per=$buy['percentage'];
  $product_name=$buy['name_product'];
  $buy_type=$buy['buy_type'];
  $getdealer = getdata(" SELECT * FROM dealers WHERE id='$dealer_id' ");
  $dealer_name = $getdealer['name'];

//   koy gshty
$sum_wasl=$sum_wasl+$cost_wasl;
$sum_maway_peshw=$sum_maway_peshw+$cost_mawa;
$sum_gshty=$sum_gshty+$cost_co;
$sum_discount+=$discount;

?>
                <tr>
                <td><?=$date?></td>
                    <td>
                    <?php 
                    $buy_type_name='';
                    if ($buy_type=="qa3a") {
                        $buy_type_name='ئەشیای ناو قاعە';
                        echo $buy_type_name."<br>";
                        echo $product_name;
                    }

                    if ($buy_type=="asn") {
                        echo 'ئاسن';
                    }

                    if ($buy_type=="helka") {
                        echo 'هێلکە';
                    }

                    if ($buy_type=="3alaf") {
                        echo 'عەلەف';
                    }

                    
                    
                    ?> 

                    


                    </td>
                    
                    <td>
                        <?=$num?> <?=$unit?>
                        <?php
                        if ($buy_type=="3alaf") {
                            echo "<br>".$per." کیلۆگرام";
                        }
                        ?>
                    </td>
                    <td><?=$type?></td>
                    <td>
                        <?php
                            if (!empty($place)) {
                                echo $place;
                            }else{
                                echo "-";
                            }
                        ?>
                   </td>
                    <td><?=$cost_t?></td>
                    <td><?=$cost_wasl?></td>
                    <td><?=$discount?></td>
                    <td><?=$cost_co?></td>
                    <td><?=$cost_mawa?></td>
                    <td><?=$dealer_name?></td>
                
                </tr>
                <?php } ?>
                <tr class="bg-dark text-white">
                    <td class="bg-dark text-white">کۆی گشتی</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?=$sum_wasl?> دینار</td>
                    <td><?=$sum_discount?> دینار</td>
                    <td><?=$sum_gshty?> دینار</td>
                    <td><?=$sum_maway_peshw?> دینار</td>
                    <td></td>

                </tr>
            </tbody>
        </table>


        
  <?php  } ?>


  <?php 

if ($report_type=="return_sale") { ?>


<table class="table table-bordered text-center" style="zoom:90%">
        <!-- <caption>List of users</caption> -->
        <thead>
            <tr>
            <th scope="col">بەروار</th>
                <th scope="col">ناوی شتوومەک</th>
                <th scope="col">بڕ</th>
                <th scope="col">جۆر</th>
                <th scope="col">شوێن</th>
                <th scope="col">نرخی فرۆشتن</th>
                <th scope="col">نرخی واسڵکراو</th>
                <th scope="col">نرخی داشکاندن</th>
                <th scope="col">نرخی گشتی</th>
                <th scope="col">نرخی ماوە</th>
               
                <th scope="col">کڕیار</th>


            </tr>
        </thead>
        <tbody>
<?php 
$sum_wasl=0;
$sum_discount=0;
$sum_gshty=0;
$sum_mawa=0;
$sum_maway_peshw=0;

$sales = show(" SELECT * FROM sale WHERE Date(date)>='$date1' AND Date(date)<='$date2' AND `status`=-1");
foreach ($sales as $sale) {
$id = $sale['id'];
$customer_id = $sale['customer_id'];
$driver_id = $sale['driver_id'];
$num = $sale['num'];
$cost_t = $sale['cost_t'];
$cost_co = $sale['cost_co'];
$cost_wasl = $sale['cost_wasl'];
$type = $sale['type'];
$cost_mawa = $cost_co-$cost_wasl;
$place = $sale['place'];
$discount = $sale['discount'];
$date = $sale['date'];
$unit = $sale['unit'];
$per=$sale['percentage'];
$product_name=$sale['name_product'];
$sale_type=$sale['sale_type'];

//   koy gshty
$sum_wasl=$sum_wasl+$cost_wasl;
$sum_maway_peshw=$sum_maway_peshw+$cost_mawa;
$sum_gshty=$sum_gshty+$cost_co;
$sum_discount+=$discount;


$getcustomer = getdata(" SELECT * FROM customer WHERE id='$customer_id' ");
$customer_name = $getcustomer['name'];



?>
            <tr>
            <td><?=$date?></td>
                <td>
                <?php 
                $sale_type_name='';
                if ($sale_type=="qa3a") {
                    $sale_type_name='ئەشیای ناو قاعە';
                    echo $sale_type_name."<br>";
                    echo $product_name;
                }

                if ($sale_type=="asn") {
                    echo 'ئاسن';
                }

                if ($sale_type=="helka") {
                    echo 'هێلکە';
                }

                if ($sale_type=="3alaf") {
                    echo 'عەلەف';
                }

                
                
                ?> 

                


                </td>
           
                <td>
                    <?=$num?> <?=$unit?>
                    <?php
                    if ($sale_type=="3alaf") {
                        echo "<br>".$per." کیلۆگرام";
                    }
                    ?>
                </td>
                <td><?=$type?></td>
                <td>
                    <?php
                        if (!empty($place)) {
                            echo $place;
                        }else{
                            echo "-";
                        }
                    ?>
               </td>
                <td><?=$cost_t?></td>
                <td><?=$cost_wasl?></td>
                <td><?=$discount?></td>
                <td><?=$cost_co?></td>
                <td><?=$cost_mawa?></td>
                <td><?=$customer_name?></td>
            
            </tr>
            <?php } ?>
            <tr class="bg-dark text-white">
                <td class="bg-dark text-white">کۆی گشتی</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?=$sum_wasl?> دینار</td>
                <td><?=$sum_discount?> دینار</td>
                <td><?=$sum_gshty?> دینار</td>
                <td><?=$sum_maway_peshw?> دینار</td>
                <td></td>

            </tr>
        </tbody>
    </table>

    
<?php } ?>



<?php if ($report_type=="debt") { ?>

    <table class="table table-bordered text-center" style="zoom:95%">
            <!-- <caption>List of users</caption> -->
            <thead>
                <tr>
                    <th scope="col">ناو</th>
                    <th scope="col">ژمارە مۆبایل</th>
                    <th scope="col"> بڕی قەرز</th>
                    <th scope="col"> بەروار وەرگرتن</th>
                    <th scope="col">بڕی گێڕاوە</th>
                    <th scope="col">بڕی ماوە</th>
                    <th scope="col"> بەروار تەواوبوون</th>
          
                </tr>
            </thead>
            <tbody>

                <?php
                $sum_debt=0;
                $sum_mawa=0;
       $debts=show("SELECT * FROM debt WHERE Date(date_start)>='$date1' AND Date(date_start)<='$date2'");
    
    foreach ($debts as $debt) {
            $debt_id=$debt['id_debt'];
            $debt_amount=$debt['debt_amount'];
            $date_debt_start=$debt['date_start'];
            $date_debt_end=$debt['date_end'];
            $gerawa=$debt['gerawa'];
            $mawa=$debt['mawa'];
            $name=$debt['name'];
            $phone=$debt['phone'];
            $client_id=$debt['clientid'];

            $sum_debt+=$debt_amount;
            $sum_mawa+=$mawa;
     ?>

<?php
                $alert_date=date('Y-m-d', strtotime($date_debt_end. ' - 2 days'));
                $today=date("Y-m-d") ;
                
                ?>

                <tr class="<?php  echo $alert_date<=$today ?  'debt_danger' : '' ;  echo $mawa==0 ? 'debt_success': '' ?>" >
                    <td><?=$name?></td>  
                    <td><?=$phone?></td>  
                    <td><?=$debt_amount?></td>
                    <td><?=$date_debt_start?></td>
                    <td><?=$gerawa?></td>
                    <td><?=$mawa?></td>
                    <td><?=$date_debt_end?></td>
               

                </tr>
                <?php } ?>


                <tr class="bg-dark text-white">
                    <td class="bg-dark text-white">کۆی گشتی</td>
                    <td></td>
                    <td><?=$sum_debt?> دینار</td>
                    <td></td>
                    <td></td>
                    <td><?=$sum_mawa?> دینار</td>
                    <td></td>
                </tr>

            </tbody>
        </table>

<?php } ?>



<?php if ($report_type=="xarjy") { ?>

    <table class="table table-bordered  text-center" dir="rtl" style="zoom:85%">
        <thead>
            <tr>
            <th>بەروار</th>
                <th>بۆچی خەرجکراوە</th>
                <th>خەرجکراوە لەلایەن</th>
                <th>پارەی وەرگیراو</th>
                <th>بڕی نرخی خەرجکراو</th>
                <th>نرخی ماوە</th>
                <th>شوێن</th>
                <th>   ژمارە مۆبایل  </th>
               
            </tr>
        </thead>
        <tbody>
<?php 
$sum_wargeraw=0;
$sum_xarjkraw=0;
$sum_mawa=0;

$items = show(" SELECT * FROM xarjy WHERE Date(date)>='$date1' AND Date(date)<='$date2'");
foreach ($items as $item) {
  $id = $item['id'];
  $name = $item['name_item'];
  $price = $item['price'];
  $place = $item['place'];
  $get_price = $item['get_price'];
  $xarj_by = $item['xarj_by'];
  $date = $item['date'];
  $price_mawa=$get_price - $price;

  $sum_wargeraw+=$get_price;
  $sum_xarjkraw+=$price;
  $sum_mawa+=$price_mawa;

?>
       <tr>
       <td><?=$date;?></td>
        <td><?=$name;?></td>
        <?php
          $persons = show(" SELECT * FROM person WHERE  `id`=$xarj_by");
          foreach ($persons as $person) {
            $name_person = $person['name'];
        ?>
        <td><?=$name_person;?></td>
        <?php } ?>
        <td><?=$get_price;?></td>
        <td><?=$price;?></td>
        <td><?=$price_mawa;?></td>
        <td><?=$place;?></td>
        <?php
          $persons = show(" SELECT * FROM person WHERE  `id`=$xarj_by");
          foreach ($persons as $person) {
            $phone_person = $person['phone'];
        ?>
        <td><?=$phone_person;?></td>
        
        <?php } ?>
    
      </tr>     
<?php
}
?>

               <tr class="bg-dark text-white">
                    <td class="bg-dark text-white">کۆی گشتی</td>
                    <td></td>
                    <td><?=$sum_wargeraw?> دینار</td>
                    <td><?=$sum_xarjkraw?> دینار</td>
                    <td><?=$sum_mawa?> دینار</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

        </tbody>
    </table>


<?php } ?>





<!-- end  if isset($_POST['submit']) -->
   <?php } ?>

   </div>



   <!-- client monthlty and daily -->

    <?php if (isset($_GET['client_month'])){  
        $client_id=$_GET['client_month'];  
        $data = show(" SELECT * FROM client WHERE `id`=$client_id");
        
        if (empty($data)) {
            direct('index.php');
        }else{  
            foreach ($data as $client) {
                $id = $client['id'];
                $name = $client['name'];
                $phone = $client['phone'];
                $date = $client['date_start'];
                $work_place = $client['work_place'];
                $status = $client['status'];
                $get_teams=getdata("SELECT * FROM teams WHERE id= '$work_place'");

                $team_name='';
                if ($get_teams==null) {
                $team_name=$work_place;
                }else{
                $team_name='ستافی '.$get_teams['name'];
                } 
        ?>


<div class="row col-lg-4 col-12 m-auto">
        <div class="card border shadow-none m-auto " style="width: 25rem;border-radius:8px">
            <ul class="list-group list-group-flush text-center">
                <li class="list-group-item"><strong>ناو : </strong> <?=$name?></li>
                <li class="list-group-item"><strong>ژمارە مۆبایل : </strong> <?=$phone?></li>
                <li class="list-group-item"><strong>بەرواری دەستپێکردن : </strong><?=$date?></li>
                <li class="list-group-item"><strong>شوێنی کار : </strong><?=$team_name?></li>
                <li class="list-group-item"><strong>جۆری کارکردن : </strong>مانگانە</li>

            </ul>
        </div>
    </div>

<div class="row col-lg-8 col-12 m-auto p-4 table-responsive">

<table class="table table-bordered text-center">
    <!-- <caption>List of users</caption> -->
    <thead>
        <tr>
            <th scope="col">بەروار</th>
            <th scope="col">بڕی موچە</th>
            <th scope="col">غەرامە</th>
            <th scope="col">کۆی گشتی مووچە</th>
        </tr>
    </thead>
    <tbody>
        <?php
$joins=show("SELECT * FROM budget WHERE clientid= $client_id");

foreach ($joins as $join) {
$budget_id=$join['id_budget'];
    $date_bud=$join['date'];
    $budget_amount=$join['budget_amount'];
    $punish=$join['punish'];
?>
        <tr>
            <td><?=$date_bud?></td>
            <td><?=$budget_amount?></td>
            <td><?=$punish?></td>
            <td>
                <?php
  $result=$budget_amount-$punish;
  echo $result."  هەزار";
  ?>
            </td>
        </tr>


        
        <?php } ?>
            </tbody>
        </table>

    </div>
        

       <?php } } } ?>





    <!-- client daily -->

    <?php if (isset($_GET['client_daily'])){  
        $client_id=$_GET['client_daily'];  
        $data = show(" SELECT * FROM client WHERE `id`=$client_id");
        
        if (empty($data)) {
            direct('index.php');
        }else{  
            foreach ($data as $client) {
                $id = $client['id'];
                $name = $client['name'];
                $phone = $client['phone'];
                $date = $client['date_start'];
                $work_place = $client['work_place'];
                $status = $client['status'];
                $get_teams=getdata("SELECT * FROM teams WHERE id= '$work_place'");

                $team_name='';
                if ($get_teams==null) {
                $team_name=$work_place;
                }else{
                $team_name='ستافی '.$get_teams['name'];
                } 
        ?>


<div class="row col-lg-4 col-12 m-auto">
        <div class="card border shadow-none m-auto " style="width: 25rem;border-radius:8px">
            <ul class="list-group list-group-flush text-center">
                <li class="list-group-item"><strong>ناو : </strong> <?=$name?></li>
                <li class="list-group-item"><strong>ژمارە مۆبایل : </strong> <?=$phone?></li>
                <li class="list-group-item"><strong>بەرواری دەستپێکردن : </strong><?=$date?></li>
                <li class="list-group-item"><strong>شوێنی کار : </strong><?=$team_name?></li>
                <li class="list-group-item"><strong>جۆری کارکردن : </strong>ڕۆژانە</li>

            </ul>
        </div>
    </div>


    <div class="row col-lg-9 col-12 m-auto p-4 table-responsive" style="zoom:90%"> 

<table class="table table-bordered text-center">
    <!-- <caption>List of users</caption> -->
    <thead>
        <tr>
            <th scope="col">بەروار</th>
            <th scope="col">سەعاتی کارکردن</th>
            <th scope="col">نرخی سەعاتی کارکردن</th>
            <th scope="col">سەعاتی ئیزافە</th>
            <th scope="col">غەرامە</th>
            <th scope="col">کۆی گشتی مووچە</th>
        </tr>
    </thead>
    <tbody>
        <?php
$joins=show("SELECT * FROM work_daily WHERE clientid= $client_id");

foreach ($joins as $join) {
    $daily_id=$join['id_daily'];
    $work_hour=$join['work_hour'];
    $work_hour_amount=$join['work_hour_amount'];
    $work_extra=$join['work_extra'];
    $budget=$join['budget'];
    $punish=$join['punish'];
    $date=$join['date'];
    $clientid=$join['clientid'];
?>
        <tr>
            <td><?=$date?></td>
            <td><?=$work_hour?></td>
            <td><?=$work_hour_amount?></td>
            <td><?=$work_extra?></td>
            <td><?=$punish?></td>
            <td><?=$budget?></td>
        </tr>


        
        <?php } ?>
            </tbody>
        </table>

    </div>
        

       <?php } } } ?>
    
    
    
   





       





    
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


