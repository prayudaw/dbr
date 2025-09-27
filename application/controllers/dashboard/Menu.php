<?php
defined('BASEPATH') or exit('No direct script access allowed');

//saat development gunakan CI_Controller  -- MY_Controller 
class Menu extends  MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model');
    }

    public function index()
    {
        $data['page_title'] = 'List Menu';
        $data['menus'] = $this->menu_model->get_user_menus(1);


        // load view
        $this->load->view('dashboard/menu/list', $data);
    }

    // get list role dengan datatable
    public function ajax_list()
    {
        header('Content-Type: application/json');
        $list = $this->menu_model->get_datatables();
        $data = array();

        $no = $this->input->post('start');

        //looping data roles
        foreach ($list as $Data) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $Data->id;
            $row[] = $Data->menu_name;
            $row[] = $Data->url;
            $row[] = $Data->icon;
            $row[] = $Data->parent_id;
            $row[] = '<a href="javascript:void(0)" id="btn-edit-post" data-id="' . $Data->id . '" class="btn btn-primary btn-sm"><i class ="fa fa-edit"></i> Edit</a>
            <a class="btn btn-danger delete-btn" data-id="' . $Data->id . '"><i class ="fa fa-trash"></i> Hapus</a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->menu_model->count_all(),
            "recordsFiltered" => $this->menu_model->count_filtered(),
            "data" => $data,
        );

        //output to json format
        $this->output->set_output(json_encode($output));
    }


    // get menu by id
    public function get_menu_by_id()
    {
        header('Content-Type: application/json');
        $id = (int)$this->input->get('id');
        $data = $this->menu_model->get_menu_by_id($id);
        echo json_encode($data);
    }

    // proses tambah
    public function add()
    {
        header('Content-Type: application/json');
        $POST = $this->input->post();

        $menu_name = trim($POST['menu_name']);
        $url = trim($POST['url']);
        $icon  = trim($POST['icon']);
        $parent_id = trim($POST['parent_id']);

        if ($menu_name !== '' && $url !== '') {
            $data_add = array(
                'menu_name' => $menu_name,
                'url' => $url,
                'icon' => $icon,
                'parent_id' => $parent_id,
            );

            $insert = $this->menu_model->insert($data_add); //proses input data ke database
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


    // proses update role
    public function update()
    {
        header('Content-Type: application/json');
        $id = $this->input->post('id');

        $menu_name = trim($this->input->post('menu_name'));
        $url = trim($this->input->post('url'));
        $icon = trim($this->input->post('icon'));
        $parent_id = trim($this->input->post('parent_id'));

        if ($menu_name !== '' && $url !== '') {
            $data_update = array(
                'menu_name' => $menu_name,
                'url' => $url,
                'icon' => $icon,
                'parent_id' => $parent_id,
            );
            $update = $this->menu_model->update_menu_by_id($data_update, $id);
            $data = array(
                'status' => 1,
                'message' => 'Data Berhasil diupdate'
            );
        } else {
            $data = array(
                'status' => 0,
                'message' => 'data harus diisi'
            );
        }
        echo json_encode($data);
    }


    public function delete()
    {
        header('Content-Type: application/json');
        $id = $this->input->post('id');
        $result = $this->menu_model->delete($id);

        if ($result) {
            echo json_encode(array('status' => 1, 'message' => 'Data berhasil dihapus.'));
        } else {
            echo json_encode(array('status' => 0, 'message' => 'Gagal menghapus.'));
        }
    }
}