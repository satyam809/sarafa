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
$route['default_controller'] = 'fronthome'; 
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['change_password'] = 'fronthome/change_password';
$route['contact'] = 'pages/contact';
$route['aboutus'] = 'pages/aboutus';
$route['bid_list'] = 'orders/bid_list';
$route['inquiry_list'] = 'orders/inquiry_list';
$route['stor_rereset_password/(:any)'] = 'admin/vendor/store_reset_password/$1';
$route['reset_password'] = 'admin/vendor/reset_password';
$route['expired_password'] = 'admin/vendor/expired_password';
$route['admin/vendor_log_history'] = 'admin/vendor/vendor_log_history';

$route['register'] = 'login/register';
$route['signup'] = 'login/signup';
$route['signin'] = 'login/signin';

$route['privacy_policy'] = 'pages/prrivacy_policy';
$route['terms_conditions'] = 'pages/terms_conditions';
$route['refund_policy'] = 'pages/refund_policy';
$route['disclaimer_policy'] = 'pages/disclaimer_policy';
$route['vendor_agreement'] = 'pages/vendor_agreement';

$route['store_user_reset_password/(:any)'] = 'login/store_user_reset_password/$1';
$route['user_reset_password'] = 'login/user_reset_password';
$route['user_expired_password'] = 'login/user_expired_password';

$route['store_vendor_reset_password/(:any)'] = 'vendor/store_vendor_reset_password/$1';
$route['vendor_reset_password'] = 'vendor/vendor_reset_password';
$route['vendor_expired_password'] = 'vendor/vendor_expired_password';

$route['order_success'] = 'cart/place_order/order_success';

$route['faq'] = 'fronthome/faq';