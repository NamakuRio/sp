<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ruang_model extends CI_Model
{
    public function rules($opsi=null)
    {
        if($opsi == 'g'){
            $rules = array(
                array('field' => 'nama_ruang', 'label' => 'Nama', 'rules' => 'required'),);
        } else {
            $rules = array(
                array('field' => 'nama_ruang', 'label' => 'Nama', 'rules' => 'required'),);
        }

        return $rules;
    }

    public function getRuang()
    {
        $this->datatables->select('id_ruang,nama_ruang,kode_ruang,keterangan_ruang');
        $this->datatables->from('tbl_ruang');
        $this->datatables->where('deleted_ruang',0);
        $this->datatables->add_column('action','
        <a href="'.site_url('data/ruang/edit/').'$1" class="btn btn-info"><i class="fas fa-edit"></i></a>
        <a href="javascript:void(0)" onclick="deleteConfirm(\''.site_url('data/ruang/hapus/').'$1\')" class="btn btn-danger"><i class="fas fa-trash"></i></a>',
        'id_ruang,nama_ruang,kode_ruang,keterangan_ruang');
        $this->datatables->edit_column('nama_ruang',nl2br(htmlspecialchars('$1')),'nama_ruang');
        $this->datatables->edit_column('keterangan_ruang',nl2br(htmlspecialchars('$1')),'keterangan_ruang');

        return $this->datatables->generate();
    }

    public function getListRuang()
    {
        $this->db->select('id_ruang,nama_ruang,kode_ruang,keterangan_ruang');
        $query = $this->db->get('tbl_ruang');
        return $query->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where('tbl_ruang', ["id_ruang" => $id]);
    }

    public function save()
    {
        $post = $this->input->post();
        $this->nama_ruang = $post["nama_ruang"];
        $this->kode_ruang = $this->kode_urut();
        $this->keterangan_ruang = $post["keterangan_ruang"];

        $dt_ruang = array(
            'nama_ruang' => nl2br(htmlspecialchars($this->nama_ruang)),
            'kode_ruang' => nl2br(htmlspecialchars($this->kode_ruang)),
            'keterangan_ruang' => nl2br(htmlspecialchars($this->keterangan_ruang)),
            'created_ruang' => date('Y:m:d H:i:s'),
            'update_ruang' => date('Y:m:d H:i:s'),
            'deleted_ruang' => 0,
        );

        $this->db->insert('tbl_ruang', $dt_ruang);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_ruang = $post['id'];
        $this->nama_ruang = nl2br(htmlspecialchars($post["nama_ruang"]));
        $this->keterangan_ruang = nl2br(htmlspecialchars($post["keterangan_ruang"]));

        $dt_ruang = array(
            'nama_ruang' => $this->nama_ruang,
            'keterangan_ruang' => $this->keterangan_ruang,
            'update_ruang' => date('Y:m:d H:i:s'),
        );

        $this->db->update('tbl_ruang', $dt_ruang, array('id_ruang' => $this->id_ruang));
    }

    public function delete($id)
    {
        if($id == 'all'){
            return $this->db->empty_table('tbl_ruang');    
        } else {
            return $this->db->delete('tbl_ruang', array("id_ruang" => $id));
        }
    }

    public function kode_urut(){
        $this->db->select('RIGHT(tbl_ruang.kode_ruang,5) AS kd_ruang',FALSE);
        $this->db->order_by('kode_ruang','DESC');
        $this->db->limit(1);        
        $query = $this->db->get('tbl_ruang');
        if($query->num_rows() <> 0){
            $data = $query->row();
            $kode = intval($data->kd_ruang) + 1;
        } else {
            $kode = 1;
        }
        $output = "RN".str_pad($kode, 5, "0", STR_PAD_LEFT);

        return $output;
    } 
}