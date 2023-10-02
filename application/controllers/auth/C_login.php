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
			'auth_users.username' => $username,
			'auth_users.password' => md5($password),
			'auth_users.status' => 1,
        );


		$validate = $this->table_users->login($data);
        if ($validate == TRUE)
        {
            $param['user_id']   = $validate->id;
            $permissions    = $this->table_roles_has_permissions->get_by_id($validate->id);
            $session_data = array(
                'id' 	            => $validate->id,
                'fullname'	        => $validate->fullname,
                'roles_id'	        => $validate->roles_id,
                'photo'	            => $validate->photo,
                'permissions'       => $permissions
            );
            $this->session->set_userdata('logged_in',$session_data);
            $this->session->set_flashdata('success', "Welcome!");

            redirect('home', $session_data);
        }
        else

        {
            $this->session->set_flashdata('error', "Failed! username is not registered or wrong password");
            redirect('login');
        }

    }
    

	public function logout()
	{
		$this->session->sess_destroy();
        $this->session->set_flashdata('success', "Logged out!");
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
            
            $this->session->set_flashdata('success', "Success! Please wait for verification");
            redirect('login');
            
        }else{
            $this->session->set_flashdata('error', "Failed! Username had been used. Please try again");
            redirect('registration');

        }
    }

}

/* End of file Controllername.php */
