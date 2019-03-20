<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->auth_model->cek_login('masuk');
        $this->auth_model->role_admin();
        $this->load->model('petugas_model');
        $this->load->model('pegawai_model');
	}

    public function index()
    {
        $this->load->view('dashboard/users/petugas/list');
    }
    
    public function tambah()
    {
        $petugas = $this->petugas_model;
        $validation = $this->form_validation;
        $validation->set_rules($petugas->rules());

        if ($validation->run()) {
            $petugas->save();
            $this->session->set_flashdata('success', 'Petugas berhasil ditambahkan');       
            redirect(site_url('users/petugas'));
        }

        $data['list_pegawai'] = $this->pegawai_model->getListPegawai();
        $data['list_level'] = $this->auth_model->getListLevel();

        $this->load->view("dashboard/users/petugas/tambah",$data);
    }

    public function edit($id=null)
    {
        if (!isset($id)) redirect('petugas');

        $petugas = $this->petugas_model;
        $validation = $this->form_validation;
        $validation->set_rules($petugas->rules('edit'));

        if ($validation->run()) {
            $petugas->update();
            $this->session->set_flashdata('success', 'Petugas berhasil diupdate');
            redirect(site_url('users/petugas'));
        }

        $data["petugas"] = $petugas->getById($id)->row();
        $data['list_level'] = $this->auth_model->getListLevel();
        if (!$data["petugas"]) show_404();
        
        $this->load->view("dashboard/users/petugas/edit", $data);

    }
    
    public function hapus($id=null)
    {
        if(!isset($id)) show_404();

        if($this->petugas_model->delete($id)){
            $this->session->set_flashdata('success', 'Petugas berhasil dihapus');
            redirect(site_url('users/petugas'));
        }
    }

    public function getPetugas()
    {
        header('Content-Type: application/json');
        return print_r($this->petugas_model->getPetugas());
    }
}