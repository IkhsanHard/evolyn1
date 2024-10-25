<?php

class M_penjualan extends CI_Model
{
	protected $_table = 'orders';

	public function lihat()
	{
		return $this->db->get($this->_table)->result();
	}

	public function jumlah()
	{
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function total_bayar()
{
    $this->db->select_sum('total_bayar');
    $query = $this->db->get('orders');

    // Mengembalikan hasil dari perhitungan total_bayar
    return $query->row()->total_bayar;
}

	public function lihat_no_penjualan($id_pesanan)
	{
		return $this->db->get_where($this->_table, ['id_pesanan' => $id_pesanan])->row();
	}

	public function tambah($data)
	{
		return $this->db->insert($this->_table, $data);
	}

	public function hapus($id_pesanan)
	{
		return $this->db->delete($this->_table, ['id_pesanan' => $id_pesanan]);
	}
}
