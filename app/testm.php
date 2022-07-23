<?php 
require_once('header.php');



if (post("add")) {
    $category_name=$_POST['category_name'];
    $piece_name=$_POST['piece_name'];
    $piece_number=$_POST['piece_number'];
    $piece_price=$_POST['piece_price'];

for ($i = 0; $i < countCat($piece_number); $i++) {

    
    $category_name=$_POST['category_name'][$i];
    $piece_name=$_POST['piece_name'][$i];
   
    $piece_price=$_POST['piece_price'][$i];

$sqlInsert = "INSERT INTO sale_category (`name`,`type`,price) VALUES ('$category_name','matr','1000')";
mysqli_query($conn, $sqlInsert);
$lastInsertId = mysqli_insert_id($conn);


execute("INSERT INTO piece (name,price,category_id) VALUES ('$piece_name','$piece_price','$lastInsertId')");




}

}


?>


    


<div class="row mt-5 mb-4  d-flex justify-content-center">
<button class="btn col-lg-2 btn-success " id="addmore">زیادکردنی بەشی تر</button>
<button class="btn col-lg-2 btn-dark mx-5 " type="submit" name="add">زیادکردن</button>
</div>

<div class="row container" id="item_cat">


<form method="post" action="">

<div class="d-flex justify-content-center " style="align-items:center" id="row_id_1">



<div class="form-group mx-2">
<label>بەش هەڵبژێرە</label>
<select name="cat" id="category1" index="1"  class="form-control col-md-10 mx-auto">
                <option disabled selected>بەش هەڵبژێرە</option>
                <?php
                    $getCategory = show(" SELECT * FROM sale_category");
                    foreach ($getCategory as $category) { ?>
                                                
                 <option value="<?=$category['id']?>"> <?=$category['name']?> </option>
                <?php   } ?>
            </select>
 </div>  



 <div class="form-group mx-2">
        <label>ناوی پارچە</label>
            <input type="text" id="piece_name1"
                class="form-control  mx-auto" name="piece_name[]"
            required="">
 </div>  

 <div class="form-group mx-2">
        <label>ژمارەی پارچە</label>
            <input type="text" id="piece_number1"
                class="form-control  mx-auto" name="piece_number[]"
            required="">
 </div>  
 <div class="form-group mx-2">
        <label>نرخی پارچە</label>
            <input type="text" id="piece_price1"
                class="form-control  mx-auto" name="piece_price[]"
            required="">
 </div>  

 <input type="submit" name="" value="offf">



</div>

</form>



    
</div>






<?php require_once('footer.php'); ?>

<script>


$(document).ready(function() {  
    var countCat=1;

    var category_target="category"+countCat;

    $(document).on('change', 'select[name="cat"]', function(){
    
    var index= $(this).attr("index");
    var value= $(this).val();

    $('#piece_name'+index).val("hhhhhhhhhh");

    // alert(index)

                //  $.ajax({
                //     url: "check_number_product.php",
                //     method: "POST",
                //     data: {helka_count:true,type:value},
                //     success: function (data) {
                //         if (data=="false") {
                //           alert("false")
                //         }
                //         if (data=="0") {
                //            alert("0");
                //         }else{
                //             $('#bry_mawa'+index).html("بڕی ماوە : "+data);
                            
                //         }
                //     }
                //  });
    
 });


    $('#addmore').click(function() {


                    countCat=countCat+1;
                    var markup = '<hr> <div class="d-flex justify-content-center " style="align-items:center" id="row_id_'+countCat+'" >';
                    markup+=' <div class="form-group mx-2"> <label>بەش هەڵبژێرە</label> <select name="cat" index="'+countCat+'" id="category'+countCat+'" class="form-control col-md-10 mx-auto"> <option disabled selected>بەش هەڵبژێرە</option> <?php $getCategory = show(" SELECT * FROM sale_category"); foreach ($getCategory as $category) { ?> <option value="<?=$category['id']?>"> <?=$category['name']?> </option> <?php } ?> </select> </div>  <div class="form-group mx-2"> <label>ناوی پارچە</label> <input type="text" id="piece_name'+countCat+'" class="form-control mx-auto" name="piece_name[]" required=""> </div> <div class="form-group mx-2"> <label>ژمارەی پارچە</label> <input type="text" id="piece_number'+countCat+'" class="form-control mx-auto" name="piece_number[]" required=""> </div> <div class="form-group mx-2"> <label>نرخی پارچە</label> <input type="text" id="piece_price'+countCat+'" class="form-control mx-auto" name="piece_price[]" required=""> </div> ';
                    markup+='</div>';
           
                    $('#item_cat').append(markup);


});



})



</script>