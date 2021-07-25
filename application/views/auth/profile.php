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
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Update Data</h4>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url();?>panel/profile/update" enctype="multipart/form-data" class="form" method="POST">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Fullname</label>
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
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="id" id="id" hidden value="<?=$data->id;?>">
                                                <input type="text" class="form-control" name="username_current" id="username_current" hidden value="<?=$data->username;?>">
                                                <input type="text" class="form-control" name="username" id="username" required value="<?=$data->username;?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Department</label>
                                            <div class="col-sm-10">
                                                <select name="department_id" id="department_id" class="form-control select2" style="width: 100%;" disabled>
                                                    <?php foreach ($department as $d):?>
                                                        <option <?=($d->id == $data->department_id)?"selected":"";?> value="<?=$d->id?>"><?=$d->title;?></option>
                                                    <?php endforeach ;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Role</label>
                                            <div class="col-sm-10">
                                                <select name="roles_id" id="roles_id" class="form-control" disabled>
                                                    <?php foreach ($roles as $r):?>
                                                        <option <?=($r->id == $data->roles_id)?"selected":"";?> value="<?=$r->id?>"><?=$r->title;?></option>
                                                    <?php endforeach ;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Update Data</h4>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url();?>panel/profile/update_password" enctype="multipart/form-data" class="form" method="POST">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Current Password</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="id" id="id" hidden value="<?=$data->id;?>">
                                                <input type="password" class="form-control" name="old_password" id="old_password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="password" id="password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Re-enter Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="passwordConfirm" id="passwordConfirm" required>
                                                <small class="ml-2" id='message'></small>
                                            </div>
                                        </div>
                                        <div class="form-group text-right">
                                            <button id="submit" type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            
            <?php $this->load->view('part/foot');?>
            <?php $this->load->view('part/alert');?>
            
        </div>
    </div>

    <?php $this->load->view('part/script');?>
    <script>
        $('form').validate();
        $('#password, #passwordConfirm').on('keyup', function() {
            if ($('#password').val() == $('#passwordConfirm').val()) {
                $('#message').html('Cocok').css('color', 'green');
                $('#submit').prop('disabled', false);
            } else {
                $('#message').html('Tidak Cocok').css('color', 'red');
                $('#submit').prop('disabled', true);
            }
        });
    </script>




</body>
</html>