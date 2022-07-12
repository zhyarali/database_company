<?php require_once('header.php'); ?>


<div class="container-fluid mt-4">
<a href="buy.php" class="btn btn-sm btn-info shadow" >
 <span class="fa fa-arsrow-right"></span>
 گەڕانەوە
  </a>
</div>

<?php if ($is_admin==1) {?>

<div class="container d-flex justify-content-around mt-2 flex-wrap">
    <a data-toggle="modal" data-target="#add" style="font-size:16px" class="btn btn-success "><i
            class="fas fa-dollar-sign "></i> کڕینی ئاسن</a>
    <!-- <div onclick="window.print()" class="btn  btn-dark "><i class="fas fa-print" style="font-size:18px"></i> پرنتکردن
    </div> -->
</div>

<?php } ?>


<div class="container-fluid mt-2">
    <div class="row m-auto">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="example" class="table  table-striped table-bordered  text-center" dir="rtl" style="zoom:85%">
                    <thead style="background-color: #0a0327;color: white">
                        <tr>
                            <th> ناوی فرۆشیار</th>
                            <th> شوێنی کڕین</th>
                            <th> جۆری ئاسن</th>
                            <th>بڕ</th>
                            <th> نرخی تاک </th>
                            <th> نرخی داشکاندن </th>
                            <th> نرخی واسڵکراو </th>
                            <th> نرخی گشتی </th>
                            <th> نرخی ماوە </th>
                            <th> نرخی فرۆشتن </th>
                            <th>جۆری دراو</th>
                            <th> بەروار </th>
                            <th> تێبینی    </th>
                            <?php if ($is_admin==1) {?><th> Action </th><?php } ?>
                            <?php if ($is_admin==1) {?>
                                <th>گەڕاندنەوە</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
$buy_asn = show(" SELECT * FROM buy WHERE buy_type='asn' AND `status`='1' ");
foreach ($buy_asn as $asn) {
  $id = $asn['id'];
  $dealer_id = $asn['dealer_id'];
  $num = $asn['num'];
  $cost_t = $asn['cost_t'];
  $cost_co = $asn['cost_co'];
  $cost_wasl = $asn['cost_wasl'];
  $type = $asn['type'];
  $cost_mawa = $cost_co-$cost_wasl;
  $place = $asn['place'];
  $cost_froshtn = $asn['cost_fr'];
  $discount = $asn['discount'];
  $date = $asn['date'];
  $unit = $asn['unit'];
  $note=$asn['note'];

//   froshyar
  $getdealer = getdata(" SELECT * FROM dealers WHERE id='$dealer_id' ");
  $dealer_name = $getdealer['name'];
  $currency_type = $getdealer['currency_type'];
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
                            <td><a href="dealer_detail.php?id=<?=$dealer_id;?>"><?=$dealer_name;?></a></td>
                            <td><?=$place;?></td>
                            <td><?=$type;?></td>
                            <td><?=$num;?>  <?=$unit;?></td>
                            <td><?=$cost_t;?></td>
                            <td><?=$discount;?></td>
                            <td><?=$cost_wasl;?></td>
                            <td><?=$cost_co;?></td>
                            <td><?=$cost_mawa;?></td>
                            <td><?=$cost_froshtn;?></td>
                            <td><?=$currency_type;?></td>
                            <td><?=$date;?></td>
                            <td style="max-width:220px;width:220px;overflow:hidden;word-wrap: break-word;overflow-wrap: break-word;white-space: pre-wrap;"><?=$note;?></td>
                            <?php if ($is_admin==1) {?>
                            <td>
                                <i class="fa fa-trash s-20 cursor" data-toggle="modal"
                                    data-target="#delete<?php echo $asn['id'] ?>"></i>
                                <i class="fa fa-edit s-20 cursor" data-toggle="modal"
                                    data-target="#edit<?php echo $asn['id'] ?>"></i>
                                <!-- <i class="fa fa-print cursor s-20" data-toggle="modal" data-target="#print" ></i>            -->
                            </td>
                            <?php } ?>

                            <?php if ($is_admin==1) {?>
                            <td>
                                    <form method="post" action="buy_asn.php">
                                        <input type="hidden" name="id" value="<?=$id?>">
                                        <button type="submit" name="return_buy" style="border:none;background:none" > <i class="fas fa-sync"></i> </button>
                                    </form> 
                            </td>
                            <?php } ?>
                        </tr>

                        <!-- delete modal -->
                        <div class="modal fade" id="delete<?php echo $asn['id'] ?>" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content" style="background-color: white;border-radius: 15px;">
                                    <div class="modal-body text-center">
                                        <div class="container-fluid">
                                            <div class="row row-cols-1 row-cols-md-3">
                                                <div class="col-md-12 mb-3 mx-auto">
                                                    <div class="h-100">
                                                        <i class="fa fa-times-circle" style="float:left;color: black"
                                                            data-dismiss="modal"></i>
                                                        <div class="card-body">
                                                            <h5 class="container col-md-6 mt-3  text-center">
                                                                دڵنیای لە سڕینەوەی ئەم کڕینە لەناو سیستەمەکەت ؟
                                                            </h5>
                                                            <br>
                                                            <form dir="rtl" method="POST">
                                                                <div class="form-group">
                                                                    <input type="hidden" placeholder="  ناو  " name="id"
                                                                        value="<?=$id;?> "
                                                                        class="form-control col-md-10 mx-auto">
                                                                </div>
                                                                <!-- <div class="form-group">
              <input type="text" placeholder="  ناو  " name="name" value="<?=$name;?> " class="form-control col-md-10 mx-auto">
            </div>   -->
                                                                <button type="submit" name="del"
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

                        <!-- edit modal -->
                        <div class="modal fade" id="edit<?php echo $asn['id'] ?>" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content" style="background-color: white;border-radius: 15px;">
                                    <div class="modal-body ">
                                        <div class="container-fluid">
                                            <div class="row row-cols-1 row-cols-md-3">
                                                <div class="col-md-12 mb-3 mx-auto">
                                                    <div class="h-100">
                                                        <i class="fa fa-times-circle" style="float:left;color: black"
                                                            data-dismiss="modal"></i>
                                                        <div class="card-body">
                                                            <h5 class="container col-md-6 mt-3  text-center">
                                                                گۆڕانکاری بکە لە زانیارییەکانی کڕین
                                                            </h5>
                                                            <br>
                                                            <form method="POST">
                                                                <div class="form-group">
                                                                    <input type="hidden" placeholder="ID " name="id"
                                                                        value="<?=$id;?> "
                                                                        class="form-control col-md-10 mx-auto">
                                                                </div>

                                        <label>ناوی فرۆشیار</label>
                                      <div class="form-group ">
                                            <select name="dealer_id"  class="form-control col-md-10 mx-auto">
                                                <?php
                                                  $getdealer = show(" SELECT * FROM dealers");
                                                  foreach ($getdealer as $dealer) { ?>
                                                
                                                <option <?php if($dealer_id==$dealer['id']) echo 'selected="selected"'; ?>  value="<?=$dealer['id']?>"> <?=$dealer['name']?> </option>
                                               <?php   } ?>
                                            </select>
                                        </div> 

                                            
                                            <label>شوێنی کڕین</label>
                                            <div class="form-group">
                                                <input type="text" value="<?=$place?>"
                                                    class="form-control col-md-10 mx-auto" name="place"
                                                    required="">
                                            </div>


                                            <label>یەکەی کڕین</label>
                                            <div class="form-group">

                                            <select name="unit" class="form-control col-md-10 mx-auto" required>
                                                <option <?php if($unit=="دانە") echo 'selected="selected"'; ?> value="دانە">دانە</option>
                                                <option <?php if($unit=="کیلۆ") echo 'selected="selected"'; ?> value="کیلۆ">کیلۆ</option>
                                                <option <?php if($unit=="تەن") echo 'selected="selected"'; ?> value="تەن">تەن</option>
                                            </select>

                                            </div>

                                            <div class="form-group">
                                                <input type="text" placeholder=" بڕی کڕین"
                                                    class="form-control col-md-10 mx-auto" value="<?=$num?>" name="num" required="">
                                            </div>

                                            <div class="form-group">
                                                <input type="text" placeholder="جۆری ئەشیا" value="<?=$type?>"
                                                    class="form-control col-md-10 mx-auto" name="type" required="">
                                            </div>

                        
                                            <label>نرخی تاک</label>
                                            <div class="form-group">
                                                <input type="text" value="<?=$cost_t?>"
                                                    class="form-control col-md-10 mx-auto" name="cost_t" required="">
                                            </div>

                                            <label>بڕی واسڵ</label>
                                            <div class="form-group">
                                                <input type="text" value="<?=$cost_wasl?>"
                                                    class="form-control col-md-10 mx-auto" name="cost_wasl" required="">
                                            </div>

                                            <label>نرخی فرۆشتن</label>
                                            <div class="form-group">
                                                <input type="text" value="<?=$cost_froshtn?>"
                                                    class="form-control col-md-10 mx-auto" name="cost_fr" required="">
                                            </div>

                                            <label>نرخی داشکاندن</label>
                                            <div class="form-group">
                                                <input type="text" value="<?=$discount?>"
                                                    class="form-control col-md-10 mx-auto" name="discount" required="">
                                            </div>

                                            <label>تێبینی</label>
                                         <div class="form-group">
                                          <textarea id="my-textarea" class="form-control" name="note" rows="4"><?=$note?></textarea>
                                         </div>

                                                            

                                                                <button type="submit" name="edit"
                                                                    class="btn btn-dark btn-block"> نوێکردنەوەی کڕین
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


                        <?php
}
?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>




    <!-- add krdn -->



    <!-- Add  modal -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            زیادکردنی کڕینی  ئاسن
                                        </h5>
                                        <br>
                                        <form class="mt-5" dir="rtl" method="POST" >

                                        <label>ناوی فرۆشیار</label>
                                      <div class="form-group ">
                                            <select name="dealer_id"  class="form-control col-md-10 mx-auto">
                                                <?php
                                                  $getdealer = show(" SELECT * FROM dealers");
                                                  foreach ($getdealer as $dealer) { ?>
                                                
                                                <option  value="<?=$dealer['id']?>"> <?=$dealer['name']?> </option>
                                               <?php   } ?>
                                            </select>
                                        </div> 

                                            <div class="form-group">
                                                <input type="text" placeholder="شوێنی کڕین"
                                                    class="form-control col-md-10 mx-auto" name="place"
                                                    required="">
                                            </div>


                                            <label>یەکەی کڕین</label>
                                            <div class="form-group">

                                            <select name="unit" class="form-control col-md-10 mx-auto" required>
                                                <option value="دانە">دانە</option>
                                                <option value="کیلۆ">کیلۆ</option>
                                                <option value="تەن">تەن</option>
                                            </select>

                                            </div>

                                            <div class="form-group">
                                                <input type="text" placeholder=" بڕی کڕین"
                                                    class="form-control col-md-10 mx-auto" name="num" required="">
                                            </div>

                                            <div class="form-group">
                                                <input type="text" placeholder="جۆری ئەشیا"
                                                    class="form-control col-md-10 mx-auto" name="type" required="">
                                            </div>

                                          

                                            <div class="form-group">
                                                <input type="text" placeholder="  نرخی تاک   "
                                                    class="form-control col-md-10 mx-auto" name="cost_t" required="">
                                            </div>


                                            <div class="form-group">
                                                <input type="text" placeholder=" بڕی واسڵ "
                                                    class="form-control col-md-10 mx-auto" name="cost_wasl" required="">
                                            </div>


                                            <div class="form-group">
                                                <input type="text" placeholder="  نرخی فرۆشتن   "
                                                    class="form-control col-md-10 mx-auto" name="cost_fr" required="">
                                            </div>

                                            <div class="form-group">
                                                <input type="text" placeholder="  نرخی داشکاندن "
                                                    class="form-control col-md-10 mx-auto" name="discount" required="">
                                            </div>


                                            <div class="form-group">
                                           <textarea id="my-textarea" placeholder="تێبینی بنووسە" class="form-control" name="note" rows="4"></textarea>
                                          </div>

                                            <br>
                                            <button type="submit" name="add"
                                                class="btn btn-success btn-block btn-sm s-20">
                                                <i class="fal fa-plus s-20"></i>
                                                زیادکردن </button>
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

 if (isset($_SESSION["update_return"])) {
    msg('سەرکەتووبوو','بە سەرکەوتوویی ئەم کڕینە گەڕێندرایەوە','success');
     unset($_SESSION["update_return"]);
  }
  

 
 ?>




    <?php 


if (post('return_buy')) {
    $id = secure($_POST['id']);
    execute("UPDATE buy SET `status`='-1' WHERE id='$id' ");
    $_SESSION["update_return"] = "";
    direct('buy_asn.php');
  }


if (post('edit')) {
    $id = secure($_POST['id']);
    $dealer_id = secure($_POST['dealer_id']);
    $num = secure($_POST['num']);
    $cost_t = secure($_POST['cost_t']);
    $type = secure($_POST['type']);
    $place = secure($_POST['place']);
    $cost_wasl = secure($_POST['cost_wasl']);
    $cost_fr = secure($_POST['cost_fr']);
    $note = secure($_POST['note']);
    $discount = secure($_POST['discount']);
    $unit = secure($_POST['unit']);
  
     $cost_co = $cost_t*$num;
     $cost_co=$cost_co - $discount;
  
     $cost_mawa =$cost_co-$cost_wasl;
  
    $sql=execute("UPDATE  `buy` SET `dealer_id`='$dealer_id',`num`='$num',`cost_t`='$cost_t',`cost_co`='$cost_co',`type`='$type',`place`='$place',`cost_wasl`='$cost_wasl',`cost_fr`='$cost_fr',`note`='$note',`discount`='$discount',`unit`='$unit'  WHERE id='$id' ");

  $_SESSION["edit_success"] = "";
  direct('buy_asn.php');

}

if (post('del')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM `buy` WHERE id = '$id'");
    $_SESSION["delete"] = "";
    direct('buy_asn.php');
}



// add

if (post('add')) {
    $dealer_id = secure($_POST['dealer_id']);
    $num = secure($_POST['num']);
    $cost_t = secure($_POST['cost_t']);
    $type = secure($_POST['type']);
    $unit = secure($_POST['unit']);
    $place = secure($_POST['place']);
    $cost_wasl = secure($_POST['cost_wasl']);
    $cost_fr = secure($_POST['cost_fr']);
    $date = date("Y-m-d");
    $discount = secure($_POST['discount']);
    $note = secure($_POST['note']);

     $cost_co = $cost_t*$num;
     $cost_co=$cost_co - $discount;

 

    $sql=execute("INSERT INTO `buy` (`dealer_id`,`cost_t`,`cost_co`,`num`,`type`,`cost_wasl`,`date`,`cost_fr`,`discount`,`unit`,`name_product`,`place`,`buy_type`,`status`,`note`) VALUES('$dealer_id','$cost_t','$cost_co','$num','$type','$cost_wasl','$date','$cost_fr','$discount','$unit','ئاسن','$place','asn','1','$note') ");
    

    $_SESSION["add_success"] = "";
    direct('buy_asn.php');
}

?>
    <?php require_once('footer.php'); ?>