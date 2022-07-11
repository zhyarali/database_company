<?php require_once('header.php'); ?>


<?php 
$category_id=$_GET['id'];
$data = show(" SELECT * FROM sale_category WHERE `id`=$category_id");

if (empty($data)) {
  direct('index.php');
}else{


foreach ($data as $category) {
    $id = $category['id'];
    $name = $category['name'];
    $type = $category['type'];
    $price = $category['price']; ?>


<div class="container-fluid mt-4">
<a href="sale_category.php" class="btn btn-sm btn-info shadow" >
 <span class="fa fa-arrow-right"></span>
 گەڕانەوە
  </a>
</div>
 

<div class="container-fluid  mt-3 d-flex justify-content-center">
        <p  class="btn btn-dark " style="font-size:16px"> زیادکردنی پارچە بۆ بەشی <?=$name?></p>
</div>


<div class="container">
<div class="row d-flex justify-content-center mt-3" >


    <div class="d-flex justify-content-center">
         <div class="form-group col-lg-4">
              <input type="text " id="name_piece" placeholder="ناوی پارچە بنوسە و گرتە بکە بۆ زیادکردن" name="id" class="form-control  mx-auto">
         </div> 


              <input type="hidden" id="id_item" value="<?=$id?>" class="form-control  mx-auto">


         <a id="add_item"  class="btn btn-dark mx-2" style="background:#7868E6 !important;"><i class="fas fa-add" style="font-size:18px"></i>  زیادکردن </a>
         </div> 

</div>

</div>


<div class="container">
<div class="mt-5"  role="group" id="show_data">

<?php 
$piece = show("SELECT * FROM piece WHERE `category_id`=$id ");

foreach ($piece as $pc){
    $id_piece = $pc['id']; 
    $name = $pc['name']; 
?>
    <input type="hidden" id="id_piece" value="<?=$id_piece?>" class="form-control  mx-auto">

    <a class="btn btn-secondary btn-sm mx-2 remove_item" style="border-radius:10px !important">  <i style="font-size:12px !important;position:absolute;left:8px;top:10px" class="fa fa-times-circle"></i> <?=$name?></a>
<?php } ?>
</div>
</div>
    
 
  
<?php require_once('footer.php'); } } ?>





<?php
 if (isset($_SESSION["edit_success"])) {
    msg('سەرکەتووبوو','سەرکەوتووانە  گۆڕانکاری لەزانیارییەکان کرا ','success');
     unset($_SESSION["edit_success"]);
 }

 if (isset($_SESSION["add_success"])) {
    msg('سەرکەتووبوو','سەرکەوتووانە زانیارییەکان تۆمارکرا ','success');
     unset($_SESSION["add_success"]);
 }

 if (isset($_SESSION["delete"])) {
    msg('ئاگاداری','سەرکەوتووانە سڕایەوە ','warning');
    unset($_SESSION["delete"]);
 }

 
 ?>
 




<?php 

// add project

if (post('add_project')) {

    $id = secure($_POST['id']);
    $name = secure($_POST['project_name']);
    $get_price = secure($_POST['get_price']);
    $xarjy = secure($_POST['xarjy']);
    $date =date('Y-m-d');
    $address = secure($_POST['address']);
    $owner = secure($_POST['owner']);
    $note = secure($_POST['note']);
  
  $sql = execute("INSERT INTO `staff_work` (`name`,`get_price`,`xarjy`,`date`,`address`,`owner`,`note`,`category_id`) VALUES('$name','$get_price','$xarjy','$date','$address','$owner','$note','$id')");
  
  $_SESSION["add_success"] = "";
  $loc="view_staff.php?category_id=".$id;
  direct($loc);
  }



// edit project 
if (post('edit_project')) {

    $id = secure($_POST['id']);
    $name = secure($_POST['project_name']);
    $get_price = secure($_POST['get_price']);
    $xarjy = secure($_POST['xarjy']);
    $address = secure($_POST['address']);
    $owner = secure($_POST['owner']);
    $note = secure($_POST['note']);
  
  $sql = execute("UPDATE `staff_work` SET `name`='$name',`get_price`='$get_price',`xarjy`='$xarjy',`address`='$address',`owner`='$owner',`note`='$note' WHERE `category_id`='$id'");
  

  $_SESSION["add_success"] = "";
  $loc="view_staff.php?category_id=".$id;
  direct($loc);
  
  }



//   delete project
if (post('delete_project')) {
    $category_id=$_GET['category_id'];
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM staff_work WHERE id= '$id'");
    $_SESSION["delete"] = "";
    $loc="view_staff.php?category_id=".$category_id;
    direct($loc);
    
}



// edit category
if (post('edit_staff')) {
    $id = secure($_POST['id']);
    $name = secure($_POST['name']);
    $manager = secure($_POST['manager']);
    $phone = secure($_POST['phone']);
    $note = secure($_POST['note']);
  
    $sql = execute("UPDATE  `category` SET `name`='$name',`manager`='$manager',`phone`='$phone',`note`='$note' WHERE id='$id'");
      $_SESSION["add_success"] = "";
      $loc="view_staff.php?category_id=".$id;
      direct($loc);
  
  }

?>




<script>
  $(document).ready(function () {
 
    $('#add_item').click(function () {
      var name = $('#name_piece').val();
      var id_item = $('#id_item').val();
      if (name != '') {
        $.ajax({
          url: "sale_category_action.php",
          method: "POST",
          data: {name: name ,id:id_item},
          success: function (data) {
            $('#show_data').html(data);
            $('#name_piece').val("");
            location.reload();
          }
        });
      }
      else {
        alert("تکایە بەبەتاڵی جێی مەهێڵە !");
      }
    });


    $(document).on("keypress", "#name_piece", function(e){
      var name = $('#name_piece').val();
      var id_item = $('#id_item').val();
    
      if(e.which == '13'){

        $.ajax({
          url: "sale_category_action.php",
          method: "POST",
          data: {name: name ,id:id_item},
          success: function (data) {
            $('#show_data').html(data);
            $('#name_piece').val("");
            location.reload();
          }
        });

    }
    
    });



    $('.remove_item').click(function () {
       var id = $('#id_item').val();
      var id_item = $('#id_piece').val();

        $.ajax({
          url: "sale_category_action.php",
          method: "POST",
          data: {id_item:id_item,id_cat:id},
          success: function (data) {
            if (data) {
                location.reload();
            }
          }
        });
    
    });



  });
</script>