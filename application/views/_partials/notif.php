<?php if(isset($_SESSION['success'])){ ?>
<div class="alert alert-success alert-dismissible show fade">
<div class="alert-body">
  <button class="close" data-dismiss="alert">
    <span>&times;</span>
  </button>
  <?php echo $_SESSION['success']; ?>
</div>
</div>
<?php } ?> 
<?php if(isset($_SESSION['gagal'])){ ?>
<div class="alert alert-danger alert-dismissible show fade">
<div class="alert-body">
  <button class="close" data-dismiss="alert">
    <span>&times;</span>
  </button>
  <?php echo $_SESSION['gagal']; ?>
</div>
</div>
<?php } ?>            