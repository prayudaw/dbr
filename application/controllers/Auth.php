<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // load model kalau perlu
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function login()
    {
        // jika tombol login ditekan
        if ($this->input->post('submit')) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // cek user di database lewat model
            $user = $this->User_model->check_login($username, $password);

            // DEBUG
        echo "<pre>"; print_r($user); echo "</pre>";

            if ($user) {
                // simpan session
                $this->session->set_userdata('user', $user);
                redirect('barang/daftar');
            } else {
                $data['error'] = "Username atau Password salah!";
                $this->load->view('login', $data);
            }
        } else {
            // tampilkan form login
            $this->load->view('login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user');
        redirect('login');
    }
}
