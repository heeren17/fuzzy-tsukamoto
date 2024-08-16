<?php

    defined('BASEPATH') or exit('No direct script access allowed');

    class Model_User extends CI_Model
    {
        public $_table = 'data_user';
        public $idm = 'id_user';

        public function getAll()
        {
            return $this->db->get($this->_table)->result();
        }

        public function getById($id)
        {
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->where($this->idm, $id);
        
            return $this->db->get()->result();
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
