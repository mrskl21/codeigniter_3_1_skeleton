<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// auth
$route['login'] = 'auth/c_login/login';
$route['logout'] = 'auth/c_login/logout';
$route['validate'] = 'auth/c_login/validate';
// $route['registration'] = 'auth/c_login/registration';
// $route['registration/attemp']['POST'] = 'auth/c_login/reg_attemp';

$route['auth/users'] = 'auth/c_users';
$route['auth/users/data'] = 'auth/c_users/data';
$route['auth/users/create']['POST'] = 'auth/c_users/create';
$route['auth/users/get']['POST'] = 'auth/c_users/get';
$route['auth/users/update']['POST'] = 'auth/c_users/update';
$route['auth/users/update_image']['POST'] = 'auth/c_users/update_image';
$route['auth/users/delete']['POST'] = 'auth/c_users/delete';
$route['auth/users/password_update']['POST'] = 'auth/c_users/password_update';

$route['auth/roles'] = 'auth/c_roles';
$route['auth/roles/data'] = 'auth/c_roles/data';
$route['auth/roles/create']['POST'] = 'auth/c_roles/create';
$route['auth/roles/get']['POST'] = 'auth/c_roles/get';
$route['auth/roles/update']['POST'] = 'auth/c_roles/update';
$route['auth/roles/delete']['POST'] = 'auth/c_roles/delete';
$route['auth/roles/has_permissions']['POST'] = 'auth/c_roles/has_permissions';
$route['auth/roles/permissions_update']['POST'] = 'auth/c_roles/permissions_update';

$route['auth/permissions'] = 'auth/c_permissions';
$route['auth/permissions/data'] = 'auth/c_permissions/data';
$route['auth/permissions/create']['POST'] = 'auth/c_permissions/create';
$route['auth/permissions/get']['POST'] = 'auth/c_permissions/get';
$route['auth/permissions/update']['POST'] = 'auth/c_permissions/update';
$route['auth/permissions/delete']['POST'] = 'auth/c_permissions/delete';

//ref
$route['ref/settings'] = 'ref/c_settings';
$route['ref/settings/data'] = 'ref/c_settings/data';
$route['ref/settings/create']['POST'] = 'ref/c_settings/create';
$route['ref/settings/get']['POST'] = 'ref/c_settings/get';
$route['ref/settings/update']['POST'] = 'ref/c_settings/update';
$route['ref/settings/delete']['POST'] = 'ref/c_settings/delete';

//main

$route['home'] = 'dash/c_home';
$route['dash/child'] = 'dash/c_child';
$route['dash/child/data'] = 'dash/c_child/data';
$route['dash/child/create']['POST'] = 'dash/c_child/create';
$route['dash/child/get']['POST'] = 'dash/c_child/get';
$route['dash/child/update']['POST'] = 'dash/c_child/update';
$route['dash/child/update_image']['POST'] = 'dash/c_child/update_image';
$route['dash/child/delete']['POST'] = 'dash/c_child/delete';

$route['dash/child/medical_record/(:num)'] = 'dash/c_child/medical_record/$1';
$route['dash/child/medical_record/create'] = 'dash/c_child/medical_create';

$route['profile'] = 'auth/c_profile';
$route['profile/update']['POST'] = 'auth/c_profile/update';
$route['profile/update_password']['POST'] = 'auth/c_profile/update_password';
$route['profile/update_image']['POST'] = 'auth/c_profile/update_image';
// end

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

