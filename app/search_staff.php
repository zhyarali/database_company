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
if (isset($_POST["staff_search"])) {
    
 $search=secure($_POST['staff_search']);
 $staffs = show(" SELECT * FROM staff WHERE `name` LIKE '%".$search."%'");
 if ($staffs==null) {
    echo "هیچ زانیارییەک نەدۆزرایەوە ..!";
} ?>

<?php 
foreach ($staffs as $staff) {
  $id = $staff['id'];
  $name = $staff['name'];
  $manager = $staff['manager'];
  $phone = $staff['phone'];
  $note = $staff['note']; 




?>
   
<div class=" col-6 col-sm-6 col-md-4 col-lg-3  col-xl-3  text-center mt-5 mt-lg-0 p-2">
 <a href="view_staff.php?staff_id=<?=$id?>">
<div class="card " style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2) !important;">
<div class="card-body pb-2">
<h6 class="card-title"><?=$name?></h6>
<p class="card-text">بەڕێوەبەر : <?=$manager;?></p>
<p class="card-text"><?=$phone;?></p>

<?php if ($is_admin==1) {?>
<div class="d-flex justify-content-around mt-3">
<a data-toggle="modal" data-target="#edit<?=$id?>" class="dropdown-item btn mx-2  btn-danger" style="background-color:#7868E6 !important;">زیادکردنی پڕۆژە</a>
<a data-toggle="modal" data-target="#delete<?=$id?>" class="dropdown-item btn  btn-warning" style="background-color:#B68973 !important;">سڕینەوە</a>
</div>
<?php } ?>

</div>
</div>
</a> 

</div>  
   
  



  <!-- add  project  modal -->
  <div class="modal fade" id="edit<?php echo $staff['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content" style="background-color: white;border-radius: 15px;">
            <div class="modal-body text-right">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-md-3">
                        <div class="col-md-12 mb-3 mx-auto">
                            <div class="h-100">
                                <i class="fa fa-times-circle" style="float:left;color: black" data-dismiss="modal"></i>
                                <div class="card-body">
                                    <h5 class="container col-md-6 mt-3  text-center">
                                       پڕۆژە زیاد بکە
                                    </h5>
                                    <br>
                                    <form method="POST">
                                     
                                    <div class="form-group">
              <input type="hidden" placeholder="  ناو  " name="id" value="<?=$id;?> " class="form-control col-md-10 mx-auto">
            </div> 
                                     


                                        <label>ناوی پڕۆژە</label>
                                        <div class="form-group">
                                            <input type="text" name="project_name" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>بڕی پارەی وەرگیراو</label>
                                        <div class="form-group">
                                            <input type="text" name="get_price" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>بڕی پارەی خەرجکراو</label>
                                        <div class="form-group">
                                            <input type="text" name="xarjy" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>ناونیشانی پڕۆژە</label>
                                        <div class="form-group">
                                            <input type="text" name="address" class="form-control col-md-10 mx-auto" required>
                                        </div>
             
                                        

                                        <label>خاوەنی پڕۆژەکە</label>
                                        <div class="form-group">
                                        <select name="owner"  class="form-control col-md-10 mx-auto" required>
                                            <option  value="کۆمپانیا">کۆمپانیا</option>
                                            <option  value="ستاف">ستاف</option>
                                            <option  value="خاوەن کار">خاوەن کار</option>
                                        </select>
                                        </div>

                                        <label>تێبینی</label>
                                       <div class="form-group">
                                      <textarea id="my-textarea" class="form-control" name="note" rows="4"></textarea>
                                      </div>



                                        <button type="submit" name="add_project"
                                            class="btn btn-dark btn-block">زیادکردن</button>
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
<div class="modal fade" id="delete<?php echo $staff['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        دڵنیای لە سڕینەوەی ئەم کارمەندە لەناو سیستەمەکەت ؟
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




<?php
}
?>
        


<!-- if input search null -->

<?php }  else{ ?>


    <?php 
$staffs = show(" SELECT * FROM staff ");
foreach ($staffs as $staff) {
  $id = $staff['id'];
  $name = $staff['name'];
  $manager = $staff['manager'];
  $phone = $staff['phone'];
  $note = $staff['note']; 




?>
   
<div class=" col-6 col-sm-6 col-md-4 col-lg-3  col-xl-3  text-center mt-5 mt-lg-0 p-2">
 <a href="view_staff.php?staff_id=<?=$id?>">
<div class="card " style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2) !important;">
<div class="card-body pb-2">
<h6 class="card-title"><?=$name?></h6>
<p class="card-text">بەڕێوەبەر : <?=$manager;?></p>
<p class="card-text"><?=$phone;?></p>
<?php if ($is_admin==1) {?>
<div class="d-flex justify-content-around mt-3">
<a data-toggle="modal" data-target="#edit<?=$id?>" class="dropdown-item btn mx-2  btn-danger" style="background-color:#7868E6 !important;">زیادکردنی پڕۆژە</a>
<a data-toggle="modal" data-target="#delete<?=$id?>" class="dropdown-item btn  btn-warning" style="background-color:#B68973 !important;">سڕینەوە</a>
</div>
<?php } ?>
</div>
</div>
</a> 

</div>  
   
  



  <!-- add  project  modal -->
  <div class="modal fade" id="edit<?php echo $staff['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content" style="background-color: white;border-radius: 15px;">
            <div class="modal-body text-right">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-md-3">
                        <div class="col-md-12 mb-3 mx-auto">
                            <div class="h-100">
                                <i class="fa fa-times-circle" style="float:left;color: black" data-dismiss="modal"></i>
                                <div class="card-body">
                                    <h5 class="container col-md-6 mt-3  text-center">
                                       پڕۆژە زیاد بکە
                                    </h5>
                                    <br>
                                    <form method="POST">
                                     
                                    <div class="form-group">
              <input type="hidden" placeholder="  ناو  " name="id" value="<?=$id;?> " class="form-control col-md-10 mx-auto">
            </div> 
                                     


                                        <label>ناوی پڕۆژە</label>
                                        <div class="form-group">
                                            <input type="text" name="project_name" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>بڕی پارەی وەرگیراو</label>
                                        <div class="form-group">
                                            <input type="text" name="get_price" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>بڕی پارەی خەرجکراو</label>
                                        <div class="form-group">
                                            <input type="text" name="xarjy" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>ناونیشانی پڕۆژە</label>
                                        <div class="form-group">
                                            <input type="text" name="address" class="form-control col-md-10 mx-auto" required>
                                        </div>
             
                                        

                                        <label>خاوەنی پڕۆژەکە</label>
                                        <div class="form-group">
                                        <select name="owner"  class="form-control col-md-10 mx-auto" required>
                                            <option  value="کۆمپانیا">کۆمپانیا</option>
                                            <option  value="ستاف">ستاف</option>
                                            <option  value="خاوەن کار">خاوەن کار</option>
                                        </select>
                                        </div>

                                        <label>تێبینی</label>
                                       <div class="form-group">
                                      <textarea id="my-textarea" class="form-control" name="note" rows="4"></textarea>
                                      </div>



                                        <button type="submit" name="add_project"
                                            class="btn btn-dark btn-block">زیادکردن</button>
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
<div class="modal fade" id="delete<?php echo $staff['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        دڵنیای لە سڕینەوەی ئەم کارمەندە لەناو سیستەمەکەت ؟
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




<?php
}
?>
             

       
<?php } ?>   