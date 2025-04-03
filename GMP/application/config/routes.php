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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = $route['default_controller'] . '/index';
$route['logout'] = $route['default_controller'] . '/A_logout_sessionDestroy';
$route['dashboard']=$route['default_controller'].'/dashboard_page';
$route['customer-reg']=$route['default_controller'].'/customer_page';
$route['supplier-reg']=$route['default_controller'].'/supplier_page';
$route['labour-reg']=$route['default_controller'].'/labour_page';
$route['units-master']=$route['default_controller'].'/units_page';
$route['raw-master']=$route['default_controller'].'/raw_page';
$route['pieces-master']=$route['default_controller'].'/pieces_page';
$route['purchase-order']=$route['default_controller'].'/purchase_page';
$route['purchase-cash-entry']=$route['default_controller'].'/purchase_entry_page';
$route['manufacturing-stock']=$route['default_controller'].'/manufacturing_stock_page';
$route['daily-mfd-stock']=$route['default_controller'].'/daily_mfd_stock_page';
$route['settings']=$route['default_controller'].'/setting_page';
$route['sales']=$route['default_controller'].'/sales_page';
$route['sales-cash-entry']=$route['default_controller'].'/sales_entry_page';
$route['print-details']=$route['default_controller'].'/print_SalesInvoice';
// $route['welcome/print_SalesInvoice/(:num)'] = 'welcome/print_SalesInvoice/$1';

//------------Reports--------
$route['material-report']=$route['default_controller'].'/raw_material_report';
$route['purchase-report']=$route['default_controller'].'/purchase_report_page';
$route['mfd-report']=$route['default_controller'].'/mfd_stock_report';
$route['ready-mfd-report']=$route['default_controller'].'/ready_mfd_report';
$route['sales-report']=$route['default_controller'].'/sales_report';



