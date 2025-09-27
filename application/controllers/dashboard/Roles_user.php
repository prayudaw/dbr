<?php
defined('BASEPATH') or exit('No direct script access allowed');

//saat development gunakan CI_Controller  -- MY_Controller 
class Roles_user extends  MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('roles_model');
        $this->load->model('menu_model'); //wajib ada setiap di controller untuk menampilkan menu sidebar

    }

    public function index()
    {
        $data['page_title'] = 'List Roles';
        // load view
        $this->load->view('dashboard/roles/list', $data);
    }

    // get list role dengan datatable
    public function ajax_list()
    {
        header('Content-Type: application/json');
        $list = $this->roles_model->get_datatables();
        $data = array();

        $no = $this->input->post('start');
        //looping data roles
        foreach ($list as $Data) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $Data->role_name;
            $row[] = '<a href="javascript:void(0)" id="btn-edit-post" data-id="' . $Data->id . '" class="btn btn-primary btn-sm"><i class ="fa fa-edit"></i> Edit</a>
            <a class="btn btn-danger btn-sm delete-btn" data-id="' . $Data->id . '"><i class ="fa fa-trash"></i> Hapus</a>
            <a href="' . base_url() . 'dashboard/access/view_access/' . $Data->id . '" class="btn btn-success btn-sm" ><i class="fa fa-list"></i> Hak Akses</a>

';
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->roles_model->count_all(),
            "recordsFiltered" => $this->roles_model->count_filtered(),
            "data" => $data,
        );

        //output to json format
        $this->output->set_output(json_encode($output));
    }

    // get list role by id
    public function get_role_by_id()
    {
        header('Content-Type: application/json');
        $id = (int)$this->input->get('id');
        $data = $this->roles_model->get_role_by_id($id);
        echo json_encode($data);
    }

    // proses update role
    public function update()
    {
        header('Content-Type: application/json');
        $id = $this->input->post('id');

        $role_name = trim($this->input->post('role_name'));

        if ($role_name !== '') {
            $data_update = array(
                'role_name' => $role_name
            );
            $update = $this->roles_model->update_role_by_id($data_update, $id);
            $data = array(
                'status' => 1,
                'message' => 'Data Berhasil diupdate'
            );
        } else {
            $data = array(
                'status' => 0,
                'message' => 'Role Name harus diisi'
            );
        }
        echo json_encode($data);
    }

    // proses tambah
    public function add()
    {
        header('Content-Type: application/json');
        $POST = $this->input->post();
        $role_name = trim($POST['role_name']);
        if ($role_name !== '') {
            $data_add = array(
                'role_name' => $role_name
            );

            $insert = $this->roles_model->insert($data_add); //proses input data ke database
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

    public function delete()
    {
        header('Content-Type: application/json');
        $id = $this->input->post('id');
        $result = $this->roles_model->delete($id);

        if ($result) {
            echo json_encode(array('status' => 1, 'message' => 'Data berhasil dihapus.'));
        } else {
            echo json_encode(array('status' => 0, 'message' => 'Gagal menghapus.'));
        }
    }
}