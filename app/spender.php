<?php require_once('header.php'); ?>

<?php 
$user_id=$_GET['id'];
$users = countdata(" SELECT * FROM person WHERE `id`=$user_id");
$data = show(" SELECT * FROM person WHERE `id`=$user_id");

if (empty($data)) {
  direct('index.php');
}else{   
    
    foreach ($data as $user) {
        $id = $user['id'];
        $name = $user['name'];
        $phone = $user['phone'];
        $note = $user['note']; ?>






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
<form method="post" action="view_report.php">
    
<input type="hidden" name="user_id" value="<?=$user_id?>">

     <button type="submit" class="btn btn-dark" name="spender_info" style="border:none;" > <i class="fas fa-print"></i> پرنتکردن</button>

  </form> 
</div>

<div class="container-fluid mt-2 d-flex flex-wrap">



    <!-- <div onclick="window.print()"><i class="fas fa-print fa-2x"></i> پرنتکردن</div> -->
    <div class="row col-lg-12 col-12 m-auto">
        <div class="card border shadow-none m-auto " style="width: 25rem;border-radius:8px">
            <ul class="list-group list-group-flush text-center">
                <li class="list-group-item"><strong>ناو : </strong> <?=$name?></li>
                <li class="list-group-item"><strong>ژمارە مۆبایل : </strong> <?=$phone?></li>
                <li class="list-group-item"><strong> تێبینی : </strong><?=$note?></li>

            </ul>
        </div>
    </div>


    <div class="container-fluid  mt-3 d-flex justify-content-around flex-wrap">
       
        <a href="spender.php?id=<?=$id?>" class="btn btn-success shadow">زانیاری گشتی بهێنەوە</a>

        
        <div class="d-flex flex-wrap justify-content-center">

            <div class="form-group mx-3">
            <input type="date" 
             class="form-control  mx-auto" id="get_by_date" required>

             <input type="hidden" 
             class="form-control  mx-auto" id="spender_id" value="<?=$id?>">

           </div>
           <p class="btn btn-dark shadow" id="btn_search">زانیاری بەپێی ڕۆژ بهێنەوە</p>

        </div>    
     
    </div>

    <div class="row col-lg-12 col-12 m-auto p-4 table-responsive">

    <table  class="table  table-bordered  text-center" dir="rtl">
        <thead>
            <tr>
                <th>بەروار</th>
                <th>بۆچی خەرجکراوە</th>
                <th>پارەی وەرگیراو</th>
                <th>بڕی نرخی خەرجکراو</th>
                <th>نرخی ماوە</th>
                <th>شوێن</th>
                <th scope="col"><i class="fas fa-print"></i></th>
            </tr>
        </thead>
        <tbody id="show_data">
<?php 
$items = show(" SELECT * FROM xarjy WHERE `xarj_by`='$id'");
foreach ($items as $item) {
  $id = $item['id'];
  $name = $item['name_item'];
  $price = $item['price'];
  $place = $item['place'];
  $get_price = $item['get_price'];
  $xarj_by = $item['xarj_by'];
  $date = $item['date'];
  $price_mawa=$get_price - $price;


?>
       <tr>
       <td><?=$date;?></td>
        <td style="max-width:320px;width:320px;overflow:hidden;word-wrap: break-word;overflow-wrap: break-word;white-space: pre-wrap;"><?=$name;?></td>
        <td><?=$get_price;?></td>
        <td><?=$price;?></td>
        <td><?=$price_mawa;?></td>
        <td><?=$place;?></td>
        <td> 
                <form method="post" action="view_report.php">
                    <input type="hidden" name="user_id" value="<?=$user_id?>">
                    <input type="hidden" name="con_id" value="<?=$id?>">

                <button type="submit" name="spender_info" style="border:none;background:none" > <i class="fas fa-print"></i> </button>

                </form>    
            
               </td>
      </tr>
<?php
}
?>
        </tbody>
    </table>

    </div>




</div>


<br><br>





    
<?php } } ?>


<?php require_once('footer.php'); ?>




<script>
  $(document).ready(function () {
 
    // $('.dateFilter').datepicker({
    //   dateFormat: "yy-mm-dd"
    // });
 
    $('#btn_search').click(function () {
      var date = $('#get_by_date').val();
      var spender_id = $('#spender_id').val();
      if (date != '') {
        $.ajax({
          url: "get_by_date.php",
          method: "POST",
          data: {date_spender: date ,spender_id:spender_id},
          success: function (data) {
            $('#show_data').html(data);
          }
        });
      }
      else {
        alert("Please Select the Date");
      }
    });
  });
</script>
