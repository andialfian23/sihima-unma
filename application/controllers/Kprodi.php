<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kprodi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('post_model');
        $this->load->model('MJ_model');
        $this->load->model('pengurus_model');
        $this->load->model('kegiatan_model');
    }
    public function index()
    {
        redirect(base_url("Dashboard"));
    }
    // AKTIF or NON AKTIF MASA JABATAN HIMA
    public function is_active($id_mj)
    {
        $status = $this->uri->segment('4');
        $where = ['id_mj' => $id_mj];
        $data = ['status_mj' => $status];
        //CEK MASA JABATAN
        if ($_SESSION['role_id'] != 1) {
            $where = ['id_mj' => $id_mj, 'id_hima' => $_SESSION['hima_id']];
        }
        $cek_mj = $this->db->get_where('t_masa_jabatan', ['id_mj' => $id_mj]);
        if ($cek_mj->num_rows() > 0) {
            $mj = $cek_mj->row_array();
            $periode = $mj['periode1'] . '/' . $mj['periode2'];

            //CEK MASA JABATAN YANG MASIH AKTIF
            $cek_aktif = $this->db->get_where('t_masa_jabatan', ['id_hima' => $mj['id_hima'], 'status_mj' => '1']);
            if ($cek_aktif->num_rows() > 0) {
                $mj_aktif = $cek_aktif->row_array();
                //MENGUBAH status MASA JABATAN YANG Masih AKTIF Jadi NON-AKTIF
                $data1 = ['status_mj' => '0'];
                $where1 = ['id_mj' => $mj_aktif['id_mj']];
                $this->mydb->update_dt($where1, $data1, 't_masa_jabatan');
            }

            //MENGUBAH SESSION 
            if ($_SESSION['role_id'] != '1') {
                $_SESSION['id_mj'] = $id_mj;
                $_SESSION['per_jabatan'] = $periode;
            }

            //MENGUBAH status MASA JABATAN 
            $this->mydb->update_dt($where, $data, 't_masa_jabatan');

            $notif = ($status == '1') ? 'Aktifkan !!!' : 'Non-Aktifkan !!!';
            notifikasi('Masa Jabatan ' . $periode . ' berhasil di ' . $notif, true);
            redirect(base_url('Dashboard/himpunan/' . $mj['id_hima']));
        } else {
            notifikasi('Data tidak ditemukan', false);
            redirect(base_url('Kprodi/himpunan'));
        }
    }
    //Anggota Pengurus
    public function pengurus($id_mj = null)
    {
        if ($id_mj != null) {
            $id_mj = (!empty($id_mj)) ? $id_mj : $_SESSION['id_mj'];
            $masa_jabatan = $this->MJ_model->get_masa_periode($id_mj);
            if (($masa_jabatan->num_rows() > 0)) {
                $mj = $masa_jabatan->row_array();
                $id_hima = $mj['id_hima'];
            } else {
                notifikasi('Data anggota tidak ditemukan', false);
                redirect(base_url('Dashboard'));
            }
            $periode = $mj['periode'];
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
            'tampil'     => $penguruss,
            'masa_jabatans' => $masa_jabatans,
            'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
            'assets_js'  => array("themes/vendors/js/tables/datatable/datatables.min.js"),
            'file'       => 'pengurus/index',
        ]);
    }
    //Anggota Lainnya
    public function anggota()
    {
        $this->load->view('dashboard/template/main', [
            'title'      => 'Anggota Lainnya ',
            'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
            'assets_js'  => array("themes/vendors/js/tables/datatable/datatables.min.js"),
            'file'       => 'mahasiswa',
        ]);
    }
    public function kegiatan($segment_id_mj = null)
    {
        $id_mj          = (!empty($segment_id_mj)) ? $segment_id_mj : $_SESSION['id_mj'];
        $mj             = $this->MJ_model->get_masa_periode($id_mj)->row_array();
        $periode        = (!empty($segment_id_mj)) ? $mj['periode'] : $_SESSION['per_jabatan'];
        $masa_jabatan   = $this->MJ_model->kahim($id_mj);
        $kegiatan       = $this->kegiatan_model->get_kegiatan($mj['id_mj']);

        $this->load->view('dashboard/template/main', [
            'title'      => 'Kegiatan ' . $_SESSION['singkatan'] . ' ' . $periode,
            'id_mj'      => $mj['id_mj'],
            'kahim'      => $masa_jabatan,
            'periode'    => $periode,
            'link'       => 'Kprodi/kegiatan',
            'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
            'assets_js'  => array("themes/vendors/js/tables/datatable/datatables.min.js"),
            'kegiatan'   => $kegiatan,
            'file'       => 'kegiatan/index2',
        ]);
    }
    public function postingan()
    {
        $posts = $this->post_model->get_postingan($_SESSION['id_mj']);
        $this->load->view('dashboard/template/main', [
            'title'      => 'Postingan Pengurus',
            'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
            'assets_js'  => array("themes/vendors/js/tables/datatable/datatables.min.js"),
            'posts'      => $posts,
            'file'       => 'post/index',
        ]);
    }
}
