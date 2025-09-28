<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Access_model extends CI_Model
{

    public function get_all_menus()
    {
        // Mengambil semua menu dari database
        return $this->db->get('menus')->result_array();
    }

    public function get_access_by_role($role_id)
    {
        // Mengambil menu yang sudah memiliki hak akses untuk role tertentu
        $this->db->select('menu_id');
        $this->db->where('role_id', $role_id);
        return $this->db->get('access_rights')->result_array();
    }

    public function update_access($role_id, $menu_ids)
    {
        // Hapus semua hak akses lama untuk role ini
        $this->db->where('role_id', $role_id);
        $this->db->delete('access_rights');

        // Tambahkan hak akses baru dari array $menu_ids
        if (!empty($menu_ids)) {

            $data = [];
            foreach ($menu_ids as $menu_id) {
                $data = [
                    'role_id' => $role_id,
                    'menu_id' => $menu_id
                ];
                $this->db->insert('access_rights', $data);
            }
            return true;
        }
    }


    /**
     * Mengambil daftar URL yang diizinkan untuk role_id tertentu
     * @param int $role_id ID Role user
     * @return array Daftar string URL
     */
    public function get_allowed_urls($role_id)
    {

        $this->db->select('url');
        $this->db->from('access_rights');
        $this->db->join('menus', 'menus.id=access_rights.menu_id', 'left');
        $this->db->where('access_rights.role_id', $role_id);
        $query = $this->db->get();


        $allowed_urls = [];
        foreach ($query->result_array() as $row) {
            $allowed_urls[] = $row['url'];
        }

        // var_dump($allowed_urls);
        // die();

        return $allowed_urls;
    }
}
