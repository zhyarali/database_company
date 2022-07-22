<?php

include_once("../server/conn.php");



if (isset($_POST['asn_count'])) {
    $type=$_POST['type'];

    $gettotalbuy = show("  SELECT sum(num) as 'totalbuy' FROM  buy WHERE   type='$type' AND buy_type='asn' AND `status`='1' ");
    $totalbuy = $gettotalbuy[0]['totalbuy']; 
  
    $gettotalsale = show("  SELECT sum(num) as 'totalsale' FROM  sale WHERE  type='$type' AND sale_type='asn' AND `status`='1' ");
    $totalsale = $gettotalsale[0]['totalsale']; 
    $remainqty = $totalbuy-$totalsale;

 if (empty($remainqty)) {
    echo "false";
 } else{
    if ($remainqty<0){
        echo "0";
    } 
    else{
           echo $remainqty;
   
    }
 }


}





if (isset($_POST['halaf_count'])) {
    $type=$_POST['type'];

    $gettotalbuy = show("  SELECT sum(num) as 'totalbuy' FROM  buy WHERE   type='$type' AND buy_type='3alaf' AND `status`='1' ");
    $totalbuy = $gettotalbuy[0]['totalbuy']; 
  
    $gettotalsale = show("  SELECT sum(num) as 'totalsale' FROM  sale WHERE  type='$type' AND sale_type='3alaf' AND `status`='1' ");
    $totalsale = $gettotalsale[0]['totalsale']; 
    $remainqty = $totalbuy-$totalsale;

 if (empty($remainqty)) {
    echo "false";
 } else{
    if ($remainqty<0){
        echo "0";
    } 
    else{
           echo $remainqty;
   
    }
 }


}




if (isset($_POST['helka_count'])) {
    $type=$_POST['type'];

    $gettotalbuy = show("  SELECT sum(num) as 'totalbuy' FROM  buy WHERE   type='$type' AND buy_type='helka' AND `status`='1' ");
    $totalbuy = $gettotalbuy[0]['totalbuy']; 
  
    $gettotalsale = show("  SELECT sum(num) as 'totalsale' FROM  sale WHERE  type='$type' AND sale_type='helka' AND `status`='1' ");
    $totalsale = $gettotalsale[0]['totalsale']; 
    $remainqty = $totalbuy-$totalsale;

 if (empty($remainqty)) {
    echo "false";
 } else{
    if ($remainqty<0){
        echo "0";
    } 
    else{
           echo $remainqty;
   
    }
 }


}










if (isset($_POST['sale_helka'])) {

    $qty=(int)$_POST['qty'];
    $name_product="هێلکە";
    $type=$_POST['type'];

 

   

    $gettotalbuy = show("  SELECT sum(num) as 'totalbuy' FROM  buy WHERE   type='$type' AND  `status`='1' ");
    $totalbuy = $gettotalbuy[0]['totalbuy']; 
  
    $gettotalsale = show("  SELECT sum(num) as 'totalsale' FROM  sale WHERE  type='$type' AND `status`='1' ");
    $totalsale = $gettotalsale[0]['totalsale']; 
    $remainqty = $totalbuy-$totalsale;

 if (empty($remainqty)) {
    echo "false";
 } else{
    if ($remainqty<0){
        echo "0";
    } 
    else{
   
   
       if($qty > $remainqty) {
           echo $remainqty;
        }
   
    }
 }
 


}


// sale asn


if (isset($_POST['sale_asn'])) {

    $qty=(int)$_POST['qty'];
    $name_product="ئاسن";
    $type=$_POST['type'];

 

   

    $gettotalbuy = show("  SELECT sum(num) as 'totalbuy' FROM  buy WHERE name_product='$name_product' AND type='$type' AND  `status`='1' ");
    $totalbuy = $gettotalbuy[0]['totalbuy']; 
  
    $gettotalsale = show("  SELECT sum(num) as 'totalsale' FROM  sale WHERE name_product='$name_product' AND type='$type' AND `status`='1' ");
    $totalsale = $gettotalsale[0]['totalsale']; 
    $remainqty = $totalbuy-$totalsale;

 if (empty($remainqty)) {
    echo "ئەم جۆرە لە مەغزەن بوونی نییە دەتەوێ زیادی بکەی ؟";
 }  else{


    if($qty > $remainqty) {
        echo 'ئەوەندە بڕ لەم کاڵەیە بەردەست نیە بڕەکەی لە مەغزەن بریتییە لە : '.$remainqty;
       }else{
           echo "success";
       }

 } 

}


// sale 3alaf


if (isset($_POST['sale_3alaf'])) {

    $qty=(int)$_POST['qty'];
    $name_product="عەلەف";
    $type=$_POST['type'];

 

   

    $gettotalbuy = show("  SELECT sum(num) as 'totalbuy' FROM  buy WHERE name_product='$name_product' AND type='$type' AND  `status`='1' ");
    $totalbuy = $gettotalbuy[0]['totalbuy']; 
  
    $gettotalsale = show("  SELECT sum(num) as 'totalsale' FROM  sale WHERE name_product='$name_product' AND type='$type' AND `status`='1' ");
    $totalsale = $gettotalsale[0]['totalsale']; 
    $remainqty = $totalbuy-$totalsale;

 if (empty($remainqty)) {
    echo "ئەم جۆرە لە مەغزەن بوونی نییە دەتەوێ زیادی بکەی ؟";
 }  else{


    if($qty > $remainqty) {
        echo 'ئەوەندە بڕ لەم کاڵەیە بەردەست نیە بڕەکەی لە مەغزەن بریتییە لە : '.$remainqty;
       }else{
           echo "success";
       }

 } 

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


?>