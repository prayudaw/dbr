<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Access extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('access_model');
        $this->load->model('roles_model');
        $this->load->model('menu_model'); //wajib ada setiap di controller untuk menampilkan menu sidebar
        // Jika user belum login, arahkan kembali ke halaman login 
        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('login'); // 
        }
    }

    public function index()
    {
        //code here
    }

    public function view_access($role_id)
    {
        $get_data_role = $this->roles_model->get_role_by_id($role_id); //get data role by id
        $data['page_title'] = 'Edit Hak Akses';
        $data['menus'] = $this->access_model->get_all_menus(); //list menu
        $data['current_access'] = $this->access_model->get_access_by_role($role_id); // list access berdasarkan role
        $data['role_id'] = $role_id;
        $data['role_data'] =  $get_data_role;
        $this->load->view('dashboard/access/view', $data);
    }

    //proses update
    public function update()
    {
        $role_id = $this->input->post('role_id');
        $menu_ids = $this->input->post('menu_ids');

        if ($this->access_model->update_access($role_id, $menu_ids)) {
            echo json_encode(['status' => 'success', 'message' => 'Hak akses berhasil diperbarui.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui hak akses.']);
        }
    }
}