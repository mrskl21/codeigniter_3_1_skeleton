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
                                    <div class="card-header-action">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Tambah Data <i class="fas fa-plus"></i></button type="button">
                                    </div>
                                </div>
                                <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="data-table">
                                                <thead>                                 
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Title</th>
                                                        <th>Description</th>
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
                    </div>
                </section>
            </div>
            
            <?php $this->load->view('part/foot');?>
            
      </div>
  </div>

  <?php $this->load->view('part/script');?>

    <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-add">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" id="title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="description" cols="100" rows="30" class="form-control"></textarea>
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
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-edit">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="e_id" id="e_id" hidden>
                                <input type="text" class="form-control" name="e_title_current" id="e_title_current" hidden>
                                <input type="text" class="form-control" name="e_title" id="e_title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="e_description" id="e_description" cols="100" rows="30" class="form-control"></textarea>
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
            "processing": true,
            "ajax": "<?=base_url("auth/permissions/data")?>",
            stateSave: true,
            "order": []
        })
        
        $('#form-add').on('submit', function () {
            $.ajax({
                type: "POST",
                url: "<?=base_url('auth/permissions/create')?>",
                beforeSend :function () {
                    swal({
                        title: 'Memproses',
                        html: 'Memuat Data',
                        onOpen: () => {
                        swal.showLoading()
                        }
                    })      
                    },
                data: {
                    title       : $('#title').val(),
                    description : $('#description').val()
                },
                dataType: "JSON",
                success: function (data) {
                    tabledata.ajax.reload(null,false);
                    swal({
                        title: 'Sukses',
                        text: 'Data telah ditambahkan!',
                        icon: "success",
                        timer: 3000,
                    })
        
                    $('#modal-add').modal('hide');
                    $('#title').val('');
                    $('#description').val('');
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal({
                        title: 'Gagal',
                        text: 'Duplicated value!',
                        icon: "error",
                        timer: 3000,
                    })
        
                    $('#modal-add').modal('hide');
                }
            })
            return false;
        });
        
        $('#data-table').on('click','.row-edit', function () {
            $.ajax({
                type: "POST",
                url: "<?=base_url('auth/permissions/get')?>",
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
                    $('[name="e_title_current"]').val(data.title);
                    $('[name="e_title"]').val(data.title);
                    $('[name="e_description"]').val(data.description);
      
                    $('#modal-edit').modal('show');
                }
            });
        });
        
        $('#form-edit').on('submit', function () {
    
            $.ajax({
            type: "POST",
            url: "<?=base_url('auth/permissions/update')?>",
            beforeSend :function () {
				swal({
					title: 'Memproses',
					html: 'Memuat Data',
                    onOpen: () => {
                    swal.showLoading()
                    }
                })      
            },
            data: {
                id              : $('#e_id').val(),
                title_current   : $('#e_title_current').val(),
                title           : $('#e_title').val(),
                description     : $('#e_description').val()
            },
            dataType: "JSON",
            success: function (data) {
                tabledata.ajax.reload(null,false);
                swal({
					title: 'Sukses',
					text: 'Data telah diubah!',
                    icon: "success",
                    timer: 3000
                })
                $('#modal-edit').modal('hide');
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
				swal({
					title: 'Gagal',
					text: 'Duplicated value!',
                    icon: "error",
                    timer: 3000,
                })
    
                $('#modal-edit').modal('hide');
            }
            })
            return false;
        });
        
        $('#data-table').on('click','.row-delete', function () {
            swal({
                title: 'Apa anda yakin?',
                text: "Setelah dihapus, data tidak dapat dikembalikan!! ",
                icon: 'warning',
                buttons: {
                    cancel: "Cancel",
                    catch: {
                        text: "OK",
                        value: "catch",
                    },
                }
            }).then((value) => {
                switch (value) {
                    case "catch":
                    $.ajax({
                        url:"<?=base_url('auth/permissions/delete')?>",  
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
                        data:{id:$(this).data('id')},
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
<?php $this->load->view('part/alert');?>


</body>
</html>
