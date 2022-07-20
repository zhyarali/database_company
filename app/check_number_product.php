<?php

include_once("../server/conn.php");

if (isset($_POST['sale_helka'])) {

    $qty=(int)$_POST['qty'];
    $name_product="هێلکە";
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