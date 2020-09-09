<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// default
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// auth
$route['login'] = 'auth';
$route['logout'] = 'auth/logout';

// akses petugas
$route['petugas/akses'] = 'akses';
$route['petugas/tambah_akses'] = 'akses/tambah';
$route['petugas/hapus_akses/(:any)'] = 'akses/hapus/$1';
$route['petugas/ubah_akses/(:any)'] = 'akses/ubah/$1';
$route['petugas/ubah_akses_role/(:any)/(:any)'] = 'akses/ubah_akses/$1/$2';

// kamar
$route['master/kamar'] = 'kamar';
$route['master/tambah_kamar'] = 'kamar/tambah';
$route['master/hapus_kamar/(:any)'] = 'kamar/hapus/$1';
$route['master/ubah_kamar/(:any)'] = 'kamar/ubah/$1';

// pengunjung
$route['master/pengunjung'] = 'pengunjung';
$route['master/tambah_pengunjung'] = 'pengunjung/tambah';
$route['master/hapus_pengunjung/(:any)'] = 'pengunjung/hapus/$1';
$route['master/ubah_pengunjung/(:any)'] = 'pengunjung/ubah/$1';