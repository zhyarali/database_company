<?php require_once('header.php'); ?>

<div class="container-fluid mt-4">
  <button onclick="window.history.back()" class="btn btn-sm btn-info shadow">
    <span class="fa fa-arrow-right"></span>
    گەڕانەوە
  </button>
</div>


<?php

$sale=show("SELECT sum(cost_co) as 'total' FROM sale 
WHERE Date(date)=CURDATE() AND status='1' ");
$saletotal = $sale[0]['total'];
if ($saletotal==null) {
$saletotal = 0;
}


$buy=show("SELECT sum(cost_co) as 'total' FROM buy 
WHERE Date(date)=CURDATE() AND status='1' ");
$buytotal = $buy[0]['total'];
if ($buytotal==null) {
$buytotal = 0;
}

$debt=show("SELECT sum(debt_amount) as 'total' FROM debt 
WHERE Date(date_start)=CURDATE() ");
$debttotal = $debt[0]['total'];
if ($debttotal==null) {
$debttotal = 0;
}

$xarjy=show("SELECT sum(get_price) as 'total' FROM xarjy 
WHERE Date(date)=CURDATE() ");
$xarjytotal = $xarjy[0]['total'];
if ($xarjytotal==null) {
$xarjytotal = 0;
}


$income=$buytotal-$saletotal;
$income=$income-$xarjytotal;
$income=$income-$debttotal;

if ($income<0) {
    $income=0;
}







?>


<div class="container-fluid">

<div class="row d-flex justify-content-center">
        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold"> داهاتی ڕۆژانە </p>
                    <h6 class="font-weight-bolder mb-0">
                      <?=$income?>
                      <span class="text-success text-sm font-weight-bolder">دینار</span>
                    </h6>
                  </div>
                </div>
                <div class="col-4 text-end">
                <img src="../assets/img/income.svg" width="40" alt="income">
                </div>
              </div>
            </div>
          </div>
        </div>



        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">خەرجی ڕۆژانە</p>
                    <h6 class="font-weight-bolder mb-0">
                      <?=$xarjytotal?>
                      <span class="text-success text-sm font-weight-bolder"> دینار</span>
                    </h6>
                  </div>
                </div>
                <div class="col-4 text-end">
                <img src="../assets/img/spend.svg" width="40" alt="income">
                </div>
              </div>
            </div>
          </div>
        </div>
 
        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">فرۆشی ڕۆژانە </p>
                    <h6 class="font-weight-bolder mb-0">
                    <?=$saletotal?>
                      <span class="text-success text-sm font-weight-bolder">  دینار </span>
                    </h6>
                  </div>
                </div>
                <div class="col-4 text-end">
                <img src="../assets/img/sale.svg" width="40" alt="income">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">کڕینی ڕۆژانە </p>
                    <h6 class="font-weight-bolder mb-0">
                    <?=$buytotal?> 
                      <span class="text-success text-sm font-weight-bolder"> دینار </span>
                    </h6>
                  </div>
                </div>
                <div class="col-4 text-end">
                <img src="../assets/img/buy.svg" width="40" alt="income">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
          <div class="card" >
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">قەرزی ڕۆژانە </p>
                    <h6 class="font-weight-bolder mb-0">
                    <?=$debttotal?>
                      <span class="text-success text-sm font-weight-bolder">  دینار </span>
                    </h6>
                  </div>
                </div>
                <div class="col-4 text-end">
                <img src="../assets/img/debt.svg" width="40" alt="income">
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>


</div>


<div class="container mt-5">
    <div class="row d-flex justify-content-center">

    <div class="col-lg-6 col-10 col-xl-6 col-md-12 mb-3">
        <div class="card bg-none p-4">
            <div class="card-title text-center  font-weight-bold">زانیاری بەپێی کات</div>

            <label>بەرواری دەستپێک</label>
            <div class="form-group">
            <input type="date" 
             class="form-control col-md-10 mx-auto" name="date1" id="date1" required="">
        </div>

        <label>بەرواری کۆتایی</label>
            <div class="form-group">
            <input type="date" 
             class="form-control col-md-10 mx-auto" name="date2" id="date2" required="">
        </div>

        <button id="income" class="btn btn-dark  m-auto btn-sm mb-3"> حیسابات <i class="fa fa-arrow-down"></i></button>
        <!-- <div id="income_result" class="btn btn-outline-dark  m-auto btn-sm">0 دینار</div> -->

        </div>
    </div>
    </div>
</div>





<div class="container-fluid mt-5" id="result">

</div>        







<?php require_once('footer.php'); ?>


<script type="text/javascript">

  $(document).ready(function() {

$('#income').on('click',function() {

var date1 = $('#date1').val();
var date2 = $('#date2').val();

if (date1=='' || date2=='') {

}
else {

    $.ajax({
   url:"accounting_time.php",
   method:"POST",
   data:{count:true,date1:date1,date2:date2},
   success:function(data)
   {
    $('#result').html(data);
   }
 

});

}





// click
});


// yakam
  });
</script>