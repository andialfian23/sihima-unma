<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('kegiatan_model');
        $this->load->model('absen_model');
        $this->load->model('pengurus_model');
    }
    //INPUT ABSEN ANGGOTA PENGURUS
    public function i_absen($no_kg = null)
    {
        $kegiatan = $this->kegiatan_model->get_kegiatan($_SESSION['id_mj'], $no_kg);
        if ($kegiatan->num_rows() > 0 || $no_kg != null) {
            $data['col']    = $kegiatan->row_array();
            $data['title']  = 'Proses Absensi Pengurus';
            $data['tampil'] = $this->absen_model->list_pengurus($no_kg, $_SESSION['id_mj']);
            $data['file']   = 'kegiatan/i_absen_pengurus';
            $this->load->view('template/index', $data);
        } else {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url("Kegiatan"));
        }
    }
    function proses_absensi()
    {
        $no_kg = post_gan('kegiatan');      //no_kegiatan
        $id_mj = $_SESSION['id_mj'];

        $kegiatan = $this->kegiatan_model->get_kegiatan($id_mj, $no_kg);
        if ($kegiatan->num_rows() > 0) {

            $mhs = post_gan('mhs'); //NPM
            $sebagai = post_gan('sebagai');
            $status = post_gan('status');
            $ttl = count($mhs);

            for ($i = 0; $i < $ttl; $i++) {
                $data = array(
                    'no_kegiatan' => $no_kg,
                    'mhs_unma' => '1',
                    'no_id' => $mhs[$i],
                    'status' => $status[$i],
                    'sebagai' => $sebagai[$i]
                );
                // var_dump($data);
                $this->mydb->input_dt($data, 't_absen');
            }
            notifikasi('Proses Absensi Berhasil !!!', true);
            redirect(base_url('Dashboard/absensi/' . $no_kg));
        } else {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url("Kegiatan"));
        }
    }
    //PROSES ABSEN PESERTA MANUAL
    public function cari_data_peserta()
    {
        header('Content-type: application/json');
        $id = $_POST['id'];
        if ($id != null) {
            // cari di data peserta
            $cek_peserta = $this->db->get_where('t_peserta', ['id_peserta' => $id]);
            if ($cek_peserta->num_rows() > 0) {
                $data_peserta = $cek_peserta->row_array();
                $peserta = [
                    'id'    => $data_peserta['id_peserta'],
                    'nama' => $data_peserta['nama'],
                    'keterangan' => $data_peserta['alamat'],
                ];
            } else {
                //cari di data mhs
                $data_mhs = json_npm($id);
                if (empty($data_mhs['id_mahasiswa_pt'])) {
                    print_r('0');
                } else {
                    $peserta = [
                        'id'    => $data_mhs['id_mahasiswa_pt'],
                        'nama' => $data_mhs['nm_pd'],
                        'keterangan' => $data_mhs['homebase']
                    ];
                }
            }
            print_r(json_encode($peserta));
        } else {
            return false;
        }
    }
    public function p_i_manual()
    {
        $id_peserta = substr(post_gan('no_id'), 0, 2);
        if (empty($id_peserta)) {
            $this->session->set_flashdata('toastr', '<script>toastr.error("Presensi manual Gagal!!!");</script>');
            redirect(base_url("Dashboard"));
        }
        if ($id_peserta == 'PS') {
            $mhs = '0';
        } else {
            $mhs = '1';
        }
        $data = array(
            'no_kegiatan' => post_gan('no_kg'),
            'mhs_unma' => $mhs,
            'no_id'   => post_gan('no_id'),
            'status'  => 'Hadir',
            'sebagai' => post_gan('sebagai')
        );
        $this->mydb->input_dt($data, 't_absen');
        $this->session->set_flashdata('toastr', '<script>toastr.success("Presensi manual berhasil :)");</script>');
        redirect(base_url("Dashboard/absensi/" . post_gan('no_kg')));
    }
    //INPUT ABSEN DENGAN SCAN
    public function scan($no_kg = null, $sebagai = null)
    {
        if ($no_kg == null || $sebagai == null) {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url('Dashboard'));
        }
        $id_mj = $_SESSION['id_mj'];
        $kegiatan = $this->kegiatan_model->get_kegiatan($id_mj, $no_kg);
        if ($kegiatan->num_rows() > 0) {
            $data['col'] = $kegiatan->row_array();
            $data['title'] = 'Kegiatan : ' . $data['col']['nama_kegiatan'];
            $data['assets_css'] = array("themes/vendors/css/tables/datatable/datatables.min.css");
            $data['assets_js'] = array("themes/vendors/js/tables/datatable/datatables.min.js");
            $data['tampil'] =  $this->absen_model->getAbsen($no_kg, 'Peserta');
            $data['sebagai'] = $sebagai;
            $data['file']   = 'kegiatan/scan';
            $this->load->view('template/index', $data);
        } else {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url("Kegiatan"));
        }
    }
    function hasil_scan($no_kg = null, $sebagai = null)
    {
        //cek apakah sudah absen atau belum
        $id_mj = $_SESSION['id_mj'];
        $kegiatan = $this->kegiatan_model->get_kegiatan($id_mj, $no_kg);
        if ($kegiatan->num_rows() > 0) {
            $no_qr = post_gan('no_qr');

            //CEK NPM ATAU BUKAN
            if ((strlen($no_qr) > 12) || (strlen($no_qr) < 9)) {
                notifikasi('QR-Code tidak dapat digunakan untuk absensi !!!', false);
            } else {
                $id_peserta = substr($no_qr, 0, 2);
                if ($id_peserta == 'PS') {
                    //CEK PESERTA NON MAHASISWA UNMA
                    $cek_peserta = $this->db->get_where('t_peserta', ['id_peserta' => $no_qr])->num_rows();
                    if ($cek_peserta > 0) {
                        //CEK SUDAH ABSEN ATAU BELUM
                        $cek_absen = $this->absen_model->cek_absen_peserta($no_kg, $no_qr)->num_rows();
                        if ($cek_absen > 0) {
                            notifikasi('Peserta ini sudah melakukan absensi !!!', false);
                        } else {
                            //INPUT ABSEN NON MAHASISWA UNMA
                            $data = array(
                                'no_kegiatan' => $no_kg,
                                'mhs_unma' => '0',
                                'no_id' => $no_qr,
                                'status' => 'Hadir',
                                'sebagai' => 'Peserta'
                            );
                            $this->mydb->input_dt($data, 't_absen');
                            notifikasi('Absensi ID Peserta <b>' . $no_qr . '</b> Berhasil !!!', true);
                        }
                    } else {
                        notifikasi('Data Peserta tidak ditemukan, QR-code tidak diketahui', false);
                    }
                } else {
                    //CEK SUDAH ABSEN ATAU BELUM
                    $cek_absen = $this->absen_model->get_absen($no_kg, $no_qr, 'unma');
                    $nama = json_npm($cek_absen->row_array()['id_mahasiswa_pt'])['nm_pd'];
                    if ($cek_absen->num_rows() > 0) {
                        notifikasi($nama . ' sudah melakukan absensi !!!', false);
                    } else {
                        //INPUT ABSEN MAHASISWA UNMA
                        $data = array(
                            'no_kegiatan' => $no_kg,
                            'mhs_unma' => '1',
                            'no_id' => $no_qr,
                            'status' => 'Hadir',
                            'sebagai' => 'Peserta'
                        );
                        $this->mydb->input_dt($data, 't_absen');
                        notifikasi('<b>' . $nama . '</b> Berhasil ter-Absen!!!', true);
                    }
                }
            }
            redirect(base_url("Absen/scan/" . $no_kg . '/' . $sebagai));
        } else {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url("Kegiatan"));
        }
    }
    //UPDATE
    public function e_absen($no_kg = null, $npm = null)
    {
        if (($no_kg == null) || ($npm == null)) {
            notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
            redirect(base_url("Kegiatan"));
        }
        $absen = $this->absen_model->get_absen($no_kg, $npm);
        if (($absen->num_rows() < 1) || ($npm == null)) {
            notifikasi('Data Absensi Tidak Ditemukan!!', false);
            redirect(base_url("Dashboard/absensi/" . $no_kg));
        }
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('sebagai', 'Sebagai', 'trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Absensi';
            $data['col'] = $absen->row_array();
            $data['nama'] = json_npm($npm)['nm_pd'];
            $data['file']   = 'kegiatan/e_absen';
            $this->load->view('template/index', $data);
        } else {
            $set = [
                'status' => post_gan('status'),
                'sebagai' => post_gan('sebagai')
            ];
            $where = ['no_kegiatan' => $no_kg, 'no_id' => $npm];
            $this->mydb->update_dt($where, $set, 't_absen');
            notifikasi('Absensi Berhasil Di update', true);
            redirect(base_url('Dashboard/absensi/' . $no_kg . '/Panitia'));
        }
    }
    //DELETE
    function del_absen($no_kegiatan = null, $id_absen = null)
    {
        //id_absen == no_id in database
        if (($no_kegiatan != null) && ($id_absen != null)) {
            $table = 't_absen';
            $where = ['no_kegiatan' => $no_kegiatan, 'no_id' => $id_absen];
            $absen = $this->db->get_where($table, $where);

            if ($absen->num_rows() > 0) {
                $where2 = ['id_peserta' => $id_absen];
                $nama = ($absen->row_array()['mhs_unma'] == '1') ?
                    json_npm($id_absen)['nm_pd']
                    : $this->db->get_where('t_peserta', $where2)->row_array()['nama'];
                //HAPUS 
                $this->mydb->del($where, $table);
                notifikasi('Data Absensi <b>' . $nama . '</b> berhasil dihapus!!', true);
            } else {
                notifikasi('Data Absensi gagal dihapus!!', false);
            }
        } else {
            notifikasi('Data Absensi Tidak Ditemukan!!', false);
        }
        redirect(base_url('Dashboard/absensi/' . $no_kegiatan));
    }
}
