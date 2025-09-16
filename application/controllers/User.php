<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        // ambil semua user
        $data['users'] = $this->User_model->get_all();

        // load view
        $this->load->view('user_list', $data);
    }
}
