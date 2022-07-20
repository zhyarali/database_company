<?php 
require_once("header.php")
?>
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


$income=$saletotal-$buytotal;
$income=$income-$xarjytotal;
$income=$income-$debttotal;

if ($income<0) {
    $income=0;
}

?>
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold"> داهاتی ئەمڕۆ </p>
                    <h5 class="font-weight-bolder mb-0">
                      <?=$income?>
                      <span class="text-success text-sm font-weight-bolder"> دینار</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-first shadow text-center border-radius-md">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>



        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">خەرجییەکانی ئەمڕۆ </p>
                    <h5 class="font-weight-bolder mb-0">
                    <?=$xarjytotal?>
                      <span class="text-success text-sm font-weight-bolder">دینار</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-first shadow text-center border-radius-md">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">کڕینەکانی ئەمڕۆ</p>
                    <h5 class="font-weight-bolder mb-0">
                    <?=$buytotal?>
                      <span class="text-danger text-sm font-weight-bolder"> کڕیار </span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-first shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">فرۆشی ئەمڕۆ </p>
                    <h5 class="font-weight-bolder mb-0">
                    <?=$saletotal?>
                      <span class="text-success text-sm font-weight-bolder">دینار </span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-first shadow text-center border-radius-md">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="container  card mt-4">
            <div class="card-body p-3">
              <div class="row">

              <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
                  <a href="store.php">
                  <div class="bg-cards border-radius-lg h-100">
                    <i class="fal fa-folder-tree s-70 p-3"></i>
                    <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
                       <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 p-1">  مەغزەن   </h3>
                    </div>
                  </div>
                  </a>
                </div>
              
                <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
                  <a href="buy.php">
                  <div class="bg-cards border-radius-lg h-100">
                    <i class="fal fa-cart-arrow-down s-70 p-3"></i>
                    <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
                       <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 p-1"> کڕین  </h3>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
                  <a href="return_buy.php">
                  <div class="bg-cards border-radius-lg h-100">
                    <i class="fal fa-store s-70 p-3"></i>
                    <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
                       <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 p-1"> گەڕاوەی کڕین   </h3>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
                  <a href="sale.php">
                  <div class="bg-cards border-radius-lg h-100">
                    <i class="fal fa-shopping-basket s-70 p-3"></i>
                    <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
                       <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 p-1"> فرۆشتن   </h3>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
                  <a href="return_sale.php">
                  <div class="bg-cards border-radius-lg h-100">
                    <i class="fal fa-store s-70 p-3"></i>
                    <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
                       <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 p-1"> گەڕاوەی فرۆشتن   </h3>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
                  <a href="debts.php">
                  <div class="bg-cards border-radius-lg h-100">
                    <i class="fal fa-hand-holding-usd s-70 p-3"></i>
                    <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
                       <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 p-1"> قەرزەکان    </h3>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
                  <a href="xarjy.php">
                  <div class="bg-cards border-radius-lg h-100">
                    <i class="fal fa-comment-alt-dollar s-70 p-3"></i>
                    <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
                       <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 p-1">  خەرجییەکان    </h3>
                    </div>
                  </div>
                  </a>
                </div>

                <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
                  <a href="dealers.php">
                  <div class="bg-cards border-radius-lg h-100">
                      <i class="fal fa-user-friends s-70 p-3"></i>
                    <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
                       <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 p-1">  فرۆشیارەکان    </h3>
                    </div>
                  </div>
                  </a>
                </div>

                <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
                  <a href="customer.php">
                  <div class="bg-cards border-radius-lg h-100">
                      <i class="fal fa-people-carry s-70 p-3"></i>
                    <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
                       <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 p-1">  کڕیارەکان    </h3>
                    </div>
                  </div>
                  </a>
                </div>

                <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
                  <a href="client.php">
                  <div class="bg-cards border-radius-lg h-100">
                    <i class="fal fa-users-class s-70 p-3"></i>
                    <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
                       <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 p-1">  کارمەندەکان   </h3>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
                  <a href="drivers.php">
                  <div class="bg-cards border-radius-lg h-100">
                    <i class="fal fa-truck-moving s-70 p-3"></i>
                    <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
                       <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 p-1">  سایەقەکان   </h3>
                    </div>
                  </div>
                  </a>
                </div>

                               
                <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
                  <a href="staff.php">
                  <div class="bg-cards border-radius-lg h-100">
                    <i class="fal fa-users s-70 p-3"></i>
                    <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
                       <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 p-1">ستاف</h3>
                    </div>
                  </div>
                  </a>
                </div>

                <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
                  <a href="report.php">
                  <div class="bg-cards border-radius-lg h-100">
                    <i class="fal fa-file s-70 p-3"></i>
                    <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
                       <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 p-1"> راپۆرتەکان    </h3>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
                  <a href="accounting.php">
                  <div class="bg-cards border-radius-lg h-100">
                    <i class="fal fa-calculator s-70 p-3"></i>
                    <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
                       <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 p-1">  ژمێریاری   </h3>
                    </div>
                  </div>
                  </a>
                </div>
                <?php if ($is_admin==1) {?>
                <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
                  <a href="backup.php">
                  <div class="bg-cards border-radius-lg h-100">
                    <i class="fad fa-download s-70 p-3"></i>
                    <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
                       <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 p-1">  پاراستنی سیستەم    </h3>
                    </div>
                  </div>
                  </a>
                </div>
                <?php } ?>

                <?php if ($is_admin==1) {?>
                <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
                  <a href="admin.php">
                  <div class="bg-cards border-radius-lg h-100">
                    <i class="fal fa-users-cog s-70 p-3"></i>
                    <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
                       <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 p-1">  بەڕێوەبەرەکان   </h3>
                    </div>
                  </div>
                  </a>
                </div>
                <?php } ?>

                <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
                  <a href="conv.php">
                  <div class="bg-cards border-radius-lg h-100">
                    <i class="fal fa-sack-dollar s-70 p-3"></i>
                    <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
                       <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 p-1">   دراو   </h3>
                    </div>
                  </div>
                  </a>
                </div>

                <?php if ($is_admin==1) {?>
                <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
                  <a href="settings.php">
                  <div class="bg-cards border-radius-lg h-100">
                    <i class="fal fa-cogs s-70 p-3"></i>
                    <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
                       <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 p-1">  ڕێکخستن   </h3>
                    </div>
                  </div>
                  </a>
                </div>
                <?php } ?>


                
              </div>
            </div>
          </div>
        </div>


       
          </div>
        </div>
      </div>


        
      
<?php 
require_once("footer.php")
?>