<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->auth_model->cek_login('masuk');
        $this->auth_model->role_admin();
        $this->load->model('pegawai_model');
	}

    public function index()
    {
        $this->load->view('dashboard/users/pegawai/list');
    }

    public function tambah()
    {
        $pegawai = $this->pegawai_model;
        $validation = $this->form_validation;
        $validation->set_rules($pegawai->rules());

        if ($validation->run()) {
            $pegawai->save();
            $this->session->set_flashdata('success', 'Pegawai berhasil ditambahkan');       
            redirect(site_url('users/pegawai'));
        }

        $this->load->view("dashboard/users/pegawai/tambah");
    }

    public function edit($id=null)
    {
        if (!isset($id)) redirect('pegawai');

        $pegawai = $this->pegawai_model;
        $validation = $this->form_validation;
        $validation->set_rules($pegawai->rules());

        if ($validation->run()) {
            $pegawai->update();
            $this->session->set_flashdata('success', 'Pegawai berhasil diupdate');
            redirect(site_url('users/pegawai'));
        }

        $data["pegawai"] = $pegawai->getById($id)->row();
        if (!$data["pegawai"]) show_404();
        
        $this->load->view("dashboard/users/pegawai/edit", $data);

    }
    
    public function hapus($id=null)
    {
        if(!isset($id)) show_404();

        if($this->pegawai_model->delete($id)){
            $this->session->set_flashdata('success', 'Pegawai berhasil dihapus');
            redirect(site_url('users/pegawai'));
        }
    }

    public function getPegawai()
    {
        header('Content-Type: application/json');
        return print_r($this->pegawai_model->getPegawai());
    }

}