<?php require_once('header.php'); ?>
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
<?php 
$driver_id=$_GET['driver_id'];
$data = show(" SELECT * FROM drivers WHERE `id`=$driver_id");

if (empty($data)) {
  direct('index.php');
}else{


foreach ($data as $driver) {
    $id = $driver['id'];
    $name = $driver['name'];
    $car_type = $driver['car_type'];
    $car_model = $driver['car_model'];
    $car_number = $driver['car_number'];
    $phone = $driver['phone'];
    $work_type = $driver['work_type'];
    $money_owner = $driver['money_owner']; 
    
    $currency_type=$driver['currency_type'];
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

 

<div class="container-fluid  mt-3 d-flex justify-content-around">

<form method="post" action="view_report.php">
    
<input type="hidden" name="driver_id" value="<?=$driver_id?>">

     <button type="submit" class="btn btn-dark" name="driver_info" style="border:none;" > <i class="fas fa-print"></i> پرنتکردن</button>

  </form> 
  
  <div class="row  mt-3 d-flex justify-content-around flex-wrap">
       <div class="d-flex flex-wrap justify-content-center">

           <div class="form-group mx-3">
           <input type="date" 
            class="form-control  mx-auto" id="get_by_date" required>

            <input type="hidden" 
            class="form-control  mx-auto" id="driver_id" value="<?=$id?>">

          </div>
          <p class="btn btn-dark shadow mx-3" id="btn_search">زانیاری بەپێی ڕۆژ بهێنەوە</p>
          <a href="view_driver.php?driver_id=<?=$id?>" class="btn btn-success shadow ">زانیاری گشتی بهێنەوە</a>

       </div>    
    
   </div>

    </div>



<div class="container-fluid mt-2 d-flex flex-wrap">



    <!-- <div onclick="window.print()"><i class="fas fa-print fa-2x"></i> پرنتکردن</div> -->
    <div class=" col-6 col-sm-6 col-md-4 col-lg-3  col-xl-3  text-center mt-5 mt-lg-0 p-2">
    <div class="card " style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2) !important;">
<div class="card-body pb-2">
<h6 class="card-title"><?=$name?></h6>
<p class="card-text"><?=$phone;?></p>
<p class="card-text"> <strong>جۆری سەیارە :</strong> <?=$car_type;?></p>
<p class="card-text"> <strong>جۆری کار :</strong> <?=$work_type?></p>
<p class="card-text"> <strong>مۆدێلی سەیارە :</strong> <?=$car_model?></p>
<p class="card-text"> <strong>ژمارەی سەیارە :</strong> <span style="font-family:sans-serif !important;font-size:13px"><?=$car_number?></span></p>
<p class="card-text"> <strong> پارەدان :</strong> <?=$money_owner?></p>
<p class="card-text"> <strong> جۆری  دراو:</strong> <?=$currency_type?></p>
<?php if ($is_admin==1) {?>
<div class="d-flex justify-content-around mt-3">
<a data-toggle="modal" data-target="#edit<?=$id?>"   class="dropdown-item mx-2  btn btn-primary" style="background-color:#7868E6 !important;">گۆڕانکاری</a>
<a data-toggle="modal" data-target="#work<?=$id?>" class="dropdown-item btn  btn-danger" style="background-color:#A6A9B6 !important;">زیادکردنی کار</a>
</div>
<?php } ?>
</div>
</div>
</div>


<!-- workfrom modal -->
<div class="modal fade" id="work<?php echo $driver['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-right">
         <div class="container-fluid">
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class="mt-3  text-center">
          زیادکردنی کار بۆ شۆفێر
        </h5>
        <br>
        <form method="POST">

        <div class="form-group">
              <input type="hidden" placeholder="ID " name="id" value="<?=$id;?> " class="form-control col-md-10 mx-auto">
            </div> 

                <label>ناونیشانی هێنانی بار</label>
                <div class="form-group">
                <input type="text" placeholder="" name="from"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ناونیشانی گەشتنی بار</label>
                <div class="form-group">
                <input type="text" placeholder="" name="to"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ماوەی گەشتن بە کات</label>
                <div class="form-group">
                <input type="number"  name="time"  class="form-control col-md-10 mx-auto">
                </div>
                
                <label>نرخی بار</label>
                <div class="form-group">
                <input type="number" placeholder="" name="price"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>پارەدانەکە لەسەر کێبووە</label>
                <div class="form-group">
                    <select name="money_owner"  class="form-control col-md-10 mx-auto">
                        <option value="کۆمپانیا">کۆمپانیا</option>
                        <option value="ستاف">ستاف</option>ستاف
                        <option value="شۆفێر">شۆفێر</option>
                        <option value="داواکار">داواکار</option>
                    </select>
                </div> 

                <label>تێبینی</label>
                <div class="form-group">
                <textarea id="my-textarea" class="form-control" name="note" rows="4"></textarea>
                </div> 

                



    <center>
      <button type="submit" name="work" class="btn btn-info btn-block" style="background-color:#7868E6 !important;">زیادکردنی کار بۆ شۆفێر</button>
    </center>

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
<div class="modal fade" id="delete<?=$id?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-center">
         <div class="container-fluid">
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class="container col-md-10 mt-3  text-center">
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
<div class="modal fade" id="edit<?=$id?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-right">
         <div class="container-fluid">
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class=" mt-3  text-center">
      گۆڕانکاری بکە لە زانیارییەکانی شۆفێر 
        </h5>
        <br>
        <form method="POST">
        <div class="form-group">
              <input type="hidden" placeholder="ID " name="id" value="<?=$id;?> " class="form-control col-md-10 mx-auto">
            </div> 
                <label>ناوی شۆفێر</label>
                <div class="form-group">
                <input type="text" placeholder="  ناوی شۆفێر  " name="name" value="<?=$name;?> " class="form-control col-md-10 mx-auto">
                </div> 
                <label>جۆری سەیارە</label>
                <div class="form-group">
                    <select name="car_type" value="<?=$car_type;?>" class="form-control col-md-10 mx-auto">
                        <option <?php if($car_type=="بچووک") echo 'selected="selected"'; ?> value="بچووک">بچووک</option>
                        <option <?php if($car_type=="گەورە") echo 'selected="selected"'; ?> value="گەورە">گەورە</option>
                    </select>
                </div> 
                <label>مۆدێلی سەیارە</label>
                <div class="form-group">
                <input type="text" placeholder="مۆدێلی سەیارە " name="car_model" value="<?=$car_model;?>"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ژمارەی سەیارە</label>
                <div class="form-group">
                <input type="text"  name="car_number" value="<?=$car_number;?>"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ژمارە مۆبایل</label>
                <div class="form-group">
                <input type="text" placeholder=" ژمارە مۆبایل" name="phone" value="<?=$phone;?>" class="form-control col-md-10 mx-auto">
                </div> 
                <label>جۆری کار</label>
                <div class="form-group">
                    <select name="work_type" value="<?=$work_type;?>" class="form-control col-md-10 mx-auto">
                        <option <?php if($work_type=="بار") echo 'selected="selected"'; ?> value="بار">بار</option>
                        <option <?php if($work_type=="سەعات") echo 'selected="selected"'; ?> value="سەعات">سەعات</option>
                        <option <?php if($work_type=="ڕۆژانە") echo 'selected="selected"'; ?> value="ڕۆژانە">ڕۆژانە</option>
                    </select>
                </div> 
                <label>پارەدان</label>
                <div class="form-group">
                    <select name="money_owner" value="<?=$money_owner;?>" class="form-control col-md-10 mx-auto">
                        <option <?php if($money_owner=="ستاف") echo 'selected="selected"'; ?> value="ستاف">ستاف</option>
                        <option <?php if($money_owner=="کۆمپانیا") echo 'selected="selected"'; ?> value="کۆمپانیا">کۆمپانیا</option>
                        <option <?php if($money_owner=="کڕیار") echo 'selected="selected"'; ?> value="کڕیار">کڕیار</option>
                    </select>
                </div> 

                <div class="form-group">
                    <select name="currency_type"  class="form-control col-md-10 mx-auto"> 
                        <option value="dinar"  <?php echo $currency_type=='دینار' ? 'selected' : '' ?> >دینار</option>
                        <option value="dollar" <?php echo $currency_type=='دۆلار' ? 'selected' : '' ?>>دۆلار</option>
                        <option value="tman"   <?php echo $currency_type=='تمەن' ? 'selected' : '' ?>>تمەن</option>
                    </select>
                    </div>
            
    <button type="submit" name="edit" class="btn btn-info btn-block">  نوێکردنەوەی زانیارییەکانی شۆفێر  </button>
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





  <div class="row col-lg-8 col-12 m-auto p-4 table-responsive" style="zoom:80%">

<table class="table table-bordered text-center">
    <!-- <caption>List of users</caption> -->
    <thead>
        <tr>
            <th scope="col">ناونیشانی هێنانی بار</th>
            <th scope="col">ناونیشانی گەشتنی بار</th>
            <th scope="col">ماوەی گەشتن</th>
            <th scope="col">نرخ</th>
            <th scope="col">پارەدان</th>
            <th>جۆری دراو</th>
            <th scope="col">تێبینی</th>
            <th scope="col">Action</th>


        </tr>
    </thead>
    <tbody id="show_data">
 
    <?php
$works=show("SELECT * FROM driver_work WHERE driver_id=$id");

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
                    <input type="hidden" name="driver_id" value="<?=$driver_id?>">
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

 
    </tbody>
</table>

</div>

   
  
 




</div>




    
 
  
<?php require_once('footer.php'); } } ?>





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


// edit driver
if (post('edit')) {
    $id = secure($_POST['id']);
  $name = secure($_POST['name']);
  $car_type = secure($_POST['car_type']);
  $car_model = secure($_POST['car_model']);
  $car_number = secure($_POST['car_number']);
  $phone = secure($_POST['phone']);
  $work_type = secure($_POST['work_type']);
  $money_owner = secure($_POST['money_owner']);
  $currency_type = secure($_POST['currency_type']);


  $sql = execute("UPDATE `drivers` SET `name`='$name',`car_type`='$car_type',`car_model`='$car_model',`car_number`='$car_number',`phone`='$phone',`work_type`='$work_type',`money_owner`='$money_owner',`currency_type`='$currency_type' WHERE id = '$id'");
    $_SESSION["edit_success"] = "";
    $loc="view_driver.php?driver_id=".$id;
    direct($loc);

}

// delete driver

if (post('del')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM drivers WHERE id = '$id'");
    $_SESSION["delete"] = "";
    direct('drivers.php');
    
}



//   delete work
if (post('delete_work')) {
    $driver_id=$_GET['driver_id'];
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM driver_work WHERE id= '$id'");
    $_SESSION["delete"] = "";
    $loc="view_driver.php?driver_id=".$driver_id;
    direct($loc);
    
}



// edit work
if (post('edit_work')) {
    $id = secure($_POST['id']);
    $from = secure($_POST['from']);
    $to = secure($_POST['to']);
    $time = secure($_POST['time']);
    $price = secure($_POST['price']);
    $money_owner = secure($_POST['money_owner']);
    $note = secure($_POST['note']);
  
    $sql = execute("UPDATE  `driver_work` SET `from`='$from',`to`='$to',`time`='$time',`price`='$price',`money_owner`='$money_owner',`note`='$note' WHERE id='$id'");
      $_SESSION["edit_success"] = "";
      $loc="view_driver.php?driver_id=".$driver_id;
      direct($loc);
  
  }


//   add work 
if (post('work')) {
    $id = secure($_POST['id']);
    $from = secure($_POST['from']);
    $to = secure($_POST['to']);
    $time = secure($_POST['time']);
    $price = secure($_POST['price']);
    $money_owner = secure($_POST['money_owner']);
    $note = secure($_POST['note']);
  
  
    $sql = execute("INSERT INTO `driver_work` (`from`,`to`,`time`,`price`,`money_owner`,`note`,`driver_id`) VALUES('$from','$to','$time','$price','$money_owner','$note','$id')");
    $_SESSION["add_success"] = "";
    $loc="view_driver.php?driver_id=".$driver_id;
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
      var driver_id = $('#driver_id').val();
      if (date != '') {
        $.ajax({
          url: "get_by_date.php",
          method: "POST",
          data: {date_driver: date ,driver_id:driver_id},
          success: function (data) {
            $('#show_data').html(data);
          }
        });
      }
      else {
        alert("تکایە بەروارێک دیاری بکە !");
      }
    });
  });
</script>
