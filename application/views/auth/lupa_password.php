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
            <div class="card card-primary">
              <div class="card-header"><h4>Lupa Password</h4></div>

              <div class="card-body">
                <p class="text-muted">Kami akan mengirimkan tautan untuk mereset kata sandi Anda</p>
                <form method="POST" action="<?php echo site_url('lupa-password/proses'); ?>" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email_user">Email</label>
                    <input id="email_user" type="email" class="form-control" name="email_user" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Silakan isi email Anda
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Kirim
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