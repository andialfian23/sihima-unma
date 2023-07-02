<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Himpunan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    // ADMIN
    public function index()
    {
        if ($_SESSION['role_id'] == '1') {
            $himpunan = $this->db->get('t_hima')->result_array();
            $this->load->view('dashboard/template/main', [
                'title'      => 'Himpunan Mahasiswa',
                'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
                'assets_js'  => array("themes/vendors/js/tables/datatable/datatables.min.js"),
                'tampil'     => $himpunan,
                'file'       => 'hima/index',
            ]);
        } else {
            notifikasi('Anda Tidak Memiliki Hak Akses Ke Halaman Tersebut !!!', true);
            redirect(base_url('Dashboard'));
        }
    }
    public function i_hima()
    {
        if ($_SESSION['role_id'] == '1') {
            $this->form_validation->set_rules('kode_fak', 'kode_fak', 'required|trim', [
                'required' => 'Kode Fakultas tidak boleh kosong !!'
            ]);
            $this->form_validation->set_rules('kode_prodi', 'kode_prodi', 'required|trim|is_unique[t_hima.kode_prodi]', [
                'required' => 'Kode Prodi tidak boleh kosong !!',
                'is_unique' => 'Kode Prodi sudah digunakan !!'
            ]);
            $this->form_validation->set_rules('singkatan', 'singkatan', 'required|trim|is_unique[t_hima.singkatan]', [
                'required' => 'Singkatan Himpunan tidak boleh kosong !!',
                'is_unique' => 'Singkatan Himpunan sudah digunakan !!'
            ]);
            $this->form_validation->set_rules('nama_hima', 'nama_hima', 'required|trim|is_unique[t_hima.nama_hima]', [
                'required' => 'Nama Himpunan tidak boleh kosong !!',
                'is_unique' => 'Nama Himpunan sudah digunakan !!'
            ]);
            if ($this->form_validation->run() == false) {
                $this->load->view('dashboard/template/main', [
                    'title' => 'Tambah Himpunan Mahasiswa',
                    'file'  => 'hima/i_hima',
                ]);
            } else {
                $logo = $_FILES['logo']['name'];
                if ($logo) {
                    $config['upload_path']   = './images/logo';
                    $config['allowed_types'] = 'jpg|png';
                    $config['max_size']      = '5048';
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('logo')) {
                        $logo = $this->upload->data('file_name');
                    } else {
                        notifikasi($this->upload->display_errors(), false);
                        redirect(base_url("Himpunan/i_hima/"));
                    }
                } else {
                    $logo = null;
                }
                $values = [
                    'kode_fak'   => $this->input->post('kode_fak'),
                    'kode_prodi' => $this->input->post('kode_prodi'),
                    'singkatan' => $this->input->post('singkatan'),
                    'nama_hima' => $this->input->post('nama_hima'),
                    'logo'      => $logo,
                    'tempat_sekre' => $this->input->post('tempat_sekre')
                ];
                $this->mydb->input_dt($values, 't_hima');
                notifikasi('Himpunan Baru Berhasil Ditambahkan', true);
                redirect(base_url('Himpunan/index'));
            }
        } else {
            notifikasi('Anda Tidak Memiliki Hak Akses Ke Halaman Tersebut !!!', true);
            redirect(base_url('Dashboard'));
        }
    }
    function del_hima($id_hima)
    {
        if ($_SESSION['role_id'] == '1') {
            $hima = $this->db->get_where('t_hima', ['id_hima' => $id_hima]);
            if ($hima->num_rows() > 0) {
                $this->mydb->del(['id_hima' => $id_hima], 't_hima');
                notifikasi('Himpunan berhasil dihapus!!', true);
                redirect(base_url("Admin/hima"));
            } else {
                notifikasi('Tidak Ada data himpunan yang dipilih!!', false);
                redirect(base_url("Admin/hima"));
            }
        } else {
            notifikasi('Anda Tidak Memiliki Hak Akses Ke Halaman Tersebut !!!', true);
            redirect(base_url('Dashboard'));
        }
    }
    public function is_active_hima()
    {
        if ($_SESSION['role_id'] == '1') {
            $id_hima = $this->input->post('id_hima');
            $status  = $this->input->post('status_hima');
            if (($id_hima != null) && ($status != null)) {
                // if (($id_hima != $_SESSION['hima_id']) && ($_SESSION['role_id'] != '1')) {
                //     notifikasi('Anda Tidak Memiliki Hak Akses Ke Halaman Tersebut !!!', true);
                //     redirect(base_url('Dashboard'));
                // } else {
                $where   = ['id_hima' => $id_hima];
                $nama_hima = $this->db->get_where('t_hima', $where)->row_array()['singkatan'];
                $data = [
                    'status_hima' =>  $status
                ];
                $this->mydb->update_dt($where, $data, 't_hima');
                echo ($status == '1') ?
                    'Data ' . $nama_hima . ' Berhasil Di Aktifkan !!!'
                    : 'Data ' . $nama_hima . ' Berhasil Di Non-aktifkan!!!';
                // }
            } else {
                notifikasi("Data himpunan tidak ditemukan", false);
                redirect(base_url('Himpunan/index'));
            }
        } else {
            notifikasi('Anda Tidak Memiliki Hak Akses Ke Halaman Tersebut !!!', true);
            redirect(base_url('Dashboard'));
        }
    }
    // KETUA / WAKIL KETUA HIMA
    public function status_hima($status = null, $id_hima = null)
    {
        if (($id_hima == null) && ($status == null)) {
            notifikasi('Data himpunan tidak diketahui!!!', false);
            redirect(base_url("Dashboard"));
        } else {
            if ($_SESSION['role_id'] == '1') {
                $page = 'Himpunan/index';
            } else {
                $page = 'Dashboard/himpunan';
                $id_hima = $_SESSION['hima_id'];
            }

            $where   = ['id_hima' => $id_hima];
            $hima = $this->db->get_where('t_hima', $where);
            if ($hima->num_rows() > 0) {
                $set = [
                    'status_hima' =>  $status
                ];
                $this->mydb->update_dt($where, $set, 't_hima');
                $nama_hima = $hima->row_array()['singkatan'];
                $notif = ($status == '1') ?
                    'Data ' . $nama_hima . ' Berhasil Di Aktifkan !!!'
                    : 'Data ' . $nama_hima . ' Berhasil Di Non-aktifkan!!!';
                notifikasi($notif, true);
                redirect(base_url($page));
            } else {
                notifikasi('Data himpunan tidak ditemukan!!!', false);
                redirect(base_url("Dashboard"));
            }
        }
    }
    public function e_hima($id_hima = null)
    {
        if ($id_hima == null) {
            notifikasi('Data Himpunan Tidak Ditemukan', false);
            redirect(base_url('Dashboard'));
        }
        $id_hima = ($_SESSION['role_id'] == '1') ? $id_hima : $_SESSION['hima_id'];
        $this->form_validation->set_rules('singkatan', 'singkatan', 'required|trim', [
            'required' => 'Singkatan Himpunan tidak boleh kosong !!'
        ]);
        $this->form_validation->set_rules('nama_hima', 'nama_hima', 'required|trim', [
            'required' => 'Nama Himpunan tidak boleh kosong !!'
        ]);

        $himpunan = $this->db->get_where('t_hima', ['id_hima' => $id_hima])->row_array();
        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/template/main', [
                'col'   => $himpunan,
                'title' => 'Edit Data Himpunan',
                'file'  => 'hima/e_hima',
            ]);
        } else {
            $where = ['id_hima' => $id_hima];
            $logo = $_FILES['logo']['name'];
            if ($logo) {
                $config['upload_path'] = './images/logo';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size']     = '5048';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('logo')) {
                    $logo = $this->upload->data('file_name');
                    $this->mydb->update_dt($where, ['logo' => $logo], 't_hima');
                    unlink(FCPATH . 'images/logo/' . $himpunan['logo']); //cover
                } else {
                    notifikasi($this->upload->display_errors(), false);
                    redirect(base_url("Himpunan/e_hima/" . $himpunan['id_hima']));
                }
            }
            $singkatan = post_gan('singkatan');
            $nama_hima = post_gan('nama_hima');
            $sekretariat = post_gan('tempat_sekre');
            if ($_SESSION['role_id'] == '1') {
                $set = [
                    'kode_prodi' => post_gan('kode_prodi'),
                    'kode_fak' => post_gan('kode_fak'),
                    'singkatan' => $singkatan,
                    'nama_hima' => $nama_hima,
                    'tempat_sekre' => $sekretariat
                ];
            } else {
                $set = [
                    'singkatan' => $singkatan,
                    'nama_hima' => $nama_hima,
                    'tempat_sekre' => $sekretariat
                ];
                $_SESSION['singkatan'] = $singkatan;
            }
            $this->mydb->update_dt($where, $set, 't_hima');
            notifikasi('Data Himpunan Berhasil Di Update', true);
            redirect(base_url('Dashboard/himpunan/' . $id_hima));
        }
    }
    //CONTACT PERSON
    public function add_cp()
    {
        $this->form_validation->set_rules('nama_contact', 'nama_contact', 'required|trim', [
            'required' => 'Nama Kontak tidak boleh kosong !!'
        ]);
        $this->form_validation->set_rules('no_telp', 'no_telp', 'required|trim|numeric', [
            'required' => 'Nomor Telepon tidak boleh kosong !!',
            'numeric' => 'Nomor Telepon harus berupa numeric / bilangan'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/template/main', [
                'title' => 'Tambah Kontak yang dapat dihubungi',
                'file'  => 'hima/i_contact_person',
            ]);
        } else {
            if ($_SESSION['role_id'] == '1') {
                $id_hima = post_gan('id_hima');
                $url = 'Dashboard/himpunan/' . $id_hima;
            } else {
                $id_hima = $_SESSION['hima_id'];
                $url = 'Dashboard/himpunan';
            }
            $data = [
                'id_hima' => $id_hima,
                'nama_contact' => post_gan('nama_contact'),
                'no_telp' => post_gan('no_telp')
            ];
            $this->mydb->input_dt($data, 't_contact_person');
            notifikasi('Data Himpunan Berhasil Di Update', true);
            redirect(base_url($url));
        }
    }
    public function del_cp($id_cp = null)
    {
        if ($id_cp == null) {
            notifikasi('Mohon maaf terjadi kesalahan penulisan URL', false);
        }
        $where = array('id_cp' => $id_cp, 'id_hima' => $_SESSION['hima_id']);
        $cek = $this->db->get_where('t_contact_person', $where);
        if ($cek->num_rows() > 0) {
            $this->mydb->del($where, 't_contact_person');
            notifikasi('Data Contact Person berhasil dihapus!!', true);
        } else {
            notifikasi('Data Contact Person Tidak Ditemukan!!', false);
        }
        redirect(base_url('Dashboard/himpunan'));
    }
}
