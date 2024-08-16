<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_Login extends CI_Model
{
    public $_table = 'data_user';
    public $idm = 'id_user';

    public function cek_login()
    {
        $USRNAMA = set_value('usernname');
        $PASWORD = set_value('passsword');

        $result   = $this->db->where('usernname', $USRNAMA)
                            ->where('passsword', $PASWORD)
                            ->limit(1)
                            ->get('data_user');

        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return array();
        }
    }

    public function add($data)
    {
        $this->db->insert($this->_table, $data);
    }
}
