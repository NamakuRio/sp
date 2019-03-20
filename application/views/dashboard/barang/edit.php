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
                <div class="card">
                  <form method="post" class="needs-validation" novalidate="" action="<?php echo site_url('inventaris/edit/').$inventaris->id_inventaris; ?>">
                    <div class="card-header">
                      <a href="<?php echo site_url('inventaris'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                      <h4>Edit Inventaris</h4>
                    </div>
                    <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kode</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="text" class="form-control" name="kode_inventaris" placeholder="IV00001" value="<?php echo $inventaris->kode_inventaris; ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama*</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="text" class="form-control" name="nama_inventaris" placeholder="HP EliteBook Folio 9470m"  value="<?php echo $inventaris->nama_inventaris; ?>" required>
                          <div class="invalid-feedback">
                            <strong>Nama Inventaris</strong> tidak boleh kosong
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kondisi</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="text" class="form-control" name="kondisi_inventaris" placeholder="Bagus" value="<?php echo $inventaris->kondisi_inventaris; ?>">
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Keterangan</label>
                        <div class="col-sm-12 col-md-7">
                          <textarea class="form-control" name="keterangan_inventaris" id="keterangan_inventaris" cols="30" rows="10" placeholder="Awet"><?php echo $inventaris->keterangan_inventaris; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah*</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="number" class="form-control" name="jumlah_inventaris" placeholder="10" value="<?php echo $inventaris->jumlah_inventaris; ?>" required>
                          <div class="invalid-feedback">
                            <strong>Jumlah Inventaris</strong> tidak boleh kosong
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis</label>
                        <div class="col-sm-12 col-md-7">
                          <select class="form-control select2" name="jenis" required>
                          <?php foreach($list_jenis as $lj): ?>
                              <option value="<?php echo $lj->id_jenis; ?>" <?php if($lj->id_jenis == $inventaris->id_jenis){ echo "selected";} ?>><?php echo $lj->nama_jenis; ?></option>
                            <?php endforeach; ?>
                          </select>
                          <div class="invalid-feedback">
                            <strong>Jenis</strong> tidak boleh kosong
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ruang</label>
                        <div class="col-sm-12 col-md-7">
                          <select class="form-control select2" name="ruang" required>
                          <?php foreach($list_ruang as $lr): ?>
                              <option value="<?php echo $lr->id_ruang; ?>" <?php if($lr->id_ruang == $inventaris->id_ruang){ echo "selected";} ?>><?php echo $lr->nama_ruang; ?></option>
                            <?php endforeach; ?>
                          </select>
                          <div class="invalid-feedback">
                            <strong>Ruang</strong> tidak boleh kosong
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <input type="hidden" name="id" value="<?php echo $inventaris->id_inventaris; ?>">
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