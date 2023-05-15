<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keuangan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('pengurus_model', 'pengurus');
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
            $data['title'] = 'Tambah Data Pemasukan';
            backEnd('keuangan/i_pm', $data);
        } else {
            $data2 = array(
                'id_mj'     => $_SESSION['id_mj'],
                'tgl_pm'    => $this->input->post('tgl_pm'),
                'nama_pemasukan' => $this->input->post('nama_pm'),
                'jml_pm'    => $this->input->post('jml_pm'),
                'sumber'    => $this->input->post('sumber')
            );
            $this->mydb->input_dt($data2, 't_pemasukan');
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
            $data['title'] = 'Edit Data Pemasukan';
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
                $data['col'] = $pemasukan;
                backEnd('keuangan/e_pm', $data);
            } else {
                //CEK KAS HIMA
                $where1 = ['kas_hima' => '1', 'no_pm' => $no_pm];
                $cek_pm = $this->db->get_where('t_pemasukan', $where1);
                if ($cek_pm->num_rows() > 0) {
                    notifikasi('Mohon maaf data pemasukan ini tidak dapat di edit !!!', false);
                } else {

                    //UPDATE DATA PEMASUKAN
                    $data2 = array(
                        'tgl_pm' => $this->input->post('tgl_pm'),
                        'sumber' => $this->input->post('sumber'),
                        'nama_pemasukan' => $this->input->post('nama_pm'),
                        'jml_pm' => $this->input->post('jml_pm')
                    );
                    $this->mydb->update_dt($where, $data2, 't_pemasukan');
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
            $data['title'] = 'Tambah Data Pengeluaran';
            backEnd('keuangan/i_pk', $data);
        } else {
            $data2 = array(
                'id_mj' => $_SESSION['id_mj'],
                'tgl_pk' => $this->input->post('tgl_pk'),
                'nama_pengeluaran' => $this->input->post('nama_pk'),
                'jml_pk' => $this->input->post('jml_pk'),
            );
            $this->mydb->input_dt($data2, 't_pengeluaran');
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
            $data['title'] = 'Edit Data Pengeluaran';
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
                $data['col'] = $pengeluaran;
                backEnd('keuangan/e_pk', $data);
            } else {

                $data2 = array(
                    'tgl_pk' => $this->input->post('tgl_pk'),
                    'nama_pengeluaran' => $this->input->post('nama_pk'),
                    'jml_pk' => $this->input->post('jml_pk')
                );

                $this->mydb->update_dt($where, $data2, 't_pengeluaran');
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
    //ATURAN KEUANGAN
    public function cash_rule() //SHOW & INPUT CASH_RULE
    {
        $this->form_validation->set_rules(
            'cash_rule',
            'cash_rule',
            'required|trim|is_unique[t_cash_rule.cash_rule]',
            ['required' => 'Peraturan tidak boleh kosong', 'is_unique' => 'Peraturan sudah ada !!!']
        );
        if ($this->form_validation->run() == false) {
            $data['title'] =  "Peraturan Kas Himpunan";
            $data['assets_css'] = array("themes/vendors/css/tables/datatable/datatables.min.css");
            $data['assets_js'] = array("themes/vendors/js/tables/datatable/datatables.min.js");
            $data['tampil'] = $this->db->get_where('t_cash_rule', ['id_hima' => $_SESSION['hima_id']])->result_array();
            backEnd('keuangan/cash_rule', $data);
        } else {
            $time = date("Y-m-d H:i:s");
            $data = array(
                'cash_rule' => $this->input->post('cash_rule'),
                'id_hima' => $_SESSION['hima_id'],
                'created_at' => $time
            );
            $this->mydb->input_dt($data, 't_cash_rule');
            notifikasi('Penambahan Peraturan Keuangan Berhasil!!!', true);
            redirect(base_url("Keuangan/cash_rule"));
        }
    }
    public function e_cr($id_cr)
    {
        $id_cr = $this->uri->segment(3);
        if ($id_cr == null) {
            notifikasi('Peraturan keuangan tidak ada yang dipilih!!!', false);
            redirect(base_url("Keuangan/cash_rule"));
        }
        $cek = $this->db->get_where('t_cash_rule', ['id_hima' => $_SESSION['hima_id'], 'id_cr' => $id_cr]);
        if ($cek->num_rows() > 0) {
            $this->form_validation->set_rules('nm_cr', 'Cash Rule', 'required|trim');
            if ($this->form_validation->run() == false) {
                $data['title'] =  "Edit Peraturan Keuangan";
                $data['col'] = $cek->row_array();
                backEnd('keuangan/e_cr', $data);
            } else {
                $data_cash_rule = array(
                    'cash_rule' => post_gan('nm_cr')
                );
                $where = ['id_cr' => $id_cr];
                $this->mydb->update_dt($where, $data_cash_rule, 't_cash_rule');
                notifikasi('Update Peraturan Keuangan Berhasil!!!', true);
                redirect(base_url("Keuangan/cash_rule"));
            }
        } else {
            notifikasi('Peraturan Keuangan Tidak Ditemukan!!', false);
            redirect(base_url("Keuangan/cash_rule"));
        }
    }
    function del_cr($id_cr) //HAPUS ATURAN KEUANGAN
    {
        $hima_id = $_SESSION['hima_id'];
        $cek = $this->db->get_where('t_cash_rule', ['id_hima' => $hima_id, 'id_cr' => $id_cr]);
        if ($cek->num_rows() > 0) {
            $where = array('id_cr' => $id_cr, 'id_hima' => $hima_id);
            $this->mydb->del($where, 't_cash_rule');
            notifikasi('Peraturan Keuangan berhasil dihapus!!', true);
        } else {
            notifikasi('Peraturan Keuangan Tidak Ditemukan!!', false);
        }
        redirect(base_url("Keuangan/cash_rule"));
    }
}
