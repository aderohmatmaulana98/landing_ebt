  <!-- ============================================================== -->
  <!-- All Required js -->
  <!-- ============================================================== -->
  <script src="<?= base_url('assets') ?>/assets/libs/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="<?= base_url('assets') ?>/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- ============================================================== -->
  <!-- This page plugin js -->
  <!-- ============================================================== -->
  <script>
      $(".preloader").fadeOut();
      // ==============================================================
      // Login and Recover Password
      // ==============================================================
      $("#to-recover").on("click", function() {
          $("#loginform").slideUp();
          $("#recoverform").fadeIn();
      });
      $("#to-login").click(function() {
          $("#recoverform").hide();
          $("#loginform").fadeIn();
      });
  </script>
  </body>

  </html>