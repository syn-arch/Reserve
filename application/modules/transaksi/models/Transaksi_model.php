<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transaksi_model extends CI_Model {

	public function get_transaksi_json()
	{
		$this->datatables->select('id,tgl_transaksi,nama_pengunjung,alamat,total_bayar,cash');
		$this->datatables->join('pengunjung', 'id_pengunjung');
		$this->datatables->from('transaksi');
		$this->db->order_by('id', 'desc');
		return $this->datatables->generate();
	}

	public function get_transaksi($id = '')
	{
		if ($id == '') {
			$this->db->join('pengunjung', 'id_pengunjung');
			$this->db->join('petugas', 'id_petugas');
			return $this->db->get('transaksi')->result_array();
		}else {
			$this->db->join('pengunjung', 'id_pengunjung');
			$this->db->join('petugas', 'id_petugas');
			$this->db->where('id', $id);
			return $this->db->get('transaksi')->row_array();
		}
	}

	public function delete($id)
	{
		$this->db->delete('transaksi', ['id' => $id]);
		$this->db->delete('detail_transaksi', ['id_transaksi' => $id]);
	}

	public function insert($post)
	{
		$this->db->trans_start();

		$data = [
			'tgl_transaksi' => $post['tgl_transaksi'],
			'id_pengunjung' => $post['id_pengunjung'],
			'id_petugas' => $post['id_petugas'],
			'cash' => $post['cash'],
			'total_bayar' => $post['total_bayar'],
			'keterangan' => $post['keterangan']
		];

		$this->db->insert('transaksi', $data);

		$id = $this->db->insert_id();

		for ($i=0; $i < count($post['id_kamar']); $i++) { 
			$data_detail = [
				'id_transaksi' => $id,
				'id_kamar' => $post['id_kamar'][$i],
				'qty' => $post['qty'][$i],
				'diskon' => $post['diskon'][$i],
				'total_harga' => $post['total_harga'][$i]
			];

			$this->db->insert('detail_transaksi', $data_detail);
		}

		$this->db->trans_complete();

		redirect('transaksi/invoice/' . $id,'refresh');
	}

	public function update($id, $post)
	{
		$this->db->trans_start();

		$data = [
			'tgl_transaksi' => $post['tgl_transaksi'],
			'id_pengunjung' => $post['id_pengunjung'],
			'id_petugas' => $post['id_petugas'],
			'cash' => $post['cash'],
			'total_bayar' => $post['total_bayar'],
			'keterangan' => $post['keterangan']
		];

		$this->db->where('id', $id);
		$this->db->update('transaksi', $data);

		$this->db->delete('detail_transaksi', ['id_transaksi' => $id]);

		for ($i=0; $i < count($post['id_kamar']); $i++) { 
			$data_detail = [
				'id_transaksi' => $id,
				'id_kamar' => $post['id_kamar'][$i],
				'qty' => $post['qty'][$i],
				'diskon' => $post['diskon'][$i],
				'total_harga' => $post['total_harga'][$i]
			];

			$this->db->insert('detail_transaksi', $data_detail);
		}

		$this->db->trans_complete();
	}

}

/* End of file transaksi_model.php */
/* Location: ./application/modules/transaksi/models/transaksi_model.php */ ?>