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
    //TAGIHAN
    public function index()
    {
        $data['title'] = 'Tagihan';
        $data['assets_css'] = array("themes/vendors/css/tables/datatable/datatables.min.css");
        $data['assets_js']  = array("themes/vendors/js/tables/datatable/datatables.min.js");
        $data['tampil']     = $this->tagihan->get_tagihan($_SESSION['id_mj']);
        $data['file']       = 'tagihan/tagihan';
        $this->load->view('template/index', $data);
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
            $data['title'] = 'Buat Tagihan';
            $data['file']         = 'tagihan/i_tg';
            $this->load->view('template/index', $data);
        } else {
            $data = [
                'id_hima' => $_SESSION['hima_id'],
                'id_mj' => $_SESSION['id_mj'],
                'nama_tagihan' => post_gan('nama_tagihan'),
                'jml_tagihan' => post_gan('jml_tagihan'),
                'jenis'     => post_gan('jenis'),
                'created_at' => post_gan('created_at'),
                'expired_at' => post_gan('expired_at')
            ];
            $this->mydb->input_dt($data, 't_tagihan');
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
            $data['title'] = 'Edit Tagihan';
            $data['col'] = $this->db->get_where('t_tagihan', $where)->row_array();
            $data['file']         = 'tagihan/e_tg';
            $this->load->view('template/index', $data);
        } else {
            $data = [
                'nama_tagihan' => post_gan('nama_tagihan'),
                'jml_tagihan' => post_gan('jml_tagihan'),
                'jenis' => post_gan('jenis'),
                'created_at' => post_gan('created_at'),
                'expired_at' => post_gan('expired_at')
            ];
            $this->mydb->update_dt($where, $data, 't_tagihan');
            notifikasi('Tagihan Berhasil Di update', true);
            redirect(base_url('Tagihan'));
        }
    }
    //TAGIHAN PENGURUS / ANGGOTA
    public function tg_pengurus($no_tg = null)
    {
        if ($no_tg == null) {
            notifikasi('Data Tagihan Tidak Ditemukan!!', false);
            redirect(base_url("Tagihan"));
        }
        $id_mj = $_SESSION['id_mj'];
        $tagihan = $this->tagihan->get_tagihan($id_mj, $no_tg);
        if ($tagihan->num_rows() > 0) {
            $data['tagihan'] = $tagihan->row_array();
            $data['title'] = 'Tagihan : ' . $tagihan->row_array()['nama_tagihan'];
            $data['assets_css'] = array("themes/vendors/css/tables/datatable/datatables.min.css");
            $data['assets_js']  = array("themes/vendors/js/tables/datatable/datatables.min.js");
            $data['jml_pengurus']        = $this->pengurus->hitung_pengurus($id_mj)['jml_pengurus'];
            $data['jml_tagihan_anggota'] = $this->tagihan->jml_ta($no_tg)['jml_ta'];
            $data['tagihan_anggota']     = $this->tagihan->get_tg_anggota($no_tg);
            $data['file']   = 'tagihan/detail_tagihan';
            $this->load->view('template/index', $data);
        } else {
            notifikasi('Data Tagihan Tidak Ditemukan!!', false);
            redirect(base_url("Tagihan"));
        }
    }
    public function i_tp($no_tg = null)   //input tagihan pengurus
    {
        if ($no_tg == null) {
            notifikasi('Data Tagihan Tidak Ditemukan!!', false);
            redirect(base_url("Tagihan"));
        }
        $id_mj = $_SESSION['id_mj'];
        $tg = $this->tagihan->get_tagihan($id_mj, $no_tg);
        if ($tg->num_rows() > 0) {
            $data['tampil'] = $this->pengurus->get_anggota_pengurus($_SESSION['hima_id'], $id_mj);
            $data['col']    = $tg->row_array();
            $data['title']  = 'Buat Tagihan Pengurus';
            $data['file']   = 'tagihan/i_tp';
            $this->load->view('template/index', $data);
        } else {
            notifikasi('Data Tagihan Tidak Ditemukan!!', false);
            redirect(base_url("Tagihan"));
        }
    }
    function p_i_tp($no_tg = null)    //PROSES INPUT TAGIHAN ANGGOTA
    {
        $mhs = post_gan('id_mhs');
        if ($no_tg == null || $mhs == null) {
            notifikasi('Gagal menambahkan data tagihan Anggota!!!', false);
            redirect(base_url("Tagihan/i_tp/" . $no_tg));
        } else {
            $ttl = count($mhs);
            for ($i = 0; $i < $ttl; $i++) {
                $data = array(
                    'id_mahasiswa_pt' => $mhs[$i],     //NPM
                    'no_tg' => $no_tg,
                    'dibayar' => '0'
                );
                $this->mydb->input_dt($data, 't_tagihan_anggota');
            }
            notifikasi('Penambahan Tagihan Anggota Berhasil!!!', true);
            redirect(base_url("Tagihan/tg_pengurus/" . $no_tg));
        }
    }
    //INPUT TAGIHAN ANGGOTA LAINNYA
    public function i_tmhs($no_tg = null)
    {
        if ($no_tg = null) {
            notifikasi('Data Tagihan Tidak Ditemukan!!', false);
            redirect(base_url("Tagihan"));
        }
        $id_mj = $_SESSION['id_mj'];
        $cek = $this->tagihan->get_tagihan($id_mj, $no_tg);
        if ($cek->num_rows() > 0) {
            $data['col'] = $cek->row_array();
            $data['title'] = 'Tambah Tagihan Anggota';

            $npm = (isset($_POST['npm'])) ? $_POST['npm'] : '';
            if ($npm != '') {
                $mhs = json_npm($npm);
                if (empty($mhs['id_mahasiswa_pt'])) {
                    $data['col2'] = "LOL";
                    notifikasi('Data Mahasiswa Tidak Ditemukan!!', false);
                } else {
                    $data['col2'] = $mhs;
                    notifikasi('Data Mahasiswa Ditemukan!!', true);
                }
            } else {
                $data['col2'] = "LOL";
            }

            $data['file']   = 'tagihan/i_tmhs';
            $this->load->view('template/index', $data);
        } else {
            notifikasi('Data Tagihan Tidak Ditemukan!!', false);
            redirect(base_url("Tagihann"));
        }
    }
    function p_i_tmhs()
    {
        $npm = post_gan('npm3');
        $no_tg = post_gan('no_tg');
        $cek_tg = $this->tagihan->get_tg_anggota($no_tg, $npm)->num_rows();
        if ($cek_tg > 0) {
            notifikasi('Tagihan Anggota tidak ada yang dipilih!!!', false);
            redirect(base_url("Tagihan"));
        } else {
            $data = array(
                'id_mahasiswa_pt' => $npm,     //NPM
                'no_tg' => $no_tg,
                'dibayar' => '0'
            );
            $this->mydb->input_dt($data, 't_tagihan_anggota');
            notifikasi('Tagihan Anggota berhasil dibuat!!!', true);
            redirect(base_url("Tagihan/tg_pengurus/" . $no_tg));
        }
    }

    //DELETE
    function del_tg($no_tg = null)
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
    function del_tp($no_ta = null)
    {
        if ($no_ta == null) {
            notifikasi('Data Tagihan Tidak Ditemukan!!', false);
            redirect(base_url("Tagihan"));
        }
        $ta = $this->tagihan->get_ta($_SESSION['id_mj'], $no_ta);
        if ($ta->num_rows() > 0) {
            $t = $ta->row_array();
            if ($t['id_mj'] != $_SESSION['id_mj']) {
                notifikasi('Tagihan Anggota tidak bisa dihapus !!', false);
            } else {
                $where = ['no_ta' => $no_ta];
                $this->mydb->del($where, 't_tagihan_anggota');
                $this->mydb->del(['no_tg' => $t['no_tg'], 'id_mahasiswa_pt' => $t['id_mahasiswa_pt']], 't_pembayaran');

                notifikasi('Tagihan Anggota berhasil dihapus!!', true);
            }
            redirect(base_url("Tagihan/tg_pengurus/" . $t['no_tg']));
        } else {
            notifikasi('Data Tagihan Tidak Ditemukan!!', false);
        }
        redirect(base_url("Tagihan"));
    }
}
