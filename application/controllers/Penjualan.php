<?php

use Dompdf\Dompdf;

class Penjualan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('M_menu', 'm_menu');
		$this->load->model('M_meja', 'm_meja');
		$this->load->model('M_kasir', 'm_kasir');
		$this->load->model('M_penjualan', 'm_penjualan');
		$this->load->model('M_detail_penjualan', 'm_detail_penjualan');
		$this->data['aktif'] = 'penjualan';
	}

	public function index()
	{
		$this->data['title'] = 'Data Penjualan';
		$this->data['all_menu'] = $this->m_menu->lihat();

		$this->load->view('penjualan/tambah', $this->data);
	}

	public function nomorMeja()
	{
		$daftarmeja = $this->m_meja->nomorMeja();
		echo json_encode($daftarmeja);
	}


	public function simpanTransaksi()
	{
		// Ambil data dari form
		$id_pesanan = $this->input->post('id_pesanan');
		$id_user = $this->input->post('id_user');
		$id_meja = $this->input->post('meja');
		$total_bayar = $this->input->post('total_bayar');
		$jumlahDibayar = $this->input->post('jumlahDibayar');
		$kembalian = $this->input->post('kembalian');
		$jenis_pembayaran = $this->input->post('jenis_pembayaran');

		// Lakukan pengolahan tanggal sesuai kebutuhan
		$tanggal_pemesanan = date('Y-m-d H:i:s'); // Contoh, bisa diatur sesuai format yang diinginkan

		// Simpan data ke dalam database
		$data = array(
			'id_pesanan' => $id_pesanan,
			'id_user' => $id_user,
			'id_meja' => $id_meja,
			'total_bayar' => $total_bayar,
			'total_dibayar' => $jumlahDibayar,
			'kembalian' => $kembalian,
			'jenis_pembayaran' => $jenis_pembayaran,
			'tanggal_pemesanan' => date('Y-m-d H:i:s'),
			// ... tambahkan field lain jika ada
		);

		// Simpan ke dalam tabel 'orders' (contoh nama tabel)
		if ($this->m_penjualan->tambah($data)) {
			// bikin query yg looping untuk insert ke detail order berdasarkan input hidden
			// for ($i = 0; $i < count($this->input->post('id_menu')); $i++) {
				$this->m_meja->updateStatusMeja($id_meja, 'tidak_tersedia');
			// }
			$this->session->set_flashdata('success', 'Data Kasir <strong>Berhasil</strong> Ditambahkan!');
			redirect('penjualan');
		} else {
			$this->session->set_flashdata('error', 'Data Kasir <strong>Gagal</strong> Ditambahkan!');
			redirect('penjualan');
		}

		// Redirect atau berikan respons setelah penyimpanan
		// redirect('halaman_setelah_simpan'); // Redirect ke halaman lain jika diperlukan
		// echo json_encode(array('status' => 'success')); // Respons JSON jika diinginkan
	}


	public function simpan_detail_order()
	{
		// Mengambil data yang dikirim dari client (JavaScript)
		$detail_order = json_decode(file_get_contents('php://input'), true);

		// Lakukan validasi data jika diperlukan
		// ...

		// Simpan data detail order ke dalam database
		$result = $this->m_detail_penjualan->simpanDetailOrder($detail_order);


		// Kirim respons ke client (JavaScript)
		if ($result) {
			$id_pesanan = $detail_order[0]['id_pesanan'];
			$resultstruk = $this->m_detail_penjualan->getdetailstruk($id_pesanan);
			echo json_encode(array('status' => 'success', 'data' => $resultstruk));
		} else {
			echo json_encode(array('status' => 'error'));
		}
	}

	public function riwayat()
	{
		$this->data['title'] = 'Riwayat Penjualan';
		$this->data['all_penjualan'] = $this->m_penjualan->lihat();

		$this->load->view('penjualan/riwayat', $this->data);
	}


	public function detail($id_pesanan)
	{
		$this->data['title'] = 'Detail Penjualan';
		$this->data['penjualan'] = $this->m_penjualan->lihat_no_penjualan($id_pesanan);
		$this->data['all_detail_penjualan'] = $this->m_detail_penjualan->getdetailstruk($id_pesanan);
		$this->data['no'] = 1;

		$this->load->view('penjualan/detail', $this->data);
	}

	public function hapus($id_pesanan)
	{
		if ($this->m_detail_penjualan->hapus($id_pesanan) && $this->m_penjualan->hapus($id_pesanan)) {
			$this->session->set_flashdata('success', 'Invoice Penjualan <strong>Berhasil</strong> Dihapus!');
			redirect('penjualan/riwayat');
		} else {
			$this->session->set_flashdata('error', 'Invoice Penjualan <strong>Gagal</strong> Dihapus!');
			redirect('penjualan/riwayat');
		}
	}

	public function export()
	{
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_penjualan'] = $this->m_penjualan->lihat();
		$this->data['title'] = 'Laporan Data Penjualan';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('penjualan/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Penjualan Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function export_detail($no_penjualan)
	{
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['penjualan'] = $this->m_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['all_detail_penjualan'] = $this->m_detail_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['title'] = 'Laporan Detail Penjualan';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('penjualan/detail_report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Detail Penjualan Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}
