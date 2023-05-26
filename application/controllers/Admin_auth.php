<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('model', 'Model2');
    }

    public function index()
    {

        // migrasi ke sms gateway
        if ($this->session->userdata('nipOTP')) {

            $this->form_validation->set_rules('nip', 'Nip', 'trim|required');
            $this->form_validation->set_rules('kode_otp', 'Kode_otp', 'trim|required');

            if ($this->form_validation->run() == false) {
                $data['title'] = 'Login Page';
                $this->load->view('templates/auth_header', $data);
                $this->load->view('auth/login_adm');
                $this->load->view('templates/auth_footer');
            } else {
                // validasinya success
                $this->_verifikasiOTP();
            }
        } else {

            $this->form_validation->set_rules('nip', 'Nip', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if ($this->form_validation->run() == false) {
                $data['title'] = 'Login Page';
                $this->load->view('templates/auth_header', $data);
                $this->load->view('auth/login_adm');
                $this->load->view('templates/auth_footer');
            } else {
                // validasinya success
                $this->_login();
            }
        }
        // batas migrasi

    }

    private function _verifikasiOTP()
    {
        $nip = $this->db->escape_str($this->input->post('nip'));
        $OTP_kode = $this->db->escape_str($this->input->post('kode_otp'));

        $user = $this->db->get_where('tb_pegawai', ['nip' => $nip])->row_array();

        // jika usernya ada
        if ($user) {

            // jika kode otp benar
            if ($user['token'] == $OTP_kode) {

                $databaru = [
                    'nip' => $nip,
                    'status_akun' => 1
                ];
                // ubah status akun
                $this->Model2->updateuse("tb_pegawai", $databaru);

                $this->session->unset_userdata('nipOTP');
                $this->session->unset_userdata('sesiOTP');

                redirect('admin_auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> kode otp yang anda masukkan salah</div>');
                redirect('admin_auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">nip is not registered!</div>');
            redirect('admin_auth');
        }
    }


    private function _login()
    {
        $nip = $this->db->escape_str($this->input->post('nip'));
        $password = $this->input->post('password');

        $user = $this->db->get_where('tb_pegawai', ['nip' => $nip])->row_array();

        // jika usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['status_akun'] == '1') {
                // cek password
                if (password_verify($password, $user['password'])) {

                    // ambil nama dari kode rolenya
                    $kd_rl = $this->db->get_where('tb_role', ['kode_role' => $user['kode_role']])->row_array();


                    $data = [
                        'email' => $user['nip'],
                        'tipe' => $user['kode_role'],
                        'nm_tipe' => $kd_rl['nama_role'],
                        'name' => $user['nama_pegawai']
                    ];
                    $this->session->set_userdata($data);
                    redirect('operator');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    redirect('admin_auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This nip has not been activated!</div>');
                redirect('admin_auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">nip is not registered!</div>');
            redirect('admin_auth');
        }
    }


    public function ajukanakun()
    {
        if ($this->session->userdata('nip')) {
            redirect('general');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('nip', 'Nip', 'required|trim|is_unique[tb_pegawai.nip]', [
            'is_unique' => 'This NIP has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registrasi Pegawai';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration_adm');
            $this->load->view('templates/auth_footer');
        } else {
            // migrasi sms gateway

            // siapkan nomor tujuan
            $no_tujuan = $this->input->post('no_hp', true);
            $nip = $this->input->post('nip', true);

            // siapkan token
            $OTP = $this->_setOTP(6);
            $sesiOTP = $this->_setOTPsesi(4);
            // buat pesan OTP
            $pesan = "Kode OTP Anda adalah : " . $OTP . " Pastikan SESI OTP Anda sama dengan berikut => " . $sesiOTP;


            $data = [
                'nip' => $this->db->escape_str(htmlspecialchars($nip)),
                'nama_pegawai' => $this->db->escape_str(htmlspecialchars($this->input->post('name', true))),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'kode_role' => $this->db->escape_str(htmlspecialchars($this->input->post('tipe'))),
                'alamat' => $this->db->escape_str(htmlspecialchars($this->input->post('alamat'))),
                'no_hp' => $this->db->escape_str(htmlspecialchars($this->input->post('no_hp'))),
                'status_akun' => 0,
                'token' => htmlspecialchars($OTP),
                'date_create' => time()

            ];

            $this->db->insert('tb_pegawai', $data);

            //aktifkan fitur kirim otp via sms
            $sending = $this->_sendSMS($no_tujuan, $pesan);
            if ($sending == "success") {
                $cekotp = [
                    'nipOTP' => $nip,
                    'sesiotp' => $sesiOTP
                ];
                $this->session->set_userdata($cekotp);

                redirect('admin_auth');
            } else {
                echo "OTP gagal Terkirim";
            }
        }
    }


    function _setOTP($value)
    {
        // Take a generator string which consist of
        // all numeric digits
        $generator = "1357902468";
        // mengacak kode OTP
        $result = "";
        for ($i = 1; $i <= $value; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }
        // Return result
        return $result;
    }
    function _setOTPsesi($value)
    {
        // Take a generator string which consist of
        // all numeric digits
        $generator = "1357902468";

        // Iterate for n-times and pick a single character
        // from generator and append it to $result

        // Login for generating a random character from generator
        //     ---generate a random number
        //     ---take modulus of same with length of generator (say i)
        //     ---append the character at place (i) from generator to result
        $result = "";
        for ($i = 1; $i <= $value; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }
        // Return result
        return $result;
    }

    function _sendSMS($no_tujuan, $pesan)
    {
        $id_mesin = "1119";
        $pin = "023347";

        // jika ada spasi pada pesan ganti dengan %20
        $pesan = str_replace(" ", "%20", $pesan);

        // persiapkan CURL
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "https://sms.indositus.com/sendsms.php?idmesin=$id_mesin&pin=$pin&to=$no_tujuan&text=$pesan");

        // aktifkan fungsi transfer nilai yang berupa string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // setting agar dapat dijalankan pada loocallhost
        // mematikan SSL verify (https)
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        // tampung hasil ke dalam variabel output
        $output = curl_exec($ch);

        // tutup CURL
        curl_close($ch);

        // mengembalikan hasil curl
        return $output;
    }


    public function logout()
    {
        $this->session->unset_userdata('nip');
        $this->session->unset_userdata('tipe');
        $this->session->unset_userdata('nm_tipe');
        $this->session->unset_userdata('name');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('admin_auth');
    }


    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    public function resetPassword()
    {
        $nip = $this->db->escape_str($this->input->get('nip'));
        $token = $this->db->escape_str($this->input->get('token'));

        $user = $this->db->get_where('tb_pegawai', ['nip' => $nip])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('tb_pegawai', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_nip', $nip);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong token.</div>');
                redirect('admin_auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong nip.</div>');
            redirect('admin_auth');
        }
    }


    public function changePassword()
    {
        if (!$this->session->userdata('reset_nip')) {
            redirect('admin_auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password_adm');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $nip = $this->session->userdata('reset_nip');

            $this->db->set('password', $password);
            $this->db->where('nip', $nip);
            $this->db->update('tb_pegawai');

            $this->session->unset_userdata('reset_nip');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login.</div>');
            redirect('admin_auth');
        }
    }
}
