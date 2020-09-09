<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pengunjung_model extends CI_Model {

	public function get_pengunjung_json()
	{
		$this->datatables->select('id_pengunjung, tgl_pengunjung, nama_lembaga,nama_pengunjung, alamat,no_telp,no_fax,no_hp,email,status');
		$this->datatables->from('pengunjung');
		return $this->datatables->generate();
	}

	public function get_pengunjung($id = '')
	{
		if ($id == '') {
			return $this->db->get('pengunjung')->result_array();
		}else {
			$this->db->where('id_pengunjung', $id);
			return $this->db->get('pengunjung')->row_array();
		}
	}

	public function delete($id)
	{
		$this->db->delete('pengunjung', ['id_pengunjung' => $id]);
	}

	public function insert($post)
	{
		$data = [
			'tgl_pengunjung' => $post['tgl_pengunjung'],
			'nama_lembaga' => $post['nama_lembaga'],
			'nama_pengunjung' => $post['nama_pengunjung'],
			'alamat' => $post['alamat'],
			'no_telp' => $post['no_telp'],
			'no_fax' => $post['no_fax'],
			'no_hp' => $post['no_hp'],
			'email' => $post['email'],
			'status' => $post['status']
		];

		$this->db->insert('pengunjung', $data);
	}

	public function update($id, $post)
	{
		$data = [
			'tgl_pengunjung' => $post['tgl_pengunjung'],
			'nama_lembaga' => $post['nama_lembaga'],
			'nama_pengunjung' => $post['nama_pengunjung'],
			'alamat' => $post['alamat'],
			'no_telp' => $post['no_telp'],
			'no_fax' => $post['no_fax'],
			'no_hp' => $post['no_hp'],
			'email' => $post['email'],
			'status' => $post['status']
		];

		$this->db->where('id_pengunjung', $id);
		$this->db->update('pengunjung', $data);
	}

}

/* End of file pengunjung_model.php */
/* Location: ./application/modules/pengunjung/models/pengunjung_model.php */ ?>