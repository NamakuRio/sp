<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->auth_model->cek_login('masuk');
        $this->auth_model->role_admin();
        $this->load->model('inventaris_model');
        $this->load->model('jenis_model');
        $this->load->model('ruang_model');
	}

    public function index()
    {
        $this->load->view('dashboard/inventaris/list');
    }

    public function tambah()
    {
        $inventaris = $this->inventaris_model;
        $validation = $this->form_validation;
        $validation->set_rules($inventaris->rules());

        if ($validation->run()) {
            $inventaris->save();
            $this->session->set_flashdata('success', 'inventaris berhasil ditambahkan');       
            redirect(site_url('inventaris'));
        }
        $data['kd_inventaris'] = $this->inventaris_model->kode_urut();
        $data['list_jenis'] = $this->jenis_model->getListJenis();
        $data['list_ruang'] = $this->ruang_model->getListRuang();

        $this->load->view("dashboard/inventaris/tambah", $data);
    }

    public function edit($id=null)
    {
        if (!isset($id)) redirect('inventaris');

        $inventaris = $this->inventaris_model;
        $validation = $this->form_validation;
        $validation->set_rules($inventaris->rules());

        if ($validation->run()) {
            $inventaris->update();
            $this->session->set_flashdata('success', 'inventaris berhasil diupdate');
            redirect(site_url('inventaris'));
        }

        $data["inventaris"] = $inventaris->getById($id)->row();
        $data['list_jenis'] = $this->jenis_model->getListJenis();
        $data['list_ruang'] = $this->ruang_model->getListRuang();
        if (!$data["inventaris"]) show_404();
        
        $this->load->view("dashboard/inventaris/edit", $data);

    }
    
    public function hapus($id=null)
    {
        if(!isset($id)) show_404();

        if($this->inventaris_model->delete($id)){
            $this->session->set_flashdata('success', 'inventaris berhasil dihapus');
            redirect(site_url('inventaris'));
        }
    }
    
    public function getInventaris()
    {
        header('Content-Type: application/json');
        return print_r($this->inventaris_model->getInventaris());
    }

    public function getStokGudang()
    {
        header('Content-Type: application/json');
        return print_r($this->inventaris_model->getStokGudang());
    }
    
}