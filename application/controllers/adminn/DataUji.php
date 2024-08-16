<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataUji extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Dataset');
        $this->load->model('Model_Datauji');
        $this->load->model('Model_Rules');
        $this->load->model('Model_Datanilai');
        $this->load->model('Model_Fuzzy');
        $this->load->model('Model_Hasil');
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

            ['field' => 'permintaan_uji',
            'label' => 'permintaan',
            'rules' => 'required'],

            ['field' => 'persediaan_uji',
            'label' => 'persediaan',
            'rules' => 'required'],

            ['field' => 'penjualan_uji',
            'label' => 'penjualan',
            'rules' => 'required']
        ];
    }

    public function index()
    {
        $mdl = $this->Model_Datauji;
        $validation = $this->form_validation;
        $post = $this->input->post();
        $data = array(
            'judul' => 'DATA Uji dan Hasil',
            'sub2' => 'Edit Data',
            'datuji' => $mdl->getAllJoin(),
            'contents' => 'admin/view_datauji'
        );
        
        $validation->set_rules($this->rules());
        if ($validation->run() == false) {
            $this->load->view('templates/index', $data);
        } else {
            $data = array(
            'id_user' => $post['id_user'],
            'permintaan_uji' => $post['permintaan_uji'],
            'persediaan_uji' => $post['persediaan_uji'],
            'penjualan_uji' => $post['penjualan_uji'],
        );
            $iduji = $mdl->add($data);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('dataujihasil/'.$iduji);
        }
    }
    // function untuk menampilkan detail hasil fuzzy
    public function hasil($id = null)
    {
        if (!isset($id)) {
            $id = $this->input->post('id');
        }
        if (!isset($id)) {
            redirect('datauji');
        }

        $this->nilaiKeanggotaan($id);

        $muji = $this->Model_Datauji;
        $mset = $this->Model_Dataset;
        $mrule = $this->Model_Rules;
        $mnilai = $this->Model_Datanilai;
        $mfuzzy = $this->Model_Fuzzy;
        $mhasil = $this->Model_Hasil;
        $post = $this->input->post();
        $data = array(
            'judul' => 'Hasil Fuzzy Tsukamoto',
            'sub' => 'DATA UJI',
            'sub1' => 'DATA NILAI KENGGOTAAN',
            'sub2' => 'RULES FUZZY',
            'sub3' => 'PREDIKSI JUMLAH PERSEDIAAN',
            'sub4' => 'HASIL PREDIKSI FUZZY TSUKAMOTO',
            'datuji' => $muji->getdetail($id)->result(),
            'datnilai' => $mnilai->getdetail($id),
            'datrule' => $mrule->getAll(),
            'datfuzzy' => $mfuzzy->getdetail($id)->result(),
            'dathasil' => $mhasil->getById($id),
            'contents' => 'admin/view_hasil_fuzzy'
        );
        
        $this->load->view('templates/index', $data);
    }
    // end detail hail fuzzy

    // function menghitung nilai keanggotaan
    public function nilaiKeanggotaan($id = null)
    {
        // memanggil datauji
        $muji = $this->Model_Datauji;
        // memanggil dataset
        $mset = $this->Model_Dataset;
        
        // membuat array keanggotaan
        $keanggotaan = array("permintaan","persediaan","penjualan");
        // membuat array keanggotaan min dan max
        $temp = array("min","max");
        // mencetak array keanggotaan
        foreach ($keanggotaan as $k) {
            $ujidata = array(
                'anggota' => $k."_uji",
                'id_uji' => $id);
            // variabel untuk menyimpan data uji menurut keanggotaan
            $temp_uji = $muji->dataUji($ujidata);
            $data_uji = $temp_uji[$k."_uji"];
            // variabel untuk menyimpan dataset min menurut keanggotaan
            $temp_min = $mset->getMin($k);
            $anggotaMin = $temp_min[$k.$temp[0]];
            // variabel untuk menyimpan dataset max menurut keanggotaan
            $temp_max = $mset->getMax($k);
            $anggotaMax = $temp_max[$k.$temp[1]];
            
            foreach ($temp as $t) {
                $hasil = 0;
                if ($t == 'min') {
                    // rumus saat keanggotaan min
                    $hasil = ($anggotaMax-$data_uji)/($anggotaMax-$anggotaMin);
                } else {
                    // rumus saat keanggotaan max
                    $hasil = ($data_uji-$anggotaMin)/($anggotaMax-$anggotaMin);
                }
                // menyimpan hasil perhitungan keanggotaan untuk dimasukkan ke database
                $data = array(
                'id_uji' => $id,
                'keanggotaan' => $k."_".$t,
                'nilai' => $hasil);
                // cek data yang sama dalam database
                $cek = count($this->Model_Datanilai->cekData($data));
                if ($cek > 0) {
                    // update data
                    $this->Model_Datanilai->edit($data);
                } else {
                    // tambah data
                    $this->Model_Datanilai->add($data);
                }
            }
        }
        // menjalankan function hitung fuzzy menurut rules
        $this->hitungFuzzy($id);
    }

    // function fuzzy rules
    public function hitungFuzzy($id = null)
    {
        $muji = $this->Model_Datauji;
        $mnilai = $this->Model_Datanilai;
        $mset = $this->Model_Dataset;
        $mfuzzy = $this->Model_Fuzzy;
        
        $keanggotaan = array('permintaan','persediaan','penjualan','kebutuhan');
        $temp = array('_min','_max');

        $r = 1;
        // perulangan untuk permintaan min dan max
        foreach ($temp as $i => $value) {
            // perulangan untuk produkasi min dan max
            foreach ($temp as $i1 => $value1) {
                // perulangan untuk penjualan min dan max
                foreach ($temp as $i2 => $value2) {
                    // perulangan untuk persediaan min dan max
                    foreach ($temp as $i3 => $value3) {
                        $temp_permintaan = $mnilai->getNilai($id, $keanggotaan[0].$value);
                        $temp_persediaan = $mnilai->getNilai($id, $keanggotaan[1].$value1);
                        $temp_penjualan = $mnilai->getNilai($id, $keanggotaan[2].$value2);

                        $permintaan = $temp_permintaan['nilai'];
                        $persediaan = $temp_persediaan['nilai'];
                        $penjualan = $temp_penjualan['nilai'];

                        $temp_min = array($permintaan,$persediaan,$penjualan);

                        $nilaimin = min($temp_min);

                        $kebutuhan = 0;

                        $temp_kebutuhannmin = $mset->getMin($keanggotaan[3]);
                        $kebutuhannMin = $temp_kebutuhannmin[$keanggotaan[3].'min'];

                        $temp_kebutuhannmax = $mset->getMax($keanggotaan[3]);
                        $kebutuhannMax = $temp_kebutuhannmax[$keanggotaan[3].'max'];

                        if ($value3 == '_min') {
                            // rumus fuzzy saat persediaan dalam dataset min
                            $kebutuhan = $kebutuhannMax - (($kebutuhannMax - $kebutuhannMin) * $nilaimin);
                        } else {
                            // rumus fuzzy saat persediaan dalam dataset max
                            $kebutuhan = $kebutuhannMin + (($kebutuhannMax - $kebutuhannMin) * $nilaimin);
                        }

                        $prediksi = $persediaan * $nilaimin;

                        $data = array(
                            'id_uji' => $id,
                            'id_rules'=> $r++,
                            'hitung_permintaan'=> $permintaan,
                            'hitung_persediaan'=> $persediaan,
                            'hitung_penjualan'=> $penjualan,
                            'minn'=> $nilaimin,
                            'hitung_kebutuhan'=> $kebutuhan,
                            'prediksi'=> $prediksi,
                        );

                        $cek = count($mfuzzy->cekData($data));
                        if ($cek > 0) {
                            $mfuzzy->edit($data);
                        } else {
                            $mfuzzy->add($data);
                        }
                    }
                }
            }
        }
        // menjalankan function hasil akhir fuzzy
        $this->hasilFuzzy($id);
    }

    // function menghitung hasil akhir fuzzy tsukamoto
    public function hasilFuzzy($id = null)
    {
        $mfuzzy = $this->Model_Fuzzy;
        $mhasil = $this->Model_Hasil;
        $dataHasil = $mfuzzy->getdetail($id)->result_array();
        $temp_minn = 0;
        $temp_prediksi = 0;
        $hasil = 0;
        foreach ($dataHasil as $key => $v) {
            // menghitung total nilai jumlah min
            $temp_minn = $temp_minn + $v['minn'];
            // menghitung total julah hasil prediksi
            $temp_prediksi = $temp_prediksi + $v['prediksi'];
        }
        // menhitung jumlah prediksi dibagi jumlah nilai min
        $hasil = $temp_prediksi / $temp_minn;

        $data = array(
            'id_uji' => $id,
            'hasil_fuzzy' => $hasil
        );

        $cek = count($mhasil->cekData($data));
        if ($cek > 0) {
            $mhasil->edit($data);
        } else {
            $mhasil->add($data);
        }
    }

    public function edit($ID_UJI = null)
    {
        if (!isset($ID_UJI)) {
            $ID_UJI = $this->input->post('id_uji');
        }
        if (!isset($ID_UJI)) {
            redirect('datauji');
        }
        $mdl = $this->Model_Datauji;
        $validation = $this->form_validation;
        $post = $this->input->post();
        $validation->set_rules($this->rules());

        if ($validation->run()) {
            $data = array(
            'id_uji' => $ID_UJI,
            'id_user' => $post['id_user'],
            'permintaan_uji' => $post['permintaan_uji'],
            'persediaan_uji' => $post['persediaan_uji'],
            'penjualan_uji' => $post['penjualan_uji'],
        );
            $mdl->edit($data);

            $this->session->set_flashdata('success', 'Berhasil diupdate');
        }
        redirect('datauji');
    }

    public function delete($id = null)
    {
        if (!isset($id)) {
            show_404();
        }
        $this->Model_Hasil->delete($id);
        $this->Model_Fuzzy->delete($id);
        $this->Model_Datanilai->delete($id);
        $this->Model_Datauji->delete($id);
        redirect('datauji');
    }
}
