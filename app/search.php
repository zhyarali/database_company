<?php 
ob_start();
session_start();
require_once('../server/helper.php') ;

$output='';
$buy_type_name="";
if (isset($_POST["query"])) {
    
$search=secure($_POST['query']);

$store = show(" SELECT name_product,buy_type,cost_t,cost_fr,type,date FROM buy WHERE  `status`='1' AND type LIKE '%".$search."%' OR name_product LIKE '%".$search."%' GROUP BY type,name_product; ");
foreach ($store as $all) {
  $cost_t = $all['cost_t'];
  $cost_froshtn = $all['cost_fr'];
  $date = $all['date'];
  $name_product = $all['name_product'];
  $type = $all['type'];
  $buy_type = $all['buy_type'];

  $gettotalbuy = show("  SELECT sum(num) as 'totalbuy' FROM  buy WHERE name_product='$name_product' AND type='$type' AND  `status`='1' ");
  $totalbuy = $gettotalbuy[0]['totalbuy']; 

  $gettotalsale = show("  SELECT sum(num) as 'totalsale' FROM  sale WHERE name_product='$name_product' AND type='$type' AND `status`='1' ");
  $totalsale = $gettotalsale[0]['totalsale']; 
  $remainqty = $totalbuy-$totalsale;

  if ($buy_type=="qa3a") {
    $buy_type_name="ئەشیای ناو قاعە - ".$name_product;
}

if ($buy_type=="asn") {
    $buy_type_name="ئاسن";
}

if ($buy_type=="helka") {
    $buy_type_name="هێلکە";
}

if ($buy_type=="3alaf") {
    $buy_type_name="عەلەف";
}

$output.='
<div class=" col-6 col-sm-6 col-md-12 col-lg-3  col-xl-3  text-center mt-5 mt-lg-0 p-2">
<div class="card h-100">
<div class="card-body">
<h6 class="card-title">'.$buy_type_name.'</h6>
<p class="card-text">جۆر: '.$type.'</p>
<p class="card-text">نرخی کڕین: '.$cost_t.'</p>
<p class="card-text">نرخی فرۆشتن: '.$cost_froshtn.'</p>
<p class="btn btn-outline-dark btn-sm">ماوەی بڕ : '.$remainqty.'</p>
</div>
</div>
</div>

';

}
echo $output;
}



else
{
    $buy_type_name="";
    $store = show(" SELECT name_product,buy_type,cost_t,cost_fr,type,date FROM buy WHERE  `status`='1'  GROUP BY type,name_product; ");
    foreach ($store as $all) {
      $cost_t = $all['cost_t'];
      $cost_froshtn = $all['cost_fr'];
      $date = $all['date'];
      $name_product = $all['name_product'];
      $type = $all['type'];
      $buy_type = $all['buy_type'];
    
      $gettotalbuy = show("  SELECT sum(num) as 'totalbuy' FROM  buy WHERE name_product='$name_product' AND type='$type' AND  `status`='1' ");
      $totalbuy = $gettotalbuy[0]['totalbuy']; 
    
      $gettotalsale = show("  SELECT sum(num) as 'totalsale' FROM  sale WHERE name_product='$name_product' AND type='$type' AND `status`='1' ");
      $totalsale = $gettotalsale[0]['totalsale']; 
      $remainqty = $totalbuy-$totalsale;
      if ($buy_type=="qa3a") {
        $buy_type_name="ئەشیای ناو قاعە - ".$name_product;
    }
    
    if ($buy_type=="asn") {
        $buy_type_name="ئاسن";
    }
    
    if ($buy_type=="helka") {
        $buy_type_name="هێلکە";
    }
    
    if ($buy_type=="3alaf") {
        $buy_type_name="عەلەف";
    }


      $output.='
<div class=" col-6 col-sm-6 col-md-12 col-lg-3  col-xl-3  text-center mt-5 mt-lg-0 p-2">
<div class="card h-100">
<div class="card-body">
<h6 class="card-title">'.$buy_type_name.'</h6>
<p class="card-text">جۆر: '.$type.'</p>
<p class="card-text">نرخی کڕین: '.$cost_t.'</p>
<p class="card-text">نرخی فرۆشتن: '.$cost_froshtn.'</p>
<p class="btn btn-outline-dark btn-sm">ماوەی بڕ : '.$remainqty.'</p>
</div>
</div>
</div>

';

}
echo $output;
}
?>    









