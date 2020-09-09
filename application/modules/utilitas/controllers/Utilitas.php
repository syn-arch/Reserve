<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class utilitas extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		cek_login();
	}

	public function backup()
	{
		$data['judul'] = "Backup Database";
		$data['db'] = $this->db->get('backup')->result_array();

		$this->load->view('templates/header', $data, FALSE);
		$this->load->view('utilitas/backup', $data, FALSE);
		$this->load->view('templates/footer', $data, FALSE);
	}

	public function backup_db()
	{
		//load helpers
		$this->load->helper('file');

		//load database
		$this->load->dbutil();

		$dbname = 'db-backup-on-' . date("Y-m-d-H-i-s");
		$this->db->insert('backup', ['file' => $dbname]);
		
		$prefs = array(
			'format' => 'txt',
			'filename' => 'epos_db_backup.sql'
		);
		$back = $this->dbutil->backup($prefs);
		$backup =& $back;
		$save='./assets/db_backup/'.$dbname.'.txt';
		$this->load->helper('file');
		write_file($save, $backup);

		// redirect
		$this->session->set_flashdata('success', 'dibackup');
		redirect('utilitas/backup','refresh');
	}

	public function hapus($id)
	{
		$backup = $this->db->get_where('backup', ['id_backup' => $id])->row_array()['file'];
		unlink(FCPATH . 'assets/db_backup/' . $backup . '.txt');
		$this->db->delete('backup',['id_backup' => $id]);
		$this->session->set_flashdata('success', 'dihapus');
		redirect('utilitas/backup','refresh');
	}

	public function download_db($name)
	{
		$this->load->helper('download');
		force_download($name . '.txt', file_get_contents(base_url('assets/db_backup/' .  $name . '.txt')));
	}

	function restore_db($db) {

		$file = file_get_contents(base_url('assets/db_backup/' .  $db . '.txt'));
		$this->db->conn_id->multi_query($file);
		$this->db->conn_id->close();

		$this->session->set_flashdata('success', 'direstore');
		redirect('auth/logout');
	}

}

/* End of file utilitas.php */
/* Location: ./application/modules/utilitas/controllers/utilitas.php */ ?>