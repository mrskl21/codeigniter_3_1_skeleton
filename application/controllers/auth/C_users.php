<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_users extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }

        if(!in_array("auth-users", $this->session->userdata['logged_in']['permissions'])){
            $this->session->set_flashdata('error',"Maaf! Anda tidak punya akses.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        $this->load->model('auth/table_users');
        $this->load->model('auth/table_roles');
    }

    public function index()
    {
        

        $title['display']   = "Users";
        $title['parent']    = "Users";
        $title['level'][0]  = "Auth";
        $title['href'][0]   = "";
        $title['level'][1]  = "Users";
        $title['href'][1]   = "";

        $roles              = $this->table_roles->all();

        $this->load->view(
            'auth/users',
            compact(
                'title',
                'roles'
            )
        );
    }

    public function data()
    {
        $users = $this->table_users->all();
        $no = 1;
        foreach ($users as $d) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $d->fullname;
            $tbody[] = $d->username;
            $tbody[] = $d->roles_title;
            $tbody[] = $d->email;
            if($d->status == 0):
                $tbody[] = '<div class="badge badge-warning">Inactive</div>';
            else:
                $tbody[] = '<div class="badge badge-success">Active</div>';
            endif;
            $aksi = "<button class='btn btn-primary row-edit' data-toggle='modal' data-id=".$d->id."><i class='fas fa-pen mr-2'></i> Update</button>";
            $aksi .= " <button class='btn btn-warning row-password' data-toggle='modal' data-id=".$d->id."><i class='fas fa-key mr-2'></i> Password</button>";
            $aksi .= " <button class='btn btn-danger row-delete' id='id' data-toggle='modal' data-id=".$d->id."><i class='fas fa-times mr-2'></i> Delete</button>";
            $tbody[] = $aksi;
            $data[] = $tbody; 
        }

        if ($users) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=>0));
        }
    }

    public function create()
    {
        
        $data['username']  = $this->input->post('username');
        $check             = $this->table_users->check($data);

        if($check == false)
        {

            $data['fullname']   = $this->input->post('fullname');
            $data['password']   = md5($this->input->post('password'));
            $data['roles_id']   = $this->input->post('roles_id');
            $data['email']      = $this->input->post('email');
            $data['status']     = 1;
            $data['created_at'] = time();

            $result = $this->table_users->add($data);
            echo json_encode($result);

        }

    }

    public function get()
    {
        $id['auth_users.id'] = $this->input->post('id');

        $data = $this->table_users->get($id);
        echo json_encode($data);
    }

    public function update()
    {
        
        $username         = $this->input->post('e_username_current');
        $id['id']         = $this->input->post('e_id');
        $data['username'] = $this->input->post('e_username');

        
        if($username != $data['username'])
        {
            $check = $this->table_users->check($data);
        }
        else {
            $check = FALSE;
        }

        if($check == FALSE)
        {
            $data['fullname']       = $this->input->post('e_fullname');
            $data['roles_id']       = $this->input->post('e_role');
            $data['email']          = $this->input->post('e_email');
            $data['roles_id']       = $this->input->post('e_roles_id');
            $data['status']         = $this->input->post('e_status');
    
            $result = $this->table_users->update($id,$data);
            echo json_encode($result);
        }
    }

    public function delete()
    {
        $id['id'] = $this->input->post('id');
        $result = $this->table_users->delete($id);
        echo json_encode($result);
    }

    public function password_update()
    {

        $id['id']        = $this->input->post('p_id');
        $p['password']  = md5($this->input->post('p_password'));
        
        $result = $this->table_users->update($id,$p);        
        echo json_encode($result);

    }

}
