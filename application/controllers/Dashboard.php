<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->load->model('Barang_model');
        $this->load->model('Ruang_model');
    }

    public function home()
    {
        // $this->load->view('templates/header');
        // $this->load->view('templates/sidebar');
        // $this->load->view('templates/topbar');
        $this->load->view('home');
        // $this->load->view('templates/footer');
    }

    public function barang()
    {
        $data = array(
            'ruangan_options' => $this->db->select('*')->get('ruangan')->result_array()
        );
        // $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('barang_list', $data);
        $this->load->view('templates/footer');
    }

    public function user()
    {
        $this->load->model('User_model');
        $data['users'] = $this->User_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('user_list', $data);
        $this->load->view('templates/footer');
    }
}