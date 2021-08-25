<?php require_once('header.php'); ?>

<div class="container d-flex justify-content-around mt-5 flex-wrap">
<a data-toggle="modal" data-target="#add_debt" style="font-size:16px"  class="btn btn-success " ><i class="fas fa-dollar-sign "></i>  زیادکردنی قەرز</a>
<div onclick="window.print()" class="btn  btn-dark "><i class="fas fa-print" style="font-size:18px"></i> پرنتکردن</div>
</div>



<style>
    .table tbody tr:last-child td {
  border-width: 1px !important;
}
.table{
    border-radius:10px !important;
}
.table th{
    /* background:red !important; */
    /* font-size:12px !important; */
}
</style>



<div class="container-fluid mt-2">
    <div class="row m-auto">
        <div class="col-md-12">
            <div class="table-responsive">
            <table class="table table-bordered text-center">
            <!-- <caption>List of users</caption> -->
            <thead>
                <tr>
                    <th scope="col">ناو</th>
                    <th scope="col">ژمارە مۆبایل</th>
                    <th scope="col"> بڕی قەرز</th>
                    <th scope="col"> بەروار وەرگرتن</th>
                    <th scope="col">بڕی گێڕاوە</th>
                    <th scope="col">بڕی ماوە</th>
                    <th scope="col"> بەروار تەواوبوون</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
       $debts=show("SELECT * FROM debt");
    
    foreach ($debts as $debt) {
            $debt_id=$debt['id_debt'];
            $debt_amount=$debt['debt_amount'];
            $date_debt_start=$debt['date_start'];
            $date_debt_end=$debt['date_end'];
            $gerawa=$debt['gerawa'];
            $mawa=$debt['mawa'];
            $name=$debt['name'];
            $phone=$debt['phone'];
            $client_id=$debt['clientid'];
     ?>

<?php
                $alert_date=date('Y-m-d', strtotime($date_debt_end. ' - 2 days'));
                $today=date("Y-m-d") ;
                
                ?>

                <tr class="<?php  echo $alert_date<=$today ?  'debt_danger' : '' ;  echo $mawa==0 ? 'debt_success': '' ?>" >
                    <td><?=$name?></td>  
                    <td><?=$phone?></td>  
                    <td><?=$debt_amount?></td>
                    <td><?=$date_debt_start?></td>
                    <td><?=$gerawa?></td>
                    <td><?=$mawa?></td>
                    <td><?=$date_debt_end?></td>
                    <td>
                        <i class="fa fa-edit  s-20 cursor" style="color:#14cd7c" data-toggle="modal"
                            data-target="#edit<?php echo $debt['id_debt'] ?>"></i>
                        <i class="fa fa-trash text-dark s-20 cursor" data-toggle="modal"
                            data-target="#del<?php echo $debt['id_debt'] ?>"></i>
                    </td>

                </tr>

                <!-- edit modal -->
                <div class="modal fade" id="edit<?php echo $debt['id_debt'] ?>" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content" style="background-color: white;border-radius: 15px;">
                            <div class="modal-body text-right">
                                <div class="container-fluid">
                                    <div class="row row-cols-1 row-cols-md-3">
                                        <div class="col-md-12 mb-3 mx-auto">
                                            <div class="h-100">
                                                <i class="fa fa-times-circle" style="float:left;color: black"
                                                    data-dismiss="modal"></i>
                                                <div class="card-body">
                                                    <h5 class="container col-md-6 mt-3  text-center">
                                                        گۆڕانکاری بکە لە زانیارییەکان
                                                    </h5>
                                                    <br>
                                                    <form method="POST">
                                                        

                                                        <div class="form-group">
                                                            <input type="hidden" placeholder=" " name="id"
                                                                value="<?=$debt_id;?> "
                                                                class="form-control col-md-10 mx-auto">
                                                        </div>
                                                    
                                                          <?php
                                                           $client_name=show("SELECT `clientid` FROM `debt` WHERE `id_debt`='$debt_id' ");
                                                           $id_client=$client_name[0]['clientid'];
                                                           if ($id_client==0) { ?>

                                                        <label>ناو</label>

                                                        <div class="form-group ">
                                                             <input type="text" name="name" value="<?=$name?>" placeholder="ناوی سیانی بنووسە"
                                                             class="form-control  col-md-10 mx-auto" >
                                                        </div>



                                                 <label>ژمارە مۆبایل</label>
                                                   <div class="form-group">
                                                   <input type="text" name="phone" value="<?=$phone?>"
                                                       class="form-control col-md-10 mx-auto" required>
                                                </div>
                                                        <?php } ?>
                                                        <label>بڕی قەرز</label>
                                                        <div class="form-group">
                                                            <input type="text" name="debt_amount"
                                                                value="<?=$debt_amount;?> "
                                                                class="form-control col-md-10 mx-auto">
                                                        </div>


                                                        <label>بەرواری وەرگرتنی قەرز</label>
                                                        <div class="form-group">
                                                            <input type="date" name="date_debt_start"
                                                                value="<?=$date_debt_start;?>"
                                                                class="form-control col-md-10 mx-auto">
                                                        </div>

                                                        <label>بڕی گێراوە</label>
                                                        <div class="form-group">
                                                            <input type="text" name="gerawa"
                                                                value="<?=$gerawa;?> "
                                                                class="form-control col-md-10 mx-auto">
                                                        </div>

                                                        <label>بڕی ماوە</label>
                                                        <div class="form-group">
                                                            <input type="text" name="mawa"
                                                                value="<?=$mawa;?> "
                                                                class="form-control col-md-10 mx-auto" disabled>
                                                        </div>

                                                        <label class="mt-4">بەرواری کۆتایی قەرز</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="date_end"
                                                id="inlineRadio1" value="30"  checked>
                                            <label class="form-check-label" for="#inlineRadio1">١ مانگ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="date_end"
                                                id="inlineRadio2" value="60">
                                            <label class="form-check-label" for="#inlineRadio2">٢ مانگ</label></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="date_end"
                                                id="inlineRadio3" value="90" >
                                            <label class="form-check-label" for="#inlineRadio3">٣ مانگ</label>
    </div>
                                            
    <br><br>
                                                        <button type="submit" name="edit_debt"
                                                            class="btn btn-dark btn-block mt-4"> نوێکردنەوەی زانیارییەکان
                                                        </button>
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
                <div class="modal fade" id="del<?php echo $debt['id_debt'] ?>" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal" role="document">
                        <div class="modal-content" style="background-color: white;border-radius: 15px;">
                            <div class="modal-body text-center">
                                <div class="container-fluid">
                                    <div class="row row-cols-1 row-cols-md-3">
                                        <div class="col-md-12 mb-3 mx-auto">
                                            <div class="h-100">
                                                <i class="fa fa-times-circle" style="float:left;color: black"
                                                    data-dismiss="modal"></i>
                                                <div class="card-body">
                                                    <h5 class="container col-md-10 mt-3  text-center">
                                                        دڵنیای لە سڕینەوەی ئەم کڕینە لەناو سیستەمەکەت ؟
                                                    </h5>
                                                    <br>
                                                    <form dir="rtl" method="POST">
                                                        <div class="form-group">
                                                            <input type="hidden" placeholder="  ناو  " name="id"
                                                                value="<?=$debt_id;?>"
                                                                class="form-control col-md-10 mx-auto">
                                                        </div>
                                                        <!-- <div class="form-group">
              <input type="text" placeholder="  ناو  " name="name" value="<?=$name;?> " class="form-control col-md-10 mx-auto">
            </div>   -->
                                                        <button type="submit" name="del_debt"
                                                            class="btn btn-danger btn-block"> سڕینەوە </button>
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

                <!-- end delete -->




                <?php } ?>
            </tbody>
        </table>
            </div>

        </div>

    </div>




    <!-- add krdn -->


    <div class="modal fade" id="add_debt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                                        قەرز زیاد بکە
                                    </h5>
                                    <br>
                                    <form method="POST">


                                    <label class="mt-4">قەرز بۆ</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" 
                                                id="client" name="sel">
                                            <label class="form-check-label" for="inlineRadio1">کارمەند</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                id="another" name="sel">
                                                <label class="form-check-label" for="inlineRadio2">هیتر</label></label>
                                         </div>

                                         <br>

                                        <div class="form-group client_name d-none">
                                            <select name="name"  class="form-control col-md-10 mx-auto">
                                              
                                                <?php
                                                $client_name=show("SELECT `name`,`id` FROM `client`");
                                                foreach ($client_name as $name) { ?>
                                                <option  value="<?=$name['name']?>" ><?=$name['name']?></option>
                                                <?php }?>
                                            </select>
                                        </div> 

                                        <div class="form-group another d-none">
                                            <input type="text" name="nameanother" placeholder="ناوی سیانی بنووسە"
                                                class="form-control  col-md-10 mx-auto" >
                                        </div>



                                    <label>ژمارە مۆبایل</label>
                                        <div class="form-group">
                                            <input type="text" name="phone"
                                                class="form-control col-md-10 mx-auto" required>
                                    </div>

                                        <label>بڕی قەرز</label>
                                        <div class="form-group">
                                            <input type="number" name="debt_amount"
                                                class="form-control col-md-10 mx-auto" required>
                                        </div>


                                        <label>بەرواری وەرگرتنی قەرز</label>
                                        <div class="form-group mb-3">
                                            <input type="date" name="date_debt_start"
                                                class="form-control col-md-10 mx-auto" required>
                                        </div>




                                        <label class="mt-4">بەرواری کۆتایی قەرز</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="date_end"
                                                id="inlineRadio1" value="30" required>
                                            <label class="form-check-label" for="inlineRadio1">١ مانگ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="date_end"
                                                id="inlineRadio2" value="60">
                                            <label class="form-check-label" for="inlineRadio2">٢ مانگ</label></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="date_end"
                                                id="inlineRadio3" value="90" >
                                            <label class="form-check-label" for="inlineRadio3">٣ مانگ</label>
                              </div>


                                        <button type="submit" name="add_debt"
                                            class="btn btn-dark btn-block mt-4">زیادکردن</button>
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

if (post('edit_debt')) {
    $id= secure($_POST['id']);
    $debt_amount = secure($_POST['debt_amount']);
    $date_debt_start = secure($_POST['date_debt_start']);
    $date_num=secure($_POST['date_end']);
    $date_debt_end=date('Y-m-d', strtotime($date_debt_start. ' + '.$date_num.' days'));
    $gerawa = secure($_POST['gerawa']);
    $mawa=$debt_amount-$gerawa;

    // agar karmand nabu
    if (isset($_POST['name'])) {
        $name = secure($_POST['name']);
        $phone = secure($_POST['phone']);
        
        $sql=execute("UPDATE `debt` SET `debt_amount`='$debt_amount',`date_start`='$date_debt_start',`date_end`='$date_debt_end',`gerawa`='$gerawa',`mawa`='$mawa',`name`='$name',`phone`='$phone' WHERE id_debt = '$id'");
        $_SESSION["edit_success"] = "";
        direct('debts.php');
    }


    
    // agar karmand bu
    else{
        $sql=execute("UPDATE `debt` SET `debt_amount`='$debt_amount',`date_start`='$date_debt_start',`date_end`='$date_debt_end',`gerawa`='$gerawa',`mawa`='$mawa' WHERE id_debt = '$id'");
        $_SESSION["edit_success"] = "";
        direct('debts.php');
    }


//   $sql = execute("UPDATE `debt` SET `name`='$name',`phone`='$phone',`date_start`='$date',`work_place`='$work_place',`status`='$status' WHERE id = '$id'");
//     $_SESSION["edit_success"] = "";
//     direct('client.php');

}

if (post('del_debt')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM debt WHERE id_debt = '$id'");
    $_SESSION["delete"] = "";
    direct('debts.php');
    
}



// add

if (post('add_debt')) {
    $name = secure($_POST['name']);
    $nameanother = secure($_POST['nameanother']);
    $phone = secure($_POST['phone']);
    $debt_amount = secure($_POST['debt_amount']);
    $date_debt_start = secure($_POST['date_debt_start']);
    $date_num=secure($_POST['date_end']);
    $date_debt_end=date('Y-m-d', strtotime($date_debt_start. ' + '.$date_num.' days'));
   
    // agar karmand bu
    if (empty($nameanother)) {
        $client_name=show("SELECT `id` FROM `client` WHERE `name`='$name' ");
        $id_client=$client_name[0]['id'];
        $sql = execute("INSERT INTO `debt` (`debt_amount`,`date_start`,`date_end`,`gerawa`,`mawa`,`clientid`,`name`,`phone`) VALUES('$debt_amount','$date_debt_start','$date_debt_end','0','$debt_amount','$id_client','$name','$phone')");

        $_SESSION["add_success"] = "";
         direct('debts.php');
      
    }  //if yakam




    // agar karmnad nabu
    else{
        $sql = execute("INSERT INTO `debt` (`debt_amount`,`date_start`,`date_end`,`gerawa`,`mawa`,`clientid`,`name`,`phone`) VALUES('$debt_amount','$date_debt_start','$date_debt_end','0','$debt_amount','0','$nameanother','$phone')");

        $_SESSION["add_success"] = "";
         direct('debts.php');
    }


}

?>
    <?php require_once('footer.php'); ?>






    <script type="text/javascript">
        function printpage() {
            window.print()
        }
    </script>