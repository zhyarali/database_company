<?php require_once('header.php'); ?>

<?php 

$user_id=$_GET['id'];

$users = countdata(" SELECT * FROM dealers WHERE `id`=$user_id");

$num_of_return_buy= countdata("SELECT * FROM buy WHERE dealer_id=$user_id AND `status`=-1");

$data = show(" SELECT * FROM dealers WHERE `id`=$user_id");

$getcost =getdata(" SELECT sum(cost_co) as cost_total,sum(cost_wasl) as cost_wasl FROM buy WHERE dealer_id=$user_id AND `status`=1");

$cost_maway_peshw=$getcost['cost_total']-$getcost['cost_wasl'];



if (empty($data)) {
  direct('index.php');
}else{   
    
    foreach ($data as $user) {
        $name = $user['name'];
        $phone = $user['phone'];
        $address = $user['address'];
        $work_place = $user['work_place'];
        $note = $user['note']; 
        $currency_type = $user['currency_type']; 
     
        if ($currency_type=='dinar') {$currency_type='دینار';}
        if ($currency_type=='dollar') {$currency_type='دۆلار';}
        if ($currency_type=='tman') {$currency_type='تمەن';}

        $refund_p=0;
        $refund=getdata(" SELECT sum(price) as price from refund WHERE dealer_id=$user_id");
       
        if (!empty($refund)) {
            $refund_p=$refund['price']; 
        }

        $dealers_buy=getdata(" SELECT sum(cost_co) as cost_total,sum(cost_wasl) as cost_wasl FROM buy WHERE dealer_id=$user_id AND `status`=1");
        $cost_maway_peshw=$dealers_buy['cost_total']-$dealers_buy['cost_wasl'];
        $cost_maway_peshw-=$refund_p;

        if ($cost_maway_peshw<0) {$cost_maway_peshw=0;}

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



<!-- <div class="container-fluid  mt-3 d-flex justify-content-around">
<form method="post" action="view_report.php">
    <input type="hidden" name="user_id" value="<?=$user_id?>">
    <button type="submit" class="btn btn-dark" name="dealer_info" style="border:none;" > <i class="fas fa-print"></i> پرنتکردن</button>
</form> 
</div> -->


<div class="container-fluid d-flex justify-content-between mt-3">

<div class="row col-lg-6 col-12 ">
        <div class="card border shadow-none m-auto " style="width: 25rem;border-radius:8px">
            <ul class="list-group list-group-flush text-center">
                <li class="list-group-item"><strong>ناو : </strong> <?=$name?></li>
                <li class="list-group-item"><strong>ژمارە مۆبایل : </strong> <?=$phone?></li>
                <li class="list-group-item"><strong>ناونیشان : </strong><?=$address?></li>
                <li class="list-group-item"><strong>شوێنی کار : </strong><?=$work_place?></li>
                <li class="list-group-item"><strong> تێبینی : </strong><?=$note?></li>

            </ul>
        </div>
    </div>


<div class="row col-lg-6 col-12 ">
        <div class="card border shadow-none m-auto " style="width: 25rem;border-radius:8px">
            <ul class="list-group list-group-flush text-center">
                <li class="list-group-item"><strong>کۆی نرخی  واسڵکراو : </strong> <?=$refund_p?></li>
                <li class="list-group-item"><strong>کۆی گشتی نرخی ماوەی ئێستا : </strong> <?=$cost_maway_peshw?></li>
 
                <li class="list-group-item">
                    <div class="d-flex justify-content-around mt-3">

                    <?php if ($is_admin==1) {?>
                       <?php if ($cost_maway_peshw>0) {?>
                             <a data-toggle="modal" data-target="#add_refund<?=$user_id?>"   class="dropdown-item mx-2  btn btn-primary" style="background-color:#7868E6 !important;">گەڕانەوەی پارە</a>
                       <?php }?>

                       <?php if ($cost_maway_peshw<=0) {?>
                             <a data-toggle="modal" data-target="#refund_warning<?=$user_id?>"   class="dropdown-item mx-2  btn btn-primary" style="background-color:#7868E6 !important;">گەڕانەوەی پارە</a>
                       <?php }?> 
                    <?php } ?>   

                        <a href="return_fund.php?id=<?=$user_id?>" class="dropdown-item btn  btn-danger" style="background-color:#A6A9B6 !important;">بینین</a>
                    </div>
                </li>

            </ul>
        </div>
    </div>


<!-- add refund -->
<div class="modal fade" id="add_refund<?=$user_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content" style="background-color: white;border-radius: 15px;">
      <div class="modal-body text-center">
        <div class="container-fluid">
          <div class="row row-cols-1 row-cols-md-3">
            <div class="col-md-12 mb-3 mx-auto">
              <div class="h-100">
                <i class="fa fa-times-circle" style="float:left;color: black" data-dismiss="modal"></i>
                <div class="card-body">
                  <h5 class="container col-md-6 mt-3  text-center">
                     گەڕانەوەی پارە  
                  </h5>
                  <br>
                  <form class="mt-5" dir="rtl" method="POST" enctype="multipart/form-data">


                  <div class="form-group">
                     <input type="hidden" placeholder=" " name="id"
                    value="<?=$user_id;?>" 
                    class="form-control col-md-10 mx-auto">
                </div>


                    <div class="container d-flex justify-content-center mb-4">
                       <strong> کۆی گشتی نرخی ماوەی پێشوو </strong> &nbsp; : &nbsp; <span><?=$cost_maway_peshw?></span>
                    </div>

                    <div class="form-group">
                      <input type="text" placeholder="نرخی پارەی گێڕاوە" class="form-control col-md-10 mx-auto"
                        name="refund_price" required="">
                    </div>

                    <div class="form-group">
                    <select name="refund_type"  class="form-control col-md-10 mx-auto"> 
                        <option value="cash">کاش</option>
                        <option value="7awala">حەواڵە</option>
                    </select>
                    </div>

               
                    <button type="submit" name="add_refund" class="btn btn-sm btn-dark  s-20">
                      گەڕانەوەی پارە </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- if refund smaller and equal to 0 -->
<div class="modal fade" id="refund_warning<?=$user_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" style="background-color: white;border-radius: 15px;">
      <div class="modal-body text-center">
        <div class="container-fluid">
          <div class="row row-cols-1 row-cols-md-3">
            <div class="col-md-12 mb-3 mx-auto">
              <div class="h-100">
                <i class="fa fa-times-circle" style="float:left;color: black" data-dismiss="modal"></i>
                <div class="card-body mt-3">
                        <h5 class="text-danger">هیچ بڕە پارەیەکی ماوە بوونی نییە تا بیگەڕێنیتەوە !</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



</div>

<div class="container-fluid mt-2 d-flex flex-wrap">

    <!-- <div onclick="window.print()"><i class="fas fa-print fa-2x"></i> پرنتکردن</div> -->

    <div class="container-fluid  mt-3 d-flex justify-content-around flex-wrap">
       
        <!-- <a href="dealer_detail.php?id=<?=$user_id?>" class="btn btn-success shadow">زانیاری گشتی بهێنەوە</a> -->

        
        <div class="d-flex flex-wrap justify-content-center">

            <!-- <div class="form-group mx-3">
            <input type="date" 
             class="form-control  mx-auto" id="get_by_date" required>
            <input type="hidden" 
             class="form-control mx-auto" value="<?=$user_id?>" id="user_id">
           </div>
           <p class="btn btn-dark shadow" id="btn_search">زانیاری بەپێی ڕۆژ بهێنەوە</p> -->


           <button style="background-color:#7868E6 !important;outline:none;shadow:none" data-bs-toggle="modal" href="#exampleModalToggle" role="button" type="button" class="btn btn-primary mx-3 border-0  position-relative">
           گەڕاوەی کڕین
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?php echo $num_of_return_buy;?>
            </span>
            </button>
        </div>    
     
    </div>

</div>
   
    
<div id="show_data">
  
<div class="container-fluid mt-2">
<div class="row m-auto" >

<div class="col-md-12">
  <div class="table-responsive">
<table id="example" class="table table-hover   table-striped table-bordered  text-center" dir="rtl" style="zoom:85%">
        <thead  class="bg-dark text-light">
            <tr>
                <th>ژمارەی وەسڵ</th>
                <th>جۆری کڕین</th>
                <th>کۆی گشتی نرخ</th>
                <th>بەروار</th>
                <th>پرنتکردن</th>
                <th>گۆڕانکاری</th>
                <th>سڕینەوە</th> 
            </tr>
        </thead>
        <tbody>
<?php 
                 $invoiceList =show("SELECT * from invoice WHERE customer_id='$user_id'  ORDER BY date DESC");

                 foreach($invoiceList as $invoiceDetails){
                 $invoiceDate = date("d/M/Y, H:i:s", strtotime($invoiceDetails["date"]));
                 $invoice_status=$invoiceDetails['status'];

                 if ($invoice_status==1) {
                  

?>


          

       <tr>
          <td><?=$invoiceDetails['id']?></td>
          <td>
                        
          <?php 
          $buy_type="";
          if ($invoiceDetails['type']=="buy_helka"){
                  $buy_type="هێلکە";
          }
          if ($invoiceDetails['type']=="buy_qa3a"){
                  $buy_type="ئەشیای ناو قاعە";
          }
          if ($invoiceDetails['type']=="buy_3alaf"){
                  $buy_type="عەلەف";
          }
          if ($invoiceDetails['type']=="buy_asn"){
                  $buy_type="ئاسن";
          }
          echo $buy_type;
          ?>

         </td>
          <td><?=$invoiceDetails['price']?></td>
          <td><?=$invoiceDetails['date']?></td>
          <td><a href="print_invoice.php?print_type=<?=$invoiceDetails['type']?>&&invoice_id=<?=$invoiceDetails['id']?>"><i class="fa fa-print"></i></a></td>
          <td><a href="<?=$invoiceDetails['type']?>_invoice.php?invoice_id=<?=$invoiceDetails['id']?>"><i class="fa fa-edit"></i></a></td>
          <td><a href="#" data-toggle="modal" data-target="#delete<?php echo $invoiceDetails['id'] ?>"><i class="fa fa-trash-alt"></i></a></td>
        
      </tr>




          <!-- delete modal -->
          <div class="modal fade" id="delete<?php echo $invoiceDetails['id'] ?>" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content" style="background-color: white;border-radius: 15px;">
                                    <div class="modal-body text-center">
                                        <div class="container-fluid">
                                            <div class="row row-cols-1 row-cols-md-3">
                                                <div class="col-md-12 mb-3 mx-auto">
                                                    <div class="h-100">
                                                        <i class="fa fa-times-circle" style="float:left;color: black"
                                                            data-dismiss="modal"></i>
                                                        <div class="card-body">
                                                            <h5 class="container col-md-6 mt-3  text-center">
                                                                دڵنیای لە سڕینەوەی ئەم وەسڵە لەناو سیستەمەکەت ؟
                                                            </h5>
                                                            <br>
                                                            <form dir="rtl" method="POST">
                                                                <div class="form-group">
                                                                    <input type="hidden" placeholder="  ناو  " name="id"
                                                                        value="<?=$invoiceDetails['id'];?> "
                                                                        class="form-control col-md-10 mx-auto">
                                                                </div>
 
                                                                <button type="submit" name="del"
                                                                    class="btn btn-danger btn-block"> سڕینەوە </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

      

  
<?php
} }
?>
        </tbody>
    </table>
    </div>

 </div>

</div>

</div>
  
</div>






<!-- return -->


<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="exampleModalLabel">لیستی گەڕاندنەوەکانی کڕین</h4>
        <button type="button" class="btn btn-secondary " data-bs-dismiss="modal" aria-label="Close">داخستن</button>
        
      </div>
      <div class="modal-body">
                        
            <?php include('return_buy_modal.php'); ?>       

      </div>

    </div>
  </div>
</div>





    
<?php } } ?>


<?php require_once('footer.php'); ?>




<?php 

if (isset($_SESSION["delete"])) {
    msg('ئاگاداری','سەرکەوتووانە سڕایەوە ','warning');
    unset($_SESSION["delete"]);
 }


if (post('del')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM `invoice` WHERE id = '$id'");
    $sql = execute(" DELETE  FROM `buy` WHERE invoice_id = '$id'");
    $_SESSION["delete"] = "";
    $loc="dealer_detail.php?id=".$_GET['id'];
    direct($loc);
}


?>


<?php 

if (isset($_SESSION["add_success"])) {
    msg('سەرکەتووبوو','سەرکەوتووانە  بڕی پارەی دیاریکراو گەڕێنرایەوە ','success');
     unset($_SESSION["add_success"]);
 }

if (isset($_SESSION["delete_return"])) {
    msg('سەرکەتووبوو','بە سەرکەوتوویی ئەم کڕینە سڕایەوە','success');
     unset($_SESSION["delete_return"]);
 }


 if (post('delete_return_buy')) {
    $id = secure($_POST['id']);
    $userId = secure($_POST['userId']);
    execute("DELETE FROM buy WHERE id='$id' ");
    $_SESSION["delete_return"] = "";
    $loc="dealer_detail.php?id=".$userId;
    direct($loc);
 }


 if (post('add_refund')) {
    $refund_price = secure($_POST['refund_price']);
    $id = secure($_POST['id']);
    $refund_type = secure($_POST['refund_type']);
    $date=date("Y-m-d");

    execute("INSERT INTO refund (`dealer_id`,`price`,`refund_type`,`date`) 
    VALUES('$id','$refund_price','$refund_type','$date')");
    $_SESSION["add_success"] = "";
    $loc="dealer_detail.php?id=".$id;
    direct($loc);
  }


  if (post('return_buy')) {
    $id = secure($_POST['id']);
    $userId = secure($_POST['userId']);
  
    execute("UPDATE buy SET `status`='-1' WHERE id='$id' ");
    $_SESSION["update_return"] = "";
    $loc="dealer_detail.php?id=".$userId;
    direct($loc);
  }


?>


<script>
  $(document).ready(function () {
 
    // $('.dateFilter').datepicker({
    //   dateFormat: "yy-mm-dd"
    // });
 
    $('#btn_search').click(function () {
      var date = $('#get_by_date').val(); 
      var user_id = $('#user_id').val();
      if (date != '') {
        $.ajax({
          url: "get_by_date.php",
          method: "POST",
          data: { date: date,user_id: user_id},
          success: function (data) {
            $('#show_data').html(data);
          }
        });
      }
      else {
        alert("Please Select the Date");
      }
    });
  });
</script>
