<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dbr extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('dbr_model');
        $this->load->model('barang_model');
        $this->load->model('ruang_model');
    }

    public function index()
    {
        $data['page_title'] = 'List Daftar Barang Ruangan Perpustakaan';
        $data['ruangan_options'] = $this->db->select('*')->get('ruangan')->result_array();
        //load view
        $this->load->view('dashboard/dbr/list', $data);
    }

    public function ajax_list()
    {
        header('Content-Type: application/json');
        $list = $this->dbr_model->get_datatables();
        $data = array();

        $no = $this->input->post('start');
        //looping data barang bmn
        foreach ($list as $Data) {
            $no++;
            $row = array();

            $row[] = $no;
            $row[] = $Data->nama_barang;
            $row[] = $Data->kode_barang;
            $row[] = $Data->nup;
            $row[] = $Data->merk_type;
            $row[] = $Data->ruangan;
            $row[] = $Data->jumlah_barang;
            $row[] = $Data->penguasaan;
            $row[] = $Data->kondisi;
            $row[] = '';

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->dbr_model->count_all(),
            "recordsFiltered" => $this->dbr_model->count_filtered(),
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

    public function add()
    {
        // Memeriksa jika bukan POST menampilkan halaman tambah DBR
        if ($this->input->server('REQUEST_METHOD') != 'POST') {
            // jika tidak akan menampilkan halaman tambah
            $data['page_title'] = 'Tambah Daftar Barang Ruangan';
            // --- TAMBAHKAN BARIS INI ---
            $data['tanggal_default'] = date('Y-m-d'); // Mengambil tanggal hari ini
            $data['ruangan_options'] = $this->db->select('*')->get('ruangan')->result_array();
            $data['barang_options'] = $this->barang_model->get_barang();
            $this->load->view('dashboard/dbr/tambah', $data);
        } else {
            // Ambil data dari POST
            $ruangan = $this->input->post('ruangan');
            $nama_barang = $this->input->post('nama_barang');
            $jumlah_barang = $this->input->post('jumlah_barang');

            // Lakukan validasi data atau simpan ke database
            if (empty($ruangan) || empty($nama_barang) || empty($jumlah_barang)) {
                $response = array(
                    'status' => 'error',
                    'message' => 'ruangan atau nama barang atau jumlah barang tidak boleh kosong.'
                );

                // Mengirim respons dalam format JSON
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
            } else {

                $data = array(
                    'nama_barang' => $this->input->post('nama_barang'),
                    'kode_barang' => $this->input->post('kode_barang'),
                    'nup' => $this->input->post('nup'),
                    'merk_type' => $this->input->post('merk_type'),
                    'tahun' => $this->input->post('tahun'),
                    'ruangan' => $this->input->post('ruangan'),
                    'kondisi' => $this->input->post('kondisi'),
                    'penguasaan' => $this->input->post('penguasaan'),
                    'keterangan' => $this->input->post('keterangan'),
                    'jumlah_barang' => $this->input->post('jumlah_barang'),
                    'tanggal_input' => $this->input->post('tanggal_input'),
                );

                //proses simpan data DBR
                $insert = $this->dbr_model->insert($data);
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


    // --- Metode baru untuk Export PDF ---
    public function export_pdf()
    {

        $filter_ruangan = trim($this->input->get('ruangan'));

        // Fetch all data from the database
        $get_number_room = $this->ruang_model->getNumberRoom($filter_ruangan);

        $data['barang'] = $this->dbr_model->get_dbr_filter($filter_ruangan); // Reuse get_all_barang or create a new method for export if needed
        $data['nama_ruangan'] = $filter_ruangan;
        $data['kode_ruangan'] = $get_number_room['kode'];

        $html = $this->load->view('report_barang_pdf', $data, true); // Load view PDF dan simpan outputnya sebagai string

        $filename = 'daftar_barang_ruangan_' . date('Ymd_His');
        // $this->dompdf_lib->create_pdf($html, $filename, TRUE, 'A4', 'portrait');
    }

    public function export_excel()
    {
        $filter_ruangan = trim($this->input->get('ruangan'));
        // Fetch all data from the database
        $data['barang'] = $this->barang_model->get_dbr_filter($filter_ruangan); // Reuse get_all_barang or create a new method for export if needed
        $data['nama_ruangan'] = $filter_ruangan;
        // Set the appropriate headers for Excel download

        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Daftar_Barang_Ruangan_" . date('Ymd_His') . ".xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        // Load a dedicated view for the Excel content
        $this->load->view('dbr_export', $data);
    }
}