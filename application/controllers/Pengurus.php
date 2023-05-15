<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengurus extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('MJ_model');
        $this->load->model('pengurus_model');
        $this->load->model('post_model');
        $this->load->model('keuangan_model', 'keuangan');
        $this->load->model('tagihan_model', 'tagihan');
    }
    public function index()
    {
        redirect(base_url('Pengurus/anggota'));
    }
    public function anggota() //Anggota Pengurus
    {
        $segment_id_mj = $this->uri->segment('3');
        if ($segment_id_mj != null) {
            $id_mj = (!empty($segment_id_mj)) ? $segment_id_mj : $_SESSION['id_mj'];
            $query = $this->MJ_model->get_masa_periode($id_mj);
            if (($query->num_rows() > 0)) {
                $mj = $query->row_array();
                $id_hima = $mj['id_hima'];
                $periode = $mj['periode'];
            } else {
                notifikasi('Data anggota tidak ditemukan', false);
                redirect(base_url('Dashboard'));
            }
        } else {
            $id_hima = $_SESSION['hima_id'];
            $id_mj   = $_SESSION['id_mj'];
            $periode = $_SESSION['per_jabatan'];
        }
        $data['id_mj']      = $id_mj;
        $data['periode']    = $periode;
        $data['kahim']      = $this->MJ_model->kahim($id_mj);

        $data['title']      = 'Anggota Pengurus ' . $periode;
        $data['assets_css'] = array("themes/vendors/css/tables/datatable/datatables.min.css");
        $data['assets_js']  = array("themes/vendors/js/tables/datatable/datatables.min.js");
        $data['tampil']     = $this->pengurus_model->get_anggota_pengurus($id_hima, $id_mj);
        $data['file']       = 'anggota/anggota_pengurus';
        $this->load->view('template/index', $data);
    }
    public function histori_pm()    //Histori Pemasukkan
    {
        $data['title']      = 'Histori Pemasukan ' . $_SESSION['per_jabatan'];
        $data['assets_css'] = array("themes/vendors/css/tables/datatable/datatables.min.css");
        $data['assets_js']  = array("themes/vendors/js/tables/datatable/datatables.min.js");
        $data['kas']        = $this->tagihan->get_kas_himpunan($_SESSION['id_mj']);
        $data['pemasukan']  = $this->keuangan->get_pemasukan($_SESSION['id_mj']);
        $data['file']       = 'keuangan/histori_pemasukan';
        $this->load->view('template/index', $data);
    }
    public function histori_pk()    //Histori Pengeluaran
    {
        $data['title']      = 'Histori Pengeluaran ' . $_SESSION['per_jabatan'];
        $data['assets_css'] = array("themes/vendors/css/tables/datatable/datatables.min.css");
        $data['assets_js']  = array("themes/vendors/js/tables/datatable/datatables.min.js");
        $data['tampil']     = $this->keuangan->get_pengeluaran($_SESSION['id_mj']);
        $data['file']       = 'keuangan/histori_pengeluaran';
        $this->load->view('template/index', $data);
    }
    public function postinganKu()   //Histori PostinganKu
    {
        $data['title']      = 'Histori PostinganKu';
        $data['assets_css'] = array("themes/vendors/css/tables/datatable/datatables.min.css");
        $data['assets_js']  = array("themes/vendors/js/tables/datatable/datatables.min.js");
        $data['tampil']     = $this->post_model->get_postingan_ku($_SESSION['id_mahasiswa_pt']);
        $data['file']       = 'post/postingan';
        $this->load->view('template/index', $data);
    }
}
