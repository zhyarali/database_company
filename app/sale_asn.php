<?php require_once('header.php'); ?>


<div class="container-fluid mt-4">
<a href="sale.php" class="btn btn-sm btn-info shadow" >
 <span class="fa fa-arsrow-right"></span>
 گەڕانەوە
  </a>
</div>


<div class="d-flex justify-content-around mt-3 flex-wrap">
    <a  href="sale_asn_add.php"  class="btn btn-success pb-1 pt-1" >

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
                <th>ناوی كڕیار</th>
                <th>کۆی گشتی نرخ</th>
                <th>بەروار</th>
                <th>پرنتکردن</th>
                <th>گۆڕانکاری</th>
                <th>سڕینەوە</th>
            </tr>
        </thead>
        <tbody>
<?php 
                 $invoiceList =show("SELECT * from invoice WHERE type='sale_asn' ORDER BY date DESC");

                 foreach($invoiceList as $invoiceDetails){
                 $invoiceDate = date("d/M/Y, H:i:s", strtotime($invoiceDetails["date"]));

?>

       <tr>
          <td><?=$invoiceDetails['id']?></td>
          <td>
              
          
            <?php  
              $dealer_id=$invoiceDetails['dealer_id'];         
              $getdealer = getdata(" SELECT * FROM customer WHERE id='$dealer_id' "); ?>
             <a href="customer_detail.php?id=<?=$getdealer['id']?>">
                <?=$getdealer['name']?>
             </a>
            <?php  ?>
          
            
        </td>
          <td><?=$invoiceDetails['price']?></td>
          <td><?=$invoiceDetails['date']?></td>
          <td><a href="print_invoice.php?print_type=sale_asn&&invoice_id=<?=$invoiceDetails['id']?>"><i class="fa fa-print"></i></a></td>
          <td><a href="sale_asn_invoice.php?invoice_id=<?=$invoiceDetails['id']?>"><i class="fa fa-edit"></i></a></td>
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

 if (isset($_SESSION["delete"])) {
    msg('ئاگاداری','سەرکەوتووانە سڕایەوە ','warning');
    unset($_SESSION["delete"]);
 }



 
 ?>




<?php 



if (post('del')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM `invoice` WHERE id = '$id'");
    $sql = execute(" DELETE  FROM `sale` WHERE invoice_id = '$id'");
    $_SESSION["delete"] = "";
    direct('sale_asn.php');
}


?>
<?php require_once('footer.php'); ?>
