<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->auth_model->cek_login('masuk');
        $this->load->model('pengaturan_model');
	}

    public function index()
    {
        $this->load->view('dashboard/pengaturan/main');
    }

}