<?php 

require_once('header.php'); 

if (isset($_SESSION["add_success"])) {
    msg('سەرکەوتوبوو','سەرکەوتووانە وەسڵەکە زیادکرا','success');
     unset($_SESSION["add_success"]);
 }


if (post("add_invoice")){
    
$total=$_POST['price'];
$type_invoice="buy_helka";
$unit ="دانە";
$date=date("Y-m-d");
$note =$_POST['note'];
$dealer_id = $_POST['dealer_id'];

$sqlInsert = "INSERT INTO invoice (`price`,`type`,`note`,`dealer_id`,`customer_id`) VALUES ('$total','$type_invoice','$note','$dealer_id','0')";
mysqli_query($conn, $sqlInsert);
$lastInsertId = mysqli_insert_id($conn);

for ($i = 0; $i < count($_POST['num']); $i++) {


$type =$_POST['type'][$i];
$num =$_POST['num'][$i];
$cost_t =$_POST['cost_t'][$i];

$cost_wasl =$_POST['cost_wasl'][$i];
$cost_fr =$_POST['cost_fr'][$i];
$discount =$_POST['discount'][$i];

$cost_co = $cost_t*$num;
$cost_co=$cost_co-$discount;

execute("INSERT INTO `buy` (`invoice_id`,`dealer_id`,`cost_t`,`cost_co`,`num`,`type`,`cost_wasl`,`date`,`cost_fr`,`discount`,`unit`,`name_product`,`buy_type`,`status`,`note`) VALUES('$lastInsertId','$dealer_id','$cost_t','$cost_co','$num','$type','$cost_wasl','$date','$cost_fr','$discount','$unit','هێلکە','helka','1','$note') ");

}

 $_SESSION["add_success"] = "";
direct("buy_helka_add.php");

}


?>


<div class="container-fluid mt-4">
<a href="buy_helka.php" class="btn btn-sm btn-info shadow" >
 <span class="fa fa-arsrow-right"></span>
 گەڕانەوە
  </a>
</div>



<form method="post" action="">

<?php if($is_admin == "1") {?>  
<div class="d-flex justify-content-around mt-3 flex-wrap">
    <a  id="add_more"  class="btn btn-success pb-1 pt-1" >

        <p style="transform:translate(0px,10px)">
        <i class="fas fa-plus-circle "></i>  <span style="font-weight:bold">زیادکردنی تر </span>
        </p>

    </a>
    <button  type="submit" name="add_invoice" class="btn btn-dark pb-1 pt-1" >

        <p style="transform:translate(0px,10px)">
        <i class="fas fa-save "></i>  <span style="font-weight:bold">سەیڤکردن</span>
        </p>

    </button>
</div>
<?php }?>

<div class=" container-fluid px-5 d-flex justify-content-around mt-3 flex-wrap" style="align-items:center">
<div class="form-group ">
    <label>ناوی فرۆشیار</label>
            <select name="dealer_id"   class="form-control col-md-10 mx-auto">
                <option disabled selected>فرۆشیار هەڵبژێرە</option>
                <?php
                    $getdealer = show(" SELECT * FROM dealers");
                    foreach ($getdealer as $dealer) { ?>
                                                
                 <option  value="<?=$dealer['id']?>"> <?=$dealer['name']?> </option>
                <?php   } ?>
            </select>
        </div>
        
        <div class="form-group col-lg-6">
            <textarea rows="3"  id="note1" placeholder="تێبینی بنووسە" class="form-control" name="note" ></textarea>
        </div>
</div>


<div class="container-fluid mt-2">
<div class="row m-auto" >

<div class="col-md-12">
  <div class="table-responsive">
<table  class="table  table-striped table-bordered  text-center" id="tab_logic" dir="rtl" style="zoom:85%">
        <thead class="bg-dark text-light">
            <tr>
                <th>لابردن</th>
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

       <tr id="row_id_1">
        <td></td>
     
        <td>
        <div class="form-group">
                      <input type="text" placeholder="   جۆری هێلکە  " class="form-control col-md-10 mx-auto"
                        name="type[]" id="type1" required="">
        </div>

        </td>


        <td>
        <div class="form-group">
                      <input id="num1" type="number" placeholder=" بڕ " class="form-control qty col-md-10 mx-auto" name="num[]"
                        required="">
                    </div>
        </td>

        <td>
        <div class="form-group">
                      <input type="text" placeholder="  نرخی تاک" class="form-control cost_t col-md-10 mx-auto"
                        name="cost_t[]" id="cost_t1" required="">
                    </div>
        </td>

        <td>
        <div class="form-group">
                      <input type="text" placeholder=" بڕی واسڵ " class="form-control cost_wasl col-md-10 mx-auto"
                        name="cost_wasl[]" id="cost_wasl1" required="">
                    </div>

        </td>

        <td>
            
        <div class="form-group">
                      <input type="text" placeholder="  نرخی فرۆشتن بە دانە " class="form-control col-md-10 mx-auto"
                        name="cost_fr[]" id="cost_fr1" required="">
                    </div>
        </td>

        <td>
        <div class="form-group">
                      <input type="text" placeholder="  نرخی داشکاندن " class="form-control cost_discount col-md-10 mx-auto"
                        name="discount[]" id="discount1" required="">
                    </div>
        </td>

        <td><div class="form-group"><input type="text"  class="form-control total col-md-10 mx-auto" disabled></div></td>

        
        
      </tr>
 
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
                    <td class="right" id="total_wasl">0</td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی داشکاندن</strong>
                    </td>
                    <td class="right" id="total_discount">0</td>
                </tr>

                <tr>
                    <td class="left">
                    <strong>کۆی گشتی نرخی ماوە</strong>
                    </td>
                    <td class="right" id="total_mawa">0</td>
                </tr>

                <tr class="bg-dark text-light" >
                    <td class="left">
                    <strong>کۆی گشتی نرخ</strong>
                    <input type="hidden" id="input_price" name="price">
                    </td>
                    <td class="right">
                    <strong id="total_gshty">0</strong>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

 </div>

</div>

</form>



<?php require_once('footer.php'); ?>



<script>
      $(document).ready(function() {
        var count=1;
        var price=0;
        $('#add_more').click(function() {
            count=count+1;
            var markup = '<tr id="row_id_'+count+'" >';
            markup+=' <td><button name="remove_row" id="'+count+'" class=" remove_row btn btn-danger btn-sm">x</button></td>';
            markup+=' <td> <div class="form-group"> <input type="text" placeholder=" جۆری هێلکە " class="form-control col-md-10 mx-auto" name="type[]" id="type'+count+'" required=""> </div> </td>';
            markup+=' <td> <div class="form-group"> <input id="num1'+count+'" type="number" placeholder=" بڕ " class="form-control qty col-md-10 mx-auto" name="num[]" required=""> </div> </td> ';
            markup+=' <td> <div class="form-group"> <input type="text" placeholder=" نرخی تاک" class="form-control cost_t col-md-10 mx-auto" name="cost_t[]" id="cost_t'+count+'" required=""> </div> </td> ';
            markup+=' <td> <div class="form-group"> <input type="text" placeholder=" بڕی واسڵ " class="form-control cost_wasl col-md-10 mx-auto" name="cost_wasl[]" id="cost_wasl'+count+'" required=""> </div> </td> ';
            markup+=' <td> <div class="form-group"> <input type="text" placeholder=" نرخی فرۆشتن بە دانە " class="form-control col-md-10 mx-auto" name="cost_fr[]" id="cost_fr'+count+'" required=""> </div> </td>';
            markup+=' <td> <div class="form-group"> <input type="text" placeholder=" نرخی داشکاندن " class="form-control cost_discount col-md-10 mx-auto" name="discount[]" id="discount'+count+'" required=""> </div> </td>';
            markup+=' <td><div class="form-group"><input type="text"  class="form-control total col-md-10 mx-auto" disabled></div></td> </tr>';

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