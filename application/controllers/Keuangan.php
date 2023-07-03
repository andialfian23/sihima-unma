<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keuangan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('keuangan_model', 'keuangan');
    }
    //PEMASUKAN
    public function i_pm()
    {
        $this->form_validation->set_rules('tgl_pm', 'Tanggal Pemasukan', 'required|trim', [
            'required' => 'Tanggal Pemasukan tidak boleh kosong !!'
        ]);
        $this->form_validation->set_rules('sumber', 'Sumber', 'required|trim', [
            'required' => 'Nama Pemasukan tidak terpilih !!'
        ]);
        $this->form_validation->set_rules('nama_pm', 'Nama Pemasukan', 'required|trim', [
            'required' => 'Nama Pemasukan tidak terpilih !!'
        ]);
        $this->form_validation->set_rules('jml_pm', 'Jumlah Pemasukan', 'required|trim|numeric', [
            'required' => 'Jumlah Pemasukan tidak boleh kosong !!',
            'numeric' => 'Jumlah Pemasukan harus berupa numeric / bilangan'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/template/main', [
                'title' => 'Tambah Data Pemasukan',
                'file' => 'pemasukan/create',
            ]);
        } else {
            $data_values = array(
                'id_mj'     => $_SESSION['id_mj'],
                'tgl_pm'    => $this->input->post('tgl_pm'),
                'nama_pemasukan' => $this->input->post('nama_pm'),
                'jml_pm'    => $this->input->post('jml_pm'),
                'sumber'    => $this->input->post('sumber')
            );
            $this->mydb->input_dt($data_values, 't_pemasukan');
            notifikasi('Tambah Pemasukan Berhasil!!!', true);
            redirect(base_url("Pengurus/histori_pm"));
        }
    }
    public function e_pm($no_pm)
    {
        $id_mj = $_SESSION['id_mj'];
        $cek = $this->keuangan->get_pemasukan($id_mj, $no_pm);
        if ($cek->num_rows() > 0) {
            $pemasukan = $cek->row_array();
            $where = array('no_pm' => $no_pm, 'id_mj' => $id_mj);
            $this->form_validation->set_rules('tgl_pm', 'Tanggal Pemasukan', 'required|trim', [
                'required' => 'Tanggal Pemasukan tidak boleh kosong !!'
            ]);
            $this->form_validation->set_rules('sumber', 'Sumber', 'required|trim', [
                'required' => 'Sumber tidak boleh kosong !!'
            ]);
            $this->form_validation->set_rules('nama_pm', 'Nama Pemasukan', 'required|trim', [
                'required' => 'Nama Pemasukan tidak boleh kosong !!'
            ]);
            $this->form_validation->set_rules('jml_pm', 'Jumlah Pemasukan', 'required|trim|numeric', [
                'required' => 'Jumlah Pemasukan tidak boleh kosong !!',
                'numeric' => 'Jumlah Pemasukan harus berupa numeric / bilangan'
            ]);
            if ($this->form_validation->run() == false) {
                $this->load->view('dashboard/template/main', [
                    'pemasukan'   => $pemasukan,
                    'title' => 'Edit Data Pemasukan',
                    'file'  => 'pemasukan/edit',
                ]);
            } else {
                //CEK KAS HIMA
                $where1 = ['kas_hima' => '1', 'no_pm' => $no_pm];
                $cek_pm = $this->db->get_where('t_pemasukan', $where1);
                if ($cek_pm->num_rows() > 0) {
                    notifikasi('Mohon maaf data pemasukan ini tidak dapat di edit !!!', false);
                } else {
                    //UPDATE DATA PEMASUKAN
                    $data_set = array(
                        'tgl_pm' => $this->input->post('tgl_pm'),
                        'sumber' => $this->input->post('sumber'),
                        'nama_pemasukan' => $this->input->post('nama_pm'),
                        'jml_pm' => $this->input->post('jml_pm')
                    );
                    $this->mydb->update_dt($where, $data_set, 't_pemasukan');
                    notifikasi('Edit Data Pemasukan Berhasil!!!', true);
                    redirect(base_url("Pengurus/histori_pm/" . $no_pm));
                }
            }
        } else {
            notifikasi('Data Pemasukan tidak ditemukan!!!', false);
            redirect(base_url("Pengurus/histori_pm"));
        }
    }
    function del_pm($no_pm = null)
    {
        if ($no_pm == null) {
            notifikasi('Data Pemasukan Tidak Ditemukan!!', false);
            redirect(base_url("Pengurus/histori_pm"));
        }
        $id_mj = $_SESSION['id_mj'];
        $cek = $this->keuangan->get_pemasukan($id_mj, $no_pm);
        if ($cek->num_rows() > 0) {
            //HAPUS DATA PEMASUKAN
            $where2 = array('no_pm' => $no_pm, 'id_mj' => $id_mj);
            $this->mydb->del($where2, 't_pemasukan');
            notifikasi('Data Pemasukan berhasil dihapus!!', true);
        } else {
            notifikasi('Data Pemasukan Tidak Ditemukan!!', false);
        }
        redirect(base_url("Pengurus/histori_pm"));
    }
    //PENGELUARAN
    public function i_pk()
    {
        $this->form_validation->set_rules('tgl_pk', 'Tanggal Pengeluaran', 'required|trim', [
            'required' => 'Tanggal Pengeluaran tidak boleh kosong !!'
        ]);
        $this->form_validation->set_rules('nama_pk', 'Nama Pengeluaran', 'required|trim', [
            'required' => 'Nama Pengeluaran tidak terpilih !!'
        ]);
        $this->form_validation->set_rules('jml_pk', 'Jumlah Pengeluaran', 'required|trim|numeric', [
            'required' => 'Jumlah Pengeluaran tidak boleh kosong !!',
            'numeric' => 'Jumlah Pengeluaran harus berupa numeric / bilangan'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/template/main', [
                'title' => 'Tambah Data Pengeluaran',
                'file'  => 'pengeluaran/insert'
            ]);
        } else {
            $data_values = array(
                'id_mj' => $_SESSION['id_mj'],
                'tgl_pk' => $this->input->post('tgl_pk'),
                'nama_pengeluaran' => $this->input->post('nama_pk'),
                'jml_pk' => $this->input->post('jml_pk'),
            );
            $this->mydb->input_dt($data_values, 't_pengeluaran');
            notifikasi('Tambah Pengeluaran Berhasil!!!', true);
            redirect(base_url("Pengurus/histori_pk"));
        }
    }
    public function e_pk($no_pk)
    {
        $id_mj = $_SESSION['id_mj'];
        $cek = $this->keuangan->get_pengeluaran($id_mj, $no_pk);
        if ($cek->num_rows() > 0) {
            $pengeluaran = $cek->row_array();
            $where = array('no_pk' => $no_pk, 'id_mj' => $id_mj);
            $this->form_validation->set_rules('tgl_pk', 'Tanggal Pengeluaran', 'required|trim', [
                'required' => 'Tanggal Pengeluaran tidak boleh kosong !!'
            ]);
            $this->form_validation->set_rules('nama_pk', 'Nama Pengeluaran', 'required|trim', [
                'required' => 'Nama Pengeluaran tidak terpilih !!'
            ]);
            $this->form_validation->set_rules('jml_pk', 'Jumlah Pengeluaran', 'trim|numeric', [
                'numeric' => 'Jumlah Pengeluaran harus berupa numeric / bilangan'
            ]);
            if ($this->form_validation->run() == false) {
                $this->load->view('dashboard/template/main', [
                    'pengeluaran'   => $pengeluaran,
                    'title' => 'Edit Data Pengeluaran',
                    'file'  => 'pengeluaran/edit',
                ]);
            } else {
                $data_set = array(
                    'tgl_pk' => $this->input->post('tgl_pk'),
                    'nama_pengeluaran' => $this->input->post('nama_pk'),
                    'jml_pk' => $this->input->post('jml_pk')
                );

                $this->mydb->update_dt($where, $data_set, 't_pengeluaran');
                notifikasi('Edit Data Pengeluaran Berhasil!!!', true);
                redirect(base_url("Pengurus/histori_pk/" . $no_pk));
            }
        } else {
            notifikasi('Data Pengeluaran tidak ditemukan!!!', false);
            redirect(base_url("Pengurus/histori_pk"));
        }
    }
    function del_pk($no_pk)
    {
        $id_mj = $_SESSION['id_mj'];
        $cek = $this->keuangan->get_pengeluaran($id_mj, $no_pk);
        if ($cek->num_rows() > 0) {
            //HAPUS DATA PENGELUARAN
            $where2 = array('no_pk' => $no_pk, 'id_mj' => $id_mj);
            $this->mydb->del($where2, 't_pengeluaran');
            notifikasi('Data Pengeluaran berhasil dihapus!!', true);
        } else {
            notifikasi('Data Pengeluaran Tidak Ditemukan!!', false);
        }
        redirect(base_url("Pengurus/histori_pk"));
    }
}
