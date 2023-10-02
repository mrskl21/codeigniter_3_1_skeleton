<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
  <div class="mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
  </div>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
			<?php if($this->session->userdata['logged_in']['photo'] == NULL || $this->session->userdata['logged_in']['photo'] == ""):?>
				<img alt="image" src="<?= base_url();?>assets/img/avatar/avatar-5.png" class="rounded-circle mr-1">
			<?php else:?>
				<img alt="image" src="<?= base_url();?>assets/uploads/images/users/<?= $this->session->userdata['logged_in']['photo'];?>" class="rounded-circle mr-1">
			<?php endif;?>

      <div class="d-sm-none d-lg-inline-block">Halo, <?= $this->session->userdata['logged_in']['fullname']?> </div></a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-title">On-Line</div>
        <a href="<?= base_url()?>profile" class="dropdown-item has-icon">
          <i class="far fa-user"></i> Profil
        </a>
        <div class="dropdown-divider"></div>
        <a href="<?= base_url()?>logout" class="dropdown-item has-icon text-danger">
          <i class="fas fa-sign-out-alt"></i> Keluar
        </a>
      </div>
    </li>
  </ul>
</nav>
