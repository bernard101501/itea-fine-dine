<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['main'] = 'Food/index';
$route['booking'] = 'Food/customer_detail';
$route['starter'] = 'Food/starter';
