<?php require_once('header.php'); ?>


<div class="container-fluid mt-4">
<button onclick="window.history.back()" class="btn btn-sm btn-info shadow" >
 <span class="fa fa-arrow-right"></span>
 گەڕانەوە
  </button>
</div>

<div class="container d-flex justify-content-around mt-2 flex-wrap">
<a data-toggle="modal" data-target="#add" style="font-size:16px"  class="btn btn-success " ><i class="fas fa-dollar-sign "></i>  گەڕانەوەی هێلکە</a>
<div onclick="window.print()" class="btn  btn-dark "><i class="fas fa-print" style="font-size:18px"></i> پرنتکردن</div>
</div>




<div class="container-fluid mt-2">
<div class="row m-auto" >

<div class="col-md-12">
  <div class="table-responsive">
<table id="example" class="table  table-striped table-bordered  text-center" dir="rtl" style="zoom:85%">
        <thead  style="background-color: #0a0327;color: white">
            <tr>
                <th> ناوی فرۆشیار</th>
                <th> ژمارە    </th>
                <th> نرخی تاک    </th>
                <th> نرخی داشکاندن    </th>
                <th> جۆر    </th>
                <th> نرخی ماوە    </th>
                <th> نرخی واسڵکراو    </th>
                <th> نرخی گشتی      </th>
                <th> نرخی فرۆشتن    </th>
                <th> بەروار    </th>
                <th> Action      </th>
            </tr>
        </thead>
        <tbody>
<?php 
$buy_helka = show(" SELECT * FROM buy WHERE buy_type='helka' AND `status`='-1' ");
foreach ($buy_helka as $helka) {
  $id = $helka['id'];
  $dealer_id = $helka['dealer_id'];
  $num = $helka['num'];
  $cost_t = $helka['cost_t'];
  $cost_co = $helka['cost_co'];
  $type = $helka['type'];
  $cost_wasl = $helka['cost_wasl'];
  $cost_froshtn = $helka['cost_fr'];
  $cost_mawa = $cost_co-$cost_wasl;
  $discount = $helka['discount'];
  $date = $helka['date'];
  $getdealer = getdata(" SELECT * FROM dealers WHERE id='$dealer_id' ");
  $dealer_name = $getdealer['name'];
  
?>

       <tr>
        <td><a href="dealer_detail.php?id=<?=$dealer_id;?>"><?=$dealer_name;?></a></td>
        <td><?=$num;?></td>
        <td><?=$cost_t;?></td>
        <td><?=$discount;?></td>
        <td><?=$type;?></td>
        <td><?=$cost_mawa;?></td>
        <td><?=$cost_wasl;?></td>
        <td><?=$cost_co;?></td>
        <td><?=$cost_froshtn;?></td>
        <td><?=$date;?></td>
        <td>
        <i class="fa fa-trash s-20 cursor" data-toggle="modal" data-target="#delete<?php echo $helka['id'] ?>"></i>        
        <i class="fa fa-edit s-20 cursor" data-toggle="modal" data-target="#edit<?php echo $helka['id'] ?>" ></i>        
        <!-- <i class="fa fa-print s-20 cursor" data-toggle="modal" data-target="#print" ></i>            -->
        </td>
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
        دڵنیای لە سڕینەوەی ئەم کڕینە لەناو سیستەمەکەت ؟
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
      گۆڕانکاری بکە لە زانیارییەکانی کڕین 
        </h5>
        <br>
    <form method="POST">
        <div class="form-group">
              <input type="hidden" placeholder="ID " name="id" value="<?=$id;?> " class="form-control col-md-10 mx-auto">
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

                    <label>جۆری هێلکە</label>
                    <div class="form-group">
                      <input type="text" value="<?=$type?>"  class="form-control col-md-10 mx-auto"
                        name="type" required="">
                    </div>

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

                    <label>نرخی تاک</label>
                    <div class="form-group">
                      <input type="text" value="<?=$cost_t?>" class="form-control col-md-10 mx-auto"
                        name="cost_t" required="">
                    </div>

                    <label>بڕی واسڵ</label>
                    <div class="form-group">
                      <input type="text" value="<?=$cost_wasl?>" class="form-control col-md-10 mx-auto"
                        name="cost_wasl" required="">
                    </div>

                    <label>نرخی فرشتن بە دانە</label>
                    <div class="form-group">
                      <input type="text" value="<?=$cost_froshtn?>" class="form-control col-md-10 mx-auto"
                        name="cost_fr" required="">
                    </div>

                    <label>نرخی داشکاندن</label>
                    <div class="form-group">
                      <input type="text" value="<?=$discount?>" class="form-control col-md-10 mx-auto"
                        name="discount" required="">
                    </div>

                   
                    <label>بەروار</label>
                    <div class="form-group">
                      <input type="date" value="<?=$date?>" class="form-control col-md-10 mx-auto" name="date"
                        required="">
                    </div>
              
    <button type="submit" name="edit" class="btn btn-dark btn-block">  نوێکردنەوەی کڕین  </button>
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
                    زیادکردنی کڕینی هێلکە
                  </h5>
                  <br>
                  <form class="mt-5" dir="rtl" method="POST" enctype="multipart/form-data">

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
                      <input type="text" placeholder="   جۆری هێلکە  " class="form-control col-md-10 mx-auto"
                        name="type" required="">
                    </div>

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
                      <input type="text" placeholder="  نرخی تاک   " class="form-control col-md-10 mx-auto"
                        name="cost_t" required="">
                    </div>

                  
                    <div class="form-group">
                      <input type="text" placeholder=" بڕی واسڵ " class="form-control col-md-10 mx-auto"
                        name="cost_wasl" required="">
                    </div>


                    <div class="form-group">
                      <input type="text" placeholder="  نرخی فرۆشتن بە دانە " class="form-control col-md-10 mx-auto"
                        name="cost_fr" required="">
                    </div>

                    <div class="form-group">
                      <input type="text" placeholder="  نرخی داشکاندن " class="form-control col-md-10 mx-auto"
                        name="discount" required="">
                    </div>

                    <div class="form-group">
                      <input type="date" placeholder="  بەروار  " class="form-control col-md-10 mx-auto" name="date"
                        required="">
                    </div>

                    <br>
                    <button type="submit" name="add" class="btn btn-success btn-block btn-sm s-20">
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

 
 ?>




<?php 

if (post('edit')) {
  $id = secure($_POST['id']);
  $dealer_id = secure($_POST['dealer_id']);
  $type = secure($_POST['type']);
  $num = secure($_POST['num']);
  $cost_t = secure($_POST['cost_t']);
  $date = secure($_POST['date']);
  $cost_wasl = secure($_POST['cost_wasl']);
  $cost_fr = secure($_POST['cost_fr']);
  $discount = secure($_POST['discount']);
  $unit = secure($_POST['unit']); 

   $cost_co = $cost_t*$num;
   $cost_co=$cost_co-$discount;

  $sql=execute("UPDATE `buy` SET `dealer_id`='$dealer_id',`cost_t`='$cost_t',`cost_co`='$cost_co',`num`='$num',`type`='$type',`cost_wasl`='$cost_wasl',`date`='$date',`cost_fr`='$cost_fr',`discount`='$discount' ,`unit`='$unit' WHERE `id`='$id' ");
    $_SESSION["edit_success"] = "";
    direct('return_buy_helka.php');

}

if (post('del')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM `buy` WHERE id = '$id'");
    $_SESSION["delete"] = "";
    direct('return_buy_helka.php');
}



// add

if (post('add')) {
    $dealer_id = secure($_POST['dealer_id']);
    $type = secure($_POST['type']);
    $num = secure($_POST['num']);
    $cost_t = secure($_POST['cost_t']);
    $date = secure($_POST['date']);
    $cost_wasl = secure($_POST['cost_wasl']);
    $cost_fr = secure($_POST['cost_fr']);
    $discount = secure($_POST['discount']);
    $unit = secure($_POST['unit']); 

     $cost_co = $cost_t*$num;
     $cost_co=$cost_co-$discount;


    $sql=execute("INSERT INTO `buy` (`dealer_id`,`cost_t`,`cost_co`,`num`,`type`,`cost_wasl`,`date`,`cost_fr`,`discount`,`unit`,`buy_type`,`status`) VALUES('$dealer_id','$cost_t','$cost_co','$num','$type','$cost_wasl','$date','$cost_fr','$discount','$unit','helka','-1') ");
    $_SESSION["add_success"] = "";
    direct('return_buy_helka.php');
}

?>
<?php require_once('footer.php'); ?>

