<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
	}

    public function index()
    {
        $this->auth_model->cek_login('login');

        redirect(site_url('login'));
        
    }

    public function login()
    {
        $this->auth_model->cek_login('login');

        $this->load->view('auth/login');

    }

    public function lupa_password()
    {
        $this->auth_model->cek_login('login');

        $this->load->view('auth/lupa_password');

    }

    public function proses($opsi=null)
    {
        $this->auth_model->cek_login('login');
        
        $auth = $this->auth_model;

        if($opsi == 'login'){
            $validation = $this->form_validation;
            $validation->set_rules($auth->rules());

            if($validation->run()){
                $login = $auth->login();

                if(!empty($login)){
                    $this->session->set_userdata($login);
                    $this->session->set_flashdata('success','Selamat datang di halaman dashboard.');

                    redirect(site_url('dashboard'));
                } else {
                    $this->session->set_flashdata('gagal','Username atau Password salah.');

                    redirect(site_url('login'));
                }
            }
        } else if ($opsi == 'lupa-password'){
            
            redirect(site_url('lupa-password'));

        } else {
            
            redirect(site_url('login'));
            
        }
    }

    public function logout()
    {

        $this->session->sess_destroy();
        redirect(site_url('login'));
    
    }

}