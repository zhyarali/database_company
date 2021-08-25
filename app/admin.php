<?php require_once('header.php'); ?>
<div class="container-fluid mt-5">
<div class="row col-md-10 m-auto" >
  <button class="btn btn-success mb-2 container col-md-2 s-20" data-toggle="modal" data-target="#add"> زیادکردن  <i class="fas fa-user-plus s-20"></i></button>


 <div class="table-responsive">
<table id="example" class="table  table-striped table-bordered  text-center" dir="rtl">
        <thead  style="background-color: #0a0327;color: white">
            <tr>
                  <th>  وێنە   </th>
                <th> ناوی بەکارهێنەر    </th>
                <th> ناوی سیانی    </th>
                <th>  جۆر   </th>
                <th> Action      </th>
            </tr>
        </thead>
        <tbody>
<?php 
$users = show(" SELECT * FROM admin ");
foreach ($users as $u) {
  $id = $u['id'];
  $uname = $u['uname'];
  $name = $u['name'];
  $type = $u['type'];
  $avatar = $u['avatar'];
?>
       <tr>
       <td> <img src="../assets/img/pro/<?=$avatar;?>" class="img-fluid rounded-circle shadow" width="50" alt=""> </td>
        <td><?=$uname;?></td>
        <td><?=$name;?></td>
        <td>
           

<?php 
if($type == "1") {
?>
     بەڕێوەبەری گشتی
      <?php
}
     ?>

<?php 
if($type == "0") {
?>
     مۆدیرەیت
      <?php
}
     ?>

              
      </td>
        <td>
        <button class="btn btn-danger text-light delbtn btn-sm" data-toggle="modal" data-target="#delete<?php echo $u['id'] ?>" >
        <i class="fa fa-trash s-14"></i>
        </button>          
        <button class="btn btn-warning text-dark delbtn btn-sm" data-toggle="modal" data-target="#edit<?php echo $u['id'] ?>" >
        <i class="fa fa-edit s-14"></i>
        </button>          
        </td>
      </tr>
      
<!-- delete modal -->
  <div class="modal fade" id="delete<?php echo $u['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        دڵنیای لە سڕینەوەی ئەم ئەکاونتە لەناو سیستەمەکەت ؟
        </h5>
        <br>
         <form dir="rtl" method="POST">
         <div class="form-group">
              <input type="hidden" placeholder="  ناو  " name="id" value="<?=$id;?> " class="form-control col-md-10 mx-auto">
            </div> 
            <div class="form-group">
              <input type="text" placeholder="  ناو  " name="name" value="<?=$name;?> " class="form-control col-md-10 mx-auto">
            </div>  
    <button type="submit" name="deluser" class="btn btn-danger btn-block">  سڕینەوە  </button>
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



      <!-- Edit modal -->
      <div class="modal fade" id="edit<?php echo $u['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-center">
         <div class="container-fluid">
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class="container col-md-6 mt-3  text-center">
       دڵنیای ئەتەوێ جۆری ئەم ئەکاونتە بگۆڕیت ؟
        </h5>
        <br>
         <form class="mt-5" dir="rtl" method="POST">
          <input type="hidden" value="<?=$id;?> " name="id" required="">
    <div class="form-group">
     ناوی بەکارهێنەر
      <input type="text" placeholder="uname " class="form-control col-md-10 mx-auto" name="uname" value="<?=$name;?> " readonly  required="">
    </div>
    <button type="submit" name="edituser"  class="btn btn-warning btn-block"> گۆڕین بۆ مۆدیرەیت   </button>
    <button type="submit" name="edituserr"  class="btn btn-success btn-block"> گۆڕین بۆ بەڕێوبەری گشتی   </button>
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
       



  <!-- Add modal -->
  <div class="modal fade" id="add" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        زیادکردنی ئەدمینی نوێ
        </h5>
        <br>
         <form class="mt-5" dir="rtl" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <input type="text" placeholder=" ناوی بەکاهێنەر  " class="form-control col-md-10 mx-auto" name="uname" required="">
    </div>
    <div class="form-group">
      <input type="text" placeholder="ناو " class="form-control col-md-10 mx-auto" name="name" required="">
    </div>
    
    <div class="form-group">
      <input type="password" name="pass" placeholder=" پاسوۆرد " class="form-control col-md-10 mx-auto"  required="">
    </div>
    <div class="form-group">
      <input type="file" name="avatar" placeholder=" img " class="form-control col-md-10 mx-auto"  required="">
    </div>
  <br>  
    <button type="submit" name="adduser"  class="btn btn-success btn-block s-20">
    <i class="fal fa-user-plus s-20"></i>    
    زیادکردن  </button>
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

if (post('adduser')) {
  $name = secure($_POST['name']);
  $uname = secure($_POST['uname']);
  $pass = md5(secure($_POST['pass']));
  $avatar = upload('avatar','../assets/img/pro/');
  execute(" INSERT INTO admin(uname,name,pass,type,avatar) VALUES('$uname','$name','$pass','1','$avatar') ");
  direct('admin.php');
}



if (post('edituser')) {
    $id = secure($_POST['id']);
    $uname = secure($_POST['uname']);
    $sql = execute("UPDATE `admin` SET type='0' WHERE id = '$id'");
    direct("admin.php");
}


if (post('edituserr')) {
    $id = secure($_POST['id']);
    $uname = secure($_POST['uname']);
    $sql = execute("UPDATE `admin` SET type='1' WHERE id = '$id'");
    direct("admin.php");
}


if (post('deluser')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM admin WHERE id = '$id'");
    direct("admin.php");
}

?>
<?php require_once('footer.php'); ?>