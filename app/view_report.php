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
 <script type="text/javascript">
     window.print();
 </script>

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
@page {
  size: A4 landscape;
}

/* Size in mm */    
@page {
  size: 100mm 200mm landscape;
}

/* Size in inches */    
@page {
  size: 4in 6in landscape;
}
</style>


<div class="container-fluid mt-2 d-flex flex-wrap" id="print_area">
<div class="col-lg-12 col-12" >
<div style="display:flex;justify-content:space-around;align-items:center;margin-top:20px">
    

    <div  style="text-align:center">
        <h5>کۆمپانیای ئارام</h5>
        <h5 style="margin-top:20px">بۆ کێلگەی پەلەوەری و بینای ئاسن</h5>
        <h5 style="margin-top:20px">ئارام : 07501200241 - 07714550600</h5>
        <h5 style="margin-top:20px">ئاکام : 07501200238 - 07514550600</h5>
    </div>

<div style="text-align:center">
<img src="../assets/img/appLogo.PNG" width="350px">
</div>


<div style="text-align:center">
<h5>بەروار : <?php echo date("d - m - Y"); ?></h5>
    <h5 style="margin-top:20px"s>پسولەی پڕۆژەی ستافەکان</h5>
    <h5 style="margin-top:20px">ناونیشان : سلێمانی - ڕانیە - دەربەند</h5>
</div>


</div>

<?php

if (isset($_POST['submit'])){
    $report_type=$_POST['report_type'];
    $date1=$_POST['date1'];
    $date2=$_POST['date2'];

    if ($report_type=="buy") { ?>


    <div class="row col-lg-12 col-12 m-auto p-4 table-responsive" style="zoom:60%">
    



<table class="table table-bordered text-center" >
            <!-- <caption>List of users</caption> -->
            <thead>
                <tr>
                    <th scope="col">بەروار</th>
                    <th scope="col">ناوی شتوومەک</th>
                    <th scope="col">بڕ</th>
                    <th scope="col">جۆر</th>
                    <th scope="col">شوێن</th>
                    <th>جۆری دراو</th>
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
  
  $currency_type=$getdealer['currency_type'];
  if ($currency_type=='dinar') {
    $currency_type='دینار';
  }

  if ($currency_type=='dollar') {
    $currency_type='دۆلار';
  }

  if ($currency_type=='tman') {
    $currency_type='تمەن';
  }

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
                   <td><?=$currency_type;?></td>
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
                    <td></td>
                    <td><?=$sum_wasl?> </td>
                    <td><?=$sum_discount?> </td>
                    <td><?=$sum_gshty?> </td>
                    <td><?=$sum_maway_peshw?></td>
                    <td></td>

                </tr>
            </tbody>
        </table>


        
  <?php  } ?>


  

   <?php 

    if ($report_type=="sale") { ?>


<table class="table table-bordered text-center" style="zoom:80%">
            <!-- <caption>List of users</caption> -->
            <thead>
                <tr>
                <th scope="col">بەروار</th>
                    <th scope="col">ناوی شتوومەک</th>
                    <th scope="col">بڕ</th>
                    <th scope="col">جۆر</th>
                    <th scope="col">شوێن</th>
                    <th>جۆری دراو</th>
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

  $currency_type=$getcustomer['currency_type'];
  if ($currency_type=='dinar') {
    $currency_type='دینار';
  }

  if ($currency_type=='dollar') {
    $currency_type='دۆلار';
  }

  if ($currency_type=='tman') {
    $currency_type='تمەن';
  }



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
                   <td><?=$currency_type;?></td>
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
                    <th>جۆری دراو</th>
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

  $currency_type=$getdealer['currency_type'];
  if ($currency_type=='dinar') {
    $currency_type='دینار';
  }

  if ($currency_type=='dollar') {
    $currency_type='دۆلار';
  }

  if ($currency_type=='tman') {
    $currency_type='تمەن';
  }

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
                   <td><?=$currency_type;?></td>
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
                    <td></td>
                    <td><?=$sum_wasl?></td>
                    <td><?=$sum_discount?></td>
                    <td><?=$sum_gshty?></td>
                    <td><?=$sum_maway_peshw?></td>
                    <td></td>

                </tr>
            </tbody>
        </table>


        
  <?php  } ?>


  <?php 

if ($report_type=="return_sale") { ?>


<table class="table table-bordered text-center" style="zoom:85%">
        <!-- <caption>List of users</caption> -->
        <thead>
            <tr>
            <th scope="col">بەروار</th>
                <th scope="col">ناوی شتوومەک</th>
                <th scope="col">بڕ</th>
                <th scope="col">جۆر</th>
                <th scope="col">شوێن</th>
                <th>جۆری دراو</th>
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

$currency_type=$getcustomer['currency_type'];
if ($currency_type=='dinar') {
  $currency_type='دینار';
}

if ($currency_type=='dollar') {
  $currency_type='دۆلار';
}

if ($currency_type=='tman') {
  $currency_type='تمەن';
}



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
               <td><?=$currency_type;?></td>
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
                <td></td>
                <td><?=$sum_wasl?> </td>
                <td><?=$sum_discount?> </td>
                <td><?=$sum_gshty?> </td>
                <td><?=$sum_maway_peshw?> </td>
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
                    <td><?=$sum_debt?> </td>
                    <td></td>
                    <td></td>
                    <td><?=$sum_mawa?> </td>
                    <td></td>
                </tr>

            </tbody>
        </table>

<?php } ?>



<?php if ($report_type=="xarjy") { ?>

    <table class="table table-bordered  text-center" dir="rtl" style="zoom:80%">
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
        <td style="max-width:320px;width:320px;overflow:hidden;word-wrap: break-word;overflow-wrap: break-word;white-space: pre-wrap;"><?=$name;?></td>
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


<!-- dealer single info -->

<?php if (isset($_POST['dealer_info'])){  
    $user_id= secure($_POST['user_id']);

    if (isset($_POST['con_id'])) {
        $post_id= secure($_POST['con_id']);
        $buys = show("SELECT * FROM buy WHERE dealer_id=$user_id AND id=$post_id AND `status`=1");
        $numRecord=countdata("SELECT * FROM buy WHERE dealer_id=$user_id AND id=$post_id AND `status`=1");
    }else{
        $buys = show(" SELECT * FROM buy WHERE dealer_id=$user_id AND `status`=1");
        $numRecord=countdata(" SELECT * FROM buy WHERE dealer_id=$user_id AND `status`=1");
    }
   

    $data = show(" SELECT * FROM dealers WHERE `id`=$user_id");  
    foreach ($data as $user) {
        $name = $user['name'];
        $phone = $user['phone'];
        $address = $user['address'];
        $work_place = $user['work_place'];
        $note = $user['note']; 
        $currency_type = $user['currency_type']; 
     
        if ($currency_type=='dinar') {$currency_type='دینار';}
        if ($currency_type=='dollar') {$currency_type='دۆلار';}
        if ($currency_type=='tman') {$currency_type='تمەن';}

        $refund_p=0;
        $refund=getdata(" SELECT sum(price) as price from refund WHERE dealer_id=$user_id");
       
        if (!empty($refund)) {
            $refund_p=$refund['price']; 
        }


        $dealers_buy=getdata(" SELECT sum(cost_co) as cost_total,sum(cost_wasl) as cost_wasl FROM buy WHERE dealer_id=$user_id AND `status`=1");
        $cost_maway_peshw=$dealers_buy['cost_total']-$dealers_buy['cost_wasl'];
        $cost_maway_peshw-=$refund_p;

        if ($cost_maway_peshw<0) {$cost_maway_peshw=0;}

       

?>

<hr>
<div class="container mr-5 mb-3 mt-3">
<h6 class="d-flex justify-content-between"> <span>ناوی فرۆشیار  :  <?=$name?></span>   <span>مۆبایل : <?=$phone?>  </span>  </h6>
</div>
<?php } ?>
 
 <table class="table table-bordered text-center" style="zoom:90%">
            <!-- <caption>List of users</caption> -->
            <thead>
                <tr>
                    <th scope="col">ناوی شتوومەک</th>
                    <th scope="col">بەروار</th>
                    <th scope="col">بڕ</th>
                    <th scope="col">جۆر</th>
                    <th scope="col">شوێن</th>
                    <th scope="col">جۆری دراو</th>
                    <th scope="col">نرخی تاک</th>
                    <th scope="col">نرخی واسڵکراو</th>
                    <th scope="col">نرخی داشکاندن</th>
                    <th scope="col">نرخی گشتی</th>
                    <th scope="col">نرخی ماوە</th>                   
                    <th scope="col">شۆفێر</th>

                </tr>
            </thead>
            <tbody  id="show_data">
<?php 
$sum_wasl=0;
$sum_discount=0;
$sum_gshty=0;
$sum_mawa=0;
$sum_maway_peshw=0;



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

//   koy gshty
$sum_wasl=$sum_wasl+$cost_wasl;
$sum_maway_peshw=$sum_maway_peshw+$cost_mawa;
$sum_gshty=$sum_gshty+$cost_co;
$sum_discount+=$discount;




//   $getdealer = getdata(" SELECT * FROM dealers WHERE id='$dealer_id' ");
//   $dealer_name = $getdealer['name'];



?>
                <tr>
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
                    <td><?=$date?></td>
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
                    <td><?=$currency_type?></td>
                    <td><?=$cost_t?></td>
                    <td><?=$cost_wasl?></td>
                    <td><?=$discount?></td>
                    <td><?=$cost_co?></td>
                    <td><?=$cost_mawa?></td>
                    <td class="driver-info">
                        <?php
                        if ($driver_id!=0) {
                            $getdriver = getdata(" SELECT * FROM drivers WHERE id='$driver_id' ");
                            $driver_name = $getdriver['name'];
                            $driver_phone = $getdriver['phone'];
                            $driver_car_number = $getdriver['car_number'];
                            echo "<span>$driver_name</span>"."<br>";
                            echo $driver_car_number."<br>";
                            echo $driver_phone."<br>";
                        }else{
                            echo "-";
                        }
                        
                        ?>
                    </td>
     
                </tr>
                <?php } ?>

            </tbody>
        </table>

<div class="row mt-5 d-flex justify-content-center">
    <div class="col-lg-4 col-sm-5 ml-auto">
        <table class="table table-clear text-center">
            <tbody>
                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی واسڵکراو</strong>
                    </td>
                    <td class="right"><?=$sum_wasl?></td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی داشکاندن</strong>
                    </td>
                    <td class="right"><?=$sum_discount?></td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی ماوە</strong>
                    </td>
                    <td class="right">
                        <?php 
                            if ($numRecord==2) {
                                echo $cost_maway_peshw;
                            }else{
                                echo $cost_mawa;
                            }
                        ?>
                    </td>
                </tr>

                <tr class="bg-dark text-light">
                    <td class="left">
                    <strong>کۆی گشتی نرخ</strong>
                    </td>
                    <td class="right">
                    <strong><?=$sum_gshty?></strong>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

 <?php } ?>   

<!-- end dealer single info -->




<!-- customer  info -->

<?php if (isset($_POST['customer_info'])){  
    $user_id= secure($_POST['user_id']);

    if (isset($_POST['con_id'])) {
        $post_id= secure($_POST['con_id']);
        $sales = show(" SELECT * FROM sale WHERE customer_id=$user_id AND `id`=$post_id AND `status`=1");
        $numRecord=countdata("SELECT * FROM sale WHERE customer_id=$user_id AND `id`=$post_id AND `status`=1");
    }else{
        $sales = show(" SELECT * FROM sale WHERE customer_id=$user_id AND `status`=1");
        $numRecord=countdata("SELECT * FROM sale WHERE customer_id=$user_id AND `status`=1");
    }

    $data = show(" SELECT * FROM customer WHERE `id`=$user_id");  
    foreach ($data as $user) {
        $name=$user['name'];
        $phone=$user['phone'];
        $currency_type=$user['currency_type'];
        if ($currency_type=='dinar') {$currency_type='دینار';}
        if ($currency_type=='dollar') {$currency_type='دۆلار';}
        if ($currency_type=='tman') {$currency_type='تمەن';}

        $refund_p=0;
        $refund=getdata(" SELECT sum(price) as price from refund_customer WHERE customer_id=$user_id");
       
        if (!empty($refund)) {
            $refund_p=$refund['price']; 
        }

        $customer=getdata(" SELECT sum(cost_co) as cost_total,sum(cost_wasl) as cost_wasl FROM sale WHERE customer_id=$user_id AND `status`=1");
        $cost_maway_peshw=$customer['cost_total']-$customer['cost_wasl'];
        $cost_maway_peshw-=$refund_p;

        if ($cost_maway_peshw<0) {$cost_maway_peshw=0;}


?>

<hr>
<div class="container mr-5 mb-3 mt-3">
    <h6 class="d-flex justify-content-between"> <span>ناوی کڕیار  :  <?=$name?></span>   <span>مۆبایل : <?=$phone?>  </span>  </h6>
</div>

<table class="table table-bordered text-center" style="zoom:90%">
            <!-- <caption>List of users</caption> -->
            <thead>
                <tr>
                    <th scope="col">ناوی شتوومەک</th>
                    <th scope="col">بەروار</th>
                    <th scope="col">بڕ</th>
                    <th scope="col">جۆر</th>
                    <th scope="col">شوێن</th>
                    <th scope="col">جۆری دراو</th>
                    <th scope="col">نرخی فرۆشتن</th>
                    <th scope="col">نرخی واسڵکراو</th>
                    <th scope="col">نرخی داشکاندن</th>
                    <th scope="col">نرخی گشتی</th>
                    <th scope="col">نرخی ماوە</th>
                   
                    <th scope="col">شۆفێر</th>



                </tr>
            </thead>
            <tbody id="show_data">
<?php 
$sum_wasl=0;
$sum_discount=0;
$sum_gshty=0;
$sum_mawa=0;
$sum_maway_peshw=0;

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


?>
                <tr>
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
                    <td><?=$date?></td>
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
                   <td><?=$currency_type;?></td>
                    <td><?=$cost_t?></td>
                    <td><?=$cost_wasl?></td>
                    <td><?=$discount?></td>
                    <td><?=$cost_co?></td>
                    <td><?=$cost_mawa?></td>
                    <td class="driver-info">
                        <?php
                        if ($driver_id!=0) {
                            $getdriver = getdata(" SELECT * FROM drivers WHERE id='$driver_id' ");
                            $driver_name = $getdriver['name'];
                            $driver_phone = $getdriver['phone'];
                            $driver_car_number = $getdriver['car_number'];
                            echo "<span>$driver_name</span>"."<br>";
                            echo $driver_car_number."<br>";
                            echo $driver_phone."<br>";
                        }else{
                            echo "-";
                        }
                        
                        ?>
                    </td>

  
                
                </tr>
                <?php } ?>
                <!-- <tr class="bg-dark text-white">
                    <td class="bg-dark text-white">کۆی گشتی</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?=$sum_wasl?></td>
                    <td><?=$sum_discount?></td>
                    <td><?=$sum_gshty?></td>
                    <td><?=$sum_maway_peshw?></td>
                    <td></td>
   

                </tr> -->
            </tbody>
        </table>


        
<div class="row mt-5 d-flex justify-content-center">
    <div class="col-lg-4 col-sm-5 ml-auto">
        <table class="table table-clear text-center">
            <tbody>
                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی واسڵکراو</strong>
                    </td>
                    <td class="right"><?=$sum_wasl?></td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی داشکاندن</strong>
                    </td>
                    <td class="right"><?=$sum_discount?></td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی ماوە</strong>
                    </td>
                    <td class="right">
                        <?php 
                            if ($numRecord==2) {
                                echo $cost_maway_peshw;
                            }else{
                                echo $cost_mawa;
                            }
                        ?>
                    </td>
                </tr>

                <tr class="bg-dark text-light">
                    <td class="left">
                    <strong>کۆی گشتی نرخ</strong>
                    </td>
                    <td class="right">
                    <strong><?=$sum_gshty?></strong>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

<?php } } ?> 
<!-- end customer info -->




<!-- spender  info -->

<?php if (isset($_POST['spender_info'])){  
    $user_id= secure($_POST['user_id']);

    if (isset($_POST['con_id'])) {
        $post_id= secure($_POST['con_id']);
        $items = show(" SELECT * FROM xarjy WHERE `xarj_by`='$user_id' AND id=$post_id ");
    }else{
        $items = show(" SELECT * FROM xarjy WHERE `xarj_by`='$user_id'");
    }

?>

<table  class="table  table-bordered  text-center" dir="rtl">
        <thead>
            <tr>
                <th>بەروار</th>
                <th>بۆچی خەرجکراوە</th>
                <th>پارەی وەرگیراو</th>
                <th>بڕی نرخی خەرجکراو</th>
                <th>نرخی ماوە</th>
                <th>شوێن</th>
            </tr>
        </thead>
        <tbody id="show_data">

<?php 
$sumGetPrice=0;
$sumPrice=0;
$sumMawa=0;

foreach ($items as $item) {
  $id = $item['id'];
  $name = $item['name_item'];
  $price = $item['price'];
  $place = $item['place'];
  $get_price = $item['get_price'];
  $xarj_by = $item['xarj_by'];
  $date = $item['date'];
  $price_mawa=$get_price - $price;

  $sumGetPrice+=$get_price;
  $sumPrice+=$price;
  $sumMawa+=$price_mawa;

?>
       <tr>
       <td><?=$date;?></td>
        <td style="max-width:320px;width:320px;overflow:hidden;word-wrap: break-word;overflow-wrap: break-word;white-space: pre-wrap;"><?=$name;?></td>
        <td><?=$get_price;?></td>
        <td><?=$price;?></td>
        <td><?=$price_mawa;?></td>
        <td><?=$place;?></td>

      </tr>
<?php
}
?>

<tr class="bg-dark text-white">
                    <td class="bg-dark text-white">کۆی گشتی</td>
                    <td></td>
                    <td><?=$sumGetPrice?></td>
                    <td><?=$sumPrice?></td>
                    <td><?=$sumMawa?></td>
                    <td></td>
                </tr>

        </tbody>
    </table>

<?php } ?> 
<!-- end spedner info -->




<!-- driver  info -->

<?php if (isset($_POST['driver_info'])){  
    $driver_id= secure($_POST['driver_id']);

    if (isset($_POST['work_id'])) {
        $work_id= secure($_POST['work_id']);
        $works=show("SELECT * FROM driver_work WHERE driver_id=$driver_id AND id=$work_id");
    }else{
        $works=show("SELECT * FROM driver_work WHERE driver_id=$driver_id");
    }
    $data = show(" SELECT * FROM drivers WHERE `id`=$driver_id");
    foreach ($data as $staff) {

    $name = $staff['name'];
    $phone = $staff['phone'];

    $currency_type=$staff['currency_type'];
    if ($currency_type=='dinar') {
      $currency_type='دینار';
    }
  
    if ($currency_type=='dollar') {
      $currency_type='دۆلار';
    }
  
    if ($currency_type=='tman') {
      $currency_type='تمەن';
    }


?>
<hr>
<div class="container mr-5 mb-3 mt-3">
    <h5> ناوی سایەق :  <?=$name?> ,   <span>ژمارەی مۆبایل  : <?=$phone?>  </span>  </h5>
</div>
<?php } ?>


<table class="table table-bordered text-center">
    <!-- <caption>List of users</caption> -->
    <thead>
        <tr>
            <th scope="col">ناونیشانی هێنانی بار</th>
            <th scope="col">ناونیشانی گەشتنی بار</th>
            <th scope="col"> ماوەی گەشتن</th>
            <th scope="col">نرخ</th>
            <th scope="col">پارەدان</th>
            <th>جۆری دراو</th>
            <th scope="col">تێبینی</th>


        </tr>
    </thead>
    <tbody id="show_data">
 
    <?php

foreach ($works as $work) {
$work_id=$work['id'];
    $from=$work['from'];
    $to=$work['to'];
    $time=$work['time'];
    $price=$work['price'];
    $money_owner=$work['money_owner'];
    $note=$work['note'];
    
?>
        <tr>
            <td><?=$from?></td>
            <td><?=$to?></td>
            <td><?=$time?></td>
            <td><?=$price?></td>
            <td><?=$money_owner?></td>
            <td><?=$currency_type;?></td>
            <td style="max-width:320px;width:320px;overflow:hidden;word-wrap: break-word;overflow-wrap: break-word;white-space: pre-wrap;"><?=$note;?></td>
          
        </tr>

        <?php } ?>

 
    </tbody>
</table>

<?php } ?> 
<!-- end driver info -->



<!-- staff  info -->

<?php if (isset($_POST['staff_info'])){  
    $staff_id= secure($_POST['staff_id']);
    if (isset($_POST['project_id'])) {
        $project_id= secure($_POST['project_id']);
        $projects=show("SELECT * FROM staff_work WHERE staff_id=$staff_id AND id=$project_id");
    }else{
        $projects=show("SELECT * FROM staff_work WHERE staff_id=$staff_id ");
    }

    $data = show(" SELECT * FROM staff WHERE `id`=$staff_id");
    foreach ($data as $staff) {

    $name = $staff['name'];
    $manager = $staff['manager'];
    $currency_type = $staff['currency_type'];

    if ($currency_type=='dinar') {
      $currency_type='دینار';
    }
  
    if ($currency_type=='dollar') {
      $currency_type='دۆلار';
    }
  
    if ($currency_type=='tman') {
      $currency_type='تمەن';
    }


?>
<hr>
<div class="container mr-5 mb-3 mt-3">
    <h5> ناوی ستاف :  <?=$name?> ,   <span>بەڕێوەبەر : <?=$manager?>  </span>  </h5>
</div>
<?php } ?>

<table class="table table-bordered text-center" style="zoom:80%">
    <!-- <caption>List of users</caption> -->
    <thead>
        <tr>
            <th scope="col">ناوی پڕۆژە</th>
            <th scope="col">بڕی نرخی پڕۆژە</th>
            <th scope="col">نرخی تاک</th>
            <th scope="col">کۆی گشتی نرخ</th>
            <th scope="col">پارەی وەرگیراو</th>
            <th scope="col">پارەی خەرجکراو</th>
            <th scope="col">پارەی ماوە</th>
            <th scope="col">ناونیشان</th>
            <th scope="col">خاوەن پڕۆژە</th>
            <th>جۆری دراو</th>
            <th scope="col">تێبینی</th>


        </tr>
    </thead>
    <tbody>
        <?php

foreach ($projects as $project) {
$project_id=$project['id'];
    $project_name=$project['name'];

    $cost_project=$project['cost_project'];
    $cost_fixed=$project['cost_fixed'];
    $cost_total=$project['cost_total'];

    $get_price=$project['get_price'];
    $xarjy=$project['xarjy'];
    $date=$project['date'];
    $address=$project['address'];
    $owner=$project['owner'];
    $note=$project['note'];
    $cost_mawa=$cost_total-$get_price;
?>
        <tr>
            <td><?=$project_name?></td>
            <td><?=$cost_project?></td>
            <td><?=$cost_fixed?></td>
            <td><?=$cost_total?></td>
            <td><?=$get_price?></td>
            <td><?=$xarjy?></td>
            <td><?=$cost_mawa?></td>
            <td><?=$address?></td>
            <td><?=$owner?></td>
            <td><?=$currency_type;?></td>
            <td style="max-width:320px;width:320px;overflow:hidden;word-wrap: break-word;overflow-wrap: break-word;white-space: pre-wrap;"><?=$note;?></td>

        </tr>

<?php } ?>

</tbody>
</table>

<?php } ?> 

<!-- end staff id -->

   </div>



   <!-- client monthlty and daily -->

    <?php if (isset($_POST['client_month'])){  
        $client_id=$_POST['client_id'];  

        if (isset($_POST['con_id'])) {
            $budget_id=$_POST['con_id'];
            $joins=show("SELECT * FROM budget WHERE clientid= $client_id AND id_budget=$budget_id");
        }else{
            $joins=show("SELECT * FROM budget WHERE clientid= $client_id");
        }

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
                $currency_type=$client['currency_type'];

                if ($currency_type=='dinar') {
                  $currency_type='دینار';
                }
              
                if ($currency_type=='dollar') {
                  $currency_type='دۆلار';
                }
              
                if ($currency_type=='tman') {
                  $currency_type='تمەن';
                }

                
                $get_teams=getdata("SELECT * FROM teams WHERE id= '$work_place'");

                $team_name='';
                if ($get_teams==null) {
                $team_name=$work_place;
                }else{
                $team_name='ستافی '.$get_teams['name'];
                } 
        ?>


<div class="row col-lg-10 col-12 m-auto">
        <div class="card border shadow-none m-auto " style="width: 60rem;border-radius:8px">
            <ul class="list-group list-group-flush text-center">
                <li class="list-group-item"><strong>ناو : </strong> <?=$name?></li>
                <li class="list-group-item"><strong>ژمارە مۆبایل : </strong> <?=$phone?></li>
                <li class="list-group-item"><strong>بەرواری دەستپێکردن : </strong><?=$date?></li>
                <li class="list-group-item"><strong>شوێنی کار : </strong><?=$team_name?></li>
                <li class="list-group-item"><strong>جۆری کارکردن : </strong>مانگانە</li>

            </ul>
        </div>
    </div>

<div class="row col-lg-8 col-12 m-auto p-4 table-responsive" style="zoom:90%">

<table class="table table-bordered text-center">
    <!-- <caption>List of users</caption> -->
    <thead>
        <tr>
            <th scope="col">بەروار</th>
            <th>جۆری دراو</th>
            <th scope="col">بڕی موچە</th>
            <th scope="col">بڕی پاداشت</th>
            <th scope="col">غەرامە</th>
            <th scope="col">کۆی گشتی مووچە</th>
        </tr>
    </thead>
    <tbody>
        <?php


foreach ($joins as $join) {
$budget_id=$join['id_budget'];
    $date_bud=$join['date'];
    $budget_amount=$join['budget_amount'];
    $punish=$join['punish'];
    $reward=$join['reward'];
?>
        <tr>
            <td><?=$date_bud?></td>
            <td><?=$currency_type?></td>
            <td><?=$budget_amount?></td>
            <td><?=$reward?></td>
            <td><?=$punish?></td>
            <td>
                <?php
 $budget=(int)$budget_amount+$reward;
 $budget=$budget-$punish;
 echo $budget;
  ?>
            </td>
        </tr>


        
        <?php } ?>
            </tbody>
        </table>

    </div>
        

       <?php } } } ?>





    <!-- client daily -->

    <?php if (isset($_POST['client_daily'])){  
        $client_id=$_POST['client_id'];  

        if (isset($_POST['con_id'])) {
            $budget_id=$_POST['con_id'];
            $joins=show("SELECT * FROM work_daily WHERE clientid= $client_id AND id_daily=$budget_id");
        }else{
            $joins=show("SELECT * FROM work_daily WHERE clientid= $client_id");
        }

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
                $bry_para = $client['bry_para'];
                $currency_type=$client['currency_type'];

                if ($currency_type=='dinar') {
                  $currency_type='دینار';
                }
              
                if ($currency_type=='dollar') {
                  $currency_type='دۆلار';
                }
              
                if ($currency_type=='tman') {
                  $currency_type='تمەن';
                }
            
                $get_teams=getdata("SELECT * FROM teams WHERE id= '$work_place'");

                $team_name='';
                if ($get_teams==null) {
                $team_name=$work_place;
                }else{
                $team_name='ستافی '.$get_teams['name'];
                } 
        ?>


<div class="row col-lg-10 col-12 m-auto">
        <div class="card border shadow-none m-auto " style="width: 60rem;border-radius:8px">
            <ul class="list-group list-group-flush text-center">
                <li class="list-group-item"><strong>ناو : </strong> <?=$name?></li>
                <li class="list-group-item"><strong>ژمارە مۆبایل : </strong> <?=$phone?></li>
                <li class="list-group-item"><strong>بەرواری دەستپێکردن : </strong><?=$date?></li>
                <li class="list-group-item"><strong>شوێنی کار : </strong><?=$team_name?></li>
                <li class="list-group-item"><strong>جۆری کارکردن : </strong>ڕۆژانە</li>
                <li class="list-group-item"><strong>بڕی پارەی کارکردنی ڕۆژانە : </strong><?=$bry_para?></li>

            </ul>
        </div>
    </div>


    <div class="row col-lg-9 col-12 m-auto p-4 table-responsive" style="zoom:75%"> 

<table class="table table-bordered text-center">
    <!-- <caption>List of users</caption> -->
    <thead>
        <tr>
                    <th scope="col">بەروار</th>
                    <th scope="col">سەعاتی کارکردن</th>
                    <th scope="col">نرخی سەعاتی کارکردن</th>
                    <th scope="col">سەعاتی زیادە</th>
                    <th scope="col">بڕی پاداشت</th>
                    <th scope="col">غەرامە</th>
                    <th scope="col">کۆی گشتی مووچە</th>
                    <th>جۆری دراو</th>
                    <th scope="col">ئیشی کردووە بۆ</th>
      
        </tr>
    </thead>
    <tbody>
    <?php
       
    
    foreach ($joins as $join) {
            $daily_id=$join['id_daily'];
            $work_hour=$join['work_hour'];
            $work_hour_amount=$join['work_hour_amount'];
            $work_extra=$join['work_extra'];
            $budget=$join['budget'];
            $punish=$join['punish'];
            $reward=$join['reward'];
            $date=$join['date'];
            $clientid=$join['clientid'];
            $work_for=$join['work_for'];
     ?>
                <tr>
                    <td><?=$date?></td>
                    <td><?=$work_hour?></td>
                    <td><?=$work_hour_amount?></td>
                    <td><?=$work_extra?></td>
                    <td><?=$reward?></td>
                    <td><?=$punish?></td>
                    <td><?=$budget?></td>
                    <td><?=$currency_type?></td>
                    <td><?=$work_for?></td>
                    
                 
                </tr>


        
        <?php } ?>
            </tbody>
        </table>

    </div>
        

       <?php } } } ?>
    
    
    

       <!-- refund -->

   <?php  
    if (isset($_POST['refund_info'])) {
        $user_id= secure($_POST['user_id']);

        if (isset($_POST['refund_id'])) {
            $refund_id= secure($_POST['refund_id']);
            $refunds=show("SELECT * FROM refund WHERE id=$refund_id AND dealer_id=$user_id");
        }else{
            $refunds=show("SELECT * FROM refund WHERE dealer_id=$user_id");        
        } 
        $dealer=getdata("SELECT * FROM dealers WHERE id=$user_id");
        $dealer_name=$dealer['name'];
        ?>

<div class="container-fluid mt-4 mb-3">
    <h6 class="text-secondary">ناوی فرۆشیار : <?=$dealer_name?></h6>
</div>

<div class="row col-lg-12 col-12 m-auto p-4 table-responsive">

<table class="table table-bordered text-center">
<thead>
    <tr>
      <th scope="col">بڕی پارەی واسڵکراو</th>
      <th scope="col">جۆری دراو</th>
      <th scope="col">جۆری واسڵکردن</th>
      <th scope="col">بەروار</th>
    </tr>
</thead>    

<tbody>
<?php
        foreach ($refunds as $refund) {
            $refund_id=$refund['id'];
            $dealer_id=$refund['dealer_id'];
            $price=$refund['price'];
            $date=$refund['date'];
            $refund_type=$refund['refund_type'];

            if ($refund_type=='cash') {$refund_type="کاش";}
            if ($refund_type=='7awala') {$refund_type="حەواڵە";}

            $dealer=getdata("SELECT * FROM dealers WHERE id=$dealer_id");
            $dealer_name=$dealer['name'];
            $currency_type = $dealer['currency_type']; 
     
            if ($currency_type=='dinar') {$currency_type='دینار';}
            if ($currency_type=='dollar') {$currency_type='دۆلار';}
            if ($currency_type=='tman') {$currency_type='تمەن';}
            

            ?>
  <tr>
        <td><?=$price;?></td>
        <td><?=$currency_type;?></td>
        <td><?=$refund_type;?></td>
        <td><?=$date;?></td>
  </tr>

  <?php }  ?>

</tbody>

</table>
</div>  
        
   <?php } ?>




   <!-- refund customer  -->

   <!-- refund -->

   <?php  
    if (isset($_POST['refund_customer_info'])) {
        $user_id= secure($_POST['user_id']);

        if (isset($_POST['refund_id'])) {
            $refund_id= secure($_POST['refund_id']);
            $refunds=show("SELECT * FROM refund_customer WHERE id=$refund_id AND customer_id=$user_id");
        }else{
            $refunds=show("SELECT * FROM refund_customer WHERE customer_id=$user_id");        
        } 
        $customer=getdata("SELECT * FROM customer WHERE id=$user_id");
        $customer_name=$customer['name'];
        ?>

<div class="container-fluid mt-4 mb-3">
    <h6 class="text-secondary">ناوی کڕیار : <?=$customer_name?></h6>
</div>

<div class="row col-lg-12 col-12 m-auto p-4 table-responsive">

<table class="table table-bordered text-center">
<thead>
    <tr>
      <th scope="col">بڕی پارەی واسڵکراو</th>
      <th scope="col">جۆری دراو</th>
      <th scope="col">جۆری واسڵکردن</th>
      <th scope="col">بەروار</th>
    </tr>
</thead>    

<tbody>
<?php
        foreach ($refunds as $refund) {
            $refund_id=$refund['id'];
            $customer_id=$refund['customer_id'];
            $price=$refund['price'];
            $date=$refund['date'];
            $refund_type=$refund['refund_type'];

            if ($refund_type=='cash') {$refund_type="کاش";}
            if ($refund_type=='7awala') {$refund_type="حەواڵە";}

            $customer=getdata("SELECT * FROM customer WHERE id=$customer_id");
            $customer_name=$customer['name'];
            $currency_type = $customer['currency_type']; 
     
            if ($currency_type=='dinar') {$currency_type='دینار';}
            if ($currency_type=='dollar') {$currency_type='دۆلار';}
            if ($currency_type=='tman') {$currency_type='تمەن';}
            

            ?>
  <tr>
        <td><?=$price;?></td>
        <td><?=$currency_type;?></td>
        <td><?=$refund_type;?></td>
        <td><?=$date;?></td>
  </tr>

  <?php }  ?>

</tbody>

</table>
</div>  
        
   <?php } ?>


       





    
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



