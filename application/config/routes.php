<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']    = 'Dashboard';     //Controller yang pertama kali diakses
$route['404_override']          = '';
$route['translate_uri_dashes']  = FALSE;

// MASTER DATA
$route['Admin/ctrlr']          = 'sistem/ctrlr/index';
$route['Admin/ctrlr/insert']   = 'sistem/ctrlr/insert';
$route['Admin/ctrlr/update']   = 'sistem/ctrlr/update';
$route['Admin/ctrlr/delete']   = 'sistem/ctrlr/delete';
$route['Admin/ctrlr/get']      = 'sistem/ctrlr/get_ctrlr';

$route['Admin/role']          = 'sistem/role/index';
$route['Admin/role/insert']   = 'sistem/role/insert';
$route['Admin/role/update']   = 'sistem/role/update';
$route['Admin/role/delete']   = 'sistem/role/delete';
$route['Admin/role/get']      = 'sistem/role/get_role';

$route['Admin/jabatan']          = 'sistem/jabatan/index';
$route['Admin/jabatan/insert']   = 'sistem/jabatan/insert';
$route['Admin/jabatan/update']   = 'sistem/jabatan/update';
$route['Admin/jabatan/delete']   = 'sistem/jabatan/delete';
$route['Admin/jabatan/get']      = 'sistem/jabatan/get_jabatan';


//KEGIATAN
$route['Kegiatan']              = 'Kegiatan/sekarang';
$route['Pembayaran/(:num)']     = 'Pembayaran/index/$1';

//INFORMASI PESERTA
$route['home']              = 'HM/index';
$route['informasi/(:any)']  = 'Register/info/$1';
$route['cetak_info_peserta/(:any)']  = 'Register/cetak/$1';

//PRESENSI ONLINE
$route['presensi_online/(:any)'] = 'Presensi/online/$1';
