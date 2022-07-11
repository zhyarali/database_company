<?php require_once('header.php'); ?>


<style>
.btn-outline-dark:hover{
    background-color:#344767 !important;
    color: white !important;
}
</style>


<div class="container-fluid mt-4">
<a href="sale_qa3a.php" class="btn btn-sm btn-info shadow" >
 <span class="fa fa-arrow-right"></span>
 گەڕانەوە
  </a>
</div> 

<?php if ($is_admin==1) {?>

<div class="container d-flex justify-content-around mt-2 flex-wrap">
    <a data-toggle="modal" data-target="#add" style="font-size:16px" class="btn btn-success "><i
            class="fas fa-dollar-sign "></i> فرۆشتن بە مەتر</a>

            <a href="sale_category.php" style="font-size:16px;background:#7868E6 !important;" class="btn btn-danger">زیادکردنی بەشەکان</a>

    <!-- <div onclick="window.print()" class="btn  btn-dark "><i class="fas fa-print" style="font-size:18px"></i> پرنتکردن
    </div> -->
</div>

<?php } ?>


<div class="container-fluid mt-2">
    <div class="row m-auto">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="example" class="table  table-striped table-bordered  text-center" dir="rtl" style="zoom:80%">
                    <thead style="background-color: #0a0327;color: white">
                        <tr>
                            <th> ناوی کڕیار</th>
                            <th>ناوی بەش</th>
                            <th>پارچەکان</th>
                            <th>بڕی مەتر</th>
                            <th> نرخی فرۆشتن </th>
                            <th> نرخی داشکاندن </th>
                            <th> شوێن </th>
                            <th> نرخی واسڵکراو </th>
                            <th> نرخی گشتی </th>
                            <th> نرخی ماوە </th>
                            <th>جۆری دراو</th>
                            <th> بەروار </th>
                            <th>تێبینی</th>
                            <?php if ($is_admin==1) {?> <th> Action </th><?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
$sale_meter =show(" SELECT * FROM sale_meter");
foreach ($sale_meter as $meter) {
  $id = $meter['id'];
  $customer_id = $meter['customer_id']; 
  $id_category= $meter['id_category'];
  $num = $meter['num_meter'];
  $cost_wasl = $meter['nrx_wasl'];
  $place = $meter['address'];
  $discount = $meter['discount'];
  $date = $meter['date'];
  $note = $meter['note'];

  $getPrice=getdata("SELECT * FROM sale_category WHERE id=$id_category ");
  $cost_t=$getPrice['price'];

  $cost_co = $cost_t*$num;
  $cost_mawa = $cost_co-$cost_wasl;

  $getCustomer = getdata(" SELECT * FROM customer WHERE id='$customer_id' ");
  $customer_name = $getCustomer['name'];


  $currency_type=$getCustomer['currency_type'];
  if ($currency_type=='dinar') {
    $currency_type='دینار';
  }

  if ($currency_type=='dollar') {
    $currency_type='دۆلار';
  }

  if ($currency_type=='tman') {
    $currency_type='تمەن';
  }


  $getCategory = getdata(" SELECT * FROM sale_category WHERE id='$id_category' ");
  $category_name = $getCategory['name'];

  $piece = $meter['piece'];
  $piece=explode(",", $piece);

?>
                        <tr>
                            <td><a href="customer_detail.php?id=<?=$customer_id;?>"><?=$customer_name;?></a></td>
                            <td><?=$category_name;?></td>
                            <td style="max-width:300px; width:300px;white-space: pre-wrap;">
                              <?php 
                              foreach ($piece as $p) {

                                if (count($piece)==1) {
                                   echo $p;
                                }else{
                                    echo $p.' - ';
                                }
                                 

                              }
                              ?> 
                        
                           </td>
                            <td><?=$num;?></td>
                            <td><?=$cost_t;?></td>
                            <td><?=$discount;?></td>
                            <td><?=$place;?></td>
                            <td><?=$cost_wasl;?></td>
                            <td><?=$cost_co;?></td>
                            <td><?=$cost_mawa;?></td>
                            <td><?=$currency_type;?></td>
                            <td><?=$date;?></td>
                            <td style="max-width:220px;width:220px;overflow:hidden;word-wrap: break-word;overflow-wrap: break-word;white-space: pre-wrap;"><?=$note;?></td>
                            <?php if ($is_admin==1) {?>
                            <td>
                                <i class="fa fa-trash s-20 cursor" data-toggle="modal"
                                    data-target="#delete<?php echo $meter['id'] ?>"></i>
                                <i class="fa fa-edit s-20 cursor" data-toggle="modal"
                                    data-target="#edit<?php echo $meter['id'] ?>"></i>
                                <!-- <i class="fa fa-print cursor s-20" data-toggle="modal" data-target="#print" ></i>            -->
                            </td>
                            <?php } ?>
                        </tr>

                        <!-- delete modal -->
                        <div class="modal fade" id="delete<?php echo $meter['id'] ?>" tabindex="-1" role="dialog"
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
                        <div class="modal fade" id="edit<?php echo $meter['id'] ?>" tabindex="-1" role="dialog"
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
                                                            <h5 class=" mt-3  text-center">
                                                                گۆڕانکاری بکە لە زانیارییەکانی فرۆشتن
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

                                        <div class="form-group ">
                                            <select name="name"   class="form-control col-md-10 mx-auto">
                                                <?php
                                                  $getCategory = show(" SELECT * FROM sale_category WHERE id=$id_category");
                                                  foreach ($getCategory as $category) { ?>
                                                
                                                <option <?php if($id_category==$category['id']) echo 'selected="selected"';?>  value="<?=$category['id']?>"> <?=$category['name']?> </option>
                                               <?php   } ?>
                                            </select>
                                        </div> 

<div class="mt-2" role="group" id="result" aria-label="Basic checkbox toggle button group" style="zoom:100%">
<?php 
$getPiece = show(" SELECT * FROM piece WHERE category_id=$id_category");
foreach ($getPiece as $p) {
 ?>
  <input type="checkbox"   class="mx-2" <?php foreach ($piece as $item) {if ($item==$p['name']) {echo 'checked="checked" ';}}?>  name="check[]" id="check<?=$p['id'] ?>" value="<?=$p['name'] ?>" autocomplete="off">
  <label  style="transform:translate(0px,-4px)" for="check<?=$p['id'] ?>"><?=$p['name'] ?></label>

<?php }
?>

</div>

           

                                            <div class="form-group">
                                                <input type="text" value="<?=$place?>"
                                                    class="form-control col-md-10 mx-auto" name="place"
                                                    required="">
                                            </div>
                                            

                                            <div class="form-group">
                                                <input type="number" value="<?=$num?>"
                                                    class="form-control col-md-10 mx-auto" name="num" required="">
                                            </div>
                               


                                            <div class="form-group">
                                                <input type="number" value="<?=$cost_wasl?>"
                                                    class="form-control col-md-10 mx-auto" name="cost_wasl" required="">
                                            </div>


                                            <div class="form-group">
                                                <input type="number" value="<?=$discount?>"
                                                    class="form-control col-md-10 mx-auto" name="discount" required="">
                                            </div>


                                            <div class="form-group">
                                           <textarea id="my-textarea" placeholder="تێبینی بنووسە" class="form-control" name="note" rows="4"><?=$note?></textarea>
                                            </div>

                                                            

                                                                <button type="submit" name="edit"
                                                                    class="btn btn-dark btn-block"> نوێکردنەوەی فرۆشتن
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
                                            فرۆشتنی  بە مەتر
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


                                        <div class="form-group ">
                                            <select name="name" onchange="getPrice(this.value)" class="form-control col-md-10 mx-auto">
                                                <?php
                                                  $getCategory = show(" SELECT * FROM sale_category");
                                                  foreach ($getCategory as $category) { ?>
                                                
                                                <option  value="<?=$category['id']?>"> <?=$category['name']?> </option>
                                               <?php   } ?>
                                            </select>
                                        </div> 


<div class="mt-2" role="group" id="show_data" aria-label="Basic checkbox toggle button group" style="zoom:80%">
<?php 
$getPiece = show(" SELECT * FROM piece WHERE category_id='1'");
foreach ($getPiece as $piece) {
 ?>
  <input type="checkbox" class="btn-check" name="check[]" id="btncheck<?=$piece['id'] ?>" value="<?=$piece['name'] ?>" autocomplete="off">
  <label class="btn btn-outline-dark" style="border-radius:10px !important" for="btncheck<?=$piece['id'] ?>"><?=$piece['name'] ?></label>

<?php }
?>
</div>
           

                                            <div class="form-group">
                                                <input type="text" placeholder="شوێنی فرۆشتن"
                                                    class="form-control col-md-10 mx-auto" name="place"
                                                    required="">
                                            </div>
                                            

                                            <div class="form-group">
                                                <input type="number" placeholder="بڕی مەتری فرۆشتن"
                                                    class="form-control col-md-10 mx-auto" name="num" required="">
                                            </div>
                               


                                            <div class="form-group">
                                                <input type="number" placeholder=" بڕی واسڵ "
                                                    class="form-control col-md-10 mx-auto" name="cost_wasl" required="">
                                            </div>


                                            <div class="form-group">
                                                <input type="number" placeholder="  نرخی داشکاندن "
                                                    class="form-control col-md-10 mx-auto" name="discount" required="">
                                            </div>


                                            <div class="form-group">
                                           <textarea id="my-textarea" placeholder="تێبینی بنووسە" class="form-control" name="note" rows="4"></textarea>
                                            </div>


                                    
                                            <button type="submit" name="add"
                                                class="btn btn-success btn-block  ">
                                
                                                فرۆشتن </button>
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
  $name = secure($_POST['name']);
  $num = secure($_POST['num']);
  $place = secure($_POST['place']);
  $check=$_POST['check'];
  $check=implode(",",$check);
  $cost_wasl = secure($_POST['cost_wasl']);
  $note = secure($_POST['note']);
  $date=date("Y-m-d");
  $discount = secure($_POST['discount']);

  $getPrice=getdata("SELECT * FROM sale_category WHERE id=$name ");
  $cost_t=$getPrice['price'];

   $cost_co = $cost_t*$num;
   $cost_co=$cost_co - $discount;

   

  $sql=execute("UPDATE  `sale_meter` SET `id_category`='$name',`customer_id`='$customer_id',`piece`='$check',`num_meter`='$num',`discount`='$discount',`address`='$place',`nrx_wasl`='$cost_wasl',`note`='$note'  WHERE id='$id' ");
  $_SESSION["edit_success"] = "";
  direct('sale_meter.php');


}

if (post('del')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM `sale_meter` WHERE id = '$id'");
    $_SESSION["delete"] = "";
    direct('sale_meter.php');
}



if (post('add')) {
    $customer_id = secure($_POST['customer_id']);
    $name = secure($_POST['name']);
    $num = secure($_POST['num']);
    $place = secure($_POST['place']);
    $check = $_POST['check'];
    $check=implode(",",$check);
    $cost_wasl = secure($_POST['cost_wasl']);
    $note = secure($_POST['note']);
    $date=date("Y-m-d");
    $discount = secure($_POST['discount']);

    $getPrice=getdata("SELECT * FROM sale_category WHERE id=$name ");
    $cost_t=$getPrice['price'];

     $cost_co = $cost_t*$num;
     $cost_co=$cost_co - $discount;

$sql=execute("INSERT INTO `sale_meter` (`id_category`,`customer_id`,`piece`,`num_meter`,`discount`,`address`,`nrx_wasl`,`date`,`note`) VALUES('$name','$customer_id','$check','$num','$discount','$place','$cost_wasl','$date','$note') ");

    $_SESSION["add_success"] = "";
    direct('sale_meter.php');

}
?>
    <?php require_once('footer.php'); ?>



    <script>
        function getPrice(id){

            $.ajax({
          url: "sale_category_action.php",
          method: "POST",
          data: {id_category:id},
          success: function (data) {
            $('#show_data').html(data);
          }
        });
        }

        // function get_piece_update(id){
        

        //     $.ajax({
        //   url: "testf.php",
        //   method: "GET",
        //   data: {id_category_update:id},
        //   success: function (data) {
        //     $('#result').html(data);
        //   }
        // });
        // }
    </script>