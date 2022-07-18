<?php 



if (isset($_GET['type'])) {

    $type=$_GET['type'];
    
    if ($type=="buy_helka") {
        include('buy_helka.php');
    }

}else{
    header("Location:index.php");
}




?>