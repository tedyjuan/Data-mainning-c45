<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'Dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//# ==========[ DATA GOAL ]=============
$route['data-goal'] = 'C_goal';
$route['tambah-goal'] = 'C_goal/tambah_data';
$route['insert-goal'] = 'C_goal/simpan_data';
$route['hapus-goal'] = 'C_goal/hapus_data';
$route['edit-goal/(:any)'] = 'C_goal/edit_form/$1';
$route['upload-goal/(:any)'] = 'C_goal/upload_form/$1';
$route['update-goal'] =  'C_goal/update_data';
$route['preview-atribute'] =  'C_goal/preview_excel';

// ==========[ DATA MAINING ]=============
$route['data-maining'] = 'C_maining';
$route['show-maining'] = 'C_maining/show_data_maining';
