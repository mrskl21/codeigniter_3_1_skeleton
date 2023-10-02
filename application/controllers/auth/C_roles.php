<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_roles extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }

        if(!in_array("auth-roles", $this->session->userdata['logged_in']['permissions'])){
            $this->session->set_flashdata('error',"Maaf! Anda tidak punya akses.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        $this->load->model('auth/table_roles');
        $this->load->model('auth/table_permissions');
        $this->load->model('auth/table_roles_has_permissions');
    }

    public function index()
    {
        $title['display']   = "Peran";
        $title['parent']    = "Peran";
        $title['level'][0]  = "Autentikasi";
        $title['href'][0]   = "";
        $title['level'][1]  = "Peran";
        $title['href'][1]   = "";
        
        $permissions        = $this->table_permissions->all();

        $this->load->view(
            'auth/roles',
            compact(
                'title',
                'permissions'
            )
        );
    }

    public function data()
    {
        $roles = $this->table_roles->all();
        $no =1;
        foreach ($roles as $d) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $d->title;
            $tbody[] = $d->description;
            $aksi = "<button class='btn btn-light row-edit' data-toggle='modal' data-id=".$d->id."><i class='fas fa-pen mr-2'></i> Ubah</button>";
            $aksi .= " <button class='btn btn-warning row-permissions' data-toggle='modal' data-id=".$d->id."><i class='fas fa-list mr-2'></i> Hak Akses</button>";
            $aksi .= " <button class='btn btn-primary row-delete' id='id' data-toggle='modal' data-id=".$d->id."><i class='fas fa-times mr-2'></i> Hapus</button>";
            $tbody[] = $aksi;
            $data[] = $tbody; 
        }

        if ($roles) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=>0));
        }
    }

    public function create()
    {
        $data['title']          = $this->input->post('title');
        $data['description']    = $this->input->post('description');
        $result = $this->table_roles->add($data);
        echo json_encode($result);
        
    }

    public function get()
    {
        $id['id'] = $this->input->post('id');

        $data = $this->table_roles->get($id);
        echo json_encode($data);
    }

    public function update()
    {
        $id['id'] = $this->input->post('id');
        $data['title']  = $this->input->post('title');
        $data['description'] = $this->input->post('description');

        $result = $this->table_roles->update($id, $data);
        echo json_encode($result);
    }

    public function delete()
    {
        $id['id'] = $this->input->post('id');
        $result = $this->table_roles->delete($id);
        echo json_encode($result);
    }

    public function has_permissions()
    {
        $id['id'] = $this->input->post('id');
        $id2['roles_id'] = $this->input->post('id');

        $data['role']           = $this->table_roles->get($id);
        $data['permissions']    = $this->table_roles_has_permissions->get_by_roles($id2);
        echo json_encode($data);
    }

    public function permissions_update(){

        $permissions    = $this->table_permissions->all();
        $roles_id       = $this->input->post('roles_id');
        $checkbox       = $this->input->post('checkbox');
        
        // $checked        = json_decode($checkbox);

        $data        = array();

        if($checkbox != null){
            $no=0;
            foreach ($permissions as $p) {
                if($checkbox[$no] != NULL){
                    $data[$p->id]['roles_id']         = $this->input->post('roles_id');
                    $data[$p->id]['permissions_id']   = $checkbox[$no];
                }
                $no++;
            }

            // echo "<pre>";
            // echo print_r($data);
            // echo "<pre>";
            // die();

            $this->table_roles_has_permissions->delete_by_roles($roles_id);
            $result = $this->table_roles_has_permissions->add_batch($data);
            echo json_encode($result);

        }


    }

}
