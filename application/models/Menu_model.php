<?php

class Menu_model extends CI_Model
{
    var $table = 'menus';
    var $column_order = array(null, 'menu_name', 'url', 'icon', 'parent_id'); // Kolom yang bisa di-order
    var $column_search = array('menu_name', 'url', 'icon', 'parent_id'); // Kolom yang bisa dicari
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

    //simpan data ke table menu
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    //get data menu by id
    public function get_menu_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    //proses update menu by id
    public function update_menu_by_id($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }


    public function get_user_menus($role_id)
    {
        // Mengambil semua menu yang dapat diakses oleh role_id tertentu
        $this->db->select('menus.*');
        $this->db->from('menus');
        $this->db->join('access_rights', 'access_rights.menu_id = menus.id');
        $this->db->where('access_rights.role_id', $role_id);

        $query = $this->db->get();
        return $query->result_array();
    }
}
