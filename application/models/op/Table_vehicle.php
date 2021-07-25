<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table_vehicle extends CI_Model
{
    private $table="op_vehicle";

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $this->db->select('
            op_vehicle.*,
            ref_car_models.title as model_title,
            ref_car_types.title as type_title,
            ref_car_brands.title as brand_title,
            ref_owners.fullname as owner_name
        ');
        $this->db->join('ref_car_models', 'op_vehicle.model_id = ref_car_models.id');
        $this->db->join('ref_car_types', 'ref_car_models.type_id = ref_car_types.id');
        $this->db->join('ref_car_brands', 'ref_car_types.brand_id = ref_car_brands.id');
        $this->db->join('ref_owners', 'op_vehicle.owner_id = ref_owners.id');
        return $this->db->get($this->table)->result();
    }

    public function rates()
    {
    //     $this->db->select('
    //         op_vehicle.*,
    //         op_rates.value as val,
    //         ref_car_models.title as model_title,
    //         ref_car_types.title as type_title,
    //         ref_car_brands.title as brand_title,
    //         ref_owners.fullname as owner_name
    //     ');

    //     $this->db->join('ref_car_models', 'op_vehicle.model_id = ref_car_models.id');
    //     $this->db->join('ref_car_types', 'ref_car_models.type_id = ref_car_types.id');
    //     $this->db->join('ref_car_brands', 'ref_car_types.brand_id = ref_car_brands.id');
    //     $this->db->join('ref_owners', 'op_vehicle.owner_id = ref_owners.id');
    //     $this->db->where('op_vehicle.status',1);
    //     // $this->db->limit(1);
    //     return $this->db->get($this->table)->result();
    
        $this->db->select('
            vehicle.*,
            ref_car_models.title as model_title,
            ref_car_types.title as type_title,
            ref_car_types.image as type_image,
            ref_car_brands.title as brand_title,
            ref_car_brands.image as brand_image,
            ref_owners.fullname as owner_name,
            rates.value'
        );
        $this->db->from('op_vehicle as vehicle');
        $this->db->join('(select max(id) max_id, vehicle_id 
                        from op_rates group by vehicle_id) as r', 'r.vehicle_id = vehicle.id', 'left');
        $this->db->join('op_rates as rates', 'rates.id = r.max_id', 'left');
        $this->db->join('ref_car_models', 'vehicle.model_id = ref_car_models.id');
        $this->db->join('ref_car_types', 'ref_car_models.type_id = ref_car_types.id');
        $this->db->join('ref_car_brands', 'ref_car_types.brand_id = ref_car_brands.id');
        $this->db->join('ref_owners', 'vehicle.owner_id = ref_owners.id');
        $this->db->where('vehicle.status',1);
        // $this->db->limit(1);
        return $this->db->get()->result();

    }

    public function add($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get($id)
    {
        $this->db->select('
            op_vehicle.*,
            ref_car_types.id as type_id,
            ref_car_brands.id as brand_id,
            ref_owners.id as owner_id
        ');
        $this->db->join('ref_car_models', 'op_vehicle.model_id = ref_car_models.id');
        $this->db->join('ref_car_types', 'ref_car_models.type_id = ref_car_types.id');
        $this->db->join('ref_car_brands', 'ref_car_types.brand_id = ref_car_brands.id');
        $this->db->join('ref_owners', 'op_vehicle.owner_id = ref_owners.id');
        $this->db->where($id);
        return $this->db->get($this->table)->row();
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