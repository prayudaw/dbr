<?php
// application/core/MY_Controller.php

class MY_Controller extends CI_Controller
{

    public $allowed_urls;

    public function __construct()
    {
        parent::__construct();

        // 1. Cek apakah user sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('login'); // Ganti dengan URL login Anda
        }

        $this->load->model('access_model');

        // 2. Ambil Role ID dari session
        $role_id = $this->session->userdata('role_id');

        // 3. Ambil daftar URL yang diizinkan
        $this->allowed_urls = $this->access_model->get_allowed_urls($role_id);

        // 4. Lakukan pengecekan akses untuk URL saat ini
        $this->_check_access();
    }

    /**
     * Pengecekan utama untuk akses controller/method saat ini
     */
    private function _check_access()
    {

        // Ambil URL segmen saat ini (misal: 'dashboard/home')
        $current_segment = $this->uri->segment(1) . '/' . $this->uri->segment(2);


        // Untuk halaman utama Controller (misal 'admin/index'), segmen 2 mungkin kosong
        if ($this->uri->segment(2) === false) {
            $current_segment = $this->uri->segment(1) . '/index';
        }

        // Contoh: Lewatkan pengecekan untuk Controller khusus (misal 'home')
        if ($this->uri->segment(1) == 'home') {
            return;
        }

        // Cek apakah URL saat ini ada dalam daftar yang diizinkan
        if (!in_array($current_segment, $this->allowed_urls)) {
            // Jika tidak diizinkan, tampilkan error atau redirect
            show_error('Anda tidak memiliki izin untuk mengakses halaman ini.', 403, 'Akses Ditolak');
            // atau: redirect('dashboard/access_denied');
            exit();
        }
    }
}
