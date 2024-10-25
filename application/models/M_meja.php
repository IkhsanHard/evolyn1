<?php

class M_meja extends CI_Model
{
	protected $_table = 'meja';

	public function lihat()
	{
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function nomorMeja()
	{
		$this->db->where('status', 'tersedia');
		$query = $this->db->get($this->_table);
		return $query->result_array(); // Change this line to return an associative array
	}

	public function updateStatusMeja($id_meja, $status)
{
    // Assuming 'meja' is the name of your table and 'status_meja' is the column name
    $this->db->where('id_meja', $id_meja);
    $this->db->update('meja', array('status' => $status));
}


	public function jumlah()
	{
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_stok()
	{
		$query = $this->db->get_where($this->_table, 'stok > 1');
		return $query->result();
	}

	public function lihat_id_meja($id_meja)
	{
		$query = $this->db->get_where($this->_table, ['id_meja' => $id_meja]);
		return $query->row();
	}

	public function lihat_nama_barang($id_menu)
	{
		$query = $this->db->select('*');
		$query = $this->db->where(['id_menu' => $id_menu]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function tambah($data)
	{
		return $this->db->insert($this->_table, $data);
	}

	public function min_stok($stok, $nama_barang)
	{
		$query = $this->db->set('stok', 'stok-' . $stok, false);
		$query = $this->db->where('nama_barang', $nama_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function ubah($data, $id_meja)
	{
		$query = $this->db->set($data);
		$query = $this->db->where(['id_meja' => $id_meja]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($id_meja)
	{
		return $this->db->delete($this->_table, ['id_meja' => $id_meja]);
	}
}
