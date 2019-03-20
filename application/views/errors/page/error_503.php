<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('auth/_partials/head'); ?>
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="page-error">
          <div class="page-inner">
            <h1>503</h1>
            <div class="page-description">
                Be right back.
            </div>
            <div class="page-search">
              <div class="mt-3">
                <a href="<?php echo site_url(); ?>">Back to Home</a>
              </div>
            </div>
          </div>
        </div>
        <?php $this->load->view('auth/_partials/footer'); ?>
      </div>
    </section>
  </div>

  <?php $this->load->view('auth/_partials/js'); ?>

</body>
</html>