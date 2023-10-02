<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_public extends CI_Controller {

    function __construct(){
        parent::__construct();

        $this->load->library('pagination');

        $this->load->model('ref/table_department');
        $this->load->model('ref/table_category');
        $this->load->model('main/table_dataset');
        $this->load->model('main/table_file');
    }

    public function index()
    {

        $title['display']   = "Beranda";
        $title['parent']    = "Beranda";
        $title['level'][0]  = "";
        $title['href'][0]   = "";

        $department = $this->table_department->count();
        $category = $this->table_category->count();
        $file = $this->table_file->count();
        $dataset = $this->table_dataset->count();

        // echo "<pre>";
        // echo print_r($popular);
        // echo "</pre>";
        // die();

        $this->load->view(
            'public/index', 
            compact(
                'title',
                'department',
                'category',
                'file',
                'dataset'
            )
        );
    }

    public function search()
    {
        if($this->input->post('keyword')){
            $keyword['keyword'] = $this->clean($this->input->post('keyword'));
            $this->session->set_userdata('search',$keyword);
        }

        $popular['category']    = $this->table_category->popular(3);
        $popular['department']  = $this->table_department->popular(3);

        $title['display']   = "Pencarian : ".$this->session->userdata['search']['keyword'];
        $title['parent']    = "";
        $title['level'][0]  = "";
        $title['href'][0]   = "";

        $count = $this->table_dataset->count_search($this->session->userdata['search']['keyword']);

        $config['base_url'] = site_url('search'); //site url
        $config['total_rows'] = $count; //total row
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 2;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        
        $config['full_tag_open']    = '<nav class="d-inline-block"><ul class="pagination mb-0">';
        $config['full_tag_close']   = '</ul></nav>';
        
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';

        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';

        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';

        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';

        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';

        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        $data = $this->table_dataset->search($this->session->userdata['search']['keyword'],$config["per_page"], $data['page']);
        $pagination = $this->pagination->create_links();

        $file = array();
        foreach ($data as $d) {
            $param3['file.dataset_id'] = $d->id;
            $file[$d->id] = $this->table_file->get_result($param3);
        }
        // echo "<pre>";
        // echo print_r(compact('keyword','data'));
        // echo "</pre>";
        // die();

        $this->load->view(
            'public/search_result',
            compact(
                'popular',
                'title',
                'pagination',
                'count',
                'data',
                'file'

            )
        );
    }

    private function clean($text, string $divider = "-")
    {
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, $divider);
        $text = preg_replace('~-+~', $divider, $text);
        $text = strtolower($text);
        $text = str_replace("-"," ",$text);
        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public function category()
    {
        $popular['category']    = $this->table_category->popular(3);
        $popular['department']  = $this->table_department->popular(3);

        $title['display']   = "Kategori";
        $title['parent']    = "Kategori";
        $title['level'][0]  = "Kategori";
        $title['href'][0]   = "";

        $data = $this->table_category->all();

        $this->load->view(
            'public/category',
            compact(
                'popular',
                'title',
                'data'

            )
        );
    }

    public function category_detail($id)
    {
        $popular['category']    = $this->table_category->popular(3);
        $popular['department']  = $this->table_department->popular(3);

        $param['slug'] = $id;
        $category = $this->table_category->get($param);

        $this->add_view("category",$category->id,$category->view);

        $title['display']   = $category->title;
        $title['parent']    = "Kategori";
        $title['level'][0]  = "Kategori";
        $title['href'][0]   = "category";
        $title['level'][1]  = "Detail";
        $title['href'][1]   = "";
        $title['level'][2]  = $category->title;
        $title['href'][2]   = "";

        $param2['dataset.category_id'] = $category->id;
        $count = $this->table_dataset->count_result($param2);

        $config['base_url'] = site_url('category/detail/').$category->slug; //site url
        $config['total_rows'] = $count; //total row
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 4;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        
        $config['full_tag_open']    = '<nav class="d-inline-block"><ul class="pagination mb-0">';
        $config['full_tag_close']   = '</ul></nav>';
        
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';

        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';

        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';

        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';

        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';

        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data       = $this->table_dataset->get_result_page($param2,$config["per_page"], $data['page']);           
        $pagination = $this->pagination->create_links();

        $file = array();
        foreach ($data as $d) {
            $param3['file.dataset_id'] = $d->id;
            $file[$d->id] = $this->table_file->get_result($param3);
        }

        $this->load->view(
            'public/category_detail',
            compact(
                'popular',
                'title',
                'category',
                'pagination',
                'count',
                'data',
                'file'

            )
        );

    }

    public function department()
    {
        $popular['category']    = $this->table_category->popular(3);
        $popular['department']  = $this->table_department->popular(3);

        $title['display']   = "Instansi / Organisasi";
        $title['parent']    = "Instansi";
        $title['level'][0]  = "Instansi";
        $title['href'][0]   = "";

        $data = $this->table_department->all();

        $this->load->view(
            'public/department',
            compact(
                'popular',
                'title',
                'data'

            )
        );
    }

    public function department_detail($id)
    {
        $popular['category']    = $this->table_category->popular(3);
        $popular['department']  = $this->table_department->popular(3);

        $param['slug'] = $id;
        $department = $this->table_department->get_row($param);

        $this->add_view("department",$department->id,$department->view);

        $title['display']   = $department->title;
        $title['parent']    = "Instansi";
        $title['level'][0]  = "Instansi";
        $title['href'][0]   = "department";
        $title['level'][1]  = "Detail";
        $title['href'][1]   = "";
        $title['level'][2]  = $department->title;
        $title['href'][2]   = "";

        $param2['dataset.department_id'] = $department->id;
        $count = $this->table_dataset->count_result($param2);

        $config['base_url'] = site_url('department/detail/').$department->slug; //site url
        $config['total_rows'] = $count; //total row
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 4;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        
        $config['full_tag_open']    = '<nav class="d-inline-block"><ul class="pagination mb-0">';
        $config['full_tag_close']   = '</ul></nav>';
        
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';

        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';

        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';

        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';

        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';

        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data       = $this->table_dataset->get_result_page($param2,$config["per_page"], $data['page']);           
        $pagination = $this->pagination->create_links();

        $file = array();
        foreach ($data as $d) {
            $param3['file.dataset_id'] = $d->id;
            $file[$d->id] = $this->table_file->get_result($param3);
        }

        $this->load->view(
            'public/department_detail',
            compact(
                'popular',
                'title',
                'department',
                'pagination',
                'count',
                'data',
                'file'
            )
        );
    }

    public function dataset_detail($id)
    {
        $popular['category']    = $this->table_category->popular(3);
        $popular['department']  = $this->table_department->popular(3);

        $param['dataset.slug'] = $id;
        $data = $this->table_dataset->get_row($param);

        $this->add_view("dataset",$data->id,$data->view);

        $param2['file.dataset_id'] = $data->id;
        $file = $this->table_file->get_result($param2);

        $title['display']   = $data->title;
        $title['parent']    = "";
        $title['level'][0]  = "";

        

        $this->load->view(
            'public/dataset_detail',
            compact(
                'popular',
                'title',
                'data',
                'file'

            )
        );
    }

    public function download_file($id)
    {
        $fid['id'] = $id;
        $file = $this->table_file->get_row($fid);
        $this->add_view("file",$file->id,$file->view);

		force_download('./assets/uploads/file/'.$file->file,NULL);
        echo "<script>window.close();</script>";
    }

    private function add_view($type,$id,$view)
    {
        $eid['id'] = $id;
        $edata['view'] = $view + 1;

        if($type == "category"){
            $this->table_category->update($eid,$edata);
        }elseif($type == "department"){
            $this->table_department->update($eid,$edata);
        }elseif($type == "dataset"){
            $this->table_dataset->update($eid,$edata);
        }elseif($type == "file"){
            $this->table_file->update($eid,$edata);
        }
    }


}

/* End of file Controllername.php */
