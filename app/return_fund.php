<?php 
require_once('header.php'); 
$user_id=$_GET['id'];

$users = countdata(" SELECT * FROM dealers WHERE `id`=$user_id");
$data = show(" SELECT * FROM dealers WHERE `id`=$user_id");


if (empty($data)) {
  direct('index.php');
}else{ 


?>




<style>
    .table tbody tr:last-child td {
  border-width: 1px !important;
}
.table{
    border-radius:10px !important;
}
.table th{
    /* background:red !important; */
    /* font-size:12px !important; */
}
</style>


<div class="container-fluid mt-4">
<button onclick="window.history.back()" class="btn btn-sm btn-info shadow" >
 <span class="fa fa-arrow-right"></span>
 گەڕانەوە
  </button>
</div>


<div class="container-fluid  mt-2 d-flex justify-content-around">
    <a  class="btn  btn-success s-16">گێڕانەوەی قەرزی کۆمپانیا</a>
</div>

<div class="container-fluid  mt-2 d-flex justify-content-around">
    <form method="post" action="view_report.php">
            <input type="hidden" name="user_id" value="<?=$user_id?>">
            <button type="submit" class="btn btn-dark" name="refund_info" style="border:none;" > <i class="fas fa-print"></i> پرنتکردن</button>
    </form> 
</div>


<div class="container-fluid mt-2">


<div class="row col-lg-12 col-12 m-auto p-4 table-responsive">

<table class="table table-bordered text-center">
<thead>
    <tr>
      <th scope="col">ناوی فرۆشیار</th>
      <th scope="col">بڕی پارەی واسڵکراو</th>
      <th scope="col">جۆری دراو</th>
      <th scope="col">جۆری واسڵکردن</th>
      <th scope="col">بەروار</th>
      <th scope="col">پرنتکردن</th>
    </tr>
</thead>    

<tbody>
<?php
        $refunds=show("SELECT * FROM refund WHERE dealer_id=$user_id");
        foreach ($refunds as $refund) {
            $refund_id=$refund['id'];
            $dealer_id=$refund['dealer_id'];
            $price=$refund['price'];
            $date=$refund['date'];
            $refund_type=$refund['refund_type'];

            if ($refund_type=='cash') {$refund_type="کاش";}
            if ($refund_type=='7awala') {$refund_type="حەواڵە";}

            $dealer=getdata("SELECT * FROM dealers WHERE id=$dealer_id");
            $dealer_name=$dealer['name'];
            $currency_type = $dealer['currency_type']; 
     
            if ($currency_type=='dinar') {$currency_type='دینار';}
            if ($currency_type=='dollar') {$currency_type='دۆلار';}
            if ($currency_type=='tman') {$currency_type='تمەن';}
            

            ?>
  <tr>

            <td><?=$dealer_name;?></td>
            <td><?=$price;?></td>
            <td><?=$currency_type;?></td>
            <td><?=$refund_type;?></td>
            <td><?=$date;?></td>

      <td>
        <form method="post" action="view_report.php">
            <input type="hidden" name="user_id" value="<?=$user_id?>">
            <input type="hidden" name="refund_id" value="<?=$refund_id?>">
            <button type="submit" name="refund_info" style="border:none;background:none" > <i class="fas fa-print text-dark"></i> </button>
        </form>           
      </td>





  </tr>

  <?php }  ?>

</tbody>

</table>
</div>  

</div>






<?php } require_once('footer.php'); ?>