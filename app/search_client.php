<?php 
ob_start();
session_start();
require_once('../server/helper.php') ;
$user_id = $_SESSION['adm_id'];
$getuser = getdata(" SELECT * FROM admin WHERE id='$user_id'");
   $is_admin = $getuser['type'];
?>





<!-- search client -->


<?php 
if (isset($_POST["client_search"])) {
    
 $search=secure($_POST['client_search']);
 $clients = show(" SELECT * FROM client WHERE `name` LIKE '%".$search."%'");
 if ($clients==null) {
    echo "هیچ زانیارییەک نەدۆزرایەوە ..!";
} ?>



<?php 

foreach ($clients as $client) {
  $id = $client['id'];
  $name = $client['name'];
  $phone = $client['phone'];
  $date = $client['date_start'];
  $image = $client['image'];
  $work_place = $client['work_place'];
  $status = $client['status'];

$get_teams=getdata("SELECT * FROM teams WHERE id='$work_place'");

$team_name='';
if ($get_teams==null) {
  $team_name=$work_place;
}else{
  $team_name='ستافی '.$get_teams['name'];
}
?>
   
   <div class=" col-6 col-sm-6 col-md-4 col-lg-3  col-xl-2  text-center mt-5 mt-lg-0 p-2">
 <a href="view_client.php?client_id=<?=$id?>">
<div class="card " style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2) !important;">
<img class="card-img-top" src='<?php echo $image==null ? "../assets/img/client/default.jpg" :"../assets/img/client/$image" ?>    ' height="180"  alt="profile" >
<div class="card-body pb-2">
<h6 class="card-title"><?=$name?></h6>
<p class="card-text"><?=$phone;?></p>
<p class="card-text"><?=$team_name;?></p>
<p class="card-text"><?php if ($status==0) {echo "مانگانە";}else {echo "ڕۆژانە";}?></p>
<!-- <p class="btn btn-outline-dark btn-sm"><?=$date;?></p> -->
<?php if ($is_admin==1) {?>
<div class="d-flex justify-content-around mt-3">
<a  <?php echo $status==0 ?"data-toggle='modal' data-target='#month$id' " : "data-toggle='modal' data-target='#day$id' " ; ?> class="dropdown-item mx-2  btn btn-primary" style="background-color:#7868E6 !important;" href="#">پێدانی مووچە</a>
<a data-toggle="modal" data-target="#delete<?=$id?>" class="dropdown-item btn  btn-danger" style="background-color:#A6A9B6 !important;">سڕینەوە</a>
</div>
<?php } ?>
</div>
</div>
</a> 

</div>  
   
  

<!-- add month -->

  <!-- add mwcha   modal -->
  <div class="modal fade" id="month<?php echo $client['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content" style="background-color: white;border-radius: 15px;">
            <div class="modal-body text-right">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-md-3">
                        <div class="col-md-12 mb-3 mx-auto">
                            <div class="h-100">
                                <i class="fa fa-times-circle" style="float:left;color: black" data-dismiss="modal"></i>
                                <div class="card-body">
                                    <h5 class="container col-md-6 mt-3  text-center">
                                        مووچە زیاد بکە
                                    </h5>
                                    <br>
                                    <form method="POST">
                                     
                                    <div class="form-group">
              <input type="hidden" placeholder="  ناو  " name="id" value="<?=$id;?> " class="form-control col-md-10 mx-auto">
            </div> 
                                     
                                        <label>بڕی مووچەی مانگانە</label>
                                        <div class="form-group">
                                            <input type="number" name="budget" class="form-control col-md-10 mx-auto" required>
                                        </div>


                                        <label>بڕی غەڕامە</label>
                                        <div class="form-group">
                                            <input type="number" name="punish" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>بۆ کێ ئیشی کردووە</label>
                                        <div class="form-group">
                                        <select name="work_for"  class="form-control col-md-10 mx-auto" required>
                                            <option  value="کۆمپانیا">کۆمپانیا</option>
                                            <option  value="کڕیار">کڕیار</option>
                                            <option  value="فرۆشیار">فرۆشیار</option>
                                        </select>
                                        </div>



                                        <button type="submit" name="add_budget_month"
                                            class="btn btn-dark btn-block">زیادکردن</button>
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
        دڵنیای لە سڕینەوەی ئەم کارمەندە لەناو سیستەمەکەت ؟
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


 


<!-- daily -->

<div class="modal fade" id="day<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content" style="background-color: white;border-radius: 15px;">
            <div class="modal-body text-right">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-md-3">
                        <div class="col-md-12 mb-3 mx-auto">
                            <div class="h-100">
                                <i class="fa fa-times-circle" style="float:left;color: black" data-dismiss="modal"></i>
                                <div class="card-body">
                                    <h5 class="container col-md-6 mt-3  text-center">
                                        مووچە زیاد بکە
                                    </h5>
                                    <br>
                                    <form method="POST">

                                    <input type="hidden" name="id" value="<?=$id?>">

                                        <label>چەن سەعات کاریکردووە</label>
                                        <div class="form-group">
                                            <input type="number" name="work_hour" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>نرخ بۆ هەر سەعاتێکی کارکردن</label>
                                        <div class="form-group">
                                            <input type="number" name="work_hour_amount" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>ئەو سەعاتانەی زیادە کاریکردووە</label>
                                        <div class="form-group">
                                            <input type="number" name="work_extra" class="form-control col-md-10 mx-auto" required>
                                        </div>


                                        <label>بڕی غەڕامە</label>
                                        <div class="form-group">
                                            <input type="number" name="punish" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>بۆ کێ ئیشی کردووە</label>
                                        <div class="form-group">
                                        <select name="work_for"  class="form-control col-md-10 mx-auto" required>
                                            <option  value="کۆمپانیا">کۆمپانیا</option>
                                            <option  value="کڕیار">کڕیار</option>
                                            <option  value="فرۆشیار">فرۆشیار</option>
                                        </select>
                                        </div>

                                       

                                        <button type="submit" name="add_budget_daily"
                                            class="btn btn-dark btn-block">زیادکردن</button>
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


<!-- if input search null -->

<?php }  else{ ?>
    <?php 
$clients = show(" SELECT * FROM client ");
foreach ($clients as $client) {
  $id = $client['id'];
  $name = $client['name'];
  $phone = $client['phone'];
  $date = $client['date_start'];
  $image = $client['image'];
  $work_place = $client['work_place'];
  $status = $client['status'];

$get_teams=getdata("SELECT * FROM teams WHERE id='$work_place'");

$team_name='';
if ($get_teams==null) {
  $team_name=$work_place;
}else{
  $team_name='ستافی '.$get_teams['name'];
}
?>
   
   <div class=" col-6 col-sm-6 col-md-4 col-lg-3  col-xl-2  text-center mt-5 mt-lg-0 p-2">
 <a href="view_client.php?client_id=<?=$id?>">
<div class="card " style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2) !important;">
<img class="card-img-top" src='<?php echo $image==null ? "../assets/img/client/default.jpg" :"../assets/img/client/$image" ?>    ' height="180"  alt="profile" >
<div class="card-body pb-2">
<h6 class="card-title"><?=$name?></h6>
<p class="card-text"><?=$phone;?></p>
<p class="card-text"><?=$team_name;?></p>
<p class="card-text"><?php if ($status==0) {echo "مانگانە";}else {echo "ڕۆژانە";}?></p>
<!-- <p class="btn btn-outline-dark btn-sm"><?=$date;?></p> -->
<?php if ($is_admin==1) {?>
<div class="d-flex justify-content-around mt-3">
<a  <?php echo $status==0 ?"data-toggle='modal' data-target='#month$id' " : "data-toggle='modal' data-target='#day$id' " ; ?> class="dropdown-item mx-2  btn btn-primary" style="background-color:#7868E6 !important;" href="#">پێدانی مووچە</a>
<a data-toggle="modal" data-target="#delete<?=$id?>" class="dropdown-item btn  btn-danger" style="background-color:#A6A9B6 !important;">سڕینەوە</a>
</div>
<?php } ?>
</div>
</div>
</a> 

</div>  
   
  

<!-- add month -->

  <!-- add mwcha   modal -->
  <div class="modal fade" id="month<?php echo $client['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content" style="background-color: white;border-radius: 15px;">
            <div class="modal-body text-right">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-md-3">
                        <div class="col-md-12 mb-3 mx-auto">
                            <div class="h-100">
                                <i class="fa fa-times-circle" style="float:left;color: black" data-dismiss="modal"></i>
                                <div class="card-body">
                                    <h5 class="container col-md-6 mt-3  text-center">
                                        مووچە زیاد بکە
                                    </h5>
                                    <br>
                                    <form method="POST">
                                     
                                    <div class="form-group">
              <input type="hidden" placeholder="  ناو  " name="id" value="<?=$id;?> " class="form-control col-md-10 mx-auto">
            </div> 
                                     
                                        <label>بڕی مووچەی مانگانە</label>
                                        <div class="form-group">
                                            <input type="number" name="budget" class="form-control col-md-10 mx-auto" required>
                                        </div>


                                        <label>بڕی غەڕامە</label>
                                        <div class="form-group">
                                            <input type="number" name="punish" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>بۆ کێ ئیشی کردووە</label>
                                        <div class="form-group">
                                        <select name="work_for"  class="form-control col-md-10 mx-auto" required>
                                            <option  value="کۆمپانیا">کۆمپانیا</option>
                                            <option  value="کڕیار">کڕیار</option>
                                            <option  value="فرۆشیار">فرۆشیار</option>
                                        </select>
                                        </div>



                                        <button type="submit" name="add_budget_month"
                                            class="btn btn-dark btn-block">زیادکردن</button>
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
        دڵنیای لە سڕینەوەی ئەم کارمەندە لەناو سیستەمەکەت ؟
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


 


<!-- daily -->

<div class="modal fade" id="day<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content" style="background-color: white;border-radius: 15px;">
            <div class="modal-body text-right">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-md-3">
                        <div class="col-md-12 mb-3 mx-auto">
                            <div class="h-100">
                                <i class="fa fa-times-circle" style="float:left;color: black" data-dismiss="modal"></i>
                                <div class="card-body">
                                    <h5 class="container col-md-6 mt-3  text-center">
                                        مووچە زیاد بکە
                                    </h5>
                                    <br>
                                    <form method="POST">

                                    <input type="hidden" name="id" value="<?=$id?>">

                                        <label>چەن سەعات کاریکردووە</label>
                                        <div class="form-group">
                                            <input type="number" name="work_hour" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>نرخ بۆ هەر سەعاتێکی کارکردن</label>
                                        <div class="form-group">
                                            <input type="number" name="work_hour_amount" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>ئەو سەعاتانەی زیادە کاریکردووە</label>
                                        <div class="form-group">
                                            <input type="number" name="work_extra" class="form-control col-md-10 mx-auto" required>
                                        </div>


                                        <label>بڕی غەڕامە</label>
                                        <div class="form-group">
                                            <input type="number" name="punish" class="form-control col-md-10 mx-auto" required>
                                        </div>

                                        <label>بۆ کێ ئیشی کردووە</label>
                                        <div class="form-group">
                                        <select name="work_for"  class="form-control col-md-10 mx-auto" required>
                                            <option  value="کۆمپانیا">کۆمپانیا</option>
                                            <option  value="کڕیار">کڕیار</option>
                                            <option  value="فرۆشیار">فرۆشیار</option>
                                        </select>
                                        </div>

                                       

                                        <button type="submit" name="add_budget_daily"
                                            class="btn btn-dark btn-block">زیادکردن</button>
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
      
<?php } ?>