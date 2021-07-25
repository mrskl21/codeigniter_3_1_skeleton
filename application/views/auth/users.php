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
                                                        <th>Fullname</th>
                                                        <th>Username</th>
                                                        <th>Role</th>
                                                        <th>Email</th>
                                                        <th>Status</th>
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
        <div class="modal-dialog modal-lg" role="document">
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
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Fullname</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="fullname" id="fullname" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="email" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" id="username" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" id="password" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Re-enter Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="passwordConfirm" id="passwordConfirm" autocomplete="off" required>
                                <small class="ml-2" id='message'></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select name="roles_id" id="roles_id" class="form-control">
                                    <?php foreach ($roles as $r):?>
                                        <option value="<?=$r->id?>"><?=$r->title;?></option>
                                    <?php endforeach ;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="submit" type="submit" name="submit" class="btn btn-primary">Submit</button>
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
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Fullname</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="e_id" id="e_id" hidden>
                                <input type="text" class="form-control" name="e_fullname" id="e_fullname" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="e_email" id="e_email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="e_username_current" id="e_username_current" hidden>
                                <input type="text" class="form-control" name="e_username" id="e_username" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select name="e_roles_id" id="e_roles_id" class="form-control">
                                    <?php foreach ($roles as $r):?>
                                        <option value="<?=$r->id?>"><?=$r->title;?></option>
                                    <?php endforeach ;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select name="e_status" id="e_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
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
    <div class="modal fade" id="modal-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-password" enctype="multipart/form-data" class="form">
                    <div class="modal-body">    
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="p_id" id="p_id" hidden>
                                <input type="password" class="form-control" name="p_password" id="p_password" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Re-enter Password</label>
                            <div class="col-sm-10">
                                <input type="password"  class="form-control" name="p_passwordConfirm" id="p_passwordConfirm" autocomplete="off" required>
                                <small class="ml-2" id='p_message'></small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="p_submit" type="submit" name="p_submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('form').validate();
        $('#password, #passwordConfirm').on('keyup', function() {
            if ($('#password').val() == $('#passwordConfirm').val()) {
                console.log('match');
                $('#message').html('Cocok').css('color', 'green');
                $('#submit').prop('disabled', false);
            } else {
                console.log('nope');
                $('#message').html('Tidak Cocok').css('color', 'red');
                $('#submit').prop('disabled', true);
            }
        });
        $('#p_password, #p_passwordConfirm').on('keyup', function() {
            if ($('#p_password').val() == $('#p_passwordConfirm').val()) {
                $('#p_message').html('Cocok').css('color', 'green');
                $('#p_submit').prop('disabled', false);
            } else {
                $('#p_message').html('Tidak Cocok').css('color', 'red');
                $('#p_submit').prop('disabled', true);
            }
        });
    </script>


    <script>
        $(document).ready(function () {

            var tabledata = $('#data-table').DataTable({
                "processing": true,
                "ajax": "<?=base_url("auth/users/data")?>",
                stateSave: true,
                "order": []
            })

            $("form#form-add").submit(function(e) {
                e.preventDefault();    
                var formData = new FormData(this);
                $.ajax({
                    url: "<?=base_url('auth/users/create')?>",
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
                    url: "<?=base_url('auth/users/get')?>",
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
                        $('[name="e_fullname"]').val(data.fullname);
                        $('[name="e_username_current"]').val(data.username);
                        $('[name="e_username"]').val(data.username);
                        $('[name="e_email"]').val(data.email);
                        $('[name="e_department_id"]').val(data.department_id);
                        $('[name="e_roles_id"]').val(data.roles_id);
                        $('[name="e_status"]').val(data.status);
        
                        $('#modal-edit').modal('show');
                    }
                });
            });

            $("form#form-edit").submit(function(e) {
                e.preventDefault();    
                var formData = new FormData(this);
                $.ajax({
                    url: "<?=base_url('auth/users/update')?>",
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
                var id =  $(this).data('id');
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
                            url:"<?=base_url('auth/users/delete')?>",  
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
                            data:{id:id},
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
            
            $('#data-table').on('click','.row-password', function () {
                $('[name="p_id"]').val($(this).data('id'));
        
                $('#modal-password').modal('show');
            });

            $("form#form-password").submit(function(e) {
                e.preventDefault();    
                var formData = new FormData(this);
                $.ajax({
                    url: "<?=base_url('auth/users/password_update')?>",
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
                        $('#modal-password').modal('hide');
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal({
                            title: 'Failed',
                            text: 'Failed!',
                            icon: "error",
                            timer: 3000,
                        })
                        $('#modal-password').modal('hide');
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                })
                return false;
            });
        });
    </script>

</body>
</html>