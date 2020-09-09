<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class pengunjung extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('pengunjung/pengunjung_model');
	}

	public function get_pengunjung_json()
	{
		header('Content-Type: application/json');
		echo $this->pengunjung_model->get_pengunjung_json();
	}

	public function list_pengunjung()
	{
		 // Fetch users
		$this->db->select('*');
		$this->db->where("nama_pengunjung like '%". $this->input->get('search') ."%' ");
		$fetched_records = $this->db->get('pengunjung');
		$users = $fetched_records->result_array();

     	// Initialize Array with fetched data
		$data = array();
		foreach($users as $user){
			$data[] = array("id"=>$user['id_pengunjung'], "text"=>$user['nama_pengunjung']);
		}

		echo json_encode($data);
	}

	public function hapus($id)
	{
		$this->pengunjung_model->delete($id);
		$this->session->set_flashdata('success', 'dihapus');
		redirect('pengunjung','refresh');
	}

	public function index()
	{
		$data['judul'] = "Data Pengunjung";

		$this->load->view('templates/header', $data, FALSE);
		$this->load->view('pengunjung/index', $data, FALSE);
		$this->load->view('templates/footer', $data, FALSE);
	}

	public function tambah()
	{
		$valid = $this->form_validation;
		$valid->set_rules('nama_pengunjung', 'nama pengunjung', 'required');
		$valid->set_rules('tgl_pengunjung', 'tgl pengunjung', 'required');
		$valid->set_rules('alamat', 'alamat', 'required');
		$valid->set_rules('status', 'status', 'required');

		if ($valid->run()) {
			$this->pengunjung_model->insert($this->input->post());
			$this->session->set_flashdata('success', 'ditambah');
			redirect('pengunjung','refresh');
		}

		$data['judul'] = "Tambah pengunjung";

		$this->load->view('templates/header', $data, FALSE);
		$this->load->view('pengunjung/tambah', $data, FALSE);
		$this->load->view('templates/footer', $data, FALSE);
	}

	public function ubah($id)
	{
		$valid = $this->form_validation;
		$valid->set_rules('nama_pengunjung', 'nama pengunjung', 'required');
		$valid->set_rules('tgl_pengunjung', 'tgl pengunjung', 'required');
		$valid->set_rules('alamat', 'alamat', 'required');
		$valid->set_rules('status', 'status', 'required');

		if ($valid->run()) {
			$this->pengunjung_model->update($id, $this->input->post());
			$this->session->set_flashdata('success', 'diubah');
			redirect('pengunjung','refresh');
		}

		$data['judul'] = "Ubah pengunjung";
		$data['pengunjung'] = $this->pengunjung_model->get_pengunjung($id);

		$this->load->view('templates/header', $data, FALSE);
		$this->load->view('pengunjung/ubah', $data, FALSE);
		$this->load->view('templates/footer', $data, FALSE);
	}

	public function export()
	{
		$pengunjung = $this->pengunjung_model->get_pengunjung();
		$spreadsheet = new Spreadsheet();
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'ID')
		->setCellValue('B1', 'Tanggal Pengunjung')
		->setCellValue('C1', 'nama lembaga')
		->setCellValue('D1', 'nama pengunjung')
		->setCellValue('E1', 'alamat')
		->setCellValue('F1', 'no telp')
		->setCellValue('G1', 'no fax')
		->setCellValue('H1', 'no hp')
		->setCellValue('I1', 'email')
		->setCellValue('J1', 'status')
		;
		// Miscellaneous glyphs, UTF-8
		$i=2; 
		foreach($pengunjung as $row) {
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $i, $row['id_pengunjung'])
			->setCellValue('B' . $i, $row['tgl_pengunjung'])
			->setCellValue('C' . $i, $row['nama_lembaga'])
			->setCellValue('D' . $i, $row['nama_pengunjung'])
			->setCellValue('E' . $i, $row['alamat'])
			->setCellValue('F' . $i, $row['no_telp'])
			->setCellValue('G' . $i, $row['no_fax'])
			->setCellValue('H' . $i, $row['no_hp'])
			->setCellValue('I' . $i, $row['email'])
			->setCellValue('J' . $i, $row['status']);
			$i++;
		}                           

		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data pengunjung.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}
	

}

/* End of file pengunjung.php */
/* Location: ./application/modules/pengunjung/controllers/pengunjung.php */ ?>