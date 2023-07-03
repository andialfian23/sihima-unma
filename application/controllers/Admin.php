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
    //ROLE
    public function role()
    {
        $role = $this->db->get('t_role')->result_array();
        $this->load->view('dashboard/template/main', [
            'title'  => 'Manajemen Role',
            'tampil' => $role,
            'file'   => 'admin/role',
        ]);
    }
    public function i_role()
    {
        $level = $this->input->post('level');
        $role  = $this->input->post('role');
        if (($level != null) && ($role != null)) {
            if ($this->db->get_where('t_role', ['level' => $level])->num_rows() > 0) {
                echo 'Nama controller sudah ada';
            } else {
                $this->db->insert('t_role', [
                    'level' => $this->input->post('level'),
                    'role' => $this->input->post('role')
                ]);
                echo '1';
            }
        } else {
            notifikasi('Gagal dalam menambah role baru !!!', true);
            redirect(base_url('Admin/role'));
        }
    }
    public function e_role()
    {
        $where = ['level' => $this->uri->segment('3')];
        $this->form_validation->set_rules('role', 'Role', 'required|trim', [
            'required' => 'Nama Role tidak boleh kosong !!'
        ]);
        if ($this->form_validation->run() == false) {
            $role = $this->db->get_where('t_role', $where)->row_array();
            $this->load->view('dashboard/template/main', [
                'title' => 'Edit Role',
                'col'   => $role,
                'file'  => 'admin/e_role',
            ]);
        } else {
            $set = [
                'role' => $this->input->post('role')
            ];
            $this->mydb->update_dt($where, $set, 't_role');
            notifikasi('Nama Role Berhasil Diubah', true);
            redirect(base_url('Admin/role'));
        }
    }
    // function del_role()
    // {
    //     $where = ['level' => $this->uri->segment('3')];
    //     $this->mydb->del($where, 't_role');
    //     notifikasi('Role Berhasil Dihapus', true);
    //     redirect(base_url('Admin/role'));
    // }
    //CONTROLLER MANAJEMEN
    public function controller()
    {
        $controller = $this->db->order_by('id_ctr', 'ASC')->get('t_controller')->result_array();
        $this->load->view('dashboard/template/main', [
            'tampil' => $controller,
            'title'  => 'Manajemen Controller',
            'file'   => 'admin/controller',
        ]);
    }
    public function i_ctr()
    {
        $controller = $this->input->post('controller');
        $fitur      = $this->input->post('fitur');
        if (($controller != null) && ($fitur != null)) {
            if ($this->db->get_where('t_controller', ['nama_controller' => $controller])->num_rows() > 0) {
                echo 'Nama controller sudah ada';
            } else {
                $this->db->insert('t_controller', [
                    'nama_controller' => $this->input->post('controller'),
                    'fitur' => $this->input->post('fitur')
                ]);
                echo '1';
            }
        } else {
            notifikasi('Gagal dalam menambah controller baru !!!', true);
            redirect(base_url('Admin/controller'));
        }
    }
    public function e_ctr()
    {
        $where = ['id_ctr' => $this->uri->segment('3')];
        $this->form_validation->set_rules('controller', 'Controller', 'required|trim', [
            'required' => 'Nama Controller tidak boleh kosong !!'
        ]);
        $this->form_validation->set_rules('fitur', 'Fitur', 'required|trim', [
            'required' => 'Fitur Controller tidak boleh kosong !!'
        ]);
        $controller = $this->db->get_where('t_controller', $where)->row_array();
        if ($this->form_validation->run() == false) {

            $this->load->view('dashboard/template/main', [
                'title' => 'Edit Controller',
                'col'   => $controller,
                'file'  => 'admin/e_controller',
            ]);
        } else {
            $values = [
                'nama_controller' => $this->input->post('controller'),
                'fitur' => $this->input->post('fitur')
            ];
            $this->mydb->update_dt($where, $values, 't_controller');
            notifikasi('Data Controller Berhasil Diubah', true);
            redirect(base_url('Admin/controller'));
        }
    }
    function del_ctr()
    {
        $where = ['id_ctr' => $this->uri->segment('3')];
        $this->mydb->del($where, 't_controller');
        notifikasi('Controller Berhasil Dihapus', true);
        redirect(base_url('Admin/controller'));
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
    //JABATAN
    public function jabatan()
    {
        $this->load->view('dashboard/template/main', [
            'title'     =>  "Jabatan",
            'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
            'assets_js' => array("themes/vendors/js/tables/datatable/datatables.min.js"),
            'tampil'    => $this->mydb->get_jabatan_hima(),
            'file'      => 'jabatan/index',
        ]);
    }
    public function e_jabatan($id_jabatan = null)   //EDIT JABATAN
    {
        if ($id_jabatan == null) {
            notifikasi('Gagal Mengakses Halaman Edit Jabatan !!!', false);
            redirect('Dashboard');
        }
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required|trim', [
            'required' => 'Nama Jabatan tidak boleh kosong'
        ]);
        $where = ['id_jabatan' => $id_jabatan];
        if ($this->form_validation->run() == false) {
            $jabatan = $this->db->get_where('t_jabatan', $where)->row_array();
            $this->load->view('dashboard/template/main', [
                'title'     => "Edit Jabatan",
                'jabatan'   => $jabatan,
                'file'      => 'jabatan/e_jabatan',
            ]);
        } else {
            $set = [
                'jabatan' => $this->input->post('jabatan')
            ];
            $this->mydb->update_dt($where, $set, 't_jabatan');
            notifikasi('Edit Jabatan Berhasil!!!', true);
            redirect(base_url("Admin/jabatan"));
        }
    }
    function del_jabatan($id_jabatan = null)    //HAPUS JABATAN
    {
        if ($id_jabatan == null) {
            notifikasi('Gagal Mengakses Halaman Hapus Jabatan !!!', false);
            redirect('Dashboard');
        }
        $jabatan = $this->db->get_where('t_jabatan', ['id_jabatan' => $id_jabatan]);
        if ($jabatan->num_rows() > 0) {
            $where = array('id_jabatan' => $id_jabatan);
            $this->mydb->del($where, 't_jabatan');
            notifikasi('Jabatan berhasil dihapus!!', true);
        } else {
            notifikasi('Tidak Ada jabatan yang dipilih!!', false);
        }
        redirect(base_url("Admin/jabatan"));
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
