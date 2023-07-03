<?php defined('BASEPATH') or exit('No direct script access allowed');

class Tagihan_anggota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('pengurus_model', 'pengurus');
        $this->load->model('tagihan_model', 'tagihan');
    }
    //TAGIHAN PENGURUS / ANGGOTA
    public function detail($no_tg = null)
    {
        if ($no_tg == null) {
            notifikasi('Data Tagihan Tidak Ditemukan!!', false);
            redirect(base_url("Tagihan"));
        }
        $id_mj = $_SESSION['id_mj'];
        $tagihan = $this->tagihan->get_tagihan($id_mj, $no_tg);
        if ($tagihan->num_rows() > 0) {
            $tagihan      = $tagihan->row_array();
            $title        = 'Tagihan : ' . $tagihan['nama_tagihan'];
            $jml_pengurus = $this->pengurus->hitung_pengurus($id_mj)['jml_pengurus'];
            $jml_tagihan_anggota = $this->tagihan->jml_ta($no_tg)['jml_ta'];
            $tagihan_anggota     = $this->tagihan->get_tg_anggota($no_tg);

            $this->load->view('dashboard/template/main', [
                'title'         => $title,
                'tagihan'       => $tagihan,
                'assets_css'    => array("themes/vendors/css/tables/datatable/datatables.min.css"),
                'assets_js'     => array("themes/vendors/js/tables/datatable/datatables.min.js"),
                'jml_pengurus'        => $jml_pengurus,
                'jml_tagihan_anggota' => $jml_tagihan_anggota,
                'tagihan_anggota'     => $tagihan_anggota,
                'file'                => 'tagihan_anggota/detail_tagihan',
            ]);
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
        $id_mj  = $_SESSION['id_mj'];
        $tg     = $this->tagihan->get_tagihan($id_mj, $no_tg);
        if ($tg->num_rows() > 0) {
            $pengurus =  $this->pengurus->get_anggota_pengurus($_SESSION['hima_id'], $id_mj);
            $this->load->view('dashboard/template/main', [
                'title'  => 'Buat Tagihan Pengurus',
                'pengurus' => $pengurus,
                'tagihan'    => $tg->row_array(),
                'file'   => 'tagihan_anggota/i_tp',
            ]);
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
                $data_values = array(
                    'id_mahasiswa_pt' => $mhs[$i],     //NPM
                    'no_tg'     => $no_tg,
                    'dibayar'   => '0'
                );
                $this->mydb->input_dt($data_values, 't_tagihan_anggota');
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
            $tagihan = $cek->row_array();

            $npm = (isset($_POST['npm'])) ? $_POST['npm'] : '';
            if ($npm != '') {
                $mhs = json_npm($npm);
                if (empty($mhs['id_mahasiswa_pt'])) {
                    $result = "LOL";
                    notifikasi('Data Mahasiswa Tidak Ditemukan!!', false);
                } else {
                    $result = $mhs;
                    notifikasi('Data Mahasiswa Ditemukan!!', true);
                }
            } else {
                $result = "LOL";
            }

            $this->load->view('dashboard/template/main', [
                'title' => 'Tambah Tagihan Anggota',
                'tagihan' => $tagihan,
                'result'  => $result,
                'file'  => 'tagihan_anggota/i_tmhs',
            ]);
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
            $data_values = array(
                'id_mahasiswa_pt' => $npm,     //NPM
                'no_tg' => $no_tg,
                'dibayar' => '0'
            );
            $this->mydb->input_dt($data_values, 't_tagihan_anggota');
            notifikasi('Tagihan Anggota berhasil dibuat!!!', true);
            redirect(base_url("Tagihan/tg_pengurus/" . $no_tg));
        }
    }
    function delete($no_ta = null)
    {
        if ($no_ta == null) {
            notifikasi('Data Tagihan Tidak Ditemukan!!', false);
            redirect(base_url("Tagihan"));
        }
        $ta = $this->tagihan->get_ta($_SESSION['id_mj'], $no_ta);
        if ($ta->num_rows() > 0) {
            $tagihan = $ta->row_array();
            if ($tagihan['id_mj'] != $_SESSION['id_mj']) {
                notifikasi('Tagihan Anggota tidak bisa dihapus !!', false);
            } else {
                $where = ['no_ta' => $no_ta];
                $this->mydb->del($where, 't_tagihan_anggota');
                $this->mydb->del(['no_tg' => $tagihan['no_tg'], 'id_mahasiswa_pt' => $tagihan['id_mahasiswa_pt']], 't_pembayaran');

                notifikasi('Tagihan Anggota berhasil dihapus!!', true);
            }
            redirect(base_url("Tagihan/tg_pengurus/" . $tagihan['no_tg']));
        } else {
            notifikasi('Data Tagihan Tidak Ditemukan!!', false);
        }
        redirect(base_url("Tagihan"));
    }
}
