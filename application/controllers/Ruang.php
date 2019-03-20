<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ruang extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->auth_model->cek_login('masuk');
        $this->auth_model->role_admin();
        $this->load->model('ruang_model');
	}

    public function index()
    {
        $this->load->view('dashboard/data/ruang/list');
    }
        
    public function tambah()
    {
        $ruang = $this->ruang_model;
        $validation = $this->form_validation;
        $validation->set_rules($ruang->rules());

        if ($validation->run()) {
            $ruang->save();
            $this->session->set_flashdata('success', 'Ruang berhasil ditambahkan');       
            redirect(site_url('data/ruang'));
        }
        $data['kd_ruang'] = $this->ruang_model->kode_urut();

        $this->load->view("dashboard/data/ruang/tambah",$data);
    }

    public function edit($id=null)
    {
        if (!isset($id)) redirect('data/ruang');

        $ruang = $this->ruang_model;
        $validation = $this->form_validation;
        $validation->set_rules($ruang->rules());

        if ($validation->run()) {
            $ruang->update();
            $this->session->set_flashdata('success', 'Ruang berhasil diupdate');
            redirect(site_url('data/ruang'));
        }

        $data["ruang"] = $ruang->getById($id)->row();
        if (!$data["ruang"]) show_404();
        
        $this->load->view("dashboard/data/ruang/edit", $data);

    }
    
    public function hapus($id=null)
    {
        if(!isset($id)) show_404();

        if($this->ruang_model->delete($id)){
            $this->session->set_flashdata('success', 'Ruang berhasil dihapus');
            redirect(site_url('data/ruang'));
        }
    }

    public function getRuang()
    {
        header('Content-Type: application/json');
        return print_r($this->ruang_model->getRuang());
    }
    
}