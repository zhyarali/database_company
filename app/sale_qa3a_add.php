<?php 

require_once('header.php'); 

if (isset($_SESSION["add_success"])) {
    msg('سەرکەوتوبوو','سەرکەوتووانە وەسڵەکە زیادکرا','success');
     unset($_SESSION["add_success"]);
 }

 if (isset($_SESSION["add_category_meter"])) {
    msg('سەرکەتووبوو','بەسەرکەوتوویی ئەم بەشە زیادکرا ','success');
     unset($_SESSION["add_category_meter"]);
  }



  if (isset($_SESSION["edit_category_not_qty"])) {
    msg('ئاگاداربە','بڕی پێویست لە کاڵاکە بوونی نییە تکایە بڕی گونجاو بنووسە یاخود بڕی تر بکڕە','warning');
     unset($_SESSION["edit_category_not_qty"]);
 }



if (post("add_category")) {

    $piece_number=$_POST['piece_number'];
    $category_id=$_POST['category'];


    $invoiceId=0;
    $lasts=show("SELECT * FROM invoice  ORDER BY id DESC LIMIT 1 ");

    if (empty($lasts)) {
        $invoiceId=0;
    }else{

    foreach ($lasts as $last) {
        $invoiceId=$last['id'];
    }
    $invoiceId+=1;
    }






    $sale_piece=show("SELECT * FROM sale_piece WHERE invoice_id='$invoiceId'");





   

    for ($i = 0; $i < count($piece_number); $i++) {


        $piece_id=$_POST['piece_id'][$i];

        $current_qty=$_POST['current_qty'][$i];

        $pieceNumber=$_POST['piece_number'][$i];

        $piece_price=$_POST['piece_price'][$i];


        $qty=$current_qty-$pieceNumber;


        $cat=getdata("SELECT * FROM piece  WHERE id='$piece_id'");
        $piece_name=$cat['name'];

      $gettotalpiece = show("  SELECT sum(qty) as 'totalNum' FROM  piece WHERE name='$piece_name' ");
      $totalpiece = $gettotalpiece[0]['totalNum']; 
    
      $gettotalsale = show("  SELECT sum(number) as 'totalsale' FROM  sale_piece WHERE name='$piece_name' ");
      $totalsale = $gettotalsale[0]['totalsale']; 

      $remainqty = $totalpiece-$totalsale;
    
      if ($remainqty< $pieceNumber) {
        $_SESSION["edit_category_not_qty"] = "";
        $loc="sale_qa3a_add.php";
        direct($loc);
      }else{
        execute("INSERT INTO sale_piece (name,number,price,piece_id,invoice_id) VALUES ('$piece_name','$pieceNumber','$piece_price','$piece_id','$invoiceId')");

      }
        


      


        


    
    }

    $_SESSION["add_category_meter"]="";
    direct("sale_qa3a_add.php");


    
}



// era
if (post("add_invoice")){

        
    $total=$_POST['price'];
    $type_invoice="sale_qa3a";
    $type="sale_qa3a";
    $name_product ="qa3a";

    $date=date("Y-m-d");
    $note =$_POST['note'];
    $place =$_POST['place'];
    $dealer_id = $_POST['dealer_id'];
    
    $sqlInsert = "INSERT INTO invoice (`price`,`type`,`note`,`dealer_id`) VALUES ('$total','$type_invoice','$note','$dealer_id')";
    mysqli_query($conn, $sqlInsert);
    $lastInsertId = mysqli_insert_id($conn);
    
    for ($i = 0; $i < count($_POST['num']); $i++) {
    
    
   
    $num =$_POST['num'][$i];
    $cost_t =$_POST['cost_t'][$i];
    $unit =$_POST['unit'][$i];
    
    $cost_wasl =$_POST['cost_wasl'][$i];

    $discount =$_POST['discount'][$i];
    
    $cost_co = $cost_t*$num;
    $cost_co=$cost_co-$discount;




    execute("INSERT INTO `sale` (`invoice_id`,`customer_id`,`cost_t`,`cost_co`,`num`,`type`,`cost_wasl`,`date`,`discount`,`unit`,`name_product`,`place`,`sale_type`,`status`,`note`) VALUES('$lastInsertId','$dealer_id','$cost_t','$cost_co','$num','$type','$cost_wasl','$date','$discount','$unit','$name_product','$place','qa3a','1','$note') ");

    
}
    
     $_SESSION["add_success"] = "";
    direct("sale_qa3a_add.php");


}


?>



<div class="container-fluid d-flex justify-content-between mt-4" style="zoom:80%">

<a href="sale_qa3a.php"   class="btn btn-info pb-1 pt-1" >

<p style="transform:translate(0px,10px)">
<i class="fas fa-arrow-right "></i>  <span style="font-weight:bold"> گەڕانەوە
</span>
</p>

</a>


</div>






    






<form method="post" action="">


<div class="container mb-5 p-5" style="background:#E7F6F2;border-radius:10px" id="item_cat">



<div class="d-flex justify-content-around text-center">

<!-- <div>
<p style="transform:translate(0px,30px)"  class="btn  btn-success " id="addmore" > <i class="fas fa-plus-circle "></i>  زیادکردنی پارچەی تر</p>
</div> -->

<div class="form-group text-center">
<label>پارچەکان</label>
            <select name="category"   class="form-control col-md-10 mx-auto">
                <option selected disabled>پارچەیەک هەڵبژێرە</option>
                <?php
                    $category=show("SELECT * FROM sale_category ");
                    foreach ($category as $cat) { ?>
                                                
                 <option  value="<?=$cat['id']?>"> <?=$cat['name']?> </option>
                <?php   } ?>
            </select>
        </div> 


       
 
 


<div>
<button style="transform:translate(0px,30px)" type="submit" name="add_category" class="btn btn-secondary">
<i class="fas fa-save "></i>  <span style="font-weight:bold">زیادکردنی بەش</span>
</button>
</div>





</div>


<div id="show_data">
    

</div>


    
</div>
</form>




<form method="post" action="">
    



<div class="d-flex justify-content-around mt-3 flex-wrap">
    <a  id="add_more"  class="btn btn-success pb-1 pt-1" >

        <p style="transform:translate(0px,10px)">
        <i class="fas fa-plus-circle "></i>  <span style="font-weight:bold">زیادکردنی کڕینی تر </span>
        </p>

    </a>


    
  <button  type="submit" name="add_invoice" class="btn btn-dark pb-1 pt-1" >

<p style="transform:translate(0px,10px)">
<i class="fas fa-save "></i>  <span style="font-weight:bold">سەیڤکردن</span>
</p>

</button>


</div>

<div class=" container-fluid px-5 d-flex justify-content-around mt-3 flex-wrap" style="align-items:center">
<div class="form-group ">
<label>ناوی فرۆشیار</label>
            <select name="dealer_id" required   class="form-control col-md-10 mx-auto">
                
            <option selected disabled> کڕیار هەڵبژێرە</option>
                <?php
                    $getdealer = show(" SELECT * FROM customer ");
                    foreach ($getdealer as $dealer) { ?>
                
                
                 <option  value="<?=$dealer['id']?>"> <?=$dealer['name']?> </option>
                <?php   } ?>
            </select>
        </div>

        <div class="form-group">
        <label>شوێنی فرۆشتن</label>
            <input type="text" placeholder="شوێنی کڕین بنووسە"
                class="form-control  mx-auto" name="place"
                required="">
        </div>  
        
        <div class="form-group col-lg-6">
        <label>تێبینی</label>
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
                <th>یەکەی فرۆشتن</th>
                <th> ژمارە    </th>
                <th> نرخی تاک    </th>
                <th> نرخی واسڵکراو    </th>
                <th> نرخی داشکاندن    </th>
                <th> کۆی گشتی    </th>
        
            </tr>
        </thead>

        <tbody id="item_table">

       <tr id="row_id_1">
                        
       <td></td>


        <td>
            <div class="form-group">
                <select name="unit[]" id="unit1" class="form-control  mx-auto" required>
                    <option value="مەتر">مەتر</option>
                    <option value="دانە">دانە</option>
                    <option value="کیلۆ">کیلۆ</option>
                </select>
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



        var countCat=1;


        

        
 $(document).on('change', 'select[name="category"]', function(){

var value= $(this).val();



             $.ajax({
                url: "get_piece.php",
                method: "POST",
                data: {sale_piece:true,catId:value},
                success: function (data) {
                    if (data) {
                      $("#show_data").html(data)
                    }
                   
                }
             });

});



$(document).on('click','.remove_piece',function(){
    var row_id=$(this).attr("id");
    $('#row'+row_id).remove();
    
})






$('#addmore').click(function() {


                countCat=countCat+1;
                var markup = '<div class="d-flex justify-content-center " style="align-items:center" id="row__cat_id_'+countCat+'" >';
                markup+=' <div class="form-group mx-2"> <label>ناوی پارچە</label> <input type="text" id="piece_name'+countCat+'" class="form-control mx-auto" name="piece_name[]" > </div> <div class="form-group mx-2"> <label>ژمارەی پارچە</label> <input type="text" id="piece_number'+countCat+'" class="form-control mx-auto" name="piece_number[]" > </div> <div class="form-group mx-2"> <label>نرخی پارچە</label> <input type="text" id="piece_price'+countCat+'" class="form-control mx-auto" name="piece_price[]" > </div> ';
                markup+=' <p id="'+countCat+'" style="transform:translate(0px,17px);zoom:80%" class="btn remove_cat btn-sm btn-danger" >X</p>';
                markup+='</div>';
       
                $('#item_cat').append(markup);


});





        $('#add_more').click(function() {
            count=count+1;
            var markup = '<tr id="row_id_'+count+'" >';
            markup+=' <td><button name="remove_row" id="'+count+'" class=" remove_row btn btn-danger btn-sm">x</button></td>';
            markup+=' <td> <div class="form-group"> <select name="unit[]" id="unit'+count+'" class="form-control mx-auto" required> <option value="مەتر">مەتر</option> <option value="دانە">دانە</option> <option value="کیلۆ">کیلۆ</option> </select> </div> </td>';
            markup+=' <td> <div class="form-group"> <input id="num1'+count+'" type="number" placeholder=" بڕ " class="form-control qty col-md-10 mx-auto" name="num[]" required=""> </div> </td> ';
            markup+=' <td> <div class="form-group"> <input type="text" placeholder=" نرخی تاک" class="form-control cost_t col-md-10 mx-auto" name="cost_t[]" id="cost_t'+count+'" required=""> </div> </td> ';
            markup+=' <td> <div class="form-group"> <input type="text" placeholder=" بڕی واسڵ " class="form-control cost_wasl col-md-10 mx-auto" name="cost_wasl[]" id="cost_wasl'+count+'" required=""> </div> </td> ';
            markup+=' <td> <div class="form-group"> <input type="text" placeholder=" نرخی داشکاندن " class="form-control cost_discount col-md-10 mx-auto" name="discount[]" id="discount'+count+'" required=""> </div> </td>';
            markup+=' <td><div class="form-group"><input type="text"  class="form-control total col-md-10 mx-auto" disabled></div></td> </tr>';

            $('#item_table').append(markup);

            });



                // remove row
                $(document).on('click','.remove_cat',function(){
                    var row_id=$(this).attr("id");
                $('#row__cat_id_'+row_id).remove();
                countCat=countCat-1;
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