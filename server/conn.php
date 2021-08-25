<?php 
define('server','localhost');
define('db','db');
define('user','root');
define('pass','');
$conn = mysqli_connect(server,user,pass,db);

if ($conn==true) {
return $conn;
}
else {
?><script type="text/javascript">alert('Connection Failed');</script><?php

}


?>