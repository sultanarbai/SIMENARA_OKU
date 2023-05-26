<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Atribut extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model', 'Model2');
        // inisialisasi halaman, mohon disesuaikan
        $page = 'atribut';

        $akses_page = FALSE;
        $ci = get_instance();
        if (!$ci->session->userdata('email')) {
            redirect('admin_auth');
        } else {
            $role = $ci->session->userdata('tipe');
            $query = $this->Model2->getId('tb_access', $role, 'kode_role');
            foreach ($query as $aks) {
                if ($aks->akses == $page) {
                    $akses_page = TRUE;
                }
            }
            if ($akses_page == FALSE) {
                redirect('upsss');
            }
        }
    }
    public function cek_hak()
    {
        // cek hak akses
        $kode_role = $this->session->userdata('tipe');
        $beranda = $this->Model2->wereAND('tb_access', 'kode_role', 'akses', $kode_role, 'atribut')->row_array();
        if ($beranda['hak'] != 'manage' or $beranda = null) {
            redirect('atribut');
        }
    }
    public function index()
    {
        // inisialisasi hak yang dapat mengakses index
        $datapage['hak'] = "manage";
        // cek hak akses for panel kelola data
        $kode_role = $this->session->userdata('tipe');
        $beranda = $this->Model2->wereAND('tb_access', 'kode_role', 'akses', $kode_role, 'atribut')->row_array();
        if ($beranda['hak'] != 'manage') {
            $datapage['hak'] = "view";
        }
        $datapage['url'] = "atribut";
        $datapage['title'] = "Data Atribut Peta";
        $datapage['subtitle'] = "";
        $datapage['datatabel'] = $this->Model2->get('tb_atribut');
        $data['menara'] = $this->load->view('atribut/v_atribut', $datapage, TRUE);
        $this->load->view('layout/html', $data);
    }
    public function form_tambah()
    {
        $this->cek_hak();

        $datapage['url'] = "atribut";
        $datapage['title'] = "Tambah Data atribut";
        $datapage['subtitle'] = "";
        if (!$_POST) {
            $datapage['err'] = "";
            $datapage['nama_atribut'] = "";
            $datapage['color'] = "";
            $data['menara'] = $this->load->view('atribut/v_add', $datapage, TRUE);
            $this->load->view('layout/html', $data);
        } elseif ($_POST) {
            // ambil post data
            $nama_atribut = $this->input->post('nama_atribut');
            $cek = $this->Model2->cek_text($nama_atribut, 'OK');
            $color = $this->input->post('color');
            if ($cek == '') {
                $this->simpan();
            } else {
                $datapage['err'] = $cek;
                $datapage['nama_atribut'] = $nama_atribut;
                $datapage['color'] = $color;
                $data['menara'] = $this->load->view('atribut/v_add', $datapage, TRUE);
                $this->load->view('layout/html', $data);
            }
        }
    }
    public function simpan()
    {
        $this->cek_hak();

        if ($_POST) {
            // ambil post data
            $nama_atribut = $this->input->post('nama_atribut');
            $cek = $this->Model2->cek_text($nama_atribut, 'OK');
            $color = $this->input->post('color');
            if ($cek != '') {
                if ($nama_atribut == null) {
                    redirect('upsss');
                }
                redirect('atribut');
            }

            // konfigurasi file validasi
            $config['upload_path']          = './geo/';
            $config['allowed_types']        = 'geojson';
            $config['max_size']             = '10000';
            // load library
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('geojson')) {
                $this->Model2->setSessionFlash('error', ' gagal di simpan ! format file salah');
            } else {

                $geojson = $this->upload->data();
                $geojsoninput = $geojson['file_name'];
                // var_dump($geojsoninput);
                // die;
                $data = ['file_atribut' => $geojsoninput, 'nama_atribut' => $nama_atribut, 'tahun_sumber' => date('Y'), 'warna_atribut' => $color];
                $this->Model2->add('tb_atribut', $data);
                $this->Model2->setSessionFlash('sukses', ' Berhasil ;)');
            }
            redirect('atribut');
        } else {
            redirect('upsss');
        }
    }
    public function form_ubah($id = '')
    {
        $this->cek_hak();

        $datapage['url'] = "atribut";
        $datapage['title'] = "Halaman Ubah Data atribut";
        $datapage['subtitle'] = "";

        if (!$_POST) {
            $cek = $this->Model2->cek_text($id, '', 'OK');
            if ($cek == '') {
                $datapage['err'] = "";
                $datapage['datatabel'] = $this->Model2->getId('tb_atribut', $id, 'kode_atribut')[0];
                if ($datapage['datatabel'] == null) {
                    redirect('upsss');
                } else {
                    $data['menara'] = $this->load->view('atribut/v_edit', $datapage, TRUE);
                    $this->load->view('layout/html', $data);
                }
            } else {
                redirect('atribut');
            }
        } elseif ($_POST) {
            $nama_atribut = $this->input->post('nama_atribut');
            $nm_err = $this->Model2->cek_text($nama_atribut, 'OK');
            $kode_atribut = $this->input->post('kd_atribut');
            $kd_err = $this->Model2->cek_text($kode_atribut, '', 'OK');
            $color = $this->input->post('color');
            if ($nm_err == '' and $kd_err == '') {
                $this->ubah();
            } else {
                $datapage['err'] = $nm_err;
                $datapage['datatabel'] = $this->Model2->getId('tb_atribut', $kode_atribut, 'kode_atribut')[0];
                if ($datapage['datatabel'] == null) {
                    redirect('upsss');
                } else {
                    $data['menara'] = $this->load->view('atribut/v_edit', $datapage, TRUE);
                    $this->load->view('layout/html', $data);
                }
            }
        }
    }
    public function ubah()
    {
        $this->cek_hak();

        if ($_POST) {
            // ambil post data
            $nama_atribut = $this->input->post('nama_atribut');
            $nm_err = $this->Model2->cek_text($nama_atribut, 'OK');
            $kode_atribut = $this->input->post('kd_atribut');
            $kd_err = $this->Model2->cek_text($kode_atribut, '', 'OK');
            $color = $this->input->post('color');
            if ($nm_err != '' and $kd_err != '') {
                redirect('upsss');
            }
            $fileinput = $_FILES['geojson']['name'];
            // var_dump($fileinput);
            // die;
            if ($fileinput != '') {
                $cekgambar = $this->Model2->getId('tb_atribut', $kode_atribut, 'kode_atribut')[0];
                if ($cekgambar != null and $cekgambar->file_atribut != null) {
                    // hapus file lama sesuai name geojson di database
                    unlink(FCPATH . './geo/' . $cekgambar->file_atribut);
                }
            }

            //upload file ke folder
            $config['allowed_types'] = 'geojson';
            $config['max_size']      = '10000';
            $config['upload_path'] = './geo/';

            $this->load->library('upload', $config);


            if ($fileinput == null) {
                $data = ['nama_atribut' => $nama_atribut, 'tahun_sumber' => date('Y'), 'warna_atribut' => $color];
            } else {
                if ($this->upload->do_upload('geojson')) {
                    $fl1 = $this->upload->data('file_name');
                    // var_dump($fl1);
                    // die;
                    $data = ['nama_atribut' => $nama_atribut, 'file_atribut' => $fl1, 'tahun_sumber' => date('Y'), 'warna_atribut' => $color];
                } else {
                    $this->Model2->setSessionFlash('error', ' gagal di simpan ! format file salah');
                    redirect('atribut');
                }
            }
            $this->Model2->update('tb_atribut', $kode_atribut, $data, 'kode_atribut');
            $this->Model2->setSessionFlash('sukses', ' Berhasil diubah ;)');
            redirect('atribut');
        } else {
            redirect('upsss');
        }
    }
    public function del($id = '')
    {
        $this->cek_hak();

        if ($id == '') {
            redirect('upsss');
        } else {
            $cekgambar = $this->Model2->getId('tb_atribut', $id, 'kode_atribut')[0];
            if ($cekgambar == null) {
                redirect('upsss');
            }
        }

        $cekgambar = $this->Model2->getId('tb_atribut', $id, 'kode_atribut')[0];
        // hapus file lama sesuai name geojson di database
        unlink(FCPATH . './geo/' . $cekgambar->file_atribut);

        $this->Model2->delete('tb_atribut', $id, 'kode_atribut');
        redirect('atribut');
    }
}
