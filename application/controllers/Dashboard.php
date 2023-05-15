<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('absen_model');
		$this->load->model('kegiatan_model', 'kegiatan');
		$this->load->model('keuangan_model', 'keuangan');
		$this->load->model('tagihan_model', 'tagihan');
		$this->load->model('pengurus_model');
		$this->load->model('MJ_model');
	}
	public function index()
	{
		$data['title'] 		= 'Dashboard';
		$data['kegiatan'] 	= $this->kegiatan->kegiatan_aktif();
		$data['file'] 		= 'dashboard/index';
		$this->load->view('template/index', $data);
	}
	//KEGIATAN
	public function kegiatan()
	{
		akses_prodi();
		$data['title'] = 'Histori Kegiatan';
		$data['assets_css'] = array("themes/vendors/css/tables/datatable/datatables.min.css");
		$data['assets_js'] = array("themes/vendors/js/tables/datatable/datatables.min.js");
		$data['tampil'] = $this->kegiatan->kegiatanku($_SESSION['id_mahasiswa_pt']);
		$data['kahim'] 	= $this->MJ_model->get_mj_aktif($_SESSION['hima_id'])['ketua_himpunan'];
		$data['file'] 	= 'dashboard/kegiatanku';
		$this->load->view('template/index', $data);
	}
	public function info_kegiatan($no_kg = null)
	{
		$id_mj = $_SESSION['id_mj'];
		if ($no_kg == null) {
			notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
			redirect(base_url("Dashboard/kegiatan"));
		}
		$kegiatan = $this->kegiatan->get_kegiatan($id_mj, $no_kg);
		if ($kegiatan->num_rows() > 0) {
			$data['kegiatan'] 	= $kegiatan->row_array();
			$data['title']   	= $data['kegiatan']['nama_kegiatan'];
			$data['file'] 		= 'kegiatan/info_kegiatan';
			$this->load->view('template/index', $data);
		} else {
			notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
			redirect(base_url("Dashboard/kegiatan"));
		}
	}
	public function absensi($no_kg = null)
	{
		$id_mj = $_SESSION['id_mj'];
		if ($no_kg == null) {
			notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
			redirect(base_url("Dashboard/kegiatan"));
		}
		$kegiatan = $this->kegiatan->get_kegiatan($id_mj, $no_kg);
		if ($kegiatan->num_rows() > 0) {
			$peserta = $this->absen_model->getAbsen($no_kg, 'Peserta');
			$data['total_peserta']  = $peserta['total_hadir'];

			if ($this->uri->segment('4') != null) {
				//MANUAL
				$sebagai = $this->uri->segment('4');
			} else {
				//DEFAULT
				$total_peserta = $peserta['num_rows'];
				if ($total_peserta > 0) {
					$sebagai = 'Peserta';
					$query = $peserta;
				} else {
					$sebagai = 'Panitia';
				}
			}
			if ($sebagai == 'Panitia') {
				$query = $this->absen_model->getAbsen($no_kg, $sebagai);
				$data['title']   = 'Daftar Panitia';
			} else {
				$query = $peserta;
				$data['title']   = 'Daftar Peserta';
			}
			$data['kegiatan'] = $kegiatan->row_array();
			$data['sebagai']  = $sebagai;
			$data['tampil']   =  $query;
			$data['assets_css'] = array("themes/vendors/css/tables/datatable/datatables.min.css");
			$data['assets_js']  = array("themes/vendors/js/tables/datatable/datatables.min.js");
			$data['file'] = 'kegiatan/absensi_kg';
			$this->load->view('template/index', $data);
		} else {
			notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
			redirect(base_url("Dashboard/kegiatan"));
		}
	}
	public function realisasi_biaya($no_kg = null)
	{
		if ((!$no_kg) || ($no_kg == null)) {
			notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
			redirect(base_url("Dashboard/kegiatan"));
		}
		$kegiatan = $this->db->get_where('t_kegiatan', ['no_kegiatan' => $no_kg, 'id_mj' => $_SESSION['id_mj']]);
		if ($kegiatan->num_rows() < 1) {
			notifikasi('Data Kegiatan tidak ditemukan!!!', false);
			redirect('Dashboard');
		}
		$data['title'] 	= 'Realisasi Biaya Kegiatan';
		$data['biaya'] 	=  $this->kegiatan->get_biaya($_SESSION['id_mj'], $no_kg);
		$data['file'] 	= 'biaya_kegiatan/index';
		$this->load->view('template/index', $data);
	}
	//KEGIATAN TERBARU
	public function kg_terbaru()
	{
		$data['title'] 		= 'Kegiatan Terbaru';
		$data['assets_css'] = array("themes/vendors/css/tables/datatable/datatables.min.css");
		$data['assets_js'] 	= array("themes/vendors/js/tables/datatable/datatables.min.js");
		$data['tampil'] 	= $this->kegiatan->kegiatan_baru();
		$data['file'] 		= 'dashboard/kegiatan_baru';
		$this->load->view('template/index', $data);
	}
	//TAGIHAN KU => BERDASARKAN NPM
	public function tagihan()
	{
		akses_prodi();
		$data['title'] = 'Histori Tagihan';
		$data['assets_css'] = array("themes/vendors/css/tables/datatable/datatables.min.css");
		$data['assets_js'] = array("themes/vendors/js/tables/datatable/datatables.min.js");
		$data['tampil'] = $this->tagihan->get_tagihanku($_SESSION['id_mahasiswa_pt']);
		$data['file'] = 'dashboard/histori_tagihan';
		$this->load->view('template/index', $data);
	}
	//HISTORI PEMBAYARAN => BERDASARKAN NPM & JIKA BENDAHARA BERDASARKAN ID_MJ
	public function histori_pb()
	{
		akses_prodi();
		$data['title'] = 'Histori Pembayaran';
		$data['assets_css'] = array("themes/vendors/css/tables/datatable/datatables.min.css");
		$data['assets_js'] = array("themes/vendors/js/tables/datatable/datatables.min.js");
		$data['tampil'] = $this->tagihan->pembayaranku($_SESSION['id_mahasiswa_pt']);
		$data['file'] = ($_SESSION['role_id'] == '5') ? 'dashboard/histori_pembayaran' : 'dashboard/histori_pembayaranku';
		$this->load->view('template/index', $data);
	}
	//Detail
	public function himpunan()
	{
		if (($_SESSION['role_id'] == '1') && ($this->uri->segment('3') != null)) {
			$id_hima = $this->uri->segment('3');
		} else {
			$id_hima = $_SESSION['hima_id'];
		}
		$data['title']  = 'Profil Himpunan';
		$data['col'] 	= $this->MJ_model->get_mj_aktif($id_hima);
		$data['tampil'] = $this->MJ_model->get_masa_jabatan($id_hima);
		$data['assets_css'] = array("themes/vendors/css/tables/datatable/datatables.min.css");
		$data['assets_js'] 	= array("themes/vendors/js/tables/datatable/datatables.min.js");
		$data['file'] 		= 'hima/detail_hima';
		$this->load->view('template/index', $data);
	}
	public function detail($npm = null)
	{
		if ($npm == null) {
			notifikasi('Data tidak ditemukan', false);
			redirect(base_url('Dashboard'));
		}
		$mhs = json_npm($npm);
		if ($mhs['id_mahasiswa_pt'] == null) {
			notifikasi('Data Anggota Tidak Ditemukan', false);
			redirect(base_url('Dashboard'));
		}
		$data['qrcode'] = (!empty($_SESSION['id_mahasiswa_pt'])) ? $this->mydb->create_qrcode($npm) : '';
		$data['t'] = $mhs;
		$data['histori_jabatan'] = $this->pengurus_model->histori_jabatan($npm);
		$data['title'] = 'Profil : ' . $mhs['nm_pd'];
		$data['file'] = 'dashboard/detail';
		$this->load->view('template/index', $data);
	}
	public function profil()
	{
		$npm = $_SESSION['id_mahasiswa_pt'];
		$data['qrcode'] = $this->mydb->create_qrcode($npm);
		$data['t'] = json_npm($npm);
		$data['histori_jabatan'] = $this->pengurus_model->histori_jabatan($npm);
		$data['title'] 	= 'Data Diri';
		$data['file'] 	= 'dashboard/detail';
		$this->load->view('template/index', $data);
	}
	public function data_presensi()
	{
		$token = $_POST['token'];
		if ($token != null) {
			$response = [];
			$presensi = $this->db->get_where(
				't_absen',
				['token_presensi' => $token]
			);
			if ($presensi->num_rows() > 0) {
				$data = $presensi->row_array();
				$response = [
					'status' => '1',
					'message' => 'Sudah Melakukan Presensi',
					'ttd' => base_url() . $data['signature']
				];
			} else {
				$response = [
					'status' => '0',
					'message' => 'Data Tidak Ditemukan'
				];
			}

			print_r(json_encode($response));
		} else {
			redirect('Dashboard');
		}
	}
}
