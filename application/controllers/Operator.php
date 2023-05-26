<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operator extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model', 'Model2');
        // inisialisasi halaman, mohon disesuaikan
        $page = 'beranda';

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

    public function index()
    {
        $now = date('Y');
        $datapage['tot_menara'] = $this->Model2->cek_row_where('tb_menara', $now, 'sumber_data');
        $datapage['tot_provider'] = $this->Model2->cek_row('tb_provider');
        $datapage['users'] = $this->Model2->cek_row('tb_pegawai');
        $datapage['zona'] = $this->Model2->cek_row('tb_zona');
        $datapage['eksisting'] = $this->Model2->cek_row_where('tb_zona', 'eksisting', 'status');
        $datapage['new'] = $this->Model2->cek_row_where('tb_zona', 'new', 'status');

        $datapage['bt'] = $this->Model2->cek_row_where_and('tb_menara', 'BTRT', $now, 'kode_kecamatan', 'sumber_data');
        $datapage['bb'] = $this->Model2->cek_row_where_and('tb_menara', 'BTRB', $now, 'kode_kecamatan', 'sumber_data');
        $datapage['sp'] = $this->Model2->cek_row_where_and('tb_menara', 'SPNJ', $now, 'kode_kecamatan', 'sumber_data');
        $datapage['uo'] = $this->Model2->cek_row_where_and('tb_menara', 'ULOG', $now, 'kode_kecamatan', 'sumber_data');
        $datapage['sbr'] = $this->Model2->cek_row_where_and('tb_menara', 'SSBR', $now, 'kode_kecamatan', 'sumber_data');
        $datapage['penga'] = $this->Model2->cek_row_where_and('tb_menara', 'PNGD', $now, 'kode_kecamatan', 'sumber_data');
        $datapage['mj'] = $this->Model2->cek_row_where_and('tb_menara', 'MRJY', $now, 'kode_kecamatan', 'sumber_data');
        $datapage['sa'] = $this->Model2->cek_row_where_and('tb_menara', 'SMDA', $now, 'kode_kecamatan', 'sumber_data');
        $datapage['l'] = $this->Model2->cek_row_where_and('tb_menara', 'LGKT', $now, 'kode_kecamatan', 'sumber_data');
        $datapage['lr'] = $this->Model2->cek_row_where_and('tb_menara', 'LBRJ', $now, 'kode_kecamatan', 'sumber_data');
        $datapage['peni'] = $this->Model2->cek_row_where_and('tb_menara', 'PNNJ', $now, 'kode_kecamatan', 'sumber_data');
        $datapage['lb'] = $this->Model2->cek_row_where_and('tb_menara', 'LBBT', $now, 'kode_kecamatan', 'sumber_data');
        $datapage['kpr'] = $this->Model2->cek_row_where_and('tb_menara', 'KPNR', $now, 'kode_kecamatan', 'sumber_data');

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


        $datapage['url'] = "operator";
        $datapage['year'] = $now;
        $datapage['subtitle'] = "";
        $data['menara'] = $this->load->view('home/v_home_operator', $datapage, TRUE);
        $data['title'] = "Selamat Datang di SimenaraOKU";
        $this->load->view('layout/html', $data);
    }
}
