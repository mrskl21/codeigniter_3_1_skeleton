<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_home extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }

    }

    public function index()
    {
        $title['display']   = "Beranda";
        $title['parent']    = "Beranda";
        $title['level'][0]  = "Utama";
        $title['href'][0]   = "";

        $this->load->view('home/index', compact('title'));
    }


}

/* End of file Controllername.php */
