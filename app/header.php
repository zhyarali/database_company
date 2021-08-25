<?php
ob_start();
session_start();
require_once('../server/helper.php') ;
if (isset($_SESSION['adm_id']) && isset($_SESSION['adm_token'])) {
  $token =$_SESSION['adm_token'];
  $user_id = $_SESSION['adm_id'];
  }
  else {
  $token ='';
  $user_id = '';
  }
  $check = countdata(" SELECT * FROM user_tokens WHERE user_id='$user_id' AND token='$token'  ");
  if($check > 0 ) {
  $getuser = getdata(" SELECT * FROM admin WHERE id='$user_id'  ");
  $uname = $getuser['uname'];
  $username = $getuser['name'];
  }
  else {
  execute(" DELETE FROM user_tokens WHERE id='$user_id' ");
  }
  ?>
<!DOCTYPE html>
<html dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- <link rel="icon" type="image/png" href="../assets/img/favicon.png"> -->
  <title>
        Management system 
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <!-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> -->
  <link href="../assets/font-awesome/all.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
  <!-- custom css Files -->
  <link id="pagestyle" href="../assets/css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/datatables.css">
  <link rel="stylesheet" href="../assets/css/datatables.min.css">
  <script src="../assets/js/core/alert.js"></script>
 
  
</head>

<body class="g-sidenav-show">

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow bg-first border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">

      <nav aria-label="breadcrumb">
        <?php $select = show(" SELECT * FROM system ");
      foreach($select as $row) {
          $id = $row['id'];
          $name = $row['name'];

?>
          <a href="index.php" class="font-weight-bolder mb-0 text-light">  <?=$name;?> </a>

          <?php }  ?>
        </nav>
       
        <div class="collapse navbar-collapse" dir="ltr" id="navbar">
          <ul class="navbar-nav" dir="rtl" >
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="profile.php" class="nav-link text-body p-0 ">
              <img src="../assets/img/pro/team-1.jpg" width="50" class="img-fluid rounded-circle " alt="">
              <?php 
            if($check > 0 ) {
            ?>
           <span class="text-light"> <?=$username;?>  </span>
            <?php
            }
            ?>
              </a>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="logout.php" class="nav-link text-body font-weight-bold px-0">  
                <span class="d-sm-inline p-2 text-warning">چوونەدەرەوە</span>
              </a>
            </li>
              </ul>
        </div>
       
      </div>
    </nav>
    <!-- End Navbar -->
