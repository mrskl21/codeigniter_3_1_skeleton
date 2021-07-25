<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_profile extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }
        
        $this->load->model('auth/table_users');
        $this->load->model('auth/table_roles');
    }

    public function index()
    {
        

        $title['display']   = "Profile";
        $title['parent']    = "";
        $title['level'][0]  = "Auth";
        $title['href'][0]   = "";
        $title['level'][1]  = "Profile";
        $title['href'][1]   = "";

        $param['auth_users.id']  = $this->session->userdata['logged_in']['id'];
        $data               = $this->table_users->get($param);

        $roles              = $this->table_roles->all();
        $department         = $this->table_department->all();

        $this->load->view(
            'auth/profile',
            compact(
                'title',
                'data',
                'roles',
                'department'
            )
        );
    }

    public function update()
    {
        
        $username         = $this->input->post('username_current');
        $id['id']         = $this->input->post('id');
        $data['username'] = $this->input->post('username');

        
        if($username != $data['username'])
        {
            $check = $this->table_users->check($data);
        }
        else {
            $check = FALSE;
        }

        if($check == FALSE)
        {
            $data['fullname']   = $this->input->post('fullname');
            $data['email']      = $this->input->post('email');
    
            $this->table_users->update($id,$data);
            $this->session->set_flashdata('success', "Berhasil! Data telah diubah.");
            redirect("profile");
        }else{
            $this->session->set_flashdata('error', "Gagal! Username baru sudah terpakai.");
            redirect("profile");
        }
    }

    public function update_password()
    {

        $data['id']        = $this->input->post('id');
        $data['password']  = md5($this->input->post('old_password'));
        $check = $this->table_users->check($data);
        
        if($check == TRUE){
            $id['id']        = $this->input->post('id');
            $param['password']  = md5($this->input->post('password'));
            $this->table_users->update($id,$param);        
            $this->session->set_flashdata('success', "Berhasil! Password telah diubah.");
            redirect("profile");
        }else{
            $this->session->set_flashdata('error', "Gagal! Password lama Salah.");
            redirect("profile");
        }
        
    }

}
