<?php require_once('header.php'); ?>


<div class="container mt-5 p-5">
  <div class="row p-2">
    <div class="card shadow col-md-4 text-center ">
    <div>
      <h2 class="text-dark mt-3"> پاراستنی سیستەم  </h2>
    </div>
    <div class="card-body">
         <button style="font-size:20px;" class="btn btn-dark btn-lg" data-toggle="modal" data-target="#backup">هەڵگرتن
      <span class="fa fa-database"></span>
    </button>
    </div>
  </div>

<div class="col-md-2">
  
</div>


    <div class="card shadow col-md-4 text-center ">
    <div class="text-dark mt-3">
      <h2> گێڕانەوەی سیستەم  </h2>
    </div>
    <div class="card-body">
         <button style="font-size:20px;" class="btn btn-dark btn-lg" data-toggle="modal" data-target="#restore"> گێڕانەوە   
      <span class="fa fa-database"></span>
    </button>
    </div>
  </div>
<br>
  
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






<!------------------------------------------ show Form-------------------------------------------------->



  <div class="modal fade" id="restore">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header" dir="ltr">
        <button class="btn-danger  border-0 btn-sm" data-dismiss="modal">X</button>
        <h4 class="modal-title text-dark"> گەڕاندنەوەی داتابەیس  </h4>
      </div>
      <div class="modal-body text-center">
        <form action="" method="POST" class="text-center" enctype="multipart/form-data">
<div class="form-group">
  <label class="text-dark">فایل</label>
  <label for="files"  class="upload"></label>
<input id="files" type="file"  class="form-control"  name="path" required="">
</div>
<button class="btn btn-success m-2 w-50 btn-lg" name="restoredb" type="submit"><span class="fa fa-save"></span> گەڕاندنەوە </button>
        </form>
      </div>
    </div>
  </div>
</div>


<!------------------------------------------ End show Form-------------------------------------------------->

<?php 
if (isset($_SESSION["backup"])) {
  msg('سەرکەوتوبوو','پاراستنی داتابەیسەکە سەرکەوتوو بوو.','success');
   unset($_SESSION["backup"]);
}


if (isset($_SESSION["restore"])) {
  msg('سەرکەوتوبوو','گەڕاندنەوەی داتابەیسەکە سەرکەوتوو بوو','success');
   unset($_SESSION["restore"]);
}


if (post('backupdatabase')) {

backup();
$_SESSION["backup"]="";
direct("backup.php");

}
elseif (post('restoredb')){

  $file = $_FILES['path']['name'];
  $path='C:/Users/'.get_current_user().'/Desktop/backup/'.$file.' ';


 
  $handle = fopen($path,"r+");
  $contents = fread($handle,filesize($path));
  
  $sql = explode(';',$contents);
  foreach($sql as $query){
    $result = mysqli_query($conn,$query);
  }
  fclose($handle);
  

  $_SESSION["restore"]="";
  direct("backup.php");

  // print_r($path);

}
?>









<?php require_once('footer.php'); ?>
