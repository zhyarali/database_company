<?php require_once('header.php'); ?>


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


<div class="container-fluid mt-4">
<a href="sale.php" class="btn btn-sm btn-info shadow" >
 <span class="fa fa-arsrow-right"></span>
 گەڕانەوە
  </a>
</div>


<?php if($is_admin == "1") {?>  
<div class="container-fluid  mt-2 d-flex justify-content-center">
    <a data-toggle="modal" data-target="#add" class="btn  btn-success s-16"><i class="fa fa-dollar-sign"></i> 
        زیادکردنی کڕیارەکان</a>

</div>
<?php }?>


<div class="container-fluid mt-2">


<div class="row col-lg-12 col-12 m-auto p-4 table-responsive">

<table class="table table-bordered text-center">
<thead>
    <tr>
      <th scope="col">ناو</th>
      <th scope="col">ناونیشان</th>
      <th scope="col">شوێنی کارکردن</th>
      <th scope="col">ژمارە مۆبایل</th>
      <th>جۆری دراو</th>
      <th scope="col">تێبینی</th>
      <?php if($is_admin == "1") {?>  
      <th scope="col">Action</th>
      <?php }?>
    </tr>
</thead>    

<tbody>
  <tr>
      <?php
        $customers=show("SELECT * FROM customer");
        foreach ($customers as $customer) {
            $id=$customer['id'];
            $name=$customer['name'];
            $address=$customer['address'];
            $phone=$customer['phone'];
            $work_place=$customer['work_place'];
            $note=$customer['note'];

            $currency_type=$customer['currency_type'];
            if ($currency_type=='dinar') {
              $currency_type='دینار';
            }
          
            if ($currency_type=='dollar') {
              $currency_type='دۆلار';
            }
          
            if ($currency_type=='tman') {
              $currency_type='تمەن';
            }

            ?>

            <td><a href="customer_detail.php?id=<?=$id;?>"><?=$name;?></a></td>
            <td><?=$address;?></td>
            <td><?=$work_place;?></td>
            <td><?=$phone;?></td>
            <td><?=$currency_type;?></td>
            <td><?=$note;?></td>
            <?php if($is_admin == "1") {?>  
      <td>
          <i class="fa fa-trash s-20 cursor" data-toggle="modal"
              data-target="#delete<?php echo $customer['id'] ?>"></i>
          <i class="fa fa-edit s-20 cursor" data-toggle="modal"
              data-target="#edit<?php echo $customer['id'] ?>"></i>
          <!-- <i class="fa fa-print cursor s-20" data-toggle="modal" data-target="#print" ></i>            -->
      </td>
      <?php }?>

        <!-- edit -->

<div class="modal fade" id="edit<?php echo $customer['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content" style="background-color: white;border-radius: 15px;">
      <div class="modal-body text-center">
        <div class="container-fluid">
          <div class="row row-cols-1 row-cols-md-3">
            <div class="col-md-12 mb-3 mx-auto">
              <div class="h-100">
                <i class="fa fa-times-circle" style="float:left;color: black" data-dismiss="modal"></i>
                <div class="card-body">
                  <h5 class="container col-md-6 mt-3  text-center">
                    زیادکردنی کڕیار  
                  </h5>
                  <br>
                  <form class="mt-5" dir="rtl" method="POST" enctype="multipart/form-data">


                  <div class="form-group">
                     <input type="hidden" placeholder=" " name="id"
                    value="<?=$id;?>" 
                    class="form-control col-md-10 mx-auto">
                </div>

                    <div class="form-group">
                      <input type="text" placeholder="ناوی کڕیار" class="form-control col-md-10 mx-auto"
                        name="name" required="" value="<?=$name;?>">
                    </div>

                    <div class="form-group">
                      <input type="text" placeholder="ناونیشان" class="form-control col-md-10 mx-auto"
                        name="address" required="" value="<?=$address;?>">
                    </div>

                    <div class="form-group">
                      <input type="text" placeholder="شوێنی کارکردن" class="form-control col-md-10 mx-auto"
                        name="work_place" required="" value="<?=$work_place;?>">
                    </div>

                    <div class="form-group">
                      <div class="mb-3">
                        <label for="sform" class="form-label float-end">جۆری دراو</label>
                        <select name="currency_type" class="form-control" name="" id="sform">
                          <option value="dinar" <?php echo $currency_type=='دینار' ? 'selected' : '' ?>>دینار</option>
                          <option value="dollar" <?php echo $currency_type=='دۆلار' ? 'selected' : '' ?>>دۆلار</option>
                          <option value="tman" <?php echo $currency_type=='تمەن' ? 'selected' : '' ?>>تمەن</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <input type="text" placeholder="ژمارە مۆبایل" class="form-control col-md-10 mx-auto"
                        name="phone" required="" value="<?=$phone;?>">
                    </div>

                    <div class="form-group">
                      <textarea name="note"  placeholder="تێبینی" id="" cols="20" rows="5" class="form-control col-md-10 mx-auto"><?=$note;?></textarea>
                    </div>

                    
                  
                    <br>
                    <button type="submit" name="edit" class="btn btn-sm btn-dark  s-20">
                      <i class="fal fa-plus s-20"></i>
                      گۆڕانکاری </button>
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
<!-- edit -->



 <!-- delete modal -->
 <div class="modal fade" id="delete<?php echo $customer['id'] ?>" tabindex="-1" role="dialog"
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
                                                                value="<?=$id;?>"
                                                                class="form-control col-md-10 mx-auto">
                                                        </div>
                                                   
                                                        <button type="submit" name="del"
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





  </tr>

  <?php } ?>

</tbody>

</table>
</div>  

</div>






<!-- Add  modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content" style="background-color: white;border-radius: 15px;">
      <div class="modal-body text-center">
        <div class="container-fluid">
          <div class="row row-cols-1 row-cols-md-3">
            <div class="col-md-12 mb-3 mx-auto">
              <div class="h-100">
                <i class="fa fa-times-circle" style="float:left;color: black" data-dismiss="modal"></i>
                <div class="card-body">
                  <h5 class="container col-md-6 mt-3  text-center">
                    زیادکردنی کڕیار  
                  </h5>
                  <br>
                  <form class="mt-5" dir="rtl" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                      <input type="text" placeholder="ناوی کڕیار" class="form-control col-md-10 mx-auto"
                        name="name" required="">
                    </div>

                    <div class="form-group">
                      <input type="text" placeholder="ناونیشان" class="form-control col-md-10 mx-auto"
                        name="address" required="">
                    </div>

                    <div class="form-group">
                      <input type="text" placeholder="شوێنی کارکردن" class="form-control col-md-10 mx-auto"
                        name="work_place" required="">
                    </div>

                    <div class="form-group">
                      <input type="text" placeholder="ژمارە مۆبایل" class="form-control col-md-10 mx-auto"
                        name="phone" required="">
                    </div>

                    <div class="form-group">
                      <div class="mb-3">
                        <label for="sform" class="form-label float-end">جۆری دراو</label>
                        <select name="currency_type" class="form-control" name="" id="sform">
                          <option value="dinar">دینار</option>
                          <option value="dollar">دۆلار</option>
                          <option value="tman">تمەن</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <textarea name="note" placeholder="تێبینی" id="" cols="20" rows="5" class="form-control col-md-10 mx-auto"></textarea>
                    </div>

                    
                  
                    <br>
                    <button type="submit" name="add" class="btn btn-sm btn-dark  s-20">
                      <i class="fal fa-plus s-20"></i>
                      زیادکردن </button>
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


if (post('add')) {
    $name = secure($_POST['name']);
    $address = secure($_POST['address']);
    $work_place = secure($_POST['work_place']);
    $phone = secure($_POST['phone']);
    $note = secure($_POST['note']);
    $currency_type = secure($_POST['currency_type']);
  
    execute("INSERT INTO customer (`name`,`phone`,`address`,`work_place`,`note`,`currency_type`) 
    VALUES('$name','$phone','$address','$work_place','$note','$currency_type') ");
  
  $_SESSION["add_success"] = "";
    direct('customer.php');
  
  }



if (post('edit')) {
    $id = secure($_POST['id']);
    $name = secure($_POST['name']);
    $address = secure($_POST['address']);
    $work_place = secure($_POST['work_place']);
    $phone = secure($_POST['phone']);
    $note = secure($_POST['note']);
    $currency_type = secure($_POST['currency_type']);
  
  
    execute("UPDATE `customer` SET `name`='$name',`phone`='$phone',`address`='$address',`work_place`='$work_place',`note`='$note' ,`currency_type`='$currency_type' WHERE `id`='$id' ");
  
    $_SESSION["edit_success"] = "";
    direct('customer.php');
  
  }


//   delete
if (post('del')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM customer WHERE id = '$id'");
    $_SESSION["delete"] = "";
    direct('customer.php');
    
}
  


?>


<?php require_once('footer.php'); ?>



