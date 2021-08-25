<?php require_once('header.php'); ?>



<div class="container-fluid mt-4">
  <button onclick="window.history.back()" class="btn btn-sm btn-info shadow">
    <span class="fa fa-arrow-right"></span>
    گەڕانەوە
  </button>
</div>

<div class="container d-flex justify-content-around mt-2 flex-wrap">
  <div onclick="window.print()" class="btn  btn-dark "><i class="fas fa-print" style="font-size:18px"></i> پرنتکردن
  </div>
</div>


<div class="container">
  
<div class="row d-flex justify-content-center">
<div class="form-group col-10 col-lg-4 col-md-8">
    <input type="text" id="search" class="form-control " placeholder="بگەڕێ بۆ ناوی شتوومەک ، جۆر ">
</div>

 
</div>    

  <div class="row d-flex justify-content-center" id="result">

  <?php 
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
?>
<div class=" col-6 col-sm-6 col-md-4 col-lg-3  col-xl-3  text-center mt-5 mt-lg-0 p-2">
<div class="card h-100">
<div class="card-body">
<h6 class="card-title"> <?php $buy_type_name='';if ($buy_type=="qa3a") {echo 'ئەشیای ناو قاعە - ';echo $name_product;}if ($buy_type=="asn") {echo 'ئاسن';}if ($buy_type=="helka") {echo 'هێلکە';}if ($buy_type=="3alaf") {echo 'عەلەف';}?></h6>
<p class="card-text">جۆر: <?=$type;?></p>
<p class="card-text">نرخی کڕین: <?=$cost_t;?></p>
<p class="card-text">نرخی فرۆشتن: <?=$cost_froshtn;?></p>
<p class="btn btn-outline-dark btn-sm">ماوەی بڕ : <?=$remainqty;?></p>
</div>
</div>
</div>
<?php
}
?>    

  </div>
</div>



<?php require_once('footer.php'); ?>



<script>
$(document).ready(function(){

  function load_data(query)
 {
  $.ajax({
   url:"search.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }



    $('#search').on("keyup input", function(){
        /* Get input value on change */
        var search = $(this).val();
        var result = $("#result");
         if(search != '')
        {
          load_data(search);
         }
       else
      {
       load_data();
      }
    });
    
    
});
</script>
