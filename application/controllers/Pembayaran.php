<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('pengurus_model', 'pengurus');
        $this->load->model('keuangan_model', 'keuangan');
        $this->load->model('tagihan_model', 'tagihan');
    }
    //TAGIHAN
    public function index($no_ta = null)
    {
        if ($no_ta == null) {
            notifikasi('Tagihan Anggota tidak ada yang dipilih!!!', false);
            redirect(base_url("Tagihan"));
        }
        $this->form_validation->set_rules('nominal', 'Nominal', 'required|trim|numeric', [
            'required' => 'Nominal bayar belum di isi',
            'numeric' => 'Nominal yang anda masukkan bukan angka'
        ]);
        $id_mj = $_SESSION['id_mj'];
        $ta = $this->tagihan->get_ta($id_mj, $no_ta);
        $col = $ta->row_array();
        if ($this->form_validation->run() == false) {
            $data['title']  =  "Proses Pembayaran";
            $data['col']    = $col;
            $data['t']      = json_npm($col['id_mahasiswa_pt']);
            $data['file']   = 'tagihan/i_pb';
            $this->load->view('template/index', $data);
        } else {
            $nominal = post_gan('nominal');
            $sisa = $col['jml_tagihan'] - $col['dibayar'];
            if ($nominal > $sisa) {
                notifikasi('Nominal yang dimasukkan terlalu besar!!!', false);
                redirect(base_url("Tagihan/bayar/" . $no_ta));
            } else {
                //UPDATE DATA PEMASUKAN => penambahan jml_pemasukan
                $this->keuangan->penambahan_jml_pemasukan($id_mj, $nominal);

                //input pembayaran
                $data1 = array(
                    'no_tg' => $col['no_tg'],
                    'id_mahasiswa_pt' => $col['id_mahasiswa_pt'],
                    'nominal_bayar' => $nominal,
                    'tgl_bayar' => post_gan('tgl_bayar')
                );
                $this->mydb->input_dt($data1, 't_pembayaran');

                //update tagihan anggota
                $dibayar = $col['dibayar'] + $nominal;
                $data2 = ['dibayar' => $dibayar];
                $where = ['no_ta' => $no_ta, 'id_mahasiswa_pt' => $col['id_mahasiswa_pt']];
                $this->mydb->update_dt($where, $data2, 't_tagihan_anggota');
                notifikasi('Pembayaran tagihan Berhasil!!!', true);
                redirect(base_url("Tagihan/tg_pengurus/" . $col['no_tg']));
            }
        }
    }

    //HAPUS PEMBAYARAN
    function hapus($no_pb = null)
    {

        if ($no_pb == null) {
            notifikasi('Data Pembayaran tidak ditemukan', false);
            redirect(base_url("Dashboard/histori_pb"));
        }
        $id_mj = $_SESSION['id_mj'];
        $pembayaran = $this->tagihan->get_pembayaran($id_mj, $no_pb);
        if ($pembayaran->num_rows() > 0) {
            $pb = $pembayaran->row_array();
            $tagihan_anggota = $this->tagihan->get_tg_anggota($pb['no_tg'], $pb['id_mahasiswa_pt']);
            if ($tagihan_anggota->num_rows() > 0) {
                //UPDATE DATA TAGIHAN ANGGOTA => pengurangan jumlah dibayar
                $jml_dibayar = $tagihan_anggota->row_array()['dibayar'];
                $dibayar = $jml_dibayar - $pb['nominal_bayar'];
                $this->tagihan->pengurangan_jml_dibayar($pb['no_tg'], $pb['id_mahasiswa_pt'], $dibayar);

                //UPDATE DATA PEMASUKAN => pengurangan jml_pemasukan
                $this->keuangan->pengurangan_jml_pemasukan($id_mj, $pb['nominal_bayar']);

                //HAPUS DATA PEMBAYARAN
                $this->mydb->del(['no_pb' => $no_pb], 't_pembayaran');

                notifikasi('Data Pembayaran berhasil dihapus!!', true);
            } else {
                notifikasi('Data Pembayaran gagal dihapus!!', false);
            }
        } else {
            notifikasi('Tidak Ada Tagihan Anggota yang dipilih!!', false);
        }
        redirect(base_url("Dashboard/histori_pb"));
    }
}
