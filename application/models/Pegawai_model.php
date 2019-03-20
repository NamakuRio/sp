<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{
    public function rules()
    {
        $rules = array(
            array('field' => 'nama_pegawai', 'label' => 'Nama', 'rules' => 'required'),
            array('field' => 'nip_pegawai', 'label' => 'NIP', 'rules' => 'required'),
            array('field' => 'alamat_pegawai', 'label' => 'Alamat', 'rules' => 'required'),);

        return $rules;
    }
    public function getPegawai()
    {
        $this->datatables->select('id_pegawai,nama_pegawai,nip_pegawai,alamat_pegawai,foto_pegawai');
        $this->datatables->from('tbl_pegawai');
        $this->datatables->where('deleted_pegawai',0);
        $this->datatables->add_column('foto_pegawai','
        <img alt="image" src="'.site_url('uploads/foto/foto_pegawai/$1').'" class="img-fluid img-shadow" data-toggle="title" title="$2" width="80">',
        'foto_pegawai,nama_pegawai');
        $this->datatables->add_column('action','
        <a href="'.site_url('users/pegawai/edit/').'$1" class="btn btn-info"><i class="fas fa-edit"></i></a>
        <a href="javascript:void(0)" onclick="deleteConfirm(\''.site_url('users/pegawai/hapus/').'$1\')" class="btn btn-danger"><i class="fas fa-trash"></i></a>',
        'id_pegawai,nama_pegawai,nip_pegawai,alamat_pegawai');
        $this->datatables->edit_column('nama_pegawai',nl2br(htmlspecialchars('$1')),'nama_pegawai');
        $this->datatables->edit_column('nip_pegawai',nl2br(htmlspecialchars('$1')),'nip_pegawai');
        $this->datatables->edit_column('alamat_pegawai',nl2br(htmlspecialchars('$1')),'alamat_pegawai');

        return $this->datatables->generate();
    }

    public function getListPegawai()
    {
        // $query = $this->db->query('SELECT tbl_pegawai.* FROM `tbl_petugas`,`tbl_pegawai` WHERE tbl_petugas.id_pegawai<>tbl_pegawai.id_pegawai');
        $this->db->select('tbl_pegawai.id_pegawai,nama_pegawai,nip_pegawai,alamat_pegawai');
        $this->db->where('id_pegawai NOT IN (SELECT id_pegawai from tbl_petugas)');
        $query = $this->db->get('tbl_pegawai');
        return $query->result();
    }

    public function getById($id)
    {
        return $this->db->get_where('tbl_pegawai', ["id_pegawai" => $id]);
    }

    public function save()
    {
        $post = $this->input->post();
        $this->nama_pegawai = nl2br(htmlspecialchars($post["nama_pegawai"]));
        $this->nip_pegawai = nl2br(htmlspecialchars($post["nip_pegawai"]));
        $this->alamat_pegawai = nl2br(htmlspecialchars($post["alamat_pegawai"]));
        $this->foto_pegawai = $this->_uploadFotoPegawai();

        $dt_pegawai = array(
            'nama_pegawai' => $this->nama_pegawai,
            'nip_pegawai' => $this->nip_pegawai,
            'alamat_pegawai' => $this->alamat_pegawai,
            'foto_pegawai' => $this->foto_pegawai,
            'created_pegawai' => date('Y:m:d H:i:s'),
            'update_pegawai' => date('Y:m:d H:i:s'),
            'deleted_pegawai' => 0,
        );

        $this->db->insert('tbl_pegawai', $dt_pegawai);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_pegawai = $post['id'];
        $this->nama_pegawai = nl2br(htmlspecialchars($post["nama_pegawai"]));
        $this->nip_pegawai = nl2br(htmlspecialchars($post["nip_pegawai"]));
        $this->alamat_pegawai = nl2br(htmlspecialchars($post["alamat_pegawai"]));

        $dt_pegawai = array(
            'nama_pegawai' => $this->nama_pegawai,
            'nip_pegawai' => $this->nip_pegawai,
            'alamat_pegawai' => $this->alamat_pegawai,
            'update_pegawai' => date('Y:m:d H:i:s'),
        );

        $this->db->update('tbl_pegawai', $dt_pegawai, array('id_pegawai' => $this->id_pegawai));
    }

    public function delete($id)
    {
        if($id == 'all'){
            return $this->db->empty_table('tbl_pegawai');    
        } else {
            $this->_deleteFotoPegawai($id);
            return $this->db->delete('tbl_pegawai', array("id_pegawai" => $id));
        }
    }

    private function _uploadFotoPegawai()
		{
		    $config['upload_path']          = './uploads/foto/foto_pegawai/';
		    $config['allowed_types']        = 'gif|jpg|png';
		    $config['file_name']            = acak(rand(10,20));
		    $config['overwrite']			= true;
		    $config['max_size']             = 1024; // 1MB
		    // $config['max_width']            = 1024;
		    // $config['max_height']           = 768;

		    $this->load->library('upload', $config);

		    if ($this->upload->do_upload('foto_pegawai')) {
		        return $this->upload->data("file_name");
		    }
		    
		    return "default.jpg";
		}

		private function _deleteFotoPegawai($id)
		{
		    $pegawai = $this->getById($id);
		    if ($pegawai->foto_pegawai != "default.jpg") {
			    $filename = explode(".", $pegawai->foto_pegawai)[0];
				return array_map('unlink', glob(FCPATH."uploads/foto/foto_pegawai/$filename.*"));
		    }
		}
}