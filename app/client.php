<?php require_once('header.php'); ?>


<div class="container-fluid mt-4">
<button onclick="window.history.back()" class="btn btn-sm btn-info shadow" >
 <span class="fa fa-arrow-right"></span>
 گەڕانەوە
  </button>
</div>


<div class="container d-flex justify-content-center mt-2">
<a data-toggle="modal" data-target="#add" style="font-size:16px"  class="btn btn-success " ><i class="fas fa-user-plus "></i>  زیادکردنی کارمەند</a>
</div>


<div class="container-fluid mt-2">
<div class="row m-auto" >
<div class="col-md-12">
<div class="table-responsive">
<table id="example" class="table  table-striped table-bordered  text-center" dir="rtl">
        <thead  style="background-color: #0a0327;color: white">
            <tr>
                <th>ناو</th>
                <th>   ژمارە مۆبایل  </th>
                <th>    بەرواری دەستپێکردن  </th>
                <th>    شوێنی کارکردن  </th>
                <th>   جۆری کارکردن   </th>
                <th> Action </th>
            </tr>
        </thead>
        <tbody>
<?php 
$clients = show(" SELECT * FROM client ");
foreach ($clients as $client) {
  $id = $client['id'];
  $name = $client['name'];
  $phone = $client['phone'];
  $date = $client['date_start'];
  $work_place = $client['work_place'];
  $status = $client['status'];

$get_teams=getdata("SELECT * FROM teams WHERE id= '$work_place'");

$team_name='';
if ($get_teams==null) {
  $team_name=$work_place;
}else{
  $team_name='ستافی '.$get_teams['name'];
}
?>
       <tr>
        <td><?=$name;?></td>
        <td><?=$phone;?></td>
        <td><?=$date;?></td>
        <td><?=$team_name;?></td>
        <td><?php if ($status==0) {echo "مانگانە";}else {echo "ڕۆژانە";}?></td>
        <td>
        <i class="fa fa-trash s-20 cursor" data-toggle="modal" data-target="#delete<?php echo $client['id'] ?>"></i>        
        <i class="fa fa-edit s-20 cursor" data-toggle="modal" data-target="#edit<?php echo $client['id'] ?>" ></i>        
        <i class="fa fa-print s-20 cursor" onclick="window.print()" ></i>  
        <a href="view_client.php?client_id=<?=$id?>"><i  class="fa fa-eye s-20 cursor"></i> </a>        
        </td>
      </tr>
      
<!-- delete modal -->
  <div class="modal fade" id="delete<?php echo $client['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<div class="modal fade" id="edit<?php echo $client['id'] ?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      گۆڕانکاری بکە لە زانیارییەکانی کارمەند 
        </h5>
        <br>
        <form method="POST">
        <div class="form-group">
              <input type="hidden" placeholder="ID " name="id" value="<?=$id;?> " class="form-control col-md-10 mx-auto">
            </div> 

            <label>ناوی سیانی</label>
                <div class="form-group">
                <input type="text" value="<?=$name?>"   name="name"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ژمارە مۆبایل</label>
                <div class="form-group">
                <input type="text" value="<?=$phone?>"   name="phone"   class="form-control col-md-10 mx-auto">
                </div> 

                <label>بەرواری دەستپێکردن</label>
                <div class="form-group">
                <input type="date" value="<?=$date?>"   name="date"   class="form-control col-md-10 mx-auto">
                </div> 

                <label>شوێنی کارکردن</label>
                <div class="form-group">
                    <select name="work_place"  class="form-control col-md-10 mx-auto">
                        <option <?php if($work_place=="1") echo 'selected="selected"'; ?> value="1">ستافی A</option>
                        <option <?php if($work_place=="2") echo 'selected="selected"'; ?> value="2">ستافی B</option>
                        <option <?php if($work_place=="3") echo 'selected="selected"'; ?> value="3">ستافی C</option>
                        <option <?php if($work_place=="کۆمپانیا") echo 'selected="selected"'; ?> value="کۆمپانیا">کۆمپانیا</option>
                    </select>
                </div> 

                <label>جۆری کارکردن</label>
                <div class="form-group">
                    <select name="status"  class="form-control col-md-10 mx-auto">
                        <option <?php if($status=="0") echo 'selected="selected"'; ?>  value="0">مانگانە</option>
                        <option <?php if($status=="1") echo 'selected="selected"'; ?> value="1">ڕۆژانە</option>
                    </select>
                </div>
                 
                 
            
    <button type="submit" name="edit" class="btn btn-success btn-block">  نوێکردنەوەی زانیارییەکان  </button>
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
    $name = secure($_POST['name']);
    $phone = secure($_POST['phone']);
    $date = secure($_POST['date']);
    $work_place = secure($_POST['work_place']);
    $status = secure($_POST['status']);

  $sql = execute("UPDATE `client` SET `name`='$name',`phone`='$phone',`date_start`='$date',`work_place`='$work_place',`status`='$status' WHERE id = '$id'");
    $_SESSION["edit_success"] = "";
    direct('client.php');

}

if (post('del')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM client WHERE id = '$id'");
    $_SESSION["delete"] = "";
    direct('client.php');
    
}

if (post('add')) {
  $name = secure($_POST['name']);
  $phone = secure($_POST['phone']);
  $date = secure($_POST['date']);
  $work_place = secure($_POST['work_place']);
  $status = secure($_POST['status']);

 

  $sql = execute("INSERT INTO `client` (`name`,`phone`,`date_start`,`work_place`,`status`) VALUES('$name','$phone','$date','$work_place','$status')");
    $_SESSION["add_success"] = "";
   direct('client.php');

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
             کارمەند زیاد بکە
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

                <label>بەرواری دەستپێکردن</label>
                <div class="form-group">
                <input type="date"  name="date"   class="form-control col-md-10 mx-auto">
                </div> 

                <label>شوێنی کارکردن</label>
                <div class="form-group">
                    <select name="work_place"  class="form-control col-md-10 mx-auto">
                        <option  value="1">ستافی A</option>
                        <option  value="2">ستافی B </option>
                        <option  value="3">ستافی C</option>
                        <option value="کۆمپانیا">کۆمپانیا</option>
                    </select>
                </div> 

                <label>جۆری کارکردن</label>
                <div class="form-group">
                    <select name="status"  class="form-control col-md-10 mx-auto">
                        <option value="0">مانگانە</option>
                        <option  value="1">ڕۆژانە</option>
                    </select>
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


  <script type="text/javascript">
function printpage()
  {
  window.print()
  }
</script>