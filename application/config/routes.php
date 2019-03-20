<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth/login';
$route['404_override'] = 'errors/error_404';
$route['translate_uri_dashes'] = FALSE;

//auth
$route['login'] = 'auth/login';
$route['lupa-password'] = 'auth/lupa_password';
$route['login/proses'] = 'auth/proses/login';
$route['lupa-password/proses'] = 'auth/proses/lupa-password';
$route['logout'] = 'auth/logout';

//jenis
$route['data/jenis'] = 'jenis';
$route['data/jenis/tambah'] = 'jenis/tambah';
$route['data/jenis/edit/(:num)'] = 'jenis/edit/$1';
$route['data/jenis/hapus/(:num)'] = 'jenis/hapus/$1';
$route['data/jenis/hapus/all'] = 'jenis/hapus/all';

//ruang
$route['data/ruang'] = 'ruang';
$route['data/ruang/tambah'] = 'ruang/tambah';
$route['data/ruang/edit/(:num)'] = 'ruang/edit/$1';
$route['data/ruang/hapus/(:num)'] = 'ruang/hapus/$1';
$route['data/ruang/hapus/all'] = 'ruang/hapus/all';

//petugas
$route['users/petugas'] = 'petugas';
$route['users/petugas/tambah'] = 'petugas/tambah';
$route['users/petugas/edit/(:num)'] = 'petugas/edit/$1';
$route['users/petugas/hapus/(:num)'] = 'petugas/hapus/$1';
$route['users/petugas/hapus/all'] = 'petugas/hapus/all';

//peminjam
$route['users/peminjam'] = 'peminjam';
$route['users/peminjam/tambah'] = 'peminjam/tambah';
$route['users/peminjam/detail/(:num)'] = 'peminjam/detail/$1';
$route['users/peminjam/edit/(:num)'] = 'peminjam/edit/$1';
$route['users/peminjam/hapus/(:num)'] = 'peminjam/hapus/$1';
$route['users/peminjam/hapus/all'] = 'peminjam/hapus/all';

//pegawai
$route['users/pegawai'] = 'pegawai';
$route['users/pegawai/tambah'] = 'pegawai/tambah';
$route['users/pegawai/edit/(:num)'] = 'pegawai/edit/$1';
$route['users/pegawai/hapus/(:num)'] = 'pegawai/hapus/$1';
$route['users/pegawai/hapus/all'] = 'pegawai/hapus/all';

//errors
$route['404'] = 'errors/error_404';
$route['403'] = 'errors/error_403';
$route['500'] = 'errors/error_500';
$route['503'] = 'errors/error_503';
$route['forbidden'] = 'errors/forbidden';