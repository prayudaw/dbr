<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Barang_model');
        $this->load->model('Ruang_model');
        // $this->load->library('dompdf_lib'); // Load library Dompdf_lib yang baru kita buat
    }


    // public function statistik()
    // {
    //     $data = array();
    //     $this->load->view('statistik', $data);
    // }


    public function input()
    {

        // ... (Kode input barang dari sebelumnya, tidak berubah) ...
        $data['barang_options'] = $this->Barang_model->get_barang();
        // --- TAMBAHKAN BARIS INI ---
        $data['tanggal_default'] = date('Y-m-d'); // Mengambil tanggal hari ini
        $data['ruangan_options'] = $this->db->select('*')->get('ruangan')->result_array();
        // Set rules untuk validasi form
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('ruangan', 'Ruangan', 'required');
        $this->form_validation->set_rules('jumlah_barang', 'Jumlah', 'required');
        $this->form_validation->set_rules('tanggal_input', 'Tanggal Masuk', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal atau form belum di-submit, tampilkan form
            $this->load->view('barang_input', $data);
        } else {
            // Jika validasi berhasil, proses data
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

            if ($this->Barang_model->simpan_barang($data)) {
                // Pesan sukses
                $this->session->set_flashdata('success_message', 'Data barang berhasil ditambahkan!');
                redirect(INDEX_URL . 'barang/input'); // Redirect kembali ke halaman input
            } else {
                // Pesan error
                $this->session->set_flashdata('error_message', 'Gagal menambahkan data barang.');
                redirect(INDEX_URL . 'barang/input');
            }
        }
    }


    // Method baru untuk mengambil data barang berdasarkan ruangan via AJAX
    public function get_barang_by_id()
    {
        $id = $this->input->post('id'); // Ambil nilai ruangan dari POST

        $barang_data = $this->Barang_model->get_barang_by_id($id);

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


    public function daftar()
    {
        $data = array(
            'ruangan_options' => $this->db->select('*')->get('ruangan')->result_array()
        );

        // Wrap dengan template dashboard
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('barang_list', $data);
        $this->load->view('templates/footer');
    }

    public function ajax_list()
    {
        $list = $this->Barang_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $barang) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $barang->nama_barang;
            $row[] = $barang->kode_barang;
            $row[] = $barang->nup;
            $row[] = $barang->merk_type;
            $row[] = $barang->ruangan;
            $row[] = $barang->jumlah_barang;
            $row[] = $barang->penguasaan;
            $row[] = $barang->kondisi;

            // Tambahkan tombol Aksi (Edit)
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_barang(' . "'" . $barang->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                     <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_barang(' . "'" . $barang->id . "'" . ')"><i class="fa fa-trush"></i> Hapus</a>
                     <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Detail" onclick="show_detail(' . "'" . $barang->id . "'" . ')"><i class="fa fa-info-circle"></i> Detail</a>';

            // Tambahkan tombol aksi jika diperlukan (misal: Edit, Hapus)
            // $row[] = '<a href="javascript:void(0)" title="Edit">Edit</a> | <a href="javascript:void(0)" title="Hapus">Hapus</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Barang_model->count_all(),
            "recordsFiltered" => $this->Barang_model->count_filtered(),
            "data" => $data,
        );
        // Output JSON
        echo json_encode($output);
    }


    public function hapus($id)
    {
        $this->Barang_model->delete_dbr_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


    // --- Method baru: Untuk mendapatkan data barang berdasarkan ID (untuk mengisi form edit) ---
    public function get_dbr_by_id($id)
    {
        $data = $this->Barang_model->get_dbr_by_id($id);
        echo json_encode($data);
    }

    // --- Method baru: Untuk melakukan update data barang ---
    public function update_dbr()
    {
        $id = $this->input->post('id'); // ID barang yang akan diupdate

        // Set rules validasi (sesuai dengan form input)// Perhatikan ini, namanya 'ruangan' bukan 'select_ruangan'
        $this->form_validation->set_rules('jumlah_barang_edit', 'Jumlah', 'required|integer|greater_than[0]');
        $this->form_validation->set_rules('kondisi_edit', 'Kondisi', 'required');
        $this->form_validation->set_rules('penguasaan_edit', 'Penguasaan', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kirimkan pesan error ke client
            $response = array(
                'status' => 'error',
                'message' => validation_errors()
            );
            echo json_encode($response);
            return; // Penting untuk berhenti di sini
        } else {

            // In your CodeIgniter controller or model
            if ($this->input->post('ruangan_edit')) {
                $data = array(
                    'ruangan' => $this->input->post('ruangan_edit'),
                    'jumlah_barang' => $this->input->post('jumlah_barang_edit'),
                    'kondisi' => $this->input->post('kondisi_edit'),
                    'penguasaan' => $this->input->post('penguasaan_edit')
                );
            } else {
                $data = array(
                    'jumlah_barang' => $this->input->post('jumlah_barang_edit'),
                    'kondisi' => $this->input->post('kondisi_edit'),
                    'penguasaan' => $this->input->post('penguasaan_edit')
                );
            }



            if ($this->Barang_model->update_dbr($id, $data)) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Data barang berhasil diperbarui!'
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Gagal memperbarui data barang.'
                );
            }
            echo json_encode($response);
        }
    }


    // Metode baru untuk mengambil detail barang dbr berdasarkan ID
    public function get_detail($id)
    {
        $data = $this->Barang_model->get_dbr_by_id($id);
        echo json_encode($data); // Mengembalikan data dalam format JSON
    }


    public function export_excel()
    {
        $filter_ruangan = trim($this->input->get('ruangan'));
        // Fetch all data from the database
        $data['barang'] = $this->Barang_model->get_dbr_filter($filter_ruangan); // Reuse get_all_barang or create a new method for export if needed
        $data['nama_ruangan'] = $filter_ruangan;
        // Set the appropriate headers for Excel download

        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Daftar_Barang_Ruangan_" . date('Ymd_His') . ".xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        // Load a dedicated view for the Excel content
        $this->load->view('dbr_export', $data);
    }


    // --- Metode baru untuk Export PDF ---
    public function export_pdf()
    {

        $filter_ruangan = trim($this->input->get('ruangan'));

        // Fetch all data from the database
        $get_number_room = $this->Ruang_model->getNumberRoom($filter_ruangan);

        $data['barang'] = $this->Barang_model->get_dbr_filter($filter_ruangan); // Reuse get_all_barang or create a new method for export if needed
        $data['nama_ruangan'] = $filter_ruangan;
        $data['kode_ruangan'] = $get_number_room['kode'];


        $html = $this->load->view('report_barang_pdf', $data, true); // Load view PDF dan simpan outputnya sebagai string

        $filename = 'daftar_barang_ruangan_' . date('Ymd_His');
        // $this->dompdf_lib->create_pdf($html, $filename, TRUE, 'A4', 'portrait');
    }
}