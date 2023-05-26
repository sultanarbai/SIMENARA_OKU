<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Zona extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model', 'Model2');
        // inisialisasi halaman, mohon disesuaikan
        $page = 'zona';

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
            redirect('zona');
        }
    }

    public function index()
    {
        // inisialisasi hak
        $datapage['hak'] = "manage";
        // cek hak akses for panel kelola data
        $kode_role = $this->session->userdata('tipe');
        $beranda = $this->Model2->wereAND('tb_access', 'kode_role', 'akses', $kode_role, 'zona')->row_array();
        if ($beranda['hak'] != 'manage') {
            $datapage['hak'] = "view";
        }

        $datapage['url'] = "zona";
        $datapage['title'] = "Halaman zona";
        $datapage['subtitle'] = "";
        $datapage['datatabel'] = $this->Model2->get('tb_zona');

        // inisialisasi tahun prediksi sementara

        $i = 0;

        $kecamatan = $this->Model2->get('tb_kecamatan')->result();
        foreach ($kecamatan as $kcmtn) {
            // inisialisasi kecamatan data
            $nama_kecamatan = $kcmtn->nama_kecamatan;
            $kode_kecamatan = $kcmtn->kode_kecamatan;
            $P = $kcmtn->jumlah_penduduk;
            $sumber_data = $kcmtn->sumber_data;
            $R = $kcmtn->laju_pertumbuhan;
            $teledensitas = $kcmtn->teledensitas;
            $V = $kcmtn->ratarata_pngl;

            $t = date('Y') + 5;
            $s = $sumber_data;
            $t_min_s = $t - $s;

            // jumlah penduduk
            $PT = $P * pow((1 + ($R / 100)), $t_min_s);
            // pengguna selular
            $UT = $PT * ($teledensitas / 100);
            // intensitas traffic
            $A = $V / (24 * 60);
            // Total Traffic
            $TR = $UT * $A;

            $BT = $TR / 55.77;
            $BT = ceil($BT);
            // START MENARA
            $cekbts = null;
            $thn = date('Y');
            while ($cekbts == null) {
                $cekbts = $this->Model2->ambil_where2('tb_menara', $thn, 'sumber_data')->result();
                if ($cekbts == null) {
                    $thn = $thn - 1;
                }
            }
            $cekbts2 = $this->Model2->wereAND('tb_menara', 'sumber_data', 'kode_kecamatan', $thn, $kode_kecamatan)->result();
            // pengulangan
            $tot_menara = 0;
            $tot_bts = 0;
            if ($cekbts2 != null) {
                foreach ($cekbts2 as $btstower) {
                    $tot_bts = $tot_bts + $btstower->jumlah_operator;
                    $tot_menara = $tot_menara + 1;
                }
            }
            // Menara
            $MT = (($BT - $tot_bts) / 3) + $tot_menara;
            $MT = ceil($MT);



            $datapage['menaraku'][$i]['kode_kecamatan'] = $kode_kecamatan;
            $datapage['menaraku'][$i]['nama_kecamatan'] = $nama_kecamatan;
            $datapage['menaraku'][$i]['prediksi_penduduk'] = $PT;
            $datapage['menaraku'][$i]['prediksi_pengguna'] = $UT;
            $datapage['menaraku'][$i]['intensitas_traffic'] = $A;
            $datapage['menaraku'][$i]['total_traffic'] = $TR;
            $datapage['menaraku'][$i]['prediksi_bts'] = $BT;
            $datapage['menaraku'][$i]['tot_bts'] = $tot_bts;
            $datapage['menaraku'][$i]['tot_menara'] = $tot_menara;
            $datapage['menaraku'][$i]['prediksi_menara'] = $MT;
            $datapage['menaraku'][$i]['selisih_menara'] = $MT - $tot_menara;
            $i = $i + 1;
        }
        $datapage['jumlah_kecamatan'] = $i;
        $datapage['tahun'] = $t;
        $datapage['thn'] = $thn;

        // load view v_zona
        $data['menara'] = $this->load->view('zona/v_zona', $datapage, TRUE);
        $this->load->view('layout/html', $data);
    }
    public function form_tambah()
    {
        $this->cek_hak();

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

        $datapage['datatabel1'] = $this->Model2->ambil_where2('tb_menara', $thn, 'sumber_data');
        $datapage['zona'] = $this->Model2->get('tb_zona');
        $datapage['datatabel2'] = $this->Model2->get('tb_kecamatan');

        $datapage['atribut'] = $this->Model2->get('tb_atribut');
        $datapage['provider'] = $this->Model2->get('tb_provider');
        $datapage['datakec'] = $this->Model2->get('tb_kecamatan');

        $datapage['prov'] = $kategori;
        $datapage['thnn'] = $thn;
        $datapage['url'] = "zona";
        $datapage['title'] = "";
        $datapage['subtitle'] = "";

        $datapage['data1'] = '';
        $datapage['data2'] = '';
        $datapage['data3'] = '';
        $datapage['data4'] = '';
        $datapage['err1'] = '';
        $datapage['err2'] = '';
        $datapage['err3'] = '';
        $datapage['err4'] = '';
        $datapage['same'] = '';

        if (!$_POST) {
            $data['menara'] = $this->load->view('zona/v_form_addz', $datapage, TRUE);
            $this->load->view('layout/html2', $data);
        } elseif ($_POST) {
            $site_id = $this->input->post('site_id');
            $err1 = $this->Model2->cek_post($site_id, 'hurang');
            $kecamatan = $this->input->post('kecamatan');
            $err2 = $this->Model2->cek_post($kecamatan, 'hurang');
            $latitude = $this->input->post('latitude');
            $err3 = $this->Model2->cek_post($latitude, 'minfloat');
            $longitude = $this->input->post('longitude');
            $err4 = $this->Model2->cek_post($longitude, 'minfloat');
            $latitude = str_replace(',', '.', $latitude);
            $longitude = str_replace(',', '.', $longitude);
            $latitude = str_replace(' ', '', $latitude);
            $longitude = str_replace(' ', '', $longitude);
            $status = $this->input->post('status');

            $same = '';
            $tess['result'] = $this->Model2->get('tb_zona');

            foreach ($tess['result']->result() as $asu) {
                if ($site_id == $asu->site_id) {
                    $same = 'Kode Kecamatan Tidak Tersedia';
                }
            }

            if ($err1 === '' and $err2 === '' and $err3 === '' and $err4 === '' and $same === '') {
                $data = ['site_id' => $site_id, 'kode_kecamatan' => $kecamatan, 'latitude' => $latitude, 'longitude' => $longitude, 'status' => $status];
                $this->Model2->add('tb_zona', $data);
                if ($status == 'eksisting') {
                    $cek_zona['result'] = $this->Model2->ambil_where2('tb_kecamatan', $kecamatan, 'kode_kecamatan');
                    foreach ($cek_zona['result']->result() as $val) {
                        $jumlah_cek = $val->jumlah_zona_eksisting;
                    }
                    $jumlah_zona_eksisting = $jumlah_cek + 1;
                    $data = ['jumlah_zona_eksisting' => $jumlah_zona_eksisting];
                    $this->Model2->update('tb_kecamatan', $kecamatan, $data, 'kode_kecamatan');
                } elseif ($status == 'new') {
                    $cek_zona['result'] = $this->Model2->ambil_where2('tb_kecamatan', $kecamatan, 'kode_kecamatan');
                    foreach ($cek_zona['result']->result() as $val) {
                        $jumlah_cek = $val->jumlah_zona_new;
                    }
                    $jumlah_zona_new = $jumlah_cek + 1;
                    $data = ['jumlah_zona_new' => $jumlah_zona_new];
                    $this->Model2->update('tb_kecamatan', $kecamatan, $data, 'kode_kecamatan');
                }
                redirect('zona');
            } else {
                $datapage['data1'] = $site_id;
                $datapage['data2'] = $kecamatan;
                $datapage['data3'] = $latitude;
                $datapage['data4'] = $longitude;
                $datapage['err1'] = $err1;
                $datapage['err2'] = $err2;
                $datapage['err3'] = $err3;
                $datapage['err4'] = $err4;
                $datapage['same'] = $same;

                $data['menara'] = $this->load->view('zona/v_form_addz', $datapage, TRUE);
                $this->load->view('layout/html2', $data);
            }
        }
    }
    public function form_ubah($id = '')
    {
        $this->cek_hak();
        if ($id === '') {
            redirect('upsss');
        } else {
            $cek = $this->Model2->ambil_where2('tb_zona', $id, 'site_id')->result();
            if ($cek == null or $cek == '') {

                redirect('upsss');
            }
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

        $datapage['datatabel1'] = $this->Model2->ambil_where2('tb_menara', $thn, 'sumber_data');
        $datapage['zona'] = $this->Model2->get('tb_zona');
        $datapage['datatabel2'] = $this->Model2->get('tb_kecamatan');

        $datapage['atribut'] = $this->Model2->get('tb_atribut');
        $datapage['provider'] = $this->Model2->get('tb_provider');
        $datapage['datakec'] = $this->Model2->get('tb_kecamatan');

        $datapage['prov'] = $kategori;
        $datapage['thnn'] = $thn;

        $datapage['url'] = "zona";
        $datapage['title'] = "Halaman Ubah Data zona";
        $datapage['subtitle'] = "Form Ubah";

        $datapage['datatabel'] = $this->Model2->ambil_where2('tb_zona', $id, 'site_id')->result();

        $datapage['err1'] = '';
        $datapage['err2'] = '';
        $datapage['err3'] = '';
        $datapage['err4'] = '';
        $datapage['same'] = '';

        if (!$_POST) {
            $data['menara'] = $this->load->view('zona/v_form_updatez', $datapage, TRUE);
            $this->load->view('layout/html2', $data);
        } elseif ($_POST) {
            $site_id = $this->input->post('site_id');
            $err1 = $this->Model2->cek_post($site_id, 'hurang');
            $kecamatan = $this->input->post('kecamatan');
            $err2 = $this->Model2->cek_post($kecamatan, 'hurang');
            $latitude = $this->input->post('latitude');
            $err3 = $this->Model2->cek_post($latitude, 'minfloat');
            $longitude = $this->input->post('longitude');
            $err4 = $this->Model2->cek_post($longitude, 'minfloat');
            $latitude = str_replace(',', '.', $latitude);
            $longitude = str_replace(',', '.', $longitude);
            $latitude = str_replace(' ', '', $latitude);
            $longitude = str_replace(' ', '', $longitude);
            $status = $this->input->post('status');
            if ($err1 === '' and $err2 === '' and $err3 === '' and $err4 === '') {
                $cek_zona['result'] = $this->Model2->ambil_where2('tb_zona', $site_id, 'site_id');
                foreach ($cek_zona['result']->result() as $val) {
                    $kecamatan_lama = $val->kode_kecamatan;
                    $status_lama = $val->status;
                }
                if ($kecamatan != $kecamatan_lama) {
                    if ($status == 'eksisting') {
                        $cek_zona['result'] = $this->Model2->ambil_where2('tb_kecamatan', $kecamatan, 'kode_kecamatan');
                        foreach ($cek_zona['result']->result() as $val) {
                            $jumlah_cek = $val->jumlah_zona_eksisting;
                        }
                        $jumlah_zona_eksisting = $jumlah_cek + 1;
                        $data = ['jumlah_zona_eksisting' => $jumlah_zona_eksisting];
                        $this->Model2->update('tb_kecamatan', $kecamatan, $data, 'kode_kecamatan');
                    } elseif ($status == 'new') {
                        $cek_zona['result'] = $this->Model2->ambil_where2('tb_kecamatan', $kecamatan, 'kode_kecamatan');
                        foreach ($cek_zona['result']->result() as $val) {
                            $jumlah_cek = $val->jumlah_zona_new;
                        }
                        $jumlah_zona_new = $jumlah_cek + 1;
                        $data = ['jumlah_zona_new' => $jumlah_zona_new];
                        $this->Model2->update('tb_kecamatan', $kecamatan, $data, 'kode_kecamatan');
                    }
                    $cek_ricek['result'] = $this->Model2->ambil_where2('tb_kecamatan', $kecamatan_lama, 'kode_kecamatan')->result();
                    if ($cek_ricek['result'] != null) {
                        if ($status_lama == 'eksisting') {
                            $cek_zona['result'] = $this->Model2->ambil_where2('tb_kecamatan', $kecamatan_lama, 'kode_kecamatan');
                            foreach ($cek_zona['result']->result() as $val) {
                                $jumlah_cek = $val->jumlah_zona_eksisting;
                            }
                            $jumlah_zona_eksisting = $jumlah_cek - 1;
                            $data = ['jumlah_zona_eksisting' => $jumlah_zona_eksisting];
                            $this->Model2->update('tb_kecamatan', $kecamatan_lama, $data, 'kode_kecamatan');
                        } elseif ($status_lama == 'new') {
                            $cek_zona['result'] = $this->Model2->ambil_where2('tb_kecamatan', $kecamatan_lama, 'kode_kecamatan');
                            foreach ($cek_zona['result']->result() as $val) {
                                $jumlah_cek = $val->jumlah_zona_new;
                            }
                            $jumlah_zona_new = $jumlah_cek - 1;
                            $data = ['jumlah_zona_new' => $jumlah_zona_new];
                            $this->Model2->update('tb_kecamatan', $kecamatan_lama, $data, 'kode_kecamatan');
                        }
                    }
                }
                if ($kecamatan == $kecamatan_lama) {
                    $cek_ricek['result'] = $this->Model2->ambil_where2('tb_kecamatan', $kecamatan, 'kode_kecamatan')->result();
                    if ($cek_ricek['result'] != null) {
                        if ($status_lama != $status) {
                            if ($status == 'new') {
                                $cek_zona['result'] = $this->Model2->ambil_where2('tb_kecamatan', $kecamatan, 'kode_kecamatan');
                                foreach ($cek_zona['result']->result() as $val) {
                                    $jumlah_cek = $val->jumlah_zona_new;
                                }
                                $jumlah_zona_new = $jumlah_cek + 1;
                                $data = ['jumlah_zona_new' => $jumlah_zona_new];
                                $this->Model2->update('tb_kecamatan', $kecamatan, $data, 'kode_kecamatan');
                            } elseif ($status == 'eksisting') {
                                $cek_zona['result'] = $this->Model2->ambil_where2('tb_kecamatan', $kecamatan, 'kode_kecamatan');
                                foreach ($cek_zona['result']->result() as $val) {
                                    $jumlah_cek = $val->jumlah_zona_eksisting;
                                }
                                $jumlah_zona_eksisting = $jumlah_cek + 1;
                                $data = ['jumlah_zona_eksisting' => $jumlah_zona_eksisting];
                                $this->Model2->update('tb_kecamatan', $kecamatan, $data, 'kode_kecamatan');
                            }

                            if ($status_lama == 'new') {
                                $cek_zona['result'] = $this->Model2->ambil_where2('tb_kecamatan', $kecamatan, 'kode_kecamatan');
                                foreach ($cek_zona['result']->result() as $val) {
                                    $jumlah_cek = $val->jumlah_zona_new;
                                }
                                $jumlah_zona_new = $jumlah_cek - 1;
                                $data = ['jumlah_zona_new' => $jumlah_zona_new];
                                $this->Model2->update('tb_kecamatan', $kecamatan, $data, 'kode_kecamatan');
                            } elseif ($status_lama == 'eksisting') {
                                $cek_zona['result'] = $this->Model2->ambil_where2('tb_kecamatan', $kecamatan, 'kode_kecamatan');
                                foreach ($cek_zona['result']->result() as $val) {
                                    $jumlah_cek = $val->jumlah_zona_eksisting;
                                }
                                $jumlah_zona_eksisting = $jumlah_cek - 1;
                                $data = ['jumlah_zona_eksisting' => $jumlah_zona_eksisting];
                                $this->Model2->update('tb_kecamatan', $kecamatan, $data, 'kode_kecamatan');
                            }
                        }
                    }
                }

                $data = ['kode_kecamatan' => $kecamatan, 'latitude' => $latitude, 'longitude' => $longitude, 'status' => $status];
                $this->Model2->update('tb_zona', $site_id, $data, 'site_id');

                redirect('zona');
            } else {
                $datapage['err1'] = $err1;
                $datapage['err2'] = $err2;
                $datapage['err3'] = $err3;
                $datapage['err4'] = $err4;
                $datapage['same'] = '';
                $data['menara'] = $this->load->view('zona/v_form_updatez', $datapage, TRUE);
                $this->load->view('layout/html2', $data);
            }
        }
    }


    public function del($id = '')
    {
        $this->cek_hak();
        if ($id === '') {
            redirect('upsss');
        } else {
            $cek = $this->Model2->ambil_where2('tb_zona', $id, 'site_id')->result();
            if ($cek == null or $cek == '') {

                redirect('upsss');
            }
        }

        $cek_zona['result'] = $this->Model2->ambil_where2('tb_zona', $id, 'site_id');
        foreach ($cek_zona['result']->result() as $val) {
            $kecamatan = $val->kecamatan;
            $status = $val->status;
        }
        $this->Model2->delete('tb_zona', $id, 'site_id');

        if ($status == 'eksisting') {
            $cek_zona['result'] = $this->Model2->ambil_where2('tb_kecamatan', $kecamatan, 'kode_kecamatan');
            foreach ($cek_zona['result']->result() as $val) {
                $jumlah_cek = $val->jumlah_zona_eksisting;
            }
            $jumlah_zona_eksisting = $jumlah_cek - 1;
            $data = ['jumlah_zona_eksisting' => $jumlah_zona_eksisting];
            $this->Model2->update('tb_kecamatan', $kecamatan, $data, 'kode_kecamatan');
        } elseif ($status == 'new') {
            $cek_zona['result'] = $this->Model2->ambil_where2('tb_kecamatan', $kecamatan, 'kode_kecamatan');
            foreach ($cek_zona['result']->result() as $val) {
                $jumlah_cek = $val->jumlah_zona_new;
            }
            $jumlah_zona_new = $jumlah_cek - 1;
            $data = ['jumlah_zona_new' => $jumlah_zona_new];
            $this->Model2->update('tb_kecamatan', $kecamatan, $data, 'kode_kecamatan');
        }
        redirect('zona');
    }
}
