<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_Datanilai extends CI_Model
{
    public $_table = 'data_nilai_keanggotaan';
    public $idm = 'id_nilai';

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function getAllJoin()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('data_uji', 'data_uji.id_uji = data_nilai_keanggotaan.id_uji');
        
        return $this->db->get()->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ['id_nilai' => $id])->row();
    }

    public function getdetail($id)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('data_nilai_keanggotaan.id_uji', $id);

        return $this->db->get()->result();
    }

    public function cekData($data)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('id_uji', $data['id_uji']);
        $this->db->where('keanggotaan', $data['keanggotaan']);
        
        return $this->db->get()->result();
    }

    public function add($data)
    {
        $this->db->insert($this->_table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, ['id_uji' => $id]);
    }

    public function getNilai($id, $anggota)
    {
        $query = "SELECT * FROM $this->_table 
        WHERE id_uji = '$id' 
        AND keanggotaan = '$anggota'";
        
        return $this->db->query($query)->row_array();
    }

    public function edit($data)
    {
        $this->db->where('id_uji', $data['id_uji']);
        $this->db->where('keanggotaan', $data['keanggotaan']);
        $this->db->update($this->_table, $data);
    }
}
