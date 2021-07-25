<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_owners extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }

        // if(!in_array("ref-owners", $this->session->userdata['logged_in']['owners'])){
        //     $this->session->set_flashdata('error',"Maaf! Anda tidak punya akses.");
        //     redirect($_SERVER['HTTP_REFERER']);
        // }
        
        $this->load->model('ref/table_owners');
    }

    public function index()
    {
        $title['display']   = "Owners";
        $title['parent']    = "Owners";
        $title['level'][0]  = "Refrence";
        $title['href'][0]   = "";
        $title['level'][1]  = "Owners";
        $title['href'][1]   = "";
        
        $this->load->view(
            'ref/owners',
            compact(
                'title'
            )
        );
    }

    public function data()
    {
        $owners = $this->table_owners->all();
        $no =1;
        foreach ($owners as $d) {
            $tbody = array();
            $tbody[] = $no++;

            $photo = base_url('assets/uploads/images/owners/thumbnail/').$d->photo;
            if(is_file(('./assets/uploads/images/owners/thumbnail/').$d->photo)){
                $tbody[] = "<img alt='image' class='mr-3 rounded-circle' width='30' height='30' alt='Responsive image' src='".$photo."'>";
            }else{
                $tbody[] = "<img alt='image' class='mr-3 rounded-circle' width='30' src='".base_url()."assets/img/avatar/avatar-1.png'>";
            }


            $tbody[] = $d->fullname;
            $tbody[] = $d->city;

            if($d->rating == 5){$r=array("fas","fas","fas","fas","fas");
            }elseif($d->rating == 4){$r=array("fas","fas","fas","fas","far");
            }elseif($d->rating == 3){$r=array("fas","fas","fas","far","far");
            }elseif($d->rating == 2){$r=array("fas","fas","far","far","far");
            }elseif($d->rating == 1){$r=array("fas","far","far","far","far");
            }else{$r=array("far","far","far","far","far");
            }

            $rating  ="<div class='product-review'>";
            $rating  .="<i class='".$r[0]." fa-star'></i>";
            $rating  .="<i class='".$r[1]." fa-star'></i>";
            $rating  .="<i class='".$r[2]." fa-star'></i>";
            $rating  .="<i class='".$r[3]." fa-star'></i>";
            $rating  .="<i class='".$r[4]." fa-star'></i>";
            $rating  .="</div>";

            $tbody[] = $rating;
            if($d->status == 0):
                $tbody[] = '<div class="badge badge-warning">Inactive</div>';
            else:
                $tbody[] = '<div class="badge badge-success">Active</div>';
            endif;

            $aksi = "<a href='".base_url()."ref/owners/detail/".$d->id."' class='btn btn-primary'><i class='fas fa-arrow-right mr-2'></i> Detail</a>";
            $tbody[] = $aksi;
            $data[] = $tbody; 
        }

        if ($owners) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=>0));
        }
    }

    public function create()
    {
        $config['upload_path'] = './assets/uploads/images/owners';
  		$config['allowed_types'] = 'jpg|jpeg|png|gif';

  		$this->load->library('upload', $config);
  		$this->upload->initialize($config);

  		if($this->upload->do_upload('photo')){
  			$size = $this->upload->data('file_size');
  			$name = $this->upload->data('file_name');
  			if ($size < 2048) {
                $uploadedImage = $this->upload->data();
                $this->resizeImage($uploadedImage['file_name']);

                $data['photo']   = $name;
            }
  		}

        $data['fullname']   = $this->input->post('fullname');
        $data['address']    = $this->input->post('address');
        $data['city']       = $this->input->post('city');
        $data['created']    = time();
        $data['rating']     = $this->input->post('rating');
        $data['status']     = $this->input->post('status');
        $data['note']       = $this->input->post('note');
        $result = $this->table_owners->add($data);
        echo json_encode($result);
        
    }

    public function detail($ids)
    {
        $title['display']   = "Customer's Detail";
        $title['parent']    = "Owners";
        $title['level'][0]  = "Refrence";
        $title['href'][0]   = "";
        $title['level'][1]  = "Owners";
        $title['href'][1]   = "ref/cutomers";
        $title['level'][2]  = "Detail";
        $title['href'][2]   = "";

        $id['id'] = $ids;

        $data = $this->table_owners->get($id);
        
        $this->load->view(
            'ref/owners_detail',
            compact(
                'title',
                'data'
            )
        );
    }

    public function get()
    {
        $id['id'] = $this->input->post('id');

        $data = $this->table_owners->get($id);
        echo json_encode($data);
    }

    public function update()
    {
        // $id['id']               = $this->input->post('id');
        // $data['title']          = $this->input->post('title');
        // $data['description']    = $this->input->post('description');

        // $result = $this->table_owners->update($id, $data);
        // echo json_encode($result);
    }

    public function update_photo()
    {

    }

    public function update_id_image()
    {
        
    }

    public function delete()
    {
        // $id['id'] = $this->input->post('id');
        // $result = $this->table_owners->delete($id);
        // echo json_encode($result);
    }

    public function resizeImage($filename)
   {
      $source_path = './assets/uploads/images/owners/' . $filename;
      $target_path = './assets/uploads/images/owners/thumbnail';
      $config_manip = array(
          'image_library' => 'gd2',
          'source_image' => $source_path,
          'new_image' => $target_path,
          'maintain_ratio' => TRUE,
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
