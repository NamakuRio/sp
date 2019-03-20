<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Docs extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('docs_model');
	}

    public function index()
    {
        $data['menu'] = $this->docs_model->getMenu();
        $data['submenu'] = $this->docs_model->getSubmenu();

        $this->load->view('docs/main', $data);
    }

    public function asd()
    {
        var_dump($this->docs_model->getSubmenu());
    }

}