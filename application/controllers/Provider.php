<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Provider extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model', 'Model2');
        // inisialisasi halaman, mohon disesuaikan
        $page = 'provider';

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
        $beranda = $this->Model2->wereAND('tb_access', 'kode_role', 'akses', $kode_role, 'pegawai')->row_array();
        if ($beranda['hak'] != 'manage') {
            redirect('provider');
        }
    }
    public function index()
    {
        // inisialisasi hak
        $datapage['hak'] = "manage";
        // cek hak akses for panel kelola data
        $kode_role = $this->session->userdata('tipe');
        $beranda = $this->Model2->wereAND('tb_access', 'kode_role', 'akses', $kode_role, 'provider')->row_array();
        if ($beranda['hak'] != 'manage') {
            $datapage['hak'] = "view";
        }

        $datapage['url'] = "provider";
        $datapage['title'] = "Halaman Provider";
        $datapage['subtitle'] = "";
        $datapage['datatabel'] = $this->Model2->get('tb_provider');
        $data['menara'] = $this->load->view('provider/v_provider', $datapage, TRUE);
        $this->load->view('layout/html', $data);
    }
    public function form_tambah()
    {
        // cek hak akses
        $this->cek_hak();

        $datapage['url'] = "provider";
        $datapage['title'] = "Halaman Tambah Data Provider";
        $datapage['subtitle'] = "Form Tambah Provider";

        if (!$_POST) {
            $datapage['kode_provider'] = '';
            $datapage['err1'] = '';
            $datapage['nama_provider'] = '';
            $datapage['err2'] = '';
            $datapage['alamat_provider'] = '';
            $datapage['err3'] = '';
            $datapage['same'] = '';
            $data['menara'] = $this->load->view('provider/v_form_add', $datapage, TRUE);
            $this->load->view('layout/html', $data);
        } elseif ($_POST) {
            // var_dump($_FILES['logo_tower']);
            // die;
            $kode_provider = $this->input->post('kode_provider');
            $err1 = $this->Model2->cek_post($kode_provider, 'hurang',);
            $nama_provider = $this->input->post('nama_provider');
            $err2 = $this->Model2->cek_post($nama_provider, 'hurang');
            $alamat_provider = $this->input->post('alamat_provider');
            $err3 = $this->Model2->cek_post($alamat_provider);

            $truex = 0;
            $same = '';
            $tess['result'] = $this->Model2->get('tb_provider');

            foreach ($tess['result']->result() as $asu) {
                if ($kode_provider == $asu->kode_provider) {
                    $truex = 1;
                    $same = 'Kode Provider Tidak Tersedia';
                }
            }
            // var_dump($err1 . $err2 . $err3 . $err4 . $err5 . $truex);
            // die;
            if ($err1 === '' and $err2 === '' and $err3 === '' and $truex === 0) {

                if ($_FILES['logo_tower']['name'] == null or $_FILES['logo_tower']['name'] == '') {
                    $fl1 = 'default.png';
                    $data = ['kode_provider' => $kode_provider, 'nama_provider' => $nama_provider, 'icon' => $fl1, 'alamat_perusahaan' => $alamat_provider];
                    $this->Model2->add('tb_provider', $data);
                    $this->Model2->setSessionFlash('sukses', ' Berhasil disimpan ;)');
                } else {
                    //upload file ke folder
                    $config['allowed_types'] = 'png';
                    $config['max_size']      = '1024';
                    $config['upload_path'] = './assets/template_contoh/images/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('logo_tower')) {
                        $fl1 = $this->upload->data('file_name');
                        $data = ['kode_provider' => $kode_provider, 'nama_provider' => $nama_provider, 'icon' => $fl1, 'alamat_perusahaan' => $alamat_provider];
                        $this->Model2->add('tb_provider', $data);
                        $this->Model2->setSessionFlash('sukses', ' Berhasil disimpan ;)');
                    } else {
                        $this->Model2->setSessionFlash('error', ' gagal di simpan ! (file bermasalah)');
                    }
                }

                redirect('provider');
            } else {
                $datapage['kode_provider'] = $kode_provider;
                $datapage['err1'] = $err1;
                $datapage['nama_provider'] = $nama_provider;
                $datapage['err2'] = $err2;
                $datapage['alamat_provider'] = $alamat_provider;
                $datapage['err3'] = $err3;
                $datapage['same'] = $same;
                $data['menara'] = $this->load->view('provider/v_form_add', $datapage, TRUE);
                $this->load->view('layout/html', $data);
            }
        }
    }

    public function form_ubah($id = '')
    {
        // cek hak akses
        $this->cek_hak();
        // untuk cek kondisi id
        if ($id === '') {
            redirect('upsss');
        } else {
            $cek = $this->Model2->getId('tb_provider', $id, 'kode_provider')[0];
            if ($cek == null) {
                redirect('upsss');
            }
        }

        $datapage['url'] = "provider";
        $datapage['title'] = "Halaman Ubah Data Provider";
        $datapage['subtitle'] = "Form Ubah";

        $datapage['err1'] = '';
        $datapage['err2'] = '';
        $datapage['err3'] = '';

        if (!$_POST) {

            $datapage['datatabel'] = $this->Model2->getId('tb_provider', $id, 'kode_provider')[0];
            $data['menara'] = $this->load->view('provider/v_form_update', $datapage, TRUE);
            $this->load->view('layout/html', $data);
        } elseif ($_POST) {

            $kode_provider = $this->input->post('kode_provider');
            $err1 = $this->Model2->cek_post($kode_provider, 'hurang',);
            $nama_provider = $this->input->post('nama_provider');
            $err2 = $this->Model2->cek_post($nama_provider, 'hurang');
            $alamat_provider = $this->input->post('alamat_provider');
            $err3 = $this->Model2->cek_post($alamat_provider);


            if ($err1 === '' and $err2 === '' and $err3 === '') {

                $fileinput = $_FILES['logo_tower']['name'];

                $tess['result'] = $this->Model2->get('tb_provider');
                if ($fileinput != null or $fileinput != '') {
                    $cekgambar = $this->Model2->getId('tb_provider', $kode_provider, 'kode_provider')[0];
                    if ($cekgambar != null and $cekgambar->icon != 'default.png') {
                        // hapus file lama sesuai name geojson di database
                        unlink(FCPATH . './assets/template_contoh/images/' . $cekgambar->icon);
                    }
                }
                //upload file ke folder
                $config['allowed_types'] = 'png';
                $config['max_size']      = '1024';
                $config['upload_path'] = './assets/template_contoh/images/';

                $this->load->library('upload', $config);

                if ($fileinput == null or $fileinput == '') {
                    $data = ['nama_provider' => $nama_provider, 'alamat_perusahaan' => $alamat_provider];
                    $this->Model2->update('tb_provider', $kode_provider, $data, 'kode_provider');
                    $this->Model2->setSessionFlash('sukses', ' Berhasil disimpan ;)');
                } else {
                    if ($this->upload->do_upload('logo_tower')) {
                        $fl1 = $this->upload->data('file_name');
                        $data = ['nama_provider' => $nama_provider, 'icon' => $fl1, 'alamat_perusahaan' => $alamat_provider];
                        $this->Model2->update('tb_provider', $kode_provider, $data, 'kode_provider');
                        $this->Model2->setSessionFlash('sukses', ' Berhasil disimpan ;)');
                    } else {
                        $this->Model2->setSessionFlash('error', ' gagal di simpan ! (file bermasalah)');
                    }
                }


                redirect('provider');
            } else {

                $datapage['err1'] = $err1;
                $datapage['err2'] = $err2;
                $datapage['err3'] = $err3;
                $datapage['datatabel'] = $this->Model2->getId('tb_provider', $id, 'kode_provider')[0];
                $data['menara'] = $this->load->view('provider/v_form_update', $datapage, TRUE);
                $this->load->view('layout/html', $data);
            }
        }
    }


    public function del($id = '')
    {
        // cek hak akses
        $this->cek_hak();

        $cekgambar = $this->Model2->getId('tb_provider', $id, 'kode_provider')[0];
        // var_dump($cekgambar->icon);
        // die;
        if ($cekgambar != null) {
            if ($cekgambar->icon != 'default.png') {
                // hapus file lama sesuai name geojson di database
                unlink(FCPATH . './assets/template_contoh/images/' . $cekgambar->icon);
            }

            $this->Model2->delete('tb_provider', $id, 'kode_provider');
        }
        redirect('provider');
    }
}
