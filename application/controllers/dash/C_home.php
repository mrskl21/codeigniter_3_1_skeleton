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
        $title['display']   = "Home";
        $title['parent']    = "Home";

        $this->load->view('home/index', compact('title'));
    }


}

/* End of file Controllername.php */
