<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris_model extends CI_Model
{
    public function rules($opsi=null)
    {
        if($opsi == 'g'){
            $rules = array(
                array('field' => 'nama_inventaris', 'label' => 'Nama', 'rules' => 'required'),
                array('field' => 'jumlah_inventaris', 'label' => 'Jumlah', 'rules' => 'required'),
                array('field' => 'jenis', 'label' => 'Jenis', 'rules' => 'required'),
                array('field' => 'ruang', 'label' => 'Ruang', 'rules' => 'required'),);
        } else {
            $rules = array(
                array('field' => 'nama_inventaris', 'label' => 'Nama', 'rules' => 'required'),
                array('field' => 'jumlah_inventaris', 'label' => 'Jumlah', 'rules' => 'required'),
                array('field' => 'jenis', 'label' => 'Jenis', 'rules' => 'required'),
                array('field' => 'ruang', 'label' => 'Ruang', 'rules' => 'required'),);
        }

        return $rules;
    }

    public function getInventaris()
    {
        $this->datatables->select('tbl_inventaris.id_inventaris,tbl_inventaris.nama_inventaris,tbl_inventaris.kondisi_inventaris,tbl_inventaris.keterangan_inventaris,tbl_inventaris.jumlah_inventaris,tbl_jenis.nama_jenis,tbl_inventaris.tanggal_register,tbl_ruang.nama_ruang,tbl_inventaris.kode_inventaris,tbl_pegawai.nama_pegawai');
        $this->datatables->join('tbl_jenis','tbl_inventaris.id_jenis=tbl_jenis.id_jenis');
        $this->datatables->join('tbl_ruang','tbl_inventaris.id_ruang=tbl_ruang.id_ruang');
        $this->datatables->join('tbl_petugas','tbl_inventaris.id_petugas=tbl_petugas.id_petugas');
        $this->datatables->join('tbl_pegawai','tbl_petugas.id_pegawai=tbl_pegawai.id_pegawai');
        $this->datatables->from('tbl_inventaris');
        $this->datatables->where('deleted_inventaris',0);
        $this->datatables->add_column('action','
        <a href="'.site_url('inventaris/edit/').'$1" class="btn btn-info"><i class="fas fa-edit"></i></a>
        <a href="javascript:void(0)" onclick="deleteConfirm(\''.site_url('inventaris/hapus/').'$1\')" class="btn btn-danger"><i class="fas fa-trash"></i></a>',
        'id_inventaris');

        return $this->datatables->generate();
    }
    
    public function getStokGudang()
    {
        $this->datatables->select('tbl_inventaris.id_inventaris,sum(tbl_detail_pinjam.jumlah_detail_pinjam) as jumlah_detail_pinjam,tbl_inventaris.jumlah_inventaris-sum(tbl_detail_pinjam.jumlah_detail_pinjam) as jumlah_digudang,tbl_inventaris.nama_inventaris,tbl_inventaris.jumlah_inventaris,tbl_jenis.nama_jenis,tbl_inventaris.tanggal_register,tbl_ruang.nama_ruang,tbl_inventaris.kode_inventaris,tbl_pegawai.nama_pegawai');
        $this->datatables->join('tbl_detail_pinjam','tbl_inventaris.id_inventaris=tbl_detail_pinjam.id_inventaris','LEFT');
        $this->datatables->join('tbl_peminjaman','tbl_detail_pinjam.id_detail_pinjam=tbl_peminjaman.id_peminjaman AND tbl_peminjaman.id_status_peminjaman=1','LEFT');
        $this->datatables->join('tbl_jenis','tbl_inventaris.id_jenis=tbl_jenis.id_jenis','LEFT');
        $this->datatables->join('tbl_ruang','tbl_inventaris.id_ruang=tbl_ruang.id_ruang','LEFT');
        $this->datatables->join('tbl_petugas','tbl_inventaris.id_petugas=tbl_petugas.id_petugas','LEFT');
        $this->datatables->join('tbl_pegawai','tbl_petugas.id_pegawai=tbl_pegawai.id_pegawai','LEFT');
        $this->datatables->from('tbl_inventaris');
        // $this->datatables->where('tbl_peminjaman.status_peminjaman','Sedang Dipinjam');
        $this->datatables->where('deleted_inventaris',0);
        $this->datatables->group_by('tbl_inventaris.id_inventaris');
        $this->datatables->add_column('action','
        <a href="'.site_url('inventaris/edit/').'$1" class="btn btn-info"><i class="fas fa-edit"></i></a>
        <a href="javascript:void(0)" onclick="deleteConfirm(\''.site_url('inventaris/hapus/').'$1\')" class="btn btn-danger"><i class="fas fa-trash"></i></a>',
        'id_inventaris');

        return $this->datatables->generate();
    }

    public function getById($id)
    {
        return $this->db->get_where('tbl_inventaris', ["id_inventaris" => $id]);
    }

    public function save()
    {
        $post = $this->input->post();
        $this->kode_inventaris = $this->kode_urut();
        $this->nama_inventaris = $post['nama_inventaris'];
        $this->kondisi_inventaris = $post['kondisi_inventaris'];
        $this->keterangan_inventaris = $post["keterangan_inventaris"];
        $this->jumlah_inventaris = $post["jumlah_inventaris"];
        $this->id_jenis = $post["jenis"];
        $this->tanggal_register = date('Y-m-d H:i:s');
        $this->id_ruang = $post["ruang"];
        $this->id_petugas = $this->session->userdata('id_petugas');

        $dt_inventaris = array(
            'kode_inventaris' => $this->kode_inventaris,
            'nama_inventaris' => $this->nama_inventaris,
            'kondisi_inventaris' => $this->kondisi_inventaris,
            'keterangan_inventaris' => $this->keterangan_inventaris,
            'jumlah_inventaris' => $this->jumlah_inventaris,
            'id_jenis' => $this->id_jenis,
            'tanggal_register' => $this->tanggal_register,
            'id_ruang' => $this->id_ruang,
            'id_petugas' => $this->id_petugas,
            'created_inventaris' => date('Y:m:d H:i:s'),
            'update_inventaris' => date('Y:m:d H:i:s'),
            'deleted_inventaris' => 0,
        );

        $this->db->insert('tbl_inventaris', $dt_inventaris);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_inventaris = $post['id'];
        $this->nama_inventaris = $post['nama_inventaris'];
        $this->kondisi_inventaris = $post['kondisi_inventaris'];
        $this->keterangan_inventaris = $post["keterangan_inventaris"];
        $this->jumlah_inventaris = $post["jumlah_inventaris"];
        $this->id_jenis = $post["jenis"];
        $this->id_ruang = $post["ruang"];

        $dt_inventaris = array(
            'nama_inventaris' => $this->nama_inventaris,
            'kondisi_inventaris' => $this->kondisi_inventaris,
            'keterangan_inventaris' => $this->keterangan_inventaris,
            'jumlah_inventaris' => $this->jumlah_inventaris,
            'id_jenis' => $this->id_jenis,
            'id_ruang' => $this->id_ruang,
            'update_inventaris' => date('Y:m:d H:i:s'),
        );

        $this->db->update('tbl_inventaris', $dt_inventaris, array('id_inventaris' => $this->id_inventaris));
    }

    public function delete($id)
    {
        if($id == 'all'){
            return $this->db->empty_table('tbl_inventaris');    
        } else {
            return $this->db->delete('tbl_inventaris', array("id_inventaris" => $id));
        }
    }

    public function kode_urut(){
        $this->db->select('RIGHT(tbl_inventaris.kode_inventaris,5) AS kd_inventaris',FALSE);
        $this->db->order_by('kode_inventaris','DESC');
        $this->db->limit(1);        
        $query = $this->db->get('tbl_inventaris');
        if($query->num_rows() <> 0){
            $data = $query->row();
            $kode = intval($data->kd_inventaris) + 1;
        } else {
            $kode = 1;
        }
        $output = "IV".str_pad($kode, 5, "0", STR_PAD_LEFT);

        return $output;
    } 
}