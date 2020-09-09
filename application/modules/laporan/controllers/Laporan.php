<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class laporan extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('laporan/laporan_model');
	}

	public function get_laporan_json()
	{
		header('Content-Type: application/json');
		echo $this->laporan_model->get_laporan_json();
	}

	public function index()
	{
		$data['judul'] = "Laporan";

		if ($this->input->get('dari') && $this->input->get('sampai')) {
			$data['laporan'] = $this->laporan_model->get_laporan($this->input->get('dari'), $this->input->get('sampai'));
		}else{
			$data['laporan'] = $this->laporan_model->get_laporan();
		}


		$this->load->view('templates/header', $data, FALSE);
		$this->load->view('laporan/index', $data, FALSE);
		$this->load->view('templates/footer', $data, FALSE);
	}

	public function export($dari = '', $sampai = '')
	{
		if ($dari != '') {
			$laporan = $this->laporan_model->get_laporan($dari, $sampai);
		}else{
			$laporan = $this->laporan_model->get_laporan();
		}
		$spreadsheet = new Spreadsheet();
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'ID Kamar')
		->setCellValue('B1', 'Nama Kamar')
		->setCellValue('C1', 'Harga')
		->setCellValue('D1', 'Jumlah Disewa')
		->setCellValue('E1', 'Jumlah Transaksi')
		->setCellValue('F1', 'Subtotal')
		->setCellValue('G1', 'Jumlah Diskon')
		->setCellValue('H1', 'Total Pendapatan')
		;
		// Miscellaneous glyphs, UTF-8
		$i=2; 
		foreach($laporan as $row) {
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $i, $row['id_kamar'])
			->setCellValue('B' . $i, $row['nama_kamar'])
			->setCellValue('C' . $i, $row['harga'])
			->setCellValue('D' . $i, $row['jumlah_disewa'])
			->setCellValue('E' . $i, $row['jumlah_transaksi'])
			->setCellValue('F' . $i, $row['subtotal'])
			->setCellValue('G' . $i, $row['jumlah_diskon'])
			->setCellValue('H' . $i, $row['total_pendapatan'])
			;
			$i++;
		}                           

		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data laporan.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}
}

/* End of file laporan.php */
/* Location: ./application/modules/laporan/controllers/laporan.php */ ?>