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
                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Data Anak</h4>
									<?php if(in_array("data-worker", $this->session->userdata['logged_in']['permissions'])):?>
									<div class="card-header-action dropdown">
										<a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Menu</a>
										<ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
										  <li class="dropdown-title">Pilih Menu</li>
										  <li><a href="#" data-toggle="modal" data-target="#modal-edit" class="dropdown-item">Ubah Data</a></li>
										  <li><a href="#" data-toggle="modal" data-target="#modal-image" class="dropdown-item">Ubah Foto</a></li>
										  <li><a href="#" data-toggle="modal" data-target="#modal-delete" class="dropdown-item">Hapus</a></li>
										</ul>
									</div>
									<?php endif; ?>
                                </div>
                                <div class="card-body table-responsive">
									<table class="table table-sm table-striped">
										<tbody>
											<tr>
												<td width="30%">Nama Orang Tua</td>
												<td width="5%">:</td>
												<th width="65%"><?=$data->parent_name;?></th>
											</tr>
											<tr>
												<td width="30%">Nama Anak</td>
												<td width="5%">:</td>
												<th width="65%"><?=$data->name;?></th>
											</tr>
											<tr>
												<td width="30%">Jenis Kelamin</td>
												<td width="5%">:</td>
												<th width="65%">
													<?php if($data->gender == 0):?>
														<span class="badge badge-danger"><i class="fas fa-venus"></i> Perempuan</span>
													<?php else:?>
														<span class="badge badge-info"><i class="fas fa-mars"></i> Laki-laki</span>
													<?php endif;?>
												</th>
											</tr>
											<tr>
												<td width="30%">Tanggal Lahir</td>
												<td width="5%">:</td>
												<th width="65%"><?=$data->birthdate;?></th>
											</tr>
											<tr>
												<td width="30%">Umur</td>
												<td width="5%">:</td>
												<th width="65%">
													<?php 
														$date1 = $data->birthdate;
														$date2 = date("Y-m-d");
														$diff = abs(strtotime($date2)-strtotime($date1));
														$years = floor($diff / (365*60*60*24));
														$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
														$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
														
														echo $years.' Tahun, ';
														echo $months.' Bulan, ';
														echo $days.' Hari';
													?>
												</th>
											</tr>
											<tr>
												<td width="30%">NIK</td>
												<td width="5%">:</td>
												<th width="65%"><?=$data->nik;?></th>
											</tr>
											<tr>
												<td width="30%">No. KK</td>
												<td width="5%">:</td>
												<th width="65%"><?=$data->kk;?></th>
											</tr>
											<tr>
												<td width="30%">Foto</td>
												<td width="5%">:</td>
												<th width="65%">
													<img src="<?=base_url();?>assets/uploads/images/child/<?=$data->photo;?>" width="100%" alt="">
												</th>
											</tr>
										</tbody>
									</table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Rekam Medis</h4>
									<?php if(in_array("data-worker", $this->session->userdata['logged_in']['permissions'])):?>
                                    <div class="card-header-action">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Tambah Rekam Medis <i class="fas fa-plus"></i></button type="button">
                                    </div>
									<?php endif; ?>
                                </div>
                                <div class="card-body table-responsive">
									<table class="table table-striped" id="data-table">
										<thead>                                 
											<tr>
												<th>#</th>
												<th>Tanggal/Waktu</th>
												<th>Usia Saat Rekam</th>
												<th>Dokumen</th>
												<th>Nama Petugas</th>
												<th>Nama Anak</th>
												<th>Catatan</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1; foreach($medical_record as $md):?>
											<tr>
												<td><?=$no++;?></td>
												<td><?=date("j M Y H:i:s",$md->datetime);?> WITA</td>
												<td>
													<?php 
														$date1 = $data->birthdate;
														$date2 = date("Y-m-d",$md->datetime);
														$diff = abs(strtotime($date2)-strtotime($date1));
														$years = floor($diff / (365*60*60*24));
														$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
														$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
														
														echo $years.' Tahun, ';
														echo $months.' Bulan, ';
														echo $days.' Hari';
													?>	
												</td>
												<td>
													<div class="gallery gallery-md">
														<div class="gallery-item" data-image="<?=base_url();?>assets/uploads/images/medical/<?=$md->photo;?>" data-title="Image 1"></div>
													</div>
												</td>
												<td><?=$md->worker_name;?></td>
												<td><?=$md->child_name;?></td>
												<td><?=$md->note;?></td>
											</tr>
											<?php $no++; endforeach;?>
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

	<?php if(in_array("data-worker", $this->session->userdata['logged_in']['permissions'])):?>

    <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url();?>dash/child/medical_record/create" method="POST" enctype="multipart/form-data" class="form">
                    <div class="modal-body">
						<div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Petugas</label>
                            <div class="col-sm-10">
								<input type="text" class="form-control" name="worker_id" id="worker_id" hidden value="<?=$this->session->userdata['logged_in']['id'];?>">
								<input type="text" class="form-control" name="worker_name" id="worker_name" disabled value="<?=$this->session->userdata['logged_in']['fullname'];?>">
                            </div>
                        </div>
						<div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Anak</label>
                            <div class="col-sm-10">
								<input type="text" class="form-control" name="child_id" id="child_id" hidden value="<?=$data->id;?>">
								<input type="text" class="form-control" name="child_name" id="child_name" disabled value="<?=$data->name;?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Catatan Rekam Medis</label>
                            <div class="col-sm-10">
								<textarea name="note" id="note" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="col-sm-2 col-form-label">Foto Dokumen</label>
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
                <form action="<?=base_url();?>dash/child/update" method="POST" enctype="multipart/form-data" class="form">
					<div class="modal-body">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-2 col-form-label">Orang Tua</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="e_id" id="e_id" hidden value="<?=$data->id;?>">
								<select name="e_parent_id" id="e_parent_id" class="form-control" style="width:100%" required>
									<option value="">--Pilih--</option>
									<?php foreach ($parent as $p):?>
										<option <?=($data->parent_id == $p->id)?"selected":""?> value="<?=$p->id?>"><?=$p->fullname;?></option>
									<?php endforeach ;?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="username" class="col-sm-2 col-form-label">Nama Anak</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="e_name" id="e_name" required autocomplete="off" value="<?=$data->name;?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="fullname" class="col-sm-2 col-form-label">NIK</label>
							<div class="col-sm-10">
								<input type="number" class="form-control" name="e_nik" id="e_nik" required autocomplete="off" value="<?=$data->nik;?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="fullname" class="col-sm-2 col-form-label">KK</label>
							<div class="col-sm-10">
								<input type="number" class="form-control" name="e_kk" id="e_kk" required autocomplete="off" value="<?=$data->kk;?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Kelamin</label>
							<div class="col-sm-10">
								<select name="e_gender" id="e_gender" class="form-control" required>
									<option value="">--Pilih--</option>
									<option <?=($data->gender == "1")?"selected":""?> value="1">Laki-laki</option>
									<option <?=($data->gender == "0")?"selected":""?> value="0">Perempuan</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="fullname" class="col-sm-2 col-form-label">Tanggal Lahir</label>
							<div class="col-sm-10">
								<input type="text" class="form-control datepicker" name="e_birthdate" id="e_birthdate" required autocomplete="off" value="<?=$data->birthdate;?>">
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
                <form action="<?=base_url();?>dash/child/update_image" method="POST" enctype="multipart/form-data" class="form">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Foto Sekarang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="i_id" id="i_id" hidden value="<?=$data->id;?>">
                                <input type="text" class="form-control" name="i_photo_old" id="i_photo_old" readonly value="<?=$data->photo;?>">
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
	
	<?php endif; ?>

	<script>
		$(document).ready(function () {
			var tabledata = $('#data-table').DataTable({
				"responsive" : true
			})
		});
	</script>


</body>
</html>
