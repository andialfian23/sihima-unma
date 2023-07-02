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
		$this->load->view('dashboard/template/main', [
			'kegiatan' 	=> $this->kegiatan->kegiatan_aktif(),
			'title' 	=> 'Dashboard',
			'file'		=> 'index',
		]);
	}
	//KEGIATAN
	public function kegiatan()
	{
		akses_prodi();

		$this->load->view('dashboard/template/main', [
			'tampil' 	 => $this->kegiatan->kegiatanku($_SESSION['id_mahasiswa_pt']),
			'kahim' 	 => $this->MJ_model->get_mj_aktif($_SESSION['hima_id'])['ketua_himpunan'],
			'title'		 => 'Histori Kegiatan',
			'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
			'assets_js'	 => array("themes/vendors/js/tables/datatable/datatables.min.js"),
			'file' 		 => 'kegiatanku',
		]);
	}
	public function info_kegiatan($no_kg = null)
	{
		if ($no_kg == null) {
			notifikasi('Data Kegiatan Tidak Ditemukan!!', false);
			redirect(base_url("Dashboard/kegiatan"));
		}

		$kegiatan = $this->kegiatan->get_kegiatan($_SESSION['id_mj'], $no_kg);
		if ($kegiatan->num_rows() > 0) {
			$kegiatan = $kegiatan->row_array();

			$this->load->view('template/index', [
				'kegiatan'  => $kegiatan,
				'title'	    => $kegiatan['nama_kegiatan'],
				'file'		=> 'kegiatan/info_kegiatan',
			]);
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
			$total_peserta  = $peserta['total_hadir'];

			if ($this->uri->segment('4') != null) {
				//MANUAL
				$sebagai = $this->uri->segment('4');
			} else {
				//DEFAULT
				$total_peserta = $peserta['num_rows'];
				if ($total_peserta > 0) {
					$sebagai = 'Peserta';
					$query 	= $peserta;
				} else {
					$sebagai = 'Panitia';
				}
			}

			if ($sebagai == 'Panitia') {
				$query 	= $this->absen_model->getAbsen($no_kg, $sebagai);
				$title	= 'Daftar Panitia';
			} else {
				$query 	= $peserta;
				$title	= 'Daftar Peserta';
			}

			$this->load->view('template/index', [
				'total_peserta' => $total_peserta,
				'kegiatan' 	=> $kegiatan->row_array(),
				'sebagai'  	=> $sebagai,
				'tampil'   	=> $query,
				'title'		=> $title,
				'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
				'asset_js' 	=> array("themes/vendors/js/tables/datatable/datatables.min.js"),
				'file' 		=> 'kegiatan/absensi_kg',
			]);
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
		$kegiatan = $this->kegiatan->get_kegiatan($_SESSION['id_mj'], $no_kg);
		if ($kegiatan->num_rows() < 1) {
			notifikasi('Data Kegiatan tidak ditemukan!!!', false);
			redirect('Dashboard');
		}

		$this->load->view('dashboard/template/main', [
			'biaya'	=> $this->kegiatan->get_biaya($_SESSION['id_mj'], $no_kg),
			'title' => 'Realisasi Biaya Kegiatan',
			'file'	=> 'biaya_kegiatan/index',
		]);
	}
	//KEGIATAN TERBARU
	public function kg_terbaru()
	{
		$this->load->view('dashboard/template/main', [
			'title'		=> 'Kegiatan Terbaru',
			'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
			'assets_js'	=> array("themes/vendors/js/tables/datatable/datatables.min.js"),
			'tampil' 	=> $this->kegiatan->kegiatan_baru(),
			'file' 		=> 'kegiatan_baru',
		]);
	}
	//TAGIHAN KU => BERDASARKAN NPM
	public function tagihan()
	{
		akses_prodi();
		$this->load->view('dashboard/template/main', [
			'title' 		=> 'Histori Tagihan',
			'assets_css' 	=> array("themes/vendors/css/tables/datatable/datatables.min.css"),
			'assets_js' 	=> array("themes/vendors/js/tables/datatable/datatables.min.js"),
			'tampil' 	=> $this->tagihan->get_tagihanku($_SESSION['id_mahasiswa_pt']),
			'file' 		=> 'histori_tagihan',
		]);
	}
	//HISTORI PEMBAYARAN => BERDASARKAN NPM & JIKA BENDAHARA BERDASARKAN ID_MJ
	public function histori_pb()
	{
		akses_prodi();
		$file = ($_SESSION['role_id'] == '5') ? 'histori_pembayaran' : 'histori_pembayaranku';

		$this->load->view('dashboard/template/main', [
			'title' 	=> 'Histori Pembayaran',
			'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
			'assets_js' => array("themes/vendors/js/tables/datatable/datatables.min.js"),
			'tampil' 	=> $this->tagihan->pembayaranku($_SESSION['id_mahasiswa_pt']),
			'file' 		=> $file,
		]);
	}
	//Detail
	public function himpunan()
	{
		$id_hima = (($_SESSION['role_id'] == '1') && ($this->uri->segment('3') != null))
			? $this->uri->segment('3')
			: $_SESSION['hima_id'];

		$this->load->view('dashboard/template/main', [
			'title'  	=> 'Profil Himpunan',
			'col' 		=> $this->MJ_model->get_mj_aktif($id_hima),
			'tampil' 	=> $this->MJ_model->get_masa_jabatan($id_hima),
			'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
			'assets_js'	=> array("themes/vendors/js/tables/datatable/datatables.min.js"),
			'file' 		=> 'hima/detail_hima',
		]);
	}
	public function detail($npm = null)
	{
		if ($npm == null) {
			notifikasi('Data Anggota tidak ditemukan', false);
			redirect(base_url('Dashboard'));
		}

		$mhs = json_npm($npm);
		if ($mhs['id_mahasiswa_pt'] == null) {
			notifikasi('Data Anggota Tidak Ditemukan', false);
			redirect(base_url('Dashboard'));
		}

		$qrcode = (!empty($_SESSION['id_mahasiswa_pt'])) ? $this->mydb->create_qrcode($npm) : '';

		$this->load->view('dashboard/template/main', [
			'histori_jabatan' => $this->pengurus_model->histori_jabatan($npm),
			'qrcode' 	=> $qrcode,
			't' 		=> $mhs,
			'title' 	=> 'Profil : ' . $mhs['nm_pd'],
			'file' 		=> 'data_diri',
		]);
	}
	public function profil()
	{
		$npm = $_SESSION['id_mahasiswa_pt'];

		$this->load->view('dashboard/template/main', [
			'histori_jabatan' => $this->pengurus_model->histori_jabatan($npm),
			'qrcode' 	=> $this->mydb->create_qrcode($npm),
			'mhs' 		=> json_npm($npm),
			'title' 	=> 'Data Diri',
			'file' 		=> 'data_diri',
		]);
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
