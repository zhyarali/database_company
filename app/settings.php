<?php require_once('header.php'); ?>


<div class="container mt-5 p-5">
  <div class="row p-2">
    <div class="card shadow col-md-4 m-2 text-center ">
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



    <div class="card shadow col-md-4 m-2 text-center ">
    <div>
      <h4 class="text-dark mt-3"> گۆڕانکاری لە وەسڵی کۆمپانیا    </h4>
    </div>
    <div class="card-body">
    <form action="" method="POST" enctype="multipart/form-data">
         <div class="form-group mb-3">
            <input for="h" type="text" class="form-control col-md-11 mx-auto"  placeholder=" ناوی کۆمپانیا   " name="file" required="" value="">
          </div>
          <div class="form-group mb-3">
            <input for="h" type="text" class="form-control col-md-11 mx-auto"  placeholder=" تایتڵ " name="file" required="" value="">
          </div>
          <div class="form-group mb-3">
            <input for="h" type="text" class="form-control col-md-11 mx-auto"  placeholder="  ناونیشان   " name="file" required="" value="">
          </div>
          <div class="form-group mb-3">
            <input for="h" type="text" class="form-control col-md-11 mx-auto"  placeholder="  ژمارەی مۆبایل   " name="file" required="" value="">
          </div>
          <div class="form-group mb-3">
            <input for="h" type="text" class="form-control col-md-11 mx-auto"  placeholder="  وێنەی کۆمپانیا    " name="file">
          </div>
    

         <button style="font-size:20px;" class="btn btn-dark btn-lg" data-toggle="modal" data-target="#backup">هەڵگرتن
      <span class="fa fa-database"></span>
    </button>
      </form>
    </div>
  </div>



    <div class="card shadow col-md-3 m-2 text-center ">
    <div>
      <h4 class="text-dark mt-3"> زانیارییەکانی سیستەم    </h4>
    </div>
    <div class="card-body">
    <form action="" method="POST" enctype="multipart/form-data">
         <div class="form-group mb-3">
            <input for="h" type="text" class="form-control col-md-11 mx-auto"  placeholder=" ناوی سیستەم   " name="file" required="" value="">
          </div>
          <div class="form-group mb-3">
            <input for="h" type="text" class="form-control col-md-11 mx-auto"  placeholder="  وێنەی سیستەم    " name="file" required="" value="">
          </div>
    

         <button style="font-size:20px;" class="btn btn-dark btn-lg" data-toggle="modal" data-target="#backup">هەڵگرتن
      <span class="fa fa-database"></span>
    </button>
      </form>
    </div>
  </div>

   




<!------------------------------------------ show Form-------------------------------------------------->


  <div class="modal fade" id="backup">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
      
       <form action="" method="POST">
         <div class="modal-body">
           <input type="hidden" id="delete_id" name="delete_id">
         پاراستن
        </div>
        <div class="card-body container">
        <h3 class="text-center"> دڵنیای لە هەڵگرتن و پاراستنی سیستەمەکەت؟</h3>
          <button type="button" class="btn btn-danger" data-dismiss="modal">نەخێر</button>
          <button type="submit" name="backupdatabase" class="btn btn-success ">بەڵێ</button>
          </div>
       </form>

         
        
      </div>
    </div>
  </div>

<!------------------------------------------ End show Form-------------------------------------------------->




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
  ?>







<?php require_once('footer.php'); ?>
