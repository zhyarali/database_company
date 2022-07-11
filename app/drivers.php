
<?php require_once('header.php'); ?>

<?php if ($is_admin==1) {?>
<div class="container d-flex justify-content-center mt-5 flex-wrap">
<a data-toggle="modal" data-target="#add" style="font-size:16px"  class="btn btn-success " ><i class="fas fa-user-plus "></i>  زیادکردنی شۆفێر</a>
</div>
<?php } ?>

<?php if ($is_admin==0) {?>
  <div class="mt-5"></div>
<?php } ?>

<div class="container-fluid ">
<div class="row d-flex justify-content-center">
  
<div class="form-group col-10 col-lg-3 col-md-8">
    <input type="text" id="search" class="form-control " placeholder="بگەڕی بۆ ناوی شۆفێر ...">
</div>

<div class="container-fluid mt-2">
<div class="row d-flex justify-content-center" id="result">

<?php 
$drivers = show(" SELECT * FROM drivers ");
foreach ($drivers as $driver) {
  $id = $driver['id'];
  $name = $driver['name'];
  $car_type = $driver['car_type'];
  $car_model = $driver['car_model'];
  $car_number = $driver['car_number'];
  $phone = $driver['phone'];
  $work_type = $driver['work_type'];
  $money_owner = $driver['money_owner'];

?>
     

<div class=" col-6 col-sm-6 col-md-4 col-lg-3  col-xl-3  text-center mt-5 mt-lg-0 p-3">
 <a href="view_driver.php?driver_id=<?=$id?>">
<div class="card " style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2) !important;">
<div class="card-body pb-2">
<h6 class="card-title"><?=$name?></h6>
<p class="card-text"><?=$phone;?></p>
<p class="card-text"> <strong>جۆری سەیارە :</strong> <?=$car_type;?></p>
<p class="card-text"> <strong>جۆری کار :</strong> <?=$work_type?></p>
<p class="card-text"> <strong>مۆدێلی سەیارە :</strong> <?=$car_model?></p>
<p class="card-text"> <strong>ژمارەی سەیارە :</strong> <span style="font-family:sans-serif !important;font-size:13px"><?=$car_number?></span></p>
<p class="card-text"> <strong> پارەدان :</strong> <?=$money_owner?></p>

<?php if ($is_admin==1) {?>
<div class="d-flex justify-content-around mt-3">
<a data-toggle="modal" data-target="#work<?=$id?>"   class="dropdown-item mx-2  btn btn-primary" style="background-color:#7868E6 !important;" href="#">کارکردن</a>
<a data-toggle="modal" data-target="#delete<?=$id?>" class="dropdown-item btn  btn-danger" style="background-color:#A6A9B6 !important;">سڕینەوە</a>
</div>
<?php } ?>

</div>
</div>
</a> 

</div> 
      
<!-- delete modal -->
  <div class="modal fade" id="delete<?php echo $driver['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        دڵنیای لە سڕینەوەی ئەم شۆفێرە لەناو سیستەمەکەت ؟
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

  
<?php
}
?>
     
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

if (post('del')) {
  $id = secure($_POST['id']);
  $sql = execute(" DELETE  FROM drivers WHERE id = '$id'");
  $_SESSION["delete"] = "";
  direct('drivers.php');
  
}


if (post('add')) {
  $name = secure($_POST['name']);
  $car_type = secure($_POST['car_type']);
  $car_model = secure($_POST['car_model']);
  $car_number = secure($_POST['car_number']);
  $phone = secure($_POST['phone']);
  $work_type = secure($_POST['work_type']);
  $money_owner = secure($_POST['money_owner']);
  $currency_type = secure($_POST['currency_type']);


  $sql = execute("INSERT INTO `drivers` (`name`,`car_type`,`car_model`,`car_number`,`phone`,`work_type`,`money_owner`,`currency_type`) VALUES('$name','$car_type','$car_model','$car_number','$phone','$work_type','$money_owner','$currency_type')");
    $_SESSION["add_success"] = "";
   direct('drivers.php');

}


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
   direct('drivers.php');

}

?>
<?php require_once('footer.php'); ?>




<!-- add driver modal -->
<div class="modal fade" id="add" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-right">
         <div class="container-fluid">
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class="container col-md-6 mt-3  text-center">
              شۆفێر زیادبکە
        </h5>
        <br>
        <form method="POST">
         
                <label>ناوی شۆفێر</label>
                <div class="form-group">
                <input type="text" placeholder="  ناوی شۆفێر  " name="name"  class="form-control col-md-10 mx-auto">
                </div> 
                <label>جۆری سەیارە</label>
                <div class="form-group">
                    <select name="car_type"  class="form-control col-md-10 mx-auto">
                        <option value="بچووک">بچووک</option>
                        <option  value="گەورە">گەورە</option>
                    </select>
                </div> 
                <label>مۆدێلی سەیارە</label>
                <div class="form-group">
                <input type="text" placeholder="مۆدێلی سەیارە " name="car_model"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ژمارەی سەیارە</label>
                <div class="form-group">
                <input type="text" placeholder="ژمارەی سەیارە" name="car_number"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ژمارە مۆبایل</label>
                <div class="form-group">
                <input type="text" placeholder=" ژمارە مۆبایل" name="phone"  class="form-control col-md-10 mx-auto">
                </div> 
                <label>جۆری کار</label>
                <div class="form-group">
                    <select name="work_type"  class="form-control col-md-10 mx-auto">
                        <option value="بار">بار</option>
                        <option value="سەعات">سەعات</option>
                        <option value="ڕۆژانە">ڕۆژانە</option>
                    </select>
                </div> 
                <label>پارەدان</label>
                <div class="form-group">
                    <select name="money_owner" class="form-control col-md-10 mx-auto">
                        <option  value="ستاف">ستاف</option>
                        <option  value="کۆمپانیا">کۆمپانیا</option>
                        <option  value="کڕیار">کڕیار</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                  <label for="" class="float-end">جۆری دراو</label>
                 <select name="currency_type"  class="form-control col-md-10 mx-auto"> 
                  <option value="dinar">دینار</option>
                  <option value="dollar">دۆلار</option>
                  <option value="tman">تمەن</option>
              </select>
               </div>
            
    <button type="submit" name="add" class="btn btn-info btn-block">زیادکردنی شۆفێر</button>
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



  
<script>
$(document).ready(function(){

  function load_data(search)
 {
  $.ajax({
   url:"search_driver.php",
   method:"POST",
   data:{driver_search:search},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }



    $('#search').on("keyup input", function(){
        /* Get input value on change */
        var search = $(this).val();
        var result = $("#result");
         if(search != '')
        {
          load_data(search);
         }
       else
      {
       load_data();
      }
    });
    
    
});
</script>