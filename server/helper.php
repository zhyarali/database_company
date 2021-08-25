<?php 
include_once("conn.php");
function msg($title,$text=null,$type='success') 
{
?>
<script type="text/javascript">swal('<?=$title?>','<?=$text?>','<?=$type?>');</script>
<?php
}
function post($post) {
	return isset($_POST[$post]);
} 
function get($get) {
	return isset($_GET[$get]);
} 
function secure($input) 
{
global $conn;
return mysqli_real_escape_string($conn,htmlspecialchars(trim($input)));
}
function escape($input) 
{
global $conn;
return mysqli_real_escape_string($conn,$input);
}
function special($input) 
{
return htmlspecialchars($input);
}
function execute($sql) {
	global $conn;
	return mysqli_query($conn,$sql);
}
function getdata($sql) {
	global $conn;
	$get =  mysqli_query($conn,$sql);
	$result = mysqli_fetch_assoc($get);
	return $result;
}
function countdata($sql) {
	global $conn;
	$get =  mysqli_query($conn,$sql);
	$nums = mysqli_num_rows($get);
	return $nums;
}
function show($sql) {
	global $conn;
	$get =  mysqli_query($conn,$sql);
	$result=[];
	while ($row=mysqli_fetch_assoc($get)) {
		$result[]=$row;
	}
	return $result;
}
function direct($page) {
	ob_start();
	header('location:'.$page);
	exit;
}
function dnd($array){
var_dump($array);
exit();
}


function clientkill() {
unset($_SESSION['adm_id']);
unset($_SESSION['adm_token']);
}

function upload($name,$path){
    $fileName = $_FILES[$name]['name'];
    $fileSize = $_FILES[$name]['size'];
    $fileTmpName =$_FILES[$name]['tmp_name'];
    $fileType = $_FILES[$name]['type'];
    $fileExt = explode('.',$fileName);
    $fileRealExt = strtolower(end($fileExt));
    $allowed = ['jpg','png','jpeg','svg'];
if ($fileName=="")
{
  return false;
}       
else {
    if (in_array($fileRealExt,$allowed)) {
        if ($fileSize < 5000000) {
          $fileNewName = uniqid('',true).'.'.$fileRealExt;
          $uploadPath = $path.$fileNewName;
          $didupload =  move_uploaded_file($fileTmpName,$uploadPath);
        if ($didupload) {
          return $fileNewName;
        }
        else {
 return false;

        }
}
else {
return false;
}
}
else {
return false;
}
}
}

 

