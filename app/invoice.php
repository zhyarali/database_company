<?php require_once('header.php'); ?>


<div class="container d-flex justify-content-around mt-2 flex-wrap">
    <a data-toggle="modal" data-target="#add" style="font-size:16px" class="btn btn-success "><i
            class="fas fa-dollar-sign "></i> فرۆشتن بە مەتر</a>

            <a href="sale_category.php" style="font-size:16px;background:#7868E6 !important;" class="btn btn-danger">زیادکردنی بەشەکان</a>

    <!-- <div onclick="window.print()" class="btn  btn-dark "><i class="fas fa-print" style="font-size:18px"></i> پرنتکردن
    </div> -->
</div>


<div class="container">
  <div class="card">
<div class="card-header d-flex justify-content-around">
وەسڵ
<strong><?php echo date('Y-m-d'); ?></strong> 
</div>
<div class="card-body">
<div class="row mb-4">

<div class="col-sm-6">
<h6 class="mb-3">بۆ :</h6>
<div>
<strong>کڕیار : ژیار علی محمود</strong>
</div>
<div>ژمارە مۆبایل : 07501520479</div>
</div>



</div>

<div class="table-responsive-sm" style="zoom:80%">
<table class="table table-striped">
<thead>
<tr>
<th>#</th>
<th>ناوی بەش</th>
<th>پارچەکان</th>
<th>بڕی مەتر</th>
<th> نرخی فرۆشتن </th>
<th> نرخی داشکاندن </th>
<th> شوێن </th>
<th> نرخی واسڵکراو </th>
<th> نرخی گشتی </th>
<th> نرخی ماوە </th>
<th>جۆری دراو</th>
</tr>
</thead>
<tbody>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>

</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-4 col-sm-5">

</div>

<div class="col-lg-4 col-sm-5 ml-auto">
<table class="table table-clear">
<tbody>
<tr>
<td class="left">
<strong>کۆی گشتی نرخی واسڵکراو</strong>
</td>
<td class="right">$8.497,00</td>
</tr>
<tr>
<td class="left">
<strong>کۆی گشتی نرخی داشکاندن</strong>
</td>
<td class="right">$1,699,40</td>
</tr>
<tr>
<td class="left">
 <strong>کۆی گشتی نرخی ماوە</strong>
</td>
<td class="right">$679,76</td>
</tr>

<tr class="bg-dark text-light">

<td class="left">
<strong>کۆی گشتی نرخ</strong>
</td>
<td class="right">
<strong>$7.477,36</strong>
</td>

</tr>
</tbody>
</table>

</div>

</div>

</div>
</div>
</div>





    <!-- Add  modal -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            فرۆشتنی  بە مەتر
                                        </h5>
                                        <br>
                                        <form class="mt-5" dir="rtl" method="POST" enctype="multipart/form-data">

                                        <label>ناوی کڕیار</label>
                                      <div class="form-group ">
                                            <select name="customer_id"  class="form-control col-md-10 mx-auto">
                                                <?php
                                                  $getCustomer = show(" SELECT * FROM customer");
                                                  foreach ($getCustomer as $customer) { ?>
                                                
                                                <option  value="<?=$customer['id']?>"> <?=$customer['name']?> </option>
                                               <?php   } ?>
                                            </select>
                                        </div> 


                                        <div class="form-group ">
                                            <select name="name" onchange="getPrice(this.value)" class="form-control col-md-10 mx-auto">
                                                <?php
                                                  $getCategory = show(" SELECT * FROM sale_category");
                                                  foreach ($getCategory as $category) { ?>
                                                
                                                <option  value="<?=$category['id']?>"> <?=$category['name']?> </option>
                                               <?php   } ?>
                                            </select>
                                        </div> 


<div class="mt-2" role="group" id="show_data" aria-label="Basic checkbox toggle button group" style="zoom:80%">
<?php 
$getPiece = show(" SELECT * FROM piece WHERE category_id='1'");
foreach ($getPiece as $piece) {
 ?>
  <input type="checkbox" class="btn-check" name="check[]" id="btncheck<?=$piece['id'] ?>" value="<?=$piece['name'] ?>" autocomplete="off">
  <label class="btn btn-outline-dark" style="border-radius:10px !important" for="btncheck<?=$piece['id'] ?>"><?=$piece['name'] ?></label>

<?php }
?>
</div>
           

                                            <div class="form-group">
                                                <input type="text" placeholder="شوێنی فرۆشتن"
                                                    class="form-control col-md-10 mx-auto" name="place"
                                                    required="">
                                            </div>
                                            

                                            <div class="form-group">
                                                <input type="number" placeholder="بڕی مەتری فرۆشتن"
                                                    class="form-control col-md-10 mx-auto" name="num" required="">
                                            </div>
                               


                                            <div class="form-group">
                                                <input type="number" placeholder=" بڕی واسڵ "
                                                    class="form-control col-md-10 mx-auto" name="cost_wasl" required="">
                                            </div>


                                            <div class="form-group">
                                                <input type="number" placeholder="  نرخی داشکاندن "
                                                    class="form-control col-md-10 mx-auto" name="discount" required="">
                                            </div>


                                            <div class="form-group">
                                           <textarea id="my-textarea" placeholder="تێبینی بنووسە" class="form-control" name="note" rows="4"></textarea>
                                            </div>


                                    
                                            <button type="submit" name="add"
                                                class="btn btn-success btn-block  ">
                                
                                                فرۆشتن </button>
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



<?php require_once('footer.php'); ?>