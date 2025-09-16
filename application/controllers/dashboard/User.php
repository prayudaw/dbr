<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index()
    {
        $data['page_title'] = 'List Username';
        // load view
        $this->load->view('dashboard/user/list', $data);
    }

    // get list user dengan datatable
    public function ajax_list()
    {
        header('Content-Type: application/json');
        $list = $this->user_model->get_datatables();
        $data = array();

        $no = $this->input->post('start');
        //looping data mahasiswa
        foreach ($list as $Data) {
            $no++;
            $row = array();
            //row pertama akan kita gunakan untuk btn edit dan delete
            $row[] = $no;
            $row[] = $Data->username;
            $row[] = $Data->role;
            $row[] = '<a href="javascript:void(0)" id="btn-edit-post" data-id="' . $Data->id . '" class="btn btn-primary btn-sm"><i class ="fa fa-edit"></i> Edit</a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->user_model->count_all(),
            "recordsFiltered" => $this->user_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
    }

    public function get_user_by_id()
    {
        header('Content-Type: application/json');
        $id = (int)$this->input->get('id');
        $data = $this->user_model->get_user_by_id($id);
        echo json_encode($data);
    }

    public function update()
    {
        header('Content-Type: application/json');
        $id = $this->input->post('id');

        $username = trim($this->input->post('username'));
        $password = trim($this->input->post('password'));

        if ($username !== '' && $password !== '') {
            $data_update = array(
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            );
            $update = $this->user_model->update_user_by_id($data_update, $id);
            $data = array(
                'status' => 1,
                'message' => 'Data Berhasil diupdate'
            );
        } else {
            $data = array(
                'status' => 0,
                'message' => 'username dan password harus diisi'
            );
        }
        echo json_encode($data);
    }
}
