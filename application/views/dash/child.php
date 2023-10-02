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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Table</h4>
									<?php if(in_array("data-worker", $this->session->userdata['logged_in']['permissions'])):?>
                                    <div class="card-header-action">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Tambah Data <i class="fas fa-plus"></i></button type="button">
                                    </div>
									<?php endif; ?>
                                </div>
                                <div class="card-body table-responsive">
									<table class="table table-striped" id="data-table">
										<thead>                                 
											<tr>
												<th>#</th>
												<th>Nama Orang Tua</th>
												<th>Nama Anak</th>
												<th>Jenis Kelamin</th>
												<th>Tanggal Lahir</th>
												<th>Umur</th>
												<th>NIK</th>
												<th>No. KK</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
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

    <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-add" enctype="multipart/form-data" class="form">
                    <div class="modal-body">
						<div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Orang Tua</label>
                            <div class="col-sm-10">
                                <select name="parent_id" id="parent_id" class="form-control select2" style="width:100%" required>
									<option value="">--Pilih--</option>
                                    <?php foreach ($parent as $p):?>
                                        <option value="<?=$p->id?>"><?=$p->fullname;?></option>
                                    <?php endforeach ;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Nama Anak</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fullname" class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="nik" id="nik" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fullname" class="col-sm-2 col-form-label">KK</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="kk" id="kk" required autocomplete="off">
                            </div>
                        </div>
						<div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select name="gender" id="gender" class="form-control" required>
									<option value="">--Pilih--</option>
									<option value="1">Laki-laki</option>
									<option value="0">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fullname" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control datepicker" name="birthdate" id="birthdate" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="photo" id="photo" accept="image/png, image/gif, image/jpeg, image/jpg">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button id="submit" type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-edit" enctype="multipart/form-data" class="form">
					<div class="modal-body">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-2 col-form-label">Orang Tua</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="e_id" id="e_id" hidden>
								<select name="e_parent_id" id="e_parent_id" class="form-control" style="width:100%" required>
									<option value="">--Pilih--</option>
									<?php foreach ($parent as $p):?>
										<option value="<?=$p->id?>"><?=$p->fullname;?></option>
									<?php endforeach ;?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="username" class="col-sm-2 col-form-label">Nama Anak</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="e_name" id="e_name" required autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							<label for="fullname" class="col-sm-2 col-form-label">NIK</label>
							<div class="col-sm-10">
								<input type="number" class="form-control" name="e_nik" id="e_nik" required autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							<label for="fullname" class="col-sm-2 col-form-label">KK</label>
							<div class="col-sm-10">
								<input type="number" class="form-control" name="e_kk" id="e_kk" required autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Kelamin</label>
							<div class="col-sm-10">
								<select name="e_gender" id="e_gender" class="form-control" required>
									<option value="">--Pilih--</option>
									<option value="1">Laki-laki</option>
									<option value="0">Perempuan</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="fullname" class="col-sm-2 col-form-label">Tanggal Lahir</label>
							<div class="col-sm-10">
								<input type="text" class="form-control datepicker" name="e_birthdate" id="e_birthdate" required autocomplete="off">
							</div>
						</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
	<div class="modal fade" id="modal-image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-image" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Foto Sekarang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="i_id" id="i_id" hidden>
                                <input type="text" class="form-control" name="i_photo_old" id="i_photo_old" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Foto Baru</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="i_photo" id="i_photo" accept="image/png, image/gif, image/jpeg, image/jpg" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

	<script>
		$(document).ready(function () {

			var tabledata = $('#data-table').DataTable({
				// "responsive" : true,
				"processing": true,
				"ajax": "<?=base_url("dash/child/data")?>",
				"stateSave": true,
				"order": []
			})

			$("form#form-add").submit(function(e) {
				e.preventDefault();    
				var formData = new FormData(this);
				$.ajax({
					url: "<?=base_url('dash/child/create')?>",
					type: 'POST',
					beforeSend :function () {
						swal({
							title: 'Memproses',
							html: 'Memuat Data',
							onOpen: () => {
							swal.showLoading()
							}
						})      
					},
					data: formData,
					success: function (data) {
						tabledata.ajax.reload(null,false);
						swal({
							title: 'Sukses',
							text: 'Data telah ditambahkan!',
							icon: "success",
							timer: 3000,
						})
						$('#modal-add').modal('hide');
						var frm = document.getElementsById('form-add')[0];
						frm.submit(); // Submit the form
						frm.reset();  // Reset all form data
						return false;
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						// console.log(jqXHR, textStatus, errorThrown);
						swal({
							title: 'Gagal',
							text: 'Username telah digunakan!',
							icon: "error",
							timer: 3000,
						})
						$('#modal-add').modal('hide');
					},
					cache: false,
					contentType: false,
					processData: false
				})
				return false;
			});
			
			
			$('#data-table').on('click','.row-edit', function () {
				$.ajax({
					type: "POST",
					url: "<?=base_url('dash/child/get')?>",
					dataType: "JSON",
					beforeSend :function () {
						swal({
							title: 'Memproses',
							html: 'Memuat Data',
							onOpen: () => {
							swal.showLoading()
							}
						})      
						},
					data: {id:$(this).data('id')},
					success: function (data) {
						swal.close();
		
						$('[name="e_id"]').val(data.id);
						$('[name="e_parent_id"]').val(data.parent_id);
						$('[name="e_name"]').val(data.name);
						$('[name="e_nik"]').val(data.nik);
						$('[name="e_kk"]').val(data.kk);
						$('[name="e_gender"]').val(data.gender);
						$('[name="e_birthdate"]').val(data.birthdate);
		
						$('#modal-edit').modal('show');
					}
				});
			});        

			$("form#form-edit").submit(function(e) {
				e.preventDefault();    
				var formData = new FormData(this);
				$.ajax({
					url: "<?=base_url('dash/child/update')?>",
					type: 'POST',
					beforeSend :function () {
						swal({
							title: 'Memproses',
							html: 'Memuat Data',
							onOpen: () => {
							swal.showLoading()
							}
						})      
					},
					data: formData,
					success: function (data) {
						tabledata.ajax.reload(null,false);
						swal({
							title: 'Sukses',
							text: 'Data telah diubah!',
							icon: "success",
							timer: 3000,
						})
						$('#modal-edit').modal('hide');
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						swal({
							title: 'Gagal',
							text: 'Username telah digunakan!',
							icon: "error",
							timer: 3000,
						})
						$('#modal-edit').modal('hide');
					},
					cache: false,
					contentType: false,
					processData: false
				})
				return false;
			});

			$('#data-table').on('click','.row-image', function () {
				$.ajax({
					type: "POST",
					url: "<?=base_url('dash/child/get')?>",
					dataType: "JSON",
					beforeSend :function () {
						swal({
							title: 'Memproses',
							html: 'Memuat Data',
							onOpen: () => {
							swal.showLoading()
							}
						})      
						},
					data: {id:$(this).data('id')},
					success: function (data) {
						swal.close();
		
						$('[name="i_id"]').val(data.id);
						$('[name="i_photo_old"]').val(data.photo);
		
						$('#modal-image').modal('show');
					}
				});
			});

			$("form#form-image").submit(function(e) {
				e.preventDefault();    
				var formData = new FormData(this);
			
				$.ajax({
					url: "<?=base_url('dash/child/update_image')?>",
					type: 'POST',
					beforeSend :function () {
						swal({
							title: 'Memproses',
							html: 'Memuat Data',
							onOpen: () => {
							swal.showLoading()
							}
						})      
					},
					data: formData,
					success: function (data) {
						tabledata.ajax.reload(null,false);
						swal({
							title: 'Sukses',
							text: 'Foto telah diubah!',
							icon: "success",
							timer: 3000,
						})
			
						$('#modal-image').modal('hide');
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						swal({
							title: 'Gagal',
							text: errorThrown,
							icon: "error",
							timer: 3000,
						})
			
						$('#modal-image').modal('hide');
					},
					cache: false,
					contentType: false,
					processData: false
				})
				return false;
			});
			
			$('#data-table').on('click','.row-delete', function () {
				var id =  $(this).data('id');
				swal({
					title: 'Apa anda yakin?',
					text: "Setelah dihapus, data tidak dapat dikembalikan!! ",
					icon: 'warning',
					buttons: {
						cancel: "Batal",
						catch: {
							text: "OK",
							value: "catch",
						},
					}
				}).then((value) => {
					switch (value) {
						case "catch":
						$.ajax({
							url:"<?=base_url('dash/child/delete')?>",  
							method:"POST",
							beforeSend :function () {
							swal({
								title: 'Memproses',
								html: 'Memuat Data',
									onOpen: () => {
									swal.showLoading()
									}
								})      
							},    
							data:{id:id},
							dataType: "JSON",
							success:function(data){
								swal({
									title: 'Sukses',
									text: 'Data telah dihapus!',
									icon: "success",
									timer: 3000,
								})
								tabledata.ajax.reload(null, false)
							}
						})
						break;

						default:
							swal({
								title: 'Dibatalkan',
								text: 'Tidak ada perubahan!',
								icon: "info",
								timer: 3000,
							});
					}
				})
			});
		});
	</script>


</body>
</html>
