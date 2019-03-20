<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->auth_model->cek_login('masuk');
        $this->auth_model->role_admin();
        $this->load->model('jenis_model');
	}

    public function index()
    {
        $this->load->view('dashboard/data/jenis/list');
    }
        
    public function tambah()
    {
        $jenis = $this->jenis_model;
        $validation = $this->form_validation;
        $validation->set_rules($jenis->rules());

        if ($validation->run()) {
            $jenis->save();
            $this->session->set_flashdata('success', 'Jenis berhasil ditambahkan');       
            redirect(site_url('data/jenis'));
        }
        $data['kd_jenis'] = $this->jenis_model->kode_urut();

        $this->load->view("dashboard/data/jenis/tambah", $data);
    }

    public function edit($id=null)
    {
        if (!isset($id)) redirect('data/jenis');

        $jenis = $this->jenis_model;
        $validation = $this->form_validation;
        $validation->set_rules($jenis->rules());

        if ($validation->run()) {
            $jenis->update();
            $this->session->set_flashdata('success', 'Jenis berhasil diupdate');
            redirect(site_url('data/jenis'));
        }

        $data["jenis"] = $jenis->getById($id)->row();
        if (!$data["jenis"]) show_404();
        
        $this->load->view("dashboard/data/jenis/edit", $data);

    }
    
    public function hapus($id=null)
    {
        if(!isset($id)) show_404();

        if($this->jenis_model->delete($id)){
            $this->session->set_flashdata('success', 'Jenis berhasil dihapus');
            redirect(site_url('data/jenis'));
        }
    }

    public function getJenis()
    {
        header('Content-Type: application/json');
        return print_r($this->jenis_model->getJenis());
    }
    
}