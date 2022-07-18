<?php require_once('header.php'); ?>


<div class="container-fluid mt-4">
<a href="buy.php" class="btn btn-sm btn-info shadow" >
 <span class="fa fa-arsrow-right"></span>
 گەڕانەوە
  </a>
</div>


<div class="d-flex justify-content-around mt-3 flex-wrap">
    <a  href="buy_helka_add.php"  class="btn btn-success pb-1 pt-1" >

        <p style="transform:translate(0px,10px)">
        <i class="fas fa-plus-circle "></i>  <span style="font-weight:bold">زیادکردن</span>
        </p>

    </a>
</div>


<div class="container-fluid mt-2">
<div class="row m-auto" >

<div class="col-md-12">
  <div class="table-responsive">
<table id="example" class="table table-hover   table-striped table-bordered  text-center" dir="rtl" style="zoom:85%">
        <thead  class="bg-dark text-light">
            <tr>
                <th>ژمارەی وەسڵ</th>
                <th>ناوی فرۆشیار</th>
                <th>کۆی گشتی نرخ</th>
                <th>بەروار</th>
                <th>پرنتکردن</th>
                <th>گۆڕانکاری</th>
                <th>سڕینەوە</th>
            </tr>
        </thead>
        <tbody>
<?php 
                 $invoiceList =show("SELECT * from invoice WHERE type='buy_helka' ORDER BY date DESC");

                 foreach($invoiceList as $invoiceDetails){
                 $invoiceDate = date("d/M/Y, H:i:s", strtotime($invoiceDetails["date"]));

?>

       <tr>
          <td><?=$invoiceDetails['id']?></td>
          <td>
              
          
            <?php  
              $dealer_id=$invoiceDetails['dealer_id'];         
              $getdealer = getdata(" SELECT * FROM dealers WHERE id='$dealer_id' "); ?>
             <a href="dealer_detail.php?id=<?=$getdealer['id']?>">
                <?=$getdealer['name']?>
             </a>
            <?php  ?>
          
            
        </td>
          <td><?=$invoiceDetails['price']?></td>
          <td><?=$invoiceDetails['date']?></td>
          <td><a href="print_invoice.php?print_type=buy_helka&&invoice_id=<?=$invoiceDetails['id']?>"><i class="fa fa-print"></i></a></td>
          <td><a href="buy_helka_invoice.php?invoice_id=<?=$invoiceDetails['id']?>"><i class="fa fa-edit"></i></a></td>
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
}
?>
        </tbody>
    </table>
    </div>

 </div>

</div>




   <!-- add krdn -->







 
 
<?php
 if (isset($_SESSION["edit_success"])) {
    msg('سەرکەتووبوو','سەرکەوتووانە  گۆڕانکاری لەزانیارییەکان کرا ','success');
     unset($_SESSION["edit_success"]);
 }

 if (isset($_SESSION["add_success"])) {
    msg('سەرکەتووبوو','سەرکەوتووانە زانیارییەکان تۆمارکرا ','success');
     unset($_SESSION["add_success"]);
 }

 if (isset($_SESSION["delete"])) {
    msg('ئاگاداری','سەرکەوتووانە سڕایەوە ','warning');
    unset($_SESSION["delete"]);
 }

 if (isset($_SESSION["update_return"])) {
    msg('سەرکەتووبوو','بە سەرکەوتوویی ئەم کڕینە گەڕێندرایەوە','success');
     unset($_SESSION["update_return"]);
 }

 
 ?>




<?php 


if (post('return_buy')) {
  $id = secure($_POST['id']);

  execute("UPDATE buy SET `status`='-1' WHERE id='$id' ");
  $_SESSION["update_return"] = "";
  direct('buy_helka.php');
}

if (post('edit')) {
  $id = secure($_POST['id']);
  $dealer_id = secure($_POST['dealer_id']);
  $type = secure($_POST['type']);
  $num = secure($_POST['num']);
  $cost_t = secure($_POST['cost_t']);
  $note = secure($_POST['note']);
  $cost_wasl = secure($_POST['cost_wasl']);
  $cost_fr = secure($_POST['cost_fr']);
  $discount = secure($_POST['discount']);
  $unit = secure($_POST['unit']); 

   $cost_co = $cost_t*$num;
   $cost_co=$cost_co-$discount;

  $sql=execute("UPDATE `buy` SET `dealer_id`='$dealer_id',`cost_t`='$cost_t',`cost_co`='$cost_co',`num`='$num',`type`='$type',`cost_wasl`='$cost_wasl',`note`='$note',`cost_fr`='$cost_fr',`discount`='$discount' ,`unit`='$unit' WHERE `id`='$id' ");
    $_SESSION["edit_success"] = "";
    direct('buy_helka.php');

}

if (post('del')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM `invoice` WHERE id = '$id'");
    $_SESSION["delete"] = "";
    direct('buy_helka.php');
}



// add

if (post('add')) {
    $dealer_id = secure($_POST['dealer_id']);
    $type = secure($_POST['type']);
    $num = secure($_POST['num']);
    $cost_t = secure($_POST['cost_t']);
    $note = secure($_POST['note']);
    $date=date("Y-m-d");
    $cost_wasl = secure($_POST['cost_wasl']);
    $cost_fr = secure($_POST['cost_fr']);
    $discount = secure($_POST['discount']);
    $unit = secure($_POST['unit']); 

     $cost_co = $cost_t*$num;
     $cost_co=$cost_co-$discount;
     

    $sql=execute("INSERT INTO `buy` (`dealer_id`,`cost_t`,`cost_co`,`num`,`type`,`cost_wasl`,`date`,`cost_fr`,`discount`,`unit`,`name_product`,`buy_type`,`status`,`note`) VALUES('$dealer_id','$cost_t','$cost_co','$num','$type','$cost_wasl','$date','$cost_fr','$discount','$unit','هێلکە','helka','1','$note') ");
    $_SESSION["add_success"] = "";
    direct('buy_helka.php');
}

?>
<?php require_once('footer.php'); ?>
