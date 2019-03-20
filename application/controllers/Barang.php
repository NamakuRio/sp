<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->auth_model->cek_login('masuk');
        $this->load->model('barang_model');
        $this->load->model('peminjam_model');
	}

    public function index()
    {
        if($this->session->userdata('nama_level') == 'Peminjam'){
            $peminjam = $this->peminjam_model;

            $data['total_sedang_dipinjam'] = $peminjam->count('total_sedang_dipinjam',$this->session->userdata('id_petugas'));
            $data['total_peminjaman'] = $peminjam->count('total_peminjaman',$this->session->userdata('id_petugas'));
            
            $this->load->view('dashboard/users/peminjam/detail',$data);
        } else {
            $data['total_sedang_dipinjam'] = $this->barang_model->count('total_sedang_dipinjam');
            $data['total_barang_di_gudang'] = $this->barang_model->count('total_barang_di_gudang');
            $data['total_barang'] = $this->barang_model->count('total_barang');
            $data['list_status_peminjaman'] = $this->auth_model->getListStatusPeminjaman();
            
            $this->load->view('dashboard/barang/list',$data);
        }
    }

    public function tambah()
    {
        if($this->session->userdata('nama_level') == 'Peminjam'){
            $this->auth_model->role_admin();
        }
        $barang = $this->barang_model;
        $validation = $this->form_validation;
        $validation->set_rules($barang->rules());

        if ($validation->run()) {
            $barang->save();
            $this->session->set_flashdata('success', 'Barang berhasil ditambahkan');       
            redirect(site_url('barang'));
        }

        $data['list_peminjam'] = $this->barang_model->getListPeminjam();
        $data['list_inventaris'] = $this->barang_model->getListInventaris();

        $this->load->view("dashboard/barang/tambah",$data);
    }

    public function edit($id=null)
    {
        if($this->session->userdata('nama_level') == 'Peminjam'){
            $this->auth_model->role_admin();
        }
        if (!isset($id)) redirect('barang');
        
        $barang = $this->barang_model;
        $validation = $this->form_validation;

        if($id == 'status_peminjaman'){
            $validation->set_rules($barang->rules('status_peminjaman'));
            
            if ($validation->run()) {
                $barang->update('status_peminjaman');
                $this->session->set_flashdata('success', 'Status Peminjaman Barang berhasil diupdate');
                redirect(site_url('barang'));
            }
        } else {

            $validation->set_rules($barang->rules());
            
            if ($validation->run()) {
                $barang->update();
                $this->session->set_flashdata('success', 'Barang berhasil diupdate');
                redirect(site_url('barang'));
            }
            
            $data["barang"] = $barang->getById($id)->row();
            $data['list_jenis'] = $this->jenis_model->getListJenis();
            $data['list_ruang'] = $this->ruang_model->getListRuang();
            if (!$data["barang"]) show_404();
            
            $this->load->view("dashboard/barang/edit", $data);
            
        }
    }
    
    public function hapus($id=null)
    {
        if($this->session->userdata('nama_level') == 'Peminjam'){
            $this->auth_model->role_admin();
        }
        if(!isset($id)) show_404();

        if($this->barang_model->delete($id)){
            $this->session->set_flashdata('success', 'Barang berhasil dihapus');
            redirect(site_url('barang'));
        }
    }
    
    public function getPeminjaman()
    {
        header('Content-Type: application/json');
        return print_r($this->barang_model->getPeminjaman());
    }
    
    public function getHistoryPeminjaman()
    {
        header('Content-Type: application/json');
        return print_r($this->barang_model->getHistoryPeminjaman());
    }
    
    public function getMaxJumlah($id_inventaris)
    {
        return print_r($this->barang_model->getMaxJumlah($id_inventaris));
    }

    public function getDetailPinjam($id=null)
    {
        header('Content-Type: application/json');
        return print_r($this->barang_model->getDetailPinjam($id));
    }
}