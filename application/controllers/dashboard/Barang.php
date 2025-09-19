<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('barang_model');
    }

    public function index()
    {
        $data['page_title'] = 'List Barang BMN Perpustakaan';
        //load view
        $this->load->view('dashboard/barang/list', $data);
    }


    // get data list untuk datatables
    public function ajax_list()
    {
        header('Content-Type: application/json');
        $list = $this->barang_model->get_datatables();
        $data = array();

        $no = $this->input->post('start');
        //looping data barang bmn
        foreach ($list as $Data) {
            $no++;
            $row = array();
            //row pertama akan kita gunakan untuk btn edit dan delete
            $row[] = $Data->kode_barang;
            $row[] = $Data->nama_barang;
            $row[] = $Data->NUP;
            $row[] = $Data->merk;
            $row[] = $Data->tgl_perolehan;
            $row[] = $this->rupiah($Data->nilai_perolehan);
            $row[] = $Data->kategori;
            $row[] = $Data->kondisi;
            $row[] = '';

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->barang_model->count_all(),
            "recordsFiltered" => $this->barang_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
    }

    public function rupiah($angka)
    {
        $hasil = 'Rp ' . number_format($angka, 2, ",", ".");
        return $hasil;
    }

    //view menu tambah Daftar Barang Ruangan
    public function add()
    {
        $data['page_title'] = 'Tambah Barang';
        //load view
        $this->load->view('dashboard/barang/tambah', $data);
    }


    //endpoint mendapatkan data barang berdasarkan id
    public function ajax_get_barang_by_id()
    {
        $id = $this->input->post('id'); // Ambil nilai ruangan dari POST
        $barang_data = $this->barang_model->get_barang_by_id($id);
        // Membuat objek DateTime dari string tanggal
        $tanggal_obj = new DateTime($barang_data['tgl_perolehan']);

        // Mengambil tahun menggunakan metode format()
        $tahun_dari_obj = $tanggal_obj->format("Y");
        $data = array(
            'kode_barang' => $barang_data['kode_barang'], // ID bisa menggunakan nama barang\
            'nama_barang' => $barang_data['nama_barang'],
            'nup' => $barang_data['NUP'],
            'merk' => $barang_data['merk'],
            'tahun' => $tahun_dari_obj,
            'kondisi' => $barang_data['kondisi'],
        );
        echo json_encode($data);
    }
}