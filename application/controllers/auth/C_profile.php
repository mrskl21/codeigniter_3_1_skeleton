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
        

        $title['display']   = "Profil";
        $title['parent']    = "";
        $title['level'][0]  = "Autentifikasi";
        $title['href'][0]   = "";
        $title['level'][1]  = "Profil";
        $title['href'][1]   = "";

        $param['auth_users.id'] = $this->session->userdata['logged_in']['id'];
        $data               	= $this->table_users->get($param);
        $roles              	= $this->table_roles->all();

        $this->load->view(
            'auth/profile',
            compact(
                'title',
                'data',
                'roles',
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
			$this->set_session($data['fullname'],NULL);
            $this->session->set_flashdata('success', "Data telah diubah");
            redirect("profile");
        }else{
            $this->session->set_flashdata('error', "Username telah digunakan!");
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
            $this->session->set_flashdata('success', "Password telah diubah");
            redirect("profile");
        }else{
            $this->session->set_flashdata('error', "Password awal salah!");
            redirect("profile");
        }
        
    }

	
    public function update_image()
    {
        $config['upload_path'] = './assets/uploads/images/users';
  		$config['allowed_types'] = 'jpg|jpeg|png|gif';

  		$this->load->library('upload', $config);
  		$this->upload->initialize($config);

  		if($this->upload->do_upload('photo')){
  			$size = $this->upload->data('file_size');
  			$name = $this->upload->data('file_name');
  			if ($size < 2048) {
                $uploadedImage = $this->upload->data();
                $this->resizeImage($uploadedImage['file_name']);

                $id['id']   	= $this->input->post("id");
                $data['photo']	= $name;
                $this->table_users->update($id,$data);
                $this->set_session(NULL, $name);


                $photo1 = './assets/uploads/images/users/'.$this->input->post("photo_old");
                $photo2 = './assets/uploads/images/users/thumbnail/'.$this->input->post("photo_old");

                if(is_file($photo1)){
                    unlink($photo1);
                }
                if(is_file($photo2)){
                    unlink($photo2);
                }
				$this->session->set_flashdata('success', "Foto telah diubah");
                redirect('profile');
            }else{
				$this->session->set_flashdata('error', "Foto terlalu besar, max 2MB!");
                redirect('profile');
			}
  		}else{
			$this->session->set_flashdata('error', "Terjadi Kesalahan!");
			redirect('profile');
		}
    }

	public function resizeImage($filename)
    {
       $source_path = './assets/uploads/images/users/' . $filename;
       $target_path = './assets/uploads/images/users/thumbnail';
       $config_manip = array(
           'image_library' => 'gd2',
           'source_image' => $source_path,
           'new_image' => $target_path,
           'contenttain_ratio' => TRUE,
           'create_thumb' => TRUE,
           'thumb_marker' => '',
           'width' => 150,
           'height' => 150
       );
 
 
       $this->load->library('image_lib', $config_manip);
       if (!$this->image_lib->resize()) {
           echo $this->image_lib->display_errors();
       }
 
 
       $this->image_lib->clear();
    }

	private function set_session($fullname,$photo)
	{

		if($fullname){
			$data['fullname']		= $fullname;
		}else{
			$data['fullname']		= $this->session->userdata['logged_in']['fullname'];
		}

		if($photo){
			$data['photo']		= $photo;
		}else{
			$data['photo']		= $this->session->userdata['logged_in']['photo'];
		}		
		
		$data['id']				= $this->session->userdata['logged_in']['id'];
		$data['roles_id']		= $this->session->userdata['logged_in']['roles_id'];
		$data['permissions']	= $this->session->userdata['logged_in']['permissions'];
		
		$this->session->set_userdata('logged_in', $data);
	}
}
