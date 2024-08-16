<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DataUser extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_User');
        $this->load->library('form_validation');

        if($this->session->userdata('status') != 'ADMIN'){
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                  Anda Belum Login !!!
                </div>');
            redirect('Login');
        }
    }

    public function rules()
    {
        return [
            ['field' => 'usernname',
            'label' => 'Username',
            'rules' => 'required'],

            ['field' => 'passsword',
            'label' => 'Password',
            'rules' => 'required']
        ];
    }

    public function index()
    {
        $mdl = $this->Model_User;
        $validation = $this->form_validation;
        $post = $this->input->post();
        $data = array(
            'judul' => 'DATA USER',
            'sub' => 'Tambah Data',
            'sub2' => 'Edit Data',
            'usr' => $mdl->getAll(),
            'contents' => 'admin/view_datauser'
        );
        
        $validation->set_rules($this->rules());
        if ($validation->run() == false) {
            $this->load->view('templates/index', $data);
        } else {
            $data = array(
                'nama_user' => $post['nama_user'],
                'email' => $post['email'],
                'usernname' => $post['usernname'],
                'passsword' => $post['passsword'],
                'status' => $post['status'],);
            $mdl->add($data);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('datauser');
        }
    }

    public function edit($ID_USER = null)
    {
        if (!isset($ID_USER)) {
            $ID_USER = $this->input->post('id_user');
        }
        if (!isset($ID_USER)) {
            redirect('datauser');
        }
        $mdl = $this->Model_User;
        $validation = $this->form_validation;
        $post = $this->input->post();
        $validation->set_rules($this->rules());

        if ($validation->run()) {
            $data = array(
            'id_user' => $ID_USER,
            'nama_user' => $post['nama_user'],
            'email' => $post['email'],
            'usernname' => $post['usernname'],
            'passsword' => $post['passsword'],
            'status' => $post['status'],
        );
            $mdl->edit($data);
            $this->session->set_flashdata('success', 'Berhasil diupdate');
        }
        redirect('datauser');
    }

    public function delete($id = null)
    {
        if (!isset($id)) {
            show_404();
        }
        if ($this->Model_User->delete($id)) {
            redirect('datauser');
        }
    }
}
