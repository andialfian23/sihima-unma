<?php defined('BASEPATH') or exit('No direct script access allowed');

class Tagihan_anggota extends CI_Controller
{
    var $table = 't_tagihan_anggota';

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('pengurus_model', 'pengurus');
        $this->load->model('tagihan_model', 'tagihan');
    }

    // VIEW TAGIHAN PENGURUS / ANGGOTA
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

            // echo $this->db->last_query();
            // die;
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

    // VIEW INPUT TAGIHAN ANGGOTA PENGURUS
    public function i_tp($no_tg = null)   //input tagihan pengurus
    {
        if ($no_tg == null) {
            notifikasi('Data Tagihan Tidak Ditemukan!!', false);
            redirect(base_url("Tagihan"));
        }
        $id_mj  = $_SESSION['id_mj'];
        $tg     = $this->tagihan->get_tagihan($id_mj, $no_tg);
        if ($tg->num_rows() > 0) {
            $penguruss =  $this->tagihan->get_anggota_pengurus($id_mj, $no_tg);
            $this->load->view('dashboard/template/main', [
                'title'  => 'Buat Tagihan Pengurus',
                'penguruss' => $penguruss->result_array(),
                'tagihan'    => $tg->row_array(),
                'file'   => 'tagihan_anggota/i_tp',
            ]);
        } else {
            notifikasi('Data Tagihan Tidak Ditemukan!!', false);
            redirect(base_url("Tagihan"));
        }
    }

    // VIEW INPUT TAGIHAN ANGGOTA LAINNYA
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

    // PROSES INPUT TAGIHAN ANGGOTA
    public function insert()
    {
        $no_tg = (!empty($_POST['no_tg'])) ? post_gan('no_tg') : null;
        $jenis = (!empty($_POST['jenis'])) ? post_gan('jenis') : null;
        $id_mahasiswa_pt = (!empty($_POST['id_mhs'])) ? post_gan('id_mhs') : null;

        if (($no_tg == null) || ($id_mahasiswa_pt == null) || ($jenis == null)) {
            notifikasi('Gagal menambahkan data tagihan Anggota!!!', false);
            redirect(base_url("Tagihan/i_tp/" . $no_tg));
        } else {
            if ($jenis == 'Pengurus') {
                $ttl = count($id_mahasiswa_pt);
                for ($i = 0; $i < $ttl; $i++) {
                    $data_values = array(
                        'id_mahasiswa_pt' => $id_mahasiswa_pt[$i],     //NPM
                        'no_tg'     => $no_tg,
                        'created_at' => date('Y-m-d H:i:s'),
                    );
                    $this->mydb->input_dt($data_values, $this->table);
                }
            } else {
                $data_values = array(
                    'id_mahasiswa_pt' => $id_mahasiswa_pt,     //NPM
                    'no_tg'     => $no_tg,
                    'created_at' => date('Y-m-d H:i:s'),
                );
                $this->mydb->input_dt($data_values, $this->table);
            }
            notifikasi('Penambahan Tagihan Anggota Berhasil!!!', true);
            redirect(base_url("Tagihan_anggota/detail/" . $no_tg));
        }
    }

    // PROSES DELETE TAGIHAN ANGGOTA
    public function delete($no_ta = null)
    {
        if ($no_ta == null) {
            notifikasi('Data Tagihan Tidak Ditemukan!!', false);
            redirect(base_url("Tagihan"));
        }

        $ta = $this->tagihan->get_ta($_SESSION['id_mj'], $no_ta);
        if ($ta->num_rows() > 0) {
            $tagihan = $ta->row_array();

            $where = ['no_ta' => $no_ta];
            $this->mydb->del($where, $this->table);
            $this->mydb->del($where, 't_pembayaran');

            notifikasi('Tagihan Anggota berhasil dihapus!!', true);
            redirect(base_url("Tagihan_anggota/detail/" . $tagihan['no_tg']));
        } else {
            notifikasi('Data Tagihan Tidak Ditemukan!!', false);
            redirect(base_url("Tagihan"));
        }
    }
}
