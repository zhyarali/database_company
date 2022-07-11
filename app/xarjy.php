<?php require_once('header.php'); ?>

<?php if ($is_admin==1) {?>
<div class="container d-flex justify-content-around mt-5 flex-wrap">
<a  data-toggle="modal" data-target="#add" class="btn btn-success" style="font-size:16px"> زیادکردنی خەرجی   <i class="fas fa-dollar-sign"></i></a>

<a href="person.php"  class="btn btn-dark" style="font-size:16px"> زیادکردنی ئەو کەسانەی خەرجی دەکەن   <i class="fas fa-user-plus "></i></a>

</div>
<?php } ?>


<div class="container-fluid mt-5">
<div class="row m-auto" >
<div class="col-md-12">  
<div class="table-responsive">
<table id="example" class="table  table-striped table-bordered  text-center" dir="rtl">
        <thead  style="background-color: #0a0327;color: white">
            <tr>
                <th>خەرجکراوە لەلایەن</th>
                <th>بۆچی خەرجکراوە</th>
                <th>پارەی وەرگیراو</th>
                <th>بڕی نرخی خەرجکراو</th>
                <th>نرخی ماوە</th>
                <th>جۆری دراو</th>
                <th>شوێن</th>
                <th>   ژمارە مۆبایل  </th>
                <th>بەروار</th>
                <?php if ($is_admin==1) {?> <th> Action </th><?php } ?>
            </tr>
        </thead>
        <tbody>
<?php 
$items = show(" SELECT * FROM xarjy ");
foreach ($items as $item) {
  $id = $item['id'];
  $name = $item['name_item'];
  $price = $item['price'];
  $place = $item['place'];
  $get_price = $item['get_price'];
  $xarj_by = $item['xarj_by'];
  $date = $item['date'];

  $currency_type=$item['currency_type'];
  if ($currency_type=='dinar') {
    $currency_type='دینار';
  }

  if ($currency_type=='dollar') {
    $currency_type='دۆلار';
  }

  if ($currency_type=='tman') {
    $currency_type='تمەن';
  }

  $price_mawa=$get_price - $price;


?>
       <tr>
       <?php
          $persons = show(" SELECT * FROM person WHERE  `id`=$xarj_by");
          foreach ($persons as $person) {
            $name_person = $person['name'];
            $name_person = $person['name'];
        ?>
        <td><a href="spender.php?id=<?=$xarj_by;?>"><?=$name_person;?></a></td>
        <?php } ?>
        <td style="max-width:320px;width:320px;overflow:hidden;word-wrap: break-word;overflow-wrap: break-word;white-space: pre-wrap;"><?=$name;?></td>
        <td><?=$get_price;?></td>
        <td><?=$price;?></td>
        <td><?=$price_mawa;?></td>
        <td><?=$currency_type;?></td>
        <td><?=$place;?></td>
        <?php
          $persons = show(" SELECT * FROM person WHERE  `id`=$xarj_by");
          foreach ($persons as $person) {
            $phone_person = $person['phone'];
        ?>
        <td><?=$phone_person;?></td>
        <td><?=$date;?></td>
        <?php } ?>
        <?php if ($is_admin==1) {?>
        <td>
        <i class="fa fa-trash s-20 cursor" data-toggle="modal" data-target="#delete<?php echo $item['id'] ?>"></i>        
        <i class="fa fa-edit s-20 cursor" data-toggle="modal" data-target="#edit<?php echo $item['id'] ?>" ></i>        
        </td>
        <?php } ?>
      </tr>
      
<!-- delete modal -->
  <div class="modal fade" id="delete<?php echo $item['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        دڵنیای لە سڕینەوەی ئەم خەرجیە لەناو سیستەمەکەت ؟
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
<div class="modal fade" id="edit<?php echo $item['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-right">
         <div class="container-fluid">
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class="container col-md-6 mt-3  text-center">
      گۆڕانکاری بکە لە زانیارییەکانی خەرجی 
        </h5>
        <br>
        <form method="POST">
        <div class="form-group">
              <input type="hidden" placeholder="ID " name="id" value="<?=$id;?> " class="form-control col-md-10 mx-auto">
            </div> 
            <label>بۆچی خەرجکراوە</label>
                <div class="form-group">
                <input type="text"  value="<?=$name;?>" name="name"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>خەرجکراوە لەلایەن</label>
                <div class="form-group">
                    <select name="xarj_by"  class="form-control col-md-10 mx-auto">
                        <?php
                           $persons = show(" SELECT * FROM person");
                           foreach ($persons as $person) {
                            $person_id=$person['id'];                           
                             $name_person = $person['name'];
                        ?>
                        <option <?php if($person_id==$xarj_by) echo 'selected="selected"'; ?> value="<?=$person_id?>"><?=$name_person?></option>
                        <?php } ?>
                    </select>
                </div> 

                <label>بڕی نرخی وەرگیراو</label>
                <div class="form-group">
                <input type="text"  name="get_price" value="<?=$get_price;?>"  class="form-control col-md-10 mx-auto">
                </div>

                <label>بڕی نرخی خەرجکراو</label>
                <div class="form-group">
                <input type="text"  name="price" value="<?=$price;?>"  class="form-control col-md-10 mx-auto">
                </div> 

                <div class="form-group">
                    <select name="currency_type"  class="form-control col-md-10 mx-auto"> 
                        <option value="dinar"  <?php echo $currency_type=='دینار' ? 'selected' : '' ?> >دینار</option>
                        <option value="dollar" <?php echo $currency_type=='دۆلار' ? 'selected' : '' ?>>دۆلار</option>
                        <option value="tman"   <?php echo $currency_type=='تمەن' ? 'selected' : '' ?>>تمەن</option>
                    </select>
                    </div>

                <label>شوێن</label>
                <div class="form-group">
                <input type="text"  name="place" value="<?=$place;?>"  class="form-control col-md-10 mx-auto">
                </div> 
               
                <label>ژمارە مۆبایل</label>
                <?php
          $persons = show(" SELECT * FROM person WHERE  `id`=$xarj_by");
          foreach ($persons as $person) {
            $phone_person = $person['phone'];
        ?>
                <div class="form-group">
                <input type="text" placeholder=" ژمارە مۆبایل" value="<?=$phone_person;?>"  disabled  class="form-control col-md-10 mx-auto">
                </div> 
                <?php } ?>    
            
    <button type="submit" name="edit" class="btn btn-info btn-block">  نوێکردنەوەی خەرجی  </button>
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






<!-- add xarjy modal -->
<div class="modal fade" id="add" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-right">
         <div class="container-fluid">
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class="container col-md-6 mt-3  text-center">
             خەرجی زیاد بکە
        </h5>
        <br>
        <form method="POST">
         
                <label>بۆچی خەرجکراوە</label>
                <div class="form-group">
                <input type="text" placeholder="بۆچی خەرجکراوە" name="name"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>خەرجکراوە لەلایەن</label>
                <div class="form-group">
                    <select name="xarj_by"  class="form-control col-md-10 mx-auto">
                        <?php
                        $items = show(" SELECT * FROM person ");
                        foreach ($items as $item) {
                          $id = $item['id'];
                          $name = $item['name'];
                          $phone = $item['phone'];
                        ?>
                        <option value="<?=$id?>"><?=$name?></option>
                        <?php } ?>
                    </select>
                </div>

                <label>بڕی نرخی وەرگیراو</label>
                <div class="form-group">
                <input type="text" name="get_price"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>بڕی نرخی خەرجکراو</label>
                <div class="form-group">
                <input type="text" placeholder="نرخ" name="price"  class="form-control col-md-10 mx-auto">
                </div> 

                <div class="form-group">
                  <label for="" class="float-end">جۆری دراو</label>
                 <select name="currency_type"  class="form-control col-md-10 mx-auto"> 
                  <option value="dinar">دینار</option>
                  <option value="dollar">دۆلار</option>
                  <option value="tman">تمەن</option>
              </select>
               </div>

                <label>شوێن</label>
                <div class="form-group">
                <input type="text"  name="place"  class="form-control col-md-10 mx-auto">
                </div> 

                
            
    <button type="submit" name="add" class="btn btn-info btn-block">زیادکردنی خەرجی</button>
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
    $price = secure($_POST['price']);
    $xarj_by = secure($_POST['xarj_by']);
    $place = secure($_POST['place']);
    $get_price = secure($_POST['get_price']);
    $currency_type = secure($_POST['currency_type']);

  $sql = execute("UPDATE `xarjy` SET `name_item`='$name',`price`='$price',`place`='$place',`get_price`='$get_price',`xarj_by`='$xarj_by',`currency_type`='$currency_type' WHERE id = '$id'");
    $_SESSION["edit_success"] = "";
    header("Location: xarjy.php");

}

if (post('del')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM xarjy WHERE id = '$id'");
    $_SESSION["delete"] = "";
    direct('xarjy.php');
    
}

if (post('add')) {
  $name = secure($_POST['name']);
  $price = secure($_POST['price']);
  $xarj_by = secure($_POST['xarj_by']);
  $date =date("Y-m-d");
  $place = secure($_POST['place']);
  $get_price = secure($_POST['get_price']);
  $currency_type = secure($_POST['currency_type']);

  $sql = execute("INSERT INTO `xarjy` (`name_item`,`price`,`place`,`get_price`,`xarj_by`,`date`,`currency_type`) VALUES('$name','$price','$place','$get_price','$xarj_by','$date','$currency_type')");
    $_SESSION["add_success"] = "";
   direct('xarjy.php');

}

?>
<?php require_once('footer.php'); ?>





  <script type="text/javascript">
function printpage()
  {
  window.print()
  }
</script>