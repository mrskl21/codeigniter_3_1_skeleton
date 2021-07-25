<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_car_brands extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }
        
        $this->load->model('ref/table_car_brands');
        $this->load->model('ref/table_car_models');
        $this->load->model('ref/table_car_types');
        $this->load->model('ref/table_car_class');
    }

    public function index()
    {

        $title['display']   = "Car Brands";
        $title['parent']    = "Car Brands";
        $title['level'][0]  = "Ref";
        $title['href'][0]   = "";
        $title['level'][1]  = "Car Brands";
        $title['href'][1]   = "";

        $this->load->view(
            'ref/car_brands',
            compact(
                'title'
            )
        );
    }

    public function data()
    {
        $data_brands = $this->table_car_brands->all();
        $no =1;
        foreach ($data_brands as $d) {
            $tbody = array();
            $tbody[] = $no++;

            $photo = base_url('assets/uploads/images/cars/').$d->image;
            if(is_file(('./assets/uploads/images/cars/').$d->image)){
                $tbody[] = "<img alt='image' class='mr-3 rounded-circle' height='30' alt='Responsive image' src='".$photo."'>";
            }else{
                $tbody[] = "";
            }

            $tbody[] = $d->title;
            $tbody[] = $d->description;
            $aksi = "<a class='btn btn-primary' href='".base_url()."ref/car_brands/".$d->id."/types'><i class='fas fa-list mr-2'></i> List</a>";
            $tbody[] = $aksi;
            $data[] = $tbody; 
        }

        if ($data_brands) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=>0));
        }
    }

    public function add()
    {
    }

    public function update()
    {
        $id['id']   = $this->input->post('d_id');
        $data['title']   = $this->input->post('d_title');
        $data['description']   = $this->input->post('d_description');

        $this->table_car_brands->update($id, $data);
        $this->session->set_flashdata('success','Update Success');
        redirect("ref/car_brands/".$id['id']."/types");

    }

    public function image_update()
    {
        $id['id']   = $this->input->post('i_id');
        $image_current   = $this->input->post('i_image_current');

        $config['upload_path'] = './assets/uploads/images/cars';
  		$config['allowed_types'] = 'jpg|jpeg|png|gif';

  		$this->load->library('upload', $config);
  		$this->upload->initialize($config);

  		if($this->upload->do_upload('i_image')){
  			$size = $this->upload->data('file_size');
  			$name = $this->upload->data('file_name');
  			if ($size < 2048) {
                $uploadedImage = $this->upload->data();
                $this->resizeImage($uploadedImage['file_name']);

                $data['image']   = $name;

                $this->table_car_brands->update($id, $data);

                unlink("./assets/uploads/images/cars/".$image_current);
                unlink("./assets/uploads/images/cars/thumbnail/".$image_current);

                $this->session->set_flashdata('success','Upload Success');
                redirect("ref/car_brands/".$id['id']."/types");
            }else{
                $this->session->set_flashdata('error','File too large, max 2mb');
                redirect("ref/car_brands/".$id['id']."/types");
            }
  		}else{
            $this->session->set_flashdata('error','Cant upload file');
            redirect("ref/car_brands/".$id['id']."/types");
        }
    }

    public function types($id)
    {
        $param['id']    = $id;
        $brand          = $this->table_car_brands->get($param);
        $class          = $this->table_car_class->all();
        $title['display']   = "Car Types";
        $title['parent']    = "Car Brands";
        $title['level'][0]  = "Ref";
        $title['href'][0]   = "";
        $title['level'][1]  = "Car Brands";
        $title['href'][1]   = "ref/car_brands";
        $title['level'][2]  = $brand->title;
        $title['href'][2]   = "";

        $this->load->view(
            'ref/car_types',
            compact(
                'title',
                'class',
                'brand'
            )
        );
    }

    public function types_data($id)
    {
        $param['brand_id'] = $id;
        $data_types = $this->table_car_types->get_result($param);
        $no =1;
        foreach ($data_types as $d) {
            $tbody = array();
            $tbody[] = $no++;

            $photo = base_url('assets/uploads/images/cars/').$d->image;
            if(is_file(('./assets/uploads/images/cars/').$d->image)){
                $tbody[] = "<img alt='image' class='mr-3' height='40' alt='Responsive image' src='".$photo."'>";
            }else{
                $tbody[] = "";
            }

            $tbody[] = $d->title;
            $tbody[] = $d->class;
            $tbody[] = $d->description;
            $aksi = "<a class='btn btn-primary' href='".base_url()."/ref/car_brands/".$d->id."/models'><i class='fas fa-list mr-2'></i> List</a>";
            $tbody[] = $aksi;
            $data[] = $tbody; 
        }

        if ($data_types) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=>0));
        }
    }

    public function types_create()
    {
        $config['upload_path'] = './assets/uploads/images/cars';
  		$config['allowed_types'] = 'jpg|jpeg|png|gif';

  		$this->load->library('upload', $config);
  		$this->upload->initialize($config);

  		if($this->upload->do_upload('image')){
  			$size = $this->upload->data('file_size');
  			$name = $this->upload->data('file_name');
  			if ($size < 2048) {
                $uploadedImage = $this->upload->data();
                $this->resizeImage($uploadedImage['file_name']);

                $data['image']   = $name;
            }
  		}

        $data['brand_id']   = $this->input->post('brand_id');
        $data['title']   = $this->input->post('title');
        $data['class']   = $this->input->post('class');
        $data['description']  = $this->input->post('description');
        $result = $this->table_car_types->add($data);
        echo json_encode($result);
    }

    public function types_update()
    {
        $id['id']   = $this->input->post('d_id');
        $data['title']   = $this->input->post('d_title');
        $data['class']   = $this->input->post('d_class');
        $data['description']   = $this->input->post('d_description');

        $this->table_car_types->update($id, $data);
        $this->session->set_flashdata('success','Update Success');
        redirect("ref/car_brands/".$id['id']."/models");

    }

    public function types_image_update()
    {
        $id['id']   = $this->input->post('i_id');
        $image_current   = $this->input->post('i_image_current');

        $config['upload_path'] = './assets/uploads/images/cars';
  		$config['allowed_types'] = 'jpg|jpeg|png|gif';

  		$this->load->library('upload', $config);
  		$this->upload->initialize($config);

  		if($this->upload->do_upload('i_image')){
  			$size = $this->upload->data('file_size');
  			$name = $this->upload->data('file_name');
  			if ($size < 2048) {
                $uploadedImage = $this->upload->data();
                $this->resizeImage($uploadedImage['file_name']);

                $data['image']   = $name;

                $this->table_car_types->update($id, $data);

                unlink("./assets/uploads/images/cars/".$image_current);
                unlink("./assets/uploads/images/cars/thumbnail/".$image_current);

                $this->session->set_flashdata('success','Upload Success');
                redirect("ref/car_brands/".$id['id']."/models");
            }else{
                $this->session->set_flashdata('error','File too large, max 2mb');
                redirect("ref/car_brands/".$id['id']."/models");
            }
  		}else{
            $this->session->set_flashdata('error','Cant upload file');
            redirect("ref/car_brands/".$id['id']."/models");
        }
    }

    public function models($id)
    {
        $param['id']    = $id;
        $type           = $this->table_car_types->get($param);
        $param2['id']   = $type->brand_id;
        $brand          = $this->table_car_brands->get($param2);
        $class          = $this->table_car_class->all();
        $title['display']   = "Car Models";
        $title['parent']    = "Car Brands";
        $title['level'][0]  = "Ref";
        $title['href'][0]   = "";
        $title['level'][1]  = "Car Brands";
        $title['href'][1]   = "ref/car_brands";
        $title['level'][2]  = $brand->title;
        $title['href'][2]   = "ref/car_brands/".$brand->id."/types";
        $title['level'][3]  = $type->title;
        $title['href'][3]   = "";

        $this->load->view(
            'ref/car_models',
            compact(
                'title',
                'class',
                'type'
            )
        );
    }

    public function models_data($id)
    {
        $param['type_id'] = $id;
        $data_models = $this->table_car_models->get_result($param);
        $no =1;
        foreach ($data_models as $d) {
            $tbody = array();
            $tbody[] = $no++;

            $tbody[] = $d->title;
            $tbody[] = $d->release_year;
            $tbody[] = $d->cc;
            $tbody[] = $d->seat;
            $tbody[] = $d->transmission;
            $tbody[] = $d->description;
            $aksi = "<button class='btn btn-primary row-edit' data-toggle='modal' data-id=".$d->id."><i class='fas fa-pen'></i></button>";
            $aksi .= " <button class='btn btn-danger row-delete' id='id' data-toggle='modal' data-id=".$d->id."><i class='fas fa-times'></i></button>";
            $tbody[] = $aksi;
            $data[] = $tbody; 
        }

        if ($data_models) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=>0));
        }
    }

    public function models_create()
    {
        $data['type_id']   = $this->input->post('type_id');
        $data['title']   = $this->input->post('title');
        $data['description']  = $this->input->post('description');
        $data['release_year']   = $this->input->post('release_year');
        $data['cc']   = $this->input->post('cc');
        $data['seat']   = $this->input->post('seat');
        $data['transmission']   = $this->input->post('transmission');
        $result = $this->table_car_models->add($data);
        echo json_encode($result);
    }

    public function models_get()
    {
        $id['id'] = $this->input->post('id');

        $data = $this->table_car_models->get($id);
        echo json_encode($data);
    }

    public function models_update()
    {
        $id['id']   = $this->input->post('e_id');
        $data['title']   = $this->input->post('e_title');
        $data['description']  = $this->input->post('e_description');
        $data['release_year']   = $this->input->post('e_release_year');
        $data['cc']   = $this->input->post('e_cc');
        $data['seat']   = $this->input->post('e_seat');
        $data['transmission']   = $this->input->post('e_transmission');
        $result = $this->table_car_models->update($id, $data);
        echo json_encode($result);
    }

    public function models_delete()
    {
        $id['id'] = $this->input->post('id');
        $result = $this->table_car_models->delete($id);
        echo json_encode($result);
    }

    public function resizeImage($filename)
    {
       $source_path = './assets/uploads/images/cars/' . $filename;
       $target_path = './assets/uploads/images/cars/thumbnail';
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
