<?php

    defined('BASEPATH') or exit('No direct script access allowed');

    class Model_Hasil extends CI_Model
    {
        public $_table = 'hasil_fuzzy_tsukamoto';
        public $idm = 'id_fuzzy';

        public function getAll()
        {
            return $this->db->get($this->_table)->result();
        }

        public function getById($id)
        {
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->where('id_uji', $id);
        
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

        public function edit($data)
        {
            $this->db->where('id_uji', $data['id_uji']);
            $this->db->update($this->_table, $data);
        }

        public function cekData($data)
        {
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->where('id_uji', $data['id_uji']);
            
            return $this->db->get()->result();
        }
    }
