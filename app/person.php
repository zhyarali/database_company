<?php require_once('header.php'); ?>


<div class="container d-flex justify-content-around mt-5 flex-wrap">
<a href="xarjy.php"  class="btn btn-dark" style="font-size:16px"><i class="fas fa-arrow-right"></i>  بگەڕێوە پەڕەی خەرجییەکان</a>

<a  data-toggle="modal" data-target="#add" class="btn btn-success" style="font-size:16px"> زیادکردنی کەسەکان   <i class="fas fa-user-plus"></i></a>  

</div>


<div class="container-fluid mt-3">
<div class="row m-auto" >
<div class="col-md-12">
<div class="table-responsive">
<table id="example" class="table  table-striped table-bordered  text-center" dir="rtl">
        <thead  style="background-color: #0a0327;color: white">
            <tr>
                <th>ناوی سیانی</th>
                <th>   ژمارە مۆبایل  </th>
                <th>تێبینی</th>
                <th> Action </th>
            </tr>
        </thead>
        <tbody>
<?php 
$persons = show(" SELECT * FROM person ");
foreach ($persons as $person) {
  $id = $person['id'];
  $name = $person['name'];
  $phone = $person['phone'];
  $note = $person['note'];



?>
       <tr>
        <td><a href="spender.php?id=<?=$id?>"><?=$name;?></a></td>
        <td><?=$phone;?></td>
        <td><?=$note;?></td>
        <td>
        <i class="fa fa-trash s-20 cursor" data-toggle="modal" data-target="#delete<?php echo $person['id'] ?>"></i>        
        <i class="fa fa-edit s-20 cursor" data-toggle="modal" data-target="#edit<?php echo $person['id'] ?>" ></i>        
        </td>
      </tr>
      
<!-- delete modal -->
  <div class="modal fade" id="delete<?php echo $person['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        دڵنیای لە سڕینەوەی ئەم کەسە لەناو سیستەمەکەت ؟
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

<!-- edit modal -->
<div class="modal fade" id="edit<?php echo $person['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-right">
         <div class="container-fluid">
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h6 class="container col-md-12 mt-3  text-center">
      گۆڕانکاری بکە لە زانیارییەکانی خەرجکەر 
        </h6>
        <br>
        <form method="POST">
        <div class="form-group">
              <input type="hidden" placeholder="ID " name="id" value="<?=$id;?> " class="form-control col-md-10 mx-auto">
            </div> 

            <label>ناوی سیانی</label>
                <div class="form-group">
                <input type="text"  value="<?=$name;?>" name="name"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ژمارە مۆبایل</label>
                <div class="form-group">
                <input type="text"  name="phone" value="<?=$phone;?>"  class="form-control col-md-10 mx-auto">
                </div> 

              <label>تێبینی</label>
              <div class="form-group">
                <textarea id="my-textarea" class="form-control" name="note" rows="4"><?=$note?></textarea>
              </div>
                  
            
    <button type="submit" name="edit" class="btn btn-info btn-block">  نوێکردنەوەی زانیارییەکان  </button>
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

</div>


<!-- add driver modal -->
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
             کەس زیاد بکە
        </h5>
        <br>
        <form method="POST">
         
                <label>ناوی سیانی</label>
                <div class="form-group">
                <input type="text"   name="name"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ژمارە مۆبایل</label>
                <div class="form-group">
                <input type="text"  name="phone"   class="form-control col-md-10 mx-auto">
                </div> 


                <label>تێبینی</label>
              <div class="form-group">
                <textarea id="my-textarea" class="form-control" name="note" rows="4"></textarea>
              </div>
                 
            
                
            
    <button type="submit" name="add" class="btn btn-success btn-block">زیادکردنی کەس</button>
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

if (post('edit')) {
    $id = secure($_POST['id']);
    $name = secure($_POST['name']);
    $phone = secure($_POST['phone']);
    $note = secure($_POST['note']);

  $sql = execute("UPDATE `person` SET `name`='$name',`phone`='$phone',`note`='$note' WHERE id = '$id'");
    $_SESSION["edit_success"] = "";
    header("Location: person.php");

}

if (post('del')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM person WHERE id = '$id'");
    $_SESSION["delete"] = "";
    direct('person.php');
    
}

if (post('add')) {
  $name = secure($_POST['name']);
  $phone = secure($_POST['phone']);
  $note = secure($_POST['note']);

 

  $sql = execute("INSERT INTO `person` (`name`,`phone`,`note`) VALUES('$name','$phone','$note')");
    $_SESSION["add_success"] = "";
   direct('person.php');

}

?>
<?php require_once('footer.php'); ?>







  <script type="text/javascript">
function printpage()
  {
  window.print()
  }
</script>