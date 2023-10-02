<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_users extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }

        if(!in_array("auth-users", $this->session->userdata['logged_in']['permissions'])){
            $this->session->set_flashdata('error',"Sorry! You don't have access here.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        $this->load->model('auth/table_users');
        $this->load->model('auth/table_roles');

    }

    public function index()
    {
        

        $title['display']   = "Pengguna";
        $title['parent']    = "Pengguna";
        $title['level'][0]  = "Autentifikasi";
        $title['href'][0]   = "";
        $title['level'][1]  = "Pengguna";
        $title['href'][1]   = "";

        $roles              = $this->table_roles->all();

        $this->load->view(
            'auth/users',
            compact(
                'title',
                'roles',
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
            if($d->photo == NULL || $d->photo == ""):
                $tbody[] = '<a href="#" class="font-weight-600"><img src="'.base_url().'assets/img/avatar/avatar-5.png" alt="avatar" width="30" class="rounded-circle mr-1"> '.$d->fullname.'</a>';
            else:
                $tbody[] = '<a href="#" class="font-weight-600"><img src="'.base_url().'assets/uploads/images/users/thumbnail/'.$d->photo.'" alt="avatar" width="30" class="rounded-circle mr-1"> '.$d->fullname.'</a>';
            endif;
            $tbody[] = $d->username;
            $tbody[] = $d->roles_title;
            $tbody[] = $d->email;
            if($d->status == 0):
                $tbody[] = '<div class="badge badge-light">Tidak Aktif</div>';
            else:
                $tbody[] = '<div class="badge badge-success">Aktif</div>';
            endif;
            $aksi = "<button class='btn btn-info row-edit' data-toggle='modal' data-id=".$d->id."><i class='fas fa-pen mr-2'></i> Ubah Data</button>";
            $aksi .= " <button class='btn btn-info row-image' data-toggle='modal' data-id=".$d->id."><i class='fas fa-image mr-2'></i> Ubah Foto</button>";
            $aksi .= " <button class='btn btn-warning row-password' data-toggle='modal' data-id=".$d->id."><i class='fas fa-key mr-2'></i> Password</button>";
            $aksi .= " <button class='btn btn-danger row-delete' id='id' data-toggle='modal' data-id=".$d->id."><i class='fas fa-times mr-2'></i> Hapus</button>";
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
			$config['upload_path'] = './assets/uploads/images/users';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
  
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
  
			if($this->upload->do_upload('photo')){
				$size = $this->upload->data('file_size');
				$name = $this->upload->data('file_name');
				if ($size < 2048) {
				  $this->resizeImage($name);
				  $data['photo']   = $name;
			  }
			}

            $data['fullname']       = $this->input->post('fullname');
            $data['password']       = md5($this->input->post('password'));
            $data['roles_id']       = $this->input->post('roles_id');
            $data['email']          = $this->input->post('email');
            $data['status']         = 1;
            $data['created_at']     = time();

            $result = $this->table_users->add($data);
            echo json_encode($result);

        }else{
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
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
        }else{
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
        }
    }

    public function update_image()
    {
        $config['upload_path'] = './assets/uploads/images/users';
  		$config['allowed_types'] = 'jpg|jpeg|png|gif';

  		$this->load->library('upload', $config);
  		$this->upload->initialize($config);

  		if($this->upload->do_upload('i_photo')){
  			$size = $this->upload->data('file_size');
  			$name = $this->upload->data('file_name');
  			if ($size < 2048) {
                $uploadedImage = $this->upload->data();
                $this->resizeImage($uploadedImage['file_name']);

                $id['id']   	= $this->input->post("i_id");
                $data['photo']	= $name;
                $result = $this->table_users->update($id,$data);

                $photo1 = './assets/uploads/images/users/'.$this->input->post("i_photo_old");
                $photo2 = './assets/uploads/images/users/thumbnail/'.$this->input->post("i_photo_old");

                if(is_file($photo1)){
                    unlink($photo1);
                }
                if(is_file($photo2)){
                    unlink($photo2);
                }
                echo json_encode($result);
            }
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

}
