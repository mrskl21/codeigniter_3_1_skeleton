<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table_roles_has_permissions extends CI_Model
{
    private $table="auth_roles_has_permissions";

    public function __construct()
    {
        parent::__construct();
    }

    public function add_batch($data)
    {
        return $this->db->insert_batch($this->table, $data);
    }

    public function get($id)
    {
        $this->db->where($id);
        return $this->db->get($this->table)->row();
    }

    public function get_by_roles($id)
    {
        $this->db->where($id);
        $data = $this->db->get($this->table)->result();

        if($data == null){
            return null;
        }else{
            foreach ($data as $d) {
                $has[$d->permissions_id] = $d;
            }
            return $has;
        }
    }

    public function get_by_id($id)
    {
        $this->db->select('auth_permissions.title');
        $this->db->join('auth_permissions','auth_permissions.id = auth_roles_has_permissions.permissions_id');
        $this->db->join('auth_roles','auth_roles.id = auth_roles_has_permissions.roles_id');
        $this->db->join('auth_users','auth_roles.id = auth_users.roles_id');
        $this->db->where('auth_users.id', $id);
        $data = $this->db->get($this->table)->result();

        if($data == null){
            return null;
        }else{
            foreach ($data as $d) {
                $has[] = $d->title;
            }
            return $has;
        }
    }

    public function result($id)
    {
        $this->db->where($id);
        return $this->db->get($this->table)->result();
    }

    public function update($id, $data)
    {
        $this->db->where($id);
        $this->db->update($this->table,$data);
    }

    public function delete_by_roles($id)
    {
        $this->db->where('roles_id',$id);
        $this->db->delete($this->table);
    }
    
}

