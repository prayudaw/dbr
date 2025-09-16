<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_user_by_username($username)
    {
        return $this->db->get_where('user', ['username' => $username])->row();
    }

    // method baru untuk ambil semua user
    public function get_all()
    {
        return $this->db->get('user')->result(); // ambil semua baris tabel user
    }
}