<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php $this->load->view('auth/_partials/head'); ?>

</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              Sarpras
            </div>
            
            <?php $this->load->view('_partials/notif'); ?>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>
              <div class="card-body">
                <form method="POST" action="<?php echo site_url('login/proses'); ?>" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="username_petugas">Username</label>
                    <input id="username_petugas" type="text" class="form-control" name="username_petugas" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Silakan isi username Anda
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password_petugas" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="<?php echo site_url('lupa-password'); ?>" class="text-small">
                          Lupa Password?
                        </a>
                      </div>
                    </div>
                    <input id="password_petugas" type="password" class="form-control" name="password_petugas" tabindex="2" required>
                    <div class="invalid-feedback">
                      Silakan isi password Anda 
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            
            <?php $this->load->view('auth/_partials/footer'); ?>

          </div>
        </div>
      </div>
    </section>
  </div>

  <?php $this->load->view('auth/_partials/js'); ?>

</body>
</html>