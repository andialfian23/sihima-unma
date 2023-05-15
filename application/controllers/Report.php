<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('absen_model', 'absen');
        $this->load->model('kegiatan_model', 'kegiatan');
        $this->load->model('keuangan_model', 'keuangan');
        $this->load->model('pengurus_model', 'pengurus');
        $this->load->model('MJ_model');
    }
    // LAPORAN KEGIATAN
    public function pdf_kegiatan($no_kg = null)
    {
        if ((!$no_kg) || ($no_kg == null)) {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url("Dashboard/kegiatan"));
        }
        $kegiatan = $this->kegiatan->get_kegiatan($_SESSION['id_mj'], $no_kg);
        $data['col']     = $kegiatan->row_array();
        $data['title']   = 'Laporan Kegiatan ';
        $data['sebagai'] = $this->absen->peran_dikegiatan();
        $data['panitia'] =  $this->absen->getAbsen($no_kg, 'Panitia');
        $data['tampil']  =  $this->absen->getAbsen($no_kg, 'Peserta');
        $data['biaya']     =  $this->kegiatan->get_biaya($_SESSION['id_mj'], $no_kg);
        $data['dokumentasi'] = $this->kegiatan->get_dokumentasi($_SESSION['id_mj'], $no_kg);

        // $this->load->view('laporan/cover_kegiatan', $data);
        // $this->load->view('laporan/laporan_kegiatan', $data);

        // $apiClient = new Api2Pdf('dfdd2e41-80a8-48ee-9c45-66a26cc803b6');
        // $pengesahan = $apiClient->libreOfficePdfToHtml(pengesahan($data['col']['pengesahan']));
        // echo $pengesahan->getFile();

        // $this->load->view('laporan/pengesahan', $data);
        // $this->load->view('laporan/daftar_panitia', $data);
        // $this->load->view('laporan/daftar_peserta', $data);
        // $this->load->view('laporan/biaya_kegiatan', $data);
        // $this->load->view('laporan/dokumentasi_kegiatan', $data);

        $this->load->library('pdfgenerator');
        $html = $this->load->view('laporan/cover_kegiatan', $data, true);
        $html .= $this->load->view('laporan/laporan_kegiatan', $data, true);
        // $html .= $this->load->view('laporan/pengesahan', $data, true);
        if ($data['panitia']['num_rows'] > 0) {
            $html .= $this->load->view('laporan/daftar_panitia', $data, true);
        }
        if ($data['tampil']['num_rows'] > 0) {
            $html .= $this->load->view('laporan/daftar_peserta', $data, true);
        }
        if ($data['biaya']['num_rows'] > 0) {
            $html .= $this->load->view('laporan/biaya_kegiatan', $data, true);
        }
        if ($data['dokumentasi']['num_rows'] > 0) {
            $html .= $this->load->view('laporan/dokumentasi_kegiatan', $data, true);
        }
        $file_pdf = 'Lap_Keg_' . $data['col']['nama_kegiatan'];

        $this->pdfgenerator->generate($html, $file_pdf, 'A4', 'portrait');
    }
    //KEGIATANKU
    public function kegiatanKu()
    {
        $npm = $_SESSION['id_mahasiswa_pt'];
        if ((!$npm) || ($npm == null)) {
            notifikasi('Mohon maaf laporan tidak dapat dicetak!!', false);
            redirect(base_url("Dashboard/kegiatan"));
        }
        $data['title'] = 'Laporan Kegiatan ';
        $data['tampil'] = $this->kegiatan->kegiatanku($npm);
        $data['kahim'] = $this->MJ_model->get_mj_aktif($_SESSION['hima_id'])['ketua_himpunan'];

        // $this->load->view('laporan/laporan_kegiatanku', $data);

        $this->load->library('pdfgenerator');
        $html = $this->load->view('laporan/laporan_kegiatanku', $data, true);
        $file_pdf = 'Kegiatanku';
        $this->pdfgenerator->generate($html, $file_pdf, 'A4', 'portrait');
    }
    //ABSENSI
    public function absensi($no_kg = null, $sebagai = 'Peserta')
    {
        if ((!$no_kg) || ($no_kg == null) || (!$sebagai)) {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url("Dashboard/kegiatan"));
        }
        $kegiatan = $this->kegiatan->get_kegiatan($_SESSION['id_mj'], $no_kg);
        $data['sebagai'] = $sebagai;
        $data['col'] = $kegiatan->row_array();
        if ($sebagai == 'Peserta') {
            $data['title'] = 'Daftar Peserta';
            $data['tampil'] =  $this->absen->getAbsen($no_kg, $sebagai);
            $file = 'daftar_peserta';
        } else {
            $data['title']  = 'Susunan Panitia';
            $data['sebagai'] = $this->absen->peran_dikegiatan();
            $data['panitia'] =  $this->absen->getAbsen($no_kg, $sebagai, 'Hadir');
            $file = 'daftar_panitia';
        }
        // $this->load->view('laporan/' . $file, $data);

        $this->load->library('pdfgenerator');
        $html = $this->load->view('laporan/' . $file, $data, true);
        $file_pdf = $data['title'] . '_' . $data['col']['nama_kegiatan'];
        $this->pdfgenerator->generate($html, $file_pdf, 'A4', 'portrait');
    }
    // LAPORAN REALISASI BIAYA KEGIATAN
    public function pdf_biaya_kegiatan($no_kg = null)
    {
        if ((!$no_kg) || ($no_kg == null)) {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url("Dashboard/kegiatan"));
        }
        $data['title'] = 'Laporan Kegiatan ';
        $kegiatan = $this->kegiatan->get_kegiatan($_SESSION['id_mj'], $no_kg);
        $data['col'] = $kegiatan->row_array();
        $data['biaya'] =  $this->kegiatan->get_biaya($_SESSION['id_mj'], $no_kg);

        // $this->load->view('laporan/biaya_kegiatan', $data);

        if ($data['biaya']['num_rows'] > 0) {
            $this->load->library('pdfgenerator');
            $html = $this->load->view('laporan/biaya_kegiatan', $data, true);
            $file_pdf = 'Realisasi_Biaya_' . $data['biaya']['nama_kegiatan'];
            $this->pdfgenerator->generate($html, $file_pdf, 'A4', 'portrait');
        } else {
            echo "Mohon maaf laporan rincian anggaran biaya tidak dapat dicetak";
        }
    }
    // LAPORAN DOKUMENTASI KEGIATAN
    public function dokumentasi_kegiatan($no_kg = null)
    {
        if ((!$no_kg) || ($no_kg == null)) {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url("Dashboard/kegiatan"));
        }
        $data['title'] = 'Laporan Kegiatan ';
        $kegiatan = $this->kegiatan->get_kegiatan($_SESSION['id_mj'], $no_kg);
        $data['col'] = $kegiatan->row_array();
        $data['dokumentasi'] = $this->kegiatan->get_dokumentasi($_SESSION['id_mj'], $no_kg);

        // $this->load->view('laporan/dokumentasi_kegiatan', $data);

        if ($data['dokumentasi']->num_rows > 0) {
            $this->load->library('pdfgenerator');
            $html = $this->load->view('laporan/dokumentasi_kegiatan', $data, true);
            $file_pdf = 'Dokumentasi_' . $data['col']['nama_kegiatan'];
            $this->pdfgenerator->generate($html, $file_pdf, 'A4', 'portrait');
        } else {
            echo "Mohon maaf laporan rincian anggaran biaya tidak dapat dicetak";
        }
    }
    //LAPORAN PEMASUKAN DAN PENGELUARAN
    public function keuangan()
    {
        $data['title'] = 'Laporan Keuangan';
        $data['hima'] = $this->MJ_model->get_mj_aktif($_SESSION['hima_id']);
        $data['pemasukan'] =  $this->keuangan->get_pemasukan($_SESSION['id_mj'], null, 'ASC');
        $data['pengeluaran'] =  $this->keuangan->get_pengeluaran($_SESSION['id_mj']);

        // $this->load->view('laporan/laporan_keuangan', $data);

        if (($data['pemasukan']['num_rows'] > 0) || ($data['pengeluaran']->num_rows() > 0)) {
            $this->load->library('pdfgenerator');
            $html = $this->load->view('laporan/laporan_keuangan', $data, true);
            $file_pdf = 'Lap_keuangan_' . $_SESSION['singkatan'] . '_' . date('Y-m-d');
            $this->pdfgenerator->generate($html, $file_pdf, 'A4', 'potrait');
        } else {
            notifikasi('Mohon maaf laporan keuangan tidak dapat dicetak !!!', false);
            redirect(base_url('Dashboard'));
        }
    }
}
