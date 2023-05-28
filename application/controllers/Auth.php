<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('encryption');
        $this->load->model('Hima_model', 'hima_model');
        $this->load->model('MJ_model', 'mj_model');
    }

    public function index()
    {
        if ($this->session->userdata('id_mhs')) {
            redirect(base_url("Dashboard"));
        }
        // if (isset($_SESSION['logged_in'])) {
        //     redirect(base_url('Dashboard'));
        // }

        //-- LOCAL OTP--//
        $data['otp'] = '914';
        $data['title'] = "Login Page";
        $this->load->view('login', $data);
        //--END LOCAL OTP--//


        // $this->load->view('401.php');
    }

    function verify_v2($id = NULL)
    {
        if ($id == NULL) {
            redirect(base_url('auth'));
        }

        $this->encryption->initialize(array(
            'cipher' => 'aes-256',
            'mode' => 'ctr',
            'key' => '4CrgnHEzNVogONMBKm4xnvbmLsMTIqfK'
        ));

        $plain_text = NULL;
        $plain_text = $this->encryption->decrypt(base64_decode($id));
        // print_r($plain_text);
        // die;

        if ($plain_text == NULL) {
            $this->result(0, $plain_text);
        } else {
            $this->result(1, $plain_text);
        }
    }

    private function result($result, $plain_text)
    {
        $data = explode('#', $plain_text);
        //REDESIGN ORDER
        //[0] = TIME     | 2023-05-28 13:41:03
        //[1] = USERNAME | 180137
        //[2] = ID_LEVEL | 105   
        //[3] = APP_LEVEL   | 1
        //[4] = SRC_DETAIL  | 2
        if ($result == 0) {
            //GAGAL
            // $location = 'https://satu.unma.ac.id';
            $location   = base_url('auth');
        } else {
            $_SESSION['logged_in']  = TRUE;
            $_SESSION['id_app']     = 2; //PRECONFIGURED
            $_SESSION['username']   = $data[1]; //ID_MHS / ID_DOSEN  180137 / 201
            $_SESSION['id_level']   = $data[2]; //ID_LEVEL  105 / 106
            $_SESSION['app_level']  = $data[3]; //APP_LEVEL  1 / 2
            $_SESSION['src_detail'] = $data[4]; //SRC_DETAIL 

            // //generate token
            $_SESSION['level_name'] = json_decode($this->curl->simple_get(ADD_API . 'ref/level?id_level=' . $data[2]))[0]->level_name;

            //GET USER DATA
            $user_data = json_decode($this->curl->simple_get(ADD_API . 'simak/detail_user/' . $_SESSION['username'] . '/' . $_SESSION['src_detail']))[0];
            $_SESSION['id_user']    = $user_data->id_user;      //NPM : 18.14.1.0001
            $_SESSION['nama_user']  = $user_data->nama_user;  //Nama : ANDI ALFIAN

            $detail = json_decode($this->curl->simple_get(ADD_API . 'simak/detail_login?id_level=' . $_SESSION['id_level']))[0];
            $_SESSION['kode_prodi']  = $detail->kode_prodi;   //14
            $_SESSION['nama_prodi']  = $detail->nama_prodi;
            $_SESSION['kode_fak']    = $detail->kode_fak;
            $_SESSION['nama_fak']    = $detail->nama_fak;

            $app_level = $_SESSION['app_level'];

            if ($app_level == '1') {
                $mhs = json_decode($this->curl->simple_get(ADD_API . 'simak/mahasiswa_pt?id_mahasiswa_pt=' . $_SESSION['id_user']))[0];
                $_SESSION['kode_prodi']  = $mhs->kode_prodi;
                $_SESSION['nama_prodi']  = $mhs->nama_prodi;
                $_SESSION['kode_fak']    = $mhs->kode_fak;       //Informatika
                $_SESSION['nama_fak']    = $mhs->nama_fak;       //FAKULTAS TEKNIK
                $_SESSION['nama']       = $mhs->nm_pd;
                $_SESSION['npm']        = $mhs->id_mahasiswa_pt;
                $_SESSION['id_mahasiswa_pt'] = $mhs->id_mahasiswa_pt;
            }

            //SESSION HIMA
            $hima = $this->hima_model->hima($_SESSION['kode_prodi']);
            $mj   = $this->mj_model->get_mj_aktif($hima['id_hima']);
            $_SESSION['hima_id']    = $hima['id_hima'];
            $_SESSION['singkatan']  = $hima['singkatan'];
            $_SESSION['nama_hima']  = $hima['nama_hima'];

            if ($app_level == '1') {    // APP_LEVEL 1 = MAHASISWA
                $query = "SELECT a.id_mj as id_mj, concat(b.periode1, '/',b.periode2) as periode, jabatan, level 
                    FROM t_pengurus a, t_masa_jabatan b, t_jabatan c
                    WHERE a.id_mj = b.id_mj 
                    AND a.id_jabatan = c.id_jabatan 
                    AND id_mahasiswa_pt='" . $mhs->id_mahasiswa_pt . "' ";
                //CEK PENGURUS YANG MENJABAT SEKARANG
                $cek_pengurus = $this->db->query($query . ' AND a.id_mj="' . $mj['id_mj'] . '"');
                if ($cek_pengurus->num_rows() > 0) {
                    //PENGURUS = MAHASISWA YANG SEDANG MENJABAT
                    $pengurus = $cek_pengurus->row_array();
                    $id_mj   = $pengurus['id_mj'];
                    $periode = $pengurus['periode'];
                    $role_id = $pengurus['level'];
                    $jabatan = $pengurus['jabatan'];
                } else {
                    $cek_demis = $this->db->query($query);
                    if ($cek_demis->num_rows() > 0) {
                        //DEMISIONER = MAHASISWA YANG PERNAH MENJABAT JADI PENGURUS
                        $demis   = $this->db->query($query . " ORDER BY periode1 DESC ")->row_array();
                        $id_mj   = $demis['id_mj'];
                        $periode = $demis['periode'];
                        $role_id = '7';
                        $jabatan = 'Demisioner';
                    } else {
                        //ANGGOTA = MAHASISWA YANG BUKAN ANGGOTA PENGURUS
                        $id_mj = $mj['id_mj'];
                        $periode = $mj['periode'];
                        $role_id = '8';
                        $jabatan = 'Anggota';
                    }
                }

                //ADMIN 
                if ($this->mydb->get_admin($_SESSION['id_mahasiswa_pt'])->num_rows() > 0) {
                    $role_id = '1';
                }

                $data2 = [
                    'id_mj' => $id_mj,
                    'per_jabatan' => $periode,
                    'role_id' => $role_id,
                    'jabatan' => $jabatan
                ];
            }

            if ($app_level == '2') { //KAPRODI
                $data2 = [
                    'id_mj'       => $mj['id_mj'],
                    'per_jabatan' => $mj['periode'],
                    'role_id'     => '2',
                    'jabatan'     => 'Ketua Program Studi',
                    'nama'        => $_SESSION['nama_user'],
                    'level_name'  => 'KAPRODI'
                ];
            }

            $this->session->set_userdata($data2);
            //HAPUS QRCODE EXPIRED
            $this->mydb->del_qrcode_exp();
            $landing_page = "dashboard";

            // SUKSES
            $location = base_url($landing_page);
        }

        redirect($location);
    }

    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('id_mhs');
        $this->session->unset_userdata('id_mahasiswa_pt');
        $this->session->unset_userdata('npm');
        $this->session->unset_userdata('id_mj');
        $this->session->unset_userdata('per_jabatan');
        $this->session->unset_userdata('hima_id');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('jabatan');
        $this->session->unset_userdata('singkatan');
        $this->session->unset_userdata('nama_hima');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('logged_in');


        // $_SESSION['logged_in'] = FALSE;
        unset(
            $_SESSION['active_smt'],

            $_SESSION['id_app'],
            $_SESSION['username'],
            $_SESSION['id_level'],
            $_SESSION['app_level'],
            $_SESSION['src_detail'],
            $_SESSION['level_name'],

            $_SESSION['kode_fak'],
            $_SESSION['nama_fak'],
            $_SESSION['kode_prodi'],
            $_SESSION['nama_prodi'],

            $_SESSION['id_user'],
            $_SESSION['nama_user'],

            $_SESSION['API_KEY'],
            $_SESSION['kode_bayar']
        );

        echo "  halaman akan tertutup dalam 2 detik
                <script>
                // setTimeout(function () { window.location.href='https://satu.unma.ac.id';}, 1000);
                setTimeout(function () { window.location.href='" . base_url('Auth') . "';}, 1000);
                </script>";
    }
}
