<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_Rules extends CI_Model
{
    public $_table = 'rule_fuzzy';
    public $idm = 'id_rule';

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ['id_rule' => $id])->row();
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
