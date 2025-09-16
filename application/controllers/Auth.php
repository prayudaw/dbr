<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function login()
    {
        if ($this->input->is_ajax_request()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->User_model->get_user_by_username($username);

            if ($user && password_verify($password, $user->password)) {
                $this->session->set_userdata([
                    'username'  => $user->username,
                    'logged_in' => TRUE
                ]);
                echo json_encode(['status' => 1, 'message' => 'Login berhasil']);
            } else {
                echo json_encode(['status' => 0, 'message' => 'Username atau password salah']);
            }
        } else {
            // kalau akses langsung tanpa AJAX
            $this->load->view('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}