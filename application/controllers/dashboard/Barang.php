<?php
defined('BASEPATH') or exit('No direct script access allowed');

//saat development gunakan CI_Controller  -- MY_Controller 
class Barang extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('barang_model');
        $this->load->model('menu_model'); //wajib ada setiap di controller untuk menampilkan menu sidebar
        // Jika user belum login, arahkan kembali ke halaman login 
        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('login'); // 
        }
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

    //view tambah barang
    public function add()
    {
        // Memeriksa jika bukan POST menampilkan halaman tambah DBR
        if ($this->input->server('REQUEST_METHOD') != 'POST') {
            $data['page_title'] = 'Tambah Barang BMN Milik Perpus';
            //load view
            $this->load->view('dashboard/barang/tambah', $data);
        } else {


            // Ambil data dari POST
            $kode_barang = $this->input->post('kode_barang');
            $nama_barang = $this->input->post('nama_barang');
            $NUP = $this->input->post('nup');
            $merk = $this->input->post('merk');
            $tgl_perolehan = $this->input->post('tgl_perolehan');
            $kategori = $this->input->post('kategori');
            $nilai_perolehan = $this->input->post('nilai_perolehan');
            $kondisi = $this->input->post('kondisi');

            // Lakukan validasi data atau simpan ke database
            if (empty($kode_barang) || empty($nama_barang) || empty($NUP) ||  empty($tgl_perolehan)  || empty($kategori) || empty($nilai_perolehan)  || empty($kondisi)) {
                $response = array(
                    'status' => 'error',
                    'message' => 'Data tidak boleh kosong.'
                );

                // Mengirim respons dalam format JSON
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
            } else {

                $data = array(
                    'nama_barang' => $this->input->post('nama_barang'),
                    'kode_barang' => $this->input->post('kode_barang'),
                    'NUP' => $this->input->post('nup'),
                    'merk' => $this->input->post('merk'),
                    'kondisi' => $this->input->post('kondisi'),
                    'nilai_perolehan' => $this->input->post('nilai_perolehan'),
                    'tgl_perolehan' => $this->input->post('tgl_perolehan'),
                    'kondisi' => $this->input->post('kondisi'),
                    'kategori' => $this->input->post('kategori'),
                    'created_by' => $this->session->userdata('username'),
                );

                //proses simpan data DBR
                $insert = $this->barang_model->insert($data);
                $response = array(
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan!'
                );

                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
            }
        }
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
