<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataSet extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Dataset');
        $this->load->library('form_validation');

        if ($this->session->userdata('status') != 'ADMIN') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                  Anda Belum Login !!!
                </div>');
            redirect('Login');
        }
    }

    public function rules()
    {
        return [

            ['field' => 'permintaan',
            'label' => 'Permintaan',
            'rules' => 'required'],

            ['field' => 'persediaan',
            'label' => 'Persediaan',
            'rules' => 'required'],


            ['field' => 'penjualan',
            'label' => 'Penjualan',
            'rules' => 'required'],

            ['field' => 'kebutuhan',
            'label' => 'Kebutuhan',
            'rules' => 'required'],
        ];
    }

    public function index()
    {
        $mdl = $this->Model_Dataset;
        $validation = $this->form_validation;
        $post = $this->input->post();
        $data = array(
            'judul' => 'DATASET',
            'sub' => 'Tambah Data',
            'sub2' => 'Edit Data',
            'datset' => $mdl->getAllJoin(),
            'contents' => 'admin/view_dataset'
        );
        
        $validation->set_rules($this->rules());
        if ($validation->run() == false) {
            $this->load->view('templates/index', $data);
        } else {
            $data = array(
            'id_user' => $post['id_user'],
            'tanggal' => $post['tanggal'],
            'permintaan' => $post['permintaan'],
            'persediaan' => $post['persediaan'],
            'penjualan' => $post['penjualan'],
            'kebutuhan' => $post['kebutuhan'],
            );
            $mdl->add($data);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('dataset');
        }
    }

    public function edit($ID_DATASET = null)
    {
        if (!isset($ID_DATASET)) {
            $ID_DATASET = $this->input->post('id_dataset');
        }
        if (!isset($ID_DATASET)) {
            redirect('dataset');
        }
        $mdl = $this->Model_Dataset;
        $validation = $this->form_validation;
        $post = $this->input->post();
        $validation->set_rules($this->rules());

        if ($validation->run()) {
            $data = array(
            'id_dataset' => $ID_DATASET,
            'id_user' => $post['id_user'],
            'tanggal' => $post['tanggal'],
            'permintaan' => $post['permintaan'],
            'persediaan' => $post['persediaan'],
            
            'penjualan' => $post['penjualan'],
            'kebutuhan' => $post['kebutuhan'],
        );
            $mdl->edit($data);
            $this->session->set_flashdata('success', 'Berhasil diupdate');
        }
        redirect('dataset');
    }

    public function delete($id = null)
    {
        if (!isset($id)) {
            show_404();
        }
        if ($this->Model_Dataset->delete($id)) {
            redirect('dataset');
        }
    }
}
