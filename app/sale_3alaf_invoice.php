<?php require_once('header.php'); ?>


<?php 

if (isset($_SESSION["edit_success"])) {
    msg('سەرکەوتوبوو','سەرکەوتووانە  گۆڕانکاری کرا','success');
     unset($_SESSION["edit_success"]);
 }

$invoice_id=$_GET['invoice_id'];

$getInvoice = getdata(" SELECT * FROM invoice WHERE id='$invoice_id' ");
$dealer_id=$getInvoice['customer_id'];


$getInvoice = getdata(" SELECT * FROM  sale WHERE invoice_id='$invoice_id' ");
$driverId=$getInvoice['driver_id'];


if (post("update_invoice")) {
    $total=$_POST['price'];
    $type_invoice="sale_3alaf";
    $date=date("Y-m-d");
    $note =$_POST['note'];
    $place =$_POST['place'];
    $driver_id =$_POST['driver_id'];
    $dealer_id = $_POST['dealer_id'];



 execute("UPDATE invoice SET `price`='$total',`type`='$type_invoice',`note`='$note',`customer_id`='$dealer_id' WHERE id='$invoice_id'");


 execute("DELETE FROM sale WHERE `status`='1' AND  `invoice_id`='$invoice_id' ");


for ($i = 0; $i < count($_POST['num']); $i++) {

    $id =$_POST['id'][$i];
    $type =$_POST['type'][$i];
    $num =$_POST['num'][$i];
    $cost_t =$_POST['cost_t'][$i];
    $unit =$_POST['unit'][$i];
    $percentage =$_POST['percentage'][$i];
    
    $cost_wasl =$_POST['cost_wasl'][$i];
    $discount =$_POST['discount'][$i];
    
    $cost_co = $cost_t*$num;
    $cost_co=$cost_co-$discount;


    $gettotalbuy = show("  SELECT sum(num) as 'totalbuy' FROM  buy WHERE   type='$type' AND buy_type='3alaf' AND `status`='1' ");
    $totalbuy = $gettotalbuy[0]['totalbuy']; 
    
    $gettotalsale = show("  SELECT sum(num) as 'totalsale' FROM  sale WHERE  type='$type' AND sale_type='3alaf' AND `status`='1' ");
    $totalsale = $gettotalsale[0]['totalsale']; 
    $remainqty = $totalbuy-$totalsale;
    
    if ($remainqty<$num) {
    
    }else{
    
    
    execute("INSERT INTO `sale` (`invoice_id`,`customer_id`,`cost_t`,`cost_co`,`num`,`type`,`cost_wasl`,`date`,`discount`,`unit`,`name_product`,`place`,`percentage`,`driver_id`,`sale_type`,`status`,`note`) VALUES('$invoice_id','$dealer_id','$cost_t','$cost_co','$num','$type','$cost_wasl','$date','$discount','$unit','عەلەف','$place','$percentage','$driver_id','3alaf','1','$note') ");
    }
    
    }

$_SESSION["edit_success"]="";
direct("sale_3alaf_invoice.php?invoice_id=$invoice_id");

}

?>


<div class="container-fluid mt-4">
<a href="sale_3alaf.php" class="btn btn-sm btn-info shadow" >
 <span class="fa fa-arrow-right"></span>
 گەڕانەوە بۆ وەسڵەکان
  </a>
</div>

<form method="post" action="sale_3alaf_invoice.php?invoice_id=<?=$invoice_id?>">

<div class="d-flex justify-content-around mt-3 flex-wrap">
    
<a  id="add_more"  class="btn btn-success pb-1 pt-1" >

<p style="transform:translate(0px,10px)">
<i class="fas fa-plus-circle "></i>  <span style="font-weight:bold">زیادکردنی تر </span>
</p>

</a>

    <button  type="submit" name="update_invoice" class="btn btn-dark pb-1 pt-1" >

        <p style="transform:translate(0px,10px)">
        <i class="fas fa-save "></i>  <span style="font-weight:bold">گۆڕانکاری</span>
        </p>

    </button>


</div>

<div class=" container-fluid px-5 d-flex mt-3 justify-content-around flex-wrap" style="align-items:center">
<div class="form-group ">

            <label>ناوی کڕیار</label>

            <select name="dealer_id" id="dealer_id1"  class="form-control col-md-10 mx-auto">
                <option disabled selected>کڕیار هەڵبژێرە</option>
                <?php
                    $getdealer = show(" SELECT * FROM customer");
                    foreach ($getdealer as $dealer) { ?>
                                                
                 <option <?php if($dealer_id==$dealer['id']) echo 'selected="selected"'; ?> value="<?=$dealer['id']?>"> <?=$dealer['name']?> </option>
                <?php   } ?>
            </select>
        </div> 

        <div class="form-group ">
            <label>ناوی شۆفێر</label>
        <select name="driver_id"  class="form-control col-md-10 mx-auto">
       
            <?php
                $getdriver = show(" SELECT * FROM drivers ");
                foreach ($getdriver as $driver) { ?>
            
            <option <?php if($driverId==$driver['id']) echo 'selected="selected"'; ?>  value="<?=$driver['id']?>"> <?=$driver['name']?> </option>
            <?php   } ?>
        </select>
    </div> 

        <div class="form-group">
        <label>شوێنی فرۆشتن</label>
        <?php 
                $getPlace = show("SELECT * FROM sale WHERE invoice_id='$invoice_id' Limit 1");
                foreach ($getPlace as $place) { 
            ?>
            <input type="text" value="<?=$place['place']?>" placeholder="شوێنی فرۆشتن"
                class="form-control  mx-auto" name="place"
                required="">
            <?php } ?>   
        </div>  

        <div class="form-group col-lg-6">
        <label>تێبینی</label>
            <?php 
                $getInvoice = show("SELECT * FROM invoice WHERE id='$invoice_id'");
                foreach ($getInvoice as $invoiceList){
            ?>
            <textarea rows="3"  id="note1" placeholder="تێبینی بنووسە" class="form-control" name="note" >
                <?=$invoiceList['note']?>
            </textarea>
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
                <th>یەکەی کڕین</th>
                <th>ڕێژە بە کیلۆگرام</th>
                <th> ژمارە    </th>
                <th> نرخی تاک    </th>
                <th> نرخی واسڵکراو    </th>
                <th> نرخی داشکاندن    </th>
                <th> کۆی گشتی    </th>
                <th>  گەڕانەوە    </th>
        
            </tr>
        </thead>

        <tbody id="item_table">

        <?php 
                   $total_wasl=0;
                   $total_discount=0;
                   $total_mawa=0;
                   $total_all=0;
                   $count=0;
                   
                  $invoice =show("SELECT * FROM sale WHERE sale_type='3alaf' AND `status`='1' AND invoice_id=$invoice_id ");
                   foreach($invoice as $invoice_list){
                       $id = $invoice_list['id'];
                       $dealer_id = $invoice_list['customer_id'];
                       $num = $invoice_list['num'];
                       $cost_t = $invoice_list['cost_t'];
                       $cost_co = $invoice_list['cost_co'];
                       $type = $invoice_list['type'];
                       $unit = $invoice_list['unit'];
                       $percentage = $invoice_list['percentage'];
                  
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

                       $count=$count+1;
       
        
        ?>

       <tr id="row_id_1">
  
        <input type="hidden" value="<?=$id?>" name="id[]"> 

        <td>

<div class="form-group">
      
      <select index="<?=$count?>" name="type[]" id="type1"  class="form-control type col-md-10 mx-auto">
          <option disabled selected>جۆری عەلەف هەڵبژێرە</option>
          <?php 

              $alldata=show("SELECT * FROM buy WHERE  `status`='1' AND buy_type='3alaf'  GROUP BY `type` ");

              foreach ($alldata as $data) {
                  echo $data['type'];
      
              ?>
                                          
           <option <?php if($type==$data['type']) echo 'selected="selected"'; ?> value="<?=$data['type']?>"> <?=$data['type']?> </option>
          <?php   } ?>
      </select>
      <p id="bry_mawa<?=$count?>"></p>
  </div>

</td>

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

            <td>
                 <form method="post" action="sale_3alaf_invoice.php?invoice_id=<?=$invoice_id?>">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <button type="submit" name="return_buy" style="border:none;background:none" > <i class="fas fa-sync"></i> </button>
                </form>  
            </td>
        
      </tr>

      <?php } ?>

      <?php if (empty($invoice)) { 
        execute("UPDATE `invoice` SET `status`='-1' WHERE id='$invoice_id' ");
       ?>
        <tr>
            <td colspan="11">ببورە ئەم وەسڵە داتاکانی گەڕێندراونەتەوە !</td>
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
                    <input type="hidden" id="rowCount"  value="<?=$count?>">
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

 </div>

</div>

</form>



<?php 
require_once('footer.php'); 

if (isset($_SESSION["update_return"])) {
    msg('سەرکەتووبوو','بە سەرکەوتوویی ئەم کڕینە گەڕێندرایەوە','success');
     unset($_SESSION["update_return"]);
 }

if (post('return_buy')) {
    $id = secure($_POST['id']);
  
    execute("UPDATE sale SET `status`='-1' WHERE id='$id' ");
    $_SESSION["update_return"] = "";
    $loc="sale_3alaf_invoice.php?invoice_id=".$invoice_id;
    direct($loc);
  }


?>



<script>
      $(document).ready(function() {
       
        var count=$('#rowCount').val();
        var price=0;


        $(document).on('change', 'select[name="type[]"]', function(){
    
                var index= $(this).attr("index");
                var value= $(this).val();

                 $.ajax({
                    url: "check_number_product.php",
                    method: "POST",
                    data: {halaf_count:true,type:value},
                    success: function (data) {
                        if (data=="0") {
                            $('#bry_mawa'+index).html("بڕی ماوە : "+data);
                        }else{
                            $('#bry_mawa'+index).html("بڕی ماوە : "+data);
                            
                        }
                    }
                 });
    
 });










 $('#add_more').click(function() {




                                    
var type=$('#type'+count).val()
var qty=$('#num'+count).val()
var cost_t=$('#cost_t'+count).val()
var cost_wasl=$('#cost_wasl'+count).val()
var discount=$('#discount'+count).val()
var percentage=$('#percentage'+count).val()



count=parseInt(count)+1;
    var markup = '<tr id="row_id_'+count+'" >';
    markup+='<td> <div class="form-group"> <select index="'+count+'" name="type[]" id="type'+count+'" class="form-control type col-md-10 mx-auto"> <option disabled selected>جۆری عەلەف هەڵبژێرە</option> <?php $alldata=show("SELECT * FROM buy WHERE `status`='1' AND buy_type='3alaf' GROUP BY `type` "); foreach ($alldata as $data) { echo $data['type']; ?> <option value="<?=$data['type']?>"> <?=$data['type']?> </option> <?php } ?> </select> <p id="bry_mawa'+count+'"></p> </div></td>';
    markup+=' <td> <div class="form-group"> <select name="unit[]" id="unit'+count+'" class="form-control mx-auto" required> <option value="دانە">دانە</option> <option value="کیلۆ">کیلۆ</option> <option value="تەن">تەن</option> </select> </div> </td>';
    markup+=' <td> <div class="form-group"> <input type="text" id="percentage'+count+'" placeholder="ڕێژە بە کیلۆگرام" class="form-control col-md-10 mx-auto" name="percentage[]" required=""> </div> </td>';
    markup+=' <td> <div class="form-group"> <input id="num'+count+'" type="number" placeholder=" بڕ " class="form-control qty col-md-10 mx-auto" name="num[]" required=""> </div> </td> ';
    markup+=' <td> <div class="form-group"> <input type="text" placeholder=" نرخی تاک" class="form-control cost_t col-md-10 mx-auto" name="cost_t[]" id="cost_t'+count+'" required=""> </div> </td> ';
    markup+=' <td> <div class="form-group"> <input type="text" placeholder=" بڕی واسڵ " class="form-control cost_wasl col-md-10 mx-auto" name="cost_wasl[]" id="cost_wasl'+count+'" required=""> </div> </td> ';
    markup+=' <td> <div class="form-group"> <input type="text" placeholder=" نرخی داشکاندن " class="form-control cost_discount col-md-10 mx-auto" name="discount[]" id="discount'+count+'" required=""> </div> </td>';
    markup+=' <td><div class="form-group"><input type="text"  class="form-control total col-md-10 mx-auto" disabled></div></td> ';
    markup+=' <td><button name="remove_row" id="'+count+'" class=" remove_row btn btn-danger btn-sm">x</button></td> </tr>';
    $('#item_table').append(markup);


});




                // remove row
                $(document).on('click','.remove_row',function(){
                    var row_id=$(this).attr("id");
                $('#row_id_'+row_id).remove();
                count=count-1;
                calc();
                });


                $('#tab_logic tbody').on('keyup change',function(){
		            calc();
	            });



function calc()
{
	$('#tab_logic tbody tr').each(function(i, element) {
		var html = $(this).html();
	
			var qty = $(this).find('.qty').val();

            // alert(qty)
			var price = $(this).find('.cost_t').val();
			var discount = $(this).find('.cost_discount').val();

            let total_amount=(qty*price)-discount;

			$(this).find('.total').val(total_amount);
			
			calc_total();
		
    });
}

function calc_total()
{
	total=0;
    let total_discount=0;
    let total_wasl=0;

    // total
	$('.total').each(function() {
        total += parseInt($(this).val());
    });
    $('#total_gshty').html(total.toFixed(2));

    $('#input_price').val(total);
    // total wasl

	$('.cost_wasl').each(function() {
        total_wasl += parseInt($(this).val());
    });
    $('#total_wasl').html(total_wasl.toFixed(2));

        // discount
	$('.cost_discount').each(function() {
        total_discount += parseInt($(this).val());
    });
    $('#total_discount').html(total_discount.toFixed(2));

    // total mawa


    let mawa=total-total_wasl;

    $('#total_mawa').html(mawa.toFixed(2));







	
	
}



      });

    


</script>