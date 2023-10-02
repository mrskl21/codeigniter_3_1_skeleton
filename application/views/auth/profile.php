<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('part/head');?>
<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <?php $this->load->view('part/topbar');?>
            <?php $this->load->view('part/sidebar');?>

            <div class="main-content">
                <section class="section">
                    <?php $this->load->view('part/title');?>

                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Ubah Data</h4>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url();?>profile/update" enctype="multipart/form-data" class="form" method="POST">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="id" id="id" hidden value="<?=$data->id;?>">
                                                <input type="text" class="form-control" name="username_current" id="username_current" hidden value="<?=$data->username;?>">
                                                <input type="text" class="form-control" name="username" id="username" required value="<?=$data->username;?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="fullname" id="fullname" required value="<?=$data->fullname;?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" name="email" id="email" required value="<?=$data->email;?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Peran</label>
                                            <div class="col-sm-10">
                                                <select name="roles_id" id="roles_id" class="form-control" disabled>
                                                    <?php foreach ($roles as $r):?>
                                                        <option <?=($r->id == $data->roles_id)?"selected":"";?> value="<?=$r->id?>"><?=$r->title;?></option>
                                                    <?php endforeach ;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Ubah Password</h4>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url();?>profile/update_password" enctype="multipart/form-data" class="form" method="POST">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Password Saat Ini</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="id" id="id" hidden value="<?=$data->id;?>">
                                                <input type="password" class="form-control" name="old_password" id="old_password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Password Baru</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="password" id="password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Ulangi Password Baru</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="passwordConfirm" id="passwordConfirm" required>
                                                <small class="ml-2" id='message'></small>
                                            </div>
                                        </div>
                                        <div class="form-group text-right">
                                            <button id="submit" type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
						<div class="col-lg-3">
							<div class="card">
								<div class="card-header">
									<h4>Ubah Foto</h4>
								</div>
								<div class="card-body">
									<div class="mb-4">
										<?php if($this->session->userdata['logged_in']['photo'] == NULL || $this->session->userdata['logged_in']['photo'] == ""):?>
											<img alt="image" width="100%" src="<?= base_url();?>assets/img/avatar/avatar-5.png">
										<?php else:?>
											<img alt="image" width="100%" src="<?= base_url();?>assets/uploads/images/users/<?= $this->session->userdata['logged_in']['photo'];?>">
										<?php endif;?>
									</div>
									<form action="<?= base_url();?>profile/update_image" enctype="multipart/form-data" class="form" method="POST">
										<div class="form-group">
											<label for="photo_old">Foto Sekarang</label>
											<input type="text" class="form-control" name="id" id="id" hidden value="<?=$data->id;?>">
											<input type="text" class="form-control" name="photo_old" id="photo_old" value="<?=$data->photo;?>" readonly>
										</div>
										<div class="form-group">
											<label for="photo">Foto Baru</label>
											<input type="file" class="form-control" name="photo" id="photo" accept="image/png, image/gif, image/jpeg, image/jpg" required>
										</div>
										<div class="form-group text-right">
											<button id="submit" type="submit" name="submit" class="btn btn-primary">Simpan</button>
										</div>
									</form>
								</div>
							</div>
						</div>
                    </div>
                </section>
            </div>
            
            <?php $this->load->view('part/foot');?>
            
        </div>
    </div>
	
    <?php $this->load->view('part/script');?>
	<?php $this->load->view('part/alert');?>
    <script>
        $('form').validate();
        $('#password, #passwordConfirm').on('keyup', function() {
            if ($('#password').val() == $('#passwordConfirm').val()) {
                $('#message').html('Match').css('color', 'green');
                $('#submit').prop('disabled', false);
            } else {
                $('#message').html('Does not Match').css('color', 'red');
                $('#submit').prop('disabled', true);
            }
        });
    </script>




</body>
</html>
