  
</div>

<footer class="footer bg-default">
  <div class="row"></div>
</footer>

<div class="container container-alert">
  <div class="alert alert-danger alert-dismissible fade hide" role="alert">
      <span class="alert-inner--text"><span class="message"></span></span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
</div>

<div class="container container-alert">
  <div class="alert alert-success alert-dismissible fade hide" role="alert">
      <span class="alert-inner--text"><span class="message"></span></span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
</div>

  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="<?= base_url("assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js") ?>"></script>
  <script src="<?= base_url("assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js") ?>"></script>
  <!-- Argon JS -->
  <script src="<?= base_url("assets/js/argon.js?v=1.0.0") ?>"></script>
  
  <script>
    $(document).ready(function(e){

      <?php if($this->session->flashdata('error')):?>
        $('.alert.alert-danger').removeClass('hide');
        $('.alert.alert-danger').addClass('show');
        $('.alert.alert-danger .message').html("<?= $this->session->flashdata('error')?>");

        setTimeout(() => {
          $('.alert.alert-danger').fadeOut('slow');
        }, 8000);
      <?php endif;?>

      <?php if($this->session->flashdata('success')):?>
        $('.alert.alert-success').removeClass('hide');
        $('.alert.alert-success').addClass('show');
        $('.alert.alert-success .message').html("<?= $this->session->flashdata('success')?>");

        setTimeout(() => {
          $('.alert.alert-success').fadeOut('slow');
        }, 8000);
      <?php endif;?>

    });
  </script>

</body>

</html>