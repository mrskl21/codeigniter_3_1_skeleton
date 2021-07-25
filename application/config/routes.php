<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// auth
$route['login'] = 'auth/c_login/login';
$route['signin/(:num)/(:any)'] = 'auth/c_login/signin/$1/$2';
$route['logout'] = 'auth/c_login/logout';
$route['validate'] = 'auth/c_login/validate';
$route['registration'] = 'auth/c_login/registration';
$route['registration/attemp']['POST'] = 'auth/c_login/reg_attemp';

$route['auth/users'] = 'auth/c_users';
$route['auth/users/data'] = 'auth/c_users/data';
$route['auth/users/create']['POST'] = 'auth/c_users/create';
$route['auth/users/get']['POST'] = 'auth/c_users/get';
$route['auth/users/update']['POST'] = 'auth/c_users/update';
$route['auth/users/delete']['POST'] = 'auth/c_users/delete';
$route['auth/users/password_update']['POST'] = 'auth/c_users/password_update';

$route['auth/users/profile'] = 'auth/c_profile';
$route['auth/users/profile/update_profile']['POST'] = 'auth/c_profile/update_profile';
$route['auth/users/profile/update_password']['POST'] = 'auth/c_profile/update_password';
$route['auth/users/profile/update_sign']['POST'] = 'auth/c_profile/update_sign';

$route['auth/users/profile'] = 'auth/c_users/profile';
$route['auth/users/profile/update_profile']['POST'] = 'auth/c_users/update_profile';
$route['auth/users/profile/update_password']['POST'] = 'auth/c_users/update_password';
$route['auth/users/profile/update_sign']['POST'] = 'auth/c_users/update_sign';

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

//main
$route['home'] = 'dash/c_home';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

