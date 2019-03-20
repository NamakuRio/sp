<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_model extends CI_Model
{
    public function rules($opsi=null)
    {
        if($opsi == 'g'){
            $rules = array(
                array('field' => 'nama_jenis', 'label' => 'Nama', 'rules' => 'required'),);
        } else {
            $rules = array(
                array('field' => 'nama_jenis', 'label' => 'Nama', 'rules' => 'required'),);
        }

        return $rules;
    }

    public function getJenis()
    {
        $this->datatables->select('id_jenis,nama_jenis,kode_jenis,keterangan_jenis');
        $this->datatables->from('tbl_jenis');
        $this->datatables->where('deleted_jenis',0);
        $this->datatables->add_column('action','
        <a href="'.site_url('data/jenis/edit/').'$1" class="btn btn-info"><i class="fas fa-edit"></i></a>
        <a href="javascript:void(0)" onclick="deleteConfirm(\''.site_url('data/jenis/hapus/').'$1\')" class="btn btn-danger"><i class="fas fa-trash"></i></a>',
        'id_jenis,nama_jenis,kode_jenis,keterangan_jenis');
        $this->datatables->edit_column('nama_jenis',nl2br(htmlspecialchars('$1')),'nama_jenis');
        $this->datatables->edit_column('keterangan_jenis',nl2br(htmlspecialchars('$1')),'keterangan_jenis');

        return $this->datatables->generate();
    }

    public function getListJenis()
    {
        $this->db->select('id_jenis,nama_jenis,kode_jenis,keterangan_jenis');
        $query = $this->db->get('tbl_jenis');
        return $query->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where('tbl_jenis', ["id_jenis" => $id]);
    }

    public function save()
    {
        $post = $this->input->post();
        $this->kode_jenis = $this->kode_urut();
        $this->nama_jenis = nl2br(htmlspecialchars($post['nama_jenis']));
        $this->keterangan_jenis = nl2br(htmlspecialchars($post["keterangan_jenis"]));

        $dt_jenis = array(
            'kode_jenis' => $this->kode_jenis,
            'nama_jenis' => $this->nama_jenis,
            'keterangan_jenis' => $this->keterangan_jenis,
            'created_jenis' => date('Y:m:d H:i:s'),
            'update_jenis' => date('Y:m:d H:i:s'),
            'deleted_jenis' => 0,
        );

        $this->db->insert('tbl_jenis', $dt_jenis);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_jenis = $post['id'];
        $this->nama_jenis = nl2br(htmlspecialchars($post["nama_jenis"]));
        $this->keterangan_jenis = nl2br(htmlspecialchars($post["keterangan_jenis"]));

        $dt_jenis = array(
            'nama_jenis' => $this->nama_jenis,
            'keterangan_jenis' => $this->keterangan_jenis,
            'update_jenis' => date('Y:m:d H:i:s'),
        );

        $this->db->update('tbl_jenis', $dt_jenis, array('id_jenis' => $this->id_jenis));
    }

    public function delete($id)
    {
        if($id == 'all'){
            return $this->db->empty_table('tbl_jenis');    
        } else {
            return $this->db->delete('tbl_jenis', array("id_jenis" => $id));
        }
    }

    public function kode_urut(){
        $this->db->select('RIGHT(tbl_jenis.kode_jenis,5) AS kd_jenis',FALSE);
        $this->db->order_by('kode_jenis','DESC');
        $this->db->limit(1);        
        $query = $this->db->get('tbl_jenis');
        if($query->num_rows() <> 0){
            $data = $query->row();
            $kode = intval($data->kd_jenis) + 1;
        } else {
            $kode = 1;
        }
        $output = "JN".str_pad($kode, 5, "0", STR_PAD_LEFT);

        return $output;
    } 
}