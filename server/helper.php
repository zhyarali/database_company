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

 


function backup($tables = '*')
{
	
	global $conn;
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysqli_query($conn,'SHOW TABLES');
		while($row = mysqli_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	$return ='';
	//cycle through
	foreach($tables as $table)
	{
		$result = mysqli_query($conn,'SELECT * FROM '.$table);
		$num_fields = mysqli_num_fields($result);
		
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysqli_fetch_row(mysqli_query($conn,'SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysqli_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j < $num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j < ($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
$user = get_current_user();
	$handle = fopen(getenv("HOMEDRIVE").getenv("HOMEPATH").'/Desktop/db-backup.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}


















function restore($filePath=null){
 if (file_exists($filePath)) {
   // Connect & select the database
global $conn;
    // Temporary variable, used to store current query
    $templine = '';
    
    // Read in entire file
    $filePath = getenv("HOMEDRIVE").getenv("HOMEPATH").'/Desktop/db-backup.sql';
    $lines = file($filePath);
    
    
    // Loop through each line
    foreach ($lines as $line){
        // Skip it if it's a comment
        if(substr($line, 0, 2) == '--' || $line == ''){
            continue;
        }
        
        // Add this line to the current segment
        $templine .= $line;
        
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';'){
            // Perform the query
            if(!mysqli_query($conn,$templine)){
return false;
            }
             $templine = '';
        }
    }
 }
 else {
return false;
 }
}
