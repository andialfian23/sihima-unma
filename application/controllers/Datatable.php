<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datatable extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('pembayaran_model', 'pembayaran');
	}
	public function json($method = 'get')
	{
		header('Content-type: application/json');
		$param = $_SERVER['QUERY_STRING'];
		$method = 'simple_' . $method;
		$kode_prodi = (!empty($_GET['kode_prodi'])) ? $_GET['kode_prodi'] : $_SESSION['kode_prodi'];

		if ($_SESSION['role_id'] == '1') {
			print_r($this->curl->$method(ADD_API . 'datatable/mahasiswa?' . $param . '&kode_prodi=' . $kode_prodi));
		} else {
			print_r($this->curl->$method(ADD_API . 'datatable/mahasiswa?' . $param . '&kode_fak=' . $_SESSION['kode_fak'] . '&kode_prodi=' . $kode_prodi));
		}
	}
	public function histori_pembayaran()
	{
		if (empty($_SESSION['id_mj'])) {
			$output = 'Gagal Mengakses data histori pembayaran';
		} else {
			$id_mj = $_SESSION['id_mj'];
			if (empty($_POST['search']['value'])) {
				$_POST['search']['value'] = '';
			}
			if (empty($_POST['length'])) {
				$_POST['length'] = '10';
				$_POST['start'] = '0';
				$_POST['draw'] = null;
			}
			$column_order     = array('tgl_bayar', 'nama_mhs', 'nama_tagihan', 'nominal_bayar');
			$list   = $this->pembayaran->get_datatables($column_order, $id_mj, null);
			$data   = array();
			foreach ($list as $key) {
				$row      = array();

				$row['tgl_bayar']   = $key->tgl_bayar;
				$row['nama']   	 	= $key->nama_mhs;
				$row['nama_tagihan']    = $key->nama_tagihan;
				$row['nominal_bayar']   = $key->nominal_bayar;
				$row['aksi']			= "<a href='#' onclick='return hapus($key->no_pb)'class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a>";

				$data[]   = $row;
			}

			$output = array(
				"draw"              => $_POST['draw'],
				"recordsFiltered"   => $this->pembayaran->total_entri_terfilter($column_order, $id_mj, null),
				"recordsTotal"      => $this->pembayaran->total_entri($id_mj, null),
				"data"              => $data,
			);
		}

		echo json_encode($output);
	}
	public function histori_pembayaranku()
	{
		if (empty($_SESSION['id_mahasiswa_pt'])) {
			$data = 'Gagal Mengakses data histori pembayaran';
		} else {
			if (empty($_POST['search']['value'])) {
				$_POST['search']['value'] = '';
			}
			if (empty($_POST['length'])) {
				$_POST['length'] = '10';
				$_POST['start'] = '0';
				$_POST['draw'] = null;
			}
			$id_mahasiswa_pt = $_SESSION['id_mahasiswa_pt'];
			$column_order     = array('tgl_bayar', 'nama_tagihan', 'nominal_bayar');
			$histori_pembayaran   = $this->pembayaran->get_datatables($column_order, null, $id_mahasiswa_pt);
			$data   = array();
			foreach ($histori_pembayaran as $key) {
				$row      = array();

				$row['tgl_bayar']   = $key->tgl_bayar;
				$row['nama_tagihan']    = $key->nama_tagihan;
				$row['nominal_bayar']   = $key->nominal_bayar;

				$data[]   = $row;
			}
			$output = array(
				"draw"              => $_POST['draw'],
				"recordsFiltered"   => $this->pembayaran->total_entri_terfilter($column_order, null, $id_mahasiswa_pt),
				"recordsTotal"      => $this->pembayaran->total_entri(null, $id_mahasiswa_pt),
				"data"              => $data,
			);
		}

		echo json_encode($output);
	}
}
