
<?php require_once('header.php'); ?>

<div class="container d-flex justify-content-around mt-5 flex-wrap">
<a data-toggle="modal" data-target="#add" style="font-size:16px"  class="btn btn-success " ><i class="fas fa-user-plus "></i>  زیادکردنی شۆفێر</a>
<div onclick="window.print()" class="btn  btn-dark "><i class="fas fa-print" style="font-size:18px"></i> پرنتکردن</div>
</div>



<div class="container-fluid mt-2">
<div class="row m-auto" >
<div class="col-md-12">
  <div class="table-responsive">
<table id="example" class="table  table-striped table-bordered  text-center" dir="rtl">
        <thead  style="background-color: #0a0327;color: white">
            <tr>
                <th> ناو    </th>
                <th>  جۆری سەیارە   </th>
                <th>  مۆدێلی سەیارە    </th>
                <th>  ژمارەی سەیارە    </th>
                <th>   ژمارە مۆبایل  </th>
                <th> جۆری کار    </th>
                <th>  پارەدان    </th>
                <th> Action      </th>
            </tr>
        </thead>
        <tbody>
<?php 
$drivers = show(" SELECT * FROM drivers ");
foreach ($drivers as $driver) {
  $id = $driver['id'];
  $name = $driver['name'];
  $car_type = $driver['car_type'];
  $car_model = $driver['car_model'];
  $car_number = $driver['car_number'];
  $phone = $driver['phone'];
  $work_type = $driver['work_type'];
  $money_owner = $driver['money_owner'];
?>
       <tr>
        <td><?=$name;?></td>
        <td><?=$car_type;?></td>
        <td><?=$car_model;?></td>
        <td><?=$car_number;?></td>
        <td><?=$phone;?></td>
        <td><?=$work_type;?></td>
        <td><?=$money_owner;?></td>
        <td>
        <i class="fa fa-trash s-20 cursor" data-toggle="modal" data-target="#delete<?php echo $driver['id'] ?>"></i>        
        <i class="fa fa-edit s-20 cursor" data-toggle="modal" data-target="#edit<?php echo $driver['id'] ?>" ></i>        
        <i class="fa fa-print s-20 cursor" onclick="window.print()" ></i>           
        </td>
      </tr>
      
<!-- delete modal -->
  <div class="modal fade" id="delete<?php echo $driver['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        دڵنیای لە سڕینەوەی ئەم کڕینە لەناو سیستەمەکەت ؟
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
<div class="modal fade" id="edit<?php echo $driver['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      گۆڕانکاری بکە لە زانیارییەکانی کڕین 
        </h5>
        <br>
        <form method="POST">
        <div class="form-group">
              <input type="hidden" placeholder="ID " name="id" value="<?=$id;?> " class="form-control col-md-10 mx-auto">
            </div> 
                <label>ناوی شۆفێر</label>
                <div class="form-group">
                <input type="text" placeholder="  ناوی شۆفێر  " name="name" value="<?=$name;?> " class="form-control col-md-10 mx-auto">
                </div> 
                <label>جۆری سەیارە</label>
                <div class="form-group">
                    <select name="car_type" value="<?=$car_type;?>" class="form-control col-md-10 mx-auto">
                        <option <?php if($car_type=="بچووک") echo 'selected="selected"'; ?> value="بچووک">بچووک</option>
                        <option <?php if($car_type=="گەورە") echo 'selected="selected"'; ?> value="گەورە">گەورە</option>
                    </select>
                </div> 
                <label>مۆدێلی سەیارە</label>
                <div class="form-group">
                <input type="text" placeholder="مۆدێلی سەیارە " name="car_model" value="<?=$car_model;?>"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ژمارەی سەیارە</label>
                <div class="form-group">
                <input type="text"  name="car_number" value="<?=$car_number;?>"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ژمارە مۆبایل</label>
                <div class="form-group">
                <input type="text" placeholder=" ژمارە مۆبایل" name="phone" value="<?=$phone;?>" class="form-control col-md-10 mx-auto">
                </div> 
                <label>جۆری کار</label>
                <div class="form-group">
                    <select name="work_type" value="<?=$work_type;?>" class="form-control col-md-10 mx-auto">
                        <option <?php if($work_type=="بار") echo 'selected="selected"'; ?> value="بار">بار</option>
                        <option <?php if($work_type=="سەعات") echo 'selected="selected"'; ?> value="سەعات">سەعات</option>
                        <option <?php if($work_type=="ڕۆژانە") echo 'selected="selected"'; ?> value="ڕۆژانە">ڕۆژانە</option>
                    </select>
                </div> 
                <label>پارەدان</label>
                <div class="form-group">
                    <select name="money_owner" value="<?=$money_owner;?>" class="form-control col-md-10 mx-auto">
                        <option <?php if($money_owner=="ستاف") echo 'selected="selected"'; ?> value="ستاف">ستاف</option>
                        <option <?php if($money_owner=="کۆمپانیا") echo 'selected="selected"'; ?> value="کۆمپانیا">کۆمپانیا</option>
                        <option <?php if($money_owner=="کڕیار") echo 'selected="selected"'; ?> value="کڕیار">کڕیار</option>
                    </select>
                </div> 
            
    <button type="submit" name="edit" class="btn btn-info btn-block">  نوێکردنەوەی زانیارییەکانی شۆفێر  </button>
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
  $car_type = secure($_POST['car_type']);
  $car_model = secure($_POST['car_model']);
  $car_number = secure($_POST['car_number']);
  $phone = secure($_POST['phone']);
  $work_type = secure($_POST['work_type']);
  $money_owner = secure($_POST['money_owner']);

  $sql = execute("UPDATE `drivers` SET `name`='$name',`car_type`='$car_type',`car_model`='$car_model',`car_number`='$car_number',`phone`='$phone',`work_type`='$work_type',`money_owner`='$money_owner' WHERE id = '$id'");
    $_SESSION["edit_success"] = "";
    header("Location: drivers.php");

}

if (post('del')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM drivers WHERE id = '$id'");
    $_SESSION["delete"] = "";
    direct('drivers.php');
    
}

if (post('add')) {
  $name = secure($_POST['name']);
  $car_type = secure($_POST['car_type']);
  $car_model = secure($_POST['car_model']);
  $car_number = secure($_POST['car_number']);
  $phone = secure($_POST['phone']);
  $work_type = secure($_POST['work_type']);
  $money_owner = secure($_POST['money_owner']);

  $sql = execute("INSERT INTO `drivers` (`name`,`car_type`,`car_model`,`car_number`,`phone`,`work_type`,`money_owner`) VALUES('$name','$car_type','$car_model','$car_number','$phone','$work_type','$money_owner')");
    $_SESSION["add_success"] = "";
   direct('drivers.php');

}

?>
<?php require_once('footer.php'); ?>




<!-- add driver modal -->
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
              شۆفێر زیادبکە
        </h5>
        <br>
        <form method="POST">
         
                <label>ناوی شۆفێر</label>
                <div class="form-group">
                <input type="text" placeholder="  ناوی شۆفێر  " name="name"  class="form-control col-md-10 mx-auto">
                </div> 
                <label>جۆری سەیارە</label>
                <div class="form-group">
                    <select name="car_type"  class="form-control col-md-10 mx-auto">
                        <option value="بچووک">بچووک</option>
                        <option  value="گەورە">گەورە</option>
                    </select>
                </div> 
                <label>مۆدێلی سەیارە</label>
                <div class="form-group">
                <input type="text" placeholder="مۆدێلی سەیارە " name="car_model"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ژمارەی سەیارە</label>
                <div class="form-group">
                <input type="text" placeholder="ژمارەی سەیارە" name="car_number"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ژمارە مۆبایل</label>
                <div class="form-group">
                <input type="text" placeholder=" ژمارە مۆبایل" name="phone"  class="form-control col-md-10 mx-auto">
                </div> 
                <label>جۆری کار</label>
                <div class="form-group">
                    <select name="work_type"  class="form-control col-md-10 mx-auto">
                        <option value="بار">بار</option>
                        <option value="سەعات">سەعات</option>
                        <option value="ڕۆژانە">ڕۆژانە</option>
                    </select>
                </div> 
                <label>پارەدان</label>
                <div class="form-group">
                    <select name="money_owner" class="form-control col-md-10 mx-auto">
                        <option  value="ستاف">ستاف</option>
                        <option  value="کۆمپانیا">کۆمپانیا</option>
                        <option  value="کڕیار">کڕیار</option>
                    </select>
                </div> 
            
    <button type="submit" name="add" class="btn btn-info btn-block">زیادکردنی شۆفێر</button>
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


  <script type="text/javascript">
function printpage()
  {
  window.print()
  }
</script>