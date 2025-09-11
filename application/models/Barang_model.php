<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{

    var $table = 'dbr';
    var $column_order = array(null, 'nama_barang', 'kode_barang', 'nup', 'merk_type', 'jumlah_barang', 'kondisi', 'ruangan', 'penguasaan', 'keterangan', 'tanggal_input'); // Kolom yang bisa di-order
    var $column_search = array('nama_barang', 'kode_barang', 'nup', 'ruangan', 'penguasaan', 'kondisi'); // Kolom yang bisa dicari
    var $order = array('id' => 'desc'); // Urutan default


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Fungsi baru untuk mengambil daftar barang 
    public function get_barang()
    {
        // die('tes');
        $this->db->select('*'); // Hanya ambil nama barang
        $query = $this->db->get('barang');
        return $query->result_array();
    }


    // Fungsi baru untuk mengambil daftar barang 
    public function get_dbr_filter($filter_ruangan)
    {
        $this->db->select('*'); // Hanya ambil nama barang
        $this->db->where('ruangan', $filter_ruangan);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_all_barang()
    {
        return $this->db->get($this->table)->result();
    }


    // Fungsi baru untuk mengambil daftar barang berdasarkan id
    public function get_barang_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id); // Hanya ambil  berdasarkan id
        $query = $this->db->get('barang');
        return $query->row_array();
    }

    public function simpan_barang($data)
    {
        return $this->db->insert('dbr', $data);
    }



    // Method baru untuk menghapus data dbr berdasarkan ID
    public function delete_dbr_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }


    // Fungsi baru: Mendapatkan detail barang berdasarkan ID
    public function get_dbr_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row(); // Mengembalikan satu baris data
    }


    // Fungsi baru: Memperbarui data barang
    public function update_barang($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Fungsi baru: Memperbarui data barang
    public function update_dbr($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Fungsi bantuan untuk DataTables (private)
    private function _get_datatables_query()
    {
        $this->db->from($this->table);

        $i = 0;
        foreach ($this->column_search as $item) // Loop kolom yang bisa dicari
        {
            if ($_POST['search']['value']) // Jika ada nilai pencarian
            {
                if ($i === 0) // First loop
                {
                    $this->db->group_start(); // Buka kurung
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) // Last loop
                    $this->db->group_end(); // Tutup kurung
            }
            $i++;
        }

        if (isset($_POST['order'])) // Jika ada pengurutan dari DataTables
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

        // Penambahan filter dari form
        if (!empty($_POST['filter_nama_barang'])) {
            $this->db->like('nama_barang', trim($_POST['filter_nama_barang']));
        }

        if (!empty($_POST['filter_kode_barang'])) {
            $this->db->like('kode_barang', trim($_POST['filter_kode_barang']));
        }


        if (!empty($_POST['filter_nup'])) {
            $this->db->like('nup', trim($_POST['filter_nup']));
        }

        if (!empty($_POST['filter_kondisi'])) {
            $this->db->like('kondisi', trim($_POST['filter_kondisi']));
        }


        if (!empty($_POST['filter_penguasaan'])) {
            $this->db->like('penguasaan', trim($_POST['filter_penguasaan']));
        }


        if (!empty($_POST['filter_ruangan'])) {
            $this->db->where('ruangan', trim($_POST['filter_ruangan']));
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}
