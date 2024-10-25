<?php

use Dompdf\Dompdf;

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
        $this->data['aktif'] = 'auth';
        $this->load->model('M_kasir', 'm_kasir');
    }

    public function index()
    {
        $this->data['title'] = 'Change Password';

        $this->load->view('change_password_form', $this->data);
    }

    public function proses_ubah()
    {
        // Ambil data dari form
        $username = $this->input->post('username');
        $password = md5($this->input->post('password')); // Gunakan MD5 untuk hashing password
        $confirm_password = $_POST['confirm_password'];

        // Data yang akan diupdate
        $data = [
            'password' => $password,
            'Updated_at' => date('Y-m-d H:i:s'),
        ];

        // Panggil model untuk melakukan update password
        if ($this->m_kasir->ubah_password($data, $username)) {
            $this->session->set_flashdata('success', 'Password Kasir berhasil diubah!');
            redirect('auth');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengubah password Kasir.');
            redirect('auth');
        }
    }
}
