<?php

use Dompdf\Dompdf;

class Kasir extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'kasir';
		$this->load->model('M_kasir', 'm_kasir');
	}

	public function index()
	{
		$this->data['title'] = 'Data Kasir';
		$this->data['all_kasir'] = $this->m_kasir->lihat_kasir();
		$this->data['no'] = 1;

		$this->load->view('kasir/lihat', $this->data);
	}

	public function tambah()
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('penjualan');
		}

		$this->data['title'] = 'Tambah Kasir';

		$this->load->view('kasir/tambah', $this->data);
	}

	public function proses_tambah()
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('penjualan');
		}

		$data = [
			'id_user' => $this->input->post('id_kasir'),
			'nama' => $this->input->post('nama_kasir'),
			'username' => $this->input->post('username_kasir'),
			'password' => md5($this->input->post('password_kasir')),
			'user_level' => 'Kasir',
			'Status' => 'Aktif',
			'Created_at' => date('Y-m-d H:i:s'),
			'Updated_at' => date('Y-m-d H:i:s'),
		];

		if ($this->m_kasir->tambah($data)) {
			$this->session->set_flashdata('success', 'Data Kasir <strong>Berhasil</strong> Ditambahkan!');
			redirect('kasir');
		} else {
			$this->session->set_flashdata('error', 'Data Kasir <strong>Gagal</strong> Ditambahkan!');
			redirect('kasir');
		}
	}

	public function ubah($id_user)
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('penjualan');
		}

		$this->data['title'] = 'Ubah Kasir';
		$this->data['kasir'] = $this->m_kasir->lihat_id_kasir($id_user);

		$this->load->view('kasir/ubah', $this->data);
	}

	public function proses_ubah($id_user)
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('penjualan');
		}

		$data = [
			'id_user' => $this->input->post('id_kasir'),
			'nama' => $this->input->post('nama_kasir'),
			'username' => $this->input->post('username_kasir'),
			'password' => $this->input->post('password_kasir'),
			'Status' => $this->input->post('Status'),
			'Updated_at' => date('Y-m-d H:i:s'),
		];

		if ($this->m_kasir->ubah($data, $id_user)) {
			$this->session->set_flashdata('success', 'Data Kasir <strong>Berhasil</strong> Diubah!');
			redirect('kasir');
		} else {
			$this->session->set_flashdata('error', 'Data Kasir <strong>Gagal</strong> Diubah!');
			redirect('kasir');
		}
	}

	public function hapus($id_user)
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('penjualan');
		}

		if ($this->m_kasir->hapus($id_user)) {
			$this->session->set_flashdata('success', 'Data Kasir <strong>Berhasil</strong> Dihapus!');
			redirect('kasir');
		} else {
			$this->session->set_flashdata('error', 'Data Kasir <strong>Gagal</strong> Dihapus!');
			redirect('kasir');
		}
	}

	public function export()
	{
		$dompdf = new Dompdf();
		$this->data['all_kasir'] = $this->m_kasir->lihat_kasir();
		$this->data['title'] = 'Laporan Data Kasir';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('kasir/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Kasir Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}
