<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_Datauji extends CI_Model
{
    public $_table = 'data_uji';
    public $idm = 'id_uji';

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function getAllJoin()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('data_user', 'data_user.id_user = data_uji.id_user');
        
        return $this->db->get()->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ['id_uji' => $id])->row();
    }

    public function getdetail($id)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('data_uji.id_uji', $id);

        return $this->db->get();
    }

    public function dataUji($data)
    {
        $anggota = $data['anggota'];
        $id = $data['id_uji'];
        $query = "SELECT $anggota FROM $this->_table WHERE id_uji = '$id' ";
        return $this->db->query($query)->row_array();
    }

    public function getnilai($id)
    {
        $this->db->select('*');
        $this->db->from('data_nilai_keanggotaan');
        $this->db->where('data_nilai_keanggotaan.id_uji', $id);

        return $this->db->get()->result();
    }

    public function add($data)
    {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
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
