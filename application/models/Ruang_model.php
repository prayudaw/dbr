<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruang_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Fungsi baru untuk mengambil No Ruangan
    public function getNumberRoom($ruangan)
    {
        //fungsi untuk memisahkan ruangan dan lantai
        $ruangan = explode("-", $ruangan);
        $lantai = $ruangan[0];
        $nama_ruangan = $ruangan[1];

        $this->db->select('kode');
        $this->db->where('lantai', trim($lantai));
        $this->db->where('nama_ruangan', trim($nama_ruangan));
        $query = $this->db->get('ruangan');
        return $query->row_array();
    }
}
