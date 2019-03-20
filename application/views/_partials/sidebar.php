<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">

          <div class="sidebar-brand">
            <a href="<?php echo site_url(); ?>">SARPRAS</a>
          </div>

          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo site_url(); ?>">SP</a>
          </div>

          <ul class="sidebar-menu">

            <li class="menu-header">Dashboard</li>
            
            <li class="<?php if($this->uri->segments[1] == 'dashboard'){ echo "active";} ?>">
              <a href="<?php echo site_url('dashboard'); ?>" class="nav-link">
                <i class="fas fa-fire"></i><span>Dashboard</span>
              </a>
            </li>
            
            <li class="<?php if($this->uri->segments[1] == 'barang'){ echo "active";} ?>">
              <a href="<?php echo site_url('barang'); ?>" class="nav-link">
                <i class="fas fa-server"></i> <span>Barang</span>
              </a>
            </li>
            
            <li class="menu-header"><?php echo $this->session->userdata('nama_level'); ?></li>

            <?php if($this->session->userdata('id_level') == 1): ?>
            
            <li class="<?php if($this->uri->segments[1] == 'inventaris'){ echo "active";} ?>">
              <a href="<?php echo site_url('inventaris'); ?>" class="nav-link">
                <i class="fab fa-docker"></i> <span>Inventaris</span>
              </a>
            </li>

            <li class="<?php if($this->uri->segments[1] == 'laporan'){ echo "active";} ?>">
              <a href="<?php echo site_url('laporan'); ?>" class="nav-link">
                <i class="fas fa-print"></i> <span>Laporan</span>
              </a>
            </li>

            <li class="dropdown <?php if($this->uri->segments[1] == 'data'){ echo "active";} ?>">
              <a href="#" class="nav-link has-dropdown"><i class="fab fa-uikit"></i><span>Data</span></a>
              <ul class="dropdown-menu">
                <li class="<?php if(isset($this->uri->segments[2])){ if($this->uri->segments[2] == 'jenis'){echo "active";}} ?>"><a class="nav-link" href="<?php echo site_url('data/jenis'); ?>">Jenis</a></li>
                <li class="<?php if(isset($this->uri->segments[2])){ if($this->uri->segments[2] == 'ruang'){echo "active";}} ?>"><a class="nav-link" href="<?php echo site_url('data/ruang'); ?>">Ruang</a></li>
              </ul>
            </li>

            <li class="dropdown <?php if($this->uri->segments[1] == 'users'){ echo "active";} ?>">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Users</span></a>
              <ul class="dropdown-menu">
                <li class="<?php if(isset($this->uri->segments[2])){ if($this->uri->segments[2] == 'petugas'){echo "active";}} ?>"><a class="nav-link" href="<?php echo site_url('users/petugas'); ?>">Petugas</a></li>
                <li class="<?php if(isset($this->uri->segments[2])){ if($this->uri->segments[2] == 'peminjam'){echo "active";}} ?>"><a class="nav-link" href="<?php echo site_url('users/peminjam'); ?>">Peminjam</a></li>
                <li class="<?php if(isset($this->uri->segments[2])){ if($this->uri->segments[2] == 'pegawai'){echo "active";}} ?>"><a class="nav-link" href="<?php echo site_url('users/pegawai'); ?>">Pegawai</a></li>
              </ul>
            </li>

            <?php endif; ?>
            
            <li class="menu-header">Lainnya</li>

            <li class="<?php if($this->uri->segments[1] == 'profile'){ echo "active";} ?>">
              <a href="<?php echo site_url('profile'); ?>" class="nav-link">
                <i class="far fa-user-circle"></i> <span>Profile</span>
              </a>
            </li>
            
            <?php if($this->session->userdata('id_level') == 1): ?>

            <li class="<?php if($this->uri->segments[1] == 'pengaturan'){ echo "active";} ?>">
              <a href="<?php echo site_url('pengaturan'); ?>" class="nav-link">
                <i class="fas fa-cog"></i> <span>Pengaturan</span>
              </a>
            </li>

            <?php endif; ?>

          </ul>  
          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="<?php echo site_url('docs'); ?>" target="_blank" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-book"></i> Dokumentasi
            </a>
          </div> 
        </aside>
      </div>
