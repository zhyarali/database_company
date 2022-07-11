<?php 
ob_start();
session_start();
require_once('../server/helper.php') ; 
$user_id = $_SESSION['adm_id'];
$getuser = getdata(" SELECT * FROM admin WHERE id='$user_id'");
   $is_admin = $getuser['type'];
?>





<!-- search client -->


<?php 
if (isset($_POST["driver_search"])) {
    
 $search=secure($_POST['driver_search']);
 $drivers = show(" SELECT * FROM drivers WHERE `name` LIKE '%".$search."%'");
 if ($drivers==null) {
    echo "هیچ زانیارییەک نەدۆزرایەوە ..!";
} ?>


<?php 

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



<!-- if input search null -->

<?php }  else{ ?>
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
      
<?php } ?>