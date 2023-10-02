<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="<?php echo base_url() ?>home"><img src="<?= base_url() ?>assets/img/logo/logo.png" width="12%" alt="" class=""> PKK Kec. Mapanget</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="<?php echo base_url() ?>home"><img src="<?= base_url() ?>assets/img/logo/logo.png" width="60%" alt="" class="mt-2"></a>
      </div>
      <ul class="sidebar-menu mt-5">
        <li class="menu-header">Utama</li>
        <li class="<?=($title['parent'] == "Beranda")?"active":"";?>"><a class="nav-link" href="<?= base_url();?>home"><i class="far fa-circle"></i> <span>Beranda</span></a></li>
        <!-- <li class="<?=($title['parent'] == "Dashboard")?"active":"";?>"><a class="nav-link" href="<?= base_url();?>dashboard"><i class="far fa-chart-bar"></i> <span>Dashboard</span></a></li> -->

        <?php 
					if(isset($this->session->userdata['logged_in']['permissions']) && (
							in_array("data-worker", $this->session->userdata['logged_in']['permissions']) ||
							in_array("data-parent", $this->session->userdata['logged_in']['permissions'])
						)
					):
				?>        
        <li class="<?=($title['parent'] == "Data Anak")?"active":"";?>"><a class="nav-link" href="<?= base_url();?>dash/child"><i class="fas fa-users"></i> <span>Data Anak</span></a></li>
        <?php endif;?>

				<?php 
          // if(isset($this->session->userdata['logged_in']['permissions']) && (
          //     in_array("ref-settings", $this->session->userdata['logged_in']['permissions'])
          // )):
        ?>   
        <!-- <li class="menu-header">Referensi</li> -->
        <?php //endif;?>
        <?php //if(isset($this->session->userdata['logged_in']['permissions']) && in_array("ref-settings", $this->session->userdata['logged_in']['permissions'])):?>        
        <!-- <li class="<?=($title['parent'] == "Pengaturan")?"active":"";?>"><a class="nav-link" href="<?= base_url();?>ref/settings"><i class="fas fa-cog"></i> <span>Pengaturan</span></a></li> -->
        <?php //endif;?>
 

        <?php 
          if(isset($this->session->userdata['logged_in']['permissions']) && (
              in_array("auth-users", $this->session->userdata['logged_in']['permissions']) ||
              in_array("auth-roles", $this->session->userdata['logged_in']['permissions']) ||
              in_array("auth-permissions", $this->session->userdata['logged_in']['permissions'])
          )):
        ?>        
        <li class="menu-header">Autentikasi</li>
        <?php endif;?>
        <?php if(isset($this->session->userdata['logged_in']['permissions']) && in_array("auth-users", $this->session->userdata['logged_in']['permissions'])):?>        
        <li class="<?=($title['parent'] == "Pengguna")?"active":"";?>"><a class="nav-link" href="<?= base_url();?>auth/users"><i class="far fa-user"></i> <span>Pengguna</span></a></li>
        <?php endif;?>
        <?php if(isset($this->session->userdata['logged_in']['permissions']) && in_array("auth-roles", $this->session->userdata['logged_in']['permissions'])):?>        
        <li class="<?=($title['parent'] == "Peran")?"active":"";?>"><a class="nav-link" href="<?= base_url();?>auth/roles"><i class="far fa-user-circle"></i> <span>Peran</span></a></li>
        <?php endif;?>
        <?php if(isset($this->session->userdata['logged_in']['permissions']) && in_array("auth-permissions", $this->session->userdata['logged_in']['permissions'])):?>        
        <li class="<?=($title['parent'] == "Hak Akses")?"active":"";?>"><a class="nav-link" href="<?= base_url();?>auth/permissions"><i class="far fa-address-card"></i> <span>Hak Akses</span></a></li>
        <?php endif;?>

      </ul> 
    </aside>
</div>
