<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->auth_model->cek_login('masuk');
        $this->auth_model->role_admin();
        $this->load->model('laporan_model');
	}

    public function index()
    {

        $data['judul_laporan'] = array('Peminjaman','Pengeluaran','History Barang','Inventaris','Jenis','Ruang','Pegawai','Peminjam','Petugas');
        $data['warna'] = array('bg-dark','bg-warning','bg-primary','bg-danger','bg-secondary','bg-info','bg-success','bg-danger','bg-info');
        $data['icon'] = array('fab fa-opencart','fas fa-random','fas fa-history','fab fa-docker','fas fa-tags text-dark','fas fa-warehouse','fas fa-users','fas fa-user-check','fas fa-user-secret');
        $data['link'] = array('peminjaman','pengeluaran','history','inventaris','jenis','ruang','pegawai','peminjam','petugas');
        $data['delay_animation'] = array('faster','faster','fast','fast','','','slow','slow','slower');

        $this->load->view('dashboard/laporan/main',$data);
    }

    public function peminjaman($export_type=null)
    {
        if($export_type == 'excel'){
            $this->laporan_excel('peminjaman');
        } else if($export_type == 'pdf'){
            $this->laporan_pdf('peminjaman');
        } else {
            $this->load->view('dashboard/laporan/peminjaman');
        }
    }

    public function pengeluaran($export_type=null)
    {
        if($export_type == 'excel'){
            $this->laporan_excel('pengeluaran');
        } else if($export_type == 'pdf'){

        } else {
            $this->load->view('dashboard/laporan/pengeluaran');
        }
    }

    public function history($export_type=null)
    {
        if($export_type == 'excel'){
            $this->laporan_excel('history_barang');
        } else if($export_type == 'pdf'){

        } else {
            $this->load->view('dashboard/laporan/history_barang');
        }
    }

    public function inventaris($export_type=null)
    {
        if($export_type == 'excel'){
            $this->laporan_excel('inventaris');
        } else if($export_type == 'pdf'){
            $this->laporan_pdf('inventaris');
        } else {
            $this->load->view('dashboard/laporan/inventaris');
        }
    }

    public function jenis($export_type=null)
    {
        if($export_type == 'excel'){
            $this->laporan_excel('jenis');
        } else if($export_type == 'pdf'){
            $this->laporan_pdf('jenis');
        } else {
            $this->load->view('dashboard/laporan/jenis');
        }
    }

    public function ruang($export_type=null)
    {
        if($export_type == 'excel'){
            $this->laporan_excel('ruang');
        } else if($export_type == 'pdf'){
            $this->laporan_pdf('ruang');
        } else {
            $this->load->view('dashboard/laporan/ruang');
        }
    }

    public function pegawai($export_type=null)
    {
        if($export_type == 'excel'){
            $this->laporan_excel('pegawai');
        } else if($export_type == 'pdf'){
            $this->laporan_pdf('pegawai');
        } else {
            $this->load->view('dashboard/laporan/pegawai');
        }
    }

    public function peminjam($export_type=null)
    {
        if($export_type == 'excel'){
            $this->laporan_excel('peminjam');
        } else if($export_type == 'pdf'){
            $this->laporan_pdf('peminjam');
        } else {
            $this->load->view('dashboard/laporan/peminjam');
        }
    }

    public function petugas($export_type=null)
    {
        if($export_type == 'excel'){
            $this->laporan_excel('petugas');
        } else if($export_type == 'pdf'){
            $this->laporan_pdf('petugas');
        } else {
            $this->load->view('dashboard/laporan/petugas');
        }
    }

    public function getLaporan($menu)
    {
        header('Content-Type: application/json');
        return print_r($this->laporan_model->getLaporan($menu));
    }

    public function laporan_excel($menu)
    {
        //cell
        $huruf_cel = array(
            'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
            'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ',
        );
        //field
        $field = array(
            'ruang' => array(
                'id_ruang',
                'nama_ruang',
                'kode_ruang',
                'keterangan_ruang',
                'created_ruang',
                'update_ruang',
                'deleted_ruang',
            ),
            'jenis' => array(
                'id_jenis',
                'nama_jenis',
                'kode_jenis',
                'keterangan_jenis',
                'created_jenis',
                'update_jenis',
                'deleted_jenis',
            ),
            'pegawai' => array(
                'id_pegawai',
                'nama_pegawai',
                'nip_pegawai',
                'alamat_pegawai',
                'created_pegawai',
                'update_pegawai',
                'deleted_pegawai',
            ),
            'peminjam' => array(
                'id_petugas',
                'nama_pegawai',
                'nip_pegawai',
                'alamat_pegawai',
                'username_petugas',
                'nama_level',
                'created_petugas',
                'update_petugas',
                'deleted_petugas',
            ),
            'petugas' => array(
                'id_petugas',
                'nama_pegawai',
                'nip_pegawai',
                'alamat_pegawai',
                'username_petugas',
                'nama_level',
                'created_petugas',
                'update_petugas',
                'deleted_petugas',
            ),
            'inventaris' => array(
                'id_inventaris',
                'nama_inventaris',
                'kondisi_inventaris',
                'keterangan_inventaris',
                'jumlah_inventaris',
                'nama_jenis',
                'tanggal_register',
                'nama_ruang',
                'kode_inventaris',
                'nama_pegawai',
                'created_inventaris',
                'update_inventaris',
                'deleted_inventaris',
            ),
            'peminjaman' => array(
                'id_peminjaman',
                'nama_pegawai',
                'nama_inventaris',
                'jumlah_detail_pinjam',
                'tanggal_pinjam',
                'tanggal_kembali',
                'nama_status_peminjaman',
                'created_peminjaman',
                'update_peminjaman',
                'deleted_peminjaman',
            ),
        );
        //title
        $title = array(
            'ruang' => array(
                'No',
                'Nama',
                'Kode',
                'Keterangan',
                'Created Ruang',
                'Update Ruang',
                'Deleted Ruang',
            ),
            'jenis' => array(
                'No',
                'Nama',
                'Kode',
                'Keterangan',
                'Created Jenis',
                'Update Jenis',
                'Deleted Jenis',
            ),
            'pegawai' => array(
                'No',
                'Nama',
                'NIP',
                'Alamat',
                'Created Pegawai',
                'Update Pegawai',
                'Deleted Pegawai',
            ),
            'peminjam' => array(
                'No',
                'Nama',
                'NIP',
                'Alamat',
                'Username',
                'Level',
                'Created Peminjam',
                'Update Peminjam',
                'Deleted Peminjam',
            ),
            'petugas' => array(
                'No',
                'Nama',
                'NIP',
                'Alamat',
                'Username',
                'Level',
                'Created Petugas',
                'Update Petugas',
                'Deleted Petugas',
            ),
            'inventaris' => array(
                'No',
                'Nama Barang',
                'Kondisi',
                'Keterangan',
                'Jumlah',
                'Jenis',
                'Tanggal Register',
                'Ruang',
                'Kode Inventaris',
                'Nama Petugas',
                'Created Petugas',
                'Update Petugas',
                'Deleted Petugas',
            ),
            'peminjaman' => array(
                'No',
                'Nama Peminjam',
                'Nama Barang',
                'Jumlah Peminjaman',
                'Tanggal Pinjam',
                'Tanggal Kembali',
                'Status Peminjaman',
                'Created Peminjaman',
                'Update Peminjaman',
                'Deleted Peminjaman',
            ),
        );
        // create file name
        $nama_file = 'laporan_'.$menu.'-'.date('YmdHis').'.xlsx';  

        // load excel library
        $data_laporan = $this->laporan_model->createLaporan($menu,'excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        // set Header
        for($j=0;$j<count($field[$menu]);$j++){
            $objPHPExcel->getActiveSheet()->SetCellValue($huruf_cel[$j] . '1', $title[$menu][$j]);
        }
        // set Row
        $rowCount = 2;
        foreach ($data_laporan as $dl) {
            for($i=0;$i<count($field[$menu]);$i++){
                $objPHPExcel->getActiveSheet()->SetCellValue($huruf_cel[$i] . $rowCount, $dl[$field[$menu][$i]]);
            }
            $rowCount++;
        }
        // set style
        $objPHPExcel->getActiveSheet()->getStyle("A1:".$huruf_cel[count($field[$menu])-1]."1")->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '6777ef')
                ),
                'font' => array(
                    'color' => array('rgb' => 'ffffff')
                ),
                'borders' => array(
                    'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
                )
            )
        );
        
        if($menu == 'ruang' || $menu == 'jenis' || $menu == 'pegawai'){
            
            // set width
            // for($i=0;$i<count($field[$menu]);$i++){
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            // }
        } else if($menu == 'peminjam' || $menu == 'petugas'){
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        } else if($menu == 'inventaris' ){
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        } else if($menu == 'peminjaman'){
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(18);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        }
        
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('./uploads/laporan/excel/'.$nama_file);
		// download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(base_url('uploads/laporan/excel/').$nama_file);        
    }

    public function laporan_pdf($menu)
    {
        //field
        $field = array(
            'ruang' => array(
                array(
                    20,
                    6,
                    'id_ruang',
                ),
                array(
                    35,
                    6,
                    'nama_ruang',
                ),
                array(
                    35,
                    6,
                    'kode_ruang',
                ),
                array(
                    75,
                    6,
                    'keterangan_ruang',
                ),
                array(
                    40,
                    6,
                    'created_ruang',
                ),
                array(
                    40,
                    6,
                    'update_ruang',
                ),
                array(
                    30,
                    6,
                    'deleted_ruang',
                ),
            ),
            'jenis' => array(
                array(
                    20,
                    6,
                    'id_jenis',
                ),
                array(
                    35,
                    6,
                    'nama_jenis',
                ),
                array(
                    35,
                    6,
                    'kode_jenis',
                ),
                array(
                    75,
                    6,
                    'keterangan_jenis',
                ),
                array(
                    40,
                    6,
                    'created_jenis',
                ),
                array(
                    40,
                    6,
                    'update_jenis',
                ),
                array(
                    30,
                    6,
                    'deleted_jenis',
                ),
            ),
            'pegawai' => array(
                array(
                    20,
                    6,
                    'id_pegawai',
                ),
                array(
                    50,
                    6,
                    'nama_pegawai',
                ),
                array(
                    20,
                    6,
                    'nip_pegawai',
                ),
                array(
                    75,
                    6,
                    'alamat_pegawai',
                ),
                array(
                    40,
                    6,
                    'created_pegawai',
                ),
                array(
                    40,
                    6,
                    'update_pegawai',
                ),
                array(
                    30,
                    6,
                    'deleted_pegawai',
                ),
            ),
            'peminjam' => array(
                array(
                    10,
                    6,
                    'id_petugas',
                ),
                array(
                    40,
                    6,
                    'nama_pegawai',
                ),
                array(
                    15,
                    6,
                    'nip_pegawai',
                ),
                array(
                    70,
                    6,
                    'alamat_pegawai',
                ),
                array(
                    25,
                    6,
                    'username_petugas',
                ),
                array(
                    20,
                    6,
                    'nama_level',
                ),
                array(
                    35,
                    6,
                    'created_petugas',
                ),
                array(
                    35,
                    6,
                    'update_petugas',
                ),
                array(
                    35,
                    6,
                    'deleted_petugas',
                ),
            ),
            'petugas' => array(
                array(
                    10,
                    6,
                    'id_petugas',
                ),
                array(
                    40,
                    6,
                    'nama_pegawai',
                ),
                array(
                    15,
                    6,
                    'nip_pegawai',
                ),
                array(
                    70,
                    6,
                    'alamat_pegawai',
                ),
                array(
                    25,
                    6,
                    'username_petugas',
                ),
                array(
                    20,
                    6,
                    'nama_level',
                ),
                array(
                    35,
                    6,
                    'created_petugas',
                ),
                array(
                    35,
                    6,
                    'update_petugas',
                ),
                array(
                    30,
                    6,
                    'deleted_petugas',
                ),
            ),
            'inventaris' => array(
                array(
                    10,
                    6,
                    'id_inventaris',
                ),
                array(
                    50,
                    6,
                    'nama_inventaris',
                ),
                array(
                    20,
                    6,
                    'kondisi_inventaris',
                ),
                array(
                    50,
                    6,
                    'keterangan_inventaris',
                ),
                array(
                    20,
                    6,
                    'jumlah_inventaris',
                ),
                array(
                    25,
                    6,
                    'nama_jenis',
                ),
                array(
                    35,
                    6,
                    'tanggal_register',
                ),
                array(
                    25,
                    6,
                    'nama_ruang',
                ),
                array(
                    30,
                    6,
                    'kode_inventaris',
                ),
                array(
                    40,
                    6,
                    'nama_pegawai',
                ),
                array(
                    35,
                    6,
                    'created_inventaris',
                ),
                array(
                    35,
                    6,
                    'update_inventaris',
                ),
                array(
                    30,
                    6,
                    'deleted_inventaris',
                ),
            ),
            'peminjaman' => array(
                array(
                    10,
                    6,
                    'id_peminjaman',
                ),
                array(
                    40,
                    6,
                    'nama_pegawai',
                ),
                array(
                    50,
                    6,
                    'nama_inventaris',
                ),
                array(
                    40,
                    6,
                    'jumlah_detail_pinjam',
                ),
                array(
                    30,
                    6,
                    'tanggal_pinjam',
                ),
                array(
                    30,
                    6,
                    'tanggal_kembali',
                ),
                array(
                    40,
                    6,
                    'nama_status_peminjaman',
                ),
                array(
                    37,
                    6,
                    'created_peminjaman',
                ),
                array(
                    37,
                    6,
                    'update_peminjaman',
                ),
                array(
                    37,
                    6,
                    'deleted_peminjaman',
                ),
            ),
        );
        //title
        $title = array(
            'ruang' => array(
                'No',
                'Nama',
                'Kode',
                'Keterangan',
                'Created Ruang',
                'Update Ruang',
                'Deleted Ruang',
            ),
            'jenis' => array(
                'No',
                'Nama',
                'Kode',
                'Keterangan',
                'Created Jenis',
                'Update Jenis',
                'Deleted Jenis',
            ),
            'pegawai' => array(
                'No',
                'Nama',
                'NIP',
                'Alamat',
                'Created Pegawai',
                'Update Pegawai',
                'Deleted Pegawai',
            ),
            'peminjam' => array(
                'No',
                'Nama',
                'NIP',
                'Alamat',
                'Username',
                'Level',
                'Created Peminjam',
                'Update Peminjam',
                'Deleted Peminjam',
            ),
            'petugas' => array(
                'No',
                'Nama',
                'NIP',
                'Alamat',
                'Username',
                'Level',
                'Created Petugas',
                'Update Petugas',
                'Deleted Petugas',
            ),
            'inventaris' => array(
                'No',
                'Nama Barang',
                'Kondisi',
                'Keterangan',
                'Jumlah',
                'Jenis',
                'Tanggal Register',
                'Ruang',
                'Kode Inventaris',
                'Nama Petugas',
                'Created Petugas',
                'Update Petugas',
                'Deleted Petugas',
            ),
            'peminjaman' => array(
                'No',
                'Nama Peminjam',
                'Nama Barang',
                'Jumlah Peminjaman',
                'Tanggal Pinjam',
                'Tanggal Kembali',
                'Status Peminjaman',
                'Created Peminjaman',
                'Update Peminjaman',
                'Deleted Peminjaman',
            ),
        );

        $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        //setting penulis
        $pdf->setTitle('laporan_'.$menu.'-'.date('YmdHis'));
        $pdf->setSubject('Laporan '.$menu);
        $pdf->setAuthor('Bimo Rio Prastiawan');
        $pdf->setKeywords('Laporan Sarana dan Prasarana');
        $pdf->setCreator('Bimo Rio Prastiawan');
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string
        $pdf->Cell(0,7,'SEKOLAH MENENGAH KEJURUSAN NEGERI 2 SEMARANG',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,7,'LAPORAN '.strtoupper($menu),0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);

        $data_laporan = $this->laporan_model->createLaporan($menu,'pdf');

        //judul
        for($j=0;$j<count($field[$menu]);$j++){
            if(count($field[$menu])-1 == $j){
                $pdf->Cell($field[$menu][$j][0],6,$title[$menu][$j],1,1);
            } else {
                $pdf->Cell($field[$menu][$j][0],6,$title[$menu][$j],1,0);
            }
        }
        $pdf->SetFont('Arial','',10);
        //isi
        foreach ($data_laporan as $row){
            for($i=0;$i<count($field[$menu]);$i++){
                if(count($field[$menu])-1 == $i){
                    $pdf->Cell($field[$menu][$i][0],$field[$menu][$i][1],$row[$field[$menu][$i][2]],1,1);
                } else {
                    $pdf->Cell($field[$menu][$i][0],$field[$menu][$i][1],$row[$field[$menu][$i][2]],1,0);
                }
            }
        }
        
        $pdf->Output();
    }

}