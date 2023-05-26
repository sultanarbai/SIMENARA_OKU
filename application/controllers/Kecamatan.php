<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kecamatan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model', 'Model2');
        // inisialisasi halaman, mohon disesuaikan
        $page = 'kecamatan';

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
            redirect('kecamatan');
        }
    }
    public function index()
    {
        // inisialisasi hak
        $datapage['hak'] = "manage";
        // cek hak akses for panel kelola data
        $kode_role = $this->session->userdata('tipe');
        $beranda = $this->Model2->wereAND('tb_access', 'kode_role', 'akses', $kode_role, 'kecamatan')->row_array();
        if ($beranda['hak'] != 'manage') {
            $datapage['hak'] = "view";
        }

        $datapage['url'] = "kecamatan";
        $datapage['title'] = "Data Kecamatan";
        $datapage['subtitle'] = "";
        $datapage['datatabel'] = $this->Model2->get('tb_kecamatan');
        $data['menara'] = $this->load->view('kec/v_kecamatan', $datapage, TRUE);
        $this->load->view('layout/html', $data);
    }
    public function form_tambah()
    {
        $this->cek_hak();

        $datapage['url'] = "kecamatan";
        $datapage['title'] = "Halaman Tambah Kecamatan";
        $datapage['subtitle'] = "";

        $datapage['kode_kecamatan'] = '';
        $datapage['err1'] = '';
        $datapage['nama_kecamatan'] = '';
        $datapage['err2'] = '';
        $datapage['jumlah_penduduk'] = '';
        $datapage['err3'] = '';
        $datapage['laju_pertumbuhan'] = '';
        $datapage['err4'] = '';
        $datapage['luas_wilayah'] = '';
        $datapage['err5'] = '';
        $datapage['sumber_data'] = '';
        $datapage['err6'] = '';
        $datapage['teledensitas'] = '';
        $datapage['err7'] = '';
        $datapage['ratarata_pngl'] = '';
        $datapage['err8'] = '';
        $datapage['same'] = '';


        // $text = '-2093-19294';
        // var_dump(strpos($text, '.'));
        // var_dump(substr_count($text, '.'));
        // die;


        if (!$_POST) {
            $data['menara'] = $this->load->view('kec/v_form_addkec', $datapage, TRUE);
            $this->load->view('layout/html', $data);
        } elseif ($_POST) {
            $kode_kecamatan = $this->input->post('kode_kecamatan');
            $err1 = $this->Model2->cek_post($kode_kecamatan, 'hurang',);
            $nama_kecamatan = $this->input->post('nama_kecamatan');
            $err2 = $this->Model2->cek_post($nama_kecamatan, 'hurang');
            $jumlah_penduduk = $this->input->post('jumlah_penduduk');
            $err3 = $this->Model2->cek_post($jumlah_penduduk, 'integer');
            $laju_pertumbuhan = $this->input->post('laju_pertumbuhan');
            $laju_pertumbuhan = str_replace(',', '.', $laju_pertumbuhan);
            $err4 = $this->Model2->cek_post($laju_pertumbuhan, 'minfloat');
            $luas_wilayah = $this->input->post('luas_wilayah');
            $luas_wilayah = str_replace(',', '.', $luas_wilayah);
            $err5 = $this->Model2->cek_post($luas_wilayah, 'float');
            $sumber_data = $this->input->post('sumber_data');
            $err6 = $this->Model2->cek_post($sumber_data, 'integer');
            $teledensitas = $this->input->post('teledensitas');
            $teledensitas = str_replace(',', '.', $teledensitas);
            $err7 = $this->Model2->cek_post($teledensitas, 'float');
            $ratarata_pngl = $this->input->post('ratarata_pngl');
            $ratarata_pngl = str_replace(',', '.', $ratarata_pngl);
            $err8 = $this->Model2->cek_post($ratarata_pngl, 'float');

            $truex = 0;
            $same = '';
            $tess['result'] = $this->Model2->get('tb_kecamatan');

            foreach ($tess['result']->result() as $asu) {
                if ($kode_kecamatan == $asu->kode_kecamatan) {
                    $truex = 1;
                    $same = 'Kode Kecamatan Tidak Tersedia';
                }
            }
            // var_dump($err1 . $err2 . $err3 . $err4 . $err5 . $truex);
            // die;
            if ($err1 === '' and $err2 === '' and $err3 === '' and $err4 === '' and $err5 === '' and $err6 === '' and $err7 === '' and $err8 === '' and $truex === 0) {
                $teledensitas = str_replace(' ', '', $teledensitas);
                $ratarata_pngl = str_replace(' ', '', $ratarata_pngl);
                $laju_pertumbuhan = str_replace(' ', '', $laju_pertumbuhan);
                $luas_wilayah = str_replace(' ', '', $luas_wilayah);

                $teledensitas = floatval($teledensitas);
                $ratarata_pngl = floatval($ratarata_pngl);
                $laju_pertumbuhan = floatval($laju_pertumbuhan);
                $luas_wilayah = floatval($luas_wilayah);
                // kepadatan
                if ($jumlah_penduduk != null and $jumlah_penduduk != 0 and $luas_wilayah != null and $luas_wilayah != 0) {
                    $kepadatan_penduduk = $jumlah_penduduk / $luas_wilayah;
                } elseif ($jumlah_penduduk == null or $jumlah_penduduk == 0 or $luas_wilayah == null or $luas_wilayah == 0) {
                    $kepadatan_penduduk = 0;
                }

                $data = ['kode_kecamatan' => $kode_kecamatan, 'nama_kecamatan' => $nama_kecamatan, 'jumlah_penduduk' => $jumlah_penduduk, 'laju_pertumbuhan' => $laju_pertumbuhan, 'luas_wilayah' => $luas_wilayah, 'kepadatan_penduduk' => $kepadatan_penduduk, 'sumber_data' => $sumber_data, 'teledensitas' => $teledensitas, 'ratarata_pngl' => $ratarata_pngl];
                $this->Model2->add('tb_kecamatan', $data);
                $this->Model2->setSessionFlash('sukses', ' Berhasil Disimpan .....  ;)');

                redirect('kecamatan');
            } else {
                $datapage['kode_kecamatan'] = $kode_kecamatan;
                $datapage['err1'] = $err1;
                $datapage['nama_kecamatan'] = $nama_kecamatan;
                $datapage['err2'] = $err2;
                $datapage['jumlah_penduduk'] = $jumlah_penduduk;
                $datapage['err3'] = $err3;
                $datapage['laju_pertumbuhan'] = $laju_pertumbuhan;
                $datapage['err4'] = $err4;
                $datapage['luas_wilayah'] = $luas_wilayah;
                $datapage['err5'] = $err5;
                $datapage['sumber_data'] = $sumber_data;
                $datapage['err6'] = $err6;
                $datapage['teledensitas'] = $teledensitas;
                $datapage['err7'] = $err7;
                $datapage['ratarata_pngl'] = $ratarata_pngl;
                $datapage['err8'] = $err8;
                $datapage['same'] = $same;
                $data['menara'] = $this->load->view('kec/v_form_addkec', $datapage, TRUE);
                $this->load->view('layout/html', $data);
            }
        }
    }


    public function form_ubah($id = '')
    {
        $this->cek_hak();
        // untuk cek kondisi id
        if ($id === '') {
            redirect('upsss');
        } else {
            $cek = $this->Model2->getId('tb_kecamatan', $id, 'kode_kecamatan')[0];
            if ($cek == null) {
                redirect('upsss');
            }
        }

        $datapage['url'] = "kecamatan";
        $datapage['title'] = "Halaman Ubah Data Kecamatan";
        $datapage['subtitle'] = "";

        $datapage['err1'] = '';
        $datapage['err2'] = '';
        $datapage['err3'] = '';
        $datapage['err4'] = '';
        $datapage['err5'] = '';
        $datapage['err6'] = '';
        $datapage['err7'] = '';
        $datapage['err8'] = '';

        if (!$_POST) {

            $datapage['datatabel'] = $this->Model2->getId('tb_kecamatan', $id, 'kode_kecamatan')[0];
            $data['menara'] = $this->load->view('kec/v_form_updatekec', $datapage, TRUE);
            $this->load->view('layout/html', $data);
        } elseif ($_POST) {
            $kode_kecamatan = $this->input->post('kode_kecamatan');
            $err1 = $this->Model2->cek_post($kode_kecamatan, 'hurang',);
            $nama_kecamatan = $this->input->post('nama_kecamatan');
            $err2 = $this->Model2->cek_post($nama_kecamatan, 'hurang');
            $jumlah_penduduk = $this->input->post('jumlah_penduduk');
            $err3 = $this->Model2->cek_post($jumlah_penduduk, 'integer');
            $laju_pertumbuhan = $this->input->post('laju_pertumbuhan');
            $laju_pertumbuhan = str_replace(',', '.', $laju_pertumbuhan);
            $err4 = $this->Model2->cek_post($laju_pertumbuhan, 'minfloat');
            $luas_wilayah = $this->input->post('luas_wilayah');
            $luas_wilayah = str_replace(',', '.', $luas_wilayah);
            $err5 = $this->Model2->cek_post($luas_wilayah, 'float');
            $sumber_data = $this->input->post('sumber_data');
            $err6 = $this->Model2->cek_post($sumber_data, 'integer');
            $teledensitas = $this->input->post('teledensitas');
            $teledensitas = str_replace(',', '.', $teledensitas);
            $err7 = $this->Model2->cek_post($teledensitas, 'minfloat');
            $ratarata_pngl = $this->input->post('ratarata_pngl');
            $ratarata_pngl = str_replace(',', '.', $ratarata_pngl);
            $err8 = $this->Model2->cek_post($ratarata_pngl, 'integer');
            $laju_pertumbuhan = str_replace(' ', '', $laju_pertumbuhan);
            $luas_wilayah = str_replace(' ', '', $luas_wilayah);
            $teledensitas = floatval($teledensitas);
            $ratarata_pngl = floatval($ratarata_pngl);
            $laju_pertumbuhan = floatval($laju_pertumbuhan);
            $luas_wilayah = floatval($luas_wilayah);

            if ($err1 === '' and $err2 === '' and $err3 === '' and $err4 === '' and $err5 === '' and $err6 === '' and $err7 === '' and $err8 === '') {
                // kepadatan
                if ($jumlah_penduduk != null and $jumlah_penduduk != 0 and $luas_wilayah != null and $luas_wilayah != 0) {
                    $kepadatan_penduduk = $jumlah_penduduk / $luas_wilayah;
                } elseif ($jumlah_penduduk == null or $jumlah_penduduk == 0 or $luas_wilayah == null or $luas_wilayah == 0) {
                    $kepadatan_penduduk = 0;
                }

                if ($kode_kecamatan != '') {
                    $data = ['nama_kecamatan' => $nama_kecamatan, 'jumlah_penduduk' => $jumlah_penduduk, 'laju_pertumbuhan' => $laju_pertumbuhan, 'luas_wilayah' => $luas_wilayah, 'kepadatan_penduduk' => $kepadatan_penduduk, 'sumber_data' => $sumber_data, 'teledensitas' => $teledensitas, 'ratarata_pngl' => $ratarata_pngl];
                    $this->Model2->update('tb_kecamatan', $kode_kecamatan, $data, 'kode_kecamatan');
                    $this->Model2->setSessionFlash('sukses', ' Berhasil ;)');
                } else {
                    $this->Model2->setSessionFlash('error', ' gagal di update !!!!!!!  :(');
                }

                redirect('kecamatan');
            } else {

                $datapage['err1'] = $err1;
                $datapage['err2'] = $err2;
                $datapage['err3'] = $err3;
                $datapage['err4'] = $err4;
                $datapage['err5'] = $err5;
                $datapage['err6'] = $err6;
                $datapage['err7'] = $err7;
                $datapage['err8'] = $err8;
                $datapage['datatabel'] = $this->Model2->getId('tb_kecamatan', $id, 'kode_kecamatan')[0];
                $data['menara'] = $this->load->view('kec/v_form_updatekec', $datapage, TRUE);
                $this->load->view('layout/html', $data);
            }
        }
    }

    public function form_geojson($id = '')
    {
        $this->cek_hak();
        if ($id === '') {
            redirect('kecamatan');
        } else {
            $cekdata = $this->Model2->getId('tb_kecamatan', $id, 'kode_kecamatan')[0];
            if ($cekdata == null) {
                redirect('kecamatan');
            }
        }

        $datapage['url'] = "kecamatan";
        $datapage['title'] = "Halaman Ubah Data Kecamatan";
        $datapage['subtitle'] = "";
        $datapage['datatabel'] = $this->Model2->getId('tb_kecamatan', $id, 'kode_kecamatan')[0];
        $data['menara'] = $this->load->view('kec/v_form_geojson', $datapage, TRUE);
        $this->load->view('layout/html', $data);
    }
    public function geojson()
    {
        $this->cek_hak();

        // var_dump($_POST);
        // die;
        if ($_POST) {
            $geojsoninput = $_FILES['geojson'];
            $kode_kecamatan = $this->input->post('kode_kecamatan');

            $cekgeojson = $this->Model2->getId('tb_kecamatan', $kode_kecamatan, 'kode_kecamatan')[0];
            if ($cekgeojson->geojson != null and $cekgeojson != null) {
                // hapus file lama sesuai name geojson di database
                unlink(FCPATH . './geo/' . $cekgeojson->geojson);
            }

            $config['upload_path']          = './geo/';
            $config['allowed_types']        = 'geojson';
            $config['max_size']             = '5000';
            $config['file_ext']             = '.geojson|.json';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('geojson')) {
                // $geojson = $this->upload->data();
                // $error= array('error' => $this->upload->display_errors() );
                // var_dump($geojson['file_type']);die;
                $this->Model2->setSessionFlash('error', ' gagal di simpan !!!!!!!  :(');
            } else {

                $geojson = $this->upload->data();
                // var_dump($geojson);die;
                $geojsoninput = $geojson['file_name'];
                $data = ['geojson' => $geojsoninput];
                $this->Model2->update('tb_kecamatan', $kode_kecamatan, $data, 'kode_kecamatan');
                $this->Model2->setSessionFlash('sukses', ' Berhasil ;)');
            }
            redirect('kecamatan');
        } else {
            redirect('upsss');
        }
    }


    public function del($id)
    {

        $this->cek_hak();
        // menghapus file
        $cekgeojson = $this->Model2->getId('tb_kecamatan', $id, 'kode_kecamatan')[0];
        // hapus file lama sesuai name geojson di database
        unlink(FCPATH . './geo/' . $cekgeojson->geojson);

        // menghapus data pada tabel
        $this->Model2->delete('tb_kecamatan', $id, 'kode_kecamatan');
        redirect('kecamatan');
    }
}
