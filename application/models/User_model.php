<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function check_login($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password); // sebaiknya pakai password hash
        $query = $this->db->get('user'); // tabel user

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return false;
    }
}