<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_Dataset extends CI_Model
{
    public $_table = 'dataset';
    public $idm = 'id_dataset';

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function getAllJoin()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('data_user', 'data_user.id_user = dataset.id_user');
        
        return $this->db->get()->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ['id_dataset' => $id])->row();
    }

    public function getdetail($id)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('dataset.id_dataset', $id);

        return $this->db->get()->result();
    }

    public function getMinMax()
    {
        $this->db->select_min('permintaan', 'permintaan_min');
        $this->db->select_max('permintaan', 'permintaan_max');
        $this->db->select_min('persediaan', 'persediaan_min');
        $this->db->select_max('persediaan', 'persediaan_max');
        $this->db->select_min('penjualan', 'penjualan_min');
        $this->db->select_max('penjualan', 'penjualan_max');
        
        $this->db->from($this->_table);

        return $this->db->get()->result_array();
    }

    public function getMin($data)
    {
        $as = $data.'min';
        $query = "SELECT MIN($data) as $as FROM $this->_table ";
        
        return $this->db->query($query)->row_array();
    }
    
    public function getMax($data)
    {
        $as = $data.'max';
        $query = "SELECT MAX($data) as $as FROM $this->_table ";

        return $this->db->query($query)->row_array();
    }

    public function add($data)
    {
        $this->db->insert($this->_table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, [$this->idm => $id]);
    }

    public function edit($data)
    {
        $this->db->where($this->idm, $data[$this->idm]);
        $this->db->update($this->_table, $data);
    }
}
