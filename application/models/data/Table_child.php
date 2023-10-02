<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table_child extends CI_Model
{
    private $table="data_child";

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
		$this->db->select('
			data_child.*,
			auth_users.fullname as parent_name
		');
		$this->db->join('auth_users','data_child.parent_id = auth_users.id');
        return $this->db->get($this->table)->result();
    }

    public function add($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get($id)
    {
		$this->db->select('
			data_child.*,
			auth_users.fullname as parent_name
		');
		$this->db->join('auth_users','data_child.parent_id = auth_users.id');
        $this->db->where($id);
        return $this->db->get($this->table)->row();
    }

    public function result($id)
    {
		$this->db->select('
			data_child.*,
			auth_users.fullname as parent_name
		');
		$this->db->join('auth_users','data_child.parent_id = auth_users.id');
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
