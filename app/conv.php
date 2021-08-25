<?php 
require_once("header.php");
$currency=show("SELECT * FROM `currency` ");
foreach ($currency as $curr) {
    $id=$curr['id'];
    $dolar=$curr['dolar'];
    

?>




<div class="container-fluid">

    <div class="row p-2">

        <div class="col-sm-10 col-md-8 col-lg-10 text-center m-auto">
            <h4> گۆڕینی دراو</h4>

        </div>

    </div>

    <div class="row p-2">

        <div class="col-10 col-sm-10 col-md-6 col-lg-4 m-auto text-center" style="zoom:100%">
            <div class="card bg-card text-center m-1">
                <div class="card-title p-2">

                </div>
                <div class="card-body">
                    <form action="" method="POST">


                        <input type="hidden" name="id" value="<?=$id?>">
                        
                        <label>نرخی سەد دۆلار</label>
                        <div class="form-group">
                            <input type="number" min="0" value="<?=$dolar?>" class="form-control" name="dolar" required="">
                        </div>


                        <button type="submit" name="change" class="btn btn-dark btn-lg w-100">گۆڕین</button>
                    </form>



                </div>
            </div>
        </div>





        <div class="col-10 col-sm-10 col-md-6 col-lg-4 m-auto text-center">
            <div class="card bg-card text-center m-1">
                <div class="card-title p-2">
                    <h4> دۆلار و دینار و تمەن</h4>
                </div>
                <div class="card-body">


                    <div class="form-group">
                        <label>دۆلار</label>
                        <input type="number" min="0" class="form-control" value="0" id="dollar">
                    </div>

                    <div class="form-group">
                        <label>دینار</label>
                        <input type="number" min="0" class="form-control" value="0" id="dinar">
                    </div>


                    <div class="form-group">
                        <label>تمەن</label>
                        <input type="number" min="0" class="form-control" value="0" id="tman">
                    </div>



                </div>
            </div>
        </div>




    </div>
</div>











<?php


if (isset($_SESSION["add_success"])) {
    msg('سەرکەتووبوو','سەرکەوتووانە زانیارییەکان تۆمارکرا ','success');
     unset($_SESSION["add_success"]);
 }

 if (isset($_SESSION["edit_success"])) {
    msg('سەرکەتووبوو','سەرکەوتووانە  گۆڕانکاری لەزانیارییەکان کرا ','success');
     unset($_SESSION["edit_success"]);
 }

 if (isset($_SESSION["delete"])) {
    msg('ئاگاداری','سەرکەوتووانە سڕایەوە ','warning');
    unset($_SESSION["delete"]);
 }



//  add




if (post('change')) {
    $id = secure($_POST['id']);
    $dolar = secure($_POST['dolar']);
 
  
    execute("UPDATE `currency` SET `dolar`='$dolar' WHERE `id`='$id' ");
  
    $_SESSION["edit_success"] = "";
    direct('conv.php');
  
  }



  


?>




<?php 

require_once("footer.php")

?>


<script type="text/javascript">
$(document).ready(function() {
  
$('#dollar').on('keyup',function () {
 var price = '<?=$dolar/100;?>'; //1460
 var dollar = $('#dollar').val();
var dinar  = dollar*price;
$('#dinar').val(dinar);
var tman=dinar*28.8652301369863;
$('#tman').val(tman);
});


$('#dinar').on('keyup',function () {
 var price = '<?=$dolar/100;?>';
 var dinar = $('#dinar').val();
 var dollar  = dinar/price;
 $('#dollar').val(dollar);
 var tman=dinar*28.8652301369863;
$('#tman').val(tman);
 
});


$('#tman').on('keyup',function () {
 var price = '<?=$dolar/100;?>';
 var tman = $('#tman').val();
 var dinar= tman* 0.035;
 $('#dinar').val(dinar);
 var dollar  = dinar/price;
 $('#dollar').val(dollar);
 
});



 }); 
</script>


<?php } ?>