<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Income extends CI_Controller
{
    private $current_cust_id;private $all_indirect_user = 0;
    private $user_list = array();
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Users_model');
        $this->load->model('checkout_model');

    }
    public function transfer_history()
    {

        $id = $this->session->userdata('cust_id');

        $customer_id = $this->session->userdata('bliss_id');

        $data['profile'] = $this->Users_model->profile($id);

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $sdate = date('Y-m-d 00:00:01', strtotime($this->input->post('sdate')));

            $edate = date('Y-m-d 23:59:59', strtotime($this->input->post('edate')));

        } else {

            $sdate = date('Y-m-1 00:00:01');

            $edate = date('Y-m-t 23:59:59');

        }

        $data['wallet_history'] = $this->Users_model->transaction_wallet($customer_id);

        //load the view

        $data['main_content'] = 'admin/transfer_history';

        $this->load->view('includes/admin/template', $data);

    }

    public function transfer_fund()
    {
        if (!$this->session->userdata('is_customer_logged_in')) {redirect(base_url() . '');}
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'income';
        $data['page_title'] = 'Working Wallet';
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('amount', 'amount', 'required');
            $this->form_validation->set_rules('member_id', 'member_id', 'required');
            $this->form_validation->set_rules('transaction', 'Transaction Code', 'required');

            $charge = (15 / 100) * $this->input->post('amount');
            $payble_amount = $this->input->post('amount') + $charge;

            if ($payble_amount > $data['profile'][0]['bliss_amount']) {
                $this->form_validation->set_rules('hsfdgsd', 'Your Wallet have less Amount', 'required');
                $this->form_validation->set_message('required', 'Your Wallet have less Amount');
            } elseif ($data['profile'][0]['tr_pin'] != md5($this->input->post('transaction'))) {
                $this->form_validation->set_rules('hsfdgsd', 'Wrong Transaction code', 'required');
                $this->form_validation->set_message('required', 'Wrong Transaction code');
            }
            $send_to = $this->Users_model->parent_profile($this->input->post('member_id'));
            if (empty($send_to)) {
                $this->form_validation->set_rules('hsfdgsd', 'Incorrect Member ID.', 'required');
                $this->form_validation->set_message('required', 'User Not Exist');
            } elseif ($send_to[0]['id'] == $id) {
                $this->form_validation->set_rules('hsfdgsd', 'Incorrect Member ID.', 'required');
                $this->form_validation->set_message('required', 'You can not Transfer Fund to Own');
            }
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            if ($this->form_validation->run()) {
                $amount = $this->input->post('amount');
                $member_id = $this->input->post('member_id');
                $password = $this->input->post('password');
                $repuchase_wallet = array();

                $repuchase_wallet[] = array('user_id' => $customer_id, 'credit_amt' => 0, 'debit_amt' => $payble_amount, 'receiver_id' => $send_to[0]['customer_id'], 'sender_id' => $customer_id, 'receive_date' => date('Y-m-d'), 'TranDescription' => 'Transfered', 'Cause' => 'Repurchase Wallet Transfered');

                $repuchase_wallet[] = array('user_id' => $send_to[0]['customer_id'], 'credit_amt' => $payble_amount, 'debit_amt' => 0, 'receiver_id' => $send_to[0]['customer_id'], 'sender_id' => $customer_id, 'receive_date' => date('Y-m-d'), 'TranDescription' => 'Transfered', 'Cause' => 'Repurchase Wallet Transfered');

                $this->Users_model->insert_batch('repurchase_wallet', $repuchase_wallet);
                $this->Users_model->update_wallet($id, $payble_amount, 'bliss_amount');
                $this->Users_model->substract_wallet($send_to[0]['id'], $payble_amount, 'bliss_amount');
                $this->session->set_flashdata('flash_message', 'updated');
                redirect(base_url() . 'admin/transfer_fund');
            }
        }
        $data['main_content'] = 'admin/transfer_fund';
        $this->load->view('includes/admin/template', $data);

    }

    public function convertCoin()
    {
        if (!$this->session->userdata('is_customer_logged_in')) {redirect(base_url() . '');}
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'income';
        $data['page_title'] = 'Working Wallet';
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('amount', 'amount', 'numeric|required|greater_than[0]');
            $payble_amount = $this->input->post('amount');
            if ($payble_amount > $data['profile'][0]['points']) {
                $this->form_validation->set_rules('hsfdgsd', 'Your Wallet have less Amount', 'required');
                $this->form_validation->set_message('required', 'Your Wallet have less Amount');
            }
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            if ($this->form_validation->run()) {

                $data_to_store = array(
                  'user_id' => $id,
                  'send_to' => $id,
                  'status' => 'Debit',
                  'wallet_type ' => 'Point',
                  'type' => 'Transfered (Main Wallet)',
                  'amount ' => $payble_amount,
                  'description' => 'Convert to main wallet'
                );
                $this->Users_model->add_transactions($data_to_store);

                $data_to_store = array(
                  'user_id' => $id,
                  'send_to' => $id,
                  'status' => 'Credit',
                  'type' => 'Transfered (Point)',
                  'wallet_type ' => 'Main Wallet',
                  'amount ' => $payble_amount*10,
                  'description' => 'Convert from coin'
                );
                $this->Users_model->add_transactions($data_to_store);

                $this->Users_model->update_wallet($id, $payble_amount, 'points');
                $this->Users_model->substract_wallet($id, $payble_amount*10, 'bliss_amount');
                $this->session->set_flashdata('flash_message', 'updated');
                redirect(base_url() . 'admin/convert-coin');
            }
        }
        $data['main_content'] = 'admin/convert_coin';
        $this->load->view('includes/admin/template', $data);

    }
    
    public function pin_addnew()
    {

        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $user = $this->Users_model->profile($id);
        $data['profile'] = $user;

        $this->load->helper('string');

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            /*form validation*/

            $this->form_validation->set_rules('pinid', 'wallet', 'required');
            $this->form_validation->set_rules('pins', 'amount', 'required');
            $no_of_pin = $this->input->post('pins');
            $package = explode("~", $this->input->post('pinid'));
            $total = $package[1] * $no_of_pin;
            $tds = $total / 10;
            $grand_total = $total + $tds;
            if ($user[0]['wallet'] < $grand_total) {
                $this->form_validation->set_rules('start_date', '', 'required');
                $this->form_validation->set_message('required', 'Your Wallet Has less Money');
            }

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                $order_id = '';
                for ($x = 1; $x <= $no_of_pin; $x++) {

                    $data_to_store = array(
                        'status' => 'Active',
                        'pinid' => random_string('alnum', 6) . random_string('alnum', 4),
                        'assign_to' => $customer_id,
                        'p_amount' => $package[1],
                        'b_volume' => $package[1] / 700,
                        'package' => $package[0],
                        'created_by_user' => $customer_id,
                    );
                    $order_id = $this->Users_model->store_pin($data_to_store);
                }
                $this->Users_model->update_wallet($id, $grand_total, 'wallet');

                if (is_numeric($order_id)) {

                    $this->session->set_flashdata('flash_message', 'updated');
                    redirect('admin/pin_addnew');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }

            } /*validation run*/

        }
        //load the view
        $data['main_content'] = 'admin/pin_addnew';
        $this->load->view('includes/admin/template', $data);
    }

    public function created_pin()
    {

        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $user = $this->Users_model->profile($id);
        $data['profile'] = $user;
        $data['pin_error'] = '';

        $data['pin'] = $this->Users_model->get_all_pin_by_create($customer_id);

        //load the view
        $data['main_content'] = 'admin/created_pins';
        $this->load->view('includes/admin/template', $data);
    }

    public function holdIncome() {

        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'income';
        $data['page_title'] = 'Income';
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        $data['income'] = $this->Users_model->getHoldIncomes($id);
        $data['main_content'] = 'admin/hold-income';
        $this->load->view('includes/admin/template', $data);
    }

    public function index()
    {
        if (!$this->session->userdata('is_customer_logged_in')) {redirect(base_url() . '');}
        // $this->distribute_monthly_income();
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'income';
        $data['page_title'] = 'Income';

        $data['myfriends'] = $data['salary'] = array();
        $data['showlevel'] = $data['sponsor_column'] = 'false';
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);

        $url = $this->uri->segment(3);
        $where_query = array('a.user_id' => $id, 'a.status' => 'Active');
        if ($url == 'matching-income') {
            $type = 'Purchase';
            $data['page_title'] = 'Matching Income';
            $data['income'] = $this->Users_model->fetch_table_data_income('binary_income', $id);
        } elseif ($url == 'Capping') {
            $type = 'Capping';
            $data['page_title'] = 'Capping';
            $data['income'] = $this->Users_model->my_bliss_amount_capping('distribution_amount', $id, $type);
        } elseif ($url == 'cashback') {
            $type = 'Cashback';
            $data['page_title'] = 'Cashback';
            $data['income'] = $this->Users_model->get_active_incomes($id, $where_query, $type);
        } elseif ($url == 'direct-income') {
            $type = 'Direct Income';
            $data['page_title'] = 'Direct Income';
            $data['income'] = $this->Users_model->get_active_incomes($id, $where_query, $type);
        } elseif ($url == 'level-income') {
            $type = 'Level Income';
            $data['page_title'] = 'Level Income';
            $data['income'] = $this->Users_model->get_active_incomes($id, $where_query, $type);
        } elseif ($url == 'upgrade-income') {
            $type = 'Upgrade Income';
            $data['page_title'] = 'Gift Your Voucher Club';
            $data['income'] = $this->Users_model->get_active_incomes($id, $where_query, $type);
        } elseif ($url == 'depth-income') {
            $type = 'Depth Income';
            $data['page_title'] = 'Depth Income';
            $data['income'] = $this->Users_model->get_active_incomes($id, $where_query, $type);
        } elseif ($url == 'voucher') {
            $type = 'Voucher';
            $data['page_title'] = 'voucher';
            $data['income'] = $this->Users_model->get_active_incomes($id, $where_query, $type);
        } elseif ($url == 'Royality-income') {
            $type = 'Royality';
            $data['page_title'] = 'Royality Income';
            $data['income'] = $this->Users_model->fetch_table_data('turnover_income', $id, $type);
        } elseif ($url == 'Leadership-income') {
            $type = 'Leadership Income';
            $data['page_title'] = 'Leadership Income';
            $data['income'] = $this->Users_model->fetch_table_data_income('binary_level_income', $id);
        } elseif ($url == 'team-performance-income') {
            $type = 'Team Performance Bonus';
            $data['page_title'] = 'Team Performance Bonus';
            $data['income'] = $this->Users_model->fetch_table_data_income('repurchase_income', $id, $type);
        } elseif ($url == 'team-level-income') {
            $type = 'Team Level Bonus';
            $data['page_title'] = 'Team Level Bonus';
            $data['income'] = $this->Users_model->fetch_table_data_income('repurchase_income', $id, $type);
        } elseif ($url == 'Repurchase-income') {
            $type = 'Repurchase';
            $data['page_title'] = 'Repurchase Income';
            $data['income'] = $this->Users_model->fetch_table_data_income('repurchase_income', $id, $type);
        } else { $data['income'] = '';}

        //$data['bliss_amount'] = $this->Users_model->my_bliss_amount($id);
        //$data['redeem_amount'] = $this->Users_model->bliss_perk_redeem_amount($id);
        //$data['bliss_perk_history'] = $this->Users_model->bliss_perk_history($id);

        $data['redeem_error'] = '';

        if ($url == 'franchisee-income') {$data['main_content'] = 'admin/franchisee_income';} else { $data['main_content'] = 'admin/income';}
        $this->load->view('includes/admin/template', $data);
    }

    public function goDownALevelDirect($customerid)
    {
        $return = array();
        $children = $this->Users_model->my_friends($customerid); //underlying SQL function
        if (!empty($children)) {
            foreach ($children as $child) {
                if ($this->current_cust_id != $child['direct_customer_id']) {
                    $this->all_indirect_user = $this->all_indirect_user + 1;
                }
                $this->goDownALevelDirect($child['customer_id']);
            }
        }
        return $return;
    }

    public function income_page()
    {
        if (!$this->session->userdata('is_customer_logged_in')) {redirect(base_url() . '');}
        // $this->distribute_monthly_income();
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'income_page';
        $data['page_title'] = 'Income page';
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);

        $data['total_incomes'] = $this->Users_model->total_incomes($id);
        $data['totalHoldIncome'] = $this->Users_model->totalHoldIncomes($id);
        //echo '<pre>'; print_r($data['totalHoldIncome']); die;

        $data['main_content'] = 'admin/income_page';
        $this->load->view('includes/admin/template', $data);
    }
    public function cmp_turnover()
    {
        if (!$this->session->userdata('is_customer_logged_in')) {redirect(base_url() . '');}
        // $this->distribute_monthly_income();
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'cmp_turnover';
        $data['page_title'] = 'Cmp Turnover';
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);

        $myfriends = $this->Users_model->friends_by_position($customer_id);
        $myfriendid = array($id);
        if (!empty($myfriends)) {
            foreach ($myfriends as $friends) {
                $friends['dposition'] = $friends['position'];
                $this->user_list[] = $friends;
                $this->downallfriends($friends['customer_id'], $friends['position']);
            }
        }
        $data['myfriends'] = $this->user_list;

        $data['bliss_amount'] = $this->Users_model->my_bliss_amount($id);
        $data['total_incomes'] = $this->Users_model->total_incomes($id);

        $data['main_content'] = 'admin/cmp_turnover';
        $this->load->view('includes/admin/template', $data);
    }

    public function car_fund()
    {
        if (!$this->session->userdata('is_customer_logged_in')) {redirect(base_url() . '');}
        // $this->distribute_monthly_income();
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'car_fund';
        $data['page_title'] = 'Car Fund';
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);

        $myfriends = $this->Users_model->friends_by_position($customer_id);
        $myfriendid = array($id);
        if (!empty($myfriends)) {
            foreach ($myfriends as $friends) {
                $friends['dposition'] = $friends['position'];
                $this->user_list[] = $friends;
                $this->downallfriends($friends['customer_id'], $friends['position']);
            }
        }
        $data['myfriends'] = $this->user_list;

        $data['bliss_amount'] = $this->Users_model->my_bliss_amount($id);
        $data['total_incomes'] = $this->Users_model->total_incomes($id);

        $data['main_content'] = 'admin/car_fund';
        $this->load->view('includes/admin/template', $data);
    }
    public function income_history()
    {
        if (!$this->session->userdata('is_customer_logged_in')) {redirect(base_url() . '');}
        // $this->distribute_monthly_income();
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'income_history';
        $data['page_title'] = 'Income History';
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);

        $myfriends = $this->Users_model->friends_by_position($customer_id);
        $myfriendid = array($id);
        if (!empty($myfriends)) {
            foreach ($myfriends as $friends) {
                $friends['dposition'] = $friends['position'];
                $this->user_list[] = $friends;
                $this->downallfriends($friends['customer_id'], $friends['position']);
            }
        }
        $data['myfriends'] = $this->user_list;

        $data['bliss_amount'] = $this->Users_model->my_bliss_amount($id);
        $data['total_incomes'] = $this->Users_model->total_incomes($id);

        $data['main_content'] = 'admin/income_history';
        $this->load->view('includes/admin/template', $data);
    }

    public function closing_history()
    {
        if (!$this->session->userdata('is_customer_logged_in')) {redirect(base_url() . '');}
        // $this->distribute_monthly_income();
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'closing_history';
        $data['page_title'] = 'Closing History';
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);

        $myfriends = $this->Users_model->friends_by_position($customer_id);
        $myfriendid = array($id);
        if (!empty($myfriends)) {
            foreach ($myfriends as $friends) {
                $friends['dposition'] = $friends['position'];
                $this->user_list[] = $friends;
                $this->downallfriends($friends['customer_id'], $friends['position']);
            }
        }
        $data['myfriends'] = $this->user_list;

        $data['bliss_amount'] = $this->Users_model->my_bliss_amount($id);
        $data['total_incomes'] = $this->Users_model->total_incomes($id);

        $data['main_content'] = 'admin/closing_history';
        $this->load->view('includes/admin/template', $data);
    }

    public function house_fund()
    {
        if (!$this->session->userdata('is_customer_logged_in')) {redirect(base_url() . '');}
        // $this->distribute_monthly_income();
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'house_fund';
        $data['page_title'] = 'House Fund';
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);

        $myfriends = $this->Users_model->friends_by_position($customer_id);
        $myfriendid = array($id);
        if (!empty($myfriends)) {
            foreach ($myfriends as $friends) {
                $friends['dposition'] = $friends['position'];
                $this->user_list[] = $friends;
                $this->downallfriends($friends['customer_id'], $friends['position']);
            }
        }
        $data['myfriends'] = $this->user_list;

        $data['bliss_amount'] = $this->Users_model->my_bliss_amount($id);
        $data['total_incomes'] = $this->Users_model->total_incomes($id);

        $data['main_content'] = 'admin/house_fund';
        $this->load->view('includes/admin/template', $data);
    }
    public function downallfriends($customerid, $position = '')
    {
        $return = array();
        $children = $this->Users_model->friends_by_position($customerid); //underlying SQL function
        if (!empty($children)) {
            foreach ($children as $child) {
                $child['dposition'] = $position;
                $this->user_list[] = $child;
                $this->downallfriends($child['customer_id'], $position);
            }
        }
        return $return;
    }

    public function daily_weekly_income_page()
    {
        if (!$this->session->userdata('is_customer_logged_in')) {redirect(base_url() . '');}
        // $this->distribute_monthly_income();
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'daily_weekly_income';
        $data['page_title'] = 'Total Income';
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        $data['daily_weakly_in'] = array();
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $sdate = date('Y-m-d 00:00:01', strtotime($this->input->post('sdate')));
            $edate = date('Y-m-d 23:59:59', strtotime($this->input->post('edate')));

        } else {

            $sdate = '';
            $edate = '';

        }

        $binary_income = $this->Users_model->daily_weakly_in_by_table('binary_income', $sdate, $edate, $id);
        $binary_level_income = $this->Users_model->daily_weakly_in_by_table('binary_level_income', $sdate, $edate, $id);
        $direct_income = $this->Users_model->daily_weakly_in_by_table('direct_income', $sdate, $edate, $id);
        $repurchase_income = $this->Users_model->daily_weakly_in_by_table('repurchase_income', $sdate, $edate, $id);
        $turnover_income = $this->Users_model->daily_weakly_in_by_table('turnover_income', $sdate, $edate, $id);
        $reward_income = $this->Users_model->daily_weakly_in_by_table('reward_income', $sdate, $edate, $id);

        if (!empty($binary_income)) {
            $data['daily_weakly_in'][] = array('amount' => $binary_income[0]['amount'] + 0, 'c_date' => $binary_income[0]['c_date'], 'type' => 'Matching Income');
        }
        if (!empty($binary_level_income)) {
            $data['daily_weakly_in'][] = array('amount' => $binary_level_income[0]['amount'] + 0, 'c_date' => $binary_level_income[0]['c_date'], 'type' => 'Leadership Income');
        }
        if (!empty($direct_income)) {
            $data['daily_weakly_in'][] = array('amount' => $direct_income[0]['amount'] + 0, 'c_date' => $direct_income[0]['c_date'], 'type' => 'Direct Income');
        }
        if (!empty($repurchase_income)) {
            $data['daily_weakly_in'][] = array('amount' => $repurchase_income[0]['amount'] + 0, 'c_date' => $repurchase_income[0]['c_date'], 'type' => 'Repuchase Income');
        }
        if (!empty($turnover_income)) {
            $data['daily_weakly_in'][] = array('amount' => $turnover_income[0]['amount'] + 0, 'c_date' => $turnover_income[0]['c_date'], 'type' => 'Royality Income + Club Income');
        }
        if (!empty($reward_income)) {
            $data['daily_weakly_in'][] = array('amount' => $reward_income[0]['amount'] + 0, 'c_date' => $reward_income[0]['c_date'], 'type' => 'Reward');
        }

        $data['main_content'] = 'admin/daily_weekly_income';
        $this->load->view('includes/admin/template', $data);
    }

    public function income_report()
    {
        if (!$this->session->userdata('is_customer_logged_in')) {redirect(base_url() . '');}
        // $this->distribute_monthly_income();
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'Income Report';
        $data['page_title'] = 'Income Report';
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);

        $binary_income = $this->Users_model->fetch_table_data_sum_report('binary_income', $id);
        $binary_level_income = $this->Users_model->fetch_table_data_sum_report('binary_level_income', $id);
        $direct_income = $this->Users_model->fetch_table_data_sum_report('direct_income', $id);
        $turnover_income = $this->Users_model->fetch_table_data_sum_report('turnover_income', $id);
        $roality_income = $this->Users_model->fetch_table_data_sum_report('roality_income', $id);
        $repurchase_income = $this->Users_model->fetch_table_data_sum_report('repurchase_income', $id);
        $data['total_income'] = $binary_level_income[0]['amount'] + $direct_income[0]['amount'] + $turnover_income[0]['amount'] + $roality_income[0]['amount'] + $repurchase_income[0]['amount'];
        $data['weekly'] = $binary_income[0]['amount'];
        //echo $data[ 'total_income' ]; die();
        $data['payout'] = $this->Users_model->get_payout_sum($id, 'Weekly Closing');
        $data['bank_process'] = $this->Users_model->get_payout_sum($id, 'Bank Process');

        $data['main_content'] = 'admin/income_report';
        $this->load->view('includes/admin/template', $data);
    }

    public function bank_statement()
    {
        if (!$this->session->userdata('is_customer_logged_in')) {redirect(base_url() . '');}
        // $this->distribute_monthly_income();
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'bank_statement';
        $data['page_title'] = 'Bank statement';
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $sdate = date('Y-m-d 00:00:01', strtotime($this->input->post('sdate')));
            $edate = date('Y-m-d 23:59:59', strtotime($this->input->post('edate')));
        } else {
            $sdate = date('Y-m-01 00:00:01');
            $edate = date('Y-m-t 23:59:59');
        }
        // $data['bliss_perk_history'] = $this->Users_model->bliss_perk_history($id);
        $data['bank_statement'] = $this->Users_model->get_clear_payout($sdate, $edate, $id);

        $data['main_content'] = 'admin/bank_statement';
        $this->load->view('includes/admin/template', $data);
    }

    public function payout_invoice_report()
    {
        if (!$this->session->userdata('is_customer_logged_in')) {redirect(base_url() . '');}
        // $this->distribute_monthly_income();
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'payout_invoice_report';
        $data['page_title'] = 'Payout Invoice Report';
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        $sdate = $edate = '';
        $status = '';
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $sdate = date('Y-m-d 00:00:01', strtotime($this->input->post('sdate')));
            $edate = date('Y-m-d 23:59:59', strtotime($this->input->post('edate')));
            $status = 'All';
        }

        $data['payout_invoice_report'] = $this->Users_model->get_all_payout($id, $sdate, $edate, $status);

        $data['main_content'] = 'admin/payout_invoice_report';
        $this->load->view('includes/admin/template', $data);
    }

    public function Payment_request()
    {
        if (!$this->session->userdata('is_customer_logged_in')) {redirect(base_url() . '');}
        // $this->distribute_monthly_income();
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'Payment request';
        $data['page_title'] = 'Payment request';

        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        //  $data['request'] = $this->Users_model->get_pin_request_by_id($id);
        $data['direct_date'] = $data['matching_date'] = $data['today_date'] = 'no';
        $data['matching_income'] = $data['direct_income'] = $data['today_income'] = 0;
        $data['bliss_perk_history'] = $this->Users_model->bliss_perk_history($id);

        $type = 'bliss_amount';
        $data['wallet_amount'] = $data['profile'][0]['bliss_amount'];

        if ($this->input->server('REQUEST_METHOD') && $this->input->post('redeem_bliss') != '') {
            /*form validation*/

            $profile = $this->Users_model->profile($id);

            $this->form_validation->set_rules('balance', 'balance', 'required|trim');
            $this->form_validation->set_rules('redeem', 'redeem', 'required|trim');

            if ($data['profile'][0]['bliss_amount'] < $this->input->post('redeem')) {
                $this->form_validation->set_rules('balance_limit', 'redeem', 'required|trim');
                $this->form_validation->set_message('required', 'Your redeem maximum Amount is ' . $data['profile'][0]['bliss_amount']);
            } elseif ($this->input->post('redeem') < 500) {
                $this->form_validation->set_rules('balance_limit', 'redeem', 'required|trim');
                $this->form_validation->set_message('required', 'Minimum withdrawal is Rs 500.');
            } elseif ($data['profile'][0]['var_status'] == 'no') {
                $this->form_validation->set_rules('profile_com', 'profile_com', 'required|trim');
                $this->form_validation->set_message('required', 'Your profile is under review please wait 2 working days');
            } elseif ($data['profile'][0]['var_status'] == '') {
                $this->form_validation->set_rules('profile_com', 'profile_com', 'required|trim');
                $this->form_validation->set_message('required', 'Please update your kyc.');
            }

            $data['redeem_error'] = 'show';
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                $data_to_store = array(
                    'balance' => $this->input->post('balance'),
                    'redeem' => $this->input->post('redeem'),
                    'after_tds' => $this->input->post('final_redeem'),
                    'my_bliss_req' => 'Wallet',
                    'user_id' => $id,
                );
                $return = $this->Users_model->redeem_bliss_request($data_to_store);

                $this->Users_model->update_wallet($id, $this->input->post('redeem'), $type);

                if ($return == true) {

                    $this->session->set_flashdata('flash_message', 'updated');
                    redirect(base_url() . 'admin/Payment_request');
                } else {
                    $this->session->set_flashdata('flash_message', 'redeem_error');
                }
            }

        }

        $data['main_content'] = 'admin/Payment_request';
        $this->load->view('includes/admin/template', $data);
    }

    public function voucher_order()
    {
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        $data['voucher_order'] = $this->Users_model->get_voucher_order($id);
        //echo '<pre>'; print_r($data['freeproduct']); die();

        //load the view
        $data['main_content'] = 'admin/voucher_order';
        $this->load->view('includes/admin/template', $data);
    }

    public function voucher_repurchase()
    {
        $ids = $this->uri->segment(2);
        $data['page_keywords'] = '';

        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        $data['vouchers_data'] = $this->Users_model->get_repurchase_voucher($id);
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('price', 'price', 'required|trim');
            $this->form_validation->set_rules('pname', 'pname', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $config['upload_path'] = 'main-admin/assets/images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                //$config['max_width']  = '1600';
                //$config['max_height']  = '1600';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $image_data = $this->upload->data();
                    $image = $image_data['file_name'];
                } else {
                    $errors = $this->upload->display_errors();
                    $image = '';
                }

                $data_to_store = array(
                    'user_id' => $this->session->userdata('cust_id'),
                    'voucher_id' => $data['voucher_data'][0]['id'],
                    'price' => $this->input->post('price'),
                    'pname' => $this->input->post('pname'),
                    'image' => $image,

                );
                // This function add items into cart.

                if ($this->Users_model->add_voucher($data_to_store) == true) {
                    $this->session->set_flashdata('flash_message', 'updated');

                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }

            }
        }

        $data['main_content'] = 'admin/repurchase_voucher';
        $this->load->view('includes/admin/template', $data);
    }

    public function main_wallet_history()
    {

        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        $data['main_wallet'] = $this->Users_model->get_wallet_history($id, "Main Wallet");
        //load the view
        $data['main_content'] = 'admin/main_wallet_history';
        $this->load->view('includes/admin/template', $data);
    }

    public function reward_wallet_history()
    {

        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        $data['reward_point'] = $this->Users_model->get_wallet_history($id, "Reward Point");
        //load the view
        $data['main_content'] = 'admin/reward_point_history';
        $this->load->view('includes/admin/template', $data);
    }

    public function point_history()
    {

        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        $data['point_history'] = $this->Users_model->get_wallet_history($id, "Point");
        //load the view
        $data['main_content'] = 'admin/point_history';
        $this->load->view('includes/admin/template', $data);
    }

    public function point()
    {

        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        $data['reward_point'] = $this->sale_model->get_wallet_history($id, "Reward Point");
        //load the view
        $data['main_content'] = 'admin/point';
        $this->load->view('includes/admin/template', $data);
    }

}
