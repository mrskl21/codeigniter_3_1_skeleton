<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_cost_types extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }

        // if(!in_array("ref-cost_types", $this->session->userdata['logged_in']['cost_types'])){
        //     $this->session->set_flashdata('error',"Maaf! Anda tidak punya akses.");
        //     redirect($_SERVER['HTTP_REFERER']);
        // }
        
        $this->load->model('ref/table_cost_types');
    }

    public function index()
    {
        $title['display']   = "Cost Types";
        $title['parent']    = "Cost Types";
        $title['level'][0]  = "Refrence";
        $title['href'][0]   = "";
        $title['level'][1]  = "Cost Types";
        $title['href'][1]   = "";
        
        $this->load->view(
            'ref/cost_types',
            compact(
                'title'
            )
        );
    }

    public function data()
    {
        $cost_types = $this->table_cost_types->all();
        $no =1;
        foreach ($cost_types as $d) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $d->title;
            $tbody[] = $d->description;
            $aksi = "<button class='btn btn-primary row-edit' data-toggle='modal' data-id=".$d->id."><i class='fas fa-pen mr-2'></i> Update</button>";
            $aksi .= " <button class='btn btn-danger row-delete' id='id' data-toggle='modal' data-id=".$d->id."><i class='fas fa-times mr-2'></i> Delete</button>";
            $tbody[] = $aksi;
            $data[] = $tbody; 
        }

        if ($cost_types) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=>0));
        }
    }

    public function create()
    {
        $data['title']          = $this->input->post('title');
        $data['description']    = $this->input->post('description');
        $result = $this->table_cost_types->add($data);
        echo json_encode($result);
        
    }

    public function get()
    {
        $id['id'] = $this->input->post('id');

        $data = $this->table_cost_types->get($id);
        echo json_encode($data);
    }

    public function update()
    {
        $id['id']               = $this->input->post('id');
        $data['title']          = $this->input->post('title');
        $data['description']    = $this->input->post('description');

        $result = $this->table_cost_types->update($id, $data);
        echo json_encode($result);
    }

    public function delete()
    {
        $id['id'] = $this->input->post('id');
        $result = $this->table_cost_types->delete($id);
        echo json_encode($result);
    }

}
