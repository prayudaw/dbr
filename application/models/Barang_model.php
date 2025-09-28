<?php

class Barang_model extends CI_Model
{
    private $table = "barang";
    private $column_order = array('kode_barang', 'nama_barang', 'NUP', 'merk', 'tgl_perolehan', 'kategori');
    private $column_search = array('kode_barang', 'nama_barang', 'NUP', 'merk', 'tgl_perolehan', 'kategori');
    private $order = array('nama_barang' => 'asc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) // loop kolom 
        {
            $Search = $this->input->post('search');
            if ($Search['value']) // jika datatable mengirim POST untuk search
            {
                if ($i === 0) // looping pertama
                {
                    $this->db->group_start();
                    $this->db->like($item, $Search['value']);
                } else {
                    $this->db->or_like($item, $Search['value']);
                }
                if (count($this->column_search) - 1 == $i) //looping terakhir
                    $this->db->group_end();
            }
            $i++;
        }

        ## Search
        if (!empty($_POST['searchKodeBarang'])) {
            $this->db->where('kode_barang like "%' . $_POST['searchKodeBarang'] . '%"');
        }

        if (!empty($_POST['searchNamaBarang'])) {
            $this->db->where('nama_barang like "%' . $_POST['searchNamaBarang'] . '%"');
        }

        if (!empty($_POST['searchKategori'])) {
            $this->db->where('kategori like "%' . $_POST['searchKategori'] . '%"');
        }

        if (!empty($_POST['searchMerk'])) {
            $this->db->where('merk like "%' . $_POST['searchMerk'] . '%"');
        }

        if (!empty($_POST['searchNUP'])) {
            $this->db->where('NUP ="' . $_POST['searchNUP'] . '"');
        }


        // jika datatable mengirim POST untuk order
        if ($this->input->post('order')) {
            $Order = $this->input->post('order');
            $this->db->order_by($this->column_order[$Order['0']['column']], $Order['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        //echo $this->db->last_query();die();

        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();

        $query = $this->db->get();
        return $query->num_rows();
    }

    //
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // Fungsi baru untuk mengambil daftar barang 
    public function get_barang()
    {
        $this->db->select('*'); // Hanya ambil nama barang
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    // Fungsi baru untuk mengambil daftar barang berdasarkan id
    public function get_barang_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id); // Hanya ambil  berdasarkan id
        $query = $this->db->get($this->table);
        return $query->row_array();
    }


    // menghitung total barang bmn milik perpus
    public function total_barang()
    {
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function total_barang_perpus_no_dbr()
    {
        $this->db->select("id,kode_barang ,nama_barang ,NUP,merk ,CONCAT(kode_barang,'',NUP) AS kdNup");
        $this->db->from($this->table);
        $this->db->where("CONCAT(kode_barang,'',NUP)   NOT IN (SELECT CONCAT(kode_barang,'',nup)  FROM dbr WHERE penguasaan = 'Barang Milik Perpustakaan')");
        $query = $this->db->get();
        return $query->num_rows();
    }


    //simpan data ke data tabel barang
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }
}
