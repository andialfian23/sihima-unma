<?php defined('BASEPATH') or exit('No direct script access allowed');

class Tagihan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('pengurus_model', 'pengurus');
        $this->load->model('keuangan_model', 'keuangan');
        $this->load->model('tagihan_model', 'tagihan');
    }
    public function index()
    {
        $tagihan = $this->tagihan->get_tagihan($_SESSION['id_mj']);
        $this->load->view('dashboard/template/main', [
            'title'      => 'Tagihan',
            'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
            'assets_js'  => array("themes/vendors/js/tables/datatable/datatables.min.js"),
            'tagihan'    => $tagihan,
            'file'       => 'tagihan/index',
        ]);
    }
    public function i_tg()
    {
        $this->form_validation->set_rules('nama_tagihan', 'Nama Tagihan', 'required|trim', [
            'required' => 'Nama Tagihan tidak boleh kosong !!'
        ]);
        $this->form_validation->set_rules('jml_tagihan', 'Jumlah Tagihan', 'required|trim|numeric', [
            'required' => 'Jumlah Tagihan tidak boleh kosong !!',
            'numeric' => 'Jumlah Pengeluaran harus berupa numeric / bilangan'
        ]);
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim', [
            'required' => 'Jenis tidak terpilih !!'
        ]);
        $this->form_validation->set_rules('created_at', 'Tanggal Dibuat', 'required|trim', [
            'required' => 'Tanggal Dibuat tidak boleh kosong !!'
        ]);
        $this->form_validation->set_rules('expired_at', 'Expired', 'required|trim', [
            'required' => 'Expired tidak boleh kosong !!'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/template/main', [
                'title' => 'Buat Tagihan',
                'file'  => 'tagihan/i_tg',
            ]);
        } else {
            $data_values = [
                'id_hima'   => $_SESSION['hima_id'],
                'id_mj'     => $_SESSION['id_mj'],
                'nama_tagihan'  => post_gan('nama_tagihan'),
                'jml_tagihan'   => post_gan('jml_tagihan'),
                'jenis'         => post_gan('jenis'),
                'created_at'    => post_gan('created_at'),
                'expired_at'    => post_gan('expired_at')
            ];
            $this->mydb->input_dt($data_values, 't_tagihan');
            notifikasi('Tagihan Baru Berhasil Ditambahkan', true);
            redirect(base_url('Tagihan'));
        }
    }
    public function e_tg($no_tg = null)
    {
        if ($no_tg = null) {
            notifikasi('Data Tagihan Tidak Ditemukan!!', false);
            redirect(base_url("Tagihan"));
        }
        $id_hima = $_SESSION['hima_id'];
        $where = ['no_tg' => $no_tg, 'id_hima' => $id_hima];
        $this->form_validation->set_rules('nama_tagihan', 'Nama Tagihan', 'required|trim', [
            'required' => 'Nama Tagihan tidak boleh kosong !!'
        ]);
        $this->form_validation->set_rules('jml_tagihan', 'Jumlah Tagihan', 'required|trim|numeric', [
            'required' => 'Jumlah Tagihan tidak boleh kosong !!',
            'numeric' => 'Jumlah Pengeluaran harus berupa numeric / bilangan'
        ]);
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim', [
            'required' => 'Jenis tidak terpilih !!'
        ]);
        $this->form_validation->set_rules('created_at', 'Tanggal Dibuat', 'required|trim', [
            'required' => 'Tanggal Dibuat tidak boleh kosong !!'
        ]);
        $this->form_validation->set_rules('expired_at', 'Expired', 'required|trim', [
            'required' => 'Expired tidak boleh kosong !!'
        ]);
        if ($this->form_validation->run() == false) {
            $tagihan = $this->db->get_where('t_tagihan', $where)->row_array();
            $this->load->view('dashboard/template/main', [
                'title'     => 'Edit Tagihan',
                'tagihan'   => $tagihan,
                'file'      => 'tagihan/e_tg',
            ]);
        } else {
            $data_set = [
                'nama_tagihan' => post_gan('nama_tagihan'),
                'jml_tagihan' => post_gan('jml_tagihan'),
                'jenis'      => post_gan('jenis'),
                'created_at' => post_gan('created_at'),
                'expired_at' => post_gan('expired_at')
            ];
            $this->mydb->update_dt($where, $data_set, 't_tagihan');
            notifikasi('Tagihan Berhasil Di update', true);
            redirect(base_url('Tagihan'));
        }
    }
    function delete($no_tg = null)
    {
        if ($no_tg == null) {
            notifikasi('Data Tagihan Tidak Ditemukan!!', false);
        }
        $id_mj = $_SESSION['id_mj'];
        $cek = $this->tagihan->get_tagihan($id_mj, $no_tg);
        if ($cek->num_rows() > 0) {
            $where = array('no_tg' => $no_tg, 'id_mj' => $id_mj);
            $this->mydb->del($where, 't_tagihan');
            $this->mydb->del(['no_tg' => $no_tg], 't_tagihan_anggota');
            $this->mydb->del(['no_tg' => $no_tg], 't_pembayaran');
            notifikasi('Data Tagihan berhasil dihapus!!', true);
        } else {
            notifikasi('Data Tagihan Tidak Ditemukan!!', false);
        }
        redirect(base_url("Tagihan"));
    }
}
