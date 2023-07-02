<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('pengurus_model');
        $this->load->model('MJ_model', 'mj_model');
    }
    //LIST MAHASISWA / Anggota Lainnya
    public function index()
    {
        redirect(base_url("Anggota/all"));
    }
    public function all()
    {

        $this->load->view('dashboard/template/main', [
            'title'      => 'Mahasiswa',
            'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
            'assets_js'  => array("themes/vendors/js/tables/datatable/datatables.min.js"),
            'file'       => 'mahasiswa',
        ]);
    }
    //PROSES ADD AKSES ANGGOTA
    public function p_i_anggota($npm = null)
    {
        if ($npm == null) {
            notifikasi('<b>Gagal Memberikan akses !!!<b> NPM tidak diketahui!!!', true);
            redirect(base_url('Anggota/all'));
        }
        $user = json_npm($npm);
        $cek_user = $this->mydb->cek_user($npm);
        if ($cek_user->num_rows() > 0) {
            notifikasi('<b>' . $user['nm_pd'] . '<b> sudah memiliki Akses !!!', true);
            redirect(base_url('Anggota/all'));
        } else {    //INPUT ADD LEVEL BIAR BISA MASUK SISTEM
            $data_user['id_mhs'] = $user['id_mhs'];
            $result = $this->curl->simple_post(ADD_API . 'hima/add_level', $data_user);
            if ($result != '1') {
                notifikasi('Gagal dalam memberi hak akses !!!', false);
            } else {
                //INPUT KE TABEL USER
                $data_baru = ['id_mahasiswa_pt' => $user['id_mahasiswa_pt']];
                $this->mydb->input_dt($data_baru, 't_user');
                notifikasi($user['nm_pd'] . ' berhasil mendapatkan hak Akses !!!', true);
            }
            redirect(base_url('Dashboard/detail/' . $npm));
        }
    }
    //INPUT PENGURUS
    public function i_pengurus($npm = null)
    {
        if ($npm == NULL) {
            notifikasi('Anda tidak bisa mengakses ke halaman tambah anggota pengurus', false);
            redirect(base_url('Dashboard'));
        }
        $cek_pengurus = $this->pengurus_model->cek_pengurus2($npm, $_SESSION['id_mj']);
        if ($cek_pengurus->num_rows() > 0) {
            notifikasi('Data Sudah Termasuk Anggota Pengurus !!!', false);
            redirect(base_url('Dashboard/detail/' . $npm));
        } else {
            $mhs = json_npm($npm);
            $jabatan = $this->db->get('t_jabatan')->result_array();
            $masa_jabatan = $this->mj_model->get_mj_aktif($_SESSION['hima_id']);

            $this->load->view('dashboard/template/main', [
                'title'  => 'Tambah Anggota Pengurus',
                'col'    => $mhs,
                'mj'     => $masa_jabatan,
                'tampil' => $jabatan,
                'file'   => 'anggota/i_pengurus',
            ]);
        }
    }
    //PROSESS INPUT ANGGOTA PENGURUS
    public function proses_save($npm = null)
    {
        if ($npm == NULL) {
            notifikasi('Anda tidak bisa mengakses ke halaman tambah anggota pengurus', false);
            redirect(base_url('Dashboard'));
        }
        if (($_POST['id_jabatan'] != null) && ($_POST['id_mj'] != null)) {
            $user = json_npm($npm);
            //INPUT ANGGOTA PENGURUS BARU KE TABEL_PENGURUS
            $value = [
                'id_mahasiswa_pt'   => $npm,
                'id_jabatan'        => post_gan('id_jabatan'),
                'id_mj'             => post_gan('id_mj')
            ];
            $this->mydb->input_dt($value, 't_pengurus');
            notifikasi('Anggota Pengurus atas nama ' . $user['nm_pd'] . ' Berhasil Ditambahkan', true);
        } else {
            notifikasi('Gagal menambahkan Anggota Pengurus', false);
        }
        if ($_SESSION['role_id'] == '2') {
            redirect(base_url('Kprodi/pengurus/' . post_gan('id_mj')));
        } else {
            redirect(base_url('Pengurus/anggota/' . post_gan('id_mj')));
        }
    }
    //EDIT ANGGOTA PENGURUS
    public function e_pengurus($npm = null)
    {
        if ($npm == NULL) {
            notifikasi('Gagal mengakses ke halaman edit anggota pengurus', false);
            redirect(base_url('Dashboard'));
        }
        $id_mj = $_SESSION['id_mj'];
        $cek_pengurus = $this->pengurus_model->cek_pengurus2($npm, $id_mj);
        if ($cek_pengurus->num_rows() > 0) {
            $this->form_validation->set_rules('id_jabatan', 'Jabatan', 'required|trim', [
                'required' => 'Jabatan harus dipilih !!'
            ]);
            if ($this->form_validation->run() == false) {
                $jabatan    = $this->db->get('t_jabatan')->result_array();
                $pengurus   = $this->pengurus_model->get_jabatan($npm, $id_mj);
                $masa_jabatan = $this->mj_model->get_masa_periode($id_mj)->row_array();
                $this->load->view('dashboard/template/main', [
                    'title'  => 'Edit Jabatan ',
                    'mhs'    => json_npm($npm),
                    'jabatan' => $jabatan,
                    'mj'     => $masa_jabatan,
                    'pengurus'   => $pengurus,
                    'file'   => 'pengurus/e_pengurus',
                ]);
            } else {
                $where = ['id_mahasiswa_pt' => $npm, 'id_mj' => $id_mj];
                $set = ['id_jabatan' => post_gan('id_jabatan')];
                $this->mydb->update_dt($where, $set, 't_pengurus');
                redirect(base_url('Dashboard/detail/' . $npm));
            }
        } else {
            notifikasi('Data Anggota Tidak Ditemukan', false);
            redirect(base_url('Dashboard'));
        }
    }
    //HAPUS DATA ANGGOTA PENGURUS
    public function del_pengurus($npm = null)
    {
        if ($npm == NULL) {
            notifikasi('Gagal memproses hapus data anggota pengurus', false);
            redirect(base_url('Dashboard'));
        }
        //MENGECEK DATA PENGURUS berdasarkan NPM dan ID_MASA_JABATAN
        if ($this->pengurus_model->cek_pengurus2($npm, $_SESSION['id_mj'])->num_rows() > 0) {
            //MENGHAPUS DATA PENGURUS
            $where = ['id_mahasiswa_pt' => $npm, 'id_mj' => $_SESSION['id_mj']];
            $this->mydb->del($where, 't_pengurus');
            //MENAMPILKAN
            $nama = json_npm($npm)['nm_pd'];
            notifikasi('Data <b>' . $nama . '</b> berhasil dihapus dari Data Pengurus!!!', true);
            redirect(base_url('Dashboard/detail/' . $npm));
        } else {
            notifikasi('Data Anggota Pengurus Tidak ditemukan !!!', false);
            redirect(base_url('Dashboard'));
        }
    }
}
