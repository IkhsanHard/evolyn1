<?php

class M_menu extends CI_Model
{
	protected $_table = 'menu';

	public function lihat()
	{
		$query = $this->db->get($this->_table);
		return $query->result();
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

	public function lihat_id($id_menu)
	{
		$query = $this->db->get_where($this->_table, ['id_menu' => $id_menu]);
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

	public function ubah($data, $id_menu)
	{
		$query = $this->db->set($data);
		$query = $this->db->where(['id_menu' => $id_menu]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($id_menu)
	{
		return $this->db->delete($this->_table, ['id_menu' => $id_menu]);
	}
}
