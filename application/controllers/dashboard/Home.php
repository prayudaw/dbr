<?php
defined('BASEPATH') or exit('No direct script access allowed');

//saat development gunakan CI_Controller  -- MY_Controller 
class Home extends  MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model'); //wajib ada setiap di controller untuk menampilkan menu sidebar
        $this->load->model('barang_model');
    }

    public function index()
    {
        $data = array(
            'total_barang_bmn' => $this->barang_model->total_barang(),
            'total_barang_bmn_yg_blm_disensus' => $this->barang_model->total_barang_perpus_no_dbr(),
            // 'menus' => $this->menu_model->get_user_menus(1)
        );
        //load view
        $this->load->view('dashboard/home', $data);
    }
}
