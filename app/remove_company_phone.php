<?php 
include_once("../server/conn.php");


if (isset($_POST['remove_phone'])) {
  
    $id =$_POST['id'];


    execute("DELETE FROM invoice_phone WHERE id='$id' ");

    echo "success";
    
  }





  function execute($sql) {
	global $conn;
	return mysqli_query($conn,$sql);
}
  


?>