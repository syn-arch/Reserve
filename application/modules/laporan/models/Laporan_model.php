<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_model extends CI_Model {

	public function get_laporan_json()
	{
		$this->datatables->select('id,tgl_laporan,nama_pengunjung,alamat,total_bayar,cash');
		$this->datatables->join('pengunjung', 'id_pengunjung');
		$this->datatables->from('laporan');
		return $this->datatables->generate();
	}

	public function get_laporan($dari = '', $sampai = '')
	{
		$this->db->select('kamar.id_kamar,
							nama_kamar,
							harga,
							SUM(detail_transaksi.diskon) AS jumlah_diskon,
							SUM(detail_transaksi.qty) AS jumlah_disewa, 
							COUNT(detail_transaksi.id_transaksi) AS jumlah_transaksi, 
							SUM(detail_transaksi.qty) * kamar.harga AS subtotal, 
							SUM(detail_transaksi.total_harga) AS total_pendapatan');
		$this->db->from('transaksi');
		$this->db->join('detail_transaksi', 'transaksi.id = detail_transaksi.id_transaksi');
		$this->db->join('kamar', 'detail_transaksi.id_kamar = kamar.id_kamar', 'left');
		if ($dari != '') {
			$this->db->where('DATE(tgl_transaksi) >=', $dari);
			$this->db->where('DATE(tgl_transaksi) <=', $sampai);
		}else{
		}
		$this->db->group_by('id_kamar');
		return $this->db->get()->result_array();
	}

}

/* End of file laporan_model.php */
/* Location: ./application/modules/laporan/models/laporan_model.php */ ?>