<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_settings extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }

        if(!in_array("ref-settings", $this->session->userdata['logged_in']['permissions'])){
            $this->session->set_flashdata('error',"Maaf! Anda tidak punya akses.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        $this->load->model('ref/table_settings');
    }

    public function index()
    {
        $title['display']   = "Pengaturan";
        $title['parent']    = "Pengaturan";
        $title['level'][0]  = "Referensi";
        $title['href'][0]   = "";
        $title['level'][1]  = "Pengaturan";
        $title['href'][1]   = "";
        
        $this->load->view(
            'ref/settings',
            compact(
                'title'
            )
        );
    }

    public function data()
    {
        $settings = $this->table_settings->all();
        $no =1;
        foreach ($settings as $d) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $d->title;
            $tbody[] = $d->slug;
            $tbody[] = $d->value;
            $tbody[] = date("Y-m-d H:i:s",$d->last_update)." WITA";
            $aksi = "<button class='btn btn-light row-edit' data-toggle='modal' data-id=".$d->id."><i class='fas fa-pen mr-2'></i> Ubah</button>";
            $aksi .= " <button class='btn btn-primary row-delete' id='id' data-toggle='modal' data-id=".$d->id."><i class='fas fa-times mr-2'></i> Hapus</button>";
            $tbody[] = $aksi;
            $array[] = $tbody; 
        }

        if ($settings) {
            echo json_encode(array('data'=> $array));
        }else{
            echo json_encode(array('data'=>0));
        }
    }

    public function create()
    {
		$title			= $this->input->post('title');
		$data['slug']	= strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
		$check          = $this->table_settings->check($data);

		if($check == false)
        {
			$data['title']  		= $title;
			$data['value']    		= $this->input->post('value');
			$data['last_update']    = time();
			$result = $this->table_settings->add($data);
			echo json_encode($result);

        }else{
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
        }
		
        
    }

    public function get()
    {
        $id['id'] = $this->input->post('id');

        $data = $this->table_settings->get($id);
        echo json_encode($data);
    }

    public function update()
    {
        $slug         		= $this->input->post('e_slug');
        $title         		= $this->input->post('e_title');
        $id['id']         	= $this->input->post('e_id');
		$data['slug']		= strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));


        
        if($slug != $data['slug'])
        {
            $check = $this->table_settings->check($data);
        }
        else {
            $check = FALSE;
        }

        if($check == FALSE)
        {
            $data['title']  		= $title;
			$data['value']    		= $this->input->post('e_value');
			$data['last_update']    = time();
    
            $result = $this->table_settings->update($id,$data);
            echo json_encode($result);
        }else{
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
        }
    }

    public function delete()
    {
        $id['id'] = $this->input->post('id');
        $result = $this->table_settings->delete($id);
        echo json_encode($result);
    }

}
