<?php

class M_detail_penjualan extends CI_Model
{
	protected $_table = 'detail_order';

	public function lihat_no_penjualan($id_pesanan)
	{
		return $this->db->get_where($this->_table, ['id_pesanan' => $id_pesanan])->result();
	}

	public function simpanDetailOrder($detail_order)
	{
		// Lakukan operasi penyimpanan ke dalam tabel detail_order
		// Gunakan perulangan atau fungsi insert untuk menyimpan setiap data detail order ke dalam database
		foreach ($detail_order as $order) {
			$data = array(
				'id_pesanan' => $order['id_pesanan'],
				'id_menu' => $order['id_menu'],
				'jumlah_pesanan' => $order['jumlah_pesanan'],
				'harga_satuan' => $order['harga_satuan'],
				'total_harga' => $order['total_harga']
				// Tambahkan kolom lainnya jika diperlukan
			);
			$this->db->insert($this->_table, $data);
		}

		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function getdetailstruk(string $id_pesanan)
	{
		// Select fields from detail_order and menu tables using join
		$this->db->select('detail_order.*, menu.nama_menu');
		$this->db->from('detail_order');
		$this->db->join('menu', 'detail_order.id_menu = menu.id_menu');

		// Filter the query by $id_pesanan, assuming it's a field in detail_order
		$this->db->where('detail_order.id_pesanan', $id_pesanan);

		// Get the result
		$query = $this->db->get();

		// Return the query result as an array of objects
		return $query->result();
	}

	public function hapus($id_pesanan)
	{
		return $this->db->delete($this->_table, ['id_pesanan' => $id_pesanan]);
	}
}
