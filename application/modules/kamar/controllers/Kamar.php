<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class kamar extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('kamar/kamar_model');
	}

	public function get_kamar_json()
	{
		header('Content-Type: application/json');
		echo $this->kamar_model->get_kamar_json();
	}

	public function get_kamar($id_kamar)
	{
		echo json_encode($this->db->get_where('kamar', ['id_kamar' => $id_kamar])->row_array());
	}

	public function hapus($id)
	{
		$this->kamar_model->delete($id);
		$this->session->set_flashdata('success', 'dihapus');
		redirect('kamar','refresh');
	}

	public function index()
	{
		$data['judul'] = "Data Kamar";

		$this->load->view('templates/header', $data, FALSE);
		$this->load->view('kamar/index', $data, FALSE);
		$this->load->view('templates/footer', $data, FALSE);
	}

	public function tambah()
	{
		$valid = $this->form_validation;
		$valid->set_rules('nama_kamar', 'nama kamar', 'required');
		$valid->set_rules('harga', 'harga', 'required');

		if ($valid->run()) {
			$this->kamar_model->insert($this->input->post());
			$this->session->set_flashdata('success', 'ditambah');
			redirect('kamar','refresh');
		}

		$data['judul'] = "Tambah kamar";

		$this->load->view('templates/header', $data, FALSE);
		$this->load->view('kamar/tambah', $data, FALSE);
		$this->load->view('templates/footer', $data, FALSE);
	}

	public function ubah($id)
	{
		$valid = $this->form_validation;
		$valid->set_rules('nama_kamar', 'nama kamar', 'required');
		$valid->set_rules('harga', 'harga', 'required');

		if ($valid->run()) {
			$this->kamar_model->update($id, $this->input->post());
			$this->session->set_flashdata('success', 'diubah');
			redirect('kamar','refresh');
		}

		$data['judul'] = "Ubah kamar";
		$data['kamar'] = $this->kamar_model->get_kamar($id);

		$this->load->view('templates/header', $data, FALSE);
		$this->load->view('kamar/ubah', $data, FALSE);
		$this->load->view('templates/footer', $data, FALSE);
	}

	public function export()
	{
		$kamar = $this->kamar_model->get_kamar();
		$spreadsheet = new Spreadsheet();
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'ID')
		->setCellValue('B1', 'Kode kamar')
		->setCellValue('C1', 'Nama kamar')
		->setCellValue('D1', 'Harga')
		->setCellValue('E1', 'Keterangan')
		;
		// Miscellaneous glyphs, UTF-8
		$i=2; 
		foreach($kamar as $row) {
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $i, $row['id'])
			->setCellValue('B' . $i, $row['id_kamar'])
			->setCellValue('C' . $i, $row['nama_kamar'])
			->setCellValue('D' . $i, $row['harga'])
			->setCellValue('E' . $i, $row['keterangan']);
			$i++;
		}                           

		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data kamar.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}
	

}

/* End of file kamar.php */
/* Location: ./application/modules/kamar/controllers/kamar.php */ ?>