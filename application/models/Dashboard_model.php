<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function count($opsi)
    {
        if($opsi == 'total_barang'){
            $query = $this->db->get('tbl_inventaris');
        } else if ($opsi == 'total_peminjam'){
            $this->db->where('id_level',3);
            $query = $this->db->get('tbl_petugas');
        } else if ($opsi == 'total_dipinjam'){
            $this->db->where('id_status_peminjaman',1);
            $query = $this->db->get('tbl_peminjaman');
        }

        return $query->num_rows();
    }
}