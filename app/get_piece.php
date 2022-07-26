<?php 


include_once("../server/conn.php");


if (isset($_POST['piece'])) {
    $catId=$_POST['catId'];
    $catId=(int)$catId; 
    
    $pieces=show("SELECT * FROM piece WHERE category_id='$catId'");    
    
    foreach ($pieces as $piece) {
      $piece_id=$piece['id'];
      $piece_name=$piece['name'];
      $piece_number=$piece['qty'];
      $piece_price=$piece['price'];

    ?>

<div class="d-flex justify-content-center text-center " style="align-items:center" >
    


 <input type="hidden" name="category_id" value="<?=$catId?>">
 <input type="hidden" name="piece_id[]" value="<?=$piece_id?>">

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


      $gettotalpiece = show("  SELECT sum(qty) as 'totalNum' FROM  piece WHERE name='$piece_name' ");
      $totalpiece = $gettotalpiece[0]['totalNum']; 
    
      $gettotalsale = show("  SELECT sum(number) as 'totalsale' FROM  sale_piece WHERE name='$piece_name' ");
      $totalsale = $gettotalsale[0]['totalsale']; 

      $remainqty = $totalpiece-$totalsale;

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
            <input type="text" id="piece_number1" 
                class="form-control  mx-auto" name="piece_number[]"
            >
 </div>  
 <div class="form-group mx-2">
        <label>نرخی پارچە</label>
            <input type="text" id="piece_price1" 
                class="form-control  mx-auto" name="piece_price[]"
            >
 </div>  


  <div>
    <p class=" mx-2  btn btn-dark " style="transform:translate(0px,17px);" id="<?=$id?>" >بڕی ماوە :   <?=$remainqty?></p>
 </div>


 <div>
    <a class="btn btn-danger btn-sm remove_piece" style="transform:translate(0px,17px);" id="<?=$id?>" >X</a>
 </div>


 </div>


<?php

}

}








if (isset($_POST['remove_piece_invoice'])) {
    $id=$_POST['id'];
    $id=(int)$id; 
    
    execute("DELETE FROM sale_piece WHERE id='$id'");
    
    echo "success";

}




if (isset($_POST['sale_piece_invoice'])) {
    $catId=$_POST['catId'];
    $catId=(int)$catId; 
    
    $pieces=show("SELECT * FROM piece WHERE id='$catId'");    
    
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



function execute($sql) {
	global $conn;
	return mysqli_query($conn,$sql);
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