<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('part/head');?>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="<?= base_url();?>assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <form class="form-horizontal m-t-20" action="<?= base_url();?>validate" method="POST">

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                  </div>

                  <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                  </div>

                  <div class="form-group mt-5">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>

                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="<?= base_url();?>registration">Create One</a>
            </div>
            <div class="simple-footer">
              Copyright &copy; <?=date("Y");?> Develop By <a href="https://lasahido.id/" target="_blank">lasahido.id</a> 
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php $this->load->view('part/script');?>
  <?php $this->load->view('part/alert');?>

</body>
</html>