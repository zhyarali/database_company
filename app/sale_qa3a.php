<?php require_once('header.php'); ?>


<div class="container-fluid mt-4">
<a href="sale.php" class="btn btn-sm btn-info shadow" >
 <span class="fa fa-arrow-right"></span>
 گەڕانەوە
  </a>
</div>


<div class="container d-flex justify-content-around mt-2 flex-wrap">
<?php if ($is_admin==1) {?>
    <a href="sale_dana.php" style="font-size:16px" class="btn btn-success "><i
            class="fas fa-dollar-sign "></i>  فرۆشتن بە دانە</a>
<?php } ?>
            <a href="sale_meter.php" style="font-size:16px;background:#7868E6 !important;" class="btn btn-danger"> فرۆشتن  بەمەتر</a>

    <!-- <div onclick="window.print()" class="btn  btn-dark "><i class="fas fa-print" style="font-size:18px"></i> پرنتکردن
    </div> -->
</div>






    <?php
 if (isset($_SESSION["edit_success"])) {
    msg('سەرکەتووبوو','سەرکەوتووانە  گۆڕانکاری لەزانیارییەکان کرا ','success');
     unset($_SESSION["edit_success"]);
 }

 if (isset($_SESSION["add_success"])) {
    msg('سەرکەتووبوو','سەرکەوتووانە زانیارییەکان تۆمارکرا ','success');
     unset($_SESSION["add_success"]);
 }

 if (isset($_SESSION["delete"])) {
    msg('ئاگاداری','سەرکەوتووانە سڕایەوە ','warning');
    unset($_SESSION["delete"]);
 }

 if (isset($_SESSION["update_return"])) {
    msg('سەرکەتووبوو','بە سەرکەوتوویی ئەم فرۆشتنە گەڕێندرایەوە','success');
     unset($_SESSION["update_return"]);
  }

 
 ?>




<?php 

if (post('return_sale')) {
    $id = secure($_POST['id']);
    execute("UPDATE sale SET `status`='-1' WHERE id='$id' ");
    $_SESSION["update_return"] = "";
    direct('sale_qa3a.php');
  }

if (post('edit')) {
  $id = secure($_POST['id']);
  $customer_id = secure($_POST['customer_id']);
  $name_product = secure($_POST['name_product']);
  $num = secure($_POST['num']);
  $cost_t = secure($_POST['cost_t']);
  $type = secure($_POST['type']);
  $place = secure($_POST['place']);
  $cost_wasl = secure($_POST['cost_wasl']);
  $note = secure($_POST['note']);
  $discount = secure($_POST['discount']);
  $unit = secure($_POST['unit']);
  $cost_co = $cost_t*$num;
  $cost_co=$cost_co - $discount;
  $cost_mawa =$cost_co-$cost_wasl;

$getoldqty = getdata(" SELECT * FROM  sale WHERE id='$id' ");
$oldnum = $getoldqty['num'];
$gettotalbuy = show("  SELECT sum(num) as 'totalbuy' FROM  buy WHERE name_product='$name_product' AND type='$type' AND  `status`='1' ");
$totalbuy = $gettotalbuy[0]['totalbuy']; 
$gettotalsale = show("  SELECT sum(num) as 'totalsale' FROM  sale WHERE name_product='$name_product' AND type='$type' AND `status`='1' ");
$totalsale = $gettotalsale[0]['totalsale']; 
$remainqty = $totalbuy-$totalsale;
// zhika lussssssssssssssss Ufffffffffffffffffffffffffffffffffff
if($num > ($remainqty+$oldnum)) {
    msg('ئاگاداربە !','ئەوەندە بڕ لەم کاڵەیە بەردەست نیە ','warning');
}
else {

  $sql=execute("UPDATE  `sale` SET `customer_id`='$customer_id',`name_product`='$name_product',`num`='$num',`cost_t`='$cost_t',`cost_co`='$cost_co',`type`='$type',`place`='$place',`cost_wasl`='$cost_wasl',`note`='$note',`discount`='$discount',`unit`='$unit'  WHERE id='$id' ");
  $_SESSION["edit_success"] = "";
  direct('sale_qa3a.php');

}
}

if (post('del')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM `sale` WHERE id = '$id'");
    $_SESSION["delete"] = "";
    direct('sale_qa3a.php');
}



if (post('add')) {
    $customer_id = secure($_POST['customer_id']);
    $name_product = secure($_POST['name_product']);
    $num = secure($_POST['num']);
    $cost_t = secure($_POST['cost_t']);
    $type = secure($_POST['type']);
    $unit = secure($_POST['unit']);
    $place = secure($_POST['place']);
    $cost_wasl = secure($_POST['cost_wasl']);
    $note = secure($_POST['note']);
    $date=date("Y-m-d");
    $discount = secure($_POST['discount']);

     $cost_co = $cost_t*$num;
     $cost_co=$cost_co - $discount;


     
$gettotalbuy = show("  SELECT sum(num) as 'totalbuy' FROM  buy WHERE name_product='$name_product' AND type='$type' AND  `status`='1' ");
$totalbuy = $gettotalbuy[0]['totalbuy']; 
   
$gettotalsale = show("  SELECT sum(num) as 'totalsale' FROM  sale WHERE name_product='$name_product' AND type='$type' AND `status`='1' ");
$totalsale = $gettotalsale[0]['totalsale']; 
$remainqty = $totalbuy-$totalsale;
// zhika lus
if($num > $remainqty) {
    msg('ئاگاداربە !','ئەوەندە بڕ لەم کاڵەیە بەردەست نیە ','warning');
}
else {
$sql=execute("INSERT INTO `sale` (`customer_id`,`cost_t`,`cost_co`,`num`,`type`,`cost_wasl`,`date`,`discount`,`unit`,`name_product`,`place`,`sale_type`,`status`,`note`) VALUES('$customer_id','$cost_t','$cost_co','$num','$type','$cost_wasl','$date','$discount','$unit','$name_product','$place','qa3a','1','$note') ");
$_SESSION["add_success"] = "";
direct('sale_qa3a.php');
}
}
?>
    <?php require_once('footer.php'); ?>