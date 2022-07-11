<?php 
ob_start();
session_start();
require_once('../server/helper.php') ; ?>








<?php if (isset($_POST["name"])) {

$name =$_POST["name"];
$id=$_POST["id"];

execute("INSERT INTO `piece` (`name`,`category_id`) VALUES('$name','$id') "); ?>


<?php 
$piece = show("SELECT * FROM piece WHERE `category_id`=$id ");

foreach ($piece as $pc){
    $name = $pc['name']; ?>

    <a  class="btn btn-secondary btn-sm mx-2 remove_item" style="border-radius:10px !important">  <i style="font-size:12px !important;position:absolute;left:8px;top:10px" class="fa fa-times-circle"></i> <?=$name?></a>
<?php } ?>



<?php } ?>  




<?php if (isset($_POST["id_item"])) { 
    $id=$_POST["id_item"]; 
    $id_cat=$_POST["id_cat"]; 

    $sql = execute(" DELETE  FROM piece WHERE id='$id'");

?>


<?php } ?>     



<!-- select option category to get piece -->

<?php if (isset($_POST["id_category"])) {
    $id=$_POST["id_category"];   
    $getPiece=show(" SELECT * FROM piece WHERE category_id=$id "); 
    foreach ($getPiece as $piece) {
    
    
?>

<input type="checkbox" class="btn-check" name="check[]"  id="btncheck<?=$piece['id'] ?>" value="<?=$piece['name'] ?>" autocomplete="off">
  <label class="btn btn-outline-dark" style="border-radius:10px !important" for="btncheck<?=$piece['id'] ?>"><?=$piece['name'] ?></label>


<?php } } ?>  



<!-- select option category to  update get piece -->

<?php if (isset($_POST["id_category_update"])) {
    $id=$_POST["id_category_update"];  

    $checkpiece=explode(',',$_POST["piece"]);   



    $getPiece=show(" SELECT * FROM piece WHERE category_id=$id "); 
    foreach ($getPiece as $piece) {
    
    
?>

<input type="checkbox" class="btn-check" name="check[]"  <?php foreach ($checkpiece as $item) {if ($item==$piece['name']) {echo 'checked="checked" ';}}?>
  id="check<?=$piece['id'] ?>" value="<?=$piece['name'] ?>" autocomplete="off">
  <label class="btn btn-outline-dark" style="border-radius:10px !important" for="check<?=$piece['id'] ?>"><?=$piece['name'] ?></label>


<?php } } ?>  
