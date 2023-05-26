<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menara extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model', 'Model2');
        // inisialisasi halaman, mohon disesuaikan
        $page = 'menara';

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
            redirect('menara');
        }
    }

    public function index()
    {
        // inisialisasi hak
        $datapage['hak'] = "manage";
        // cek hak akses for panel kelola data
        $kode_role = $this->session->userdata('tipe');
        $beranda = $this->Model2->wereAND('tb_access', 'kode_role', 'akses', $kode_role, 'menara')->row_array();
        if ($beranda['hak'] != 'manage') {
            $datapage['hak'] = "view";
        }

        $stop = false;
        $thn = date('Y');
        while ($stop == false) {
            $cektahun['result'] = $this->Model2->ambil_where2('tb_menara', $thn, 'sumber_data');


            if ($cektahun['result']->result() == null) {
                $thn = $thn - 1;
            } else {
                $stop = true;
            }
        }
        $kategori = 'semua';
        $datapage['datatabel'] = $this->Model2->ambil_where2('tb_menara', $thn, 'sumber_data');

        if (isset($_POST['kategori'])) {
            $kategori = $this->input->post('kat');
            $v_thn = $this->input->post('thn');
            if ($kategori != 'semua') {
                $datapage['datatabel'] = $this->Model2->wereAND('tb_menara', 'sumber_data', 'kode_kecamatan', $v_thn, $kategori);
                $thn = $v_thn;
            } else {
                $datapage['datatabel'] = $this->Model2->ambil_where2('tb_menara', $v_thn, 'sumber_data');
                $thn = $v_thn;
            }
        }


        $datapage['prov'] = $kategori;
        $datapage['thnn'] = $thn;
        $datapage['url'] = "menara";
        $datapage['title'] = "Halaman Menara";
        $datapage['subtitle'] = "";

        $datapage['tahun'] = $this->Model2->select_disting();
        $datapage['kecamatan'] = $this->Model2->get('tb_kecamatan');
        $datapage['pemilik'] = $this->Model2->get('tb_provider');

        $data['menara'] = $this->load->view('menara/v_menara', $datapage, TRUE);

        $data['title'] = $datapage['title'];
        $this->load->view('layout/html', $data);
    }
    public function form_tambah()
    {
        $this->cek_hak();

        $datapage['url'] = "menara";
        $datapage['title'] = "Formulir Tambah Menara";
        $datapage['subtitle'] = "";
        $datapage['datatabel1'] = $this->Model2->get('tb_provider');
        $datapage['datatabel3'] = $this->Model2->get('tb_kecamatan');
        $datapage['datatabel4'] = $this->Model2->get('tb_zona');

        $datapage['data1'] = '';
        $datapage['data2'] = '';
        $datapage['data3'] = '';
        $datapage['data4'] = '';
        $datapage['data5'] = '';
        $datapage['data6'] = '';
        $datapage['err1'] = '';
        $datapage['err2'] = '';
        $datapage['err3'] = '';
        $datapage['err4'] = '';
        $datapage['err5'] = '';
        $datapage['err6'] = '';

        if (!$_POST) {
            $data['menara'] = $this->load->view('menara/v_form_add', $datapage, TRUE);
            $data['title'] = $datapage['title'];
            $this->load->view('layout/html', $data);
        } elseif ($_POST) {
            $site_id = $this->input->post('site_id');
            $kecamatan = $this->input->post('kecamatan');
            $jenis_menara = $this->input->post('jenis_menara');
            $provider = $this->input->post('provider');
            $sumber_data = $this->input->post('tahun');

            $kelurahan = $this->input->post('kelurahan');
            $err1 = $this->Model2->cek_post($kelurahan, 'hurang');
            $alamat = $this->input->post('alamat');
            $err2 = $this->Model2->cek_post($alamat);
            $tinggi_menara = $this->input->post('tinggi_menara');
            $err3 = $this->Model2->cek_post($tinggi_menara, 'float');
            $latitude = $this->input->post('latitude');
            $err4 = $this->Model2->cek_post($latitude, 'minfloat');
            $longitude = $this->input->post('longitude');
            $err5 = $this->Model2->cek_post($longitude, 'minfloat');
            $jumlah_operator = $this->input->post('jumlah_operator');
            $err6 = $this->Model2->cek_post($jumlah_operator, 'integer');

            $latitude = str_replace(',', '.', $latitude);
            $longitude = str_replace(',', '.', $longitude);
            $latitude = str_replace(' ', '', $latitude);
            $longitude = str_replace(' ', '', $longitude);

            if ($err1 === '' and $err2 === '' and $err3 === '' and $err4 === '' and $err5 === '' and $err6 === '') {
                //cari data yang punya kode_provider = $kode_provider
                $cekid_menara['result'] = $this->Model2->ambil_where2('tb_menara', $provider, 'kode_provider');

                $plus_id = 100;
                $id_menara_baru = $kecamatan . $provider . $sumber_data . $plus_id;
                if ($cekid_menara['result'] == NULL) {
                    $id_menara_baru = $kecamatan . $provider . $sumber_data . $plus_id;
                } elseif ($cekid_menara != NULL) {
                    foreach ($cekid_menara['result']->result() as $sip) {
                        $id_menara_lama = $sip->kode_menara;
                        if ($id_menara_baru == $id_menara_lama) {
                            $plus_id = $plus_id + 1;
                            $id_menara_baru = $kecamatan . $provider . $sumber_data . $plus_id;
                        }
                    }
                }

                if ($site_id != '') {
                    $cek_zona['result'] = $this->Model2->ambil_where2('tb_zona', $site_id, 'site_id');
                    foreach ($cek_zona['result']->result() as $val) {
                        $jumlah_menara = $val->jumlah_menara;
                    }
                    $jumlah_menara = $jumlah_menara + 1;
                    $data = ['jumlah_menara' => $jumlah_menara, 'status' => 'eksisting'];
                    $this->Model2->update('tb_zona', $site_id, $data, 'site_id');
                }
                $data = ['kode_menara' => $id_menara_baru, 'site_id' => $site_id, 'kelurahan' => $kelurahan, 'alamat' => $alamat, 'kode_kecamatan' => $kecamatan, 'tinggi_menara' => $tinggi_menara, 'kode_jenis_menara' => $jenis_menara, 'latitude' => $latitude, 'longitude' => $longitude, 'jumlah_operator' => $jumlah_operator, 'sumber_data' => $sumber_data, 'kode_provider' => $provider];

                $this->Model2->add('tb_menara', $data);

                $this->Model2->setSessionFlash('sukses', ' Berhasil Disimpan ;)');
                redirect('menara');
            } else {
                $datapage['data1'] = $kelurahan;
                $datapage['data2'] = $alamat;
                $datapage['data3'] = $tinggi_menara;
                $datapage['data4'] = $latitude;
                $datapage['data5'] = $longitude;
                $datapage['data6'] = $jumlah_operator;
                $datapage['err1'] = $err1;
                $datapage['err2'] = $err2;
                $datapage['err3'] = $err3;
                $datapage['err4'] = $err4;
                $datapage['err5'] = $err5;
                $datapage['err6'] = $err6;
                $data['menara'] = $this->load->view('menara/v_form_add', $datapage, TRUE);
                $data['title'] = $datapage['title'];
                $this->load->view('layout/html', $data);
            }


            // var_dump($_POST);
            // die;
        }
    }
    public function form_ubah($id = '')
    {
        $this->cek_hak();
        if ($id === '') {
            redirect('upsss');
        } else {
            $cek = $this->Model2->ambil_where2('tb_menara', $id, 'kode_menara')->result();
            if ($cek == null or $cek == '') {

                redirect('upsss');
            }
        }

        $datapage['url'] = "menara";
        $datapage['title'] = "Formulir Ubah Menara";
        $datapage['subtitle'] = "";
        $datapage['datatabel'] = $this->Model2->ambil_where2('tb_menara', $id, 'kode_menara')->result();
        $datapage['datajoin'] = $this->Model2->getJoinDisting('tb_provider.kode_provider,tb_provider.nama_provider', 'tb_provider', 'tb_menara', 'tb_provider.kode_provider = tb_menara.kode_provider');
        $datapage['datatabel1'] = $this->Model2->get('tb_provider');
        $datapage['datatabel3'] = $this->Model2->get('tb_kecamatan');
        $datapage['datatabel4'] = $this->Model2->get('tb_zona');

        $datapage['err1'] = '';
        $datapage['err2'] = '';
        $datapage['err3'] = '';
        $datapage['err4'] = '';
        $datapage['err5'] = '';
        $datapage['err6'] = '';

        if (!$_POST) {
            $data['menara'] = $this->load->view('menara/v_form_update', $datapage, TRUE);
            $data['title'] = $datapage['title'];
            $this->load->view('layout/html', $data);
        } elseif ($_POST) {
            $id_menara = $this->input->post('template');
            $site_id = $this->input->post('site_id');
            $kecamatan = $this->input->post('kecamatan');
            $jenis_menara = $this->input->post('jenis_menara');
            $provider = $this->input->post('provider');
            $sumber_data = $this->input->post('tahun');

            $kelurahan = $this->input->post('kelurahan');
            $err1 = $this->Model2->cek_post($kelurahan, 'hurang');
            $alamat = $this->input->post('alamat');
            $err2 = $this->Model2->cek_post($alamat);
            $tinggi_menara = $this->input->post('tinggi_menara');
            $err3 = $this->Model2->cek_post($tinggi_menara, 'float');
            $latitude = $this->input->post('latitude');
            $err4 = $this->Model2->cek_post($latitude, 'minfloat');
            $longitude = $this->input->post('longitude');
            $err5 = $this->Model2->cek_post($longitude, 'minfloat');
            $jumlah_operator = $this->input->post('jumlah_operator');
            $err6 = $this->Model2->cek_post($jumlah_operator, 'integer');

            $latitude = str_replace(',', '.', $latitude);
            $longitude = str_replace(',', '.', $longitude);
            $latitude = str_replace(' ', '', $latitude);
            $longitude = str_replace(' ', '', $longitude);

            if ($err1 === '' and $err2 === '' and $err3 === '' and $err4 === '' and $err5 === '' and $err6 === '') {
                if ($site_id != '') {

                    $cek_menara['result'] = $this->Model2->ambil_where2('tb_menara', $id_menara, 'kode_menara');
                    foreach ($cek_menara['result']->result() as $val) {
                        $site_id_lama = $val->site_id;
                    }
                    if ($site_id_lama != '') {
                        // kurangi jumlah menara di site id lama
                        $cek_zona['result'] = $this->Model2->ambil_where2('tb_zona', $site_id_lama, 'site_id');
                        foreach ($cek_zona['result']->result() as $val) {
                            $jumlah_menara = $val->jumlah_menara;
                        }
                        $jumlah_menara = $jumlah_menara - 1;
                        $data = ['jumlah_menara' => $jumlah_menara, 'status' => 'eksisting'];
                        $this->Model2->update('tb_zona', $site_id_lama, $data, 'site_id');
                    }
                    // tambah jumlah menara di site id baru
                    $cek_zona['result'] = $this->Model2->ambil_where2('tb_zona', $site_id, 'site_id');
                    foreach ($cek_zona['result']->result() as $val) {
                        $jumlah_menara = $val->jumlah_menara;
                    }
                    $jumlah_menara = $jumlah_menara + 1;
                    $data = ['jumlah_menara' => $jumlah_menara, 'status' => 'eksisting'];
                    $this->Model2->update('tb_zona', $site_id, $data, 'site_id');
                }

                $data = ['site_id' => $site_id, 'kelurahan' => $kelurahan, 'alamat' => $alamat, 'kode_kecamatan' => $kecamatan, 'tinggi_menara' => $tinggi_menara, 'kode_jenis_menara' => $jenis_menara, 'latitude' => $latitude, 'longitude' => $longitude, 'jumlah_operator' => $jumlah_operator, 'sumber_data' => $sumber_data, 'kode_provider' => $provider];
                $this->Model2->update('tb_menara', $id_menara, $data, 'kode_menara');

                $this->Model2->setSessionFlash('sukses', ' Berhasil ;)');


                redirect('menara');
            } else {
                $datapage['err1'] = $err1;
                $datapage['err2'] = $err2;
                $datapage['err3'] = $err3;
                $datapage['err4'] = $err4;
                $datapage['err5'] = $err5;
                $datapage['err6'] = $err6;

                $data['menara'] = $this->load->view('menara/v_form_update', $datapage, TRUE);
                $data['title'] = $datapage['title'];
                $this->load->view('layout/html', $data);
            }
        }
    }


    public function ubah_zona($id = '')
    {
        $this->cek_hak();
        if ($id === '') {
            redirect('upsss');
        } else {
            $cek = $this->Model2->ambil_where2('tb_menara', $id, 'kode_menara')->result();
            if ($cek == null or $cek == '') {
                redirect('upsss');
            }
        }

        $id_menara = $id;
        $menara['result'] = $this->Model2->ambil_where2('tb_menara', $id_menara, 'kode_menara');
        foreach ($menara['result']->result() as $val) {
            $site_id = $val->site_id;
            $main_latt = $val->latitude;
            $main_long = $val->longitude;
        }
        if ($main_latt != '0' or $main_latt != null) {
            $stop = false;
            $thn = date('Y');
            while ($stop == false) {
                $cektahun['result'] = $this->Model2->ambil_where2('tb_menara', $thn, 'sumber_data');
                if ($cektahun['result']->result() == null) {
                    $thn = $thn - 1;
                } else {
                    $stop = true;
                }
            }
            $zona['result'] = $this->Model2->get('tb_zona');
            // pengecekan jarak menara dengan zona
            $jarak = 1000;
            $site_id = '';
            foreach ($zona['result']->result() as $val) {
                if ($val->longitude != '0' or $val->longitude != null) {
                    $R = 6371;
                    $lat1 = $main_latt;
                    $lon1 = $main_long;
                    $dLat = deg2rad($val->latitude - $lat1);
                    $dLon = deg2rad($val->longitude - $lon1);

                    $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($val->latitude)) * sin($dLon / 2) * sin($dLon / 2);
                    $c = 2 * asin(sqrt($a));
                    $d = $R * $c;
                    // jika dah tahu jaraknya maka cek
                    if ($d < $jarak) {
                        // simpan jarak
                        $jarak = $d;
                        $site_id = $val->site_id;
                    }
                }
            }



            if ($site_id != '') {

                $cek_menara['result'] = $this->Model2->ambil_where2('tb_menara', $id_menara, 'kode_menara');
                foreach ($cek_menara['result']->result() as $val) {
                    $site_id_lama = $val->site_id;
                }
                if ($site_id_lama != '') {
                    // kurangi jumlah menara di site id lama
                    $cek_zona['result'] = $this->Model2->ambil_where2('tb_zona', $site_id_lama, 'site_id');
                    foreach ($cek_zona['result']->result() as $val) {
                        $jumlah_menara = $val->jumlah_menara;
                    }
                    $jumlah_menara = $jumlah_menara - 1;
                    $data = ['jumlah_menara' => $jumlah_menara, 'status' => 'eksisting'];
                    $this->Model2->update('tb_zona', $site_id_lama, $data, 'site_id');
                }
                // tambah jumlah menara di site id baru
                $cek_zona['result'] = $this->Model2->ambil_where2('tb_zona', $site_id, 'site_id');
                foreach ($cek_zona['result']->result() as $val) {
                    $jumlah_menara = $val->jumlah_menara;
                }
                $jumlah_menara = $jumlah_menara + 1;
                $data = ['jumlah_menara' => $jumlah_menara, 'status' => 'eksisting'];
                $this->Model2->update('tb_zona', $site_id, $data, 'site_id');
            }

            $data = ['site_id' => $site_id];
            $this->Model2->update('tb_menara', $id_menara, $data, 'kode_menara');

            $this->Model2->setSessionFlash('sukses', ' Berhasil ;)');


            redirect('menara');
        }
    }
    public function del($id = '')
    {
        $this->cek_hak();
        if ($id === '') {
            redirect('upsss');
        }
        $this->Model2->delete('tb_menara', $id, 'kode_menara');
        redirect('menara');
    }
}
