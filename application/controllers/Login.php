<?php

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if ($this->session->login) redirect('dashboard');
		$this->load->model('M_kasir', 'm_kasir');
		// $this->load->model('M_pengguna', 'm_pengguna');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function proses_login()
	{
		if ($this->input->post('role') === 'kasir') $this->_proses_login_kasir($this->input->post('username'));
		elseif ($this->input->post('role') === 'admin') $this->_proses_login_admin($this->input->post('username'));
		else {
?>
			<script>
				alert('role tidak tersedia!')
			</script>
<?php
		}
	}

	protected function _proses_login_kasir($username)
	{
		$get_kasir = $this->m_kasir->lihat_username_kasir($username);
		if ($get_kasir) {
			if ($get_kasir->password == md5($this->input->post('password'))) {
				$session = [
					'nama' => $get_kasir->nama,
					'username' => $get_kasir->username,
					'id_user' => $get_kasir->id_user,
					'password' => md5($get_kasir->password),
					'user_level' => $get_kasir->user_level,
					'role' => $this->input->post('role'),
					'jam_masuk' => date('H:i:s')
				];

				$this->session->set_userdata('login', $session);
				$this->session->set_flashdata('success', '<strong>Login</strong> Berhasil!');
				redirect('penjualan');
			} else {
				$this->session->set_flashdata('error', 'Password Salah!');
				redirect();
			}
		} else {
			$this->session->set_flashdata('error', 'Username Salah!');
			redirect();
		}
	}

	protected function _proses_login_admin($username)
	{
		$get_admin = $this->m_kasir->lihat_username_admin($username);
		if ($get_admin) {
			if ($get_admin->password == $this->input->post('password')) {
				$session = [
					'nama' => $get_admin->nama,
					'username' => $get_admin->username,
					'id_user' => $get_admin->id_user,
					'password' => md5($get_admin->password),
					'user_level' => $get_admin->user_level,
					'role' => $this->input->post('role'),
					'jam_masuk' => date('Y-m-d H:i:s')
				];

				$this->session->set_userdata('login', $session);
				$this->session->set_flashdata('success', '<strong>Login</strong> Berhasil!');
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', 'Password Salah!');
				redirect();
			}
		} else {
			$this->session->set_flashdata('error', 'Username Salah!');
			redirect();
		}
	}
}
