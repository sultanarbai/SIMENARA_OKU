<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model', 'Model2');
        // inisialisasi halaman, mohon disesuaikan
        $page = 'pegawai';

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
            redirect('pegawai');
        }
    }
    public function index()
    {
        // inisialisasi hak
        $datapage['hak'] = "manage";
        // cek hak akses for panel kelola data
        $kode_role = $this->session->userdata('tipe');
        $beranda = $this->Model2->wereAND('tb_access', 'kode_role', 'akses', $kode_role, 'pegawai')->row_array();
        if ($beranda['hak'] != 'manage') {
            $datapage['hak'] = "view";
        }

        $datapage['url'] = "pegawai";
        $datapage['title'] = "";
        $datapage['subtitle'] = "";
        $datapage['datatabel'] = $this->Model2->get('tb_pegawai');
        $data['menara'] = $this->load->view('pegawai/v_pegawai', $datapage, TRUE);
        $this->load->view('layout/html', $data);
    }
    public function form_tambah()
    {
        $this->cek_hak();

        $datapage['nip'] = '';
        $datapage['nip_err'] = '';
        $datapage['nama'] = '';
        $datapage['nama_err'] = '';
        $datapage['no_hp'] = '';
        $datapage['nohp_err'] = '';
        $datapage['alamat'] = '';

        $datapage['url'] = "pegawai";
        $datapage['title'] = "";
        $datapage['subtitle'] = "";
        $datapage['datatabel4'] = $this->Model2->get('tb_role');

        $this->simpan();
    }
    public function simpan()
    {
        $this->cek_hak();

        // ambil data yg dipost
        // cek_text($post, 'huruf', 'angka','spesial1','spesial2','spesial3')
        $nip = $this->input->post('nip');
        $nip_err = $this->Model2->cek_text($nip, '', 'OK');
        $nama = $this->input->post('nama_pegawai');
        $nama_err = $this->Model2->cek_text($nama, 'OK');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $no_hp = $this->input->post('no_hp');
        $nohp_err = $this->Model2->cek_text($no_hp, '', 'OK');
        $kode_role = $this->input->post('kode_role');
        $alamat = $this->db->escape_str($this->input->post('alamat'));
        $status_akun = $this->db->escape_str($this->input->post('status'));
        // form validasi
        $this->form_validation->set_rules('nip', 'Nip', 'is_unique[tb_pegawai.nip]|required', array('is_unique' => '%s telah terdaftar'));
        $this->form_validation->run();
        if ($nip_err == '' and $nama_err == '' and $nohp_err == '' and $this->form_validation->run() != false) {
            $data = ['nip' => $nip, 'nama_pegawai' => $nama, 'password' => $password, 'no_hp' => $no_hp, 'kode_role' => $kode_role, 'alamat' => $alamat, 'status_akun' => $status_akun];
            $this->Model2->add('tb_pegawai', $data);
            $this->Model2->setSessionFlash('sukses', ' Berhasil Disimpan .....  ;)');
            redirect('pegawai/form_tambah');
        } else {
            $datapage['nip'] = $nip;
            $datapage['nip_err'] = $nip_err;
            $datapage['nama'] = $nama;
            $datapage['nama_err'] = $nama_err;
            $datapage['no_hp'] = $no_hp;
            $datapage['nohp_err'] = $nohp_err;
            $datapage['alamat'] = $alamat;

            $datapage['url'] = "pegawai";
            $datapage['title'] = "";
            $datapage['subtitle'] = "";
            $datapage['datatabel4'] = $this->Model2->get('tb_role');

            $data['menara'] = $this->load->view('pegawai/v_tambah', $datapage, TRUE);
            $this->load->view('layout/html', $data);
        }
    }
    public function form_ubah($id = '')
    {
        $this->cek_hak();

        $datapage['nip_err'] = '';
        $datapage['nama_err'] = '';
        $datapage['nohp_err'] = '';

        $datapage['url'] = "pegawai";
        $datapage['title'] = "";
        $datapage['subtitle'] = "";
        $datapage['datatabel4'] = $this->Model2->get('tb_role');
        $datapage['datatabel'] = $this->Model2->getId('tb_pegawai', $id, 'nip')[0];

        // form validasi jika nip sama dengan nip lama maka tidak mengalami pengecekan unique
        if ($datapage['datatabel']->nip == $this->input->post('nip')) {
            $this->ubah($id);
        }
        // berarti mengalami perubahan wajib di cek keunikannya
        else {
            $this->form_validation->set_rules('nip', 'Nip', 'is_unique[tb_pegawai.nip]|required');
            if ($this->form_validation->run() == false) {
                $data['menara'] = $this->load->view('pegawai/v_ubah', $datapage, TRUE);
                $this->load->view('layout/html', $data);
            } else {
                $this->ubah($id);
            }
        }
    }
    public function ubah($id = '')
    {
        $this->cek_hak();

        // ambil data yg dipost
        $nip_old = $this->input->post('abcdefghijklmnopqrstuvwxyzz');
        $pass_old = $this->input->post('abcdefghijklmnopqrstuvwxyz');
        $nip = $this->input->post('nip');
        $nip_err = $this->Model2->cek_text($nip, '', 'OK');
        $nama = $this->input->post('nama_pegawai');
        $nama_err = $this->Model2->cek_text($nama, 'OK');
        $no_hp = $this->input->post('no_hp');
        $nohp_err = $this->Model2->cek_text($no_hp, '', 'OK');
        $kode_role = $this->db->escape_str($this->input->post('kode_role'));
        $alamat = $this->db->escape_str($this->input->post('alamat'));
        $status_akun = $this->db->escape_str($this->input->post('status'));
        if ($nip_err == '' and $nama_err == '' and $nohp_err == '' and $nip_old != null) {
            // jika pass diubah
            if ($this->input->post('password') != null) {
                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                $password_cek = $this->input->post('password1');
                if (password_verify($password_cek, $pass_old)) {
                    if ($nip != '') {
                        $data = ['nip' => $nip, 'nama_pegawai' => $nama, 'password' => $password, 'no_hp' => $no_hp, 'kode_role' => $kode_role, 'alamat' => $alamat, 'status_akun' => $status_akun];
                        $this->Model2->update('tb_pegawai', $nip_old, $data, 'nip');
                        $this->Model2->setSessionFlash('sukses', ' Berhasil ;)');
                    } else {
                        $this->Model2->setSessionFlash('error', ' gagal di simpan !!!!!!!  :(');
                    }
                } else {
                    $this->Model2->setSessionFlash('error', ' Password Lama Anda Salah !!!!!!!  :(');
                }
            }
            // pass tidak diubah  
            else {
                if ($nip != '') {
                    $data = ['nip' => $nip, 'nama_pegawai' => $nama, 'no_hp' => $no_hp, 'kode_role' => $kode_role, 'alamat' => $alamat, 'status_akun' => $status_akun];
                    $this->Model2->update('tb_pegawai', $nip_old, $data, 'nip');
                    $this->Model2->setSessionFlash('sukses', ' Berhasil ;)');
                }
            }
            redirect('pegawai');
        } else {
            if (!$_POST) {
                redirect('pegawai');
            }
            $datapage['nip_err'] = $nip_err;
            $datapage['nama_err'] = $nama_err;
            $datapage['nohp_err'] = $nohp_err;

            $datapage['url'] = "pegawai";
            $datapage['title'] = "";
            $datapage['subtitle'] = "";
            $datapage['datatabel4'] = $this->Model2->get('tb_role');
            $datapage['datatabel'] = $this->Model2->getId('tb_pegawai', $id, 'nip')[0];
            $data['menara'] = $this->load->view('pegawai/v_ubah', $datapage, TRUE);
            $this->load->view('layout/html', $data);
        }
    }
    public function del($id = '')
    {
        $this->cek_hak();

        $cek = $this->Model2->cek_text($id, '', 'OK');

        if ($cek == '') {
            $this->Model2->delete('tb_pegawai', $id, 'nip');
        }

        redirect('pegawai');
    }
}
