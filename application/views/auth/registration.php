<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('part/head');?>


<body>
  <div id="app">
    <section class="section">
      <div class="container mt-1">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
            <div class="login-brand">
              <img src="<?= base_url();?>assets/img/logo-new/logo-2.png" alt="logo" width="200" class="mt-5">
            </div>

            <div class="card card-warning">
              <div class="card-header"><h4>Registration</h4></div>

              <div class="card-body">
                <form class="form-horizontal m-t-20" action="<?= base_url();?>registration/attemp" method="POST">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="username" required>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input id="fullname" type="text" class="form-control" name="fullname" required>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" required>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" required>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                    	<label for="passwordConfirm" class="control-label">Re-enter Password</label>
                    </div>
                    <input id="passwordConfirm" type="password" class="form-control" name="passwordConfirm" required>
                    <small class="ml-2" id='message'></small>
                  </div>

                  <div class="form-group">
                    <button id="submit" type="submit" name="submit" class="btn btn-warning btn-lg btn-block" tabindex="4">
                      Submit
                    </button>
                  </div>
                </form>

              </div>
            </div>
            <div class="mt-2 text-muted text-center">
              Already had an account? <a href="<?= base_url();?>login">Log In</a>
            </div>
            <div class="simple-footer">
              &copy; <?=date("Y");?> <div class="bullet"></div> <a href="https://catcoincrypto.me/" target="_blank">Catcoin</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  

  <?php $this->load->view('part/script');?>
  <?php $this->load->view('part/alert');?>
<script>
    $('form').validate();
    $('#password, #passwordConfirm').on('keyup', function() {
        if ($('#password').val() == $('#passwordConfirm').val()) {
            $('#message').html('Match').css('color', 'green');
            $('#submit').prop('disabled', false);
        } else {
            $('#message').html('Does not Match').css('color', 'red');
            $('#submit').prop('disabled', true);
        }
    });
</script>

</body>
</html>
