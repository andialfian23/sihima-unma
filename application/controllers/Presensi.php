<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Presensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mydb');
        $this->load->model('absen_model', 'absen');
        $this->load->model('kegiatan_model', 'kegiatan');
    }
    public function index()
    {
        notifikasi('Himpunan tidak ditemukan !!!', false);
        redirect(base_url('HM/block'));
    }
    public function online($token = null)
    {
        if ($token == null) {
            notifikasi('Himpunan tidak ditemukan !!!', false);
            redirect(base_url('HM/block'));
        }

        $this->load->view('presensi/index', [
            'title'     => 'PRESENSI',
            'token'     => $token,
            'presensi'  => $this->absen->presensi($token),
        ]);
    }
    public function proses_presensi()
    {
        $cek_token = $this->absen->presensi($_POST['token_presensi']);
        if ($cek_token['num_rows'] > 0) {  //cek token
            $row = $cek_token['result'];
            if ($row['status'] == 'Belum Hadir') {  //cek sudah presensi belum
                $mulai   = strtotime($row['mulai_absensi']);
                $selesai = strtotime($row['selesai_absensi']);
                $waktu_sekarang = strtotime(date("Y-m-d H:i:s"));
                if (($waktu_sekarang >= $mulai) && ($waktu_sekarang <= $selesai)) { //cek waktu presensi
                    $data      = base64_decode(str_replace('data:image/png;base64,', '', $_POST['ttd']));
                    $nama_file = './images/ttd/' . uniqid() . '.png';
                    $success   = file_put_contents($nama_file, $data);
                    if ($success) { //cek keberhasilan input ttd
                        $image = str_replace('./', '', $nama_file);
                        $where = ['token_presensi' => $row['token_presensi']];
                        $set   = ['status' => 'Hadir', 'signature' => $image];
                        $this->mydb->update_dt($where, $set, 't_absen');
                        $response = 'Presensi Berhasil';
                    } else {
                        $response = 'Presensi Gagal';
                    }
                } else {
                    if ($waktu_sekarang < $mulai) {
                        $response = 'Waktu presensi belum dimulai';
                    } else {
                        $response = 'Waktu presensi sudah selesai';
                    }
                }
            } else {
                $response = 'Anda sudah melakukan proses presensi';
            }
        } else {
            $response = 'Token tidak ter-identifikasi';
        }
        echo $response;
    }
    public function cek_presensi()
    {
        $no_kg        = $_POST['no_kg'];
        $no_id        = $_POST['no_id'];
        $response = [];
        if (($no_id != null) && ($no_kg != null)) {
            $cek_kegiatan = $this->db->get_where('t_kegiatan', ['no_kegiatan' => $no_kg]);
            if ($cek_kegiatan->num_rows() > 0) {
                $kg = $cek_kegiatan->row_array();
                $now = time();
                $mulai = strtotime($kg['mulai_absensi']);
                $selesai = strtotime($kg['selesai_absensi']);
                if (($now >= $mulai) && ($now <= $selesai)) {
                    $presensi = $this->db->get_where(
                        't_absen',
                        [
                            'no_kegiatan' => $no_kg,
                            'no_id' => $no_id,
                            'sebagai' => 'Peserta'
                        ]
                    );
                    if ($presensi->num_rows() > 0) {
                        $data = $presensi->row_array();
                        if ($data['status'] != 'Hadir') {
                            $response = [
                                'status' => '1',
                                'message' => base_url() . 'Presensi/online/' . $data['token_presensi']
                            ];
                        } else {
                            $response = [
                                'status' => '0',
                                'message' => 'Anda sudah melakukan presensi'
                            ];
                        }
                    } else {
                        $response = [
                            'status' => '0',
                            'message' => 'Anda tidak terdaftar sebagai peserta'
                        ];
                    }
                } else {
                    $response = [
                        'status' => '0',
                        'message' => 'Waktu Presensi Belum Dimulai'
                    ];
                }
            } else {
                $response = [
                    'status' => '0',
                    'message' => 'Data kegiatan tidak ditemukan'
                ];
            }
        } else {
            $response = [
                'status' => '0',
                'message' => 'Maaf, sistem tidak dapat melanjutkan permintaan anda!!!'
            ];
        }
        print_r(json_encode($response));
    }
    public function add_presensi()
    {
        $no_kg        = $_POST['no_kg'];
        $id_peserta   = $_SESSION['id_mahasiswa_pt'];
        if ((!empty($id_peserta)) && ($no_kg != null)) {
            $token2 = random_string('alnum', 50);
            $cek_absen      = $this->db->get_where('t_absen', ['no_id' => $id_peserta, 'no_kegiatan' => $no_kg]);
            $nama_kegiatan = $this->db->get_where('t_kegiatan', ['no_kegiatan' => $no_kg])->row_array()['nama_kegiatan'];
            if ($cek_absen->num_rows() > 0) {
                echo 'Anda sudah terdaftar pada kegiatan ' . $nama_kegiatan . '<br>';
            } else {
                $data2 = array(
                    'no_kegiatan' => $no_kg,
                    'mhs_unma' => '1',
                    'no_id' => $id_peserta,
                    'status' => 'Belum Hadir',
                    'sebagai' => 'Peserta',
                    'token_presensi' => $token2
                );
                // echo json_encode($data2, true);
                $this->mydb->input_dt($data2, 't_absen');
                echo 'Anda berhasil terdaftar pada kegiatan ' . $nama_kegiatan;
            }
        } else {
            echo 'Maaf, sistem tidak dapat melanjutkan permintaan anda!!!';
        }
    }
}
