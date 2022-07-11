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
<button onclick="window.history.back()" class="btn btn-sm btn-info shadow" >
 <span class="fa fa-arrow-right"></span>
 گەڕانەوە
  </button>
</div>


<div class="container-fluid  mt-2 d-flex justify-content-around">
    <a  class="btn  btn-success s-16">قەرزی کۆمپانیا</a>

</div>


<div class="container-fluid mt-2">


<div class="row col-lg-12 col-12 m-auto p-4 table-responsive">

<table class="table table-bordered text-center">
<thead>
    <tr>
      <th scope="col">ناوی فرۆشیار</th>
      <th scope="col">ناونیشان</th>
      <th scope="col">شوێنی کارکردن</th>
      <th scope="col">ژمارە مۆبایل</th>
      <th scope="col">جۆری دراو</th>
      <th scope="col">کۆی گشتی نرخی ماوە</th>
      <?php if ($is_admin==1) {?><th scope="col">گەڕانەوەی پارە</th><?php } ?>
    </tr>
</thead>    

<tbody>
<?php
        $dealers=show("SELECT * FROM dealers");
        foreach ($dealers as $dealer) {
            $id=$dealer['id'];
            $name=$dealer['name'];
            $address=$dealer['address'];
            $phone=$dealer['phone'];
            $work_place=$dealer['work_place'];
            $currency_type=$dealer['currency_type'];
            $note=$dealer['note'];
            
            if ($currency_type=='dinar') {$currency_type='دینار';}
            if ($currency_type=='dollar') {$currency_type='دۆلار';}
            if ($currency_type=='tman') {$currency_type='تمەن';}
            $refund_p=0;
            $refund=getdata(" SELECT sum(price) as price from refund WHERE dealer_id=$id");
           
            if (!empty($refund)) {
                $refund_p=$refund['price'];
            }

            $dealers_buy=getdata(" SELECT sum(cost_co) as cost_total,sum(cost_wasl) as cost_wasl FROM buy WHERE dealer_id=$id AND `status`=1");
            $cost_maway_peshw=$dealers_buy['cost_total']-$dealers_buy['cost_wasl'];
            $cost_maway_peshw-=$refund_p;

            if ($cost_maway_peshw>0) {
            

            ?>
  <tr>

            <td><a href="dealer_detail.php?id=<?=$id;?>"><?=$name;?></a></td>
            <td><?=$address;?></td>
            <td><?=$work_place;?></td>
            <td><?=$phone;?></td>
            <td><?=$currency_type;?></td>
            <td><?=$cost_maway_peshw?></td>
      <?php if ($is_admin==1) {?>
      <td>
          <i class="fa fa-edit s-20 cursor" data-toggle="modal"
              data-target="#edit<?php echo $dealer['id'] ?>"></i>
          <!-- <i class="fa fa-print cursor s-20" data-toggle="modal" data-target="#print" ></i>            -->
      </td>
      <?php } ?>
        <!-- edit -->

<div class="modal fade" id="edit<?php echo $dealer['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                     گەڕانەوەی پارە  
                  </h5>
                  <br>
                  <form class="mt-5" dir="rtl" method="POST" enctype="multipart/form-data">


                  <div class="form-group">
                     <input type="hidden" placeholder=" " name="id"
                    value="<?=$id;?>" 
                    class="form-control col-md-10 mx-auto">
                </div>


                    <div class="container d-flex justify-content-center mb-4">
                       <strong> کۆی گشتی نرخی ماوەی پێشوو </strong> &nbsp; : &nbsp; <span><?=$cost_maway_peshw?></span>
                    </div>

                    <div class="form-group">
                      <input type="text" placeholder="نرخی پارەی گێڕاوە" class="form-control col-md-10 mx-auto"
                        name="refund_price" required="">
                    </div>

                    <div class="form-group">
                    <select name="refund_type"  class="form-control col-md-10 mx-auto"> 
                        <option value="cash">کاش</option>
                        <option value="7awala">حەواڵە</option>
                    </select>
                    </div>

               
                    <button type="submit" name="add_refund" class="btn btn-sm btn-dark  s-20">
                      گەڕانەوەی پارە </button>
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



  </tr>

  <?php } } ?>

</tbody>

</table>
</div>  

</div>




<?php 

if (isset($_SESSION["add_success"])) {
    msg('سەرکەتووبوو','سەرکەوتووانە  بڕی پارەی دیاریکراو گەڕێنرایەوە ','success');
     unset($_SESSION["add_success"]);
 }


 if (post('add_refund')) {
  $refund_price = secure($_POST['refund_price']);
  $id = secure($_POST['id']);
  $refund_type = secure($_POST['refund_type']);
  $date=date("Y-m-d");

  execute("INSERT INTO refund (`dealer_id`,`price`,`refund_type`,`date`) 
  VALUES('$id','$refund_price','$refund_type','$date')");

    $_SESSION["add_success"] = "";
    direct('debt_company.php');
  }


?>



<?php require_once('footer.php'); ?>