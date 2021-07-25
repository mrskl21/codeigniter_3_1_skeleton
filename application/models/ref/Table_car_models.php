<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table_car_models extends CI_Model
{
    private $table="ref_car_models";

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $this->db->select('
            ref_car_models.*,
            ref_car_types.title as type_title,
            ref_car_brands.title as brand_title
        ');
        $this->db->join('ref_car_types', 'ref_car_models.type_id = ref_car_types.id');
        $this->db->join('ref_car_brands', 'ref_car_types.brand_id = ref_car_brands.id');
        return $this->db->get($this->table)->result();
    }

    public function add($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get($id)
    {
        $this->db->where($id);
        return $this->db->get($this->table)->row();
    }

    public function get_result($id)
    {
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