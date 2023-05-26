<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model', 'Model2');
        // inisialisasi halaman, mohon disesuaikan
        $page = 'role';

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
        // inisialisasi hak
        $datapage['hak'] = "manage";
        // cek hak akses for panel kelola data
        $kode_role = $this->session->userdata('tipe');
        $beranda = $this->Model2->wereAND('tb_access', 'kode_role', 'akses', $kode_role, 'role')->row_array();
        if ($beranda['hak'] != 'manage') {
            $datapage['hak'] = "view";
        }

        $datapage['role'] = "";
        $datapage['role_err'] = "";
        $datapage['url'] = "role";
        $datapage['title'] = "";
        $datapage['subtitle'] = "";
        $datapage['datatabel'] = $this->Model2->get('tb_role');
        $datapage['datatabel1'] = $this->Model2->get('tb_access');

        if ($_POST) {
            $nama_role = $this->input->post('nama_role');
            $nama_err = $this->Model2->cek_text($nama_role, 'OK');
            if ($nama_err == '') {
                if ($nama_role != null and $nama_role != '') {
                    $this->simpan($nama_role);
                }
                redirect('role');
            } else {
                // inisialisasi hak
                $datapage['role'] = $nama_role;
                $datapage['role_err'] = $nama_err;
                $data['menara'] = $this->load->view('role/v_role', $datapage, TRUE);
                $this->load->view('layout/html', $data);
            }
        } else {
            $data['menara'] = $this->load->view('role/v_role', $datapage, TRUE);
            $this->load->view('layout/html', $data);
        }
    }
    public function simpan($nama_role = '')
    {
        // cek hak akses
        $kode_role = $this->session->userdata('tipe');
        $beranda = $this->Model2->wereAND('tb_access', 'kode_role', 'akses', $kode_role, 'role')->row_array();
        if ($beranda['hak'] != 'manage') {
            redirect('role');
        }
        // cek jika ada input paksaan (null) melalui tab url
        if ($nama_role == '') {
            redirect('role');
        }
        // cek jika ada input paksaan (valued) melalui tab url
        $nama_r = $nama_role;
        $nama_err = $this->Model2->cek_text($nama_r, 'OK');

        if ($nama_err == '') {
            if ($nama_role != null and $nama_role != '') {
                $data = ['nama_role' => $nama_role];
                $this->Model2->add('tb_role', $data);
                // var_dump($nama_err);
                // die;
            }
            redirect('role');
        } else {
            redirect('role');
        }
    }
    public function form_ubah($id = '')
    {
        // cek hak akses
        $kode_role = $this->session->userdata('tipe');
        $beranda = $this->Model2->wereAND('tb_access', 'kode_role', 'akses', $kode_role, 'role')->row_array();
        if ($beranda['hak'] != 'manage') {
            redirect('role');
        }
        // cek jika ada input paksaan (null) melalui tab url
        if ($id == '') {
            redirect('role');
        }
        // cek jika ada input paksaan (valued) melalui tab url
        $ada_err = $this->Model2->cek_text($id, '', 'OK');
        if ($ada_err == '') {
            $datapage['url'] = "role";
            $datapage['title'] = "";
            $datapage['subtitle'] = "";
            $datapage['datatabel'] = $this->Model2->getId('tb_role', $id, 'kode_role')[0];
            $datapage['datatabel1'] = $this->Model2->getId('tb_access', $id, 'kode_role');
            // var_dump($datapage['datatabel1']);
            // die;
            if ($datapage['datatabel'] == null and $datapage['datatabel1'] == null) {
                redirect('role');
            } else {
                $data['menara'] = $this->load->view('role/v_ubah', $datapage, TRUE);
                $this->load->view('layout/html', $data);
            }
        } else {
            redirect('role');
        }
    }
    public function add_acc($id = '')
    {
        // cek hak akses
        $kode_role = $this->session->userdata('tipe');
        $beranda = $this->Model2->wereAND('tb_access', 'kode_role', 'akses', $kode_role, 'role')->row_array();
        if ($beranda['hak'] != 'manage') {
            redirect('role');
        }

        // cek jika ada input paksaan (null) melalui tab url
        if ($id == '') {
            redirect('role');
        }
        // cek jika ada input paksaan (valued) melalui tab url
        $ada_err = $this->Model2->cek_text($id, '', 'OK');
        if ($ada_err == '') {
            $nama = $this->input->post('akses');
            $hak = $this->input->post('hak');
            $same = FALSE;
            $cek_available = $this->Model2->getId('tb_access', $id, 'kode_role');
            $datapage['datatabel'] = $this->Model2->getId('tb_role', $id, 'kode_role');
            // var_dump($datapage['datatabel']);
            // die;
            if ($datapage['datatabel'] != null and $datapage['datatabel'] != '' and $nama != null and $hak != null) {
                foreach ($cek_available as $key) {
                    if ($key->akses == $nama) {
                        $same = TRUE;
                    }
                }
                if ($same == FALSE) {
                    $data = ['kode_role' => $id, 'akses' => $nama, 'hak' => $hak];
                    $this->Model2->add('tb_access', $data);
                }
                redirect('role/form_ubah/' . $id);
            } else {
                redirect('role');
            }
        } else {
            redirect('role');
        }
    }
    public function del_acc()
    {
        // cek hak akses
        $kode_role = $this->session->userdata('tipe');
        $beranda = $this->Model2->wereAND('tb_access', 'kode_role', 'akses', $kode_role, 'role')->row_array();
        if ($beranda['hak'] != 'manage') {
            redirect('role');
        }

        $id = $this->input->get('role', TRUE);
        $id_access = $this->input->get('acc', TRUE);

        $this->Model2->delete('tb_access', $id_access, 'kode_access');
        redirect('role/form_ubah/' . $id);
    }
    public function del($kode_role = '')
    {
        // cek hak akses
        $rroll = $this->session->userdata('tipe');
        $beranda = $this->Model2->wereAND('tb_access', 'kode_role', 'akses', $rroll, 'role')->row_array();
        if ($beranda['hak'] != 'manage') {
            redirect('role');
        }
        // cek jika ada input paksaan (null) melalui tab url
        if ($kode_role == '') {
            redirect('role');
        }
        // cek jika ada input paksaan (valued) melalui tab url
        $ada_err = $this->Model2->cek_text($kode_role, '', 'OK');
        if ($ada_err == '') {
            $datapage['datatabel'] = $this->Model2->getId('tb_role', $kode_role, 'kode_role');
            if ($datapage['datatabel'] != null and $datapage['datatabel'] != '') {
                $this->Model2->delete('tb_access', $kode_role, 'kode_role');
                $this->Model2->delete('tb_role', $kode_role, 'kode_role');
                $data = ['kode_role' => ''];
                $this->Model2->update('tb_pegawai', $kode_role, $data, 'kode_role');
                redirect('role');
            }
        }
        redirect('role');
    }
}
