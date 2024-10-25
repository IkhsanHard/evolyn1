<?php

class M_kasir extends CI_Model
{
	protected $_table = 'users';

	public function lihat_kasir()
	{
		$query = $this->db->get($this->_table);
		$query = $this->db->get_where($this->_table, ['user_level' => 'Kasir']);
		return $query->result();
	}

	public function jumlah_kasir()
	{
		$query = $this->db->get($this->_table);
		$query = $this->db->get_where($this->_table, ['user_level' => 'Kasir']);
		return $query->num_rows();
	}

	public function jumlah_admin()
	{
		$query = $this->db->get($this->_table);
		$query = $this->db->get_where($this->_table, ['user_level' => 'Admin']);
		return $query->num_rows();
	}

	public function lihat_id_kasir($id_user)
	{
		$query = $this->db->get_where($this->_table, ['id_user' => $id_user, 'user_level' => 'Kasir']);
		return $query->row();
	}

	public function lihat_id_admin($id_user)
	{
		$query = $this->db->get_where($this->_table, ['id_user' => $id_user, 'user_level' => 'Admin']);
		return $query->row();
	}

	public function lihat_username_kasir($username)
	{
		$query = $this->db->get_where($this->_table, ['username' => $username, 'user_level' => 'Kasir']);
		return $query->row();
	}

	public function lihat_username_admin($username)
	{
		$query = $this->db->get_where($this->_table, ['username' => $username, 'user_level' => 'Admin']);
		return $query->row();
	}

	public function tambah($data)
	{
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $id_user)
	{
		$query = $this->db->set($data);
		$query = $this->db->where(['id_user' => $id_user]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function ubah_password($data, $username)
	{
		$this->db->where(['username' => $username]);
		return $this->db->update($this->_table, $data);
	}

	public function hapus($id_user)
	{
		return $this->db->delete($this->_table, ['id_user' => $id_user]);
	}
}
