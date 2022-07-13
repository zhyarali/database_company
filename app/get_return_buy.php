<?php

ob_start();
session_start();
require_once('../server/helper.php') ;
$user_id = $_SESSION['adm_id'];
$getuser = getdata(" SELECT * FROM admin WHERE id='$user_id'");
   $is_admin = $getuser['type'];


if (post('user_id')) {
    echo "hahahhahaha";
}



   ?>