<?php require_once('header.php'); ?>


<div class="container-fluid mt-4">
<a href="index.php" class="btn btn-sm btn-info shadow" >
 <span class="fa fa-arrow-right"></span>
 گەڕانەوە
  </a>
</div>

<?php if ($is_admin==1) {?>
<div class="container d-flex justify-content-center mt-2">
<a data-toggle="modal" data-target="#add" style="font-size:16px"  class="btn btn-success " ><i class="fas fa-user-plus "></i>  زیادکردنی کارمەند</a>
</div>
<?php } ?>


<div class="container-fluid ">
<div class="row d-flex justify-content-center">
<div class="form-group col-10 col-lg-3 col-md-8">
    <input type="text" id="search" class="form-control " placeholder="بگەڕی بۆ ناوی کارمەند ...">
</div>
</div> 
   
<div class="row d-flex justify-content-center" id="result">


<?php 
$clients = show(" SELECT * FROM client ");
foreach ($clients as $client) {
  $id = $client['id'];
  $name = $client['name'];
  $image = $client['image'];
  $phone = $client['phone'];
  $date = $client['date_start'];
  $work_place = $client['work_place'];
  $bry_para = $client['bry_para'];
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
                                     
                                        <label>بڕی پاداشت</label>
                                        <div class="form-group">
                                            <input type="number" name="reward" class="form-control col-md-10 mx-auto" >
                                        </div>

                                        <label>بڕی غەڕامە</label>
                                        <div class="form-group">
                                            <input type="number" name="punish" class="form-control col-md-10 mx-auto" >
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

                                    <input type="hidden" class="daily_client_id" name="id" value="<?php echo $client['id'] ?>">
                                    <input type="hidden"  name="bry_para" value="<?=$bry_para?>">
                                           
                                        <label>چەن سەعات کاریکردووە</label>
                                        <div class="form-group">
                                            <input id="work_hour_daily" type="number"  name="work_hour" class="form-control col-md-10 mx-auto" required>
                                        </div>


                                        <label>ئەو سەعاتانەی زیادە کاریکردووە</label>
                                        <div class="form-group">
                                            <input type="number" name="work_extra" class="form-control col-md-10 mx-auto" >
                                        </div>

                                        <label>بڕی پاداشت</label>
                                        <div class="form-group">
                                            <input type="number" name="reward" class="form-control col-md-10 mx-auto" >
                                        </div>

                                        <label>بڕی غەڕامە</label>
                                        <div class="form-group">
                                            <input type="number" name="punish" class="form-control col-md-10 mx-auto" >
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
        


 </div>

</div>









<!-- add  modal -->
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
             کارمەند زیاد بکە
        </h5>
        <br>
        <form method="POST" enctype="multipart/form-data">
         
                <label>ناوی سیانی</label>
                <div class="form-group">
                <input type="text"   name="name"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>وێنە</label>
                <div class="form-group">
                <input type="file"   name="image"  class="form-control col-md-10 mx-auto" required>
                </div> 

                <label>ژمارە مۆبایل</label>
                <div class="form-group">
                <input type="text"  name="phone"   class="form-control col-md-10 mx-auto">
                </div> 

                <div class="form-group">
                  <label for="" class="float-end">جۆری دراو</label>
                 <select name="currency_type"  class="form-control col-md-10 mx-auto"> 
                  <option value="dinar">دینار</option>
                  <option value="dollar">دۆلار</option>
                  <option value="tman">تمەن</option>
              </select>
               </div>

                <label>جۆری کارکردن</label>
                <div class="form-group">
                    <select id="client_status" name="status"  class="form-control col-md-10 mx-auto">
                      <option id="client_daily" value="1">ڕۆژانە</option>
                      <option id="client_monthly"  value="0">مانگانە</option>
                    </select>
                </div> 

              <div id="daily_amount" >
                <label>بڕی پارەی کارکردنی ڕۆژانە</label>
                <div class="form-group">
                  <input type="text"  name="bry_para"   class="form-control col-md-10 mx-auto">
                </div>
              </div>

              <div class="d-none" id="budget_amount">
              <label>بڕی مووچەی مانگانە</label>
              <div class="form-group">
                  <input type="number" name="budget" class="form-control col-md-10 mx-auto">
                </div>
              </div>


                <!-- <label>بەرواری دەستپێکردن</label>
                <div class="form-group">
                <input type="date"  name="date"   class="form-control col-md-10 mx-auto">
                </div>  -->

                <label>شوێنی کارکردن</label>
                <div class="form-group">
                    <select name="work_place"  class="form-control col-md-10 mx-auto">
                        <option  value="1">ستافی A</option>
                        <option  value="2">ستافی B </option>
                        <option  value="3">ستافی C</option>
                        <option value="کۆمپانیا">کۆمپانیا</option>
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
  $image =upload('image','../assets/img/client/');
  $phone = secure($_POST['phone']);
  $date =date('Y-m-d');
  $work_place = secure($_POST['work_place']);
  $status = secure($_POST['status']);
  $bry_para=secure($_POST['bry_para']);
  $budget=secure($_POST['budget']);
  $currency_type=secure($_POST['currency_type']);
  if (empty($bry_para)) {
    $bry_para="0";
  }

  if (empty($budget)) {
    $budget="0";
  }
 

  $sql = execute("INSERT INTO `client` (`name`,`image`,`phone`,`date_start`,`work_place`,`bry_para`,`status`,`currency_type`,`budget_month`) VALUES('$name','$image','$phone','$date','$work_place','$bry_para','$status','$currency_type','$budget')");
    $_SESSION["add_success"] = "";
   direct('client.php');

}




// add mangana

if (post('add_budget_month')) {

  $id = secure($_POST['id']);
  $budget = secure($_POST['budget']);   
  $debt = secure($_POST['debt']);
  $date_budget =date('Y-m-d');
  $punish = secure($_POST['punish']);
  $reward = secure($_POST['reward']);
  $work_for = secure($_POST['work_for']);

if (empty($reward)) {
  $reward=0;
}

if (empty($punish)) {
  $punish=0;
}


$sql = execute("INSERT INTO `budget` (`budget_amount`,`punish`,`reward`,`date`,`work_for`,`clientid`) VALUES('$budget','$punish','$reward','$date_budget','$work_for','$id')");

$_SESSION["add_success"] = "";
  $loc="client.php";
 direct($loc);

}



// add rozhana

if (post('add_budget_daily')) {
$id =secure($_POST['id']);
$work_hour = secure($_POST['work_hour']);
$work_extra = secure($_POST['work_extra']);
$date =date('Y-m-d');
$punish = secure($_POST['punish']);

$bry_para = secure($_POST['bry_para']);

$reward = secure($_POST['reward']);
$work_for = secure($_POST['work_for']);


if (empty($reward)) {
  $reward=0;
}

if (empty($work_extra)) {
  $work_extra=0;
}

if (empty($punish)) {
  $punish=0;
}

// static  calculation  >>> the hour of working daily is 10 and static
$work_hour_amount=$bry_para/10; 

$all_hour=$work_hour+$work_extra; 


$budget=$work_hour_amount*$all_hour;

$budget=(int)$budget+$reward;
$budget=$budget-$punish;


$sql = execute("INSERT INTO `work_daily` (`work_hour`,`work_hour_amount`,`work_extra`,`budget`,`punish`,`reward`,`date`,`work_for`,`clientid`) VALUES('$work_hour','$work_hour_amount','$work_extra','$budget','$punish','$reward','$date','$work_for','$id')");

$_SESSION["add_success"] = "";
$loc="client.php";
direct($loc);

}



?>
<?php require_once('footer.php'); ?>




<script>
$(document).ready(function(){

  function load_data(search)
 {
  $.ajax({
   url:"search_client.php",
   method:"POST",
   data:{client_search:search},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }



    $('#search').on("keyup input", function(){
        /* Get input value on change */
        var search = $(this).val();
        var result = $("#result");
         if(search != '')
        {
          load_data(search);
         }
       else
      {
       load_data();
      }
    });
    
    
});
</script>