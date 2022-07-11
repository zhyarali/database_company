<?php require_once('../server/helper.php');
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
        Management system 
  </title>
 
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/font-awesome/all.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
  <!-- custom css Files -->
  <link id="pagestyle" href="../assets/css/style.css" rel="stylesheet" />
  <script src="../assets/js/core/alert.js"></script>
        
</head> 
<body class="bg-dark" >
<div class="container card col-lg-3 col-10 col-xl-3 col-md-4" style="border-radius: 25px;margin-top:2%">
<?php $select = show(" SELECT * FROM system ");
      foreach($select as $row) {
          $id = $row['id'];
          $name = $row['name'];
          $avatar = $row['avatar'];

?>
     <img src="../assets/img/system/<?=$avatar;?>" class="card-img p-3" >
     <div class="container">
      <h5 class="text-center mb-2" style="color: #2c5982;">
      <?=$name;?>
      </h5>
      <?php } ?>
      <form action="" method="POST" dir="rtl">
            <div class="input-group mb-3">
              <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="ناوی بەکارهێنەر" name="uname" required="">
            </div>

            <div class="input-group mb-3">
              <input type="password" name="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder=" تێپەڕە ووشە" required="">
            </div>

            <div class="container ">
                <button type="submit" name="login" class="btn d-flex m-auto text-light" style="border-radius:5px;background-color: #2c5982;">
                  چوونەژوورەوە
                </button>
                <p class="text-center text-muted mt-3" style="font-size: 8pt">All right resived 2021 <a href="https://www.facebook.com/zarda.dev.5/"> &copy; Yellow developer - TiyaPro</a></p>
            </div>
         </form>
    </div>
</div>


<?php
if (post('login')) {
$uname = secure($_POST['uname']);
$password = md5(secure($_POST['password']));
$sql = " SELECT * FROM admin WHERE uname='$uname' AND pass='$password' ";
$check = countdata($sql);
if ($check > 0 ) {
$get = getdata($sql);
$id = $get['id'];
$token = md5($password).uniqid().password_hash($password,PASSWORD_DEFAULT);
$username = $get['username'];
$_SESSION['adm_id']=$id;
$_SESSION['adm_token']=$token;
$token = $_SESSION['adm_token']=uniqid(md5(random_bytes(4)));
if ($token==true) {
execute(" DELETE FROM user_tokens WHERE id='$id' ");
execute(" INSERT INTO user_tokens(user_id,token) VALUES('$id','$token'); ");
direct('index.php');
}
else {
msg('Authentication','Invalid Session Token ! ','warning');
}
	}
	else {
		msg(' ناتوانی چوونەژوورەوە بکەیت','ووشە نهێنیت ، یان پاسوۆردەکەت هەڵەیە ، تکایە هەوڵبدەوە','warning');
	}
}
