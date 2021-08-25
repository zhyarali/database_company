<?php require_once('header.php'); ?>


<div class="container mt-5 p-5">
  <div class="row p-2">
<div class="col-md-4">

    <div class="card shadow m-2 text-center ">
    <div>
      <h4 class="text-dark mt-3"> زانیارییەکانی سیستەم    </h4>
    </div>
    <div class="card-body">

         <div class="form-group mb-3">
            <input for="h" type="text" class="form-control col-md-11 mx-auto"  placeholder=" ناونیشان    " name="file" required="" value="">
          </div>
          <div class="form-group mb-3">
              <textarea name="msg" class="form-control col-md-11 mx-auto" id="" cols="30" rows="10"></textarea>
          </div>
         <button class="btn btn-success"> زیادکردن
      <i class="fal fa-edit"></i>
    </button>
    </div>
  </div>
  </div>
 
<div class="col-md-8">
  <div class="card shadow col-md-3 m-2 text-center ">
    <div>
      <h4 class="text-dark mt-3"> تێبینیەکان   </h4>
    </div>
    <div class="card-body">
    <div class="form-group mb-3">
           <h6 class="text-right text-danger"> ناونیشان :  سڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاو  </h6>
          </div>
         <div class="form-group mb-3">
           <h6 class="text-right text-success">  سڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاوسڵاو  </h6>
          </div>
         <button class="btn btn-warning"> <i class="fal fa-edit"></i></button>
         <button class="btn btn-danger"> <i class="fal fa-trash"></i></button>
    </div>
  </div>

  </div>
</div>
</div>




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









<?php require_once('footer.php'); ?>
