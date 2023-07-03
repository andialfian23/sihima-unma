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

        $id_mj  = $_SESSION['id_mj'];
        $cek_ta = $this->tagihan->get_ta($id_mj, $no_ta);
        if ($cek_ta->num_rows() > 0) {
            $tagihan = $cek_ta->row_array();

            $this->form_validation->set_rules('nominal', 'Nominal', 'required|trim|numeric', [
                'required' => 'Nominal bayar belum di isi',
                'numeric' => 'Nominal yang anda masukkan bukan angka'
            ]);

            if ($this->form_validation->run() == false) {
                $mhs = json_npm($tagihan['id_mahasiswa_pt']);
                $this->load->view('dashboard/template/main', [
                    'title'     => "Proses Pembayaran",
                    'mhs'       => $mhs,
                    'tagihan'   => $tagihan,
                    'file'      => 'tagihan/i_pb',
                ]);
            } else {
                $nominal = post_gan('nominal');
                $sisa = $tagihan['jml_tagihan'] - $tagihan['dibayar'];
                if ($nominal > $sisa) {
                    notifikasi('Nominal yang dimasukkan terlalu besar!!!', false);
                    redirect(base_url("Tagihan/bayar/" . $no_ta));
                } else {
                    //UPDATE DATA PEMASUKAN => penambahan jml_pemasukan
                    $this->keuangan->penambahan_jml_pemasukan($id_mj, $nominal);

                    //input pembayaran
                    $values = array(
                        'no_tg'         => $tagihan['no_tg'],
                        'id_mahasiswa_pt' => $tagihan['id_mahasiswa_pt'],
                        'nominal_bayar' => $nominal,
                        'tgl_bayar'     => post_gan('tgl_bayar')
                    );
                    $this->mydb->input_dt($values, 't_pembayaran');

                    //update tagihan anggota
                    $dibayar  = $tagihan['dibayar'] + $nominal;
                    $data_set = ['dibayar' => $dibayar];
                    $where    = ['no_ta' => $no_ta, 'id_mahasiswa_pt' => $tagihan['id_mahasiswa_pt']];
                    $this->mydb->update_dt($where, $data_set, 't_tagihan_anggota');

                    notifikasi('Pembayaran tagihan Berhasil!!!', true);
                    redirect(base_url("Tagihan/tg_pengurus/" . $tagihan['no_tg']));
                }
            }
        } else {
            notifikasi('Tagihan Tidak Diketahui !!!', false);
            redirect(base_url("Dashboard"));
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
