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
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-add">Create <i class="fas fa-plus"></i></button type="button">
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
                                                        <th>Action</th>
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
    <?php $this->load->view('part/alert');?>

    <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-add" enctype="multipart/form-data" class="form">
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-edit" enctype="multipart/form-data" class="form">
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
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
            
            $("form#form-add").submit(function(e) {
                e.preventDefault();    
                var formData = new FormData(this);
                $.ajax({
                    url: "<?=base_url('auth/permissions/create')?>",
                    type: 'POST',
                    beforeSend :function () {
                        swal({
                            title: 'Waiting',
                            html: 'Processing data',
                            onOpen: () => {
                            swal.showLoading()
                            }
                        })      
                    },
                    data: formData,
                    success: function (data) {
                        tabledata.ajax.reload(null,false);
                        swal({
                            title: 'Succeed',
                            text: 'Data had been added!',
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
                            title: 'Failed',
                            text: 'Duplicated value!',
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
                    url: "<?=base_url('auth/permissions/get')?>",
                    dataType: "JSON",
                    beforeSend :function () {
                        swal({
                                title: 'Waiting',
                                html: 'Processing data',
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
            
            $("form#form-edit").submit(function(e) {
                e.preventDefault();    
                var formData = new FormData(this);
                $.ajax({
                    url: "<?=base_url('auth/permissions/update')?>",
                    type: 'POST',
                    beforeSend :function () {
                        swal({
                            title: 'Waiting',
                            html: 'Processing data',
                            onOpen: () => {
                            swal.showLoading()
                            }
                        })      
                    },
                    data: formData,
                    success: function (data) {
                        tabledata.ajax.reload(null,false);
                        swal({
                            title: 'Succeed',
                            text: 'Data had been added!',
                            icon: "success",
                            timer: 3000,
                        })
                        $('#modal-edit').modal('hide');
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal({
                            title: 'Failed',
                            text: 'Duplicated value!',
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
            
            $('#data-table').on('click','.row-delete', function () {
                swal({
                    title: 'Are you sure?',
                    text: "Once deleted, you will not be able to recover this imaginary file! ",
                    icon: 'warning',
                    buttons: {
                        cancel: "Cancel",
                        catch: {
                            text: "Submit",
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
                            title: 'Waiting',
                            html: 'Processing data',
                                    onOpen: () => {
                                    swal.showLoading()
                                    }
                                })      
                            },    
                            data:{id:$(this).data('id')},
                            dataType: "JSON",
                            success:function(data){
                                swal({
                                    title: 'Succeed',
                                    text: 'Data had been deleted!',
                                    icon: "success",
                                    timer: 3000,
                                })
                                tabledata.ajax.reload(null, false)
                            }
                        })
                        break;

                        default:
                            swal({
                                title: 'Cancelled',
                                text: 'Change are not saved!',
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