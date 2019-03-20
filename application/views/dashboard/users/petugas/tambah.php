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
                  <form method="post" class="needs-validation" novalidate="" action="<?php echo site_url('users/petugas/tambah'); ?>">
                    <div class="card-header">
                      <a href="<?php echo site_url('users/petugas'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                      <h4>Buat Petugas Baru</h4>
                    </div>
                    <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="text" class="form-control" name="username_petugas" placeholder="Rioprastiawan" required>
                          <div class="invalid-feedback">
                            <strong>Username Petugas</strong> tidak boleh kosong
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="password" class="form-control"  name="password_petugas" required>
                          <div class="invalid-feedback">
                            <strong>Password Petugas</strong> tidak boleh kosong
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pegawai</label>
                        <div class="col-sm-12 col-md-7">
                          <select class="form-control select2" name="pegawai" required>
                          <?php foreach($list_pegawai as $lp): ?>
                              <option value="<?php echo $lp->id_pegawai; ?>"><?php echo $lp->nama_pegawai," - ".$lp->nip_pegawai; ?></option>
                            <?php endforeach; ?>
                          </select>
                          <div class="invalid-feedback">
                            <strong>Pegawai</strong> tidak boleh kosong
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Level</label>
                        <div class="col-sm-12 col-md-7">
                          <select class="form-control select2" name="level" required>
                          <?php foreach($list_level as $ll): ?>
                              <option value="<?php echo $ll->id_level; ?>"><?php echo $ll->nama_level; ?></option>
                            <?php endforeach; ?>
                          </select>
                          <div class="invalid-feedback">
                            <strong>Level</strong> tidak boleh kosong
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                          <button class="btn btn-primary">Buat Petugas</button>
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