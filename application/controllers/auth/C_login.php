<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller {

    function __construct(){
        parent::__construct();
        
        $this->load->model('auth/table_users');
        $this->load->model('auth/table_roles_has_permissions');
    }

    public function login()
    {
        if(($this->session->userdata('logged_in'))){
            redirect('home');
		}
        $this->load->view('auth/login');
    }

    public function validate()
	{
		$username   = $this->input->post('username');
        $password   = $this->input->post('password');
		$data = array(
			'username' => $username,
			'password' => md5($password),
			'status' => 1,
        );


		$validate = $this->table_users->login($data);
        if ($validate == TRUE)
        {
            $param['user_id']   = $validate->id;
            $permissions    = $this->table_roles_has_permissions->get_by_id($validate->id);
            $session_data = array(
                'id' 	        => $validate->id,
                'fullname'	    => $validate->fullname,
                'roles_id'	    => $validate->roles_id,
                'photo'	        => $validate->photo,
                'permissions'   => $permissions
            );
            $this->session->set_userdata('logged_in',$session_data);
            $this->session->set_flashdata('success', "Selamat Datang!");

            redirect('home', $session_data);
        }
        else

        {
            $this->session->set_flashdata('error', "Masuk Gagal! anda belum terdaftar atau username/kata sandi anda salah");
            redirect('login');
        }

    }
    

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success mb-2" role="alert" id="flash_message">Logged out!</div>'
		);
    	redirect('login');
	}

    public function registration()
    {
        if(($this->session->userdata('logged_in'))){
            redirect('home');
		}
        $this->load->view('auth/registration');
    }

    public function reg_attemp()
    {
        $data['username']  = $this->input->post('username');
        $check             = $this->table_users->check($data);

        if($check == false)
        {

            $data['fullname']       = $this->input->post('fullname');
            $data['password']       = md5($this->input->post('password'));
            $data['roles_id']       = 2;
            $data['email']          = $this->input->post('email');
            $data['status']         = 0;
            $data['created_at']     = time();

            $this->table_users->add($data);
            
            $this->session->set_flashdata('success', "Berhasil! Mohon tunggu akun teraktivasi");
            redirect('login');
            
        }else{
            $this->session->set_flashdata('error', "Gagal! Username telah terpakai. Mohon coba lagi");
            redirect('registration');

        }
    }

}

/* End of file Controllername.php */
