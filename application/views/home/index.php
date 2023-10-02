<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('part/head');?>
<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <?php $this->load->view('part/topbar');?>
            <?php $this->load->view('part/sidebar');?>

            <!-- Main Content -->
            <div class="main-content">
				<section class="section">
				<?php //$this->load->view('part/title');?>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-hero hero-primary text-light">
									<div class="card-icon">
									  <i class="far fa-user"></i>
									</div>
									<h4>Hi, <?= $this->session->userdata['logged_in']['fullname']?> !</h4>
									<div class="card-description" style="font-size:13pt;font-weight:100;line-height: normal !important;height:20px;">
										<small>Selamat Datang di Aplikasi Monitoring Tumbuh Kembang Anak - PKK Kecamatan Mapanget</small>
									</div>
								</div>
							</div>
							<img src="<?=base_url();?>assets/img/bg.png" width="100%" alt="">
						</div>
					</div>
				</section>
            </div>
            <?php $this->load->view('part/foot');?>
            
      	</div>
	</div>

	<?php $this->load->view('part/script');?>
	<?php $this->load->view('part/alert');?>

</body>
</html>
