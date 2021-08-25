<?php require_once('header.php');
if (isset($_SESSION['adm_id']) && isset($_SESSION['adm_token'])) {
$adm_id = $_SESSION['adm_id'];
$select = show(" SELECT * FROM admin WHERE id='$adm_id' ");
foreach($select as $row) {
    $id = $row['id'];
    $uname = $row['uname'];
    $name = $row['name'];
    $pass = $row['pass'];
    $avatar = $row['avatar'];

?>

<div class="container col-lg-3 col-10 col-xl-3 col-md-4 mt-5 card shadow" dir="rtl">
          <img src="../assets/img/pro/<?=$avatar;?>" alt="Yellow Developer" style="max-width:8rem;" class="img-fluid rounded-circle shadow mx-auto mt-3">
        
<form action="" method="POST"  enctype="multipart/form-data">
          <input type="hidden" name="id" required="" value="<?=$id;?>">

          <div class="mb-3 mt-5">
<input type="text" class="form-control col-md-11 mx-auto"  placeholder=" ناوی بەکارهێنەر  " name="uname" required="" value="<?=$uname;?>">
          </div>
          <div class="mb-3">
<input type="text" class="form-control col-md-11 mx-auto"  placeholder=" ناوی سیانی " name="name" value="<?=$name;?>" required="" value="">
          </div>
          <div class="mb-3">
    <input type="file" class="form-control col-md-11 mx-auto"  placeholder=" فایل  " name="avatar" value="<?=$avatar;?>">
          </div>
          <div class="mb-3 row">
<button name="chpro" class="btn btn-warning text-dark col-md-8 mx-auto"> نوێکردنەوەی زانیاری  </button>
          </div>
          <hr>
</form>
      <button class="btn btn-dark container m-auto col-md-8 mx-auto" data-toggle="modal" data-target="#pass">  گۆڕینی تێپەڕە ووشە   </button>
<br>
        </div>
<?php } } ?>

<!-- pass modal -->
  <div class="modal fade" id="pass" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-center">
         <div class="container-fluid">
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class="container  mt-3  text-center">
              گۆڕینی ووشەی نهێنی   
        </h5>
        <br>
         <form class="mt-5" dir="rtl" method="POST">
          <input type="hidden" name="id" required="" value="<?=$id;?>">
    <div class="form-group">
      <input type="password" placeholder=" پاسۆردی کۆن " class="form-control col-md-10 mx-auto"  
      required="" name="oldpass" >
    </div>
    <div class="form-group">
      <input type="password" placeholder=" پاسوۆردی نوێ  " class="form-control col-md-10 mx-auto" 
      required="" name="newpass" >
    </div>
  <br>  
    <button type="submit" name="chpass" class="btn btn-dark btn-block">  گۆڕینی پاسوۆرد </button>
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
   if (post('chpro')) {
    $id = secure($_POST['id']);
    $name = secure($_POST['name']);
    $uname = secure($_POST['uname']);
    $avatar = upload('avatar','../assets/img/pro/');
    if ($avatar!=null) {
    $get = getdata(" SELECT * FROM admin WHERE id='$id'");
    $oldavatar = $get['avatar'];
    unlink('../assets/img/pro/'.$oldavatar);
    execute(" UPDATE admin SET avatar='$avatar' WHERE id='$id'");
    }
    $sql = execute(" UPDATE admin SET name='$name' , uname='$uname' WHERE id = '$id'");
    direct("profile.php");
}
if (post('chpass')) {
  $id = secure($_POST['id']);
  $oldpass = secure(md5($_POST['oldpass']));
  $newpass = secure(md5($_POST['newpass']));

$check = countdata(" SELECT * FROM admin WHERE pass='$oldpass' ");
if ($check == 0 ) {
  msg(' ناتوانی  گۆڕان بکەیت','ووشە نهێنی کۆنت هەڵەیە','warning');

  }
  else {
  execute(" UPDATE admin SET pass='$newpass' WHERE id='$id' ");
  direct('profile.php');
}
}
  
  ?>



<?php require_once('footer.php'); ?>