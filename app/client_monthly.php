
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



<div class="container-fluid  mt-3 d-flex justify-content-around">
<?php if ($is_admin==1) {?>
    <a data-toggle="modal" data-target="#edit_info<?=$id?>" class="btn  btn-success"><i class="fa fa-user"></i> گۆڕانکاری لە زانیاری کارمەند</a>
<?php } ?>  
    <form method="post" action="view_report.php">
            <input type="hidden" name="client_id" value="<?=$id?>">
         <button type="submit" class="btn btn-dark" name="client_month" style="border:none;" > <i class="fas fa-print"></i> پرنتکردن</button>
      </form> 
        <!-- <a href="view_report.php?client_month=<?=$id?>" class="btn  btn-dark "><i class="fas fa-print" style="font-size:18px"></i> پرنتکردن</a> -->
</div>

<div class="container-fluid mt-2 d-flex flex-wrap">



    <!-- <div onclick="window.print()"><i class="fas fa-print fa-2x"></i> پرنتکردن</div> -->
    <div class="row col-lg-4 col-12 m-auto">
        <div class="card border shadow-none m-auto " style="width: 25rem;border-radius:8px">
            <ul class="list-group list-group-flush text-center">
                <li class="list-group-item">
                <img  src='<?php echo $image==null ? "../assets/img/client/default.jpg" :"../assets/img/client/$image" ?> ' width="120" style="border-radius:10px" class="shadow" alt="profile" >
                </li>
                <li class="list-group-item"><strong>ناو : </strong> <?=$name?></li>
                <li class="list-group-item"><strong>ژمارە مۆبایل : </strong> <?=$phone?></li>
                <li class="list-group-item"><strong>بەرواری دەستپێکردن : </strong><?=$date?></li>
                <li class="list-group-item"><strong>شوێنی کار : </strong><?=$team_name?></li>
                <li class="list-group-item"><strong>جۆری کارکردن : </strong>مانگانە</li>

            </ul>
        </div>
    </div>

    <div class="modal fade" id="edit_info<?=$id?>" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content" style="background-color: white;border-radius: 15px;">
        <div class="modal-body text-right">
         <div class="container-fluid">
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-12 mb-3 mx-auto">
      <div class="h-100">
        <i class="fa fa-times-circle" style="float:left;color: black"  data-dismiss="modal"></i>
        <div class="card-body">
          <h5 class="container  mt-3  text-center">
               گۆڕانکاری بکە لەزانیارییەکان
        </h5>
        <br>
        <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
                <input type="hidden"   name="id" value="<?=$id;?> "class="form-control col-md-10 mx-auto">
                </div> 
         
                <label>ناوی سیانی</label>
                <div class="form-group">
                <input type="text"   name="name" value="<?=$name;?> "class="form-control col-md-10 mx-auto">
                </div> 



                <label>وێنە</label>
                <div class="form-group">
                <input type="file"   name="image" value="<?=$image?>"  class="form-control col-md-10 mx-auto">
                </div> 

                <label>ژمارە مۆبایل</label>
                <div class="form-group">
                <input type="text"  name="phone"  value="<?=$phone?>"   class="form-control col-md-10 mx-auto">
                </div> 

                <div class="form-group">
                    <select name="currency_type"  class="form-control col-md-10 mx-auto"> 
                        <option value="dinar"  <?php echo $currency_type=='دینار' ? 'selected' : '' ?> >دینار</option>
                        <option value="dollar" <?php echo $currency_type=='دۆلار' ? 'selected' : '' ?>>دۆلار</option>
                        <option value="tman"   <?php echo $currency_type=='تمەن' ? 'selected' : '' ?>>تمەن</option>
                    </select>
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
                    <select id="client_status" name="status"  class="form-control col-md-10 mx-auto">
                        <option id="client_monthly" <?php if($status=="0") echo 'selected="selected"'; ?>  value="0">مانگانە</option>
                        <option id="client_daily" <?php if($status=="1") echo 'selected="selected"'; ?> value="1">ڕۆژانە</option>
                    </select>
                </div>

                <div id="daily_amount" class="d-none">
                <label>بڕی پارەی کارکردنی ڕۆژانە</label>
                <div class="form-group">
                  <input type="text"  name="bry_para" value="<?=$bry_para?>"   class="form-control col-md-10 mx-auto">
                </div>
              </div>
                 
            
                
            
    <button type="submit" name="edit_client" class="btn btn-dark btn-block">نوێکردنەوەی زانیارییەکان</button>
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


    <div class="row col-lg-8 col-12 m-auto p-4 table-responsive" style="zoom:85%">

        <table class="table table-bordered text-center">
            <!-- <caption>List of users</caption> -->
            <thead>
                <tr>
                    <th scope="col">بەروار</th>
                    <th>جۆری دراو</th>
                    <th scope="col">بڕی موچە</th>
                    <th scope="col">بڕی پاداشت</th>
                    <th scope="col">غەرامە</th>
                    <th scope="col">کۆی گشتی مووچە</th>
                    <th scope="col">ئیشی کردووە بۆ</th>
                    <th scope="col">Action</th>


                </tr>
            </thead>
            <tbody>
                <?php
       $joins=show("SELECT * FROM budget WHERE clientid= $client_id");
    
    foreach ($joins as $join) {
        $budget_id=$join['id_budget'];
            $date_bud=$join['date'];
            // $budget_amount=$join['budget_amount'];
            $punish=$join['punish'];
            $reward=$join['reward'];
            $work_for=$join['work_for'];
     ?>
                <tr>
                    <td><?=$date_bud?></td>
                    <td><?=$currency_type?></td>
                    <td><?=$budget_month?></td>
                    <td><?=$reward?></td>
                    <td><?=$punish?></td>
                    <td>
                        <?php 
                         $budget=(int)$budget_month+$reward;
                         $budget=$budget-$punish;
                         echo $budget;
                        ?>
                    </td>
                    <td><?=$work_for?></td>
                    <?php if ($is_admin==1) {?>
                    <td class="d-flex justify-content-between">
                        <i class="fa fa-edit  s-20 cursor" style="color:#14cd7c" data-toggle="modal"
                            data-target="#edit<?php echo $join['id_budget'] ?>"></i>
                        <i class="fa fa-trash text-dark s-20 cursor" data-toggle="modal"
                            data-target="#del<?php echo $join['id_budget'] ?>"></i>

                            <form method="post" action="view_report.php">
                                <input type="hidden" name="client_id" value="<?=$id?>">
                                <input type="hidden" name="con_id" value="<?=$budget_id?>">
                                <button type="submit" name="client_month" style="border:none;background:none" > <i class="fas fa-print s-20"></i> </button>
                            </form>
                    </td>
                    <?php } ?>

                    <?php if ($is_admin==0) {?>
                    <td class="d-flex justify-content-center">
                        <form method="post" action="view_report.php">
                                    <input type="hidden" name="client_id" value="<?=$id?>">
                                    <input type="hidden" name="con_id" value="<?=$budget_id?>">
                                    <button type="submit" name="client_month" style="border:none;background:none" > <i class="fas fa-print s-20"></i> </button>
                        </form>
                    </td>    
                    <?php } ?>
                </tr>


                <!-- edit modal -->
                <div class="modal fade" id="edit<?php echo $join['id_budget'] ?>" tabindex="-1" role="dialog"
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
                                                                value="<?=$budget_id;?> "
                                                                class="form-control col-md-10 mx-auto">
                                                        </div>

                                                        <label>بڕی پاداشت</label>
                                                        <div class="form-group">
                                                          <input type="number" value="<?=$reward?>" name="reward" class="form-control col-md-10 mx-auto" >
                                                        </div>

                                                        <label>بڕی غەڕامە</label>
                                                        <div class="form-group">
                                                            <input type="number" name="punish" value="<?=$punish?>"
                                                                class="form-control col-md-10 mx-auto">
                                                        </div>

                                                        <label>بۆ کێ ئیشی کردووە</label>
                                                    <div class="form-group">
                                                    <select name="work_for"  class="form-control col-md-10 mx-auto" required>
                                                        <option <?php if($work_for=="کۆمپانیا") echo 'selected="selected"'; ?>  value="کۆمپانیا">کۆمپانیا</option>
                                                        <option <?php if($work_for=="کڕیار") echo 'selected="selected"'; ?>  value="کڕیار">کڕیار</option>
                                                        <option <?php if($work_for==">فرۆشیار") echo 'selected="selected"'; ?>  value="فرۆشیار">فرۆشیار</option>
                                                    </select>
                                                    </div>

                                                        <button type="submit" name="edit_budget_month"
                                                            class="btn btn-dark btn-block"> نوێکردنەوەی زانیارییەکان
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
                <div class="modal fade" id="del<?php echo $join['id_budget'] ?>" tabindex="-1" role="dialog"
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
                                                        دڵنیای لە سڕینەوەی ئەم مووچەیەی ئەم کارمەندە   ؟
                                                    </h5>
                                                    <br>
                                                    <form dir="rtl" method="POST">
                                                        <div class="form-group">
                                                            <input type="hidden" placeholder="  ناو  " name="id"
                                                                value="<?=$budget_id;?>"
                                                                class="form-control col-md-10 mx-auto">
                                                        </div>
                                                        <!-- <div class="form-group">
              <input type="text" placeholder="  ناو  " name="name" value="<?=$name;?> " class="form-control col-md-10 mx-auto">
            </div>   -->
                                                        <button type="submit" name="del_budget_month"
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



<!-- debt  -->

<div class="container-fluid d-flex  mt-4 flex-wrap">

    <div class="row col-xl-7 table-responsive col-12 m-auto">
        <table class="table table-bordered text-center">
            <!-- <caption>List of users</caption> -->
            <thead>
                <tr>
                    <th scope="col">قەرز</th>
                    <th scope="col"> بەروار وەرگرتن</th>
                    <th scope="col">بڕی گێڕاوە</th>
                    <th scope="col">بڕی ماوە</th>
                    <th scope="col"> بەروار تەواوبوون</th>
                    <?php if ($is_admin==1) {?><th scope="col">Action</th><?php } ?>
                </tr>
            </thead>
            <tbody>

                <?php
       $debts=show("SELECT * FROM debt WHERE clientid= $client_id");
    
    foreach ($debts as $debt) {
            $debt_id=$debt['id_debt'];
            $debt_amount=$debt['debt_amount'];
            $date_debt_start=$debt['date_start'];
            $date_debt_end=$debt['date_end'];
            $gerawa=$debt['gerawa'];
            $mawa=$debt['mawa'];
     ?>

<?php
                $alert_date=date('Y-m-d', strtotime($date_debt_end. ' - 2 days'));
                $today=date("Y-m-d") ;
                
                ?>

                <tr class="<?php  echo $alert_date==$today ?  "debt_danger" : "" ; echo $mawa==0 ? 'debt_success' :''; ?>" >
                    <td><?=$debt_amount?></td>
                    <td><?=$date_debt_start?></td>
                    <td><?=$gerawa?></td>
                    <td><?=$mawa?></td>
                    <td><?=$date_debt_end?></td>
                    <?php if ($is_admin==1) {?>
                    <td>
                        <i class="fa fa-edit  s-20 cursor" style="color:#14cd7c" data-toggle="modal"
                            data-target="#edit<?php echo $debt['id_debt'] ?>"></i>
                        <i class="fa fa-trash text-dark s-20 cursor" data-toggle="modal"
                            data-target="#del<?php echo $debt['id_debt'] ?>"></i>   
                    </td>
                    <?php } ?>

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

                                                        <label>بڕی قەرز</label>
                                                        <div class="form-group">
                                                            <input type="text" name="debt_amount"
                                                                value="<?=$debt_amount;?> "
                                                                class="form-control col-md-10 mx-auto">
                                                        </div>


                                                        <label>بەرواری وەرگرتنی قەرز</label>
                                                        <div class="form-group">
                                                            <input type="date" name="date_debt_start"
                                                                value="<?=$date_debt_start;?> "
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
                                                        <button type="submit" name="edit_debt_month"
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
                                                        <button type="submit" name="del_debt_month"
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
    <?php if ($is_admin==1) {?>
    <div class="col-xl-5  m-auto col-12">
        <a data-toggle="modal" data-target="#add_debt" class="btn btn-dark m-4"><i class="fa fa-hand-holding-usd"></i>
            پێدانی قەرز</a>
    </div>
    <?php } ?>
</div>




<!-- add mwcha   modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                        <label>بڕی مووچەی مانگانە</label>
                                        <div class="form-group">
                                            <input type="number" name="budget" class="form-control col-md-10 mx-auto">
                                        </div>

                                        <label>بەرواری وەرگرتنی مووچە</label>
                                        <div class="form-group">
                                            <input type="date" name="date_budget"
                                                class="form-control col-md-10 mx-auto">
                                        </div>

                                        <label>بڕی غەڕامە</label>
                                        <div class="form-group">
                                            <input type="number" name="punish" class="form-control col-md-10 mx-auto">
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


<!-- add qarz   modal -->
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

                                        <label>بڕی قەرز</label>
                                        <div class="form-group">
                                            <input type="number" name="debt_amount"
                                                class="form-control col-md-10 mx-auto">
                                        </div>


                                        <label>بەرواری وەرگرتنی قەرز</label>
                                        <div class="form-group mb-3">
                                            <input type="date" name="date_debt_start"
                                                class="form-control col-md-10 mx-auto">
                                        </div>




                                        <label class="mt-4">بەرواری کۆتایی قەرز</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="date_end"
                                                id="inlineRadio1" value="30">
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


                                        <button type="submit" name="add_debt_month"
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