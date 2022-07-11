<?php require_once('header.php'); ?>


<div class="container-fluid mt-4">
<a href="sale_meter.php" class="btn btn-sm btn-info shadow" >
 <span class="fa fa-arrow-right"></span>
 گەڕانەوە
  </a>
</div>


<div class="container d-flex justify-content-center mt-2">
<a data-toggle="modal" data-target="#add" style="font-size:16px"  class="btn btn-success " > زیادکردنی بەشەکانی فرۆشتن بە مەتر</a>
</div>


 
</div>    
<div class="row d-flex justify-content-center mt-3" id="result">


<?php 
$cats = show(" SELECT * FROM sale_category ");
foreach ($cats as $cat) {
  $id = $cat['id'];
  $name = $cat['name'];
  $type = $cat['type'];
  $price = $cat['price']; ?>
   
<div class=" col-6 col-sm-6 col-md-4 col-lg-3  col-xl-3  text-center mt-5 mt-lg-0 p-2">
 <a href="view_sale_category.php?id=<?=$id?>">
<div class="card " style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2) !important;">
<div class="card-body pb-2">
<p class="card-text">ناو : <?=$name?></p>
<p class="card-text">جۆر : <?=$type;?></p>
<p class="card-text">نرخ : <?=$price;?></p>
<div class="d-flex justify-content-around mt-3">

<a data-toggle="modal" data-target="#edit<?=$id?>" class="dropdown-item btn mx-2  btn-danger" style="background-color:#7868E6 !important;">گۆڕانکاری</a>
<a data-toggle="modal" data-target="#delete<?=$id?>" class="dropdown-item btn  btn-warning" style="background-color:#A6A9B6 !important;">سڕینەوە</a>
</div>

</div>
</div>
</a> 

</div>  
   
  
<div class="modal fade" id="edit<?=$id?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-right">
         <div class="container-fluid"> 
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class=" mt-3  text-center">
            گۆڕانکاری بکە لە زانیارییەکانی بەش
        </h5>
        <br>
        <form method="POST" >
         
        <input type="hidden"   name="id" value="<?=$id;?>"  class="form-control col-md-10 mx-auto">


                <label>ناوی بەش</label>
                <div class="form-group">
                <input type="text"   name="name" value="<?=$name;?>"  class="form-control col-md-10 mx-auto">
                </div> 


                <label>نرخ بەپێی مەتر</label>
                <div class="form-group">
                <input type="number"  name="price" value="<?=$price;?>"  class="form-control col-md-10 mx-auto">
                </div>

                          
            
    <button type="submit" name="edit" class="btn btn-success btn-block">گۆڕانکاری</button>
  </form>
      </div>
      </div>
       </div>
  </div>
  </div>
        </div>
      </div>
    </div>
  </div>





<!-- delete modal -->
<div class="modal fade" id="delete<?php echo $cat['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-center">
         <div class="container-fluid">
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class="container col-md-10 mt-3  text-center">
        دڵنیای لە سڕینەوەی ئەم کارمەندە لەناو سیستەمەکەت ؟
        </h5>
        <br>
         <form dir="rtl" method="POST">
         <div class="form-group">
              <input type="hidden" placeholder="  ناو  " name="id" value="<?=$id;?> " class="form-control col-md-10 mx-auto">
            </div> 
            <!-- <div class="form-group">
              <input type="text" placeholder="  ناو  " name="name" value="<?=$name;?> " class="form-control col-md-10 mx-auto">
            </div>   -->
    <button type="submit" name="del" class="btn btn-danger btn-block">  سڕینەوە  </button>
  </form>
      </div>
      </div>
       </div>
  </div>
  </div>
        </div>
      </div>
    </div>
  </div>




<?php
}
?>
        


 </div>

</div>









<!-- add  modal -->
<div class="modal fade" id="add" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-right">
         <div class="container-fluid"> 
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class="container col-md-6 mt-3  text-center">
            بەش زیاد بکە
        </h5>
        <br>
        <form method="POST" >
         
                <label>ناوی بەش</label>
                <div class="form-group">
                <input type="text"   name="name"  class="form-control col-md-10 mx-auto">
                </div> 


                <label>نرخ بەپێی مەتر</label>
                <div class="form-group">
                <input type="number"  name="price"   class="form-control col-md-10 mx-auto">
                </div>

                          
            
    <button type="submit" name="add" class="btn btn-success btn-block">زیادکردنی بەش</button>
  </form>
      </div>
      </div>
       </div>
  </div>
  </div>
        </div>
      </div>
    </div>
  </div>



 



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


if (post('del')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM cat WHERE id = '$id'");
    $_SESSION["delete"] = "";
    direct('cat.php');
    
}

if (post('add')) {
  $name = secure($_POST['name']);
  $price = secure($_POST['price']);

  $sql = execute("INSERT INTO `sale_category` (`name`,`type`,`price`) VALUES('$name','مەتر','$price')");
    $_SESSION["add_success"] = "";
   direct('sale_category.php');

}

if (post('edit')) {
  $id = secure($_POST['id']);
  $name = secure($_POST['name']);
  $price = secure($_POST['price']);

  $sql = execute("UPDATE `sale_category` SET `name`='$name',`price`='$price' WHERE id=$id ");
    $_SESSION["edit_success"] = "";
   direct('sale_category.php');

}




?>
<?php require_once('footer.php'); ?>




<script>
$(document).ready(function(){

  function load_data(search)
 {
  $.ajax({
   url:"search_staff.php",
   method:"POST",
   data:{staff_search:search},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }



    $('#search').on("keyup input", function(){
        /* Get input value on change */
        var search = $(this).val();
        var result = $("#result");
         if(search != '')
        {
          load_data(search);
         }
       else
      {
       load_data();
      }
    });
    
    
});
</script>