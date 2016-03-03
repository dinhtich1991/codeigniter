<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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

$route['default_controller'] = "frontend/home/index";
$route['backend$'] = 'backend/home/index';
// Category

$route['([a-zA-Z0-9/-]+)-68(\d+)$'] = 'frontend/article/category/$2';
$route['([a-zA-Z0-9/-]+)-68(\d+)/(\d+)$'] = 'frontend/article/category/$2/$3';
$route['([a-zA-Z0-9/-]+)-68(\d+)/trang-(\d+)$'] = 'frontend/article/category/$2/$3';

$route['([a-zA-Z0-9/-]+)-88(\d+)$'] = 'frontend/article/item/$2';

// Trang co dinh
$route['gioi-thieu'] = 'frontend/intro/index';
$route['dang-ky'] = 'frontend/account/register';
//$route['bo-suu-tap'] = 'frontend/galary/bst';
$route['bo-suu-tap/trang-(\d+)'] = 'frontend/galary/bstdetail/$1';

// Lang
$route['en'] = 'frontend/home/index/en';
$route['jp'] = 'frontend/home/index/jp';


require_once 'route';
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */