<?php require_once('header.php'); ?>


<div class="container-fluids p-3">
  <div class=" d-flex justify-content-center p-2">


    <div class="card shadow col-lg-4 m-2 text-center ">
    <div>
      <h4 class="text-dark mt-3"> زانیارییەکانی سیستەم    </h4>
    </div>
    <div class="card-body">
      <?php $select = show(" SELECT * FROM system ");
      foreach($select as $row) {
          $id = $row['id'];
          $name = $row['name'];
          $avatar = $row['avatar'];

?>
        <form action="" method="POST" enctype="multipart/form-data">
         <div class="form-group mb-3">
            <input for="h" type="text" class="form-control col-md-11 mx-auto"  placeholder=" ناوی سیستەم   " name="name" required="" value="<?=$name;?>">
          </div>

          <div class="form-group mb-3">
            <img src="../assets/img/system/<?=$avatar;?>" class="form-control col-md-11 mx-auto"  placeholder=" ناوی سیستەم   "    required="">
          </div>


          <div class="form-group mb-3">
            <input for="h" type="file" class="form-control col-md-11 mx-auto"  placeholder="  وێنەی سیستەم    " name="avatar" required="" value="">
          </div>
         <button class="btn btn-dark btn-lg" type="submit" name="edit"> نوێکردنەوە
      <i class="fal fa-edit"></i>
    </button>
    </form>
    <?php } ?>
    </div>
  </div>



    <div class="card shadow col-lg-4 m-2 ">
    <div>
      <h4 class="text-dark mt-3 text-center"> گۆڕانکاری لە وەسڵی کۆمپانیا    </h4>
    </div>
    <div class="card-body">
    <form action="" method="POST" enctype="multipart/form-data">

<?php 

$company_invoice=getdata("SELECT * FROM company_invoice");
$name=$company_invoice['name'];
$title=$company_invoice['title'];
$desc=$company_invoice['description'];
$address=$company_invoice['address'];
$avatar=$company_invoice['image'];

?>


         <div class="form-group mb-3">
          <label>ناوی کۆمپانیا</label>
            <input for="h" type="text" class="form-control col-md-11 mx-auto"   name="name" required="" <?php echo empty($name) ? 'placeholder=" ناوی کۆمپانیا"' : 'value="'.$name.'"' ?> >
          </div>
          <div class="form-group mb-3">
          <label>تایتڵ</label>
            <input for="h" type="text" class="form-control col-md-11 mx-auto"  <?php echo empty($title) ? 'placeholder="تایتڵ"' : 'value="'.$title.'"' ?> name="title" required="" >
          </div>
          <div class="form-group mb-3">
          <label>درێژە - پێناسە</label>
            <input for="h" type="text" class="form-control col-md-11 mx-auto" <?php echo empty($desc) ? 'placeholder="درێژە"' : 'value="'.$desc.'"' ?>  name="desc" required="" >
          </div>
          <div class="form-group mb-3">
          <label>ناونیشان</label>
            <input for="h" type="text" class="form-control col-md-11 mx-auto" <?php echo empty($address) ? 'placeholder="ناونیشان"' : 'value="'.$address.'"' ?>  name="address" required="" >
          </div>

          
         <center>
            <img src="../assets/img/company_invoice/<?=$avatar;?>" class="text-center mb-3 shadow" style="border-radius:10px"  width="220px">
            </center>

          <div class="form-group mb-3">
            <input type="file" type="text" class="form-control col-md-11 mx-auto"  placeholder="  وێنەی کۆمپانیا    " name="file" required>
          </div>
    

          <center>

         <button type="submit" style="font-size:18px;" class="btn btn-dark btn-lg mx-auto" name="edit_invoice">سەیڤ
      <span class="fa fa-database"></span>
    </button>

      </center>

      </form>
    </div>
  </div>


  <div class="card shadow col-lg-4 m-2 text-center ">
    <div>
      <h4 class="text-dark mt-3">ژمارە مۆبایلی  وەسڵی کۆمپانیا</h4>
    </div>
    <div class="card-body">

        <form action="" method="POST" enctype="multipart/form-data">

         <div class="form-group mb-3">
            <input for="h" type="text" class="form-control col-md-11 mx-auto"  placeholder="ناو و ژمارە مۆبایل بنووسە" name="name" required="" >
          </div>


         <button class="btn btn-success " type="submit" name="add_phone"> زیادکردن
      <i class="fal fa-plus"></i>
    </button>
    </form>


    <hr>

        <!-- edit -->

  <div class="mt-5">
  <form action="" method="POST" enctype="multipart/form-data">
  <h6 class="text-dark mt-3 mb-3">گۆڕانکاری</h6>

<?php 

$phones=show("SELECT * FROM invoice_phone");

foreach($phones as $phone){

?>

<input type="hidden" name="id[]" value="<?=$phone['id']?>">

  <div class="form-group mb-3 d-flex" id="row<?=$phone['id']?>">
        <input for="h" type="text" class="form-control  mx-auto"  value="<?=$phone['name']?>" name="name[]" required="" >
        <a id="<?=$phone['id']?>"  class="btn remove_phone btn-danger btn-sm mx-2" style="zoom:80%;transform:translate(0px,7px)">X</a>
  </div>

<?php } ?>  

  
  <button class="btn btn-dark " type="submit" name="edit_phone"> گۆڕانکاری
      <i class="fal fa-edit"></i>
    </button>
    </form>

  </div>  



    </div>

  </div>


  
      </div>
      </div>



<?php 
   if (post('edit')) {
    $name = secure($_POST['name']);
    $avatar = upload('avatar','../assets/img/system/');
    if ($avatar!=null) {
    $get = getdata(" SELECT * FROM system");
    $oldavatar = $get['avatar'];
    unlink('../assets/img/system/'.$oldavatar);
    execute(" UPDATE system SET avatar='$avatar'");
    }
    $sql = execute(" UPDATE system SET name='$name'");
    direct("settings.php");
}  




if (post('edit_invoice')) {
  $name = secure($_POST['name']);
  $desc = secure($_POST['desc']);
  $title = secure($_POST['title']);
  $address = secure($_POST['address']);

  $avatar = upload('file','../assets/img/company_invoice/');

  $getdata = getdata(" SELECT * FROM company_invoice");


  if (empty($getdata)) {
    execute("INSERT INTO company_invoice (`name`,`description`,`title`,`address`,`image`) VALUES('$name','$desc','$title','$address','$avatar')");
  }

  else{
    $get = getdata(" SELECT * FROM company_invoice");
    $oldavatar = $get['image'];
    unlink('../assets/img/company_invoice/'.$oldavatar);

    execute("UPDATE company_invoice SET  `name`='$name',`description`='$desc' , `title`='$title',`address`='$address',`image`='$avatar'");
  }

  direct("settings.php");

}




if (post('add_phone')) {
  $name = secure($_POST['name']);
  execute("INSERT INTO invoice_phone (`name`) VALUES ('$name')");
  direct("settings.php");
}




if (post('edit_phone')) {

  $number =$_POST['name'];


  for ($i = 0; $i < count($number); $i++) {

    $id=$_POST['id'][$i];
    $name =$_POST['name'][$i];

  execute("UPDATE invoice_phone SET `name`='$name' WHERE id='$id' ");

  }

  direct("settings.php");
}



  ?>







<?php require_once('footer.php'); ?>


<script>

$(document).ready(function() {



  $(document).on('click','.remove_phone',function(){
    var row_id=$(this).attr("id");


          $.ajax({
                    url: "remove_company_phone.php",
                    method: "POST",
                    data: {remove_phone:true,id:row_id},
                    success: function (data) {
                        if (data=="success") {
                            $('#row'+row_id).remove();
                        }
                       
                    }
                 });
  
  });



});


</script>
