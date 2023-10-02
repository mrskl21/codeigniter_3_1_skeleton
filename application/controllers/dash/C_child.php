<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_child extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }

        if(!(in_array("data-worker", $this->session->userdata['logged_in']['permissions']) || in_array("data-parent", $this->session->userdata['logged_in']['permissions']))){
            $this->session->set_flashdata('error',"Sorry! You don't have access here.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        $this->load->model('auth/table_roles');
        $this->load->model('auth/table_users');
        $this->load->model('data/table_child');
        $this->load->model('data/table_medical');

    }

    public function index()
    {
        $title['display']   = "Data Anak";
        $title['parent']    = "Data Anak";
        $title['level'][0]  = "Utama";
        $title['href'][0]   = "";
        $title['level'][1]  = "Data Anak";
        $title['href'][1]   = "";

		$param['auth_users.roles_id']	= "3";
        $parent              = $this->table_users->result($param);

        $this->load->view(
            'dash/child',
            compact(
                'title',
                'parent',
            )
        );
    }

    public function data()
    {
		if(in_array("data-worker", $this->session->userdata['logged_in']['permissions'])){
			$child = $this->table_child->all();
		}elseif(in_array("data-parent", $this->session->userdata['logged_in']['permissions'])){
			$param['data_child.parent_id'] = $this->session->userdata['logged_in']['id'];
			$child = $this->table_child->result($param);
		}

        $no = 1;
        foreach ($child as $d) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $d->parent_name;
            if($d->photo == NULL || $d->photo == ""):
                $tbody[] = '<a href="#" class="font-weight-600"><img src="'.base_url().'assets/img/avatar/avatar-5.png" alt="avatar" width="30" class="rounded-circle mr-1"> '.$d->name.'</a>';
            else:
                $tbody[] = '<a href="#" class="font-weight-600"><img src="'.base_url().'assets/uploads/images/child/thumbnail/'.$d->photo.'" alt="avatar" width="30" class="rounded-circle mr-1"> '.$d->name.'</a>';
            endif;
            if($d->gender == 0):
                $tbody[] = '<span class="badge badge-danger"><i class="fas fa-venus"></i> Perempuan</span>';
            else:
                $tbody[] = '<span class="badge badge-info"><i class="fas fa-mars"></i> Laki-laki</span>';
            endif;
            $tbody[] = $d->birthdate;

			$date1 = $d->birthdate;
			$date2 = date("Y-m-d");
			$diff = abs(strtotime($date2)-strtotime($date1));
			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
			$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
			
            $tbody[] = $years.' Tahun, '.$months.' Bulan, '.$days.' Hari';
            $tbody[] = $d->nik;
            $tbody[] = $d->kk;
            // $aksi = "<button class='btn btn-info row-edit' data-toggle='modal' data-id=".$d->id."><i class='fas fa-pen mr-2'></i> Ubah Data</button>";
            // $aksi .= " <button class='btn btn-info row-image' data-toggle='modal' data-id=".$d->id."><i class='fas fa-image mr-2'></i> Ubah Foto</button>";
            // $aksi .= " <button class='btn btn-danger row-delete' id='id' data-toggle='modal' data-id=".$d->id."><i class='fas fa-times mr-2'></i> Hapus</button>";
            $aksi = " <a class='btn btn-warning' href=".base_url()."dash/child/medical_record/".$d->id."><i class='fas fa-arrow-right mr-2'></i> Rekam Medis</a>";
            $tbody[] = $aksi;
            $data[] = $tbody; 
        }

        if ($child) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=>0));
        }
    }

    public function create()
    {

		$config['upload_path'] = './assets/uploads/images/child';
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

		$data['name']		= $this->input->post('name');
		$data['parent_id']	= $this->input->post('parent_id');
		$data['nik']		= $this->input->post('nik');
		$data['kk']			= $this->input->post('kk');
		$data['gender']		= $this->input->post('gender');
		$data['birthdate']	= $this->input->post('birthdate');

		$result = $this->table_child->add($data);
		echo json_encode($result);

    }

    public function get()
    {
        $id['data_child.id'] = $this->input->post('id');

        $data = $this->table_child->get($id);
        echo json_encode($data);
    }

    public function update()
    {
        
        $id['id']         = $this->input->post('e_id');

		$data['name']		= $this->input->post('e_name');
		$data['parent_id']	= $this->input->post('e_parent_id');
		$data['nik']		= $this->input->post('e_nik');
		$data['kk']			= $this->input->post('e_kk');
		$data['gender']		= $this->input->post('e_gender');
		$data['birthdate']	= $this->input->post('e_birthdate');

		$result = $this->table_child->update($id,$data);
		$this->session->set_flashdata('success', "Data Anak telah diubah");
		redirect("dash/child/medical_record/".$id['id']);
    }

    public function update_image()
    {
        $config['upload_path'] = './assets/uploads/images/child';
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
                $result = $this->table_child->update($id,$data);

                $photo1 = './assets/uploads/images/child/'.$this->input->post("i_photo_old");
                $photo2 = './assets/uploads/images/child/thumbnail/'.$this->input->post("i_photo_old");

                if(is_file($photo1)){
                    unlink($photo1);
                }
                if(is_file($photo2)){
                    unlink($photo2);
                }
				$this->session->set_flashdata('success', "Foto Anak telah diubah");
				redirect("dash/child/medical_record/".$id['id']);
                
            }
  		}
    }

    public function delete()
    {
        $id['id'] = $this->input->post('id');
        $result = $this->table_child->delete($id);
        // echo json_encode($result);
		
		$this->session->set_flashdata('success', "Data Anak telah dihapus");
		redirect("dash/child/");
    }

	public function resizeImage($filename)
    {
       $source_path = './assets/uploads/images/child/' . $filename;
       $target_path = './assets/uploads/images/child/thumbnail';
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

    public function medical_record($id)
    {
        $param['data_child.id'] = $id;
        $data = $this->table_child->get($param);

		$param2['data_medical.child_id'] = $id;
		$medical_record = $this->table_medical->result($param2);

		$title['display']   = $data->name;
        $title['parent']    = "Data Anak";
        $title['level'][0]  = "Utama";
        $title['href'][0]   = "";
        $title['level'][1]  = "Data Anak";
        $title['href'][1]   = "/dash/child";
        $title['level'][2]  = $data->name;
        $title['href'][2]   = "";

		$param3['auth_users.roles_id']	= "3";
        $parent              = $this->table_users->result($param3);

        $this->load->view(
            'dash/child_detail',
            compact(
                'title',
                'data',
                'medical_record',
                'parent',
            )
        );
	}
	
    public function medical_create()
    {

		$config['upload_path'] = './assets/uploads/images/medical';
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

		$data['datetime']	= time();
		$data['worker_id']	= $this->input->post('worker_id');
		$data['child_id']	= $this->input->post('child_id');
		$data['note']		= $this->input->post('note');

		$result = $this->table_medical->add($data);
		$this->session->set_flashdata('success', "Rekam Medis telah ditambah");
		redirect("dash/child/medical_record/".$data['child_id']);
    }
}
