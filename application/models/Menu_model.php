<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
	function sidebar_admin()	//LEVEL 1 ADMIN
	{
		$data = [
			[
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard',
				'menu_text' => 'Dashboard',
				'menu_color' => '',
				'menu_icon' => 'ft-home'
			],
			[
				'has-sub' => TRUE,
				'menu_color' => 'bg-secondary bg-darken-4',
				'menu_text' => 'Manajemen Sistem',
				'menu_icon' => 'ft-layers',
				'menu_child' =>	[
					[
						'menu_link' => 'Admin',
						'menu_text' => 'Admin',
					], [
						'menu_link' => 'Admin/controller',
						'menu_text' => 'Controller',
					], [
						'menu_link' => 'Admin/role',
						'menu_text' => 'Level & Role',
					],
					// [
					// 	'menu_link' => 'Admin/icon',
					// 	'menu_text' => 'Icon',
					// ],
				],
			],
			[
				'has-sub' => FALSE,
				'menu_link' => 'Himpunan/index',
				'menu_text' => 'Himpunan',
				'menu_color' => 'bg-danger bg-darken-4',
				'menu_icon' => 'ft-star'
			],
			[
				'has-sub' => FALSE,
				'menu_link' => 'Admin/jabatan',
				'menu_text' => 'Jabatan',
				'menu_color' => 'bg-warning bg-darken-4',
				'menu_icon' => 'ft-star'
			],
			[
				'has-sub' => TRUE,
				'menu_color' => 'bg-info bg-darken-4',
				'menu_text' => 'Anggota',
				'menu_icon' => 'ft-users',
				'menu_child' =>	[
					[
						'menu_link' => 'Pengurus/anggota',
						'menu_text' => 'Anggota Pengurus',
					], [
						'menu_link' => 'Anggota/all',
						'menu_text' => 'Anggota Lainnya',
					],
				],
			],
			[
				'has-sub' => TRUE,
				'menu_color' => 'bg-success bg-darken-4',
				'menu_text' => 'Kegiatan',
				'menu_icon' => 'ft-layers',
				'menu_child' =>	[
					[
						'menu_link' => 'Kegiatan/sekarang',
						'menu_text' => 'Kegiatan Pengurus',
					], [
						'menu_link' => 'Dashboard/kg_terbaru',
						'menu_text' => 'Kegiatan Terbaru',
					], [
						'menu_link' => 'Dashboard/kegiatan',
						'menu_text' => 'KegiatanKu',
					], [
						'menu_link' => 'Pengurus/postinganku',
						'menu_text' => 'PostinganKu',
					]
				],
			],
			[
				'has-sub' => TRUE,
				'menu_color' => 'bg-warning bg-darken-4',
				'menu_text' => 'Keuangan',
				'menu_icon' => 'fas fa-file-contract',
				'menu_child' =>	[
					[
						'menu_link' => 'Dashboard/tagihan',
						'menu_text' => 'Histori Tagihan',
					], [

						'menu_link' => 'Dashboard/histori_pb',
						'menu_text' => 'Histori Pembayaran',
					], [

						'menu_link' => 'Pengurus/histori_pm',
						'menu_text' => 'Histori Pemasukan',
					], [
						'menu_link' => 'Pengurus/histori_pk',
						'menu_text' => 'Histori Pengeluaran',
					]
				],
			], [
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard/profil',
				'menu_text' => 'Data Diri',
				'menu_color' => 'bg-info bg-darken-4',
				'menu_icon' => 'ft-user'
			],
		];
		return $data;
	}
	function sidebar_kaprodi()	//LEVEL 2 KAPRODI
	{
		$data = [
			[
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard',
				'menu_text' => 'Dashboard',
				'menu_color' => '',
				'menu_icon' => 'ft-home'
			],
			[
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard/himpunan',
				'menu_text' => 'Himpunan',
				'menu_color' => 'bg-danger bg-darken-4',
				'menu_icon' => 'ft-star'
			],
			[
				'has-sub' => TRUE,
				'menu_color' => 'bg-primary bg-darken-4',
				'menu_text' => 'Anggota',
				'menu_icon' => 'ft-users',
				'menu_child' =>	[
					[
						'menu_link' => 'Kprodi/pengurus',
						'menu_text' => 'Anggota Pengurus',

					], [
						'menu_link' => 'Kprodi/anggota',
						'menu_text' => 'Anggota Lainnya',

					],
				],
			],
			[
				'has-sub' => TRUE,
				'menu_color' => 'bg-success bg-darken-4',
				'menu_text' => 'Kegiatan',
				'menu_icon' => 'ft-layers',
				'menu_child' =>	[
					[
						'menu_link' => 'Kprodi/kegiatan',
						'menu_text' => 'Kegiatan Pengurus',

					], [
						'menu_link' => 'Dashboard/kg_terbaru',
						'menu_text' => 'Kegiatan Terbaru',
					], [

						'menu_link' => 'Kprodi/postingan',
						'menu_text' => 'Postingan',
					]
				],
			],
		];
		return $data;
	}
	function sidebar_ketua()	//LEVEL 3 KETUA
	{
		$data = [
			[
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard',
				'menu_text' => 'Dashboard',
				'menu_color' => '',
				'menu_icon' => 'ft-home'
			], [
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard/himpunan',
				'menu_color' => 'bg-danger bg-darken-4',
				'menu_text' => 'Himpunan',
				'menu_icon' => 'ft-star',
			], [
				'has-sub' => TRUE,
				'menu_color' => 'bg-primary bg-darken-4',
				'menu_text' => 'Anggota',
				'menu_icon' => 'ft-users',
				'menu_child' =>	[
					[
						'menu_link' => 'Pengurus/anggota',
						'menu_text' => 'Anggota Pengurus',

					], [
						'menu_link' => 'Anggota/all',
						'menu_text' => 'Anggota Lainnya',

					],
				],
			], [
				'has-sub' => TRUE,
				'menu_color' => 'bg-success bg-darken-4',
				'menu_text' => 'Kegiatan',
				'menu_icon' => 'ft-layers',
				'menu_child' =>	[
					[
						'menu_link' => 'Kegiatan/sekarang',
						'menu_text' => 'Kegiatan Pengurus',

					], [
						'menu_link' => 'Dashboard/kg_terbaru',
						'menu_text' => 'Kegiatan Terbaru',
					], [
						'menu_link' => 'Dashboard/kegiatan',
						'menu_text' => 'KegiatanKu',
					], [

						'menu_link' => 'Pengurus/postinganku',
						'menu_text' => 'PostinganKu',
					]
				],
			], [
				'has-sub' => TRUE,
				'menu_color' => 'bg-warning bg-darken-4',
				'menu_text' => 'Keuangan',
				'menu_icon' => 'fas fa-file-contract',
				'menu_child' =>	[
					[
						'menu_link' => 'Dashboard/tagihan',
						'menu_text' => 'Histori Tagihan',
					], [

						'menu_link' => 'Dashboard/histori_pb',
						'menu_text' => 'Histori Pembayaran',
					], [

						'menu_link' => 'Pengurus/histori_pm',
						'menu_text' => 'Histori Pemasukan',
					], [

						'menu_link' => 'Pengurus/histori_pk',
						'menu_text' => 'Histori Pengeluaran',
					]
				],
			], [
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard/profil',
				'menu_text' => 'Data Diri',
				'menu_color' => 'bg-info bg-darken-4',
				'menu_icon' => 'ft-user'
			],
		];
		return $data;
	}
	function sidebar_sekretaris()	//LEVEL 4 SEKRETARIS
	{
		$data = [
			[
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard',
				'menu_text' => 'Dashboard',
				'menu_color' => '',
				'menu_icon' => 'ft-home'
			], [
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard/himpunan',
				'menu_text' => 'HimpunanKu',
				'menu_color' => 'bg-danger',
				'menu_icon' => 'ft-star'
			], [
				'has-sub' => FALSE,
				'menu_link' => 'Pengurus/anggota',
				'menu_text' => 'Anggota Pengurus',
				'menu_color' => 'bg-info',
				'menu_icon' => 'ft-users'
			], [
				'has-sub' => TRUE,
				'menu_color' => 'bg-success bg-darken-4',
				'menu_text' => 'Kegiatan',
				'menu_icon' => 'ft-layers',
				'menu_child' =>	[
					[
						'menu_link' => 'Kegiatan/sekarang',
						'menu_text' => 'Kegiatan Pengurus',
					], [
						'menu_link' => 'Dashboard/kg_terbaru',
						'menu_text' => 'Kegiatan Terbaru',
					], [
						'menu_link' => 'Dashboard/kegiatan',
						'menu_text' => 'KegiatanKu',

					], [
						'menu_link' => 'Pengurus/postinganku',
						'menu_text' => 'PostinganKu',
					]
				],
			], [
				'has-sub' => TRUE,
				'menu_color' => 'bg-warning bg-darken-4',
				'menu_text' => 'Keuangan',
				'menu_icon' => 'fas fa-file-contract',
				'menu_child' =>	[
					[
						'menu_link' => 'Dashboard/tagihan',
						'menu_text' => 'Histori Tagihan',
					], [
						'menu_link' => 'Dashboard/histori_pb',
						'menu_text' => 'Histori Pembayaran',
					], [
						'menu_link' => 'Pengurus/histori_pm',
						'menu_text' => 'Histori Pemasukan',
					], [
						'menu_link' => 'Pengurus/histori_pk',
						'menu_text' => 'Histori Pengeluaran',
					]
				],
			], [
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard/profil',
				'menu_text' => 'Data Diri',
				'menu_color' => 'bg-info bg-darken-4',
				'menu_icon' => 'ft-user'
			],
		];
		return $data;
	}
	function sidebar_bendahara()	//LEVEL 5  BENDAHARA
	{
		$data = [
			[
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard',
				'menu_text' => 'Dashboard',
				'menu_color' => '',
				'menu_icon' => 'ft-home'
			], [
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard/himpunan',
				'menu_text' => 'HimpunanKu',
				'menu_color' => 'bg-danger',
				'menu_icon' => 'ft-star'
			], [
				'has-sub' => FALSE,
				'menu_link' => 'Pengurus/anggota',
				'menu_text' => 'Anggota Pengurus',
				'menu_color' => 'bg-info',
				'menu_icon' => 'ft-users'
			], [
				'has-sub' => TRUE,
				'menu_color' => 'bg-success bg-darken-4',
				'menu_text' => 'Kegiatan',
				'menu_icon' => 'ft-layers',
				'menu_child' =>	[
					[
						'menu_link' => 'Dashboard/kg_terbaru',
						'menu_text' => 'Kegiatan Terbaru',
					], [
						'menu_link' => 'Dashboard/kegiatan',
						'menu_text' => 'KegiatanKu',

					], [

						'menu_link' => 'Pengurus/postinganku',
						'menu_text' => 'PostinganKu',
					]
				],
			], [
				'has-sub' => TRUE,
				'menu_color' => 'bg-warning bg-darken-4',
				'menu_text' => 'Keuangan',
				'menu_icon' => 'fas fa-file-contract',
				'menu_child' =>	[
					[
						'menu_link' => 'Keuangan/cash_rule',
						'menu_text' => 'Peraturan Keuangan',
					], [
						'menu_link' => 'Tagihan',
						'menu_text' => 'Tagihan',
					], [
						'menu_link' => 'Dashboard/tagihan',
						'menu_text' => 'Histori TagihanKu',
					], [
						'menu_link' => 'Dashboard/histori_pb',
						'menu_text' => 'Histori Pembayaran',
					], [
						'menu_link' => 'Pengurus/histori_pm',
						'menu_text' => 'Histori Pemasukan',
					], [
						'menu_link' => 'Pengurus/histori_pk',
						'menu_text' => 'Histori Pengeluaran',
					]
				],
			], [
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard/profil',
				'menu_text' => 'Data Diri',
				'menu_color' => 'bg-info bg-darken-4',
				'menu_icon' => 'ft-user'
			],
		];
		return $data;
	}
	function sidebar_pengurus()	//LEVEL 6 & 7  Pengurus & Demisioner
	{
		$data = [
			[
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard',
				'menu_text' => 'Dashboard',
				'menu_color' => '',
				'menu_icon' => 'ft-home'
			], [
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard/himpunan',
				'menu_text' => 'HimpunanKu',
				'menu_color' => 'bg-danger',
				'menu_icon' => 'ft-star'
			], [
				'has-sub' => FALSE,
				'menu_link' => 'Pengurus/anggota',
				'menu_text' => 'Anggota Pengurus',
				'menu_color' => 'bg-info',
				'menu_icon' => 'ft-users'
			], [
				'has-sub' => TRUE,
				'menu_color' => 'bg-success bg-darken-4',
				'menu_text' => 'Kegiatan',
				'menu_icon' => 'ft-layers',
				'menu_child' =>	[
					[
						'menu_link' => 'Dashboard/kg_terbaru',
						'menu_text' => 'Kegiatan Terbaru',
					], [
						'menu_link' => 'Dashboard/kegiatan',
						'menu_text' => 'KegiatanKu',
					], [
						'menu_link' => 'Pengurus/postinganku',
						'menu_text' => 'PostinganKu',
					]
				],
			], [
				'has-sub' => TRUE,
				'menu_color' => 'bg-warning bg-darken-4',
				'menu_text' => 'Keuangan',
				'menu_icon' => 'fas fa-file-contract',
				'menu_child' =>	[
					[
						'menu_link' => 'Dashboard/tagihan',
						'menu_text' => 'Histori Tagihan',
					], [
						'menu_link' => 'Dashboard/histori_pb',
						'menu_text' => 'Histori Pembayaran',
					], [
						'menu_link' => 'Pengurus/histori_pm',
						'menu_text' => 'Histori Pemasukan',
					], [
						'menu_link' => 'Pengurus/histori_pk',
						'menu_text' => 'Histori Pengeluaran',
					]
				],
			], [
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard/profil',
				'menu_text' => 'Data Diri',
				'menu_color' => 'bg-info bg-darken-4',
				'menu_icon' => 'ft-user'
			],
		];
		return $data;
	}
	function sidebar_anggota()	//LEVEL 8	Anggota Biasa
	{
		$data = [
			[
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard',
				'menu_text' => 'Dashboard',
				'menu_color' => '',
				'menu_icon' => 'ft-home'
			], [
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard/himpunan',
				'menu_text' => 'HimpunanKu',
				'menu_color' => 'bg-danger',
				'menu_icon' => 'ft-star'
			],
			[
				'has-sub' => TRUE,
				'menu_color' => 'bg-success bg-darken-4',
				'menu_text' => 'Kegiatan',
				'menu_icon' => 'ft-layers',
				'menu_child' =>	[
					[
						'menu_link' => 'Dashboard/kg_terbaru',
						'menu_text' => 'Kegiatan Terbaru',
					], [
						'menu_link' => 'Dashboard/kegiatan',
						'menu_text' => 'KegiatanKu',
					]
				],
			],
			[
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard/tagihan',
				'menu_text' => 'Histori Tagihan',
				'menu_color' => 'bg-warning bg-darken-4',
				'menu_icon' => 'ft-layers'
			],
			[
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard/histori_pb',
				'menu_text' => 'Histori Pembayaran',
				'menu_color' => 'bg-success bg-darken-4',
				'menu_icon' => 'ft-layers'
			],
			[
				'has-sub' => FALSE,
				'menu_link' => 'Dashboard/profil',
				'menu_text' => 'Data Diri',
				'menu_color' => 'bg-info bg-darken-4',
				'menu_icon' => 'ft-user'
			],
		];
		return $data;
	}
}
