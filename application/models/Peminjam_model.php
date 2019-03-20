<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjam_model extends CI_Model
{
    public function rules($opsi=null)
    {
        if($opsi == 'edit'){
            $rules = array(
                array('field' => 'username_petugas', 'label' => 'Username', 'rules' => 'required'),            );
        } else {
            $rules = array(
                array('field' => 'username_petugas', 'label' => 'Username', 'rules' => 'required'),
                array('field' => 'password_petugas', 'label' => 'Password', 'rules' => 'required'),
                array('field' => 'pegawai', 'label' => 'Pegawai', 'rules' => 'required'),);
        }

        return $rules;
    }
    
    public function getPeminjam()
    {
        $this->datatables->select('tbl_petugas.id_petugas,tbl_pegawai.id_pegawai,tbl_petugas.username_petugas,tbl_level.nama_level,tbl_pegawai.nama_pegawai,tbl_pegawai.nip_pegawai,tbl_pegawai.alamat_pegawai');
        $this->datatables->join('tbl_level','tbl_petugas.id_level=tbl_level.id_level');
        $this->datatables->join('tbl_pegawai','tbl_petugas.id_pegawai=tbl_pegawai.id_pegawai');
        $this->datatables->from('tbl_petugas');
        $this->datatables->where('deleted_petugas',0);
        $this->datatables->where('nama_level', 'Peminjam');
        $this->datatables->add_column('action','
        <a href="'.site_url('users/peminjam/detail/').'$1" class="btn btn-success"><i class="fas fa-eye"></i></a>
        <a href="'.site_url('users/peminjam/edit/').'$1" class="btn btn-info"><i class="fas fa-edit"></i></a>
        <a href="javascript:void(0)" onclick="deleteConfirm(\''.site_url('users/peminjam/hapus/').'$1\')" class="btn btn-danger"><i class="fas fa-trash"></i></a>',
        'id_petugas');
        $this->datatables->edit_column('nama_pegawai',nl2br(htmlspecialchars('$1')),'nama_pegawai');
        $this->datatables->edit_column('nip_pegawai',nl2br(htmlspecialchars('$1')),'nip_pegawai');
        $this->datatables->edit_column('alamat_pegawai',nl2br(htmlspecialchars('$1')),'alamat_pegawai');
        $this->datatables->edit_column('username_petugas',nl2br(htmlspecialchars('$1')),'username_petugas');

        return $this->datatables->generate();
    }

    public function getDetailPinjam($id=null)
    {
        $this->datatables->select('tbl_peminjaman.id_peminjaman,tbl_pegawai.nama_pegawai,tbl_inventaris.nama_inventaris,tbl_peminjaman.tanggal_pinjam,tbl_peminjaman.tanggal_kembali,tbl_detail_pinjam.jumlah_detail_pinjam,tbl_peminjaman.id_status_peminjaman,tbl_status_peminjaman.nama_status_peminjaman');
        $this->datatables->join('tbl_detail_pinjam','tbl_detail_pinjam.id_peminjaman=tbl_peminjaman.id_peminjaman','left');
        $this->datatables->join('tbl_inventaris','tbl_detail_pinjam.id_inventaris=tbl_inventaris.id_inventaris','left');
        $this->datatables->join('tbl_pegawai','tbl_peminjaman.id_pegawai=tbl_pegawai.id_pegawai','left');
        $this->datatables->join('tbl_petugas','tbl_pegawai.id_pegawai=tbl_petugas.id_pegawai','left');
        $this->datatables->join('tbl_status_peminjaman','tbl_peminjaman.id_status_peminjaman=tbl_status_peminjaman.id_status_peminjaman','left');
        $this->datatables->from('tbl_peminjaman');
        $this->datatables->where('tbl_petugas.id_petugas',$id);
        // $this->datatables->where('nama_level', 'Peminjam');
        // $this->datatables->add_column('action','
        // <a href="'.site_url('users/peminjam/detail/').'$1" class="btn btn-success"><i class="fas fa-eye"></i></a>
        // <a href="'.site_url('users/peminjam/edit/').'$1" class="btn btn-info"><i class="fas fa-edit"></i></a>
        // <a href="javascript:void(0)" onclick="deleteConfirm(\''.site_url('users/peminjam/hapus/').'$1\')" class="btn btn-danger"><i class="fas fa-trash"></i></a>',
        // 'id_petugas');
        // $this->datatables->edit_column('nama_pegawai',nl2br(htmlspecialchars('$1')),'nama_pegawai');
        // $this->datatables->edit_column('nip_pegawai',nl2br(htmlspecialchars('$1')),'nip_pegawai');
        // $this->datatables->edit_column('alamat_pegawai',nl2br(htmlspecialchars('$1')),'alamat_pegawai');
        // $this->datatables->edit_column('username_petugas',nl2br(htmlspecialchars('$1')),'username_petugas');

        return $this->datatables->generate();
    }

    public function getById($id)
    {
        $this->db->join('tbl_pegawai','tbl_petugas.id_pegawai=tbl_pegawai.id_pegawai');
        return $this->db->get_where('tbl_petugas', ["id_petugas" => $id]);
    }

    public function count($opsi,$id)
    {

        if($opsi == 'total_sedang_dipinjam'){
            $this->db->where('id_status_peminjaman',1);
            $this->db->join('tbl_petugas','tbl_petugas.id_petugas='.$id);
            $this->db->join('tbl_pegawai','tbl_pegawai.id_pegawai=tbl_petugas.id_petugas');
            $this->db->where('tbl_pegawai.id_pegawai',$id);
            $query = $this->db->get('tbl_peminjaman');
        } else if ($opsi == 'total_peminjaman'){
            $this->db->join('tbl_petugas','tbl_petugas.id_petugas='.$id);
            $this->db->join('tbl_pegawai','tbl_pegawai.id_pegawai=tbl_petugas.id_petugas');
            $this->db->where('tbl_pegawai.id_pegawai',$id);
            $query = $this->db->get('tbl_peminjaman');
        }
    
        return $query->num_rows();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->username_petugas = nl2br(htmlspecialchars($post["username_petugas"]));
        $this->password_petugas = password_hash($post["password_petugas"],PASSWORD_DEFAULT);
        $this->id_pegawai = $post["pegawai"];
        // $this->id_level = $post["level"];

        $dt_petugas = array(
            'username_petugas' => $this->username_petugas,
            'password_petugas' => $this->password_petugas,
            'id_level' => 3,
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
        // $this->id_level = $post["level"];

        if($post['password_petugas'] == ''){
            $dt_petugas = array(
                'username_petugas' => $this->username_petugas,
                'id_level' => 3,
                'update_petugas' => date('Y:m:d H:i:s'),
            );
        } else {
            $dt_petugas = array(
                'username_petugas' => $this->username_petugas,
                'password_petugas' => password_hash($post['password_petugas'],PASSWORD_DEFAULT),
                'id_level' => 3,
                'update_petugas' => date('Y:m:d H:i:s'),
            );
        }

        $this->db->update('tbl_petugas', $dt_petugas, array('id_petugas' => $this->id_petugas));
    }

    public function delete($id)
    {
        if($id == 'all'){
            return $this->db->delete('tbl_petugas', array("id_level" => 3));
        } else {
            return $this->db->delete('tbl_petugas', array("id_petugas" => $id));
        }
    }
}