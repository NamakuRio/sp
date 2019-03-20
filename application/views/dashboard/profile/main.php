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
          <div class="section-body">
            </div>
            <h2 class="section-title">Hi, <?php echo $this->session->userdata('nama_pegawai'); ?>!</h2>
            <p class="section-lead">
              Ubah informasi tentang diri Anda di sini.
            </p>

            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget animated fadeIn faster">
                  <div class="profile-widget-header">                     
                    <img alt="image" src="<?php echo base_url('uploads/foto/foto_pegawai/').$this->session->userdata('foto_pegawai'); ?>" data-image="<?php echo base_url('uploads/foto/foto_pegawai/').$this->session->userdata('foto_pegawai'); ?>" data-title="Foto Profile" height="100" class="rounded-circle profile-widget-picture gallery-item">
                    <div class="profile-widget-items">
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Status</div>
                        <div class="profile-widget-item-value"><?php echo $this->session->userdata('nama_level'); ?></div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">NIP</div>
                        <div class="profile-widget-item-value"><?php echo $this->session->userdata('nip_pegawai'); ?></div>
                      </div>
                    </div>
                  </div>
                  <div class="profile-widget-description">
                    <div class="profile-widget-name"><?php echo $this->session->userdata('nama_pegawai'); ?> <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> <?php echo $this->session->userdata('username_petugas'); ?></div></div>
                    
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-7">
                <div class="card animated fadeIn">
                  <form method="post" class="needs-validation" novalidate="" action="<?php echo site_url('profile/edit'); ?>">
                    <div class="card-header">
                      <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">                               
                          <div class="form-group col-md-7 col-12">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" value="<?php echo $this->session->userdata('nama_pegawai'); ?>" required="">
                            <div class="invalid-feedback">
                            Silakan isi nama
                            </div>
                          </div>
                          <div class="form-group col-md-5 col-12">
                            <label>NIP</label>
                            <input type="text" class="form-control" name="nip" value="<?php echo $this->session->userdata('nip_pegawai'); ?>" readonly>
                            <small class="form-text text-muted">NIP tidak dapat diedit</small>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-12">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="10" required><?php echo $this->session->userdata('alamat_pegawai'); ?></textarea>
                            <div class="invalid-feedback">
                              Silakan isi alamatnya
                            </div>
                          </div>
                        </div>
                        <div class="row">                               
                          <div class="form-group col-md-6 col-12">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $this->session->userdata('username_petugas'); ?>" readonly="">
                            <small class="form-text text-muted">Username tidak dapat diedit</small>
                          </div>
                          <div class="form-group col-md-6 col-12">
                            <label>Password</label>
                            <input type="password" class="form-control pwstrength" name="password" data-indicator="pwindicator">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengedit password</small>
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                          </div>
                        </div>
                        <div class="row">      
                          <div class="form-group col-12">
                            <label>Level</label>
                            <input type="text" class="form-control" name="level" value="<?php echo $this->session->userdata('nama_level'); ?>" readonly>
                            <small class="form-text text-muted">Level tidak dapat diedit</small>
                          </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary">Simpan Perubahan</button>
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