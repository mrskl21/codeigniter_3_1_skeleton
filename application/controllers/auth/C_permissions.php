<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_permissions extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }

        if(!in_array("auth-permissions", $this->session->userdata['logged_in']['permissions'])){
            $this->session->set_flashdata('error',"Maaf! Anda tidak punya akses.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        $this->load->model('auth/table_permissions');
    }

    public function index()
    {
        $title['display']   = "Hak Akses";
        $title['parent']    = "Hak Akses";
        $title['level'][0]  = "Autentikasi";
        $title['href'][0]   = "";
        $title['level'][1]  = "Hak Akses";
        $title['href'][1]   = "";
        
        $this->load->view(
            'auth/permissions',
            compact(
                'title'
            )
        );
    }

    public function data()
    {
        $permissions = $this->table_permissions->all();
        $no =1;
        foreach ($permissions as $d) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $d->title;
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
        $data['title']  = str_replace(" ","-",strtolower($this->input->post('title')));
        $check   = $this->table_permissions->check($data);

        if($check == false)
        {
            $data['description']    = $this->input->post('description');
            $result = $this->table_permissions->add($data);
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

        $data = $this->table_permissions->get($id);
        echo json_encode($data);
    }

    public function update()
    {
        $title = $this->input->post('title_current');
        $id['id'] = $this->input->post('id');
        $data['title']  = str_replace(" ","-",strtolower($this->input->post('title')));
        
        if($title != $data['title']){
            $check = $this->table_permissions->check($data);
        }
        else {
            $check = FALSE;
        }

        if($check == FALSE){
            $data['description'] = $this->input->post('description');
    
            $result = $this->table_permissions->update($id, $data);
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
        $result = $this->table_permissions->delete($id);
        echo json_encode($result);
    }

}
