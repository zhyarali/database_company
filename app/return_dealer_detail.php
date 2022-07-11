<?php require_once('header.php'); ?>

<?php 

$user_id=$_GET['id'];

$users = countdata(" SELECT * FROM dealers WHERE `id`=$user_id");

$num_of_return_buy= countdata("SELECT * FROM buy WHERE dealer_id=$user_id AND `status`=-1");

$data = show(" SELECT * FROM dealers WHERE `id`=$user_id");

$getcost =getdata(" SELECT sum(cost_co) as cost_total,sum(cost_wasl) as cost_wasl FROM buy WHERE dealer_id=$user_id AND `status`=1");

$cost_maway_peshw=$getcost['cost_total']-$getcost['cost_wasl'];



if (empty($data)) {
  direct('index.php');
}else{   
    
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
    <button type="submit" class="btn btn-dark" name="dealer_info" style="border:none;" > <i class="fas fa-print"></i> پرنتکردن</button>
</form> 
</div>


<div class="container-fluid d-flex justify-content-between">

<div class="row col-lg-6 col-12 ">
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

                    <?php if ($is_admin==1) {?>
                       <?php if ($cost_maway_peshw>0) {?>
                             <a data-toggle="modal" data-target="#add_refund<?=$user_id?>"   class="dropdown-item mx-2  btn btn-primary" style="background-color:#7868E6 !important;">گەڕانەوەی پارە</a>
                       <?php }?>

                       <?php if ($cost_maway_peshw<=0) {?>
                             <a data-toggle="modal" data-target="#refund_warning<?=$user_id?>"   class="dropdown-item mx-2  btn btn-primary" style="background-color:#7868E6 !important;">گەڕانەوەی پارە</a>
                       <?php }?> 
                    <?php } ?>   

                        <a href="return_fund.php?id=<?=$user_id?>" class="dropdown-item btn  btn-danger" style="background-color:#A6A9B6 !important;">بینین</a>
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

<div class="container-fluid mt-2 d-flex flex-wrap">

    <!-- <div onclick="window.print()"><i class="fas fa-print fa-2x"></i> پرنتکردن</div> -->

    <div class="container-fluid  mt-3 d-flex justify-content-around flex-wrap">
       
        <a href="dealer_detail.php?id=<?=$user_id?>" class="btn btn-success shadow">زانیاری گشتی بهێنەوە</a>

        
        <div class="d-flex flex-wrap justify-content-center">

            <div class="form-group mx-3">
            <input type="date" 
             class="form-control  mx-auto" id="get_by_date" required>
            <input type="hidden" 
             class="form-control mx-auto" value="<?=$user_id?>" id="user_id">
           </div>
           <p class="btn btn-dark shadow" id="btn_search">زانیاری بەپێی ڕۆژ بهێنەوە</p>


           <button style="background-color:#7868E6 !important;outline:none;shadow:none" data-bs-toggle="modal" href="#exampleModalToggle" role="button" type="button" class="btn btn-primary mx-3 border-0  position-relative">
           گەڕاوەی کڕین
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?php echo $num_of_return_buy;?>
            </span>
            </button>
        </div>    
     
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
                    <th scope="col">جۆری دراو</th>
                    <th scope="col">نرخی تاک</th>
                    <th scope="col">نرخی واسڵکراو</th>
                    <th scope="col">نرخی داشکاندن</th>
                    <th scope="col">نرخی گشتی</th>
                    <th scope="col">نرخی ماوە</th>                   
                    <th scope="col">شۆفێر</th>
                    <th scope="col"><i class="fas fa-print"></i></th>
                    <th scope="col">گەڕاندنەوە</th>

                </tr>
            </thead>
            <tbody>
<?php 
$sum_wasl=0;
$sum_discount=0;
$sum_gshty=0;
$sum_mawa=0;
$sum_maway_peshw=0;

$buys = show(" SELECT * FROM buy WHERE dealer_id=$user_id AND `status`=1");
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
?>
                <tr>
                    <td>
                    <?php 
                    $buy_type_name='';
                    if ($buy_type=="qa3a") {
                        $buy_type_name='ئەشیای ناو قاعە';
                        echo $buy_type_name."<br>";
                        echo $product_name;}

                    if ($buy_type=="asn") {echo 'ئاسن';}

                    if ($buy_type=="helka") {echo 'هێلکە';}

                    if ($buy_type=="3alaf") {echo 'عەلەف';}
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
                <td> 
                <form method="post" action="view_report.php">
                    <input type="hidden" name="user_id" value="<?=$user_id?>">
                    <input type="hidden" name="con_id" value="<?=$id?>">
                    <button type="submit" name="dealer_info" style="border:none;background:none" > <i class="fas fa-print"></i> </button>
                </form>    
               </td>
                <td> 
                <form method="post" action="dealer_detail.php">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <button type="submit" name="return_buy" style="border:none;background:none" > <i class="fas fa-sync"></i> </button>
                </form>    
               </td>
                </tr>
                <?php } ?>
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


<!-- return -->


<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="exampleModalLabel">گەڕانەوەی کڕین</h4>
        <button type="button" class="btn btn-secondary " data-bs-dismiss="modal" aria-label="Close">داخستن</button>
        
      </div>
      <div class="modal-body">
        Show a second modal and hide this one with the button below.
      </div>

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

    execute("INSERT INTO refund (`dealer_id`,`price`,`refund_type`,`date`) 
    VALUES('$id','$refund_price','$refund_type','$date')");
    $_SESSION["add_success"] = "";
    $loc="dealer_detail.php?id=".$id;
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
          data: { date: date,user_id: user_id},
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
