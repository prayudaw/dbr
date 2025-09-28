<?php

class Dbr_model extends CI_Model
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
        // Penambahan filter dari form

        if (!empty($_POST['searchKodeBarang'])) {
            $this->db->like('kode_barang', trim($_POST['searchKodeBarang']));
        }

        if (!empty($_POST['searchNamaBarang'])) {
            $this->db->like('nama_barang', trim($_POST['searchNamaBarang']));
        }

        if (!empty($_POST['searchMerk'])) {
            $this->db->like('merk_type', trim($_POST['searchMerk']));
        }


        if (!empty($_POST['searchNUP'])) {
            $this->db->like('nup', trim($_POST['searchNUP']));
        }

        if (!empty($_POST['searchKondisi'])) {
            $this->db->like('kondisi', trim($_POST['searchKondisi']));
        }

        if (!empty($_POST['searchPenguasaan'])) {
            $this->db->like('penguasaan', trim($_POST['searchPenguasaan']));
        }

        if (!empty($_POST['searchRuangan'])) {
            $this->db->like('ruangan', trim($_POST['searchRuangan']));
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

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    //simpan data ke dbr
    public function insert($data)
    {
        return $this->db->insert('dbr', $data);
    }

    //get data dbr bedasarkan ruangan
    public function get_dbr_filter($filter_ruangan)
    {
        $this->db->select('*'); // Hanya ambil nama barang
        $this->db->where('ruangan', $filter_ruangan);
        $query = $this->db->get($this->table);
        return $query->result();
    }
}
