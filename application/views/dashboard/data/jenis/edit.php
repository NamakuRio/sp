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
                  <form method="post" class="needs-validation" novalidate="" action="<?php echo site_url('data/jenis/edit/').$jenis->id_jenis; ?>">
                    <div class="card-header">
                      <a href="<?php echo site_url('data/jenis'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                      <h4>Edit Jenis</h4>
                    </div>
                    <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kode</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="text" class="form-control" name="kode_jenis" placeholder="JN00001" value="<?php echo $jenis->kode_jenis; ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="text" class="form-control"  name="nama_jenis" placeholder="Laptop" value="<?php echo $jenis->nama_jenis; ?>" required>
                          <div class="invalid-feedback">
                            <strong>Nama Jenis</strong> tidak boleh kosong
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Keterangan</label>
                        <div class="col-sm-12 col-md-7">
                          <textarea name="keterangan_jenis" id="keterangan_jenis" cols="30" rows="10" class="form-control" placeholder="Bagus"><?php echo $jenis->keterangan_jenis; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <input type="hidden" name="id" value="<?php echo $jenis->id_jenis; ?>">
                          <button class="btn btn-primary">Simpan Perubahan</button>
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