<!DOCTYPE html>
<html lang="id">
<head>
    <?php $this->load->view('docs/_partials/head'); ?> 
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
      
            <?php $this->load->view('docs/_partials/navbar'); ?>
      
            <?php $this->load->view('docs/_partials/sidebar'); ?>
      
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <div class="section-header">
                            <h1 id="overview">Overview</h1>
                            <div class="ml-auto">
                                <a href="" class="btn btn-white btn-icon icon-right btn-lg">
                                    Skip to License
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                        <hr>
                        <ul>
                            <li><a href="#thank-you">Thank You</a></li>
                        </ul>
                        <p><a name="section-1"></a></p>

                        <h2 id="thank-you">Thank You</h2>
                        <p>First, thank you for using Stisla. Stisla is a responsive HTML5 admin template based on Bootstrap 4. Using this template you can easily create the layout you want</p>
                        <p>You can use this template in PHP Native, Laravel Framework, CodeIgniter or the other depending on the skills that you can acquire.</p>
                        <p>First, thank you for using Stisla. Stisla is a responsive HTML5 admin template based on Bootstrap 4. Using this template you can easily create the layout you want</p>
                        <p>You can use this template in PHP Native, Laravel Framework, CodeIgniter or the other depending on the skills that you can acquire.</p>
                        
                        <hr class="mt-5 mb-5">
                        <div class="d-flex justify-content-lg-end">
                            <a href="<?php echo site_url('docs'); ?>" target="_blank" class="btn btn-white btn-icon icon-right btn-lg">
                                Next: License     
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </section>
            </div>
            <?php $this->load->view('docs/_partials/footer'); ?>
        </div>
    </div>

    <?php $this->load->view('docs/_partials/js'); ?>
</body>
</html>