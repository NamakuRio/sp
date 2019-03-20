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
                  <form method="post" class="needs-validation" novalidate="" action="<?php echo site_url('barang/tambah'); ?>">
                    <div class="card-header">
                      <a href="<?php echo site_url('barang'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                      <h4>Tambah Peminjaman Baru</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Peminjam*</label>
                        <div class="col-sm-12 col-md-7">
                          <select class="form-control select2" name="peminjam" required>
                          <?php foreach($list_peminjam as $lp): ?>
                              <option value="<?php echo $lp->id_pegawai; ?>"><?php echo $lp->nama_pegawai; ?></option>
                            <?php endforeach; ?>
                          </select>
                          <div class="invalid-feedback">
                            <strong>Peminjam</strong> tidak boleh kosong
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Barang*</label>
                        <div class="col-sm-12 col-md-7">
                          <select class="form-control select2" name="barang" onchange="setJumlah(this.value);" required>
                          <?php foreach($list_inventaris as $li): ?>
                              <option value="<?php echo $li->id_inventaris; ?>"><?php echo $li->nama_inventaris." (".$li->kode_inventaris.")"; ?></option>
                            <?php endforeach; ?>
                          </select>
                          <div class="invalid-feedback">
                            <strong>Barang</strong> tidak boleh kosong
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah*</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="number" class="form-control" id="jumlah_input" name="jumlah_pinjam" placeholder="10" required >
                          <small class="form-text text-muted" id="text-jumlah-peminjaman"></small>
                          <div class="invalid-feedback">
                            <strong>Jumlah Pinjam</strong> tidak boleh kosong
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal*</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="text" class="form-control daterange" name="tanggal_pinjam" placeholder="10" required  onchange="console.log(this.value);" >
                          <div class="invalid-feedback">
                            <strong>Tanggal Pinjam</strong> tidak boleh kosong
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                          <button class="btn btn-primary">Tambah Peminjaman</button>
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
  <script>

    function setJumlah(id_inventaris){

      $.ajax({
        type:'GET',
        url: '<?php echo site_url('barang/getMaxJumlah/'); ?>'+id_inventaris,
        success: function(result){
            response = JSON.parse(result);

            if(response.status == "sukses"){
                $('#jumlah_input').attr('max',response.data);
                $('#text-jumlah-peminjaman').html('Jumlah maksimal peminjaman '+response.data);
            }
            else if(response.status == "gagal"){
                switch(response.kode_v){
                    case "1":
                        swal("Gagal Login!", "Silahkan ulangi lagi..", "error");
                    break;
                    case "2":
                        swal("Gagal Login!", "Username atau Email Anda sudah Terdaftar\nMohon gunakan yang lainnya..", "error");
                    break;
                    default:
                    break;
                }
            }
            $('.loader-auth').fadeOut();
        }
    })


    }
  
  </script>
</body>
</html>