<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('_partials/head'); ?>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      
      <?php $this->load->view('_partials/navbar'); ?>

      <?php $this->load->view('_partials/sidebar'); ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <?php $this->load->view('_partials/breadcrumb'); ?>
          <?php $this->load->view('_partials/notif'); ?>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1 animated fadeIn faster">
                <div class="card-icon bg-danger">
                  <i class="fas fa-user-check"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Peminjam</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $totalPeminjam; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1 animated fadeIn fast">
                <div class="card-icon bg-warning">
                  <i class="fab fa-opencart"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Dipinjam</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $totalDipinjam; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1 animated fadeIn slow">
                <div class="card-icon bg-primary">
                  <i class="fab fa-codepen"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Digudang</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $totalDigudang; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1 animated fadeIn slower">
                <div class="card-icon bg-success">
                  <i class="fas fa-sitemap"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Barang</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $totalBarang; ?>
                  </div>
                </div>
              </div>
            </div>                  
          </div>
        </section>
      </div>

      <?php $this->load->view('_partials/footer'); ?>
    </div>
  </div>
    <?php $this->load->view('_partials/js'); ?>
</body>
</html>