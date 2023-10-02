<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table_users extends CI_Model
{
    private $table="auth_users";

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $this->db->select('
            auth_users.*,
            auth_roles.title as roles_title
        ');
        $this->db->join('auth_roles','auth_users.roles_id = auth_roles.id');
        return $this->db->get($this->table)->result();
    }

    public function active()
    {
        $this->db->select('
            auth_users.*,
            auth_roles.title as roles_title
        ');
        $this->db->join('auth_roles','auth_users.roles_id = auth_roles.id');
        $this->db->where('auth_users.status',1); 
        return $this->db->get($this->table)->result();
    }

    public function login($data)
        {$this->db->select('
            auth_users.*,
            auth_roles.title as roles_title
        ');
        $this->db->join('auth_roles','auth_users.roles_id = auth_roles.id');
        return $this->db->get_where($this->table,$data)->row();
        
    }

    public function add($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get($id)
    {
        $this->db->select('
            auth_users.*,
            auth_roles.title as roles_title
        ');
        $this->db->join('auth_roles','auth_users.roles_id = auth_roles.id');
        $this->db->where($id);
        return $this->db->get($this->table)->row();
    }

    public function result($id)
    {
        $this->db->select('
            auth_users.*,
            auth_roles.title as roles_title
        ');
        $this->db->join('auth_roles','auth_users.roles_id = auth_roles.id');
        $this->db->where($id);
        return $this->db->get($this->table)->result();
    }

    public function update($id, $data)
    {
        $this->db->where($id);
        $this->db->update($this->table,$data);
    }

    public function delete($id)
    {
        $this->db->where($id);
        $this->db->delete($this->table);
    }

    public function check($data)
    {
        $this->db->where($data);
        $data = $this->db->get($this->table)->row();

        if($data){
            return true;
        } else{
            return false;
        }
    }
    
}
