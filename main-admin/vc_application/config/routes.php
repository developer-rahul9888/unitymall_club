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
$route['default_controller'] = 'user/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/* Admin */
$route['admin'] = 'user/index';
$route['welcome'] = 'user/admin_welcome';
$route['login'] = 'user/index';
$route['logout'] = 'user/logout';

$route['login/validate_credentials'] = 'user/validate_credentials';
$route['forgetpassword'] = 'vc_site_admin/user/forgot_admin_Password';
$route['admin/distributor_login'] = 'vc_site_admin/user/distributor_login';
$route['admin/activity_log'] = 'vc_site_admin/customer/activity_log';
$route['admin/activity_log/(:any)'] = 'vc_site_admin/customer/activity_log_by_id/$1';

$route['admin/setting'] = 'vc_site_admin/search/setting';

/*Orders*/
$route['admin/order'] = 'vc_site_admin/order/index';
$route['admin/purchased_voucher'] = 'vc_site_admin/order/purchased_voucher';
$route['admin/voucher_import'] = 'vc_site_admin/order/voucher_import';
$route['admin/order/(:num)'] = 'vc_site_admin/order/order_view/$1';
$route['admin/order/distribute/(:num)'] = 'vc_site_admin/order/order_distribute/$1';

/*customers*/
$route['admin/customer'] = 'vc_site_admin/customer/index';
$route['admin/franchise_list'] = 'vc_site_admin/customer/franchise_list';
$route['admin/customer_all'] = 'vc_site_admin/customer/customer_all';
$route['admin/customer/add'] = 'vc_site_admin/customer/add';
$route['admin/customer/edit/(:num)'] = 'vc_site_admin/customer/update/$1';
$route['admin/customer/del/(:num)'] = 'vc_site_admin/customer/del/$1';
$route['admin/wallet/add'] = 'vc_site_admin/customer/wallet';


$route['admin/wallet_request_list'] = 'vc_site_admin/customer/wallet_request_list';
$route['admin/pin_request/edit/(:num)'] = 'vc_site_admin/customer/pin_request_update/$1';
$route['admin/company_turnover_distribution'] = 'vc_site_admin/customer/company_turnover_distribution';
$route['admin/field_expense_distribution'] = 'vc_site_admin/customer/field_expense_distribution';
$route['admin/reward'] = 'vc_site_admin/customer/reward';
$route['admin/reward/edit/(:num)'] = 'vc_site_admin/customer/reward/$1';
//$route['admin/wallet'] = 'vc_site_admin/customer/wallet_summery';
$route['admin/wallet/history'] = 'vc_site_admin/customer/wallet_history';

/*review*/
$route['admin/review'] = 'vc_site_admin/review/index';
$route['admin/review/add'] = 'vc_site_admin/review/add';
$route['admin/review/edit/(:num)'] = 'vc_site_admin/review/update/$1';
$route['admin/review/del/(:num)'] = 'vc_site_admin/review/del/$1';
//$route['admin/news/add'] = 'vc_site_admin/review/news_add';



/*offers and for dynamics slider src*/
$route['admin/offer'] = 'vc_site_admin/offer/index';
$route['admin/offer/add'] = 'vc_site_admin/offer/add';
$route['admin/offer/edit/(:num)'] = 'vc_site_admin/offer/update/$1';
$route['admin/offer/del/(:num)'] = 'vc_site_admin/offer/del/$1';
$route['admin/banner/add'] = 'vc_site_admin/offer/banner_add';
$route['admin/banner/addnew'] = 'vc_site_admin/offer/banner';

/*News*/
$route['admin/news'] = 'vc_site_admin/news/index';
$route['admin/news/add'] = 'vc_site_admin/news/add';
$route['admin/news/edit/(:num)'] = 'vc_site_admin/news/update/$1';
$route['admin/news/del/(:num)'] = 'vc_site_admin/news/del/$1';

/*redeem*/
$route['admin/redeam'] = 'vc_site_admin/redeam/index';
$route['admin/redeam/add'] = 'vc_site_admin/redeam/add';
$route['admin/redeam/edit/(:num)'] = 'vc_site_admin/redeam/update/$1';
$route['admin/redeam/del/(:num)'] = 'vc_site_admin/redeam/del/$1';

/*Upgrade*/
$route['admin/upgrade'] = 'vc_site_admin/upgrade/index';
$route['admin/upgrade/add'] = 'vc_site_admin/upgrade/add';
$route['admin/upgrade/edit/(:num)'] = 'vc_site_admin/upgrade/update/$1';
$route['admin/upgrade/del/(:num)'] = 'vc_site_admin/upgrade/del/$1';

/*doc verification*/
$route['admin/docverification'] = 'vc_site_admin/docverification/index';
$route['admin/docverification/add'] = 'vc_site_admin/docverification/add';
$route['admin/docverification/edit/(:num)'] = 'vc_site_admin/docverification/update/$1';
$route['admin/docverification/del/(:num)'] = 'vc_site_admin/docverification/del/$1';
$route['admin/doc_list'] = 'vc_site_admin/docverification/doc_list';
 
 
/*product*/
$route['admin/stoke'] = 'vc_site_admin/product/stoke';
$route['admin/stoke/add'] = 'vc_site_admin/product/stoke_add';
$route['admin/stoke/edit/(:num)'] = 'vc_site_admin/product/stoke_update/$1';
$route['admin/stoke/del/(:num)'] = 'vc_site_admin/product/stoke_del/$1';

/*product*/
$route['admin/product'] = 'vc_site_admin/product/index';
$route['admin/product/add'] = 'vc_site_admin/product/add';
$route['admin/product/edit/(:num)'] = 'vc_site_admin/product/update/$1';
$route['admin/product/del/(:num)'] = 'vc_site_admin/product/del/$1';

/*product*/
$route['admin/e_product'] = 'vc_site_admin/product/ecommerce';
$route['admin/e_product/add'] = 'vc_site_admin/product/e_add';
$route['admin/e_product/edit/(:num)'] = 'vc_site_admin/product/e_update/$1';
$route['admin/e_product/del/(:num)'] = 'vc_site_admin/product/e_del/$1';


/*Merchant product*/
$route['admin/w_product'] = 'vc_site_admin/product/web_product_list';
$route['admin/w_product/add'] = 'vc_site_admin/product/web_add';
$route['admin/w_product/edit/(:num)'] = 'vc_site_admin/product/web_update/$1';
$route['admin/w_product/del/(:num)'] = 'vc_site_admin/product/web_del/$1';


/*product*/
$route['admin/m_product'] = 'vc_site_admin/product/m_list';
$route['admin/m_product/edit/(:num)'] = 'vc_site_admin/product/m_update/$1';
$route['admin/product/del/(:num)'] = 'vc_site_admin/product/del/$1';

/*tax*/ 
$route['admin/tax'] = 'vc_site_admin/tax/index';
$route['admin/tax/add'] = 'vc_site_admin/tax/add';
$route['admin/tax/edit/(:num)'] = 'vc_site_admin/tax/update/$1';
$route['admin/tax/del/(:num)'] = 'vc_site_admin/tax/del/$1';

/*tax*/ 
$route['admin/product_sale'] = 'vc_site_admin/prodcut_sale/index';
$route['admin/product_sale/add'] = 'vc_site_admin/prodcut_sale/add';
$route['admin/product_sale/edit/(:num)'] = 'vc_site_admin/prodcut_sale/update/$1';
$route['admin/product_sale/del/(:num)'] = 'vc_site_admin/prodcut_sale/del/$1';

$route['admin/category'] = 'vc_site_admin/category/index';
$route['admin/category/add'] = 'vc_site_admin/category/add';
$route['admin/category/edit/(:num)'] = 'vc_site_admin/category/update/$1';
$route['admin/category/del/(:num)'] = 'vc_site_admin/category/del/$1';

$route['admin/coupon'] = 'vc_site_admin/coupon/index';
$route['admin/coupon/add'] = 'vc_site_admin/coupon/add';
$route['admin/coupon/edit/(:num)'] = 'vc_site_admin/coupon/update/$1';
$route['admin/coupon/del/(:num)'] = 'vc_site_admin/coupon/del/$1';

$route['admin/pin'] = 'vc_site_admin/pin/index';
$route['admin/package'] = 'vc_site_admin/pin/package_list';
$route['admin/pin/add'] = 'vc_site_admin/pin/add';
$route['admin/package/add'] = 'vc_site_admin/pin/package_add';
$route['admin/package/edit/(:num)'] = 'vc_site_admin/pin/package_update/$1';
$route['admin/pin/edit'] = 'vc_site_admin/pin/update';
$route['admin/pin/del/(:num)'] = 'vc_site_admin/pin/del/$1';
$route['admin/package/del/(:num)'] = 'vc_site_admin/pin/package_del/$1';
$route['admin/payouts'] = 'vc_site_admin/pin/payouts';
$route['admin/weekly-closing'] = 'vc_site_admin/pin/weekly_closing';
$route['admin/monthly-closing'] = 'vc_site_admin/pin/monthly_closing';
$route['admin/pin/my-pin-transfer'] = 'vc_site_admin/pin/my_pin_transfer';
$route['admin/bank-statement'] = 'vc_site_admin/pin/bank_statement';
$route['admin/bank-process'] = 'vc_site_admin/pin/bank_process';
$route['admin/tds_report'] = 'vc_site_admin/pin/tds_report';
$route['admin/admin_report'] = 'vc_site_admin/pin/admin_report';



$route['admin/seo'] = 'vc_site_admin/seo/index';
$route['admin/seo/add'] = 'vc_site_admin/seo/add';
$route['admin/seo/edit/(:num)'] = 'vc_site_admin/seo/update/$1';
$route['admin/seo/del/(:num)'] = 'vc_site_admin/seo/del/$1';

$route['admin/webstores'] = 'vc_site_admin/webstores/index';
$route['admin/webstores/add'] = 'vc_site_admin/webstores/add';
$route['admin/webstores/edit/(:num)'] = 'vc_site_admin/webstores/update/$1';
$route['admin/webstores/del/(:num)'] = 'vc_site_admin/webstores/del/$1';

$route['admin/voucher-codes'] = 'vc_site_admin/webstores/voucher_codes';
$route['admin/voucher-brands'] = 'vc_site_admin/webstores/voucher_brands';
$route['admin/voucher-brand/(:any)'] = 'vc_site_admin/webstores/voucher_brand_generate/$1';
$route['admin/voucher/history'] = 'vc_site_admin/webstores/voucher_history';
$route['admin/voucher-code/(:num)'] = 'vc_site_admin/webstores/voucher_codes_generate/$1';


$route['admin/merchant'] = 'vc_site_admin/merchant/index';
$route['admin/merchant/add'] = 'vc_site_admin/merchant/add';
$route['admin/merchant/edit/(:num)'] = 'vc_site_admin/merchant/update/$1';
$route['admin/merchant/del/(:num)'] = 'vc_site_admin/merchant/del/$1';
/* Search */
$route['admin/search'] = 'vc_site_admin/search';


$route['admin/sale'] = 'vc_site_admin/sale/index';
$route['admin/sale/franchise_stock'] = 'vc_site_admin/sale/franchise_stock'; 
$route['admin/sale/send_stock_qty'] = 'vc_site_admin/sale/send_stock_qty';
$route['admin/sale/send_stock_qty/del/(:any)'] = 'vc_site_admin/sale/send_stock_qty_del';
$route['admin/sale/add'] = 'vc_site_admin/sale/add'; 
$route['admin/sale/edit/(:num)'] = 'vc_site_admin/sale/update/$1';
$route['admin/sale/invoice/(:num)'] = 'vc_site_admin/sale/invoice/$1';
$route['admin/sale/del/(:num)'] = 'vc_site_admin/sale/del/$1'; 
$route['admin/daily-weekly-income'] = 'vc_site_admin/sale/daily_weekly_income';
$route['admin/daily-sale-report'] = 'vc_site_admin/sale/daily_sale_report';
$route['admin/cut-off-report'] = 'vc_site_admin/sale/cut_off_report';




$route['admin/pin_sale'] = 'vc_site_admin/sale/pininsale';
$route['admin/pin_invoice/(:num)'] = 'vc_site_admin/sale/pininvoice/$1';
$route['admin/gst_report'] = 'vc_site_admin/sale/gst_report';

/* update Admin password */
$route['admin/password'] = 'password/index';


/*Gallery*/
$route['admin/gallery'] = 'vc_site_admin/gallery/index';
$route['admin/gallery/add'] = 'vc_site_admin/gallery/add';
$route['admin/gallery/edit/(:num)'] = 'vc_site_admin/gallery/update/$1';
$route['admin/gallery/del/(:num)'] = 'vc_site_admin/gallery/del/$1'; 

/* profile popup */
$route['admin/popup'] = 'vc_site_admin/gallery/popup';
$route['admin/achiever'] = 'vc_site_admin/gallery/achiever';
$route['admin/popup/add'] = 'vc_site_admin/gallery/popup_add';
$route['admin/popup/edit/(:num)'] = 'vc_site_admin/gallery/popup_update/$1';
$route['admin/popup/del/(:num)'] = 'vc_site_admin/gallery/popup_del/$1'; 


$route['admin/f_product'] = 'vc_site_admin/product/freeproduct';
$route['admin/voucher_order'] = 'vc_site_admin/product/voucher_order';
$route['admin/voucher_order/edit/(:num)'] = 'vc_site_admin/product/voucher_order_update/$1';
$route['admin/f_product/add'] = 'vc_site_admin/product/f_add';
$route['admin/f_product/edit/(:num)'] = 'vc_site_admin/product/f_update/$1';
$route['admin/f_product/del/(:num)'] = 'vc_site_admin/product/f_del/$1';
$route['admin/bonanza_list'] = 'vc_site_admin/customer/bonanza_list';
$route['admin/bonanza/add'] = 'vc_site_admin/customer/bonanza_add';
$route['admin/bonanza/edit/(:num)'] = 'vc_site_admin/customer/bonanza_update/$1';




/*receipts Request*/
$route['admin/receipt'] = 'vc_site_admin/product/receipt_list';
$route['admin/receipt/edit/(:num)'] = 'vc_site_admin/product/receipt_update/$1';
$route['admin/receipt/del/(:num)'] = 'vc_site_admin/product/receipt_del/$1'; 










?>