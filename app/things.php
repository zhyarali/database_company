<?php require_once('header.php'); ?>
<div class="container-fluid mt-5">
<div class="row m-auto" >
<div class="col-md-4">
<button class="btn btn-success mb-2 container col-md-8 s-20" data-toggle="modal" data-target="#add"> زیادکردنی بەشەکانی فرۆشتن  <i class="fas fa-user-plus s-20"></i></button>
  <div class="table-responsive">
<table id="example" class="table  table-striped table-bordered  text-center" dir="rtl">
        <thead  style="background-color: #0a0327;color: white">
            <tr>
                <th> ناو    </th>
                <th> Action      </th>
            </tr>
        </thead>
        <tbody>
<?php 
$users = show(" SELECT * FROM parts ");
foreach ($users as $u) {
  $id = $u['id'];
  $name = $u['name'];

?>
       <tr>
        <td><?=$name;?></td>
        <td>
        <button class="btn btn-danger text-light delbtn btn-sm" data-toggle="modal" data-target="#delete<?php echo $u['id'] ?>" >
        <i class="fa fa-trash s-14"></i>
        </button>                
        </td>
      </tr>
      
<!-- delete modal -->
  <div class="modal fade" id="delete<?php echo $u['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-center">
         <div class="container-fluid">
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class="container col-md-6 mt-3  text-center">
        دڵنیای لە سڕینەوەی ئەم بەشە لەناو سیستەمەکەت ؟
        </h5>
        <br>
         <form dir="rtl" method="POST">
         <div class="form-group">
              <input type="hidden" placeholder="  ناو  " name="id" value="<?=$id;?> " class="form-control col-md-10 mx-auto">
            </div> 
            <div class="form-group">
              <input type="text" placeholder="  ناو  " name="name" value="<?=$name;?> " class="form-control col-md-10 mx-auto">
            </div>  
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
        </tbody>
    </table>
    </div>

 </div>


 <div class="col-md-8 row">
 <?php 
$users = show(" SELECT * FROM parts ");
foreach ($users as $u) {
  $id = $u['id'];
  $name = $u['name'];

?>
 <div class="card shadow col-md-12 m-2 text-center ">
    <div>
      <h4 class="text-dark mt-3"> <?=$name;?>    </h4>
    </div>
    <div class="card-body">
    <div class="table-responsive">
<table id="example" class="table  table-striped table-bordered  text-center" dir="rtl">
        <thead  style="background-color: #0a0327;color: white">
            <tr>
                <th> ناو    </th>
                <th> پێوانەکەی    </th>
                <th> نرخی کڕین    </th>
                <th> نرخی فرۆشتن    </th>      
                <th> Action      </th>
            </tr>
        </thead>
        <tbody>
<?php 
$users = show(" SELECT * FROM parts ");
foreach ($users as $u) {
  $id = $u['id'];
  $name = $u['name'];

?>
       <tr>
        <td><?=$name;?></td>
        <td><?=$name;?></td><td><?=$name;?></td><td><?=$name;?></td>
        <td>
        <button class="btn btn-danger text-light delbtn btn-sm" data-toggle="modal" data-target="#delete<?php echo $u['id'] ?>" >
        <i class="fa fa-trash s-14"></i>
        </button>                
        </td>
      </tr>
      
<!-- delete modal -->
  <div class="modal fade" id="delete<?php echo $u['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-center">
         <div class="container-fluid">
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class="container col-md-6 mt-3  text-center">
        دڵنیای لە سڕینەوەی ئەم بەشە لەناو سیستەمەکەت ؟
        </h5>
        <br>
         <form dir="rtl" method="POST">
         <div class="form-group">
              <input type="hidden" placeholder="  ناو  " name="id" value="<?=$id;?> " class="form-control col-md-10 mx-auto">
            </div> 
            <div class="form-group">
              <input type="text" placeholder="  ناو  " name="name" value="<?=$name;?> " class="form-control col-md-10 mx-auto">
            </div>  
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
        </tbody>
    </table>
    </div>

          
         <button class="btn btn-success mt-3"> <i class="fal fa-plus"></i></button>
    </div>
  </div>

  <?php } ?>
 </div>
 </div>
 </div>

 
       



  <!-- Add modal -->
  <div class="modal fade" id="add" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-center">
         <div class="container-fluid">
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class="container col-md-6 mt-3  text-center">
        زیادکردنی بەشی نوێ
        </h5>
        <br>
         <form class="mt-5" dir="rtl" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <input type="text" placeholder=" ناوی بەشی فرۆشتن  " class="form-control col-md-10 mx-auto" name="name" required="">
    </div>
  <br>  
    <button type="submit" name="add"  class="btn btn-success btn-block s-20">
    <i class="fal fa-user-plus s-20"></i>    
    زیادکردن  </button>
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

if (post('add')) {
  $name = secure($_POST['name']);
  execute(" INSERT INTO parts(name) VALUES('$name') ");
    msg('سەرکەتووبوو','سەرکەوتووانە زانیارییەکان تۆمارکرا ','success');
  direct('things.php');

}

if (post('del')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM parts WHERE id = '$id'");
    msg('ئاگاداری','سەرکەوتووانە سڕایەوە ','warning');
    direct('things.php');
}

?>
<?php require_once('footer.php'); ?>