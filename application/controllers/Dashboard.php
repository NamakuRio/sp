<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->auth_model->cek_login('masuk');
        $this->load->model('dashboard_model');
        $this->load->model('barang_model');
	}

    public function index()
    {
        $data['totalBarang'] = $this->barang_model->count('total_barang');
        $data['totalPeminjam'] = $this->dashboard_model->count('total_peminjam');
        $data['totalDigudang'] = $this->barang_model->count('total_barang_di_gudang');
        $data['totalDipinjam'] = $this->barang_model->count('total_sedang_dipinjam');

        $this->load->view('dashboard/dashboard', $data);
    }

}