<?php 
ob_start();
session_start();
require_once('../server/helper.php') ;

if (isset($_POST["count"])) {

    $date1=secure($_POST['date1']);
    $date2=secure($_POST['date2']);

$sale=show("SELECT sum(cost_co) as 'total' FROM sale 
WHERE Date(date)>='$date1' AND Date(date)<='$date2' AND status='1' ");
$saletotal = $sale[0]['total'];
if ($saletotal==null) {
$saletotal = 0;
}


$buy=show("SELECT sum(cost_co) as 'total' FROM buy 
WHERE Date(date)>='$date1' AND Date(date)<='$date2' AND status='1' ");
$buytotal = $buy[0]['total'];
if ($buytotal==null) {
$buytotal = 0;
}

$debt=show("SELECT sum(debt_amount) as 'total' FROM debt 
WHERE Date(date_start)>='$date1' AND Date(date_start)<='$date2' ");
$debttotal = $debt[0]['total'];
if ($debttotal==null) {
$debttotal = 0;
}



$xarjy=show("SELECT sum(get_price) as 'total' FROM xarjy 
WHERE Date(date)>='$date1' AND Date(date)<='$date2' ");
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


// mwchay karmand

$daily=show("SELECT sum(budget) as 'total' FROM work_daily 
WHERE Date(date)>='$date1' AND Date(date)<='$date2' ");
$dailytotal = $daily[0]['total'];
if ($dailytotal==null) {
$dailytotal = 0;
}

$monthly=show("SELECT sum(budget_amount) as 'total' FROM budget 
WHERE Date(date)>='$date1' AND Date(date)<='$date2' ");
$monthlytotal = $monthly[0]['total'];
if ($monthlytotal==null) {
$monthlytotal = 0;
}


$budget_all=$dailytotal+$monthlytotal;




    echo '
    <div class="row d-flex justify-content-center">

    <div class="col-xl-3 col-sm-6  mb-4">
      <div class="card-e bg-dark" style="border-radius:15px">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm text-white mb-0 text-capitalize font-weight-bold"> داهات </p>
                <h6 class="font-weight-bolder mb-0 text-warning">
                  '.$income.'
                  <span class="text-white text-sm font-weight-bolder">دینار</span>
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


    <div class="col-xl-3 col-sm-6  mb-4">
      <div class="card-e bg-dark" style="border-radius:15px">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm text-white mb-0 text-capitalize font-weight-bold">خەرجی</p>
                <h6 class="font-weight-bolder mb-0 text-warning">
                '.$xarjytotal.'
                  <span class="text-white text-sm font-weight-bolder">دینار</span>
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

    <div class="col-xl-3 col-sm-6 mb-4">
    <div class="card-e bg-dark" style="border-radius:15px">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm text-white mb-0 text-capitalize font-weight-bold">فرۆشتن</p>
                <h6 class="font-weight-bolder mb-0 text-warning">
                  '.$saletotal.'
                  <span class="text-white text-sm font-weight-bolder">دینار</span>
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


    <div class="col-xl-3 col-sm-6 mb-4">
    <div class="card-e bg-dark" style="border-radius:15px">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm text-white mb-0 text-capitalize font-weight-bold">کڕین</p>
                <h6 class="font-weight-bolder mb-0 text-warning">
                '.$buytotal.'
                  <span class="text-white text-sm font-weight-bolder">دینار</span>
                </h6>
              </div>
            </div>
            <div class="col-4 text-end">
                <img src="../assets/img/buy2.svg" width="40" alt="income">
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-xl-3 col-sm-6 mb-4">
    <div class="card-e bg-dark" style="border-radius:15px">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm text-white mb-0 text-capitalize font-weight-bold">قەرز</p>
                <h6 class="font-weight-bolder mb-0 text-warning">
                '.$debttotal.'
                  <span class="text-white text-sm font-weight-bolder">دینار</span>
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

    <div class="col-xl-3 col-sm-6 mb-4">
    <div class="card-e bg-dark" style="border-radius:15px">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm text-white mb-0 text-capitalize font-weight-bold">موچەی کارمەند</p>
                <h6 class="font-weight-bolder mb-0 text-warning">
                  '.$budget_all.'
                  <span class="text-white text-sm font-weight-bolder">دینار</span>
                </h6>
              </div>
            </div>
            <div class="col-4 text-end">
                <img src="../assets/img/salary.svg" width="40" alt="income">
            </div>
          </div>
        </div>
      </div>
    </div>





</div>
    ';
}else{
    echo "nya";
}







?>