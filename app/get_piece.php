<?php 


include_once("../server/conn.php");


if (isset($_POST['piece'])) {
    $catId=$_POST['catId'];
    $catId=(int)$catId; 
    
    $pieces=show("SELECT * FROM piece WHERE category_id='$catId'");    
    
    foreach ($pieces as $piece) {
      $piece_name=$piece['name'];
      $piece_number=$piece['qty'];
      $piece_price=$piece['price'];

    ?>

<div class="d-flex justify-content-center text-center " style="align-items:center" >
    


 <input type="hidden" name="category_id" value="<?=$catId?>">

<div class="form-group mx-2">
        <label>ناوی پارچە</label>
            <input type="text" id="peice_name1" value="<?=$piece_name?>"
                class="form-control  mx-auto" name="piece_name[]"
            >
 </div>  

 <div class="form-group mx-2">
        <label>ژمارەی پارچە</label>
            <input type="text" id="piece_number1" value="<?=$piece_number?>"
                class="form-control  mx-auto" name="piece_number[]"
            >
 </div>  
 <div class="form-group mx-2">
        <label>نرخی پارچە</label>
            <input type="text" id="piece_price1" value="<?=$piece_price?>"
                class="form-control  mx-auto" name="piece_price[]"
            >
 </div>  


 </div>


<?php

}

}






if (isset($_POST['sale_piece'])) {
    $catId=$_POST['catId'];
    $catId=(int)$catId; 
    
    $pieces=show("SELECT * FROM piece WHERE category_id='$catId'");    
    
    foreach ($pieces as $piece) {
      $id=$piece['id'];
      $piece_name=$piece['name'];
      $piece_number=$piece['qty'];
      $piece_price=$piece['price'];

    ?>

<div class="d-flex justify-content-center text-center " style="align-items:center" id="row<?=$id?>">
    


 <input type="hidden" name="category_id" value="<?=$catId?>">
 <input type="hidden" name="piece_id[]" value="<?=$id?>">

 <input type="hidden" name="current_qty[]" value="<?=$piece_number?>">

<div class="form-group mx-2">
        <label>ناوی پارچە</label>
            <input disabled type="text" id="piece_name1" value="<?=$piece_name?>"
                class="form-control  mx-auto" name="piece_name[]"
            >
 </div>  

 <div class="form-group mx-2">
        <label>ژمارەی پارچە</label>
            <input type="text" id="piece_number1" value="<?=$piece_number?>"
                class="form-control  mx-auto" name="piece_number[]"
            >
 </div>  
 <div class="form-group mx-2">
        <label>نرخی پارچە</label>
            <input type="text" id="piece_price1" value="<?=$piece_price?>"
                class="form-control  mx-auto" name="piece_price[]"
            >
 </div>  


 <div>
    <a class="btn btn-danger btn-sm remove_piece" style="transform:translate(0px,17px);zoom:80%" id="<?=$id?>" >X</a>
 </div>


 </div>


<?php

}

}



function show($sql) {
	global $conn;
	$get =  mysqli_query($conn,$sql);
	$result=[];
	while ($row=mysqli_fetch_assoc($get)) {
		$result[]=$row;
	}
	return $result;
}


?>