<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('kegiatan_model');
        $this->load->model('absen_model');
        $this->load->model('pengurus_model');
    }
    public function index()
    {
        redirect(base_url('Kegiatan/sekarang'));
    }
    // SHOW DATA KEGIATAN di MASA JABATAN sekarang
    public function sekarang()
    {
        $title = 'Kegiatan ' . $_SESSION['singkatan'] . ' ' . $_SESSION['per_jabatan'];
        $kegiatan = $this->kegiatan_model->get_kegiatan($_SESSION['id_mj']);
        $this->load->view('dashboard/template/main', [
            'title'      => $title,
            'kegiatan'   => $kegiatan,
            'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
            'assets_js'  => array("themes/vendors/js/tables/datatable/datatables.min.js"),
            'file'       => 'kegiatan/index',
        ]);
    }
    // INPUT KEGIATAN
    public function i_kg()
    {
        $this->load->view('template/index', [
            'title' => 'Tambah Kegiatan',
            'file'  => 'kegiatan/create',
        ]);
    }
    public function p_i_kg()
    {
        $mulai = post_gan('mulai');
        $selesai = post_gan('selesai');
        $tgl = substr($mulai, 0, 10);
        if (($mulai == null) && ($selesai == null)) {
            notifikasi('Anda mau apa ???', false);
            redirect(base_url('Dashboard'));
        } else {
            $mulaiAbsen = post_gan('mulaiAbsen');
            $selesaiAbsen = post_gan('selesaiAbsen');
            $data_values = [
                'nama_kegiatan'     => post_gan('nama_kegiatan'),
                'tgl_kegiatan'      => $tgl,
                'tempat'            => post_gan('tempat'),
                'sifat_kegiatan'    => post_gan('sifat'),
                'lingkup'           => post_gan('lingkup'),
                'mulai'             => $mulai,
                'selesai'           => $selesai,
                'mulai_absensi'     => $mulaiAbsen,
                'selesai_absensi'   => $selesaiAbsen,
                'deskripsi'         => post_gan('deskripsi'),
                'id_mj'             => $_SESSION['id_mj']
            ];
            $this->mydb->input_dt($data_values, 't_kegiatan');
            echo 'Berhasil menambahkan data kegiatan';
        }
    }
    // EDIT KEGIATAN
    public function e_kg($no_kg = null)
    {
        if ($no_kg == null) {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url("Kegiatan/sekarang"));
        }
        $kegiatan = $this->kegiatan_model->get_kegiatan($_SESSION['id_mj'], $no_kg);
        if ($kegiatan->num_rows() > 0) {
            $kegiatan    = $kegiatan->row_array();

            $this->load->view('dashboard/template/main', [
                'title'     => 'Edit Kegiatan',
                'kegiatan'  => $kegiatan,
                'file'      => 'kegiatan/edit',
            ]);
        } else {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url("Dashboard/kg_terbaru"));
        }
    }
    public function p_e_kg($no_kg = null)
    {
        if ($no_kg == null) {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url("Kegiatan/sekarang"));
        }
        $id_mj = $_SESSION['id_mj'];
        $kegiatan = $this->kegiatan_model->get_kegiatan($id_mj, $no_kg);
        if ($kegiatan->num_rows() > 0) {
            $mulai = post_gan('mulai');
            $tgl = substr($mulai, 0, 10);
            $mulaiAbsen = post_gan('mulaiAbsen');
            $selesaiAbsen = post_gan('selesaiAbsen');
            $data_values = [
                'nama_kegiatan' => post_gan('nama_kegiatan'),
                'tgl_kegiatan'  => $tgl,
                'tempat'        => post_gan('tempat'),
                'sifat_kegiatan' => post_gan('sifat'),
                'lingkup'       => post_gan('lingkup'),
                'mulai'         => $mulai,
                'selesai'       => post_gan('selesai'),
                'mulai_absensi' => $mulaiAbsen,
                'selesai_absensi' => $selesaiAbsen,
                'deskripsi'      => post_gan('deskripsi')
            ];
            $where = ['no_kegiatan' => $no_kg, 'id_mj' => $id_mj];
            $this->mydb->update_dt($where, $data_values, 't_kegiatan');
            echo 'Berhasil menambahkan data kegiatan';
        } else {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url("Dashboard/info_kegiatan/" . $no_kg));
        }
    }
    //HAPUS
    function delete($no_kg = null)
    {
        if ($no_kg == null) {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url("Kegiatan/sekarang"));
        }
        $kegiatan = $this->kegiatan_model->get_kegiatan($_SESSION['id_mj'], $no_kg);
        $nama_kg = $kegiatan->row_array()['nama_kegiatan'];
        if ($kegiatan->num_rows() > 0) {
            $where = array('no_kegiatan' => $no_kg);
            $where2 = array('no_kg' => $no_kg);

            //data absensi pengurus dan peserta kegiatan
            $this->mydb->del($where, 't_absen');
            //menghapus data realisasi biaya kegiatan
            $this->mydb->del($where2, 't_biaya_kegiatan');
            //menghapus data dokumentasi kegiatan
            $this->mydb->del($where2, 't_dokumentasi');
            //menghapus data kegiatan
            $this->mydb->del($where, 't_kegiatan');

            $notif = 'success("Kegiatan <b>' . $nama_kg . '</b> berhasil dihapus!!")';
        } else {
            $notif = 'danger("Data Kegiatan Tidak Ditemukan!!")';
        }
        $this->session->set_flashdata('toastr', '<script>toastr.' . $notif . ';</script>');
        redirect(base_url("Kegiatan/sekarang"));
    }

    //PROSES UPLOAD HALAMAN PENGESAHAN KEGIATAN
    public function add_pengesahan($no_kg = null)
    {
        if ($no_kg == null) {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url("Kegiatan/sekarang"));
        }
        $kegiatan = $this->kegiatan_model->get_kegiatan($_SESSION['id_mj'], $no_kg);
        if ($kegiatan->num_rows() > 0) {
            $proses_upload = $this->upload_file();
            if ($proses_upload['status'] == "error") {
                $response = $proses_upload['message'];
            } else {
                $nama_file = $proses_upload['file_name'];
                $where = array('no_kegiatan' => $no_kg);
                $set = ['pengesahan' => $nama_file];
                $this->mydb->update_dt($where, $set, 't_kegiatan');
                $response = 1;
            }
        } else {
            $response = 'Gagal upload file pengesahan';
        }
        echo $response;
    }
    private function upload_file()
    {
        $config['upload_path'] = './media_library/pengesahan/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 0;
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('pengesahan')) {
            $this->vars['status'] = 'error';
            $this->vars['message'] = $this->upload->display_errors();
        } else {
            $file = $this->upload->data();
            // chmood new file
            @chmod(FCPATH . 'media_library/pengesahan/' . $file['file_name'], 0777);
            $this->vars['status']       = 'success';
            $this->vars['file_name']    = $file['file_name'];
        }
        return $this->vars;
    }
}
