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
        $this->load->model('pembayaran_model', 'pembayaran');
    }
    public function index()
    {
        redirect(base_url('Pengurus/anggota'));
    }
    public function anggota($id_mj = null) //Anggota Pengurus
    {
        if ($id_mj != null) {
            $id_mj = (!empty($id_mj)) ? $id_mj : $_SESSION['id_mj'];
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

        $kahim     = $this->MJ_model->kahim($id_mj);
        $masa_jabatans = $this->MJ_model->get_masa_jabatan($_SESSION['hima_id']);
        $penguruss = $this->pengurus_model->get_anggota_pengurus($id_hima, $id_mj);
        $this->load->view('dashboard/template/main', [
            'title'      => 'Anggota Pengurus ' . $periode,
            'id_mj'      => $id_mj,
            'periode'    => $periode,
            'kahim'      => $kahim,
            'masa_jabatans' => $masa_jabatans,
            'penguruss'     => $penguruss,
            'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
            'assets_js'  => array("themes/vendors/js/tables/datatable/datatables.min.js"),
            'file'       => 'pengurus/index',
        ]);
    }
    public function histori_pm()    //Histori Pemasukkan
    {
        $pemasukans = $this->keuangan->get_pemasukan($_SESSION['id_mj']);
        $pembayaran = $this->pembayaran->get_kas_himpunan($_SESSION['id_mj']);

        // echo $this->db->last_query();
        // die;

        $this->load->view('dashboard/template/main', [
            'title'      => 'Histori Pemasukan ' . $_SESSION['per_jabatan'],
            'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
            'assets_js'  => array("themes/vendors/js/tables/datatable/datatables.min.js"),
            'kas'        => $pembayaran,
            'pemasukan'  => $pemasukans,
            'file'       => 'pemasukan/index_pm',
        ]);
    }
    public function histori_pk()    //Histori Pengeluaran
    {
        $pengeluarans = $this->keuangan->get_pengeluaran($_SESSION['id_mj']);
        $this->load->view('dashboard/template/main', [
            'title'      => 'Histori Pengeluaran ' . $_SESSION['per_jabatan'],
            'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
            'assets_js'  => array("themes/vendors/js/tables/datatable/datatables.min.js"),
            'tampil'     => $pengeluarans,
            'file'       => 'pengeluaran/index_pk',
        ]);
    }
    public function postinganKu()   //Histori PostinganKu
    {
        $posts = $this->post_model->get_postingan_ku($_SESSION['id_mahasiswa_pt']);
        $this->load->view('dashboard/template/main', [
            'title'      => 'Histori PostinganKu',
            'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
            'assets_js'  => array("themes/vendors/js/tables/datatable/datatables.min.js"),
            'posts'      => $posts,
            'file'       => 'post/index',
        ]);
    }
}
