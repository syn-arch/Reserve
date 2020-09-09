<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kamar_model extends CI_Model {

	public function get_kamar_json()
	{
		$this->datatables->select('id,id_kamar, nama_kamar, harga,keterangan');
		$this->datatables->from('kamar');
		return $this->datatables->generate();
	}

	public function get_kamar($id = '')
	{
		if ($id == '') {
			return $this->db->get('kamar')->result_array();
		}else {
			$this->db->where('id_kamar', $id);
			return $this->db->get('kamar')->row_array();
		}
	}

	public function delete($id)
	{
		$this->db->delete('kamar', ['id_kamar' => $id]);
	}

	public function insert($post)
	{
		$data = [
			'id_kamar' => $post['id_kamar'],
			'nama_kamar' => $post['nama_kamar'],
			'harga' => $post['harga'],
			'keterangan' => $post['keterangan']
		];

		$this->db->insert('kamar', $data);
	}

	public function update($id, $post)
	{
		$data = [
			'nama_kamar' => $post['nama_kamar'],
			'harga' => $post['harga'],
			'keterangan' => $post['keterangan']
		];

		$this->db->where('id_kamar', $id);
		$this->db->update('kamar', $data);
	}

}

/* End of file kamar_model.php */
/* Location: ./application/modules/kamar/models/kamar_model.php */ ?>