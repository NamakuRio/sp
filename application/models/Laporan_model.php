<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    public function getLaporan($menu)
    {
        if($menu == 'pegawai'){
            $result = $this->getPegawai();
        } else if($menu == 'jenis'){
            $result = $this->getJenis();
        } else if($menu == 'ruang'){
            $result = $this->getRuang();
        } else if($menu == 'peminjam'){
            $result = $this->getPeminjam();
        } else if($menu == 'petugas'){
            $result = $this->getPetugas();
        } else if($menu == 'inventaris'){
            $result = $this->getInventaris();
        } else if($menu == 'peminjaman'){
            $result = $this->getPeminjaman();
        } else if($menu == 'pengeluaran'){
            $result = $this->getPengeluaran();
        } else if($menu == 'history_barang'){
            $result = $this->getHistoryBarang();
        } 


         return $result;
    }

    public function getPegawai($awal=null,$akhir=null)
    {
        $this->datatables->select('id_pegawai,nama_pegawai,nip_pegawai,alamat_pegawai');
        $this->datatables->from('tbl_pegawai');
        $this->datatables->where('deleted_pegawai',0);
        $this->datatables->add_column('action','
        <a href="'.site_url('users/pegawai/edit/').'$1" class="btn btn-info"><i class="fas fa-edit"></i></a>
        <a href="javascript:void(0)" onclick="deleteConfirm(\''.site_url('users/pegawai/hapus/').'$1\')" class="btn btn-danger"><i class="fas fa-trash"></i></a>',
        'id_pegawai,nama_pegawai,nip_pegawai,alamat_pegawai');
        $this->datatables->edit_column('nama_pegawai',nl2br(htmlspecialchars('$1')),'nama_pegawai');
        $this->datatables->edit_column('nip_pegawai',nl2br(htmlspecialchars('$1')),'nip_pegawai');
        $this->datatables->edit_column('alamat_pegawai',nl2br(htmlspecialchars('$1')),'alamat_pegawai');

        return $this->datatables->generate();
    }

    public function getRuang()
    {
        $this->datatables->select('id_ruang,nama_ruang,kode_ruang,keterangan_ruang');
        $this->datatables->from('tbl_ruang');
        $this->datatables->where('deleted_ruang',0);
        $this->datatables->edit_column('nama_ruang',nl2br(htmlspecialchars('$1')),'nama_ruang');
        $this->datatables->edit_column('keterangan_ruang',nl2br(htmlspecialchars('$1')),'keterangan_ruang');

        return $this->datatables->generate();
    }
    
    public function getJenis()
    {
        $this->datatables->select('id_jenis,nama_jenis,kode_jenis,keterangan_jenis');
        $this->datatables->from('tbl_jenis');
        $this->datatables->where('deleted_jenis',0);
        $this->datatables->edit_column('nama_jenis',nl2br(htmlspecialchars('$1')),'nama_jenis');
        $this->datatables->edit_column('keterangan_jenis',nl2br(htmlspecialchars('$1')),'keterangan_jenis');

        return $this->datatables->generate();
    }
    
    public function getPeminjam()
    {
        $this->datatables->select('id_petugas,nama_pegawai,nip_pegawai,alamat_pegawai,username_petugas,nama_level');
        $this->datatables->join('tbl_level','tbl_petugas.id_level=tbl_level.id_level');
        $this->datatables->join('tbl_pegawai','tbl_petugas.id_pegawai=tbl_pegawai.id_pegawai');
        $this->datatables->from('tbl_petugas');
        $this->datatables->where('deleted_petugas',0);
        $this->datatables->where('tbl_level.id_level',3);
        $this->datatables->edit_column('nama_pegawai',nl2br(htmlspecialchars('$1')),'nama_pegawai');
        $this->datatables->edit_column('alamat_pegawai',nl2br(htmlspecialchars('$1')),'alamat_pegawai');

        return $this->datatables->generate();
    }
    
    public function getPetugas()
    {
        $this->datatables->select('id_petugas,nama_pegawai,nip_pegawai,alamat_pegawai,username_petugas,nama_level');
        $this->datatables->join('tbl_level','tbl_petugas.id_level=tbl_level.id_level');
        $this->datatables->join('tbl_pegawai','tbl_petugas.id_pegawai=tbl_pegawai.id_pegawai');
        $this->datatables->from('tbl_petugas');
        $this->datatables->where('deleted_petugas',0);
        $this->datatables->where('tbl_level.id_level != 3');
        $this->datatables->edit_column('nama_pegawai',nl2br(htmlspecialchars('$1')),'nama_pegawai');
        $this->datatables->edit_column('alamat_pegawai',nl2br(htmlspecialchars('$1')),'alamat_pegawai');

        return $this->datatables->generate();
    }

    public function getInventaris()
    {
        $this->datatables->select('id_inventaris,nama_inventaris,kondisi_inventaris,keterangan_inventaris,jumlah_inventaris,nama_jenis,tanggal_register,nama_ruang,kode_inventaris,nama_pegawai');
        $this->datatables->join('tbl_jenis','tbl_inventaris.id_jenis=tbl_jenis.id_jenis');
        $this->datatables->join('tbl_ruang','tbl_inventaris.id_ruang=tbl_ruang.id_ruang');
        $this->datatables->join('tbl_petugas','tbl_inventaris.id_petugas=tbl_petugas.id_petugas');
        $this->datatables->join('tbl_pegawai','tbl_petugas.id_pegawai=tbl_pegawai.id_pegawai');
        $this->datatables->from('tbl_inventaris');
        $this->datatables->where('deleted_inventaris',0);
        // $this->datatables->edit_column('nama_pegawai',nl2br(htmlspecialchars('$1')),'nama_pegawai');
        // $this->datatables->edit_column('alamat_pegawai',nl2br(htmlspecialchars('$1')),'alamat_pegawai');

        return $this->datatables->generate();
    }

    public function getPeminjaman()
    {
        $this->datatables->select('tbl_peminjaman.id_peminjaman,nama_pegawai,nama_inventaris,jumlah_detail_pinjam,tanggal_pinjam,tanggal_kembali,tbl_peminjaman.id_status_peminjaman,tbl_status_peminjaman.nama_status_peminjaman');
        $this->datatables->join('tbl_detail_pinjam','tbl_peminjaman.id_peminjaman=tbl_detail_pinjam.id_peminjaman');
        $this->datatables->join('tbl_inventaris','tbl_detail_pinjam.id_inventaris=tbl_inventaris.id_inventaris');
        $this->datatables->join('tbl_pegawai','tbl_peminjaman.id_pegawai=tbl_pegawai.id_pegawai');
        $this->datatables->join('tbl_status_peminjaman','tbl_peminjaman.id_status_peminjaman=tbl_status_peminjaman.id_status_peminjaman');
        // $this->datatables->join('tbl_pegawai','tbl_petugas.id_pegawai=tbl_pegawai.id_pegawai');
        $this->datatables->from('tbl_peminjaman');
        $this->datatables->where('deleted_peminjaman',0);
        // $this->datatables->edit_column('nama_pegawai',nl2br(htmlspecialchars('$1')),'nama_pegawai');
        // $this->datatables->edit_column('alamat_pegawai',nl2br(htmlspecialchars('$1')),'alamat_pegawai');

        return $this->datatables->generate();
    }

    public function getPengeluaran()
    {

    }

    public function getHistoryBarang()
    {

    }

    public function createLaporan($menu,$tipe)
    {
        if($menu == 'ruang'){
            $laporan = $this->generateRuang($tipe);
        } else if($menu == 'jenis') {
            $laporan = $this->generateJenis($tipe);
        } else if($menu == 'pegawai') {
            $laporan = $this->generatePegawai($tipe);
        } else if($menu == 'peminjam') {
            $laporan = $this->generatePeminjam($tipe);
        } else if($menu == 'petugas') {
            $laporan = $this->generatePetugas($tipe);
        } else if($menu == 'inventaris') {
            $laporan = $this->generateInventaris($tipe);
        } else if($menu == 'peminjaman') {
            $laporan = $this->generatePeminjaman($tipe);
        } else if($menu == 'pengeluaran') {
            $laporan = $this->generatePengeluaran($tipe);
        } else if($menu == 'history_barang') {
            $laporan = $this->generateHistoryBarang($tipe);
        }

        return $laporan;
    }

    public function generateRuang($tipe)
    {
        if($tipe == 'excel'){
            $result = $this->db->get('tbl_ruang')->result_array();
        } else if ($tipe == 'pdf'){
            $result = $this->db->get('tbl_ruang')->result_array();
        }

        return $result;
    }
    
    public function generateJenis($tipe)
    {
        if($tipe == 'excel'){
            $result = $this->db->get('tbl_jenis')->result_array();
        } else if ($tipe == 'pdf'){
            $result = $this->db->get('tbl_jenis')->result_array();
        }

        return $result;
    }

    public function generatePegawai($tipe)
    {
        if($tipe == 'excel'){
            $result = $this->db->get('tbl_pegawai')->result_array();
        } else if ($tipe == 'pdf'){
            $result = $this->db->get('tbl_pegawai')->result_array();
        }

        return $result;
    }

    public function generatePeminjam($tipe)
    {
        if($tipe == 'excel'){
            $this->db->select('id_petugas,nama_pegawai,nip_pegawai,alamat_pegawai,username_petugas,nama_level,created_petugas,update_petugas,deleted_petugas');
            $this->db->join('tbl_level','tbl_petugas.id_level=tbl_level.id_level');
            $this->db->join('tbl_pegawai','tbl_petugas.id_pegawai=tbl_pegawai.id_pegawai');
            $this->db->where('tbl_level.id_level',3);
            $result = $this->db->get('tbl_petugas')->result_array();
        } else if ($tipe == 'pdf'){
            $this->db->select('id_petugas,nama_pegawai,nip_pegawai,alamat_pegawai,username_petugas,nama_level,created_petugas,update_petugas,deleted_petugas');
            $this->db->join('tbl_level','tbl_petugas.id_level=tbl_level.id_level');
            $this->db->join('tbl_pegawai','tbl_petugas.id_pegawai=tbl_pegawai.id_pegawai');
            $this->db->where('tbl_level.id_level',3);
            $result = $this->db->get('tbl_petugas')->result_array();
        }

        return $result;
    }

    public function generatePetugas($tipe)
    {
        if($tipe == 'excel'){
            $this->db->select('tbl_petugas.*,tbl_pegawai.*,tbl_level.*');
            $this->db->where('tbl_petugas.id_level != 3');
            $this->db->join('tbl_pegawai','tbl_petugas.id_pegawai=tbl_pegawai.id_pegawai');
            $this->db->join('tbl_level','tbl_petugas.id_level=tbl_level.id_level');
            $result = $this->db->get('tbl_petugas')->result_array();
        } else if ($tipe == 'pdf'){
            $this->db->select('tbl_petugas.*,tbl_pegawai.*,tbl_level.*');
            $this->db->where('tbl_petugas.id_level != 3');
            $this->db->join('tbl_pegawai','tbl_petugas.id_pegawai=tbl_pegawai.id_pegawai');
            $this->db->join('tbl_level','tbl_petugas.id_level=tbl_level.id_level');
            $result = $this->db->get('tbl_petugas')->result_array();
        }

        return $result;
    }

    public function generateInventaris($tipe)
    {
        if($tipe == 'excel'){
            $this->db->select('tbl_inventaris.*,tbl_jenis.*,tbl_ruang.*,tbl_petugas.*,tbl_pegawai.*');
            $this->db->join('tbl_jenis','tbl_inventaris.id_jenis=tbl_jenis.id_jenis');
            $this->db->join('tbl_ruang','tbl_inventaris.id_ruang=tbl_ruang.id_ruang');
            $this->db->join('tbl_petugas','tbl_inventaris.id_petugas=tbl_petugas.id_petugas');
            $this->db->join('tbl_pegawai','tbl_petugas.id_pegawai=tbl_pegawai.id_pegawai');
            $result = $this->db->get('tbl_inventaris')->result_array();
        } else if ($tipe == 'pdf'){
            $this->db->select('tbl_inventaris.*,tbl_jenis.*,tbl_ruang.*,tbl_petugas.*,tbl_pegawai.*');
            $this->db->join('tbl_jenis','tbl_inventaris.id_jenis=tbl_jenis.id_jenis');
            $this->db->join('tbl_ruang','tbl_inventaris.id_ruang=tbl_ruang.id_ruang');
            $this->db->join('tbl_petugas','tbl_inventaris.id_petugas=tbl_petugas.id_petugas');
            $this->db->join('tbl_pegawai','tbl_petugas.id_pegawai=tbl_pegawai.id_pegawai');
            $result = $this->db->get('tbl_inventaris')->result_array();
        } 

        return $result;
    }

    public function generatePeminjaman($tipe)
    {
        if($tipe == 'excel'){
            $this->db->select('tbl_peminjaman.*,tbl_detail_pinjam.*,tbl_inventaris.*,tbl_petugas.*,tbl_pegawai.*,tbl_status_peminjaman.*');
            $this->db->join('tbl_detail_pinjam','tbl_peminjaman.id_peminjaman=tbl_detail_pinjam.id_peminjaman');
            $this->db->join('tbl_inventaris','tbl_detail_pinjam.id_inventaris=tbl_inventaris.id_inventaris');
            $this->db->join('tbl_pegawai','tbl_peminjaman.id_pegawai=tbl_pegawai.id_pegawai');
            $this->db->join('tbl_petugas','tbl_pegawai.id_pegawai=tbl_petugas.id_pegawai');
            $this->db->join('tbl_status_peminjaman','tbl_peminjaman.id_status_peminjaman=tbl_status_peminjaman.id_status_peminjaman');
            $result = $this->db->get('tbl_peminjaman')->result_array();
        } else if ($tipe == 'pdf'){
            $this->db->select('tbl_peminjaman.*,tbl_detail_pinjam.*,tbl_inventaris.*,tbl_petugas.*,tbl_pegawai.*,tbl_status_peminjaman.*');
            $this->db->join('tbl_detail_pinjam','tbl_peminjaman.id_peminjaman=tbl_detail_pinjam.id_peminjaman');
            $this->db->join('tbl_inventaris','tbl_detail_pinjam.id_inventaris=tbl_inventaris.id_inventaris');
            $this->db->join('tbl_pegawai','tbl_peminjaman.id_pegawai=tbl_pegawai.id_pegawai');
            $this->db->join('tbl_petugas','tbl_pegawai.id_pegawai=tbl_petugas.id_pegawai');
            $this->db->join('tbl_status_peminjaman','tbl_peminjaman.id_status_peminjaman=tbl_status_peminjaman.id_status_peminjaman');
            $result = $this->db->get('tbl_peminjaman')->result_array();
        }

        return $result;
    }

    public function generatePengeluaran($tipe)
    {
        if($tipe == 'excel'){

        } else if ($tipe == 'pdf'){

        }
    }

    public function generateHistoryBarang($tipe)
    {
        if($tipe == 'excel'){

        } else if ($tipe == 'pdf'){

        }
    }

}