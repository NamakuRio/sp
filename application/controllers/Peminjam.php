<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjam extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->auth_model->cek_login('masuk');
        $this->auth_model->role_admin();
        $this->load->model('peminjam_model');
        $this->load->model('pegawai_model');
	}

    public function index()
    {
        $this->load->view('dashboard/users/peminjam/list');
    }
    
    public function tambah()
    {
        $peminjam = $this->peminjam_model;
        $validation = $this->form_validation;
        $validation->set_rules($peminjam->rules());

        if ($validation->run()) {
            $peminjam->save();
            $this->session->set_flashdata('success', 'Peminjam berhasil ditambahkan');       
            redirect(site_url('users/peminjam'));
        }

        $data['list_pegawai'] = $this->pegawai_model->getListPegawai();
        $data['list_level'] = $this->auth_model->getListLevel();

        $this->load->view("dashboard/users/peminjam/tambah",$data);
    }

    public function detail($id=null)
    {
        if (!isset($id)) redirect('peminjam');

        $peminjam = $this->peminjam_model;
        $validation = $this->form_validation;
        $validation->set_rules($peminjam->rules('edit'));

        if ($validation->run()) {
            $peminjam->update();
            $this->session->set_flashdata('success', 'Peminjam berhasil diupdate');
            redirect(site_url('users/peminjam'));
        }
        $data['total_sedang_dipinjam'] = $peminjam->count('total_sedang_dipinjam',$id);
        $data['total_peminjaman'] = $peminjam->count('total_peminjaman',$id);
        $data["peminjam"] = $peminjam->getById($id)->row();
        $data['list_level'] = $this->auth_model->getListLevel();
        if (!$data["peminjam"]) show_404();
        
        $this->load->view("dashboard/users/peminjam/detail", $data);

    }

    public function edit($id=null)
    {
        if (!isset($id)) redirect('peminjam');

        $peminjam = $this->peminjam_model;
        $validation = $this->form_validation;
        $validation->set_rules($peminjam->rules('edit'));

        if ($validation->run()) {
            $peminjam->update();
            $this->session->set_flashdata('success', 'Peminjam berhasil diupdate');
            redirect(site_url('users/peminjam'));
        }

        $data["peminjam"] = $peminjam->getById($id)->row();
        $data['list_level'] = $this->auth_model->getListLevel();
        if (!$data["peminjam"]) show_404();
        
        $this->load->view("dashboard/users/peminjam/edit", $data);

    }
    
    public function hapus($id=null)
    {
        if(!isset($id)) show_404();

        if($this->peminjam_model->delete($id)){
            $this->session->set_flashdata('success', 'Peminjam berhasil dihapus');
            redirect(site_url('users/peminjam'));
        }
    }

    public function getPeminjam()
    {
        header('Content-Type: application/json');
        return print_r($this->peminjam_model->getPeminjam());
    }

    public function getDetailPinjam($id=null)
    {
        header('Content-Type: application/json');
        return print_r($this->peminjam_model->getDetailPinjam($id));
    }

}