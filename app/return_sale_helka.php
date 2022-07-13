<?php require_once('header.php'); ?>


<div class="container-fluid mt-4">
<a href="return_sale.php" class="btn btn-sm btn-info shadow" >
 <span class="fa fa-arrow-right"></span>
 گەڕانەوە
  </a>
</div>

<div class="container d-flex justify-content-around mt-2 flex-wrap">
    <a class="btn btn-primary text-light" style="background-color:#7868E6 !important;font-size:16px">گەڕانەوەی فرۆشتنی  هێلکە</a>
</div>




<div class="container-fluid mt-2">
<div class="row m-auto" >

<div class="col-md-12">
  <div class="table-responsive">
<table id="example" class="table  table-striped table-bordered  text-center" dir="rtl" style="zoom:85%">
        <thead  style="background-color: #0a0327;color: white">
            <tr>
                <th> ناوی کڕیار</th>
                <th> ژمارە    </th>
                <th> نرخی فرۆشتن    </th>
                <th> نرخی داشکاندن    </th>
                <th> جۆر    </th>
                <th> نرخی واسڵکراو    </th>
                <th> نرخی ماوە    </th>
                <th> نرخی گشتی      </th>
                <th>جۆری دراو</th>
                <th> بەروار    </th>
                <th>تێبینی</th>
                <?php if ($is_admin==1) {?><th> Action</th><?php } ?>
            </tr>
        </thead>
        <tbody>
<?php 
$buy_helka = show(" SELECT * FROM sale WHERE sale_type='helka' AND `status`='-1' ");
foreach ($buy_helka as $helka) {
  $id = $helka['id'];
  $customer_id = $helka['customer_id'];
  $name_product = $helka['name_product'];
  $num = $helka['num'];
  $cost_t = $helka['cost_t'];
  $cost_co = $helka['cost_co'];
  $type = $helka['type'];
  $cost_wasl = $helka['cost_wasl'];

  $cost_mawa = $cost_co-$cost_wasl;
  $discount = $helka['discount'];
  $date = $helka['date'];
  $note = $helka['note'];
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
        <td><a href="customer_detail.php?id=<?=$customer_id;?>"><?=$customer_name;?></a></td>
        <td><?=$num;?></td>
        <td><?=$cost_t;?></td>
        <td><?=$discount;?></td>
        <td><?=$type;?></td>
        <td><?=$cost_wasl;?></td>
        <td><?=$cost_mawa;?></td>
        <td><?=$cost_co;?></td>
        <td><?=$currency_type;?></td>
        <td><?=$date;?></td>
        <td style="max-width:220px;width:220px;overflow:hidden;word-wrap: break-word;overflow-wrap: break-word;white-space: pre-wrap;"><?=$note;?></td>
        <?php if ($is_admin==1) {?>
        <td>
        <i class="fa fa-trash s-20 cursor" data-toggle="modal" data-target="#delete<?php echo $helka['id'] ?>"></i>        
        <i class="fa fa-edit s-20 cursor" data-toggle="modal" data-target="#edit<?php echo $helka['id'] ?>" ></i>        
        <!-- <i class="fa fa-print s-20 cursor" data-toggle="modal" data-target="#print" ></i>            -->
        </td>
        <?php } ?>
      </tr>
      
<!-- delete modal -->
  <div class="modal fade" id="delete<?php echo $helka['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-center">
         <div class="container-fluid">
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class="container col-md-6 mt-3  text-center">
        دڵنیای لە سڕینەوەی ئەم فرۆشتنە لەناو سیستەمەکەت ؟
        </h5>
        <br>
         <form dir="rtl" method="POST">
         <div class="form-group">
              <input type="hidden" placeholder="  ناو  " name="id" value="<?=$id;?> " class="form-control col-md-10 mx-auto">
            </div> 
            <!-- <div class="form-group">
              <input type="text" placeholder="  ناو  " name="name" value="<?=$name;?> " class="form-control col-md-10 mx-auto">
            </div>   -->
    <button type="submit" name="del" class="btn btn-danger btn-block">  سڕینەوە  </button>
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

<!-- edit modal -->
<div class="modal fade" id="edit<?php echo $helka['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body ">
         <div class="container-fluid">
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class="container col-md-6 mt-3  text-center">
      گۆڕانکاری بکە لە زانیارییەکانی فرۆشتن 
        </h5>
        <br>
    <form method="POST">
        <div class="form-group">
              <input type="hidden" placeholder="ID " name="id" value="<?=$id;?> " class="form-control col-md-10 mx-auto">
            </div> 

                                    <label>ناوی کڕیار</label>
                                      <div class="form-group ">
                                            <select name="customer_id"  class="form-control col-md-10 mx-auto">
                                                <?php
                                                  $getcustomer = show(" SELECT * FROM customer");
                                                  foreach ($getcustomer as $customer) { ?>
                                                
                                                <option <?php if($customer_id==$customer['id']) echo 'selected="selected"'; ?>  value="<?=$customer['id']?>"> <?=$customer['name']?> </option>
                                               <?php   } ?>
                                            </select>
                                        </div> 

                    <label>جۆری هێلکە</label>   
                    <div class="form-group">
                      <input type="text" value="<?=$type?>"  class="form-control col-md-10 mx-auto"
                        name="type" required="">
                    </div>


                    <input name="name_product" type="hidden" value="<?=$name_product;?>" required>


                    <div class="form-group">
                      <select name="unit"  class="form-control col-md-10 mx-auto">
                          <option value="دانە">دانە</option>
                      </select>
                    </div>

                    <label>بڕ  </label>
                    <div class="form-group">
                      <input type="text" value="<?=$num?>" class="form-control col-md-10 mx-auto" name="num"
                        required="">
                    </div>

                    <label>نرخی فرۆشتنی تاک</label>
                    <div class="form-group">
                      <input type="text" value="<?=$cost_t?>" class="form-control col-md-10 mx-auto"
                        name="cost_t" required="">
                    </div>

                    <label>بڕی واسڵ</label>
                    <div class="form-group">
                      <input type="text" value="<?=$cost_wasl?>" class="form-control col-md-10 mx-auto"
                        name="cost_wasl" required="">
                    </div>


                    <label>نرخی داشکاندن</label>
                    <div class="form-group">
                      <input type="text" value="<?=$discount?>" class="form-control col-md-10 mx-auto"
                        name="discount" required="">
                    </div>

                   
                    <label>تێبینی</label>
                  <div class="form-group">
                    <textarea id="my-textarea" class="form-control" name="note" rows="4"><?=$note?></textarea>
                  </div>
              
    <button type="submit" name="edit" class="btn btn-dark btn-block">  نوێکردنەوەی فرۆشتن  </button>
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

  
<?php
}
?>
        </tbody>
    </table>
    </div>

 </div>

</div>




   <!-- add krdn -->



<!-- Add helka modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" style="background-color: white;border-radius: 15px;">
      <div class="modal-body text-right">
        <div class="container-fluid">
          <div class="row row-cols-1 row-cols-md-3">
            <div class="col-md-12 mb-3 mx-auto">
              <div class="h-100">
                <i class="fa fa-times-circle" style="float:left;color: black" data-dismiss="modal"></i>
                <div class="card-body">
                  <h5 class="container col-md-6 mt-3  text-center">
                    زیادکردنی گەڕانەوەی فرۆشتنی هێلکە
                  </h5>
                  <br>
                  <form class="mt-5" dir="rtl" method="POST" enctype="multipart/form-data">

                                       <label>ناوی کڕیار</label>
                                      <div class="form-group ">
                                            <select name="customer_id"  class="form-control col-md-10 mx-auto">
                                                <?php
                                                  $getcustomer = show(" SELECT * FROM customer");
                                                  foreach ($getcustomer as $customer) { ?>
                                                
                                                <option  value="<?=$customer['id']?>"> <?=$customer['name']?> </option>
                                               <?php   } ?>
                                            </select>
                                        </div> 

                    <div class="form-group">
                      <input type="text" placeholder="   جۆری هێلکە  " class="form-control col-md-10 mx-auto"
                        name="type" required="">
                    </div>

                    <input name="name_product" type="hidden" value="هێلکە" required>


                    <div class="form-group">
                      <select name="unit"  class="form-control col-md-10 mx-auto">
                          <option value="دانە">دانە</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <input type="text" placeholder=" بڕ " class="form-control col-md-10 mx-auto" name="num"
                        required="">
                    </div>

                    <div class="form-group">
                      <input type="text" placeholder="  نرخی فرۆشتنی تاک   " class="form-control col-md-10 mx-auto"
                        name="cost_t" required="">
                    </div>

                  
                    <div class="form-group">
                      <input type="text" placeholder=" بڕی واسڵ " class="form-control col-md-10 mx-auto"
                        name="cost_wasl" required="">
                    </div>



                    <div class="form-group">
                      <input type="text" placeholder="  نرخی داشکاندن " class="form-control col-md-10 mx-auto"
                        name="discount" required="">
                    </div>

                    <div class="form-group">
                        <textarea id="my-textarea" placeholder="تێبینی بنووسە" class="form-control" name="note" rows="4"></textarea>
                      </div>
                  

                    <br>
                    <button type="submit" name="add" class="btn btn-success btn-block btn-sm s-20">
                      <i class="fal fa-plus s-20"></i>
                     گەڕانەوەی فرۆشتن </button>
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

 
 ?>




<?php 

if (post('edit')) {
  $id = secure($_POST['id']);
  $customer_id = secure($_POST['customer_id']);
  $name_product = secure($_POST['name_product']);
  $type = secure($_POST['type']);
  $num = secure($_POST['num']);
  $cost_t = secure($_POST['cost_t']);
  $note = secure($_POST['note']);
  $cost_wasl = secure($_POST['cost_wasl']);
  $discount = secure($_POST['discount']);
  $unit = secure($_POST['unit']); 

   $cost_co = $cost_t*$num;
   $cost_co=$cost_co-$discount;

   $getoldqty = getdata(" SELECT * FROM  sale WHERE id='$id' ");
   $oldnum = $getoldqty['num'];
   
        $gettotalbuy = show("  SELECT sum(num) as 'totalbuy' FROM  buy WHERE name_product='$name_product' AND type='$type' AND  `status`='1' ");
        $totalbuy = $gettotalbuy[0]['totalbuy']; 
      
        $gettotalsale = show("  SELECT sum(num) as 'totalsale' FROM  sale WHERE name_product='$name_product' AND type='$type' AND `status`='1' ");
        $totalsale = $gettotalsale[0]['totalsale']; 
        $remainqty = $totalbuy-$totalsale;
   // zhika lussssssssssssssss
   if($num > ($remainqty+$oldnum)) {
   msg('ئاگاداربە !','ئەوەندە بڕ لەم کاڵەیە بەردەست نیە ','warning');
   }
   else {

  $sql=execute("UPDATE `sale` SET `customer_id`='$customer_id',`cost_t`='$cost_t',`cost_co`='$cost_co',`num`='$num',`type`='$type',`cost_wasl`='$cost_wasl',`note`='$note',`discount`='$discount' ,`unit`='$unit' WHERE `id`='$id' ");
    $_SESSION["edit_success"] = "";
    direct('return_sale_helka.php');

}
}

if (post('del')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM `sale` WHERE id = '$id'");
    $_SESSION["delete"] = "";
    direct('return_sale_helka.php');
}



// add

if (post('add')) {
    $customer_id = secure($_POST['customer_id']);
    $name_product = secure($_POST['name_product']);
    $type = secure($_POST['type']);
    $num = secure($_POST['num']);
    $cost_t = secure($_POST['cost_t']);
    $note = secure($_POST['note']);
    $date=date("Y-m-d");
    $cost_wasl = secure($_POST['cost_wasl']);
    $discount = secure($_POST['discount']);
    $unit = secure($_POST['unit']); 

     $cost_co = $cost_t*$num;
     $cost_co=$cost_co-$discount;

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

    $sql=execute("INSERT INTO `sale` (`customer_id`,`cost_t`,`cost_co`,`num`,`type`,`cost_wasl`,`date`,`discount`,`unit`,`name_product`,`sale_type`,`status`,`note`) VALUES('$customer_id','$cost_t','$cost_co','$num','$type','$cost_wasl','$date','$discount','$unit','هێلکە','helka','-1','$note') ");
    $_SESSION["add_success"] = "";
    direct('return_sale_helka.php');
}
}

?>
<?php require_once('footer.php'); ?>

