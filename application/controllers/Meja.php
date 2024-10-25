<?php

use Dompdf\Dompdf;

class Meja extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'meja';
		$this->load->model('M_meja', 'm_meja');
	}

	public function index()
	{
		$this->data['title'] = 'Data Meja';
		$this->data['all_meja'] = $this->m_meja->lihat();
		$this->data['no'] = 1;

		$this->load->view('meja/lihat', $this->data);
	}

	public function tambah()
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('penjualan');
		}

		$this->data['title'] = 'Tambah Meja';

		$this->load->view('meja/tambah', $this->data);
	}

	public function proses_tambah()
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('penjualan');
		}

		$data = [
			'nomor_meja' => $this->input->post('nomor_meja'),
			'kapasitas' => $this->input->post('kapasitas'),
		];

		if ($this->m_meja->tambah($data)) {
			$this->session->set_flashdata('success', 'Data Meja <strong>Berhasil</strong> Ditambahkan!');
			redirect('meja');
		} else {
			$this->session->set_flashdata('error', 'Data Meja <strong>Gagal</strong> Ditambahkan!');
			redirect('meja');
		}
	}

	public function ubah($id_meja)
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('penjualan');
		}

		$this->data['title'] = 'Ubah Meja';
		$this->data['meja'] = $this->m_meja->lihat_id_meja($id_meja);

		$this->load->view('meja/ubah', $this->data);
	}

	public function proses_ubah($id_meja)
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('penjualan');
		}

		$data = [
			'id_meja' => $this->input->post('id_meja'),
			'nomor_meja' => $this->input->post('nomor_meja'),
			'kapasitas' => $this->input->post('kapasitas'),
			'status' => $this->input->post('status')
		];

		if ($this->m_meja->ubah($data, $id_meja)) {
			$this->session->set_flashdata('success', 'Data Meja <strong>Berhasil</strong> Diubah!');
			redirect('meja');
		} else {
			$this->session->set_flashdata('error', 'Data Meja <strong>Gagal</strong> Diubah!');
			redirect('meja');
		}
	}

	public function hapus($id_meja)
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('penjualan');
		}

		if ($this->m_meja->hapus($id_meja)) {
			$this->session->set_flashdata('success', 'Data Meja <strong>Berhasil</strong> Dihapus!');
			redirect('meja');
		} else {
			$this->session->set_flashdata('error', 'Data Meja <strong>Gagal</strong> Dihapus!');
			redirect('meja');
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
