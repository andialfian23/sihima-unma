<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    var $table = 't_mahasiswa';

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('auth_model', 'user');
    }

    public function main()
    {
        $admins = $this->user->get_admin()->result_array();
        $this->load->view('dashboard/template/main', [
            'title'     => 'Dashboard Admin',
            'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
            'assets_js' => array("themes/vendors/js/tables/datatable/datatables.min.js"),
            'admins'     => $admins,
            'file'      => 'admin/index_adm',
        ]);
    }
    public function search()
    {
        $npm = $_POST['npm'];
        if ($npm != null) {
            $api_mhs = $this->curl->simple_get(ADD_API . 'simak/mahasiswa_pt?id_mahasiswa_pt=' . $npm);
            if ($api_mhs != null) {
                $mhs = [];
                $mhs = json_decode($api_mhs, true)[0];
                $cek_admin = $this->user->get_admin($mhs['id_mahasiswa_pt'])->num_rows();
                if ($cek_admin > 0) {
                    $result = [
                        'kode' => '0',
                        'pesan' => 'Mahasiswa ini sudah menjadi Admin',
                    ];
                } else {
                    $result = [
                        'kode' => '1',
                        'pesan' => $mhs,
                    ];
                }
            } else {
                $result = [
                    'kode' => '0',
                    'pesan' => 'Data Mahasiswa tidak Ditemukan',
                ];
            }
        } else {
            $result = [
                'kode' => '0',
                'pesan' => 'NPM masih kosong',
            ];
        }
        echo json_encode($result);
    }
    public function insert()
    {
        $npm = $_POST['npm'];
        if ($npm != null) {
            $where = ['id_mahasiswa_pt' => $npm];
            $cek_user = $this->db->get_where($this->table, $where);
            if ($cek_user->num_rows() > 0) {
                $user = $cek_user->row_array();
                if ($user['is_admin'] == '1') {
                    $result = [
                        'kode' => '0',
                        'pesan' => 'Mahasiswa telah menjadi Admin',
                    ];
                } else {
                    $set = ['is_admin' => '1'];
                    $this->mydb->update_dt($where, $set, $this->table);
                    $result = [
                        'kode' => '1',
                        'pesan' => 'Berhasil menjadikan Admin ',
                    ];
                }
            } else {
                $mhs = json_npm($npm);
                $values = [
                    'id_mhs' => $mhs['id_mhs'],
                    'id_mahasiswa_pt' => $npm,
                    'is_admin' => '1'
                ];
                $this->mydb->input_dt($values, $this->table);
                $result = [
                    'kode' => '1',
                    'pesan' => 'Berhasil menambahkan ' . $mhs['nm_pd'] . ' menjadi Admin',
                ];
            }
        } else {
            $result = [
                'kode' => '0',
                'pesan' => 'Gagal menambahkan admin',
            ];
        }
        echo json_encode($result);
    }
    public function delete()
    {
        $id = $_POST['id'];
        if ($id == null) {
            $result = [
                'kode' => '0',
                'pesan' => 'Gagal Menghapus Admin',
            ];
        } else {
            $where = ['id' => $id];
            $cek_user = $this->db->get_where($this->table, $where);
            if ($cek_user->num_rows() > 0) {
                $set = ['is_admin' => '0'];
                $this->mydb->update_dt($where, $set, $this->table);
                $nama = json_row($cek_user->row_array()['id_mhs'])['nm_pd'];
                $result = [
                    'kode' => '1',
                    'pesan' => 'Berhasil Menghapus Admin ' . $nama,
                ];
            } else {
                $result = [
                    'kode' => '0',
                    'pesan' => 'Data User Tidak Ditemukan',
                ];
            }
        }
        echo json_encode($result);
    }

    //ICON MENU
    public function icon()
    {
        $this->load->view('dashboard/template/main', [
            'title' => 'IKON !!!',
            'file'  => 'admin/ikon',
        ]);
    }
}
