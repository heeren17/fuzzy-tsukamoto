<?php

defined('BASEPATH') or exit('No direct script access allowed');

class HomeAdmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Model_rules');
        $this->load->library('form_validation');

        if ($this->session->userdata('status') != 'ADMIN') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                  Anda Belum Login !!!
                </div>');
            redirect('Login');
        }
    }
    

    public function index()
    {
        $mdl = $this->Model_rules;
        $data = array(
            'judul' => 'HOME',
            'judul1' => 'SELAMAT DATANG DI SISTEM INFORMASI PERSEDIAAN BARANG <br> DENGAN MENGGUNAKAN  METODE FUZZY TSUKAMOTO',
            'judul2' => 'INPUT',
            'rule' => $mdl->getAll(),
            'contents' => 'admin/view_home.php'
        );
        $this->load->view('templates/index', $data);
    }
}

/* End of file HomeAdmin.php */
