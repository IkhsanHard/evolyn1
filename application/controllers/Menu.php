<?php

use Dompdf\Dompdf;

class Menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'menu';
		$this->load->model('M_menu', 'm_menu');
	}

	public function index()
	{
		$this->data['title'] = 'Data Menu';
		$this->data['all_menu'] = $this->m_menu->lihat();
		$this->data['no'] = 1;

		$this->load->view('menu/lihat', $this->data);
	}

	public function tambah()
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('penjualan');
		}

		$this->data['title'] = 'Tambah Menu';

		$this->load->view('menu/tambah', $this->data);
	}

	public function proses_tambah()
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('penjualan');
		}

		$config['upload_path'] = './uploads/'; // Folder tempat menyimpan gambar di server
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 2048; // Ukuran maksimum dalam kilobytes

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$error = $this->upload->display_errors();
			// Jika gagal upload, bisa lakukan sesuatu, misalnya:
			$this->session->set_flashdata('error', 'Gagal upload gambar: ' . $error);
			redirect('menu');
		} else {
			$upload_data = $this->upload->data();
			// $namaFile = './uploads/' . $_FILES['gambar']['name'];
			$namaFile = './uploads/' . str_replace(' ', '_', $_FILES['gambar']['name']); // Ganti spasi dengan _
			$gambar = file_get_contents($upload_data['full_path']); // Ambil data gambar

			$data = [
				'id_menu' => $this->input->post('id_menu'),
				'nama_menu' => $this->input->post('nama_menu'),
				'deskripsi' => $this->input->post('deskripsi'),
				'harga' => $this->input->post('harga'),
				'kategori' => $this->input->post('kategori'),
				'gambar' => $namaFile, // Simpan data gambar
				'Created_at' => date('Y-m-d H:i:s'),
			];

			if ($this->m_menu->tambah($data)) {
				$this->session->set_flashdata('success', 'Data Menu <strong>Berhasil</strong> Ditambahkan!');
				redirect('menu');
			} else {
				$this->session->set_flashdata('error', 'Data Menu <strong>Gagal</strong> Ditambahkan!');
				redirect('menu');
			}
		}
	}

	public function ubah($id_menu)
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('penjualan');
		}

		$this->data['title'] = 'Ubah Menu';
		$this->data['menu'] = $this->m_menu->lihat_id($id_menu);

		$this->load->view('menu/ubah', $this->data);
	}

	public function proses_ubah($id_menu)
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('penjualan');
		}

		$data = [
			'id_menu' => $this->input->post('id_menu'),
			'nama_menu' => $this->input->post('nama_menu'),
			'deskripsi' => $this->input->post('deskripsi'),
			'harga' => $this->input->post('harga'),
			'kategori' => $this->input->post('kategori'),
		];

		if ($this->m_menu->ubah($data, $id_menu)) {
			$this->session->set_flashdata('success', 'Data Menu <strong>Berhasil</strong> Diubah!');
			redirect('menu');
		} else {
			$this->session->set_flashdata('error', 'Data Menu <strong>Gagal</strong> Diubah!');
			redirect('menu');
		}
	}

	public function hapus($id_menu)
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('penjualan');
		}

		if ($this->m_menu->hapus($id_menu)) {
			$this->session->set_flashdata('success', 'Data Menu <strong>Berhasil</strong> Dihapus!');
			redirect('menu');
		} else {
			$this->session->set_flashdata('error', 'Data Menu <strong>Gagal</strong> Dihapus!');
			redirect('menu');
		}
	}

	public function export()
	{
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_barang'] = $this->m_barang->lihat();
		$this->data['title'] = 'Laporan Data Barang';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('barang/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Barang Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}
