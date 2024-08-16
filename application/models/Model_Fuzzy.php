<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_Fuzzy extends CI_Model
{
    public $_table = 'data_hitung_rules_fuzzy';
    public $idm = 'id_hitung';

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function getAllJoin()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('data_uji', 'data_uji.id_uji = data_hitung_rules_fuzzy.id_uji');
        
        return $this->db->get()->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ['id_hitung' => $id])->row();
    }

    public function getdetail($id)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('id_uji', $id);

        return $this->db->get();
    }

    public function add($data)
    {
        $this->db->insert($this->_table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, ['id_uji' => $id]);
    }

    public function edit($data)
    {
        $this->db->where('id_uji', $data['id_uji']);
        $this->db->where('id_rules', $data['id_rules']);
        $this->db->update($this->_table, $data);
    }

    public function cekData($data)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('id_uji', $data['id_uji']);
        $this->db->where('id_rules', $data['id_rules']);
        
        return $this->db->get()->result();
    }
}
