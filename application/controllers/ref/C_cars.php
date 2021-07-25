<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_users extends CI_Controller {

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
        // if(!in_array("auth-users", $this->session->userdata['logged_in']['permissions'])){
        //     $this->session->set_flashdata('error',"Maaf! Anda tidak punya akses.");
        //     redirect($_SERVER['HTTP_REFERER']);
        // }

        $title['display']   = "Users";
        $title['parent']    = "Users";
        $title['level'][0]  = "Auth";
        $title['href'][0]   = "";
        $title['level'][1]  = "Users";
        $title['href'][1]   = "";

        $data   = $this->table_users->all();

        $this->load->view(
            'auth/users/index',
            compact(
                'title',
                'data'
            )
        );
    }

    public function create()
    {
        // if(!in_array("auth-users", $this->session->userdata['logged_in']['permissions'])){
        //     $this->session->set_flashdata('error',"Maaf! Anda tidak punya akses.");
        //     redirect($_SERVER['HTTP_REFERER']);
        // }
        
        $title['display']   = "Create User";
        $title['parent']    = "Users";
        $title['level'][0]  = "Auth";
        $title['href'][0]   = "";
        $title['level'][1]  = "Users";
        $title['href'][1]   = "auth/users";
        $title['level'][2]  = "Create";
        $title['href'][2]   = "";

        $roles  = $this->table_roles->all();

        $this->load->view(
            'auth/users/create',
            compact(
                'title',
                'roles'
            )
        );
    }

    public function add()
    {
        
        // if(!in_array("auth-users", $this->session->userdata['logged_in']['permissions'])){
        //     $this->session->set_flashdata('error',"Maaf! Anda tidak punya akses.");
        //     redirect($_SERVER['HTTP_REFERER']);
        // }
        
        $data['username']  = $this->input->post('username');
        $check             = $this->table_users->check($data);

        if($check == false)
        {

            $data['fullname']   = $this->input->post('fullname');
            $data['password']   = md5($this->input->post('password'));
            $data['roles_id']   = $this->input->post('role');
            $data['email']      = $this->input->post('email');
            $data['status']     = 1;
            $data['created_at'] = time();

            $this->table_users->add($data);

            $this->session->set_flashdata('success',"Berhasil! Data berhasil ditambahkan.");
            redirect("auth/users");
        }
        else{
            $this->session->set_flashdata('error',"Gagal! username sudah terpakai.");
            redirect("auth/users/create");
        }

    }

    public function detail($id)
    {
        // if(!in_array("auth-users", $this->session->userdata['logged_in']['permissions'])){
        //     $this->session->set_flashdata('error',"Maaf! Anda tidak punya akses.");
        //     redirect($_SERVER['HTTP_REFERER']);
        // }
        $param['auth_users.id'] = $id;
        $param2['user_id'] = $id;
        
        $title['display']   = "Detail User";
        $title['parent']    = "Users";
        $title['level'][0]  = "Auth";
        $title['href'][0]   = "";
        $title['level'][1]  = "Users";
        $title['href'][1]   = "auth/users";
        $title['level'][2]  = "Detail";
        $title['href'][2]   = "";

        $roles          = $this->table_roles->all();
        $data           = $this->table_users->get($param);

        $this->session->set_flashdata('success',"Berhasil! Password berhasil diubah.");

        $this->load->view(
            'auth/users/edit',
            compact(
                'title',
                'roles',
                'data',
                'witel',
                'point',
                'history'
            )
        );
    }

    public function update()
    {
        // if(!in_array("auth-users", $this->session->userdata['logged_in']['permissions'])){
        //     $this->session->set_flashdata('error',"Maaf! Anda tidak punya akses.");
        //     redirect($_SERVER['HTTP_REFERER']);
        // }
        
        $username         = $this->input->post('username_before');
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
            $data['roles_id']   = $this->input->post('role');
            $data['email']      = $this->input->post('email');
            $data['roles_id']   = $this->input->post('role');
            $data['status']     = $this->input->post('status');
    
            $this->table_users->update($id,$data);

            $this->session->set_flashdata('success',"Berhasil! Data berhasil diubah.");
            redirect("auth/users/detail/".$id['id']);
        }
        else{
            $this->session->set_flashdata('error',"Gagal! username sudah terpakai.");
            redirect("auth/users/detail/".$id['id']);
        }
    }

    public function password()
    {

        $id['id']        = $this->input->post('id2');
        $p['password']  = md5($this->input->post('password'));
        $this->table_users->update($id,$p);
        
        $this->session->set_flashdata('success',"Berhasil! Password berhasil diubah.");
        redirect("auth/users/detail/".$id['id']);

    }

    public function profile()
    {
        $title  = "Profil";
        $id['users.id']     = $this->session->userdata['logged_in']['id'];
        $roles  = $this->table_roles->all();
        $witel  = $this->table_ref_witel->all();
        $data   = $this->table_users->get($id);

        $id2['user_id'] = $this->session->userdata['logged_in']['id'];
        $point          = $this->table_users_has_point->get_row($id2);
        $history        = $this->table_users_point_history->get_result($id2);

        $this->load->view(
            'auth/users/profile',
            compact(
                'title',
                'roles',
                'data',
                'witel',
                'point',
                'history'
            )
        );
    }

    

    public function update_profile()
    {
        $username         = $this->input->post('username_before');
        $id['id']         = $this->session->userdata['logged_in']['id'];
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
            $data['fullname'] = $this->input->post('fullname');
            $data['nip']      = $this->input->post('nip');
            $data['email']    = $this->input->post('email');
    
            $this->table_users->update($id,$data);

            $this->session->set_flashdata('success',"Berhasil! Data berhasil diubah.");
            redirect("auth/users/profile");
        }
        else{
            $this->session->set_flashdata('error',"Gagal! username sudah terpakai.");
            redirect("auth/users/profile");
        }
    }

    public function update_password()
    {
        $id         = $this->session->userdata['logged_in']['id'];
        $old_pass   = $this->input->post('password_before');

        $data = array(
			'id' => $id,
			'password' => md5($old_pass)
        );

        $validate = $this->table_users->login($data);
        if ($validate == TRUE)
        {
            $i['id']        = $id;
            $p['password']  = md5($this->input->post('password'));
            $this->table_users->update($i,$p);

            $this->session->set_flashdata('success',"Berhasil! Password berhasil diubah.");
            redirect("auth/users/profile");
        }
        else
        {
            $this->session->set_flashdata('error',"Gagal! password lama anda salah.");
            redirect("auth/users/profile");
        }

    }

    public function delete()
    {
        $param['id'] = $this->input->post('id4');
        $param2['user_id'] = $this->input->post('id4');

        $this->table_users->delete($param);
        $this->table_users_has_upb->delete($param2);

        $this->session->set_flashdata('warning',"Berhasil! Data berhasil dihapus.");
        redirect("auth/users");
    }

}
