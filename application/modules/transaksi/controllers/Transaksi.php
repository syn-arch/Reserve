<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class transaksi extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('transaksi/transaksi_model');
		$this->load->model('kamar/kamar_model');
		$this->load->model('pengunjung/pengunjung_model');
	}

	public function get_transaksi_json()
	{
		header('Content-Type: application/json');
		echo $this->transaksi_model->get_transaksi_json();
	}

	public function hapus($id)
	{
		$this->transaksi_model->delete($id);
		$this->session->set_flashdata('success', 'dihapus');
		redirect('transaksi','refresh');
	}

	public function index()
	{
		$data['judul'] = "Transaksi";

		$this->load->view('templates/header', $data, FALSE);
		$this->load->view('transaksi/index', $data, FALSE);
		$this->load->view('templates/footer', $data, FALSE);
	}

	public function tambah()
	{
		$valid = $this->form_validation;
		$valid->set_rules('tgl_transaksi', 'tgl transaksi', 'required');
		$valid->set_rules('id_pengunjung', 'pengunjung', 'required');

		if ($valid->run()) {
			$this->transaksi_model->insert($this->input->post());
			$this->session->set_flashdata('success', 'ditambah');
			redirect('transaksi','refresh');
		}

		$data['judul'] = "Tambah Transaksi";
		$data['kamar'] = $this->kamar_model->get_kamar();
		$data['pengunjung'] = $this->pengunjung_model->get_pengunjung();

		$this->load->view('templates/header', $data, FALSE);
		$this->load->view('transaksi/tambah', $data, FALSE);
		$this->load->view('templates/footer', $data, FALSE);
	}

	public function invoice($id)
	{
		$data['judul'] = "Invoice {$id}";
		$data['transaksi'] = $this->transaksi_model->get_transaksi($id);

		$this->load->view('templates/header', $data, FALSE);
		$this->load->view('transaksi/invoice', $data, FALSE);
		$this->load->view('templates/footer', $data, FALSE);
	}

	public function invoice_cetak($id)
	{
		$data['judul'] = "Invoice {$id}";
		$data['transaksi'] = $this->transaksi_model->get_transaksi($id);

		$this->load->view('transaksi/invoice_cetak', $data, FALSE);
	}

	public function ubah($id)
	{
		$valid = $this->form_validation;
		$valid->set_rules('tgl_transaksi', 'tgl transaksi', 'required');
		$valid->set_rules('id_pengunjung', 'pengunjung', 'required');

		if ($valid->run()) {
			$this->transaksi_model->update($id, $this->input->post());
			$this->session->set_flashdata('success', 'diubah');
			redirect('transaksi','refresh');
		}

		$data['judul'] = "Ubah Transaksi";
		$data['kamar'] = $this->kamar_model->get_kamar();
		$data['transaksi'] = $this->transaksi_model->get_transaksi($id);
		$data['pengunjung'] = $this->pengunjung_model->get_pengunjung();

		$this->load->view('templates/header', $data, FALSE);
		$this->load->view('transaksi/ubah', $data, FALSE);
		$this->load->view('templates/footer', $data, FALSE);
	}

	public function export()
	{
		$transaksi = $this->transaksi_model->get_transaksi();
		$spreadsheet = new Spreadsheet();
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'ID')
		->setCellValue('B1', 'Tanggal')
		->setCellValue('C1', 'Nama Pengunjung')
		->setCellValue('D1', 'Alamat')
		->setCellValue('E1', 'Total Bayar')
		->setCellValue('F1', 'Cash')
		->setCellValue('G1', 'Kembalian')
		;
		// Miscellaneous glyphs, UTF-8
		$i=2; 
		foreach($transaksi as $row) {
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $i, $row['id'])
			->setCellValue('B' . $i, $row['tgl_transaksi'])
			->setCellValue('C' . $i, $row['nama_pengunjung'])
			->setCellValue('D' . $i, $row['alamat'])
			->setCellValue('E' . $i, $row['total_bayar'])
			->setCellValue('F' . $i, $row['cash'])
			->setCellValue('G' . $i, $row['cash'] - $row['total_bayar']);
			$i++;
		}                           

		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data transaksi.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}
	

}

/* End of file transaksi.php */
/* Location: ./application/modules/transaksi/controllers/transaksi.php */ ?>