<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function rules()
    {
        $rules = array(
            array('field' => 'username_petugas', 'label' => 'Username', 'rules' => 'required'),
            array('field' => 'password_petugas', 'label' => 'Password', 'rules' => 'required'),);

        return $rules;
    }

    public function getListLevel()
    {
        $this->db->select('id_level,nama_level');
        $query = $this->db->get('tbl_level');
        return $query->result();
    }

    public function getListStatusPeminjaman()
    {
        $this->db->select('id_status_peminjaman,nama_status_peminjaman');
        $query = $this->db->get('tbl_status_peminjaman');
        return $query->result();
    }

    public function login()
    {
        $post = $this->input->post();
        $this->username_petugas = $post['username_petugas'];
        $this->password_petugas = $post['password_petugas'];
        
        $this->db->where('username_petugas',$this->username_petugas);
        $this->db->join('tbl_level','tbl_petugas.id_level = tbl_level.id_level');
        $this->db->join('tbl_pegawai','tbl_petugas.id_pegawai = tbl_pegawai.id_pegawai');

        $query = $this->db->get('tbl_petugas');
        $result = $query->row_array();

        if(password_verify($this->password_petugas, $result['password_petugas'])){
            return $result;
        } else {
            return array();
        }
    }
    
    public function cek_login($opsi){
        if($opsi == "login")
        {
            if($this->session->userdata('username_petugas'))
            {
                redirect(site_url('dashboard'));
            }
        }
        else if($opsi == "masuk")
        {
            if(!$this->session->userdata('username_petugas')){
                redirect(site_url('login'));
            }
        }
    }
    
    public function role_admin(){
        if($this->session->userdata('nama_level') != 'Admin'){
            redirect(site_url('forbidden'));
        }
        return;
    }
    
    public function role_operator(){
        if($this->session->userdata('nama_level') != 'Operator'){
            redirect(site_url('forbidden'));
        }
        return;
    }

    public function role_peminjam(){
        if($this->session->userdata('nama_level') != 'Peminjam'){
            redirect(site_url('forbidden'));
        }
        return;
    }

}