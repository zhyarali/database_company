<?php require_once('header.php'); ?>


<div class="container-fluid mt-4">
<button onclick="window.history.back()" class="btn btn-sm btn-info shadow" >
 <span class="fa fa-arrow-right"></span>
 گەڕانەوە
  </button>
</div>


<div class="container d-flex justify-content-around mt-2 flex-wrap">
    <a data-toggle="modal" data-target="#add" style="font-size:16px" class="btn btn-success "><i
            class="fas fa-dollar-sign "></i>گەڕانەوەی فرۆشتنی ئەشیای قاعە </a>
    <div onclick="window.print()" class="btn  btn-dark "><i class="fas fa-print" style="font-size:18px"></i> پرنتکردن
    </div>
</div>




<div class="container-fluid mt-2">
    <div class="row m-auto">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="example" class="table  table-striped table-bordered  text-center" dir="rtl" style="zoom:85%">
                    <thead style="background-color: #0a0327;color: white">
                        <tr>
                            <th> ناوی کڕیار</th>
                            <th> ناوی شتوومەک</th>
                            <th> ژمارە </th>
                            <th> نرخی فرۆشتن </th>
                            <th> نرخی داشکاندن </th>
                            <th> جۆر </th>
                            <th> شوێن </th>
                            <th> نرخی واسڵکراو </th>
                            <th> نرخی گشتی </th>
                            <th> نرخی ماوە </th>
                            <th> بەروار </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
$sale_qa3a =show(" SELECT * FROM sale WHERE sale_type='qa3a' AND `status`='-1' ");
foreach ($sale_qa3a as $qa3a) {
  $id = $qa3a['id'];
  $customer_id = $qa3a['customer_id']; 
  $name_product = $qa3a['name_product'];
  $num = $qa3a['num'];
  $cost_t = $qa3a['cost_t'];
  $cost_co = $qa3a['cost_co'];
  $type = $qa3a['type'];
  $cost_wasl = $qa3a['cost_wasl'];
  $cost_mawa = $cost_co-$cost_wasl;
  $place = $qa3a['place'];
  $discount = $qa3a['discount'];
  $date = $qa3a['date'];
  $unit = $qa3a['unit'];

  $getCustomer = getdata(" SELECT * FROM customer WHERE id='$customer_id' ");
  $customer_name = $getCustomer['name'];

?>
                        <tr>
                            <td><a href="customer_detail.php?id=<?=$customer_id;?>"><?=$customer_name;?></a></td>
                            <td><?=$name_product;?></td>
                            <td><?=$num;?>   <?=$unit;?></td>
                            <td><?=$cost_t;?></td>
                            <td><?=$discount;?></td>
                            <td><?=$type;?></td>
                            <td><?=$place;?></td>
                            <td><?=$cost_wasl;?></td>
                            <td><?=$cost_co;?></td>
                            <td><?=$cost_mawa;?></td>
                            <td><?=$date;?></td>
                            <td>
                                <i class="fa fa-trash s-20 cursor" data-toggle="modal"
                                    data-target="#delete<?php echo $qa3a['id'] ?>"></i>
                                <i class="fa fa-edit s-20 cursor" data-toggle="modal"
                                    data-target="#edit<?php echo $qa3a['id'] ?>"></i>
                                <!-- <i class="fa fa-print cursor s-20" data-toggle="modal" data-target="#print" ></i>            -->
                            </td>
                        </tr>

                        <!-- delete modal -->
                        <div class="modal fade" id="delete<?php echo $qa3a['id'] ?>" tabindex="-1" role="dialog"
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
                                                                دڵنیای لە سڕینەوەی ئەم فرۆشتنە لەناو سیستەمەکەت ؟
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
                        <div class="modal fade" id="edit<?php echo $qa3a['id'] ?>" tabindex="-1" role="dialog"
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
                                                        گۆڕانکاری بکە لە زانیارییەکانی گەڕاوەی فرۆش
                                                            </h5>
                                                            <br>
                                                            <form method="POST">
                                                                <div class="form-group">
                                                                    <input type="hidden" placeholder="ID " name="id"
                                                                        value="<?=$id;?> "
                                                                        class="form-control col-md-10 mx-auto">
                                                                </div>

                                        <label>ناوی كڕیار</label>
                                      <div class="form-group ">
                                            <select name="customer_id"  class="form-control col-md-10 mx-auto">
                                                <?php
                                                  $getCustomer = show(" SELECT * FROM customer");
                                                  foreach ($getCustomer as $customer) { ?>
                                                
                                                <option <?php if($customer_id==$customer['id']) echo 'selected="selected"'; ?>  value="<?=$customer['id']?>"> <?=$customer['name']?> </option>
                                               <?php   } ?>
                                            </select>
                                        </div> 


                                            <label>ناوی شتوومەک</label>
                                            <div class="form-group">
                                                <input type="text" value="<?=$name_product?>"
                                                    class="form-control col-md-10 mx-auto" name="name_product"
                                                    required="">
                                            </div>
                                            
                                            <label>شوێن</label>
                                            <div class="form-group">
                                                <input type="text" value="<?=$place?>"
                                                    class="form-control col-md-10 mx-auto" name="place"
                                                    required="">
                                            </div>


                                            <label>یەکەی فرۆشتن</label>
                                            <div class="form-group">

                                                <select name="unit" class="form-control col-md-10 mx-auto" required>
                                                    <option <?php if($unit=="مەتر") echo 'selected="selected"'; ?> value="مەتر">مەتر</option>
                                                    <option <?php if($unit=="دانە") echo 'selected="selected"'; ?> value="دانە">دانە</option>
                                                    <option <?php if($unit=="کیلۆ") echo 'selected="selected"'; ?> value="کیلۆ">کیلۆ</option>
                                                </select>

                                            </div>


                                            <div class="form-group">
                                                <input type="text" placeholder="بڕی فرۆشتن" value="<?=$num?>"
                                                    class="form-control col-md-10 mx-auto" name="num" required="">
                                            </div>

                                            <div class="form-group">
                                                <input type="text" placeholder="جۆری ئەشیا" value="<?=$type?>"
                                                    class="form-control col-md-10 mx-auto" name="type" required="">
                                            </div>

                                          

                                            <label>نرخی فرۆشتنی تاک</label>
                                            <div class="form-group">
                                                <input type="text" value="<?=$cost_t?>"
                                                    class="form-control col-md-10 mx-auto" name="cost_t" required="">
                                            </div>

                                            <label>بڕی واسڵ</label>
                                            <div class="form-group">
                                                <input type="text" value="<?=$cost_wasl?>"
                                                    class="form-control col-md-10 mx-auto" name="cost_wasl" required="">
                                            </div>

                            

                                            <label>نرخی داشکاندن</label>
                                            <div class="form-group">
                                                <input type="text" value="<?=$discount?>"
                                                    class="form-control col-md-10 mx-auto" name="discount" required="">
                                            </div>

                                            <label> بەروار</label>
                                            <div class="form-group">
                                                <input type="date" value="<?=$date?>"
                                                    class="form-control col-md-10 mx-auto" name="date" required="">
                                            </div>

                                                            

                                                                <button type="submit" name="edit"
                                                                    class="btn btn-dark btn-block"> نوێکردنەوەی گەڕانەوەی فرۆشتن
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
                                            گەڕانەوەی فرۆشتنی  ئەشیای ناو قاعە
                                        </h5>
                                        <br>
                                        <form class="mt-5" dir="rtl" method="POST" enctype="multipart/form-data">

                                        <label>ناوی کڕیار</label>
                                      <div class="form-group ">
                                            <select name="customer_id"  class="form-control col-md-10 mx-auto">
                                                <?php
                                                  $getCustomer = show(" SELECT * FROM customer");
                                                  foreach ($getCustomer as $customer) { ?>
                                                
                                                <option  value="<?=$customer['id']?>"> <?=$customer['name']?> </option>
                                               <?php   } ?>
                                            </select>
                                        </div> 

                                            <div class="form-group">
                                                <input type="text" placeholder="   ناوی شتوومەک  "
                                                    class="form-control col-md-10 mx-auto" name="name_product"
                                                    required="">
                                            </div>

                                            <div class="form-group">
                                                <input type="text" placeholder="شوێنی فرۆشتن"
                                                    class="form-control col-md-10 mx-auto" name="place"
                                                    required="">
                                            </div>
                                            
                                            <label>یەکەی فرۆشتن</label>
                                            <div class="form-group">

                                                <select name="unit" class="form-control col-md-10 mx-auto" required>
                                                    <option value="مەتر">مەتر</option>
                                                    <option value="دانە">دانە</option>
                                                    <option value="کیلۆ">کیلۆ</option>
                                                </select>

                                            </div>


                                            <div class="form-group">
                                                <input type="text" placeholder="بڕی فرۆشتن"
                                                    class="form-control col-md-10 mx-auto" name="num" required="">
                                            </div>

                                            <div class="form-group">
                                                <input type="text" placeholder="جۆری ئەشیا"
                                                    class="form-control col-md-10 mx-auto" name="type" required="">
                                            </div>

                                            

                                            <div class="form-group">
                                                <input type="text" placeholder="  نرخی فرۆشتنی تاک   "
                                                    class="form-control col-md-10 mx-auto" name="cost_t" required="">
                                            </div>


                                            <div class="form-group">
                                                <input type="text" placeholder=" بڕی واسڵ "
                                                    class="form-control col-md-10 mx-auto" name="cost_wasl" required="">
                                            </div>


                                            <div class="form-group">
                                                <input type="text" placeholder="  نرخی داشکاندن "
                                                    class="form-control col-md-10 mx-auto" name="discount" required="">
                                            </div>


                                            <div class="form-group">
                                                <input type="date" placeholder="  بەروار  "
                                                    class="form-control col-md-10 mx-auto" name="date" required="">
                                            </div>

                                            <br>
                                            <button type="submit" name="add"
                                                class="btn btn-success btn-block btn-sm s-20">
                                                <i class="fal fa-plus s-20"></i>
                                                 گەڕاندنەوەی فرۆشتن </button>
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
  $num = secure($_POST['num']);
  $cost_t = secure($_POST['cost_t']);
  $type = secure($_POST['type']);
  $place = secure($_POST['place']);
  $cost_wasl = secure($_POST['cost_wasl']);
  $date = secure($_POST['date']);
  $discount = secure($_POST['discount']);
  $unit = secure($_POST['unit']);

   $cost_co = $cost_t*$num;
   $cost_co=$cost_co - $discount;

   $cost_mawa =$cost_co-$cost_wasl;

  $sql=execute("UPDATE  `sale` SET `customer_id`='$customer_id',`name_product`='$name_product',`num`='$num',`cost_t`='$cost_t',`cost_co`='$cost_co',`type`='$type',`place`='$place',`cost_wasl`='$cost_wasl',`date`='$date',`discount`='$discount',`unit`='$unit'  WHERE id='$id' ");
  $_SESSION["edit_success"] = "";
  direct('return_sale_qa3a.php');

}

if (post('del')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM `sale` WHERE id = '$id'");
    $_SESSION["delete"] = "";
    direct('return_sale_qa3a.php');
}



// add

if (post('add')) {
    $customer_id = secure($_POST['customer_id']);
    $name_product = secure($_POST['name_product']);
    $num = secure($_POST['num']);
    $cost_t = secure($_POST['cost_t']);
    $type = secure($_POST['type']);
    $unit = secure($_POST['unit']);
    $place = secure($_POST['place']);
    $cost_wasl = secure($_POST['cost_wasl']);
    $date = secure($_POST['date']);
    $discount = secure($_POST['discount']);

     $cost_co = $cost_t*$num;
     $cost_co=$cost_co - $discount;

 

    $sql=execute("INSERT INTO `sale` (`customer_id`,`cost_t`,`cost_co`,`num`,`type`,`cost_wasl`,`date`,`discount`,`unit`,`name_product`,`place`,`sale_type`,`status`) VALUES('$customer_id','$cost_t','$cost_co','$num','$type','$cost_wasl','$date','$discount','$unit','$name_product','$place','qa3a','-1') ");
    $_SESSION["add_success"] = "";
    direct('return_sale_qa3a.php');
}

?>
    <?php require_once('footer.php'); ?>