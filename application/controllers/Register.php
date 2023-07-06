<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mydb');
        $this->load->model('post_model', 'post');
        $this->load->model('kegiatan_model', 'kegiatan');
    }
    public function index()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required|trim|alpha_numeric_spaces', [
            'required' => 'Nama Tidak boleh dikosongkan !!',
        ]);
        $this->form_validation->set_rules('alamat', 'alamat', 'required|trim', [
            'required' => 'Bagian ini tidak boleh dikosongkan !!'
        ]);
        $this->form_validation->set_rules('asal_sekolah', 'asal_sekolah', 'trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim', [
            'required' => 'Email tidak boleh dikosongkan !!'
        ]);
        $this->form_validation->set_rules('telp', 'telp', 'required|trim|numeric', [
            'required' => 'Bagian ini tidak boleh dikosongkan !!'
        ]);

        if ($this->form_validation->run() == false) {
            $kegiatan = $this->kegiatan->kegiatan_umum();
            $this->load->view('front/template/main', [
                'title'    => 'Registrasi',
                'kegiatan' => $kegiatan,
                'file'     => 'register/index',
            ]);
        } else {
            $this->load->helper('string');
            $email = post_aman('email');
            $nama = strtoupper(post_aman('nama'));
            //BUAT TOKEN
            $token = random_string('alnum', 15);

            $this->load->library('encryption');
            $this->encryption->initialize(array(
                'cipher' => 'aes-256',
                'mode' => 'ctr',
                'key' => 'Km4xnvbmLsMTIqfK4CrgnHEzNVogONMB'
            ));
            $ciphertext = $this->encryption->encrypt($token);
            $token =  str_replace('=', '', base64_encode($ciphertext));

            //INPUT PESERTA
            $cek_peserta = $this->db->get_where('t_peserta', ['nama' => $nama, 'email' => $email]);
            if ($cek_peserta->num_rows() < 1) {
                $d12 = date('y');
                $d34 = date('m');
                $dakhir = $this->db->query('SELECT max(id+1) as jml FROM t_peserta')->row_array()['jml'];
                $id_peserta = 'PS.' . $d12 . '.' . $d34 . '.' . $dakhir;
                $kolom = [
                    'id_peserta' => $id_peserta,
                    'email'     => $email,
                    'token'     => $token,
                    'nama'      => $nama,
                    'asal_sekolah' => post_aman('asal_sekolah'),
                    'alamat'    => post_aman('alamat'),
                    'telp'      => post_aman('telp')
                ];
                $this->mydb->input_dt($kolom, 't_peserta');
            } else {
                $id_peserta = $cek_peserta->row_array()['id_peserta'];
                $token = $cek_peserta->row_array()['token'];
            }

            $no_kg = post_gan('no_kg'); //NPM
            $ttl = count($no_kg);
            $text = '';
            for ($i = 0; $i < $ttl; $i++) {
                $token2 = random_string('alnum', 50);
                $cek_absen = $this->db->get_where('t_absen', ['no_id' => $id_peserta, 'no_kegiatan' => $no_kg[$i]]);
                $nama_kegiatan = $this->db->get_where('t_kegiatan', ['no_kegiatan' => $no_kg[$i]])->row_array()['nama_kegiatan'];
                if ($cek_absen->num_rows() > 0) {
                    $text .= 'Anda sudah terdaftar pada kegiatan ' . $nama_kegiatan . '<br>';
                } else {
                    $data2 = array(
                        'no_kegiatan' => $no_kg[$i],
                        'mhs_unma'  => '0',
                        'no_id'     => $id_peserta,
                        'status'    => 'Belum Hadir',
                        'sebagai'   => 'Peserta',
                        'token_presensi' => $token2
                    );
                    // echo json_encode($data2, true);
                    $this->mydb->input_dt($data2, 't_absen');
                    $text .= 'Anda berhasil terdaftar pada kegiatan ' . $nama_kegiatan . '<br>';
                }
            }

            $token_presensi = $this->db->select('token_presensi,nama_kegiatan')
                ->from('t_absen a')->join('t_kegiatan b', 'a.no_kegiatan=b.no_kegiatan')
                ->where('no_id', $id_peserta)->get();
            $data_link = '';
            foreach ($token_presensi->result_array() as $row) {
                // $data_link .= '<a href="' . base_url() . 'Presensi/online/' . $row['token_presensi'] . '">Presensi Kegiatan '.$row['nama_kegiatan'].'</a><br>';
                $data_link .= 'Presensi Kegiatan ' . $row['nama_kegiatan'] . ' : ' . base_url() . 'Presensi/online/' . $row['token_presensi'] . ' ';
            }

            $this->_setEmail($token, $email, $data_link);

            // $this->_sendEmail($token, $email, $data_link);

            //NOTIFIKASI
            $this->session->set_flashdata('message', '<div class="alert-box alert-box--success hideit"> <p>' . $text . '</p><i class="fa fa-times alert-box__close"></i></div>');
            redirect(base_url('informasi/' . $token));
        }
    }
    //CONFIGURASI EMAIL
    private function _setEmail($token, $email_penerima, $data_link)
    {
        $email_saya = 'hima@unma.ac.id';
        $password_email = '********';
        $this->load->library('encryption');
        $config = [
            'protocol' => 'smtp',
            // 'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => $email_saya,
            'smtp_pass' => $password_email,
            'smtp_port' => '465',
            'smtp_crypto' => 'ssl',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->from($email_saya, 'HIMA UNMA');
        $this->email->to($email_penerima);
        $this->email->subject('INFO PESERTA');
        $this->email->message(' Berikut adalah link untuk : 
        Informasi Anda : ' . base_url() . 'HM/info/' . urlencode($token) . ' ' . $data_link . ' ');

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
    //INFO PESERTA
    public function info($token)
    {
        // $token = str_replace(' ', '+', $_GET['id']);
        if ($token == null) {
            $text = 'Data Peserta tidak ditemukan!!!';
            $this->session->set_flashdata('message', '<div class="alert-box alert-box--success hideit"> <p>' . $text . '</p><i class="fa fa-times alert-box__close"></i></div>');
            redirect(base_url('Register'));
        }
        $query = $this->db->get_where('t_peserta', ['token' => $token]);
        if ($query->num_rows() < 1) {
            $text = 'Data Peserta tidak ditemukan!!!';
            $this->session->set_flashdata('message', '<div class="alert-box alert-box--error hideit"> <p>' . $text . '</p><i class="fa fa-times alert-box__close"></i></div>');
            redirect('Register');
        } else {
            $qrcode = $this->mydb->create_qrcode($query->row_array()['id_peserta']);
        }

        $peserta = $query->row_array();

        $this->load->view('front/template/main', [
            'title' => 'Informasi Peserta',
            'col'   => $peserta,
            'qrcode' => $qrcode,
            'file'  => 'register/info_peserta',
        ]);
    }
}
