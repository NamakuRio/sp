<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    public function rules($opsi=null)
    {
        if($opsi == 'g'){
            $rules = array(
                array('field' => 'peminjam', 'label' => 'Peminjam', 'rules' => 'required'),
                array('field' => 'barang', 'label' => 'Barang', 'rules' => 'required'),
                array('field' => 'jumlah_pinjam', 'label' => 'Jumlah', 'rules' => 'required'),
                array('field' => 'tanggal_pinjam', 'label' => 'Tanggal', 'rules' => 'required'),);
        } else if($opsi == 'status_peminjaman'){
            $rules = array(
                array('field' => 'status_peminjaman', 'label' => 'Status Peminjaman', 'rules' => 'required'),
                array('field' => 'id', 'label' => 'Id', 'rules' => 'required'),
            );
        }else {
            $rules = array(
                array('field' => 'peminjam', 'label' => 'Peminjam', 'rules' => 'required'),
                array('field' => 'barang', 'label' => 'Barang', 'rules' => 'required'),
                array('field' => 'jumlah_pinjam', 'label' => 'Jumlah', 'rules' => 'required'),
                array('field' => 'tanggal_pinjam', 'label' => 'Tanggal', 'rules' => 'required'),);
        }

        return $rules;
    }

    public function getPeminjaman()
    {
        $this->datatables->select('tbl_peminjaman.id_peminjaman,tbl_peminjaman.tanggal_pinjam,tbl_peminjaman.tanggal_kembali,tbl_peminjaman.id_status_peminjaman,tbl_detail_pinjam.jumlah_detail_pinjam,tbl_pegawai.nama_pegawai,tbl_inventaris.nama_inventaris,tbl_status_peminjaman.id_status_peminjaman,tbl_status_peminjaman.nama_status_peminjaman');
        $this->datatables->join('tbl_detail_pinjam','tbl_peminjaman.id_peminjaman=tbl_detail_pinjam.id_peminjaman');
        $this->datatables->join('tbl_inventaris','tbl_detail_pinjam.id_inventaris=tbl_inventaris.id_inventaris','left');
        $this->datatables->join('tbl_pegawai','tbl_peminjaman.id_pegawai=tbl_pegawai.id_pegawai','left');
        $this->datatables->join('tbl_petugas','tbl_pegawai.id_pegawai=tbl_petugas.id_pegawai','left');
        $this->datatables->join('tbl_status_peminjaman','tbl_peminjaman.id_status_peminjaman=tbl_status_peminjaman.id_status_peminjaman','left');
        $this->datatables->from('tbl_peminjaman');
        $this->datatables->where('deleted_peminjaman',0);
        $this->datatables->where('tbl_status_peminjaman.id_status_peminjaman',1);
        $this->datatables->add_column('action','
        <a href="'.site_url('barang/edit/').'$1" class="btn btn-info"><i class="fas fa-edit"></i></a>
        <a href="javascript:void(0)" onclick="deleteConfirm(\''.site_url('barang/hapus/').'$1\')" class="btn btn-danger"><i class="fas fa-trash"></i></a>',
        'id_peminjaman');
        $this->datatables->edit_column('nama_status_peminjaman','<a class="edit_status_peminjaman" href="javascript:void(0)" data-status="$1" data-id="$3">$2</a>','id_status_peminjaman,nama_status_peminjaman,id_peminjaman');

        return $this->datatables->generate();
    }
    
    public function getHistoryPeminjaman()
    {
        $this->datatables->select('tbl_peminjaman.id_peminjaman,tbl_peminjaman.tanggal_pinjam,tbl_peminjaman.tanggal_kembali,tbl_peminjaman.id_status_peminjaman,tbl_detail_pinjam.jumlah_detail_pinjam,tbl_pegawai.nama_pegawai,tbl_inventaris.nama_inventaris,tbl_status_peminjaman.nama_status_peminjaman');
        $this->datatables->join('tbl_detail_pinjam','tbl_peminjaman.id_peminjaman=tbl_detail_pinjam.id_peminjaman');
        $this->datatables->join('tbl_inventaris','tbl_detail_pinjam.id_inventaris=tbl_inventaris.id_inventaris','left');
        $this->datatables->join('tbl_pegawai','tbl_peminjaman.id_pegawai=tbl_pegawai.id_pegawai','left');
        $this->datatables->join('tbl_petugas','tbl_pegawai.id_pegawai=tbl_petugas.id_pegawai','left');
        $this->datatables->join('tbl_status_peminjaman','tbl_peminjaman.id_status_peminjaman=tbl_status_peminjaman.id_status_peminjaman','left');
        $this->datatables->from('tbl_peminjaman');
        $this->datatables->where('deleted_peminjaman',0);
        // $this->datatables->where('id_status_peminjaman','Sedang Dipinjam');
        $this->datatables->add_column('action','
        <a href="'.site_url('barang/edit/').'$1" class="btn btn-info"><i class="fas fa-edit"></i></a>
        <a href="javascript:void(0)" onclick="deleteConfirm(\''.site_url('barang/hapus/').'$1\')" class="btn btn-danger"><i class="fas fa-trash"></i></a>',
        'id_peminjaman');

        return $this->datatables->generate();
    }

    public function getDetailPinjam($id=null)
    {
        $this->datatables->select('tbl_peminjaman.id_peminjaman,tbl_pegawai.nama_pegawai,tbl_inventaris.nama_inventaris,tbl_peminjaman.tanggal_pinjam,tbl_peminjaman.tanggal_kembali,tbl_detail_pinjam.jumlah_detail_pinjam,tbl_peminjaman.id_status_peminjaman');
        $this->datatables->join('tbl_detail_pinjam','tbl_detail_pinjam.id_peminjaman=tbl_peminjaman.id_peminjaman','left');
        $this->datatables->join('tbl_inventaris','tbl_detail_pinjam.id_inventaris=tbl_inventaris.id_inventaris','left');
        $this->datatables->join('tbl_pegawai','tbl_peminjaman.id_pegawai=tbl_pegawai.id_pegawai','left');
        $this->datatables->join('tbl_petugas','tbl_pegawai.id_pegawai=tbl_petugas.id_pegawai','left');
        $this->datatables->from('tbl_peminjaman');
        $this->datatables->where('tbl_pegawai.id_pegawai',$id);
        $this->datatables->where('deleted_peminjaman',0);
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
        return $this->db->get_where('tbl_peminjaman', ["id_peminjaman" => $id]);
    }

    public function getListPeminjam()
    {
        $this->db->select('tbl_petugas.id_petugas,tbl_pegawai.id_pegawai,tbl_pegawai.nama_pegawai');
        $this->db->join('tbl_pegawai','tbl_petugas.id_pegawai=tbl_pegawai.id_pegawai');
        $this->db->where('tbl_petugas.id_level',3);
        $query = $this->db->get('tbl_petugas');
        return $query->result();
    }

    public function getListInventaris()
    {
        $this->db->select('tbl_inventaris.id_inventaris,tbl_inventaris.nama_inventaris,tbl_inventaris.kode_inventaris');
        $query = $this->db->get('tbl_inventaris');
        return $query->result();
    }

    public function getMaxJumlah($id_inventaris)
    {
        $this->db->select('SUM(tbl_detail_pinjam.jumlah_detail_pinjam) as maksimal_pinjam');
        $this->db->join('tbl_detail_pinjam','tbl_peminjaman.id_peminjaman=tbl_detail_pinjam.id_peminjaman');
        $this->db->where('tbl_detail_pinjam.id_inventaris',$id_inventaris);
        $query = $this->db->get('tbl_peminjaman');
        $maxInput = $this->count('total_barang',$id_inventaris) - $query->row()->maksimal_pinjam;

        $result = array('status' => 'sukses', 'data' => $maxInput);

        return json_encode($result);

        
    }

    public function count($opsi,$id_inventaris=null)
    {
        if($opsi == 'total_sedang_dipinjam'){
            
            $this->db->select('SUM(jumlah_detail_pinjam) as jumlah_dipinjam');
            $this->db->join('tbl_peminjaman','tbl_detail_pinjam.id_peminjaman=tbl_peminjaman.id_peminjaman');
            $this->db->where('id_status_peminjaman',1);
            $query = $this->db->get('tbl_detail_pinjam');

            if($query->row()->jumlah_dipinjam == null){
                return 0;
            } else {
                return $query->row()->jumlah_dipinjam;
            }
        } else if ($opsi == 'total_barang_di_gudang'){
            return $this->count('total_barang') - $this->count('total_sedang_dipinjam');
        } else if ($opsi == 'total_barang'){
            if($id_inventaris != null) {
                
                $this->db->select('SUM(jumlah_inventaris) as jumlah_inventaris');
                $this->db->where('id_inventaris',$id_inventaris);
                $query = $this->db->get('tbl_inventaris');
    
                if($query->row()->jumlah_inventaris == null){
                    return 0;
                } else {
                    return $query->row()->jumlah_inventaris;
                }

            } else {

                $this->db->select('SUM(jumlah_inventaris) as jumlah_inventaris');
                $query = $this->db->get('tbl_inventaris');
    
                if($query->row()->jumlah_inventaris == null){
                    return 0;
                } else {
                    return $query->row()->jumlah_inventaris;
                }

            }
        }
        
    }

    public function save()
    {
        $post = $this->input->post();
        $this->id_pegawai = $post['peminjam'];
        $this->id_inventaris = $post['barang'];
        $this->jumlah_detail_pinjam = $post["jumlah_pinjam"];
        $this->tanggal = $post["tanggal_pinjam"];
        $this->tanggal_kembali = substr($this->tanggal,13);
        $this->tanggal_pinjam = substr($this->tanggal,0,10);

        $dt_peminjaman = array(
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => $this->tanggal_kembali,
            'id_status_peminjaman' => 1,
            'id_pegawai' => $this->id_pegawai,
            'created_peminjaman' => date('Y:m:d H:i:s'),
            'update_peminjaman' => date('Y:m:d H:i:s'),
            'deleted_peminjaman' => 0,
        );

        $this->db->insert('tbl_peminjaman', $dt_peminjaman);

        $this->db->order_by('id_peminjaman','desc');
        $this->id_peminjaman = $this->db->get('tbl_peminjaman')->row()->id_peminjaman;

        $dt_detail_peminjaman = array(
            'id_inventaris' => $this->id_inventaris,
            'id_peminjaman' => $this->id_peminjaman,
            'jumlah_detail_pinjam' => $this->jumlah_detail_pinjam,
            'created_detail_pinjam' => date('Y:m:d H:i:s'),
            'update_detail_pinjam' => date('Y:m:d H:i:s'),
            'deleted_detail_pinjam' => 0,
        );

        $this->db->insert('tbl_detail_pinjam', $dt_detail_peminjaman);
    }

    public function update($opsi=null)
    {
        $post = $this->input->post();
        $this->id_peminjaman = $post['id'];
        if($opsi == 'status_peminjaman'){

            $this->id_status_peminjaman = $post['status_peminjaman'];

            $dt_peminjaman = array(
                'id_status_peminjaman' => $this->id_status_peminjaman,
                'update_peminjaman' => date('Y:m:d H:i:s'),
            );
        } else { 

            $this->nama_inventaris = $post['nama_inventaris'];
            $this->kondisi_inventaris = $post['kondisi_inventaris'];
            $this->keterangan_inventaris = $post["keterangan_inventaris"];
            $this->jumlah_inventaris = $post["jumlah_inventaris"];
            $this->id_jenis = $post["jenis"];
            $this->id_ruang = $post["ruang"];

            $dt_peminjaman = array(
                'nama_inventaris' => $this->nama_inventaris,
                'kondisi_inventaris' => $this->kondisi_inventaris,
                'keterangan_inventaris' => $this->keterangan_inventaris,
                'jumlah_inventaris' => $this->jumlah_inventaris,
                'id_jenis' => $this->id_jenis,
                'id_ruang' => $this->id_ruang,
                'update_peminjaman' => date('Y:m:d H:i:s'),
            );
        
        }
        $this->db->update('tbl_peminjaman', $dt_peminjaman, array('id_peminjaman' => $this->id_peminjaman));
    }

    public function delete($id)
    {
        if($id == 'all'){
            return $this->db->empty_table('tbl_inventaris');    
        } else {
            return $this->db->delete('tbl_inventaris', array("id_inventaris" => $id));
        }
    }
}