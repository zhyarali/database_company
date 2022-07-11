<?php require_once('header.php'); ?>


<div class="container-fluid mt-4">
<button onclick="window.history.back()" class="btn btn-sm btn-info shadow" >
 <span class="fa fa-arrow-right"></span>
 گەڕانەوە
  </button>
</div>

<?php if ($is_admin==1) {?>
<div class="container d-flex justify-content-center mt-2">
<a data-toggle="modal" data-target="#add" style="font-size:16px"  class="btn btn-success " ><i class="fas fa-user-plus "></i>  زیادکردنی ستاف</a>
</div>
<?php } ?>


<div class="container-fluid ">
<div class="row d-flex justify-content-center">
<div class="form-group col-10 col-lg-3 col-md-8">
    <input type="text" id="search" class="form-control " placeholder="بگەڕی بۆ ناوی ستاف ...">
</div>

 
</div>    
<div class="row d-flex justify-content-center" id="result">


<?php 
$staffs = show(" SELECT * FROM staff ");
foreach ($staffs as $staff) {
  $id = $staff['id'];
  $name = $staff['name'];
  $manager = $staff['manager'];
  $phone = $staff['phone'];
  $note = $staff['note']; 
  $currency_type= $staff['currency_type']; 

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
   
<div class=" col-6 col-sm-6 col-md-4 col-lg-3  col-xl-3  text-center mt-5 mt-lg-0 p-2">
 <a href="view_staff.php?staff_id=<?=$id?>">
<div class="card " style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2) !important;">
<div class="card-body pb-2">
<h6 class="card-title"><?=$name?></h6>
<p class="card-text">بەڕێوەبەر : <?=$manager;?></p>
<p class="card-text"><?=$phone;?></p>
<p class="card-text">جۆری دراو : <?=$currency_type;?></p>

<?php if ($is_admin==1) {?>
<div class="d-flex justify-content-around mt-3">
<a data-toggle="modal" data-target="#edit<?=$id?>" class="dropdown-item btn mx-2  btn-danger" style="background-color:#7868E6 !important;">زیادکردنی پڕۆژە</a>
<a data-toggle="modal" data-target="#delete<?=$id?>" class="dropdown-item btn  btn-warning" style="background-color:#A6A9B6 !important;">سڕینەوە</a>
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

                                        <label>بڕی نرخی پڕۆژە</label>
                                        <div class="form-group">
                                            <input type="number" name="cost_project" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>نرخی تاک</label>
                                        <div class="form-group">
                                            <input type="number" name="cost_fixed" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>نرخی کۆ</label>
                                        <div class="form-group">
                                            <input type="number" name="cost_total" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>بڕی پارەی وەرگیراو</label>
                                        <div class="form-group">
                                            <input type="number" name="get_price" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>بڕی پارەی خەرجکراو</label>
                                        <div class="form-group">
                                            <input type="number" name="xarjy" class="form-control col-md-10 mx-auto" required>
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
        


 </div>

</div>









<!-- add  modal -->
<div class="modal fade" id="add" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-right">
         <div class="container-fluid"> 
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class="container col-md-6 mt-3  text-center">
             ستاف زیاد بکە
        </h5>
        <br>
        <form method="POST" enctype="multipart/form-data">
         
                <label>ناوی ستاف</label>
                <div class="form-group">
                <input type="text"   name="name"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ناوی بەڕێوەبەر</label>
                <div class="form-group">
                <input type="text"   name="manager"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ژمارە مۆبایل</label>
                <div class="form-group">
                <input type="text"  name="phone"   class="form-control col-md-10 mx-auto">
                </div> 

                <div class="form-group">
                  <label for="" class="float-end">جۆری دراو</label>
                 <select name="currency_type"  class="form-control col-md-10 mx-auto"> 
                  <option value="dinar">دینار</option>
                  <option value="dollar">دۆلار</option>
                  <option value="tman">تمەن</option>
              </select>
               </div>

                <label>تێبینی</label>
                <div class="form-group">
                 <textarea id="my-textarea" class="form-control" name="note" rows="4"></textarea>
                </div>
            
                
            
    <button type="submit" name="add" class="btn btn-success btn-block">زیادکردنی ستاف</button>
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


if (post('del')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM staff WHERE id = '$id'");
    $_SESSION["delete"] = "";
    direct('staff.php');
}

if (post('add')) {
  $name = secure($_POST['name']);
  $manager = secure($_POST['manager']);
  $phone = secure($_POST['phone']);
  $note = secure($_POST['note']);
  $currency_type = secure($_POST['currency_type']);

  $sql = execute("INSERT INTO `staff` (`name`,`manager`,`phone`,`note`,`currency_type`) VALUES('$name','$manager','$phone','$note','$currency_type')");
    $_SESSION["add_success"] = "";
   direct('staff.php');

}




// add project

if (post('add_project')) {

  $id = secure($_POST['id']);
  $name = secure($_POST['project_name']);

  $cost_project = secure($_POST['cost_project']);
  $cost_fixed = secure($_POST['cost_fixed']);
  $cost_total = secure($_POST['cost_total']);

  $get_price = secure($_POST['get_price']);
  $xarjy = secure($_POST['xarjy']);
  $date =date('Y-m-d');
  $address = secure($_POST['address']);
  $owner = secure($_POST['owner']);
  $note = secure($_POST['note']);

$sql = execute("INSERT INTO `staff_work` (`name`,`cost_project`,`cost_fixed`,`cost_total`,`get_price`,`xarjy`,`date`,`address`,`owner`,`note`,`staff_id`) VALUES('$name','$cost_project','$cost_fixed','$cost_total','$get_price','$xarjy','$date','$address','$owner','$note','$id')");

$_SESSION["add_success"] = "";
  $loc="staff.php";
 direct($loc);

}



?>
<?php require_once('footer.php'); ?>




<script>
$(document).ready(function(){

  function load_data(search)
 {
  $.ajax({
   url:"search_staff.php",
   method:"POST",
   data:{staff_search:search},
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