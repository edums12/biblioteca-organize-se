  
</div>

<footer class="footer bg-default">
  <div class="row"></div>
</footer>

<div class="container container-alert">
  <div class="alert alert-danger alert-dismissible fade hide" role="alert">
      <span class="alert-inner--text"><span class="message"></span></span>
      <button type="button" class="close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
</div>

<div class="container container-alert">
  <div class="alert alert-success alert-dismissible fade hide" role="alert">
      <span class="alert-inner--text"><span class="message"></span></span>
      <button type="button" class="close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
</div>

  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="<?= base_url("assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js") ?>"></script>
  <script src="<?= base_url("assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js") ?>"></script>
  <script src="<?= base_url("assets/vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js") ?>"></script>
  <!-- Argon JS -->
  <script src="<?= base_url("assets/js/argon.js?v=1.0.0") ?>"></script>
  
  <script>
    $(document).ready(function(e){

      <?php if(@Base::$flashdata['error']):?>
        $('.alert.alert-danger').removeClass('hide');
        $('.alert.alert-danger').addClass('show');
        $('.alert.alert-danger .message').html("<?= @Base::$flashdata['error']?>");

        setTimeout(() => {
          $('.alert.alert-danger').fadeOut('slow');
        }, 8000);
      <?php endif;?>

      <?php if(@Base::$flashdata['success']):?>
        $('.alert.alert-success').removeClass('hide');
        $('.alert.alert-success').addClass('show');
        $('.alert.alert-success .message').html("<?= @Base::$flashdata['success']?>");

        setTimeout(() => {
          $('.alert.alert-success').fadeOut('slow');
        }, 8000);
      <?php endif;?>

        $('.alert .close').click(function(e){
          e.preventDefault();

          var alert = $(e.currentTarget).parent();

          alert.removeClass('show');
          alert.addClass('hide');
        });

        $('a.print-table').click(function(e){
          e.preventDefault();

          window.print();
        });
    });
  </script>

</body>

</html>