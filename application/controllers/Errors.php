<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // load view admin/overview.php
        $this->load->view("errors/page/error_404");
    }

    public function error_404()
    {
        $this->output->set_status_header('404');
        $this->load->view("errors/page/error_404");	
    }

    public function error_403()
    {
        $this->output->set_status_header('403');
        $this->load->view("errors/page/error_403");	
    }

    public function error_500()
    {
        $this->output->set_status_header('500');
        $this->load->view("errors/page/error_500");	
    }

    public function error_503()
    {
        $this->output->set_status_header('503');
        $this->load->view("errors/page/error_503");	
    }

    public function forbidden()
    {
        $this->output->set_status_header('500');
        $this->load->view("errors/page/error_500");	
    }

}