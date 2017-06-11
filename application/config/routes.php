<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */

$route['default_controller'] = 'front/home';

//Management URL link Backend
$route['admin-login'] = 'backend/c_login';
$route['dashboard'] = 'backend/c_dashboard';

$route['kategori_user'] = 'backend/c_kategori_user';
$route['register_user'] = 'backend/c_reg_user';
$route['member'] = 'backend/c_member';
$route['seminar-admin'] = 'backend/c_seminar';
$route['report'] = 'backend/c_report';

//Management URL link Frontend
$route['login'] = 'front/member';
$route['logout'] = 'front/member/logout';
$route['member-dashboard'] = 'front/c_biomember';
$route['update-member'] = 'front/c_biomember/update_member';
$route['list-seminar'] = 'front/c_biomember/list_seminar';
$route['seminar/(:any)'] = 'front/all_seminar/index/$1';
$route['seminar'] = 'front/all_seminar/index/1';
$route['profil'] = 'front/home/profil';
$route['resend-confirmation'] = 'front/member/resend_confirmation';
$route['account-confirmations'] = 'front/member/confirmation';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* End of file routes.php */
/* Location: ./application/config/routes.php */