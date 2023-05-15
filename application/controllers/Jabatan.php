<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('MJ_model');
        $this->load->model('pengurus_model');
    }
    public function index()
    {
        redirect(base_url("Jabatan/i_mj"));
    }
    public function i_mj()  //INPUT MASA JABATAN
    {
        $this->form_validation->set_rules('periode1', 'periode', 'required|trim', [
            'required' => 'Periode tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('periode2', 'periode', 'required|trim', [
            'required' => 'Periode tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('sk', 'sk', 'trim');
        $this->form_validation->set_rules('tgl_awal', 'tgl_awal', 'trim');
        $this->form_validation->set_rules('tgl_akhir', 'tgl_akhir', 'trim');
        if ($this->form_validation->run() == false) {
            $data['title'] =  "Tambah Masa Jabatan";
            $data['file']   = 'jabatan/i_mj';
            $this->load->view('template/index', $data);
        } else {
            $id_hima = ($_SESSION['role_id'] == '1') ? post_gan('hima') : $_SESSION['hima_id'];

            $cek_status = $this->db->get_where('t_masa_jabatan', ['id_hima' => $id_hima, 'status_mj' => '1']);

            $status = ($cek_status->num_rows() > 0) ? "0" : "1";
            $sk = $_FILES['sk']['name'];
            if ($sk) {
                $config['upload_path'] = './assets/sk';
                $config['allowed_types'] = 'pdf';
                $config['max_size']     = '5048';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('sk')) {
                    $sk = $this->upload->data('file_name');
                } else {
                    notifikasi($this->upload->display_errors(), false);
                    redirect(base_url("Jabatan/i_mj"));
                }
            } else {
                $sk = '';
            }
            $value = array(
                'id_hima' => $id_hima,
                'periode1' => $this->input->post('periode1'),
                'periode2' => $this->input->post('periode2'),
                'tgl_awal' => $this->input->post('tgl_awal'),
                'tgl_akhir' => $this->input->post('tgl_akhir'),
                'sk' => $sk,
                'status_mj' => $status
            );
            $this->mydb->input_dt($value, 't_masa_jabatan');
            $id_mj = $this->db->insert_id();
            $value2 = ['id_mj' => $id_mj, 'id_mahasiswa_pt' => post_gan('npm'), 'id_jabatan' => '2'];
            $this->mydb->input_dt($value2, 't_pengurus');

            notifikasi('Masa Jabatan Baru Berhasil dibuat!!!', true);
            if ($_SESSION['role_id'] == '2') {
                redirect(base_url("Kprodi/himpunan"));
            } else {
                $hima = ($_SESSION['role_id'] == '1') ? '/' . $id_hima : '';
                redirect(base_url("Dashboard/himpunan/" . $hima));
            }
        }
    }
    public function e_mj($id_mj)  //EDIT MASA JABATAN
    {
        $mj = $this->db->get_where('t_masa_jabatan', ['id_mj' => $id_mj, 'status_mj' => '1']);
        if ($mj->num_rows() > 0) {
            $data['col'] = $mj->row_array();
            $this->form_validation->set_rules('periode1', 'periode1', 'required|trim', [
                'required' => 'Periode tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('periode2', 'periode2', 'required|trim', [
                'required' => 'Periode tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('tgl_awal', 'tgl_awal', 'trim');
            $this->form_validation->set_rules('tgl_akhir', 'tgl_akhir', 'trim');
            if ($this->form_validation->run() == false) {
                $data['title'] =  "Edit Masa Jabatan";
                $data['file']   = 'jabatan/e_mj';
                $this->load->view('template/index', $data);
            } else {
                $where = ['id_mj' => $id_mj];
                $sk = $_FILES['sk']['name'];
                if ($sk) {
                    $config['upload_path'] = './assets/sk';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size']     = '5048';
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('sk')) {
                        $sk = $this->upload->data('file_name');
                        $this->mydb->update_dt($where, ['sk' => $sk], 't_masa_jabatan');
                        unlink(FCPATH . 'assets/sk/' . $data['col']['sk']); //cover
                    } else {
                        notifikasi($this->upload->display_errors(), false);
                        redirect(base_url("Jabatan/e_mj/" . $id_mj));
                    }
                }
                $set = array(
                    'periode1' => post_gan('periode1'),
                    'periode2' => post_gan('periode2'),
                    'tgl_awal' => post_gan('tgl_awal'),
                    'tgl_akhir' => post_gan('tgl_akhir')
                );
                $this->mydb->update_dt($where, $set, 't_masa_jabatan');
                notifikasi('Masa Jabatan Baru Berhasil dibuat!!!', true);
                if (akses("Kprodi")->num_rows() > 0) {
                    redirect(base_url("Kprodi/himpunan"));
                } else {
                    redirect(base_url("Jabatan"));
                }
            }
        } else {
            notifikasi('Masa Jabatan Tidak Ditemukan!!!', true);
            redirect(base_url("Dashboard"));
        }
    }
    function del_mj($id_mj) //HAPUS MASA JABATAN ACAN
    {
        $cek_mj = $this->mj_model->cek_mj($id_mj, $_SESSION['hima_id']);
        if ($cek_mj['num_rows'] > 0) {
            $mj = $cek_mj['row_array'];
            if ($mj['status_mj'] == '1') {
                $msg = 'Masa Jabatan tidak dapat dihapus karena masih <b>Aktif</b> !!!';
                $type = false;
            } else {
                $where = ['id_mj' => $id_mj];
                //MELAKUKAN HAPUS DATA BERDASARKAN ID_MJ
                $this->mydb->del($where, 't_kegiatan');
                $this->mydb->del($where, 't_tagihan');
                $this->mydb->del($where, 't_pemasukan');
                $this->mydb->del($where, 't_pengeluaran');
                $this->mydb->del($where, 't_post');
                $this->mydb->del($where, 't_masa_jabatan');
                $msg = 'Masa Jabatan berhasil Dihapus !!!';
                $type = true;
            }
        } else {
            $msg = 'Masa Jabatan tidak ditemukan !!!';
            $type = false;
        }
        notifikasi($msg, $type);
        if (akses("Kprodi")->num_rows() > 0) {
            redirect(base_url("Kprodi/himpunan"));
        }
        redirect(base_url("Jabatan"));
    }
    public function i_jabatan()  //INPUT NAMA JABATAN
    {
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required|trim|is_unique[t_jabatan.jabatan]', [
            'is_unique' => 'Nama Jabatan sudah ada',
            'required' => 'Nama Jabatan tidak boleh kosong'
        ]);
        if ($this->form_validation->run() == false) {
            $data['title'] =  "Tambah Jabatan";
            $data['tampil'] = $this->db->get('t_jabatan');
            $data['file']   = 'jabatan/i_jabatan';
            $this->load->view('template/index', $data);
        } else {
            $data = array(
                'jabatan' => post_gan('jabatan'),
                'level' => post_gan('level')
            );
            $this->mydb->input_dt($data, 't_jabatan');
            notifikasi('Jabatan Baru Berhasil Ditambahkan!!!', true);
            redirect(base_url("Dashboard"));
        }
    }
}
