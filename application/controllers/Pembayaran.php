<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    var $table = 't_pembayaran';

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('pembayaran_model', 'pembayaran');
        $this->load->model('tagihan_model', 'tagihan');
    }

    // BAYAR TAGIHAN
    public function bayar($no_ta = null)
    {
        if ($no_ta == null) {
            notifikasi('Tagihan Anggota tidak ada yang dipilih!!!', false);
            redirect(base_url("Tagihan"));
        }

        $id_mj  = $_SESSION['id_mj'];
        $cek_ta = $this->tagihan->get_ta($id_mj, $no_ta);
        if ($cek_ta->num_rows() > 0) {
            $tg_anggota = $cek_ta->row_array();

            $this->form_validation->set_rules('nominal', 'Nominal', 'required|trim|numeric', [
                'required' => 'Nominal bayar belum di isi',
                'numeric' => 'Nominal yang anda masukkan bukan angka'
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view('dashboard/template/main', [
                    'title'     => "Proses Pembayaran",
                    'tagihan'   => $tg_anggota,
                    'file'      => 'pembayaran/i_pb',
                ]);
            } else {
                $nominal = post_gan('nominal');
                $sisa = $tg_anggota['jml_tagihan'] - $tg_anggota['telah_dibayar'];
                if ($nominal > $sisa) {
                    notifikasi('Nominal yang dimasukkan terlalu besar!!!', false);
                    redirect(base_url("Pembayaran/bayar/" . $no_ta));
                } else {
                    //input pembayaran
                    $data_values = array(
                        'no_ta'         => $tg_anggota['no_ta'],
                        'nominal_bayar' => $nominal,
                        'tgl_bayar'     => post_gan('tgl_bayar')
                    );
                    $this->mydb->input_dt($data_values, $this->table);

                    notifikasi('Pembayaran tagihan Berhasil!!!', true);
                    redirect(base_url("Tagihan_anggota/detail/" . $tg_anggota['no_tg']));
                }
            }
        } else {
            notifikasi('Tagihan Tidak Diketahui !!!', false);
            redirect(base_url("Dashboard"));
        }
    }

    //HAPUS PEMBAYARAN
    public function delete($no_pb = null)
    {
        if ($no_pb == null) {
            notifikasi('Data Pembayaran tidak ditemukan', false);
            redirect(base_url("Dashboard/histori_pb"));
        }

        $id_mj = $_SESSION['id_mj'];
        $pembayaran = $this->pembayaran->get_pembayaran($id_mj, $no_pb);
        if ($pembayaran->num_rows() > 0) {

            //HAPUS DATA PEMBAYARAN
            $this->mydb->del(['no_pb' => $no_pb], $this->table);

            notifikasi('Data Pembayaran berhasil dihapus!!', true);
        } else {
            notifikasi('Data Pembayaran gagal dihapus!!', false);
        }
        redirect(base_url("Dashboard/histori_pb"));
    }
}
