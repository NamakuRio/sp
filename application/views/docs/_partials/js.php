<!-- General JS Scripts -->
<script src="<?php echo base_url(); ?>assets/docs/modules/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/docs/modules/popper.js"></script>
  <script src="<?php echo base_url(); ?>assets/docs/modules/tooltip.js"></script>
  <script src="<?php echo base_url(); ?>assets/docs/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/docs/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/docs/modules/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/docs/js/marked.min.js"></script>
  
  <!-- JS Libraies -->
  <script src="<?php echo base_url(); ?>assets/docs/modules/prism/prism.js"></script>

  <!-- Page Specific JS File -->
  <script id="page-js">
    var base_url      = 'https://getstisla.com/', 
        overview      = 'index.html#/en/2.2.0/overview',
        load_scripts  = [
                      'https://demo.getstisla.com/assets/js/stisla.js', 
                      '<?php echo base_url(); ?>assets/docs/modules/sticky-kit.js',
                      '<?php echo base_url(); ?>assets/docs/modules/chocolat/dist/js/jquery.chocolat.min.js',
                      '<?php echo base_url(); ?>assets/docs/js/scripts.js'
                    ];
  </script>

  <!-- Template JS File -->

  <script src="<?php echo base_url(); ?>assets/docs/assets/js/scripts.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
  <script>
  
  $(".main-sidebar aside ul li a").each(function() {
    $(this).attr('href', '#' + $(this).attr('href'));
  });

  $(".main-sidebar aside ul li a[href^='" + current_path() + "']").addClass("active");

  if($('.main-sidebar aside ul li a.active').length) {    
    setTimeout(function() {
      $(".main-sidebar").animate(
        $(".main-sidebar aside ul li a.active").closest('ul').closest('li').offset().top - 80
      );
    }, 500);
  }

  let sidebar_over = false;
  $(window).scroll(function() {
    if($(this).scrollTop() > 10 && !sidebar_over) {
      $(".main-sidebar").addClass('main-sidebar-top');
      sidebar_over = true;
    }
    
    if($(this).scrollTop() < 10 && sidebar_over) {
      $(".main-sidebar").removeClass('main-sidebar-top');
      sidebar_over = false;
    }
  });

  sidebarInit = true;

$(".do-nicescrol").niceScroll();
  
  </script>