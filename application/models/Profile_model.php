<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model
{
    public function rules()
    {
        $rules = array(
            array('field' => 'nama', 'label' => 'Nama', 'rules' => 'required'),
            array('field' => 'alamat', 'label' => 'Alamat', 'rules' => 'required'),);

        return $rules;
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_pegawai = $this->session->userdata('id_pegawai');
        $this->nama_pegawai = $post['nama'];
        $this->alamat_pegawai = $post['alamat'];
        
        $dt_pegawai = array(
            'nama_pegawai' => $this->nama_pegawai,
            'alamat_pegawai' => $this->alamat_pegawai,
            'update_pegawai' => date('Y-m-d H:i:s'),
        );
        
        $this->db->update('tbl_pegawai',$dt_pegawai, array('id_pegawai' => $this->id_pegawai));
        
        $this->id_petugas = $this->session->userdata('id_petugas');
        if($post['password'] != ''){
            
            $dt_petugas = array(
                'password_petugas' => password_hash($post['password'], PASSWORD_DEFAULT),
                'update_petugas' => date('Y-m-d H:i:s'),
            );

            $this->db->update('tbl_petugas',$dt_petugas, array('id_petugas' => $this->id_petugas));
        } 
        $this->session->set_userdata($dt_pegawai);
        $this->session->set_userdata($dt_petugas);
    }
}