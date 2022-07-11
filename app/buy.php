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


<div class="container-fluid d-flex justify-content-around mt-5 flex-wrap">
<h5  style="font-size:16px" class="btn btn-dark ">کڕین</h5>
</div>



<div class="container-fluid col-md-10  card">
  <div class="row m-5">

    <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
      <a href="buy_helka.php"> 
      <div class="bg-cards border-radius-lg h-100">
        <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
          <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 mt-5 p-1" > هێلکە </h3>
        </div>
      </div>
      </a>
    </div>

    <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
    <a href="buy_qa3a.php"> 
      <div class="bg-cards border-radius-lg h-100">
        <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
          <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 mt-5 p-1" data-toggle="modal"
            data-target="#qa3a"> ئەشیای قاعە </h3>
        </div>
      </div>
</a>
    </div>

    <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
    <a href="buy_3alaf.php"> 
      <div class="bg-cards border-radius-lg h-100">
        <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
          <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 mt-5 p-1"> علف </h3>
        </div>
      </div>
</a>
    </div>

    <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
    <a href="buy_asn.php"> 
      <div class="bg-cards border-radius-lg h-100">
        <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
          <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 mt-5 p-1"> ئاسن </h3>
        </div>
      </div>
</a>
    </div>

    <!-- <div class="col-lg-2 col-6 col-xl-2 col-md-12 ms-auto text-center mt-5 mt-lg-0 p-2">
    <a href="buy_panal.php"> 
      <div class="bg-cards border-radius-lg h-100">
        <div class="position-relative  align-items-center justify-content-center h-80 mt-3">
          <h3 class="text-light btn btn-dark container s-14 col col-xl-8 col-8 col-md-8 mt-5 p-1"> پەناڵ </h3>
        </div>
      </div>
</a>
    </div> -->

  </div>
</div>

<?php if ($is_admin==1) {?>
<div class="container-fluid d-flex justify-content-around mt-5 flex-wrap">
<a href="dealers.php"  style="font-size:16px" class="btn btn-success "><i
            class="fas fa-user-plus "></i> زیادکردنی  فرۆشیار</a>
</div>
<?php } ?>


<?php require_once('footer.php'); ?>
