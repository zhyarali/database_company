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
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
      
       <form action="" method="POST">
         <div class="modal-body">
           <input type="hidden" id="delete_id" name="delete_id">
         پاراستن
        </div>
        <div class="card-body container">
        <h3 class="text-center"> دڵنیای لە گێڕانەوەی سیستەمەکەت بۆ داتابەیس ؟ </h3>
          <button type="button" class="btn btn-danger" data-dismiss="modal">نەخێر</button>
          <button type="submit" name="restoredb" class="btn btn-success ">بەڵێ</button>
          </div>
       </form>

         
        
      </div>
    </div>
  </div>

<!------------------------------------------ End show Form-------------------------------------------------->

<?php 
if (post('backupdatabase')) {

backup();

}
elseif (post('restoredb')){

restore();

}
?>









<?php require_once('footer.php'); ?>
