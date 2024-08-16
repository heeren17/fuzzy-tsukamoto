<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_Login");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('usernname', 'USERNAME', 'required', ['required' => 'Username wajib diisi !!!']);
        $this->form_validation->set_rules('passsword', 'PASSWORD', 'required', ['required' => 'Password wajib diisi !!!']);
        if ($this->form_validation->run()==false) {
            $data = array(
                'judul' => 'LOGIN'
            );
            $this->load->view('view_login', $data);
        } else {
            $auth = $this->Model_Login->cek_login();
            if ($auth == false) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
					Username atau Password anda salah !!! </div>');
                redirect('Login');
            } else {
                $array = array(
                    'id_user' => $auth->id_user,
                    'usernname'=> $auth->usernname,
                    'status'=> $auth->status );
                
                $this->session->set_userdata($array);
                

                switch ($auth->status) {
                    case 'ADMIN': redirect('home');
                        break;
                    

                        default: ;break;
                }
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Login');
    }
}
