<?php

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->login['role'] != 'admin') redirect('penjualan');
		$this->data['aktif'] = 'dashboard';
		$this->load->model('M_menu', 'm_menu');
		$this->load->model('M_kasir', 'm_kasir');
		$this->load->model('M_penjualan', 'm_penjualan');
		$this->load->model('Graph_model');
		// $this->load->model('M_pengguna', 'm_pengguna');
		// $this->load->model('M_toko', 'm_toko');
	}
	public function index()
	{
		$this->data['title'] = 'Halaman Dashboard';
		$this->data['jumlah_menu'] = $this->m_menu->jumlah();
		$this->data['jumlah_kasir'] = $this->m_kasir->jumlah_kasir();
		$this->data['jumlah_penjualan'] = $this->m_penjualan->jumlah();
		$this->data['total_bayar'] = $this->m_penjualan->total_bayar();
		// $this->data['jumlah_pengguna'] = $this->m_kasir->jumlah_admin();
		// $this->data['toko'] = $this->m_toko->lihat();
		$this->load->view('dashboard', $this->data);
	}
	public function getGraphData()
	{
		// Panggil model atau lakukan query untuk mendapatkan data grafik
		$graphData = $this->Graph_model->getGraphData();

		// Format data sebagai JSON
		echo json_encode($graphData);
	}

	public function get_daily_summary()
	{
		// Panggil model untuk mendapatkan ringkasan pendapatan harian
		$ringkasan_pendapatan = $this->Graph_model->getDailySummary();

		// Mengembalikan data dalam format JSON
		echo json_encode($ringkasan_pendapatan);
	}
}
