<!-- <div class="bg-dark container d-flex justify-content-center mb-1 rounded overflow-hidden mt-5 py-2 px-3" dir="rtl">
	<span class="s-12 m-0 text-light " style="float:right;">گەشەی پێئەدرێت لەلایەن 
    <i class="fas fa-heart" style="color:#ff5454;"></i><a href="https://www.facebook.com/zarda.dev.5/" class="text-warning">
     شاناز عبدالواحید </a>  - <a href="https://tiyapro.com/app/" class="text-light"> تییا پڕۆ </a> </span>
</div> -->

<!--   Core JS Files   -->

  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/bootstrap.bundle.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  
  <script src="../assets/js/core/jquery.dataTables.js"></script>
  <script src="../assets/js/core/jquery.dataTables.min.js"></script>
  
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>


  <script src="../assets/js/core/alert.js"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
  <script src="../assets/js/printthis.js"></script>

   
</script>
        <script>
      $(document).ready(function() {
          var table = $('#example').DataTable( {
          } );
       
          $('input[type="search"]').addClass("search-input");


      } );





      $('#client').click(function() {
        $('.client_name').removeClass("d-none");
        $('.another').addClass("d-none");
     });

     $('#another').click(function() {
        $('.another').removeClass("d-none");
        $('.client_name').addClass("d-none");
     });

     
  $("#client_status").change(function() {
        if ($("#client_monthly").is(":selected")) {
         $("#daily_amount").addClass("d-none");
         $("#budget_amount").removeClass("d-none");
        }
        else if ($("#client_daily").is(":selected")) {
         $("#daily_amount").removeClass("d-none");
         $("#budget_amount").addClass("d-none");
        }
  })






     </script>
</body>
</html>