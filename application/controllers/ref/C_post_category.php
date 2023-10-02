<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_post_category extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }

        if(!in_array("ref-post-category", $this->session->userdata['logged_in']['permissions'])){
            $this->session->set_flashdata('error',"Maaf! Anda tidak punya akses.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        $this->load->model('ref/table_post_category');
    }

    public function index()
    {
        $title['display']   = "Kategori Artikel";
        $title['parent']    = "Kategori Artikel";
        $title['level'][0]  = "Referensi";
        $title['href'][0]   = "";
        $title['level'][1]  = "Kategori Artikel";
        $title['href'][1]   = "";
        
        $this->load->view(
            'ref/post_category',
            compact(
                'title'
            )
        );
    }

    public function data()
    {
        $permissions = $this->table_post_category->all();
        $no =1;
        foreach ($permissions as $d) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $d->title;
            $tbody[] = $d->slug;
            $tbody[] = $d->description;
            $aksi = "<button class='btn btn-light row-edit' data-toggle='modal' data-id=".$d->id."><i class='fas fa-pen mr-2'></i> Ubah</button>";
            $aksi .= " <button class='btn btn-primary row-delete' id='id' data-toggle='modal' data-id=".$d->id."><i class='fas fa-times mr-2'></i> Hapus</button>";
            $tbody[] = $aksi;
            $data[] = $tbody; 
        }

        if ($permissions) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=>0));
        }
    }

    public function create()
    {
        $data['title']  		= $this->input->post('title');
		$data['description']    = $this->input->post('description');
        $data['slug']           = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post('title'))));
		$result = $this->table_post_category->add($data);
		echo json_encode($result);
        
    }

    public function get()
    {
        $id['id'] = $this->input->post('id');

        $data = $this->table_post_category->get($id);
        echo json_encode($data);
    }

    public function update()
    {
        $id['id'] 				= $this->input->post('id');
        $data['title']  		= $this->input->post('title');
		$data['description']    = $this->input->post('description');
        $data['slug']           = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post('title'))));
		
		$result = $this->table_post_category->update($id, $data);
		echo json_encode($result);
    }

    public function delete()
    {
        $id['id'] = $this->input->post('id');
        $result = $this->table_post_category->delete($id);
        echo json_encode($result);
    }

}
