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
        $data['title'] = 'Dashboard Admin';
        $data['assets_css'] = array("themes/vendors/css/tables/datatable/datatables.min.css");
        $data['assets_js'] = array("themes/vendors/js/tables/datatable/datatables.min.js");
        $data['admin'] = $this->mydb->get_admin();
        $data['file']   = 'admin/index';
        $this->load->view('template/index', $data);
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
                $data = [
                    'id_mhs' => $mhs['id_mhs'],
                    'id_mahasiswa_pt' => $npm,
                    'is_admin' => '1'
                ];
                $this->mydb->input_dt($data, 't_user');
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
        $data['title'] = 'Manajemen Role';
        $data['tampil'] = $this->db->get('t_role')->result_array();
        $data['file']   = 'admin/role';
        $this->load->view('template/index', $data);
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
            $data['title'] = 'Edit Role';
            $data['col'] = $this->db->get_where('t_role', $where)->row_array();
            $data['file']   = 'admin/e_role';
            $this->load->view('template/index', $data);
        } else {
            $data = [
                'role' => $this->input->post('role')
            ];
            $this->mydb->update_dt($where, $data, 't_role');
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
        $data['title'] = 'Manajemen Controller';
        $data['tampil'] = $this->db->order_by('id_ctr', 'ASC')->get('t_controller')->result_array();
        $data['file']   = 'admin/controller';
        $this->load->view('template/index', $data);
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
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Controller';
            $data['col'] = $this->db->get_where('t_controller', $where)->row_array();
            $data['file']   = 'admin/e_controller';
            $this->load->view('template/index', $data);
        } else {
            $data = [
                'nama_controller' => $this->input->post('controller'),
                'fitur' => $this->input->post('fitur')
            ];
            $this->mydb->update_dt($where, $data, 't_controller');
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
        $data['col'] = $this->db->get_where('t_role', ['level' => $level])->row_array();
        $data['title'] = 'Akses Menu : ' . $data['col']['role'];
        $data['tampil'] = $this->db->get('t_controller')->result_array();
        $data['file']   = 'admin/menu_access';
        $this->load->view('template/index', $data);
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

        if ($result->num_rows() < 1) {
            $this->db->insert('t_menu_access', $data);
        } else {
            $this->db->delete('t_menu_access', $data);
        }

        notifikasi('Akses Berhasil Di ubah!!!', true);
    }
    //JABATAN
    public function jabatan()
    {
        $data['title'] =  "Jabatan";
        $data['assets_css'] = array("themes/vendors/css/tables/datatable/datatables.min.css");
        $data['assets_js'] = array("themes/vendors/js/tables/datatable/datatables.min.js");
        $data['tampil'] = $this->mydb->get_jabatan_hima();
        $data['file']   = 'jabatan/index';
        $this->load->view('template/index', $data);
    }
    function del_jabatan($id_jabatan)   //HAPUS JABATAN
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
    public function e_jabatan($id_jabatan = null) //EDIT JABATAN
    {
        if ($id_jabatan == null) {
            notifikasi('Gagal Mengakses Halaman Edit Jabatan !!!', false);
            redirect('Dashboard');
        }
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required|trim', [
            'required' => 'Nama Jabatan tidak boleh kosong'
        ]);
        if ($this->form_validation->run() == false) {
            $data['title'] =  "Edit Jabatan";
            $data['col'] = $this->db->get_where('t_jabatan', ['id_jabatan' => $id_jabatan])->row_array();
            $data['file']   = 'jabatan/e_jabatan';
            $this->load->view('template/index', $data);
        } else {
            $data_edit = [
                'jabatan' => $this->input->post('jabatan')
            ];
            $where = ['id_jabatan' => $id_jabatan];
            $this->mydb->update_dt($where, $data_edit, 't_jabatan');
            notifikasi('Edit Jabatan Berhasil!!!', true);
            redirect(base_url("Admin/jabatan"));
        }
    }
    //ICON MENU
    public function icon()
    {
        $data['title']    = 'IKON!!!!';
        $data['file']   = 'admin/ikon';
        $this->load->view('template/index', $data);
    }
}
