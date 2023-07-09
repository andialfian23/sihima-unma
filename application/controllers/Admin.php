<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $admin = $this->mydb->get_admin();
        $this->load->view('dashboard/template/main', [
            'title'     => 'Dashboard Admin',
            'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
            'assets_js' => array("themes/vendors/js/tables/datatable/datatables.min.js"),
            'admin'     => $admin,
            'file'      => 'admin/index',
        ]);
    }
    public function cari_data()
    {
        header('Content-type: application/json');
        $npm = $_POST['npm'];
        if ($npm != null) {
            $mhs = json_npm($npm);
            if (empty($mhs['nm_pd'])) {
                print_r('0');
            } else {
                $cek_admin = $this->mydb->get_admin($mhs['id_mahasiswa_pt']);
                if ($cek_admin->num_rows() > 0) {
                    print_r('1');
                } else {
                    print_r(json_encode($mhs));
                }
            }
        } else {
            return false;
        }
    }
    public function add_admin()
    {
        $npm = $_POST['npm'];
        if ($npm != null) {
            //CEK DATA USER
            $cek_user = $this->db->get_where('t_user', ['id_mahasiswa_pt' => $npm]);
            if ($cek_user->num_rows() > 0) {
                $user = $cek_user->row_array();
                if ($user['is_admin'] == '1') {
                    notifikasi('Mahasiswa telah menjadi Admin', false);
                } else {
                    $set = ['is_admin' => '1'];
                    $where = ['id_mahasiswa_pt' => $npm];
                    $this->mydb->update_dt($where, $set, 't_user');
                    notifikasi('Berhasil menjadikan Admin ', true);
                }
            } else {
                $mhs = json_npm($npm);
                $values = [
                    'id_mhs' => $mhs['id_mhs'],
                    'id_mahasiswa_pt' => $npm,
                    'is_admin' => '1'
                ];
                $this->mydb->input_dt($values, 't_user');
                notifikasi('Berhasil menambahkan ' . $mhs['nm_pd'] . ' menjadi Admin', true);
            }
        } else {
            notifikasi('Gagal menambahkan admin', false);
        }
        redirect(base_url('Admin/index'));
    }
    public function del_admin($id = null)
    {
        if ($id == null) {
            notifikasi('Gagal menghapus admin', false);
        } else {
            $cek_user = $this->db->get_where('t_user', ['id' => $id]);
            if ($cek_user->num_rows() > 0) {
                $set = ['is_admin' => '0'];
                $where = ['id' => $id];
                $this->mydb->update_dt($where, $set, 't_user');
                notifikasi('Berhasil menghapus admin ' . json_row($cek_user->row_array()['id_mhs'])['nm_pd'], true);
            }
        }
        redirect(base_url('Admin'));
    }
    //MENU AKSES
    public function menu_access($level = null)
    {
        if ($level == null) {
            notifikasi('Pilih role yang akan anda cek !!!', false);
            redirect(base_url('admin/role'));
        }
        $role       = $this->db->get_where('t_role', ['level' => $level])->row_array();
        $controller = $this->db->get('t_controller')->result_array();

        $this->load->view('dashboard/template/main', [
            'col'    => $role,
            'title'  => 'Akses Menu : ' . $role['role'],
            'tampil' => $controller,
            'file'   => 'admin/menu_access',
        ]);
    }
    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'level' => $role_id,
            'id_ctr' => $menu_id
        ];

        $result = $this->db->get_where('t_menu_access', $data);

        ($result->num_rows() < 1)
            ? $this->db->insert('t_menu_access', $data)
            : $this->db->delete('t_menu_access', $data);


        notifikasi('Akses Berhasil Di ubah!!!', true);
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
