<nav class="navbar navbar-expand-lg main-navbar">
        <a href="#" class="nav-link sidebar-gone-show h-auto" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
        <a href="#" class="navbar-brand text-center">
          Dokumentasi
        </a>
        <div class="nav-collapse mr-lg-auto mr-0 ml-auto m-lg-0">
          <a class="sidebar-gone-show nav-collapse-toggle sidebar-gone-show nav-link" href="#">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <ul class="navbar-nav mr-3">
            <?php if(!$this->session->userdata('username_petugas')){ ?>
            <li><a href="<?php echo site_url('login'); ?>" class="nav-link">Masuk</a></li>
            <?php }else{ ?>
            <li><a href="<?php echo site_url('dashboard'); ?>" class="nav-link">Dashboard</a></li>
            <?php } ?>
          </ul>
        </div>
        <ul class="navbar-nav d-lg-flex align-items-center justify-content-end w-25 d-none">
          <li class="ml-lg-2"><a href="https://instagram.com/rioprastiawan" target="_blank" class="nav-link btn btn-danger btn-icon icon-left"><i class="fab fa-instagram"></i> @rioprastiawan</a></li>
        </ul>
      </nav>