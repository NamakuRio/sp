<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('_partials/head'); ?>
    <style>
        .menu-laporan{
            transition:.5s all;
            /* box-shadow:5px 5px 3px #80808033; */
            cursor:pointer;
        }
        .menu-laporan:hover{
            box-shadow:0px 0px 25px #8080805c;
        }
    </style>
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
          <div class="section-body">
            </div>
            <h2 class="section-title">Cetak Laporan</h2>
            <p class="section-lead">
              Pilih menu yang ingin anda cetak
            </p>
            <div class="row"> 
                <?php for($i=0;$i<count($warna);$i++): ?>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-center menu-laporan animated fadeIn <?php echo $delay_animation[$i]; ?>">
                        <a href="<?php echo site_url('laporan/').$link[$i]; ?>" class="text-dark card-cta">
                        <div class="pt-2 pb-2 mt-5 mb-5">
                            <figure class="avatar mr-2 avatar-xl <?php echo $warna[$i]; ?> img-thumbnail text-white">
                                <i class="<?php echo $icon[$i]; ?>" style="font-size:30px;margin:15px;"></i>
                            </figure>
                            <h4 class="mt-3" class="text-dark"><?php echo $judul_laporan[$i]; ?></h4>
                        </div>
                        </a>
                    </div> 
                </div> 
                <?php endfor; ?>
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