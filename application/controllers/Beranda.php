<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model', 'Model2');
    }

    public function index()
    {
        $datacontent['active'] = 'beranda';
        $datacontent['title'] = 'Halaman Beranda';
        $data['content'] = $this->load->view('website/berandaView', $datacontent, TRUE);
        $data['title'] = 'Selamat Datang di Beranda';
        $this->load->view('website/layouts/html', $data);
    }
    public function about()
    {
        $datacontent['active'] = 'about';
        $datacontent['title'] = 'Halaman Beranda';
        $data['content'] = $this->load->view('website/v_about', $datacontent, TRUE);
        $data['title'] = 'About';
        $this->load->view('website/layouts/html', $data);
    }
    public function contact()
    {
        $datacontent['active'] = 'contact';
        $datacontent['title'] = 'Halaman Beranda';
        $data['content'] = $this->load->view('website/v_contact', $datacontent, TRUE);
        $data['title'] = 'Contact';
        $this->load->view('website/layouts/html', $data);
    }
    public function map()
    {
        $datacontent['active'] = 'map';

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

        if ($_POST) {
            $kategori = $this->input->post('kat');
            $v_thn = $this->input->post('thn');
            if ($kategori != 'semua') {
                $datacontent['datatabel1'] = $this->Model2->wereAND('tb_menara', 'sumber_data', 'kode_kecamatan', $v_thn, $kategori);
                $thn = $v_thn;
                $datacontent['zona'] = $this->Model2->ambil_where2('tb_zona', $kategori, 'kode_kecamatan');
                $datacontent['datatabel2'] = $this->Model2->ambil_where2('tb_kecamatan', $kategori, 'kode_kecamatan');
            }
            if ($kategori == 'semua') {
                // $datacontent['datatabel1'] = $this->Model2->wereAND('tb_menara', 'sumber_data', 'provider', $v_thn, 'TLKMv');
                $datacontent['datatabel1'] = $this->Model2->ambil_where2('tb_menara', $v_thn, 'sumber_data');
                $thn = $v_thn;
                $datacontent['zona'] = $this->Model2->get('tb_zona');
                $datacontent['datatabel2'] = $this->Model2->get('tb_kecamatan');
            }
        } else {
            $datacontent['datatabel1'] = $this->Model2->ambil_where2('tb_menara', $thn, 'sumber_data');
            $datacontent['zona'] = $this->Model2->get('tb_zona');
            $datacontent['datatabel2'] = $this->Model2->get('tb_kecamatan');
        }


        $datacontent['atribut'] = $this->Model2->get('tb_atribut');
        $datacontent['provider'] = $this->Model2->get('tb_provider');
        $datacontent['datakec'] = $this->Model2->get('tb_kecamatan');

        $datacontent['prov'] = $kategori;
        $datacontent['url'] = "beranda";
        $datacontent['thnn'] = $thn;
        $datacontent['subtitle'] = "";
        $datacontent['tahun'] = $this->Model2->select_disting();

        $datacontent['title'] = 'Halaman Beranda';
        $data['content'] = $this->load->view('website/v_map', $datacontent, TRUE);
        $data['title'] = 'Peta Persebaran Menara';
        $this->load->view('layout/html3', $data);
    }
    public function findmap()
    {
        $datacontent['active'] = 'findmap';

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

        // inisialisasi variabel
        $datacontent['lat'] = null;
        $datacontent['lat_err'] = '';
        $datacontent['long'] = null;
        $datacontent['long_err'] = '';

        $terdekat = 10000000;
        $siteid_temp = '';
        $statuszon_temp = '';
        $latzon_temp = 0;
        $longzon_temp = 0;
        $pesan_posisi = '';
        $ket = '';

        if ($_POST) {

            $lat = $this->input->post('latitude');
            // $ccc = strpos($lat, "'");
            // var_dump($ccc);
            // die;
            $lat_err = $this->Model2->cek_text($lat, '', 'OK', '', '', 'OK');
            $long = $this->input->post('longitude');
            $long_err = $this->Model2->cek_text($long, '', 'OK', '', '', 'OK');

            // var_dump($lat);
            // die;
            $lat = str_replace(',', '.', $lat);
            $long = str_replace(',', '.', $long);

            $datacontent['lat'] = $lat;
            $datacontent['long'] = $long;
            // var_dump($lat_err . '---' . $long_err);
            // die;
            if ($lat_err == '' and $long_err == '') {
                $querry = $this->Model2->get('tb_zona')->result();
                foreach ($querry as $key => $value) {
                    $lat_tb = $value->latitude;
                    $long_tb = $value->longitude;

                    // konversi dari degrees ke radians
                    $lat_from = deg2rad($lat);
                    $long_from = deg2rad($long);
                    $lat_tb_to = deg2rad($lat_tb);
                    $long_tb_to = deg2rad($long_tb);

                    $lat_delta = $lat_tb_to - $lat_from;
                    $long_delta = $long_tb_to - $long_from;

                    $angle = 2 * asin(sqrt(pow(sin($lat_delta / 2), 2) + cos($lat_from) * cos($lat_tb_to) * pow(sin($long_delta / 2), 2)));

                    // in km
                    $distance = 6371 * $angle;
                    // in m
                    // $distance = $distance * 1000;

                    if ($distance < $terdekat) {
                        $terdekat = $distance;
                        $siteid_temp = $value->site_id;
                        $statuszon_temp = $value->status;
                        $latzon_temp = $value->latitude;
                        $longzon_temp = $value->longitude;
                    }
                }

                if ($terdekat <= 0.4) {
                    // berada di dalam zona
                    $pesan_posisi = 'di dalam zona ' . $siteid_temp;
                    if ($statuszon_temp == 'new') {
                        $ket = 'Koordinat yang Anda inputkan berada pada zona yang <b>direkomendasikan</b> untuk mendirikan menara telekomunikasi yang baru';
                    } elseif ($statuszon_temp == 'eksisting') {
                        $ket = 'Koordinat yang Anda inputkan berada pada zona yang <b>Tidak direkomendasikan</b> mendirikan menara telekomunikasi yang baru, <i>disarankan untuk bergabung dengan menara yang telah ada pada zona </i>' . $siteid_temp;
                    }
                } elseif ($terdekat > 0.4) {
                    // berada di luar zona
                    $pesan_posisi = 'di luar zona ';
                    $ket = 'Dimohon agar <b>tidak mendirikan menara Baru</b> pada koordinat yang Anda inputkan';
                }
            } else {
                $datacontent['lat_err'] = $lat_err;
                $datacontent['long_err'] = $long_err;
            }

            // var_dump($terdekat . ' Km');
            // die;
        }
        $datacontent['siteid'] = $siteid_temp;
        $datacontent['latzon'] = $latzon_temp;
        $datacontent['longzon'] = $longzon_temp;
        $datacontent['statuszon'] = $statuszon_temp;
        $datacontent['posisizon'] = $pesan_posisi;
        $datacontent['ketzon'] = $ket;
        $datacontent['jarakk'] = $terdekat;

        $datacontent['datatabel1'] = $this->Model2->ambil_where2('tb_menara', $thn, 'sumber_data');
        $datacontent['atribut'] = $this->Model2->get('tb_atribut');
        $datacontent['provider'] = $this->Model2->get('tb_provider');
        $datacontent['datakec'] = $this->Model2->get('tb_kecamatan');
        $datacontent['zona'] = $this->Model2->get('tb_zona');
        $datacontent['provider'] = $this->Model2->get('tb_provider');

        $datacontent['prov'] = $kategori;
        $datacontent['url'] = "beranda";
        $datacontent['thnn'] = $thn;
        $datacontent['subtitle'] = "";
        $datacontent['datatabel2'] = $this->Model2->get('tb_kecamatan');
        $datacontent['tahun'] = $this->Model2->select_disting();

        $datacontent['title'] = 'Halaman Beranda';
        $data['content'] = $this->load->view('website/v_findmap', $datacontent, TRUE);
        $data['title'] = 'Cek Lokasi Menara';
        $this->load->view('layout/html3', $data);
    }
}
