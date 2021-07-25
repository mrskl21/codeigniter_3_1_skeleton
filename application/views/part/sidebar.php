<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">CI 3.1 Skeleton</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">CIS</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Main</li>
        <li class="<?=($title['parent'] == "Home")?"active":"";?>"><a class="nav-link" href="<?= base_url();?>home"><i class="far fa-building"></i> <span>Home</span></a></li>

        <?php 
          if(
              $this->session->userdata['logged_in']['permissions'] && in_array( "auth-users", $this->session->userdata['logged_in']['permissions']) ||
              $this->session->userdata['logged_in']['permissions'] && in_array( "auth-permissions", $this->session->userdata['logged_in']['permissions']) ||
              $this->session->userdata['logged_in']['permissions'] && in_array( "auth-permissions", $this->session->userdata['logged_in']['permissions'])
          ):
        ?>
        <li class="menu-header">Auth</li>     
        <?php endif;?>

        <?php if($this->session->userdata['logged_in']['permissions'] && in_array( "auth-users", $this->session->userdata['logged_in']['permissions'])):?>
        <li class="<?=($title['parent'] == "Users")?"active":"";?>"><a class="nav-link" href="<?= base_url();?>auth/users"><i class="far fa-user"></i> <span>Users</span></a></li>
        <?php endif;?>

        <?php if($this->session->userdata['logged_in']['permissions'] && in_array( "auth-roles", $this->session->userdata['logged_in']['permissions'])):?>
        <li class="<?=($title['parent'] == "Roles")?"active":"";?>"><a class="nav-link" href="<?= base_url();?>auth/roles"><i class="far fa-user-circle"></i> <span>Roles</span></a></li>
        <?php endif;?>

        <?php if($this->session->userdata['logged_in']['permissions'] && in_array( "auth-permissions", $this->session->userdata['logged_in']['permissions'])):?>
        <li class="<?=($title['parent'] == "Permissions")?"active":"";?>"><a class="nav-link" href="<?= base_url();?>auth/permissions"><i class="far fa-address-card"></i> <span>Permissions</span></a></li>
        <?php endif;?>

      </ul> 
    </aside>
</div>