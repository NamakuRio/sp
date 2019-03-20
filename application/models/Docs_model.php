<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Docs_model extends CI_Model
{
    public function getMenu()
    {
        return $this->db->get('tbl_menu_dokumentasi')->result();
    }

    public function getSubmenu()
    {
        $this->db->join('tbl_menu_dokumentasi','tbl_submenu_dokumentasi.id_menu_dokumentasi=tbl_menu_dokumentasi.id_menu_dokumentasi');
        return $this->db->get('tbl_submenu_dokumentasi')->result();
    }
}