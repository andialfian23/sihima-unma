<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Biaya_kegiatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('kegiatan_model', 'kegiatan');
    }
    public function insert_pemasukan($no_kg = null)
    {
        $notif = 'Data Kegiatan tidak ditemukan!!!';
        if ($no_kg == null) {
            notifikasi($notif, false);
            redirect('Dashboard');
        }
        $kegiatan = $this->kegiatan->get_kegiatan($_SESSION['id_mj'], $no_kg);
        if (($kegiatan->num_rows() < 1)) {
            notifikasi($notif, false);
            redirect('Dashboard');
        }

        $jenis = 'pemasukan';
        $this->form_validation->set_rules('nama_item', 'Nama ' . $jenis, 'required|trim', [
            'required' => 'Nama ' . $jenis . ' tidak boleh kosong !!'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'trim|numeric', [
            'numeric' => 'Harga satuan harus berupa numeric / bilangan'
        ]);
        $this->form_validation->set_rules('volume', 'Volume', 'trim|numeric', [
            'numeric' => 'Volume harus berupa numeric / bilangan'
        ]);
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim|numeric', [
            'required' => 'Jumlah tidak boleh kosong !!',
            'numeric' => 'Jumlah harus berupa numeric / bilangan'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/template/main', [
                'title'  => 'Tambah Pemasukan -> Realisasi Biaya Kegiatan',
                'col'    => $kegiatan->row_array(),
                'jenis'  => $jenis,
                'file'   => 'biaya_kegiatan/add_item',
            ]);
        } else {
            $this->add_item($no_kg, $jenis);
        }
    }
    public function insert_pengeluaran($no_kg = null)
    {
        $notif = 'Data Kegiatan tidak ditemukan!!!';
        if ($no_kg == null) {
            notifikasi($notif, false);
            redirect('Dashboard');
        }
        $kegiatan = $this->kegiatan->get_kegiatan($_SESSION['id_mj'], $no_kg);
        if (($kegiatan->num_rows() < 1)) {
            notifikasi($notif, false);
            redirect('Dashboard');
        }
        $jenis = 'pengeluaran';
        $this->form_validation->set_rules('nama_item', 'Nama ' . $jenis, 'required|trim', [
            'required' => 'Nama ' . $jenis . ' tidak boleh kosong !!'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'trim|numeric', [
            'numeric' => 'Harga satuan harus berupa numeric / bilangan'
        ]);
        $this->form_validation->set_rules('volume', 'Volume', 'trim|numeric', [
            'numeric' => 'Volume harus berupa numeric / bilangan'
        ]);
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim|numeric', [
            'required' => 'Jumlah tidak boleh kosong !!',
            'numeric' => 'Jumlah harus berupa numeric / bilangan'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/template/main', [
                'title' => 'Tambah Pengeluaran -> Realisasi Biaya Kegiatan',
                'col'   => $kegiatan->row_array(),
                'jenis' => $jenis,
                'file'  => 'biaya_kegiatan/add_item',
            ]);
        } else {
            $this->add_item($no_kg, $jenis);
        }
    }
    private function add_item($no_kg = null, $jenis = null)
    {
        if (($no_kg == null) || ($jenis == null)) {
            notifikasi('Gagal menambahkan item realisasi biaya kegiatan', false);
            redirect(base_url('dashboard'));
        }

        $values = array(
            'jenis'     => $jenis,
            'nama_item' => post_aman('nama_item'),
            'harga'     => post_aman('harga'),
            'volume'    => post_aman('volume'),
            'unit'      => post_aman('unit'),
            'jumlah'    => post_aman('jumlah'),
            'no_kg'     => $no_kg,
        );
        $this->mydb->input_dt($values, 't_biaya_kegiatan');

        notifikasi('Berhasil menambahkan ' . $jenis . ' !!!', true);
        redirect(base_url("Dashboard/realisasi_biaya/" . $no_kg));
    }
    public function del_item($id_biaya = null)
    {
        if ($id_biaya == null) {
            notifikasi('Gagal Menghapus Item Realisasi Biaya Kegiatan!!!', false);
            redirect('Dashboard');
        }

        $cek_biaya_kg = $this->kegiatan->cek_biaya($_SESSION['id_mj'], $id_biaya);
        if ($cek_biaya_kg->num_rows() > 0) {
            $kegiatan = $cek_biaya_kg->row_array();
            $this->mydb->del(['id_biaya' => $id_biaya], 't_biaya_kegiatan');
            notifikasi('Item ' . $kegiatan['jenis'] . ' ' . $kegiatan['nama_item'] . ' berhasil dihapus!!', true);
            redirect(base_url('Dashboard/realisasi_biaya/' . $kegiatan['no_kg']));
        } else {
            notifikasi('Gagal Menghapus Item Realisasi Biaya Kegiatan!!!', false);
            redirect('Dashboard');
        }
    }
}

/* End of file Biaya_kegiatan.php and path \application\controllers\Biaya_kegiatan.php */
