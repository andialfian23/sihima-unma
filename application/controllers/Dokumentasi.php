<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokumentasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('kegiatan_model');
    }
    public function index($no_kg = null)
    {
        if ($no_kg == null) {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url("Dashboard/kg_terbaru"));
        }
        $id_mj = $_SESSION['id_mj'];
        $kegiatan = $this->kegiatan_model->get_kegiatan($id_mj, $no_kg);
        if ($kegiatan->num_rows() > 0) {
            $data['kegiatan'] = $kegiatan->row_array();
            $data['title'] = 'Dokumentasi Kegiatan';
            $data['dokumentasi'] = $this->kegiatan_model->get_dokumentasi($id_mj, $no_kg);
            $data['file']   = 'kegiatan/dokumentasi_kg';
            $this->load->view('template/index', $data);
        } else {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url("Dashboard/kg_terbaru"));
        }
    }
    // PROSES MENAMBAHKAN DOKUMENTASI
    public function add($no_kg = null)
    {
        if ($no_kg == null) {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url("Dashboard/kg_terbaru"));
        } else {
            $kegiatan = $this->kegiatan_model->get_kegiatan($_SESSION['id_mj'], $no_kg);
            if ($kegiatan->num_rows() > 0) {

                $config['upload_path'] = './media_library/dokumentasi/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = 0;
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto_dokumentasi')) {
                    $file_name = $this->upload->data('file_name');
                } else {
                    $response = $this->upload->display_errors();
                }

                $data = [
                    'image' => $file_name,
                    'caption' => post_gan('caption'),
                    'id_mahasiswa_pt' => $_SESSION['id_mahasiswa_pt'],
                    'no_kg' => $no_kg
                ];
                $this->mydb->input_dt($data, 't_dokumentasi');
                notifikasi('Dokumentasi Berhasil Ditambahkan', true);
                $response = 1;
            } else {
                $response = 'Dokumentasi tidak dapat ditambahkan!!';
            }
        }
        echo $response;
    }
    // HAPUS DOKUMENTASI
    public function delete($id_dk = null)
    {
        $no_kg = $this->db->get_where('t_dokumentasi', ['id_dk' => $id_dk])->row_array()['no_kg'];
        $kegiatan = $this->kegiatan_model->get_kegiatan($_SESSION['id_mj'], $no_kg);
        if ($kegiatan->num_rows() > 0) {
            $file = $this->db->get_where('t_dokumentasi', ['id_dk' => $id_dk])->row_array()['image'];
            unlink(FCPATH . 'media_library/dokumentasi/' . $file);
            $this->mydb->del(['id_dk' => $id_dk, 'no_kg' => $no_kg], 't_dokumentasi');
            $this->session->set_flashdata('toastr', '<script>toastr.success("Dokumentasi berhasil dihapus")</script>');

            redirect(base_url("Dokumentasi/index/" . $no_kg));
        } else {
            notifikasi('Dokumentasi tidak dapat ditambahkan!!', false);
            redirect(base_url("Dashboard/kg_terbaru"));
        }
    }
}
