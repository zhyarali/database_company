
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

<div>
<img src="../assets/img/img1.png" width="100%">
</div>


<!-- buy_helka -->
<?php 

if($print_type=="buy_helka"){
    $invoice_id=$_GET['invoice_id'];

    $getInvoice = getdata(" SELECT * FROM invoice WHERE id='$invoice_id' ");
    $dealer_id=$getInvoice['dealer_id'];
?>

<div class=" container-fluid px-5 d-flex justify-content-between mt-3 flex-wrap" style="align-items:center">
        <div class="form-group ">
            <?php 
                $getdealer = show(" SELECT * FROM dealers WHERE id='$dealer_id'");
                foreach ($getdealer as $dealer) { 
            ?>
            <p>ناوی فرۆشیار : <?php echo $dealer['name'] ; ?>  </p>

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















<?php require_once('footer.php'); ?>


<script>
     $("input").prop("disabled", true);
</script>