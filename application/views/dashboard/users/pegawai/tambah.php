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
          <?php //$this->load->view('_partials/breadcrumb'); ?>
          <?php $this->load->view('_partials/notif'); ?>
          <div class="section-body">
            <!-- <h2 class="section-title">Buat Rekening Baru</h2>
            <p class="section-lead">
              Anda dapat menambahkan rekening di sini...
            </p> -->

            <div class="row">
              <div class="col-12">
                <div class="card animated fadeIn">
                  <form method="post" class="needs-validation" novalidate="" action="<?php echo site_url('users/pegawai/tambah'); ?>" enctype="multipart/form-data">
                    <div class="card-header">
                      <a href="<?php echo site_url('users/pegawai'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                      <h4>Tambah Pegawai Baru</h4>
                    </div>
                    <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama*</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="text" class="form-control" name="nama_pegawai" placeholder="Bimo Rio Prastiawan" required>
                          <div class="invalid-feedback">
                            <strong>Nama Pegawai</strong> tidak boleh kosong
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIP*</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="number" class="form-control"  name="nip_pegawai" placeholder="21189" required>
                          <div class="invalid-feedback">
                            <strong>NIP Pegawai</strong> tidak boleh kosong
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat*</label>
                        <div class="col-sm-12 col-md-7">
                          <textarea class="form-control" name="alamat_pegawai" id="alamat_pegawai" cols="30" rows="10" placeholder="Jl. Tirtoyoso Tengah No.34" required></textarea>
                          <div class="invalid-feedback">
                            <strong>Alamat</strong> tidak boleh kosong
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="file" class="form-control" name="foto_pegawai">
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                          <button class="btn btn-primary">Tambah Pegawai</button>
                          <small class="form-text text-muted">*tidak boleh kosong</small>
                        </div>
                      </div>
                    </div>
                  </form>
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