<?php
defined('BASEPATH') or exit('No direct script access allowed');
//saat development gunakan CI_Controller  -- MY_Controller 
class User extends  MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('roles_model');
        $this->load->model('menu_model'); //wajib ada setiap di controller untuk menampilkan menu sidebar
    }

    public function index()
    {
        $data['page_title'] = 'List Username';
        $data['role_user'] = $this->roles_model->get_role_user();

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
        //looping data user
        foreach ($list as $Data) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $Data->username;
            $row[] = $this->get_role_name_by_id($Data->role);
            // $row[] = $Data->role;
            $row[] = '<a href="javascript:void(0)" id="btn-edit-post" data-id="' . $Data->id . '" class="btn btn-primary btn-sm"><i class ="fa fa-edit"></i> Edit</a>
           ';
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

    private function get_role_name_by_id($id)
    {

        $get_data = $this->roles_model->get_role_by_id($id);
        return $get_data['role_name'];
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
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role' => $this->input->post('role')
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

    public function add_user()
    {
        header('Content-Type: application/json');
        $POST = $this->input->post();

        $username = trim($POST['username']);
        $password = trim($POST['password']);
        $role = $POST['role'];

        if ($username !== '' && $password  !== '' && $role  !== '') {
            $data_add = array(
                'username' =>  $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role' => $role
            );

            $insert = $this->user_model->insert_user($data_add); //proses input data ke database
            if ($insert) {
                $data = array(
                    'status' => 1,
                    'message' => 'Data Berhasil di Simpan'
                );
            }
        } else {
            $data = array(
                'status' => 0,
                'message' => 'Data harus lengkap'
            );
        }

        echo json_encode($data);
    }
}
