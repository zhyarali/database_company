<?php require_once("header.php") ?>




 <!--  buy -->

 <div class="container mt-5" >
    <div class="row d-flex justify-content-center">

    <div class="col-lg-6 col-10 col-xl-6 col-md-12 mb-3">
        <div class="card bg-none p-4">
            <div class="card-title text-center  font-weight-bold">ڕاپۆرتەکان بەپێی کات</div>

           <form action="view_report.php" method="post">
            <label>جۆری ڕاپۆرت</label>
                <div class="form-group">
                    <select name="report_type"  class="form-control col-md-10 mx-auto" required>
                        <option value="buy">کڕین</option>
                        <option value="sale">فرۆشتن</option>
                        <option value="return_buy">گەڕاوەی کڕین</option>
                        <option value="return_sale">گەڕاوەی فرۆش</option>
                        <option value="debt">قەرزەکان</option>
                        <option value="xarjy">خەرجییەکان</option>
                    </select>
                </div> 

            <label>بەرواری دەستپێک</label>
            <div class="form-group">
            <input type="date" 
             class="form-control col-md-10 mx-auto" name="date1" id="date1" required>
        </div>

        <label>بەرواری کۆتایی</label>
            <div class="form-group">
            <input type="date" 
             class="form-control col-md-10 mx-auto" name="date2" id="date2" required>
        </div>

       <center><button type="submit" name="submit" class="btn btn-dark    mb-3"> بینین <i class="fa fa-arrow-down"></i></button></center> 
    </form>
        </div>
    </div>
    </div>
</div>


<?php require_once("footer.php") ?>