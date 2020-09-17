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
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/
$route['default_controller'] = 'Auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

/* Auth */
$route['login'] = 'Auth/login';
$route['login_process'] = 'Auth/login_process';
$route['registrasi'] = 'Auth/registration';
$route['register_process'] = 'Auth/register_process';
$route['atur_ulang_kata_sandi'] = 'Auth/forget_password';

/* Admin */
$route['admin_side/launcher'] = 'admin/App/launcher';
$route['admin_side/beranda'] = 'admin/App/home';
$route['admin_side/menu'] = 'admin/App/menu';
$route['admin_side/log_activity'] = 'admin/App/log_activity';
$route['admin_side/cleaning_log'] = 'admin/App/cleaning_log';
$route['admin_side/tentang_aplikasi'] = 'admin/App/about';
$route['admin_side/bantuan'] = 'admin/App/helper';

$route['admin_side/dasbor_peta'] = 'admin/Dashboard';
$route['admin_side/peta_provinsi/(:any)'] = 'admin/Dashboard/province/$1';
$route['admin_side/peta_kabupaten/(:any)'] = 'admin/Dashboard/city/$1';
$route['admin_side/peta_kecamatan/(:any)'] = 'admin/Dashboard/sub_district/$1';

$route['admin_side/dasbor_grafik'] = 'admin/Dashboard/main_graph';
$route['admin_side/dasbor_grafik_provinsi/(:any)/(:any)'] = 'admin/Dashboard/graph_province/$1/$2';
$route['admin_side/dasbor_grafik_kabupaten/(:any)/(:any)'] = 'admin/Dashboard/graph_region/$1/$2';
$route['admin_side/dasbor_grafik_kecamatan/(:any)/(:any)'] = 'admin/Dashboard/graph_district/$1/$2';

$route['admin_side/administrator'] = 'admin/Master/administrator_data';
$route['admin_side/tambah_data_admin'] = 'admin/Master/add_administrator_data';
$route['admin_side/simpan_data_admin'] = 'admin/Master/save_administrator_data';
$route['admin_side/detail_data_admin/(:any)'] = 'admin/Master/detail_administrator_data/$1';
$route['admin_side/ubah_data_admin/(:any)'] = 'admin/Master/edit_administrator_data/$1';
$route['admin_side/perbarui_data_admin'] = 'admin/Master/update_administrator_data';
$route['admin_side/atur_ulang_kata_sandi_admin/(:any)'] = 'admin/Master/reset_password_administrator_account/$1';
$route['admin_side/hapus_data_admin/(:any)'] = 'admin/Master/delete_administrator_data/$1';

$route['admin_side/data_anggota'] = 'admin/Master/member_data';
$route['admin_side/tambah_data_anggota'] = 'admin/Master/add_member_data';
$route['admin_side/simpan_data_anggota'] = 'admin/Master/save_member_data';
$route['admin_side/ubah_data_anggota/(:any)'] = 'admin/Master/edit_member_data/$1';
$route['admin_side/perbarui_data_anggota'] = 'admin/Master/update_member_data';
$route['admin_side/atur_ulang_kata_sandi_anggota/(:any)'] = 'admin/Master/reset_password_member_account/$1';
$route['admin_side/hapus_data_anggota/(:any)'] = 'admin/Master/delete_member_data/$1';

$route['admin_side/antrean_kk'] = 'admin/Master/antrean_kk';
$route['admin_side/tambah_data_kk'] = 'admin/Master/tambah_data_kk';
$route['admin_side/ajukan_permohonan_kk'] = 'admin/Master/simpan_data_kk';
$route['admin_side/detil_data_pengajuan_kk/(:any)'] = 'admin/Report/detil_data_pengajuan_kk/$1';
$route['admin_side/perbarui_data_antrean_kk'] = 'admin/Master/perbarui_data_antrean_kk';
$route['admin_side/hapus_data_pengajuan_kk/(:any)'] = 'admin/Report/hapus_data_pengajuan_kk/$1';
$route['admin_side/antrean_ktp'] = 'admin/Master/antrean_ktp';
$route['admin_side/tambah_data_ktp'] = 'admin/Master/tambah_data_ktp';
$route['admin_side/simpan_data_ktp'] = 'admin/Master/simpan_data_ktp';
$route['admin_side/perbarui_data_antrean_ktp'] = 'admin/Report/perbarui_data_antrean_ktp';
$route['admin_side/ubah_status_tercetak/(:any)'] = 'admin/Report/ubah_status_tercetak/$1';
$route['admin_side/hapus_data_antrean_ktp/(:any)'] = 'admin/Master/hapus_data_antrean_ktp/$1';

$route['admin_side/data_antrean'] = 'admin/Report/data_antrean';
$route['admin_side/data_kk'] = 'admin/Report/data_kk';
$route['admin_side/perbarui_permohonan_kk'] = 'admin/Master/perbarui_permohonan_kk';
$route['admin_side/data_ktp'] = 'admin/Report/data_ktp';
$route['admin_side/cetak_nik'] = 'admin/Report/cetak_nik';

/* Member */
$route['member_side/launcher'] = 'member/App/launcher';
$route['member_side/beranda'] = 'member/App/home';
$route['member_side/menu'] = 'member/App/menu';
$route['member_side/log_activity'] = 'member/App/log_activity';
$route['member_side/cleaning_log'] = 'member/App/cleaning_log';
$route['member_side/tentang_aplikasi'] = 'member/App/about';
$route['member_side/bantuan'] = 'member/App/helper';

$route['member_side/tambah_data_pengajuan_ktp'] = 'member/Master/tambah_data_ktp';
$route['member_side/ajukan_cetak_ktp'] = 'member/Master/simpan_data_ktp';
$route['member_side/daftar_permohonan_kk'] = 'member/Master/daftar_permohonan_kk';
$route['member_side/ajukan_data_kk'] = 'member/Master/ajukan_data_kk';
$route['member_side/riwayat_pengajuan_ktp'] = 'member/Report/riwayat_pengajuan_ktp';
$route['member_side/perbarui_data_pengajuan_ktp'] = 'member/Report/perbarui_data_pengajuan_ktp';
$route['member_side/hapus_data_pengajuan_ktp/(:any)'] = 'member/Report/hapus_data_pengajuan_ktp/$1';

$route['member_side/riwayat_pengajuan_kk'] = 'member/Report/riwayat_pengajuan_kk';
$route['member_side/tambah_data_pengajuan_kk'] = 'member/Master/tambah_data_kk';
$route['member_side/ajukan_permohonan_kk'] = 'member/Master/simpan_data_kk';
$route['member_side/detil_data_pengajuan_kk/(:any)'] = 'member/Report/detil_data_pengajuan_kk/$1';
$route['member_side/hapus_data_pengajuan_kk/(:any)'] = 'member/Report/hapus_data_pengajuan_kk/$1';
$route['member_side/hapus_data_pengajuan_kk/(:any)/(:any)'] = 'member/Report/hapus_data_pengajuan_kk/$1/$2';

/* REST API */
$route['api'] = 'Rest_server/documentation';

$route['api/login'] = 'api/auth/Login';
$route['api/change_password'] = 'api/auth/Change_password';

$route['api/indikator'] = 'api/master/Indikator';
$route['api/user_data'] = 'api/master/User_data';
$route['api/device'] = 'api/master/Device';
$route['api/provinsi'] = 'api/master/Provinsi';
$route['api/kabupaten'] = 'api/master/Kabupaten';
$route['api/kecamatan'] = 'api/master/Kecamatan';
$route['api/desa'] = 'api/master/Desa';

$route['api/hapus_laporan'] = 'api/Other/delete_report';

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8