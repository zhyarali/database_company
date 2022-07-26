
<?php 
require_once('header.php');
$print_type=$_GET['print_type'];


?>
 <script type="text/javascript">
     window.print();
 </script>


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
@page {
  size: A4 landscape;
}

/* Size in mm */    
@page {
  size: 100mm 200mm landscape;
}

/* Size in inches */    
@page {
  size: 4in 6in landscape;
}
</style>



<?php 

$company_invoice=getdata("SELECT * FROM company_invoice");
$phone_name=$company_invoice['name'];
$phone_title=$company_invoice['title'];
$phone_desc=$company_invoice['description'];
$phone_address=$company_invoice['address'];
$phone_avatar=$company_invoice['image'];

?>



<div style="display:flex;justify-content:space-around;align-items:center;margin-top:20px">
    

    <div  style="text-align:center">
        <h5><?=$phone_name?></h5>
        <h5 style="margin-top:20px"><?=$phone_desc?></h5>

        <?php 

        $phones=show("SELECT * FROM invoice_phone");

        foreach($phones as $phone){

        ?>

        <h5 style="margin-top:20px"><?=$phone['name']?></h5>

        <?php } ?>  

    </div>

<div style="text-align:center">
<img src="../assets/img/company_invoice/<?=$phone_avatar;?>" width="350px">
</div>


<div style="text-align:center">
<h5>بەروار : <?php echo date("d - m - Y"); ?></h5>
    <h5 style="margin-top:20px"><?=$phone_title?></h5>
    <h5 style="margin-top:20px"><?=$phone_address?></h5>
</div>


</div>


<!-- <div>
<img src="../assets/img/img1.png" width="100%">
</div> -->


<!-- buy_helka -->
<?php 

if($print_type=="buy_helka"){
    $invoice_id=$_GET['invoice_id'];

    $getInvoice = getdata(" SELECT * FROM invoice WHERE id='$invoice_id' ");
    $dealer_id=$getInvoice['dealer_id'];
?>

<div class=" container-fluid px-5 d-flex justify-content-between mt-6 flex-wrap" style="align-items:center">
        <div class="form-group ">
            <?php 
                $getdealer = show(" SELECT * FROM dealers WHERE id='$dealer_id'");
                foreach ($getdealer as $dealer) { 
            ?>
            <p>ناوی فرۆشیار : <?php echo $dealer['name'] ; ?>  </p>

            <?php } ?>

            <?php 

                //   froshyar
                $getdealer = getdata(" SELECT * FROM dealers WHERE id='$dealer_id' ");
                $dealer_name = $getdealer['name'];
                $currency_type = $getdealer['currency_type'];
                if ($currency_type=='dinar') {
                    $currency_type='دینار';
                }

                if ($currency_type=='dollar') {
                    $currency_type='دۆلار';
                }

                if ($currency_type=='tman') {
                    $currency_type='تمەن';
                }

                ?>

                <p>جۆری دراو : <?=$currency_type?></p>
        </div>
        
        

</div>

<div class="container-fluid mt-2">
<div class="row m-auto" >

<div class="col-md-12">
  <div class="table-responsive">
<table  class="table  table-striped table-bordered  text-center" id="tab_logic" dir="rtl" style="zoom:85%">
        <thead class="bg-dark text-light">
            <tr>
                <th> جۆر    </th>
                <th> ژمارە    </th>
                <th> نرخی تاک    </th>
                <th> نرخی واسڵکراو    </th>
                <th> نرخی فرۆشتن    </th>
                <th> نرخی داشکاندن    </th>
                <th> کۆی گشتی    </th>
        
            </tr>
        </thead>

        <tbody id="item_table">

        <?php 
            $total_wasl=0;
            $total_discount=0;
            $total_mawa=0;
            $total_all=0;
           $invoice =show(" SELECT * FROM buy WHERE buy_type='helka' AND `status`='1' AND invoice_id={$invoice_id} ");
            foreach($invoice as $invoice_list){
                $id = $invoice_list['id'];
                $dealer_id = $invoice_list['dealer_id'];
                $num = $invoice_list['num'];
                $cost_t = $invoice_list['cost_t'];
                $cost_co = $invoice_list['cost_co'];
                $type = $invoice_list['type'];
                $cost_wasl = $invoice_list['cost_wasl'];
                $cost_froshtn = $invoice_list['cost_fr'];
                $cost_mawa = $cost_co-$cost_wasl;
                $discount = $invoice_list['discount'];
                $date = $invoice_list['date'];
                $note=$invoice_list['note'];

                // total
                $total_wasl+=$cost_wasl;
                $total_discount+=$discount;
                $total_mawa+=$cost_mawa;

                $total_all+=$cost_co;
               
                
                $getdealer = getdata(" SELECT * FROM dealers WHERE id='$dealer_id' ");
                $dealer_name = $getdealer['name'];


        ?>



       <tr id="row_id_1" class="text-center">
        <td>

        <input type="hidden" value="<?=$id?>" name="id[]">
        <div class="form-group">
                      <input type="text" value="<?=$type?>" placeholder="   جۆری هێلکە  " class="form-control  col-md-10 mx-auto"
                        name="type[]" id="type1" required="">
        </div>

        </td>


        <td>
        <div class="form-group">
                      <input id="num1" value="<?=$num?>" type="number" placeholder=" بڕ " class="form-control qty col-md-10 mx-auto" name="num[]"
                        required="">
                    </div>
        </td>

        <td>
        <div class="form-group">
                      <input type="text" value="<?=$cost_t?>" placeholder="  نرخی تاک" class="form-control cost_t col-md-10 mx-auto"
                        name="cost_t[]" id="cost_t1" required="">
                    </div>
        </td>

        <td>
        <div class="form-group">
                      <input type="text" value="<?=$cost_wasl?>" placeholder=" بڕی واسڵ " class="form-control cost_wasl col-md-10 mx-auto"
                        name="cost_wasl[]" id="cost_wasl1" required="">
                    </div>

        </td>

        <td>
            
        <div class="form-group">
                      <input type="text" value="<?=$cost_froshtn?>" placeholder="  نرخی فرۆشتن بە دانە " class="form-control col-md-10 mx-auto"
                        name="cost_fr[]" id="cost_fr1" required="">
                    </div>
        </td>

        <td>
        <div class="form-group">
                      <input type="text" value="<?=$discount?>" placeholder="  نرخی داشکاندن " class="form-control cost_discount col-md-10 mx-auto"
                        name="discount[]" id="discount1" required="">
                    </div>
        </td>



        <td><div class="form-group"><input value="<?=$cost_co?>" type="text"  class="form-control total col-md-10 mx-auto" disabled></div></td>

        
        
      </tr>

      <?php } ?>
 
        </tbody>
    </table>
    </div>



    <div class="row  d-flex justify-content-center">
    <div class="col-lg-4 col-sm-5 ml-auto ">
        <table class="table table-clear text-center " >
            <tbody >
                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی واسڵکراو</strong>
                    </td>
                    <td class="right" id="total_wasl"><?=$total_wasl?></td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی داشکاندن</strong>
                    </td>
                    <td class="right" id="total_discount"><?=$total_discount?></td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی ماوە</strong>
                    </td>
                    <td class="right" id="total_mawa"><?=$total_mawa?></td>
                </tr>

                <tr class="bg-dark text-light" >
                    <td class="left">
                    <strong>کۆی گشتی نرخ</strong>
                    <input type="hidden" id="input_price" name="price">
                    </td>
                    <td class="right">
                    <strong id="total_gshty"><?=$total_all?></strong>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

 </div>

</div>

<?php } ?>

<!-- end buy_helka -->



<!-- buy qa3a -->



<?php 
if($print_type=="buy_qa3a"){
    $invoice_id=$_GET['invoice_id'];

    $getInvoice = getdata(" SELECT * FROM invoice WHERE id='$invoice_id' ");
    $dealer_id=$getInvoice['dealer_id'];
?>

<div class=" container-fluid px-5 d-flex justify-content-between mt-6 flex-wrap" style="align-items:center">
        <div class="form-group ">
            <?php 
                $getdealer = show(" SELECT * FROM dealers WHERE id='$dealer_id'");
                foreach ($getdealer as $dealer) { 
            ?>
            <p>ناوی فرۆشیار : <?php echo $dealer['name'] ; ?>  </p>

            <?php } ?>

            <?php 
                $getPlace = show("SELECT * FROM buy WHERE invoice_id='$invoice_id' LIMIT 1");
                foreach ($getPlace as $place) { 
            ?>
            
            <p>شوێنی کڕین : <?php echo $place['place']; ?> </p>
            
            <?php } ?>

            <?php 

                //   froshyar
                $getdealer = getdata(" SELECT * FROM dealers WHERE id='$dealer_id' ");
                $dealer_name = $getdealer['name'];
                $currency_type = $getdealer['currency_type'];
                if ($currency_type=='dinar') {
                    $currency_type='دینار';
                }

                if ($currency_type=='dollar') {
                    $currency_type='دۆلار';
                }

                if ($currency_type=='tman') {
                    $currency_type='تمەن';
                }
            
            ?>

            <p>جۆری دراو : <?=$currency_type?></p>
            
        </div>


        <div>
            <div class="d-flex justify-content-center">
                <p>پارچەکان</p>
            </div>
            <?php 
            
            $category=show("SELECT * FROM sale_category WHERE invoice_id='$invoice_id'");
            foreach ($category as $cat) {
                $catId=$cat['id'];
              $pieces=show("SELECT * FROM piece WHERE category_id='$catId'");  
                foreach ($pieces as $piece) {
            ?>

    
          
            
         
               <button type="button" class="btn btn-outline-light btn-sm text-dark"> <p> <?=$piece['qty']?> </p> <?=$piece['name']?> </button>
               
   


<?php }} ?>
        </div>
        

  
</div>

<div class="container-fluid mt-2">
<div class="row m-auto" >

<div class="col-md-12">
  <div class="table-responsive">
  <table  class="table  table-striped table-bordered  text-center" id="tab_logic" dir="rtl" style="zoom:75%">
        <thead class="bg-dark text-light">
            <tr>
                <th>ناوی شتوومەک</th>
                <th>یەکەی کڕین</th>
                <th> جۆر    </th>
                <th> ژمارە    </th>
                <th> نرخی تاک    </th>
                <th> نرخی واسڵکراو    </th>
                <th> نرخی فرۆشتن    </th>
                <th> نرخی داشکاندن    </th>
                <th> کۆی گشتی    </th>
        
            </tr>
        </thead>

        <tbody id="item_table">

        <?php 
                   $total_wasl=0;
                   $total_discount=0;
                   $total_mawa=0;
                   $total_all=0;
                  $invoice =show(" SELECT * FROM buy WHERE buy_type='qa3a' AND `status`='1' AND invoice_id={$invoice_id} ");
                   foreach($invoice as $invoice_list){
                       $id = $invoice_list['id'];
                       $dealer_id = $invoice_list['dealer_id'];
                       $num = $invoice_list['num'];
                       $cost_t = $invoice_list['cost_t'];
                       $cost_co = $invoice_list['cost_co'];
                       $type = $invoice_list['type'];
                       $unit = $invoice_list['unit'];
                       $product_name = $invoice_list['name_product'];
                       $cost_wasl = $invoice_list['cost_wasl'];
                       $cost_froshtn = $invoice_list['cost_fr'];
                       $cost_mawa = $cost_co-$cost_wasl;
                       $discount = $invoice_list['discount'];
                       $date = $invoice_list['date'];
                       $note=$invoice_list['note'];
       
                       // total
                       $total_wasl+=$cost_wasl;
                       $total_discount+=$discount;
                       $total_mawa+=$cost_mawa;
       
                       $total_all+=$cost_co;
                      
                       
                       $getdealer = getdata(" SELECT * FROM dealers WHERE id='$dealer_id' ");
                       $dealer_name = $getdealer['name'];
       
        
        ?>

       <tr id="row_id_1">

        <input type="hidden" value="<?=$id?>" name="id[]">
        <td>
        <div class="form-group">
                <input type="text" value="<?=$product_name?>"
                    class="form-control mx-auto" name="name_product[]"
                    id="name_product1"
                    required="">
            </div>
        </td>

        <td>
            <div class="form-group">
                <select  name="unit[]" id="unit1" class="form-control  mx-auto" required>
                    <option <?php if($unit=="مەتر") echo 'selected="selected"'; ?> value="مەتر">مەتر</option>
                    <option <?php if($unit=="دانە") echo 'selected="selected"'; ?> value="دانە">دانە</option>
                    <option <?php if($unit=="کیلۆ") echo 'selected="selected"'; ?> value="کیلۆ">کیلۆ</option>
                </select>
            </div>
        </td>
     
        <td>


            <div class="form-group">
                        <input type="text" value="<?=$type?>" placeholder="   جۆر  " class="form-control  col-md-10 mx-auto"
                            name="type[]" id="type1" required="">
            </div>

            </td>


            <td>
            <div class="form-group">
                        <input id="num1" value="<?=$num?>" type="number" placeholder=" بڕ " class="form-control qty col-md-10 mx-auto" name="num[]"
                            required="">
                        </div>
            </td>

            <td>
            <div class="form-group">
                        <input type="text" value="<?=$cost_t?>" placeholder="  نرخی تاک" class="form-control cost_t col-md-10 mx-auto"
                            name="cost_t[]" id="cost_t1" required="">
                        </div>
            </td>

            <td>
            <div class="form-group">
                        <input type="text" value="<?=$cost_wasl?>" placeholder=" بڕی واسڵ " class="form-control cost_wasl col-md-10 mx-auto"
                            name="cost_wasl[]" id="cost_wasl1" required="">
                        </div>

            </td>

            <td>
                
            <div class="form-group">
                        <input type="text" value="<?=$cost_froshtn?>" placeholder="  نرخی فرۆشتن بە دانە " class="form-control col-md-10 mx-auto"
                            name="cost_fr[]" id="cost_fr1" required="">
                        </div>
            </td>

            <td>
            <div class="form-group">
                        <input type="text" value="<?=$discount?>" placeholder="  نرخی داشکاندن " class="form-control cost_discount col-md-10 mx-auto"
                            name="discount[]" id="discount1" required="">
                        </div>
            </td>



            <td><div class="form-group"><input value="<?=$cost_co?>" type="text"  class="form-control total col-md-10 mx-auto" disabled></div></td>


        
      </tr>

      <?php } ?>
 
        </tbody>
    </table>
  </div>



    <div class="row  d-flex justify-content-center">
    <div class="col-lg-4 col-sm-5 ml-auto ">
        <table class="table table-clear text-center " >
            <tbody >
                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی واسڵکراو</strong>
                    </td>
                    <td class="right" id="total_wasl"><?=$total_wasl?></td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی داشکاندن</strong>
                    </td>
                    <td class="right" id="total_discount"><?=$total_discount?></td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی ماوە</strong>
                    </td>
                    <td class="right" id="total_mawa"><?=$total_mawa?></td>
                </tr>

                <tr class="bg-dark text-light" >
                    <td class="left">
                    <strong>کۆی گشتی نرخ</strong>
                    <input type="hidden" id="input_price" name="price">
                    </td>
                    <td class="right">
                    <strong id="total_gshty"><?=$total_all?></strong>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

 </div>

</div>

<?php } ?>


<!-- end buy qa3a -->






<!-- buy asn -->



<?php 
if($print_type=="buy_asn"){
    $invoice_id=$_GET['invoice_id'];

    $getInvoice = getdata(" SELECT * FROM invoice WHERE id='$invoice_id' ");
    $dealer_id=$getInvoice['dealer_id'];
?>

<div class=" container-fluid px-5 d-flex justify-content-between mt-6 flex-wrap" style="align-items:center">
        <div class="form-group ">
            <?php 
                $getdealer = show(" SELECT * FROM dealers WHERE id='$dealer_id'");
                foreach ($getdealer as $dealer) { 
            ?>
            <p>ناوی فرۆشیار : <?php echo $dealer['name'] ; ?>  </p>

            <?php } ?>

            <?php 
                $getPlace = show("SELECT * FROM buy WHERE invoice_id='$invoice_id' LIMIT 1");
                foreach ($getPlace as $place) { 
            ?>
            
            <p>شوێنی کڕین : <?php echo $place['place']; ?> </p>
            
            <?php } ?>

            <?php 

                //   froshyar
                $getdealer = getdata(" SELECT * FROM dealers WHERE id='$dealer_id' ");
                $dealer_name = $getdealer['name'];
                $currency_type = $getdealer['currency_type'];
                if ($currency_type=='dinar') {
                    $currency_type='دینار';
                }

                if ($currency_type=='dollar') {
                    $currency_type='دۆلار';
                }

                if ($currency_type=='tman') {
                    $currency_type='تمەن';
                }
            
            ?>

            <p>جۆری دراو : <?=$currency_type?></p>
            
        </div>
        

  
</div>

<div class="container-fluid mt-2">
<div class="row m-auto" >

<div class="col-md-12">
  <div class="table-responsive">
  <table  class="table  table-striped table-bordered  text-center" id="tab_logic" dir="rtl" style="zoom:75%">
        <thead class="bg-dark text-light">
            <tr>
                <th>یەکەی کڕین</th>
                <th> جۆر    </th>
                <th> ژمارە    </th>
                <th> نرخی تاک    </th>
                <th> نرخی واسڵکراو    </th>
                <th> نرخی فرۆشتن    </th>
                <th> نرخی داشکاندن    </th>
                <th> کۆی گشتی    </th>
        
            </tr>
        </thead>

        <tbody id="item_table">

        <?php 
                   $total_wasl=0;
                   $total_discount=0;
                   $total_mawa=0;
                   $total_all=0;
                  $invoice =show(" SELECT * FROM buy WHERE buy_type='asn' AND `status`='1' AND invoice_id={$invoice_id} ");
                   foreach($invoice as $invoice_list){
                       $id = $invoice_list['id'];
                       $dealer_id = $invoice_list['dealer_id'];
                       $num = $invoice_list['num'];
                       $cost_t = $invoice_list['cost_t'];
                       $cost_co = $invoice_list['cost_co'];
                       $type = $invoice_list['type'];
                       $unit = $invoice_list['unit'];
                       $cost_wasl = $invoice_list['cost_wasl'];
                       $cost_froshtn = $invoice_list['cost_fr'];
                       $cost_mawa = $cost_co-$cost_wasl;
                       $discount = $invoice_list['discount'];
                       $date = $invoice_list['date'];
                       $note=$invoice_list['note'];
       
                       // total
                       $total_wasl+=$cost_wasl;
                       $total_discount+=$discount;
                       $total_mawa+=$cost_mawa;
       
                       $total_all+=$cost_co;
                      
                       
                       $getdealer = getdata(" SELECT * FROM dealers WHERE id='$dealer_id' ");
                       $dealer_name = $getdealer['name'];
       
        
        ?>

       <tr id="row_id_1">

        <input type="hidden" value="<?=$id?>" name="id[]">


        <td>
            <div class="form-group">
                <select  name="unit[]" id="unit1" class="form-control  mx-auto" required>
                    <option <?php if($unit=="دانە") echo 'selected="selected"'; ?> value="دانە">دانە</option>
                    <option <?php if($unit=="کیلۆ") echo 'selected="selected"'; ?> value="کیلۆ">کیلۆ</option>
                    <option <?php if($unit=="تەن") echo 'selected="selected"'; ?> value="تەن">تەن</option>
                </select>
            </div>
        </td>
     
        <td>


            <div class="form-group">
                        <input type="text" value="<?=$type?>" placeholder="   جۆر  " class="form-control  col-md-10 mx-auto"
                            name="type[]" id="type1" required="">
            </div>

            </td>


            <td>
            <div class="form-group">
                        <input id="num1" value="<?=$num?>" type="number" placeholder=" بڕ " class="form-control qty col-md-10 mx-auto" name="num[]"
                            required="">
                        </div>
            </td>

            <td>
            <div class="form-group">
                        <input type="text" value="<?=$cost_t?>" placeholder="  نرخی تاک" class="form-control cost_t col-md-10 mx-auto"
                            name="cost_t[]" id="cost_t1" required="">
                        </div>
            </td>

            <td>
            <div class="form-group">
                        <input type="text" value="<?=$cost_wasl?>" placeholder=" بڕی واسڵ " class="form-control cost_wasl col-md-10 mx-auto"
                            name="cost_wasl[]" id="cost_wasl1" required="">
                        </div>

            </td>

            <td>
                
            <div class="form-group">
                        <input type="text" value="<?=$cost_froshtn?>" placeholder="  نرخی فرۆشتن بە دانە " class="form-control col-md-10 mx-auto"
                            name="cost_fr[]" id="cost_fr1" required="">
                        </div>
            </td>

            <td>
            <div class="form-group">
                        <input type="text" value="<?=$discount?>" placeholder="  نرخی داشکاندن " class="form-control cost_discount col-md-10 mx-auto"
                            name="discount[]" id="discount1" required="">
                        </div>
            </td>



            <td><div class="form-group"><input value="<?=$cost_co?>" type="text"  class="form-control total col-md-10 mx-auto" disabled></div></td>


        
      </tr>

      <?php } ?>
 
        </tbody>
    </table>
  </div>



    <div class="row  d-flex justify-content-center">
    <div class="col-lg-4 col-sm-5 ml-auto ">
        <table class="table table-clear text-center " >
            <tbody >
                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی واسڵکراو</strong>
                    </td>
                    <td class="right" id="total_wasl"><?=$total_wasl?></td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی داشکاندن</strong>
                    </td>
                    <td class="right" id="total_discount"><?=$total_discount?></td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی ماوە</strong>
                    </td>
                    <td class="right" id="total_mawa"><?=$total_mawa?></td>
                </tr>

                <tr class="bg-dark text-light" >
                    <td class="left">
                    <strong>کۆی گشتی نرخ</strong>
                    <input type="hidden" id="input_price" name="price">
                    </td>
                    <td class="right">
                    <strong id="total_gshty"><?=$total_all?></strong>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

 </div>

</div>

<?php } ?>


<!-- end buy asn -->







<!-- buy 3alaf -->



<?php 
if($print_type=="buy_3alaf"){
    $invoice_id=$_GET['invoice_id'];

    $getInvoice = getdata(" SELECT * FROM invoice WHERE id='$invoice_id' ");
    $dealer_id=$getInvoice['dealer_id'];


    $getInvoice = getdata(" SELECT * FROM  buy WHERE invoice_id='$invoice_id' ");
$driverId=$getInvoice['driver_id'];

?>

<div class=" container-fluid px-5 d-flex justify-content-between mt-6 flex-wrap" style="align-items:center">
        <div class="form-group ">
            <?php 
                $getdealer = show(" SELECT * FROM dealers WHERE id='$dealer_id'");
                foreach ($getdealer as $dealer) { 
            ?>
            <p>ناوی فرۆشیار : <?php echo $dealer['name'] ; ?>  </p>

            <?php } ?>

            <?php 
                $getPlace = show("SELECT * FROM buy WHERE invoice_id='$invoice_id' LIMIT 1");
                foreach ($getPlace as $place) { 
            ?>
            
            <p>شوێنی کڕین : <?php echo $place['place']; ?> </p>
            
            <?php } ?>

            <?php 

                //   froshyar
                $getdealer = getdata(" SELECT * FROM dealers WHERE id='$dealer_id' ");
                $dealer_name = $getdealer['name'];
                $currency_type = $getdealer['currency_type'];
                if ($currency_type=='dinar') {
                    $currency_type='دینار';
                }

                if ($currency_type=='dollar') {
                    $currency_type='دۆلار';
                }

                if ($currency_type=='tman') {
                    $currency_type='تمەن';
                }
            
            ?>

            <p>جۆری دراو : <?=$currency_type?></p>
            
        </div>


        <div>
        <?php 
                $getdealer = show(" SELECT * FROM drivers WHERE id='$driverId'");
                foreach ($getdealer as $dealer) { 
            ?>
            <p>ناوی شۆفێر : <?php echo $dealer['name'] ; ?>  </p>
            <p>ژمارە مۆبایل  : <?php echo $dealer['phone'] ; ?>  </p>


            <?php } ?>
        </div>
        

  
</div>

<div class="container-fluid mt-2">
<div class="row m-auto" >

<div class="col-md-12">
  <div class="table-responsive">
  <table  class="table  table-striped table-bordered  text-center" id="tab_logic" dir="rtl" style="zoom:75%">
        <thead class="bg-dark text-light">
            <tr>

                <th>یەکەی کڕین</th>
                <th>ڕێژە بە کیلۆگرام</th>
                <th> جۆر    </th>
                <th> ژمارە    </th>
                <th> نرخی تاک    </th>
                <th> نرخی واسڵکراو    </th>
                <th> نرخی فرۆشتن    </th>
                <th> نرخی داشکاندن    </th>
                <th> کۆی گشتی    </th>
        
            </tr>
        </thead>

        <tbody id="item_table">

<?php 
           $total_wasl=0;
           $total_discount=0;
           $total_mawa=0;
           $total_all=0;
          $invoice =show(" SELECT * FROM buy WHERE buy_type='3alaf' AND `status`='1' AND invoice_id={$invoice_id} ");
           foreach($invoice as $invoice_list){
               $id = $invoice_list['id'];
               $dealer_id = $invoice_list['dealer_id'];
               $num = $invoice_list['num'];
               $cost_t = $invoice_list['cost_t'];
               $cost_co = $invoice_list['cost_co'];
               $type = $invoice_list['type'];
               $unit = $invoice_list['unit'];
               $percentage = $invoice_list['percentage'];
          
               $cost_wasl = $invoice_list['cost_wasl'];
               $cost_froshtn = $invoice_list['cost_fr'];
               $cost_mawa = $cost_co-$cost_wasl;
               $discount = $invoice_list['discount'];
               $date = $invoice_list['date'];
               $note=$invoice_list['note'];

               // total
               $total_wasl+=$cost_wasl;
               $total_discount+=$discount;
               $total_mawa+=$cost_mawa;

               $total_all+=$cost_co;
              
               
               $getdealer = getdata(" SELECT * FROM dealers WHERE id='$dealer_id' ");
               $dealer_name = $getdealer['name'];


?>

<tr id="row_id_1">
<input type="hidden" value="<?=$id?>" name="id[]">


<td>
    <div class="form-group">
        <select  name="unit[]" id="unit1" class="form-control  mx-auto" required>
            <option <?php if($unit=="دانە") echo 'selected="selected"'; ?> value="دانە">دانە</option>
            <option <?php if($unit=="کیلۆ") echo 'selected="selected"'; ?> value="کیلۆ">کیلۆ</option>
            <option <?php if($unit=="تەن") echo 'selected="selected"'; ?> value="تەن">تەن</option>
        </select>
    </div>
</td>

<td>
    <div class="form-group">
       <input type="text" value="<?=$percentage?>" id="percentage1" placeholder="ڕێژە بە کیلۆگرام"
        class="form-control col-md-10 mx-auto" name="percentage[]" required="">
    </div>
</td>

<td>


    <div class="form-group">
                <input type="text" value="<?=$type?>" placeholder="   جۆر  " class="form-control  col-md-10 mx-auto"
                    name="type[]" id="type1" required="">
    </div>

    </td>


    <td>
    <div class="form-group">
                <input id="num1" value="<?=$num?>" type="number" placeholder=" بڕ " class="form-control qty col-md-10 mx-auto" name="num[]"
                    required="">
                </div>
    </td>

    <td>
    <div class="form-group">
                <input type="text" value="<?=$cost_t?>" placeholder="  نرخی تاک" class="form-control cost_t col-md-10 mx-auto"
                    name="cost_t[]" id="cost_t1" required="">
                </div>
    </td>

    <td>
    <div class="form-group">
                <input type="text" value="<?=$cost_wasl?>" placeholder=" بڕی واسڵ " class="form-control cost_wasl col-md-10 mx-auto"
                    name="cost_wasl[]" id="cost_wasl1" required="">
                </div>

    </td>

    <td>
        
    <div class="form-group">
                <input type="text" value="<?=$cost_froshtn?>" placeholder="  نرخی فرۆشتن بە دانە " class="form-control col-md-10 mx-auto"
                    name="cost_fr[]" id="cost_fr1" required="">
                </div>
    </td>

    <td>
    <div class="form-group">
                <input type="text" value="<?=$discount?>" placeholder="  نرخی داشکاندن " class="form-control cost_discount col-md-10 mx-auto"
                    name="discount[]" id="discount1" required="">
                </div>
    </td>



    <td><div class="form-group"><input value="<?=$cost_co?>" type="text"  class="form-control total col-md-10 mx-auto" disabled></div></td>



</tr>

<?php } ?>

</tbody>
    </table>
  </div>



    <div class="row  d-flex justify-content-center">
    <div class="col-lg-4 col-sm-5 ml-auto ">
        <table class="table table-clear text-center " >
            <tbody >
                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی واسڵکراو</strong>
                    </td>
                    <td class="right" id="total_wasl"><?=$total_wasl?></td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی داشکاندن</strong>
                    </td>
                    <td class="right" id="total_discount"><?=$total_discount?></td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی ماوە</strong>
                    </td>
                    <td class="right" id="total_mawa"><?=$total_mawa?></td>
                </tr>

                <tr class="bg-dark text-light" >
                    <td class="left">
                    <strong>کۆی گشتی نرخ</strong>
                    <input type="hidden" id="input_price" name="price">
                    </td>
                    <td class="right">
                    <strong id="total_gshty"><?=$total_all?></strong>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

 </div>

</div>

<?php } ?>


<!-- end buy asn -->




<!-- sale  -->




<!-- sale helka -->

<!-- buy_helka -->
<?php 

if($print_type=="sale_helka"){
    $invoice_id=$_GET['invoice_id'];

    $getInvoice = getdata(" SELECT * FROM invoice WHERE id='$invoice_id' ");
    $dealer_id=$getInvoice['dealer_id'];
?>

<div class=" container-fluid px-5 d-flex justify-content-between mt-6 flex-wrap" style="align-items:center">
        <div class="form-group ">
            <?php 
                $getdealer = show(" SELECT * FROM customer WHERE id='$dealer_id'");
                foreach ($getdealer as $dealer) { 
            ?>
            <p>ناوی کڕیار : <?php echo $dealer['name'] ; ?>  </p>

            <?php } ?>

            <?php 

                //   froshyar
                $getdealer = getdata(" SELECT * FROM customer WHERE id='$dealer_id' ");
                $dealer_name = $getdealer['name'];
                $currency_type = $getdealer['currency_type'];
                if ($currency_type=='dinar') {
                    $currency_type='دینار';
                }

                if ($currency_type=='dollar') {
                    $currency_type='دۆلار';
                }

                if ($currency_type=='tman') {
                    $currency_type='تمەن';
                }

                ?>

                <p>جۆری دراو : <?=$currency_type?></p>
        </div>
        
        

</div>

<div class="container-fluid mt-2">
<div class="row m-auto" >

<div class="col-md-12">
  <div class="table-responsive">
<table  class="table  table-striped table-bordered  text-center" id="tab_logic" dir="rtl" style="zoom:85%">
        <thead class="bg-dark text-light">
            <tr>
                  <th> جۆر    </th>
                <th> ژمارە    </th>
                <th> نرخی تاک    </th>
                <th> نرخی واسڵکراو    </th>
                <th> نرخی داشکاندن    </th>
                <th> کۆی گشتی    </th>
        
            </tr>
        </thead>

        <tbody id="item_table">

        <?php 
            $total_wasl=0;
            $total_discount=0;
            $total_mawa=0;
            $total_all=0;
           $invoice =show(" SELECT * FROM sale WHERE sale_type='helka' AND `status`='1' AND invoice_id={$invoice_id} ");
            foreach($invoice as $invoice_list){
                $id = $invoice_list['id'];
                $dealer_id = $invoice_list['customer_id'];
                $num = $invoice_list['num'];
                $cost_t = $invoice_list['cost_t'];
                $cost_co = $invoice_list['cost_co'];
                $type = $invoice_list['type'];
                $cost_wasl = $invoice_list['cost_wasl'];
                $cost_mawa = $cost_co-$cost_wasl;
                $discount = $invoice_list['discount'];
                $date = $invoice_list['date'];
                $note=$invoice_list['note'];

                // total
                $total_wasl+=$cost_wasl;
                $total_discount+=$discount;
                $total_mawa+=$cost_mawa;

                $total_all+=$cost_co;
               
                
                $getdealer = getdata(" SELECT * FROM customer WHERE id='$dealer_id' ");
                $dealer_name = $getdealer['name'];


        ?>



       <tr id="row_id_1" class="text-center">
        <td>

        <input type="hidden" value="<?=$id?>" name="id[]">
        <div class="form-group">
                      <input type="text" value="<?=$type?>" placeholder="   جۆری هێلکە  " class="form-control  col-md-10 mx-auto"
                        name="type[]" id="type1" required="">
        </div>

        </td>


        <td>
        <div class="form-group">
                      <input id="num1" value="<?=$num?>" type="number" placeholder=" بڕ " class="form-control qty col-md-10 mx-auto" name="num[]"
                        required="">
                    </div>
        </td>

        <td>
        <div class="form-group">
                      <input type="text" value="<?=$cost_t?>" placeholder="  نرخی تاک" class="form-control cost_t col-md-10 mx-auto"
                        name="cost_t[]" id="cost_t1" required="">
                    </div>
        </td>

        <td>
        <div class="form-group">
                      <input type="text" value="<?=$cost_wasl?>" placeholder=" بڕی واسڵ " class="form-control cost_wasl col-md-10 mx-auto"
                        name="cost_wasl[]" id="cost_wasl1" required="">
                    </div>

        </td>



        <td>
        <div class="form-group">
                      <input type="text" value="<?=$discount?>" placeholder="  نرخی داشکاندن " class="form-control cost_discount col-md-10 mx-auto"
                        name="discount[]" id="discount1" required="">
                    </div>
        </td>



        <td><div class="form-group"><input value="<?=$cost_co?>" type="text"  class="form-control total col-md-10 mx-auto" disabled></div></td>

        
        
      </tr>

      <?php } ?>
 
        </tbody>
    </table>
    </div>



    <div class="row  d-flex justify-content-center">
    <div class="col-lg-4 col-sm-5 ml-auto ">
        <table class="table table-clear text-center " >
            <tbody >
                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی واسڵکراو</strong>
                    </td>
                    <td class="right" id="total_wasl"><?=$total_wasl?></td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی داشکاندن</strong>
                    </td>
                    <td class="right" id="total_discount"><?=$total_discount?></td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی ماوە</strong>
                    </td>
                    <td class="right" id="total_mawa"><?=$total_mawa?></td>
                </tr>

                <tr class="bg-dark text-light" >
                    <td class="left">
                    <strong>کۆی گشتی نرخ</strong>
                    <input type="hidden" id="input_price" name="price">
                    </td>
                    <td class="right">
                    <strong id="total_gshty"><?=$total_all?></strong>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

 </div>

</div>

<?php } ?>

<!-- end buy_helka -->

<!-- end sale helka -->










<!-- sale asn -->



<?php 
if($print_type=="sale_asn"){
    $invoice_id=$_GET['invoice_id'];

    $getInvoice = getdata(" SELECT * FROM invoice WHERE id='$invoice_id' ");
    $dealer_id=$getInvoice['dealer_id'];
?>

<div class=" container-fluid px-5 d-flex justify-content-between mt-6 flex-wrap" style="align-items:center">
        <div class="form-group ">
            <?php 
                $getdealer = show(" SELECT * FROM customer WHERE id='$dealer_id'");
                foreach ($getdealer as $dealer) { 
            ?>
            <p>ناوی کڕیار : <?php echo $dealer['name'] ; ?>  </p>

            <?php } ?>

            <?php 
                $getPlace = show("SELECT * FROM sale WHERE invoice_id='$invoice_id' LIMIT 1");
                foreach ($getPlace as $place) { 
            ?>
            
            <p>شوێنی فرۆشتن : <?php echo $place['place']; ?> </p>
            
            <?php } ?>

            <?php 

                //   froshyar
                $getdealer = getdata(" SELECT * FROM customer WHERE id='$dealer_id' ");
                $dealer_name = $getdealer['name'];
                $currency_type = $getdealer['currency_type'];
                if ($currency_type=='dinar') {
                    $currency_type='دینار';
                }

                if ($currency_type=='dollar') {
                    $currency_type='دۆلار';
                }

                if ($currency_type=='tman') {
                    $currency_type='تمەن';
                }
            
            ?>

            <p>جۆری دراو : <?=$currency_type?></p>
            
        </div>
        

  
</div>

<div class="container-fluid mt-2">
<div class="row m-auto" >

<div class="col-md-12">
  <div class="table-responsive">
  <table  class="table  table-striped table-bordered  text-center" id="tab_logic" dir="rtl" style="zoom:75%">
        <thead class="bg-dark text-light">
            <tr>
                <th>یەکەی فرۆشتن</th>
                <th> جۆر    </th>
                <th> ژمارە    </th>
                <th> نرخی تاک    </th>
                <th> نرخی واسڵکراو    </th>

                <th> نرخی داشکاندن    </th>
                <th> کۆی گشتی    </th>
        
            </tr>
        </thead>

        <tbody id="item_table">

        <?php 
                   $total_wasl=0;
                   $total_discount=0;
                   $total_mawa=0;
                   $total_all=0;
                  $invoice =show(" SELECT * FROM sale WHERE sale_type='asn' AND `status`='1' AND invoice_id={$invoice_id} ");
                   foreach($invoice as $invoice_list){
                       $id = $invoice_list['id'];
                       $dealer_id = $invoice_list['customer_id'];
                       $num = $invoice_list['num'];
                       $cost_t = $invoice_list['cost_t'];
                       $cost_co = $invoice_list['cost_co'];
                       $type = $invoice_list['type'];
                       $unit = $invoice_list['unit'];
                       $cost_wasl = $invoice_list['cost_wasl'];
                
                       $cost_mawa = $cost_co-$cost_wasl;
                       $discount = $invoice_list['discount'];
                       $date = $invoice_list['date'];
                       $note=$invoice_list['note'];
       
                       // total
                       $total_wasl+=$cost_wasl;
                       $total_discount+=$discount;
                       $total_mawa+=$cost_mawa;
       
                       $total_all+=$cost_co;
                      
                       
                       $getdealer = getdata(" SELECT * FROM customer WHERE id='$dealer_id' ");
                       $dealer_name = $getdealer['name'];
       
        
        ?>

       <tr id="row_id_1">

        <input type="hidden" value="<?=$id?>" name="id[]">


        <td>
            <div class="form-group">
                <select  name="unit[]" id="unit1" class="form-control  mx-auto" required>
                    <option <?php if($unit=="دانە") echo 'selected="selected"'; ?> value="دانە">دانە</option>
                    <option <?php if($unit=="کیلۆ") echo 'selected="selected"'; ?> value="کیلۆ">کیلۆ</option>
                    <option <?php if($unit=="تەن") echo 'selected="selected"'; ?> value="تەن">تەن</option>
                </select>
            </div>
        </td>
     
        <td>


            <div class="form-group">
                        <input type="text" value="<?=$type?>" placeholder="   جۆر  " class="form-control  col-md-10 mx-auto"
                            name="type[]" id="type1" required="">
            </div>

            </td>


            <td>
            <div class="form-group">
                        <input id="num1" value="<?=$num?>" type="number" placeholder=" بڕ " class="form-control qty col-md-10 mx-auto" name="num[]"
                            required="">
                        </div>
            </td>

            <td>
            <div class="form-group">
                        <input type="text" value="<?=$cost_t?>" placeholder="  نرخی تاک" class="form-control cost_t col-md-10 mx-auto"
                            name="cost_t[]" id="cost_t1" required="">
                        </div>
            </td>

            <td>
            <div class="form-group">
                        <input type="text" value="<?=$cost_wasl?>" placeholder=" بڕی واسڵ " class="form-control cost_wasl col-md-10 mx-auto"
                            name="cost_wasl[]" id="cost_wasl1" required="">
                        </div>

            </td>



            <td>
            <div class="form-group">
                        <input type="text" value="<?=$discount?>" placeholder="  نرخی داشکاندن " class="form-control cost_discount col-md-10 mx-auto"
                            name="discount[]" id="discount1" required="">
                        </div>
            </td>



            <td><div class="form-group"><input value="<?=$cost_co?>" type="text"  class="form-control total col-md-10 mx-auto" disabled></div></td>


        
      </tr>

      <?php } ?>
 
        </tbody>
    </table>
  </div>



    <div class="row  d-flex justify-content-center">
    <div class="col-lg-4 col-sm-5 ml-auto ">
        <table class="table table-clear text-center " >
            <tbody >
                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی واسڵکراو</strong>
                    </td>
                    <td class="right" id="total_wasl"><?=$total_wasl?></td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی داشکاندن</strong>
                    </td>
                    <td class="right" id="total_discount"><?=$total_discount?></td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی ماوە</strong>
                    </td>
                    <td class="right" id="total_mawa"><?=$total_mawa?></td>
                </tr>

                <tr class="bg-dark text-light" >
                    <td class="left">
                    <strong>کۆی گشتی نرخ</strong>
                    <input type="hidden" id="input_price" name="price">
                    </td>
                    <td class="right">
                    <strong id="total_gshty"><?=$total_all?></strong>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

 </div>

</div>

<?php } ?>


<!-- end sale asn -->









<!-- sale qa3a -->





<?php 
if($print_type=="sale_qa3a"){
    $invoice_id=$_GET['invoice_id'];

    $getInvoice = getdata(" SELECT * FROM invoice WHERE id='$invoice_id' ");
    $dealer_id=$getInvoice['dealer_id'];
?>

<div class=" container-fluid px-5 d-flex justify-content-between mt-6 flex-wrap" style="align-items:center">
        <div class="form-group ">
            <?php 
                $getdealer = show(" SELECT * FROM customer WHERE id='$dealer_id'");
                foreach ($getdealer as $dealer) { 
            ?>
            <p>ناوی کڕیار : <?php echo $dealer['name'] ; ?>  </p>

            <?php } ?>

            <?php 
                $getPlace = show("SELECT * FROM sale WHERE invoice_id='$invoice_id' LIMIT 1");
                foreach ($getPlace as $place) { 
            ?>
            
            <p>شوێنی فرۆشتن : <?php echo $place['place']; ?> </p>
            
            <?php } ?>

            <?php 

                //   froshyar
                $getdealer = getdata(" SELECT * FROM customer WHERE id='$dealer_id' ");
                $dealer_name = $getdealer['name'];
                $currency_type = $getdealer['currency_type'];
                if ($currency_type=='dinar') {
                    $currency_type='دینار';
                }

                if ($currency_type=='dollar') {
                    $currency_type='دۆلار';
                }

                if ($currency_type=='tman') {
                    $currency_type='تمەن';
                }
            
            ?>

            <p>جۆری دراو : <?=$currency_type?></p>
            
        </div>
        

        <div style=" direction: ltr">
            <div class="d-flex justify-content-center">
                <p>پارچەکان</p>
            </div>
            <?php 
       
              $pieces=show("SELECT * FROM sale_piece WHERE invoice_id='$invoice_id'");  
                foreach ($pieces as $piece) {
            ?>
               <button type="button" class="btn btn-outline-light btn-sm text-dark"> <p> <?=$piece['number']?> </p> <?=$piece['name']?> </button>
            <?php } ?>
        </div>
        
  
</div>

<div class="container-fluid mt-2">
<div class="row m-auto" >

<div class="col-md-12">
  <div class="table-responsive">
  <table  class="table  table-striped table-bordered  text-center" id="tab_logic" dir="rtl" style="zoom:85%">
        <thead class="bg-dark text-light">
            <tr>
                <th>یەکەی فرۆشتن</th>
                <th> ژمارە (بڕ) </th>
                <th> نرخی تاک    </th>
                <th> نرخی واسڵکراو    </th>

                <th> نرخی داشکاندن    </th>
                <th> کۆی گشتی    </th>
        
            </tr>
        </thead>

        <tbody id="item_table">

        <?php 
                   $total_wasl=0;
                   $total_discount=0;
                   $total_mawa=0;
                   $total_all=0;
                  $invoice =show(" SELECT * FROM sale WHERE sale_type='qa3a' AND `status`='1' AND invoice_id={$invoice_id} ");
                   foreach($invoice as $invoice_list){
                       $id = $invoice_list['id'];
                       $dealer_id = $invoice_list['customer_id'];
                       $num = $invoice_list['num'];
                       $cost_t = $invoice_list['cost_t'];
                       $cost_co = $invoice_list['cost_co'];
                       $type = $invoice_list['type'];
                       $unit = $invoice_list['unit'];
                       $cost_wasl = $invoice_list['cost_wasl'];
                
                       $cost_mawa = $cost_co-$cost_wasl;
                       $discount = $invoice_list['discount'];
                       $date = $invoice_list['date'];
                       $note=$invoice_list['note'];
       
                       // total
                       $total_wasl+=$cost_wasl;
                       $total_discount+=$discount;
                       $total_mawa+=$cost_mawa;
       
                       $total_all+=$cost_co;
                      
                       
                       $getdealer = getdata(" SELECT * FROM customer WHERE id='$dealer_id' ");
                       $dealer_name = $getdealer['name'];
       
        
        ?>

       <tr id="row_id_1">

        <input type="hidden" value="<?=$id?>" name="id[]">


        <td>
            <div class="form-group">
                <select  name="unit[]" id="unit1" class="form-control  mx-auto" required>
                    <option <?php if($unit=="دانە") echo 'selected="selected"'; ?> value="دانە">دانە</option>
                    <option <?php if($unit=="کیلۆ") echo 'selected="selected"'; ?> value="کیلۆ">کیلۆ</option>
                </select>
            </div>
        </td>
     



            <td>
            <div class="form-group">
                        <input id="num1" value="<?=$num?>" type="number" placeholder=" بڕ " class="form-control qty col-md-10 mx-auto" name="num[]"
                            required="">
                        </div>
            </td>

            <td>
            <div class="form-group">
                        <input type="text" value="<?=$cost_t?>" placeholder="  نرخی تاک" class="form-control cost_t col-md-10 mx-auto"
                            name="cost_t[]" id="cost_t1" required="">
                        </div>
            </td>

            <td>
            <div class="form-group">
                        <input type="text" value="<?=$cost_wasl?>" placeholder=" بڕی واسڵ " class="form-control cost_wasl col-md-10 mx-auto"
                            name="cost_wasl[]" id="cost_wasl1" required="">
                        </div>

            </td>



            <td>
            <div class="form-group">
                        <input type="text" value="<?=$discount?>" placeholder="  نرخی داشکاندن " class="form-control cost_discount col-md-10 mx-auto"
                            name="discount[]" id="discount1" required="">
                        </div>
            </td>



            <td><div class="form-group"><input value="<?=$cost_co?>" type="text"  class="form-control total col-md-10 mx-auto" disabled></div></td>


        
      </tr>

      <?php } ?>
 
        </tbody>
    </table>
  </div>



    <div class="row  d-flex justify-content-center">
    <div class="col-lg-4 col-sm-5 ml-auto ">
        <table class="table table-clear text-center " >
            <tbody >
                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی واسڵکراو</strong>
                    </td>
                    <td class="right" id="total_wasl"><?=$total_wasl?></td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی داشکاندن</strong>
                    </td>
                    <td class="right" id="total_discount"><?=$total_discount?></td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی ماوە</strong>
                    </td>
                    <td class="right" id="total_mawa"><?=$total_mawa?></td>
                </tr>

                <tr class="bg-dark text-light" >
                    <td class="left">
                    <strong>کۆی گشتی نرخ</strong>
                    <input type="hidden" id="input_price" name="price">
                    </td>
                    <td class="right">
                    <strong id="total_gshty"><?=$total_all?></strong>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

 </div>

</div>

<?php } ?>


<!-- end sale qa3a -->








<?php require_once('footer.php'); ?>


<script>
     $("input").prop("disabled", true);
     $("select").prop("disabled", true);
     
</script>