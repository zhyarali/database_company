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
$staff_id=$_GET['staff_id'];
$data = show(" SELECT * FROM staff WHERE `id`=$staff_id");

if (empty($data)) {
  direct('index.php');
}else{

foreach ($data as $staff) {
    $id = $staff['id'];
    $name = $staff['name'];
    $manager = $staff['manager'];
    $phone = $staff['phone'];
    $note = $staff['note']; 
    $currency_type = $staff['currency_type']; 

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

 

<div class="container-fluid  mt-3 d-flex justify-content-center">
<form method="post" action="view_report.php">
    
    <input type="hidden" name="staff_id" value="<?=$staff_id?>">
    
         <button type="submit" class="btn btn-dark" name="staff_info" style="border:none;" > <i class="fas fa-print"></i> پرنتکردن</button>
    
      </form> 
</div>


<div class="container d-flex justify-content-center">
<div class=" col-10 col-sm-6 col-md-4 col-lg-3  col-xl-4  text-center mt-5 mt-lg-0 p-2">

<div class="card  d-flex" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2) !important;">
    <div class="card-body pb-2">
    <h6 class="card-title"><?=$name?></h6>
    <p class="card-text">بەڕێوەبەر : <?=$manager;?></p>
    <p class="card-text"><?=$phone;?></p>
    <p class="card-text text-sm"><strong>تێبینی : </strong><?=$note;?> </p>
    </div>

<?php if ($is_admin==1) {?>
<div class="mt-4 ">
<a data-toggle="modal" data-target="#edit_info<?=$id?>" class="btn btn-sm  btn-success">گۆڕانکاری لە زانیاری کارمەند</a>

<a data-toggle="modal" data-target="#edit<?=$id?>" class=" btn  btn-sm btn-danger" style="background-color:#7868E6 !important;">زیادکردنی پڕۆژە</a>
</div>
<?php } ?>

</div>



    </div>
</div>


<div class="container-fluid mt-2 d-flex flex-wrap">

    <!-- <div onclick="window.print()"><i class="fas fa-print fa-2x"></i> پرنتکردن</div> -->

    <div class="modal fade" id="edit_info<?=$id?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-right">
         <div class="container-fluid">
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class="container  mt-3  text-center">
               گۆڕانکاری بکە لەزانیارییەکان
        </h5>
        <br>
        <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
              <input type="hidden" placeholder="  ناو  " name="id" value="<?=$id;?>" class="form-control col-md-10 mx-auto">
            </div> 
                     
                         
                <label>ناوی ستاف</label>
                <div class="form-group">
                <input type="text"   name="name" value="<?=$name?>"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ناوی بەڕێوەبەر</label>
                <div class="form-group">
                <input type="text"   name="manager" value="<?=$manager?>" class="form-control col-md-10 mx-auto">
                </div> 

                <label>ژمارە مۆبایل</label>
                <div class="form-group">
                <input type="text"  name="phone" value="<?=$phone?>"   class="form-control col-md-10 mx-auto">
                </div> 

                <div class="form-group">
                    <select name="currency_type"  class="form-control col-md-10 mx-auto"> 
                        <option value="dinar"  <?php echo $currency_type=='دینار' ? 'selected' : '' ?> >دینار</option>
                        <option value="dollar" <?php echo $currency_type=='دۆلار' ? 'selected' : '' ?>>دۆلار</option>
                        <option value="tman"   <?php echo $currency_type=='تمەن' ? 'selected' : '' ?>>تمەن</option>
                    </select>
                    </div>

                <label>تێبینی</label>
                <div class="form-group">
                 <textarea id="my-textarea" class="form-control" name="note" rows="4"><?=$note?></textarea>
                </div>
            
                
            
    <button type="submit" name="edit_staff" class="btn btn-dark btn-block">نوێکردنەوەی زانیارییەکان</button>
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





  <!-- add project -->

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


  
  <div class="row col-lg-12 col-12 m-auto p-4 table-responsive" style="zoom:70%">

<table class="table table-bordered text-center">
    <!-- <caption>List of users</caption> -->
    <thead>
        <tr>
            <th scope="col">بەروار</th>
            <th scope="col">ناوی پڕۆژە</th>
            <th scope="col">بڕی نرخی پڕۆژە</th>
            <th scope="col">نرخی تاک</th>
            <th scope="col">کۆی گشتی نرخ</th>
            <th scope="col">پارەی وەرگیراو</th>
            <th scope="col">پارەی خەرجکراو</th>
            <th scope="col">پارەی ماوە</th>
            <th scope="col">ناونیشان</th>
            <th scope="col">خاوەن پڕۆژە</th>
            <th>جۆری دراو</th>
            <th scope="col">تێبینی</th>
            <th scope="col">Action</th>


        </tr>
    </thead>
    <tbody>
        <?php
$projects=show("SELECT * FROM staff_work WHERE staff_id=$staff_id ");

foreach ($projects as $project) {
$project_id=$project['id'];
    $project_name=$project['name'];

    $cost_project=$project['cost_project'];
    $cost_fixed=$project['cost_fixed'];
    $cost_total=$project['cost_total'];
    $get_price=$project['get_price'];
    $xarjy=$project['xarjy'];
    $date=$project['date'];
    $address=$project['address'];
    $owner=$project['owner'];
    $note=$project['note'];

    $cost_mawa=$cost_total-$get_price;
?>
        <tr>
            <td><?=$date?></td>
            <td><?=$project_name?></td>
            <td><?=$cost_project?></td>
            <td><?=$cost_fixed?></td>
            <td><?=$cost_total?></td>
            <td><?=$get_price?></td>
            <td><?=$xarjy?></td>
            <td><?=$cost_mawa?></td>
            <td><?=$address?></td>
            <td><?=$owner?></td>
            <td><?=$currency_type;?></td>
            <td style="max-width:320px;width:320px;overflow:hidden;word-wrap: break-word;overflow-wrap: break-word;white-space: pre-wrap;"><?=$note;?></td>
            <td class="d-flex justify-content-around">

            <?php if ($is_admin==1) {?>
                <i class="fa fa-edit  s-20 cursor" style="color:#14cd7c" data-toggle="modal"
                    data-target="#edit<?php echo $project['id'] ?>"></i>
                <i class="fa fa-trash text-dark s-20 cursor" data-toggle="modal"
                    data-target="#del<?php echo $project['id'] ?>"></i>
            <?php } ?>
                <form method="post" action="view_report.php">
                    <input type="hidden" name="staff_id" value="<?=$staff_id?>">
                    <input type="hidden" name="project_id" value="<?=$project_id?>">

                <button type="submit" name="staff_info" style="border:none;background:none" > <i style="color:#7868E6" class="fas fa-print s-20"></i> </button>

                </form>  
            </td>
        </tr>


        <!-- edit modal -->
        <div class="modal fade" id="edit<?php echo $project['id'] ?>" tabindex="-1" role="dialog"
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
              <input type="hidden" placeholder="  ناو  " name="id" value="<?=$id;?>" class="form-control col-md-10 mx-auto">
            </div> 
                                     


                                        <label>ناوی پڕۆژە</label>
                                        <div class="form-group">
                                            <input type="text" name="project_name" value="<?=$project_name;?>"  class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>بڕی نرخی پڕۆژە</label>
                                        <div class="form-group">
                                            <input type="number" value="<?=$cost_project;?>" name="cost_project" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>نرخی تاک</label>
                                        <div class="form-group">
                                            <input type="number" value="<?=$cost_fixed;?>" name="cost_fixed" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>نرخی کۆ</label>
                                        <div class="form-group">
                                            <input type="number" value="<?=$cost_total;?>" name="cost_total" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>بڕی پارەی وەرگیراو</label>
                                        <div class="form-group">
                                            <input type="text" name="get_price" value="<?=$get_price;?>"  class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>بڕی پارەی خەرجکراو</label>
                                        <div class="form-group">
                                            <input type="text" name="xarjy" value="<?=$xarjy;?>"  class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>ناونیشانی پڕۆژە</label>
                                        <div class="form-group">
                                            <input type="text" name="address" value="<?=$address;?>"  class="form-control col-md-10 mx-auto" required>
                                        </div>
             
                                        

                                        <label>خاوەنی پڕۆژەکە</label>
                                        <div class="form-group">
                                        <select name="owner"  class="form-control col-md-10 mx-auto" required>
                                            <option <?php if($owner=="کۆمپانیا") echo 'selected="selected"'; ?>   value="کۆمپانیا">کۆمپانیا</option>
                                            <option <?php if($owner=="ستاف") echo 'selected="selected"'; ?>   value="ستاف">ستاف</option>
                                            <option <?php if($owner=="خاوەن کار") echo 'selected="selected"'; ?>   value="خاوەن کار">خاوەن کار</option>
                                        </select>
                                        </div>

                                        <label>تێبینی</label>
                                       <div class="form-group">
                                      <textarea id="my-textarea" class="form-control" name="note" rows="4"><?=$note;?></textarea>
                                      </div>

                                                <button type="submit" name="edit_project"
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
        <div class="modal fade" id="del<?php echo $project['id'] ?>" tabindex="-1" role="dialog"
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
                                                        value="<?=$project_id;?>"
                                                        class="form-control col-md-10 mx-auto">
                                                </div>
                                                <!-- <div class="form-group">
      <input type="text" placeholder="  ناو  " name="name" value="<?=$name;?> " class="form-control col-md-10 mx-auto">
    </div>   -->
                                                <button type="submit" name="delete_project"
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
  $loc="view_staff.php?staff_id=".$id;
  direct($loc);
  }



// edit project 
if (post('edit_project')) {

    $id = secure($_POST['id']);
    $name = secure($_POST['project_name']);

    $cost_project = secure($_POST['cost_project']);
    $cost_fixed = secure($_POST['cost_fixed']);
    $cost_total = secure($_POST['cost_total']);

    $get_price = secure($_POST['get_price']);
    $xarjy = secure($_POST['xarjy']);
    $address = secure($_POST['address']);
    $owner = secure($_POST['owner']);
    $note = secure($_POST['note']);
  
  $sql = execute("UPDATE `staff_work` SET `name`='$name',`cost_project`='$cost_project',`cost_fixed`='$cost_fixed',`cost_total`='$cost_total',`get_price`='$get_price',`xarjy`='$xarjy',`address`='$address',`owner`='$owner',`note`='$note' WHERE `staff_id`='$id'");
  

  $_SESSION["add_success"] = "";
  $loc="view_staff.php?staff_id=".$id;
  direct($loc);
  
  }



//   delete project
if (post('delete_project')) {
    $staff_id=$_GET['staff_id'];
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM staff_work WHERE id= '$id'");
    $_SESSION["delete"] = "";
    $loc="view_staff.php?staff_id=".$staff_id;
    direct($loc);
    
}



// edit staff
if (post('edit_staff')) {
    $id = secure($_POST['id']);
    $name = secure($_POST['name']);
    $manager = secure($_POST['manager']);
    $phone = secure($_POST['phone']);
    $note = secure($_POST['note']);
    $currency_type = secure($_POST['currency_type']);
  
    $sql = execute("UPDATE  `staff` SET `name`='$name',`manager`='$manager',`phone`='$phone',`note`='$note',`currency_type`='$currency_type' WHERE id='$id'");
      $_SESSION["add_success"] = "";
      $loc="view_staff.php?staff_id=".$id;
      direct($loc);
  
  }

?>
