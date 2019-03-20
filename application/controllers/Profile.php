<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->auth_model->cek_login('masuk');
        $this->load->model('profile_model');
	}

    public function index()
    {
        $this->load->view('dashboard/profile/main');
    }
    
    public function edit()
    {
        $profile = $this->profile_model;
        $validation = $this->form_validation;
        $validation->set_rules($profile->rules());

        if ($validation->run()) {
            $profile->update();
            $this->session->set_flashdata('success', 'Profile Berhasil diedit');        
        }

        redirect(site_url('profile'));

    }

}