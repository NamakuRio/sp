<nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?php echo base_url('uploads/foto/foto_pegawai/').$this->session->userdata('foto_pegawai'); ?>" class="rounded-circle mr-1" height="30px">
            <div class="d-sm-none d-lg-inline-block">Hai, <?php echo $this->session->userdata('nama_pegawai'); ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title"><?php echo $this->session->userdata('username_petugas'); ?></div>
              <a href="<?php echo site_url('profile'); ?>" class="dropdown-item has-icon">
                <i class="far fa-user-circle"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?php echo site_url('logout'); ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Keluar
              </a>
            </div>
          </li>
        </ul>
      </nav>