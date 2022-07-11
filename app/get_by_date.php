<?php

ob_start();
session_start();
require_once('../server/helper.php') ;
$user_id = $_SESSION['adm_id'];
$getuser = getdata(" SELECT * FROM admin WHERE id='$user_id'");
   $is_admin = $getuser['type'];
// get dealer info
if (isset($_POST['date'])){ 
    $user_id= $_POST['user_id'];

$users = countdata(" SELECT * FROM dealers WHERE `id`=$user_id");
$data = show(" SELECT * FROM dealers WHERE `id`=$user_id");

$getcost =getdata(" SELECT sum(cost_co) as cost_total,sum(cost_wasl) as cost_wasl FROM buy WHERE dealer_id=$user_id AND `status`=1");

$cost_maway_peshw=$getcost['cost_total']-$getcost['cost_wasl'];
    
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

        </tr>
    </thead>
    <tbody>
<?php 
$by_date=$_POST['date'];
$sum_wasl=0;
$sum_discount=0;
$sum_gshty=0;
$sum_mawa=0;
$sum_maway_peshw=0;

$buys = show(" SELECT * FROM buy WHERE  `status`=1 AND Date(date)='$by_date' ");
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

            

<?php } } ?>


<!-- customer detial -->


<?php if (isset($_POST['date_customer'])){ 
    $user_id = $_POST['user_id'];    
    $users = countdata(" SELECT * FROM customer WHERE `id`=$user_id");
    $data = show(" SELECT * FROM customer WHERE `id`=$user_id");
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
$by_date=$_POST['date_customer'];
$sum_wasl=0;
$sum_discount=0;
$sum_gshty=0;
$sum_mawa=0;
$sum_maway_peshw=0;

$sales = show(" SELECT * FROM sale WHERE customer_id=$user_id AND `status`=1 AND Date(date)='$by_date'");
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

<?php } } ?>





<!-- spender -->
<?php if (isset($_POST['date_spender'])){ ?>
<?php 
$id=$_POST['spender_id'];
$date=$_POST['date_spender'];

$items = show(" SELECT * FROM xarjy WHERE Date(date)='$date' AND `xarj_by`='$id'");
foreach ($items as $item) {
  $id = $item['id'];
  $name = $item['name_item'];
  $price = $item['price'];
  $place = $item['place'];
  $get_price = $item['get_price'];
  $xarj_by = $item['xarj_by'];
  $date = $item['date'];
  $price_mawa=$get_price - $price;


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
<?php } ?>

<!-- end spender -->





<!--  driver work -->


<?php if (isset($_POST['date_driver'])){ 
$id=$_POST['driver_id'];
$date=$_POST['date_driver'];   

$driver_info = getdata(" SELECT * FROM drivers WHERE `id`=$id");

$currency_type=$driver_info['currency_type'];
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

<?php
$works=show("SELECT * FROM driver_work WHERE Date(date)='$date' AND driver_id='$id' ");

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
            <td class="d-flex justify-content-around">

            <?php if ($is_admin==1) {?>
                <i class="fa fa-edit  s-20 cursor" style="color:#14cd7c" data-toggle="modal"
                    data-target="#edit_work<?php echo $work['id'] ?>"></i>
                <i class="fa fa-trash text-dark s-20 cursor" data-toggle="modal"
                    data-target="#delete_work<?php echo $work['id'] ?>"></i>
           <?php } ?>

                    <form method="post" action="view_report.php">
                    <input type="hidden" name="driver_id" value="<?=$id?>">
                    <input type="hidden" name="work_id" value="<?=$work_id?>">

                <button type="submit" name="driver_info" style="border:none;background:none" > <i style="color:#7868E6" class="fas fa-print s-20"></i> </button>

                </form>

            </td>
        </tr>


        <!-- edit modal -->
        <div class="modal fade" id="edit_work<?php echo $work['id'] ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content" style="background-color: white;border-radius: 15px;">
                    <div class="modal-body text-right">
                        <div class="container-fluid">
                            <div class="row row-cols-1 row-cols-md-3">
                                <div class="col-md-12 mb-3 mx-auto">
                                    <div class="h-100">
                                        <i class="fa fa-times-circle" style="float:left;color: black"
                                            data-dismiss="modal"></i>
                                        <div class="card-body">
                                            <h5 class="container col-md-6 mt-3  text-center">
                                                گۆڕانکاری بکە لە زانیارییەکان
                                            </h5>
                                            <br>
        <form method="POST">

                <div class="form-group">
                  <input type="hidden" placeholder="  ناو  " name="id" value="<?=$work_id;?>" class="form-control col-md-10 mx-auto">
                  </div> 
                                     
                 <label>ناونیشانی هێنانی بار</label>
                <div class="form-group">
                <input type="text" value="<?=$from?>" name="from"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ناونیشانی گەشتنی بار</label>
                <div class="form-group">
                <input type="text" value="<?=$to?>" name="to"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ماوەی گەشتن بە کات</label>
                <div class="form-group">
                <input type="number" value="<?=$time?>"  name="time"  class="form-control col-md-10 mx-auto">
                </div>
                
                <label>نرخی بار</label>
                <div class="form-group">
                <input type="number" value="<?=$price?>" name="price"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>پارەدانەکە لەسەر کێبووە</label>
                <div class="form-group">
                    <select name="money_owner"  class="form-control col-md-10 mx-auto">
                        <option <?php if($money_owner=="کۆمپانیا") echo 'selected="selected"'; ?> value="کۆمپانیا">کۆمپانیا</option>
                        <option <?php if($money_owner=="ستاف") echo 'selected="selected"'; ?> value="ستاف">ستاف</option>ستاف
                        <option <?php if($money_owner=="شۆفێر") echo 'selected="selected"'; ?> value="شۆفێر">شۆفێر</option>
                        <option <?php if($money_owner=="داواکار") echo 'selected="selected"'; ?> value="داواکار">داواکار</option>
                    </select>
                </div> 

                <label>تێبینی</label>
                <div class="form-group">
                <textarea id="my-textarea" class="form-control" name="note" rows="4"><?=$note?></textarea>
                </div> 


                                   

                                                <button type="submit" name="edit_work"
                                                    class="btn btn-dark btn-block"> نوێکردنەوەی زانیارییەکان
                                                </button>
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




        <!-- delete modal -->
        <div class="modal fade" id="delete_work<?php echo $work['id'] ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal" role="document">
                <div class="modal-content" style="background-color: white;border-radius: 15px;">
                    <div class="modal-body text-center">
                        <div class="container-fluid">
                            <div class="row row-cols-1 row-cols-md-3">
                                <div class="col-md-12 mb-3 mx-auto">
                                    <div class="h-100">
                                        <i class="fa fa-times-circle" style="float:left;color: black"
                                            data-dismiss="modal"></i>
                                        <div class="card-body">
                                            <h5 class="container col-md-10 mt-3  text-center">
                                                دڵنیای لە سڕینەوەی ئەم کڕینە لەناو سیستەمەکەت ؟
                                            </h5>
                                            <br>
                                            <form dir="rtl" method="POST">
                                                <div class="form-group">
                                                    <input type="hidden" placeholder="  ناو  " name="id"
                                                        value="<?=$work_id;?>"
                                                        class="form-control col-md-10 mx-auto">
                                                </div>
                                                <!-- <div class="form-group">
      <input type="text" placeholder="  ناو  " name="name" value="<?=$name;?> " class="form-control col-md-10 mx-auto">
    </div>   -->
                                                <button type="submit" name="delete_work"
                                                    class="btn btn-danger btn-block"> سڕینەوە </button>
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

        <!-- end delete -->


<?php } ?>



<?php } ?>
