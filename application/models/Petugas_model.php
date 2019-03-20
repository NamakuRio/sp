<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas_model extends CI_Model
{
    public function rules($opsi=null)
    {
        if($opsi == 'edit'){
            $rules = array(
                array('field' => 'username_petugas', 'label' => 'Username', 'rules' => 'required'),            
                array('field' => 'level', 'label' => 'Level', 'rules' => 'required'),);
        } else {
            $rules = array(
                array('field' => 'username_petugas', 'label' => 'Username', 'rules' => 'required'),
                array('field' => 'password_petugas', 'label' => 'Password', 'rules' => 'required'),
                array('field' => 'pegawai', 'label' => 'Pegawai', 'rules' => 'required'),
                array('field' => 'level', 'label' => 'Level', 'rules' => 'required'),);
        }

        return $rules;
    }

    public function getPetugas()
    {
        $this->datatables->select('tbl_petugas.id_petugas,tbl_petugas.username_petugas,tbl_level.nama_level,tbl_pegawai.nama_pegawai,tbl_pegawai.nip_pegawai,tbl_pegawai.alamat_pegawai');
        $this->datatables->join('tbl_level','tbl_petugas.id_level=tbl_level.id_level');
        $this->datatables->join('tbl_pegawai','tbl_petugas.id_pegawai=tbl_pegawai.id_pegawai');
        $this->datatables->from('tbl_petugas');
        $this->datatables->where('nama_level !=','Peminjam');
        // $this->datatables->where('deleted_petugas',0);
        $this->datatables->add_column('action','
        <a href="'.site_url('users/petugas/edit/').'$1" class="btn btn-info"><i class="fas fa-edit"></i></a>
        <a href="javascript:void(0)" onclick="deleteConfirm(\''.site_url('users/petugas/hapus/').'$1\')" class="btn btn-danger"><i class="fas fa-trash"></i></a>',
        'id_petugas');
        $this->datatables->edit_column('nama_pegawai',nl2br(htmlspecialchars('$1')),'nama_pegawai');
        $this->datatables->edit_column('nip_pegawai',nl2br(htmlspecialchars('$1')),'nip_pegawai');
        $this->datatables->edit_column('alamat_pegawai',nl2br(htmlspecialchars('$1')),'alamat_pegawai');
        $this->datatables->edit_column('username_petugas',nl2br(htmlspecialchars('$1')),'username_petugas');
        // $this->db->query('select tbl_inventaris.jumlah_inventaris, sum(tbl_detail_pinjam.jumlah_detail_pinjam) from tbl_inventaris,tbl_detail_pinjam,tbl_peminjaman WHERE tbl_inventaris.id_inventaris=tbl_detail_pinjam.id_inventaris AND tbl_peminjaman.id_peminjaman=tbl_detail_pinjam.id_detail_pinjam AND tbl_peminjaman.status_peminjaman="Sedang Dipinjam" GROUP BY tbl_inventaris.id_inventaris');
        

        return $this->datatables->generate();
    }

    public function getById($id)
    {
        return $this->db->get_where('tbl_petugas', ["id_petugas" => $id]);
    }

    public function save()
    {
        $post = $this->input->post();
        $this->username_petugas = nl2br(htmlspecialchars($post["username_petugas"]));
        $this->password_petugas = password_hash($post["password_petugas"],PASSWORD_DEFAULT);
        $this->id_pegawai = $post["pegawai"];
        $this->id_level = $post["level"];

        $dt_petugas = array(
            'username_petugas' => $this->username_petugas,
            'password_petugas' => $this->password_petugas,
            'id_level' => $this->id_level,
            'id_pegawai' => $this->id_pegawai,
            'created_petugas' => date('Y:m:d H:i:s'),
            'update_petugas' => date('Y:m:d H:i:s'),
            'deleted_petugas' => 0,
        );

        $this->db->insert('tbl_petugas', $dt_petugas);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_petugas = $post['id'];
        $this->username_petugas = nl2br(htmlspecialchars($post["username_petugas"]));
        $this->id_level = $post["level"];

        if($post['password_petugas'] == ''){
            $dt_petugas = array(
                'username_petugas' => $this->username_petugas,
                'id_level' => $this->id_level,
                'update_petugas' => date('Y:m:d H:i:s'),
            );
        } else {
            $dt_petugas = array(
                'username_petugas' => $this->username_petugas,
                'password_petugas' => password_hash($post['password_petugas'],PASSWORD_DEFAULT),
                'id_level' => $this->id_level,
                'update_petugas' => date('Y:m:d H:i:s'),
            );
        }

        $this->db->update('tbl_petugas', $dt_petugas, array('id_petugas' => $this->id_petugas));
    }

    public function delete($id)
    {
        if($id == 'all'){
            return $this->db->empty_table('tbl_petugas');    
        } else {
            return $this->db->delete('tbl_petugas', array("id_petugas" => $id));
        }
    }
}