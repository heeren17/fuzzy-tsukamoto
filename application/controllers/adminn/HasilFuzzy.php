<?php

defined('BASEPATH') or exit('No direct script access allowed');

class HasilFuzzy extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Dataset');
        $this->load->model('Model_Datauji');
        $this->load->model('Model_Rules');
        
        //Do your magic here
        if($this->session->userdata('status') != 'ADMIN'){
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                  Anda Belum Login !!!
                </div>');
            redirect('Login');
        }
    }
    
    public function index($id = null)
    {
        if (!isset($id)) {
            $id = $this->input->post('id');
        }
        if (!isset($id)) {
            redirect('datauji');
        }

        $muji = $this->Model_Datauji;
        $mset = $this->Model_Dataset;
        $mrule = $this->Model_Rules;
        $post = $this->input->post();
        $data = array(
            'judul' => 'Hasil Fuzzy Tsukamoto',
            'sub' => 'Data Uji',
            'sub1' => 'Data Nilai Keanggotaan',
            'sub2' => 'Rules Fuzzy',
            'sub3' => 'Prediksi Jumlah Persedian',
            'datuji' => $muji->getAllJoin(),
            'datset' => $mset->getAllJoin(),
            'datrule' => $mrule->getAllJoin(),
            'contents' => 'admin/view_hasil_fuzzy'
        );
        
        $validation->set_rules($this->rules());
        if ($validation->run() == false) {
            $this->load->view('templates/index', $data);
        } else {
            $data = array(
            'id_user' => 1,
            'permintaan_uji' => $post['permintaan_uji'],
            'persediaan_uji' => $post['persediaan_uji'],
            'penjualan_uji' => $post['penjualan_uji'],
        );
            $mdl->add($data);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('datauji');
        }
    }
}

/* End of file HasilFuzzy.php */
