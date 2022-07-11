<?php require_once('header.php'); ?>

<?php 
$user_id=$_GET['id'];
$users = countdata(" SELECT * FROM customer WHERE `id`=$user_id");
$data = show(" SELECT * FROM customer WHERE `id`=$user_id");

if (empty($data)) {
  direct('index.php');
}else{   
    
    foreach ($data as $user) {
        $id = $user['id'];
        $name = $user['name'];
        $phone = $user['phone'];
        $address = $user['address'];
        $work_place = $user['work_place'];
        $note = $user['note'];
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
<form method="post" action="view_report.php">
    
<input type="hidden" name="user_id" value="<?=$user_id?>">

     <button type="submit" class="btn btn-dark" name="customer_info" style="border:none;" > <i class="fas fa-print"></i> پرنتکردن</button>

  </form> 
</div>

<div class="container-fluid mt-2 d-flex flex-wrap">

    <div class="row col-lg-6 col-12 m-auto">
        <div class="card border shadow-none m-auto " style="width: 25rem;border-radius:8px">
            <ul class="list-group list-group-flush text-center">
                <li class="list-group-item"><strong>ناو : </strong> <?=$name?></li>
                <li class="list-group-item"><strong>ژمارە مۆبایل : </strong> <?=$phone?></li>
                <li class="list-group-item"><strong>ناونیشان : </strong><?=$address?></li>
                <li class="list-group-item"><strong>شوێنی کار : </strong><?=$work_place?></li>
                <li class="list-group-item"><strong> تێبینی : </strong><?=$note?></li>

            </ul>
        </div>
    </div>



    
<div class="row col-lg-6 col-12 ">
        <div class="card border shadow-none m-auto " style="width: 25rem;border-radius:8px">
            <ul class="list-group list-group-flush text-center">
                <li class="list-group-item"><strong>کۆی نرخی  واسڵکراو : </strong> <?=$refund_p?></li>
                <li class="list-group-item"><strong>کۆی گشتی نرخی ماوەی ئێستا : </strong> <?=$cost_maway_peshw?></li>
 
                <li class="list-group-item">
                    <div class="d-flex justify-content-around mt-3">
                       <?php if ($cost_maway_peshw>0) {?>
                             <a data-toggle="modal" data-target="#add_refund<?=$user_id?>"   class="dropdown-item mx-2  btn btn-primary" style="background-color:#7868E6 !important;">گەڕانەوەی پارە</a>
                       <?php }?>

                       <?php if ($cost_maway_peshw<=0) {?>
                             <a data-toggle="modal" data-target="#refund_warning<?=$user_id?>"   class="dropdown-item mx-2  btn btn-primary" style="background-color:#7868E6 !important;">گەڕانەوەی پارە</a>
                       <?php }?> 

                        <a href="return_fund_customer.php?id=<?=$user_id?>" class="dropdown-item btn  btn-danger" style="background-color:#A6A9B6 !important;">بینین</a>
                    </div>
                </li>

            </ul>
        </div>
    </div>


<!-- add refund -->
<div class="modal fade" id="add_refund<?=$user_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content" style="background-color: white;border-radius: 15px;">
      <div class="modal-body text-center">
        <div class="container-fluid">
          <div class="row row-cols-1 row-cols-md-3">
            <div class="col-md-12 mb-3 mx-auto">
              <div class="h-100">
                <i class="fa fa-times-circle" style="float:left;color: black" data-dismiss="modal"></i>
                <div class="card-body">
                  <h5 class="container col-md-6 mt-3  text-center">
                     گەڕانەوەی پارە  
                  </h5>
                  <br>
                  <form class="mt-5" dir="rtl" method="POST" enctype="multipart/form-data">


                  <div class="form-group">
                     <input type="hidden" placeholder=" " name="id"
                    value="<?=$user_id;?>" 
                    class="form-control col-md-10 mx-auto">
                </div>


                    <div class="container d-flex justify-content-center mb-4">
                       <strong> کۆی گشتی نرخی ماوەی پێشوو </strong> &nbsp; : &nbsp; <span><?=$cost_maway_peshw?></span>
                    </div>

                    <div class="form-group">
                      <input type="text" placeholder="نرخی پارەی گێڕاوە" class="form-control col-md-10 mx-auto"
                        name="refund_price" required="">
                    </div>

                    <div class="form-group">
                    <select name="refund_type"  class="form-control col-md-10 mx-auto"> 
                        <option value="cash">کاش</option>
                        <option value="7awala">حەواڵە</option>
                    </select>
                    </div>

               
                    <button type="submit" name="add_refund" class="btn btn-sm btn-dark  s-20">
                      گەڕانەوەی پارە </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- if refund smaller and equal to 0 -->
<div class="modal fade" id="refund_warning<?=$user_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" style="background-color: white;border-radius: 15px;">
      <div class="modal-body text-center">
        <div class="container-fluid">
          <div class="row row-cols-1 row-cols-md-3">
            <div class="col-md-12 mb-3 mx-auto">
              <div class="h-100">
                <i class="fa fa-times-circle" style="float:left;color: black" data-dismiss="modal"></i>
                <div class="card-body mt-3">
                        <h5 class="text-danger">هیچ بڕە پارەیەکی ماوە بوونی نییە تا بیگەڕێنیتەوە !</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


   
</div>   


    <div class="container-fluid  mt-3 d-flex justify-content-around flex-wrap">
       
       <a href="customer_detail.php?id=<?=$user_id?>" class="btn btn-success shadow">زانیاری گشتی بهێنەوە</a>

       
       <div class="d-flex flex-wrap justify-content-center">

           <div class="form-group mx-3">
           <input type="date" 
            class="form-control  mx-auto" id="get_by_date" required>
           <input type="hidden" 
            class="form-control  mx-auto" id="user_id" value="<?=$user_id?>">
          </div>
          <p class="btn btn-dark shadow" id="btn_search">زانیاری بەپێی ڕۆژ بهێنەوە</p>

       </div>    
    
   </div>

   <div id="show_data">
     
    <div class="row col-lg-12 col-12 m-auto p-4 table-responsive">

        <table class="table table-bordered text-center" style="zoom:80%">
            <!-- <caption>List of users</caption> -->
            <thead>
                <tr>
                    <th scope="col">ناوی شتوومەک</th>
                    <th scope="col">بەروار</th>
                    <th scope="col">بڕ</th>
                    <th scope="col">جۆر</th>
                    <th scope="col">شوێن</th>
                    <th>جۆری دراو</th>
                    <th scope="col">نرخی فرۆشتن</th>
                    <th scope="col">نرخی واسڵکراو</th>
                    <th scope="col">نرخی داشکاندن</th>
                    <th scope="col">نرخی گشتی</th>
                    <th scope="col">نرخی ماوە</th>
                   
                    <th scope="col">شۆفێر</th>
                    <th scope="col"><i class="fas fa-print"></i></th>



                </tr>
            </thead>
            <tbody>
<?php 
$sum_wasl=0;
$sum_discount=0;
$sum_gshty=0;
$sum_mawa=0;
$sum_maway_peshw=0;

$sales = show(" SELECT * FROM sale WHERE customer_id=$user_id AND `status`=1");
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




//   $getdealer = getdata(" SELECT * FROM customer WHERE id='$customer_id' ");
//   $dealer_name = $getdealer['name'];



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

                    <td> 
                <form method="post" action="view_report.php">
                    <input type="hidden" name="user_id" value="<?=$user_id?>">
                    <input type="hidden" name="con_id" value="<?=$id?>">

                <button type="submit" name="customer_info" style="border:none;background:none" > <i class="fas fa-print"></i> </button>

                </form>    
            
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
                    <td></td>

                </tr> -->
            </tbody>
        </table>

    </div>




    <div class="row  d-flex justify-content-center">
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
                    <td class="right"><?=$cost_maway_peshw?></td>
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


</div>





    
<?php } } ?>


<?php require_once('footer.php'); ?>


<?php 

if (isset($_SESSION["add_success"])) {
    msg('سەرکەتووبوو','سەرکەوتووانە  بڕی پارەی دیاریکراو گەڕێنرایەوە ','success');
     unset($_SESSION["add_success"]);
 }


 if (post('add_refund')) {
    $refund_price = secure($_POST['refund_price']);
    $id = secure($_POST['id']);
    $refund_type = secure($_POST['refund_type']);
    $date=date("Y-m-d");

    execute("INSERT INTO refund_customer (`customer_id`,`price`,`refund_type`,`date`) 
    VALUES('$id','$refund_price','$refund_type','$date')");
    $_SESSION["add_success"] = "";
    $loc="customer_detail.php?id=".$id;
    direct($loc);
  }


?>


<script>
  $(document).ready(function () {
 
    // $('.dateFilter').datepicker({
    //   dateFormat: "yy-mm-dd"
    // });
 
    $('#btn_search').click(function () {
      var date = $('#get_by_date').val();
      var user_id = $('#user_id').val();
      if (date != '') {
        $.ajax({
          url: "get_by_date.php",
          method: "POST",
          data: { date_customer: date,user_id: user_id},
          success: function (data) {
            $('#show_data').html(data);
          }
        });
      }
      else {
        alert("Please Select the Date");
      }
    });
  });
</script>
