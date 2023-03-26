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
$route['default_controller'] = 'customer_front';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* User login & Signup */
$route['login'] = 'vc_site_admin/user/validate_credentials';
$route['uploadreadymodal'] = 'vc_site_admin/user/validate_upl_credentials';
$route['review'] = 'vc_site_admin/user/validate_review';
$route['forgetpassword'] = 'vc_site_admin/user/forgotPassword';
$route['logout'] = 'vc_site_admin/user/logout';
$route['admin/logout'] = 'vc_site_admin/user/logout';
$route ['register'] = 'vc_site_admin/user/create_member';
$route ['profile'] = 'vc_site_admin/user/profile';
$route ['reference/(:any)(:num)'] = 'customer_front';
$route ['get-bliss-code-by-phone'] = 'vc_site_admin/user/get_bliss_code_by_phone';

$route['about'] = 'page/about';
$route['gallery'] = 'page/gallery';
$route['banker'] = 'page/banker';
$route['refund_policy'] = 'page/refund_policy';
$route['ship'] = 'page/ship';
$route['disclaimer'] = 'page/disclaimer';
$route['affiliate'] = 'page/affiliate';
$route['cell'] = 'page/cell';
$route['reward'] = 'page/reward';
$route['news'] = 'page/news';
$route['legal'] = 'page/legal';
$route['vision'] = 'page/vision';
$route['mission'] = 'page/mission';
$route['genuine'] = 'page/genuine';
$route['excellence'] = 'page/excellence';
$route['customer_delight'] = 'page/customer_delight';
$route['social_responsibility'] = 'page/social_responsibility';
$route['team_work'] = 'page/team_work';
$route['business_plan'] = 'page/business_plan';
$route['term_condition'] = 'page/term_condition';
$route['offers'] = 'page/offers';
$route['store_locator'] = 'page/store_locator';
$route['help'] = 'page/help';
$route['track_order'] = 'page/track_order';
$route['corporate'] = 'page/corporate';
$route['send_a_query'] = 'page/send_a_query';
$route['contact_us'] = 'page/contact_us';
$route['feedback'] = 'page/feedback';
$route['complaint'] = 'page/complaint';
$route['career'] = 'page/career';
$route['faq'] = 'page/faq';
$route['how_do_i_shop'] = 'page/how_do_i_shop';
$route['terms_of_use'] = 'page/terms_of_use';
$route['how_do_i_pay'] = 'page/how_do_i_pay';
$route['privacy'] = 'page/privacy';
$route['shipping_policy'] = 'page/shipping_policy';
$route['exchanges_return'] = 'page/exchanges_return';
$route['happy_hours'] = 'page/happy_hours';
$route['ways-to-earn'] = 'page/ways_to_earn';
$route['winners_league'] = 'page/winners_league';
$route['good_times'] = 'page/good_times';
$route['the_one'] = 'page/the_one';

$route['cart'] = 'cart/index';
$route['cart/remove/(:any)'] = 'cart/remove/$1';
$route['checkout'] = 'checkout/index';
$route['payment'] = 'checkout/payment';
$route['ccavenue'] = 'checkout/ccavenue';
$route['thankyou'] = 'checkout/thankyou';
$route['search'] = 'product/search';

$route['category/(:any)'] = 'category/index';
$route['products'] = 'product/bliss_product_list';
$route['deals-king'] = 'deals/index';
$route['deals/(:any)(:num)'] = 'deals/merchants_deal';
$route['new-arrivals'] = 'product/new_arrivals';
$route['stores'] = 'product/stores';
$route['product/(:any)'] = 'product/real_product';
//$route['product/(:any)'] = 'product/product';

/* Admin */
$route['admin/signup/(:any)/(:any)'] = 'vc_site_admin/user/signup'; 
$route['admin'] = 'vc_site_admin/profile/index'; 
$route['distributor'] = 'vc_site_admin/profile/index';
$route['admin/profile'] = 'vc_site_admin/profile/profile';
$route['admin/personal_details'] = 'vc_site_admin/profile/personal_details';
$route['admin/bank_details'] = 'vc_site_admin/profile/bank_details';
$route['admin/kyc_details'] = 'vc_site_admin/profile/kyc'; 
$route['admin/pins'] = 'vc_site_admin/profile/pins';
$route['admin/repurchase_pins'] = 'vc_site_admin/profile/repurchase_pins';
$route['admin/pin/edit'] = 'vc_site_admin/profile/transfer_pin';
$route['admin/upgrade_account'] = 'vc_site_admin/profile/upgrade_account';
$route['admin/pins/transfer'] = 'vc_site_admin/profile/transfer_e_pin';
//$route['admin/pin_activate/(:num)'] = 'vc_site_admin/profile/transfer_pin/$1';
$route['admin/my-pin-transfer'] = 'vc_site_admin/profile/my_pin_transfer';
$route['admin/request-pin'] = 'vc_site_admin/profile/pin_request';
$route['admin/pin_transfer'] = 'vc_site_admin/profile/pin_transfer';
$route['admin/pins/(:any)'] = 'vc_site_admin/profile/pins_status/$1';
$route['admin/pin_addnew'] = 'vc_site_admin/income/pin_addnew';

$route['admin/franchize_pin/edit'] = 'vc_site_admin/profile/franchize_pin';
$route['admin/pin_activate/(:num)'] = 'vc_site_admin/profile/transfer_pin/$1';

$route['admin/signup'] = 'vc_site_admin/user/signup'; 
$route['admin/prodcut_purchse_date'] = 'vc_site_admin/product/index';
$route['admin/prodcut_dispached_date'] = 'vc_site_admin/product/prodcut_dispached_date';
$route['admin/prodcut_delivered_date'] = 'vc_site_admin/product/prodcut_delivered_date';

/*reward and achiever*/

$route['admin/reward'] = 'vc_site_admin/order/reward_list';
$route['admin/achiever_list'] = 'vc_site_admin/order/achiever_list';

/* update Admin password */
$route['admin/password'] = 'vc_site_admin/password';

/*Downline sale*/
$route['admin/downlinesale'] = 'vc_site_admin/downlinesale/index';

/*Orders*/
$route['admin/order'] = 'vc_site_admin/order/index';
$route['admin/order/(:num)'] = 'vc_site_admin/order/order_view/$1';


/*sale*/
$route['admin/sale'] = 'vc_site_admin/sale/index';
$route['admin/sale/add'] = 'vc_site_admin/sale/add';
$route['admin/sale/edit/(:num)'] = 'vc_site_admin/sale/update/$1';
$route['admin/sale/invoice/(:num)'] = 'vc_site_admin/sale/invoice/$1';
$route['admin/sale/del/(:num)'] = 'vc_site_admin/sale/del/$1';
$route['admin/pin_sale'] = 'vc_site_admin/sale/pininsale';
$route['admin/pin_invoice/(:num)'] = 'vc_site_admin/sale/pininvoice/$1';


$route['admin/repurchase_wallet_history'] = 'vc_site_admin/sale/repurchase_wallet_history';
$route['admin/wallet_history'] = 'vc_site_admin/sale/wallet_history';


/* Activate account */
$route['admin/activate'] = 'vc_site_admin/activate/index';



/*profileupdate*/
$route['admin/proedit'] = 'vc_site_admin/proedit/index';
$route['admin/proedit/edit/(:num)'] = 'vc_site_admin/proedit/update/$1';


/* income */
$route['admin/income'] = 'vc_site_admin/income/income_page';

$route['admin/daily-weekly-income'] = 'vc_site_admin/income/daily_weekly_income_page';
$route['admin/income/(:any)'] = 'vc_site_admin/income/index';
$route['admin/income/(:any)/pin'] = 'vc_site_admin/income/index';
$route['admin/income/(:any)/difference'] = 'vc_site_admin/income/index';
$route['admin/income/(:any)/referral'] = 'vc_site_admin/income/index';
$route['admin/pin_addnew'] = 'vc_site_admin/income/pin_addnew';
$route['admin/created_pin'] = 'vc_site_admin/income/created_pin';
$route['admin/Payment_request'] = 'vc_site_admin/income/Payment_request';
$route['admin/transfer_history'] = 'vc_site_admin/income/transfer_history';
$route['admin/transfer_fund'] = 'vc_site_admin/income/transfer_fund';


$route['admin/bank-statement'] = 'vc_site_admin/income/bank_statement';
$route['admin/request-wallet'] = 'vc_site_admin/profile/pin_request';
$route['admin/payout-invoice-report'] = 'vc_site_admin/income/payout_invoice_report';

/*Distributor Level Information*/
$route['admin/DistributorLevelInformation'] = 'vc_site_admin/DistributorLevelInformation/index';
$route['admin/DistributorLevelInformation/(:any)'] = 'vc_site_admin/DistributorLevelInformation/index/$1';


/*Downline all*/
$route['admin/downlineall'] = 'vc_site_admin/downlineall/index';
$route['admin/downlineall/left'] = 'vc_site_admin/downlineall/index/$1';
$route['admin/downlineall/right'] = 'vc_site_admin/downlineall/index/$1';

$route['admin/direct_distributor'] = 'vc_site_admin/downlineall/direct_distributor';
$route['admin/direct_distributor/left'] = 'vc_site_admin/downlineall/direct_distributor/$1';
$route['admin/direct_distributor/right'] = 'vc_site_admin/downlineall/direct_distributor/$1';

$route['admin/downlineall/(:num)'] = 'vc_site_admin/downlineall/index/$1';
$route['admin/left_users'] = 'vc_site_admin/downlineall/left_users';
$route['admin/right_users'] = 'vc_site_admin/downlineall/right_users';

$route['admin/treeview'] = 'vc_site_admin/downlineall/treeview';
$route['admin/treeview/(:any)'] = 'vc_site_admin/downlineall/treeview/$1';
$route['admin/welcomeletter'] = 'vc_site_admin/profile/welcomeletter';




/*
$route['admin/welcome'] = 'vc_site_admin/user/admin_welcome';
$route['admin/signup'] = 'vc_site_admin/user/signup';
$route['admin/create_member'] = 'vc_site_admin/user/create_member';
$route['admin/login'] = 'vc_site_admin/user/index';
$route['admin/logout'] = 'vc_site_admin/user/logout';
$route['admin/login/validate_credentials'] = 'vc_site_admin/user/validate_credentials';
$route['admin/forgot-password'] = 'vc_site_admin/user/forgot_password';

//$route['admin/profile'] = 'vc_site_admin/profile/index';
$route['admin/commercial'] = 'vc_site_admin/commercial/index';
$route['admin/bank-detail'] = 'vc_site_admin/bank_detail/index';
$route['admin/other-supporting-document'] = 'vc_site_admin/other_supporting_document/index';
$route['admin/authorized-signature'] = 'vc_site_admin/authorized_signature/index';*/

/*product*//*
$route['admin/product'] = 'vc_site_admin/product/index';
$route['admin/product/add'] = 'vc_site_admin/product/add';
$route['admin/product/edit/(:num)'] = 'vc_site_admin/product/update/$1';
$route['admin/product/del/(:num)'] = 'vc_site_admin/product/del/$1';*/

?>