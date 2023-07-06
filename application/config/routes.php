<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']    = 'Dashboard';     //Controller yang pertama kali diakses
$route['404_override']          = '';
$route['translate_uri_dashes']  = FALSE;

//KEGIATAN
$route['Kegiatan']          = 'Kegiatan/sekarang';
$route['Pembayaran/(:num)'] = 'Pembayaran/index/$1';

//INFORMASI PESERTA
$route['home']              = 'HM/index';
$route['informasi/(:any)']  = 'Register/info/$1';
