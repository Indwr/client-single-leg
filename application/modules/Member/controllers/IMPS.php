<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class IMPS extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
        date_default_timezone_set('Asia/Kolkata');
      // $this->api_token = "623455573391844"; /// Anil Api (A.S Soft Solution - Anil Kumar) 
       $this->api_token = ""; // Sunil Api ( Sunil Kumar)
         //$this->api_token = "177653283932743"; // Arun Api (Arun Kumar)
        //$this->api_token = "156996308911217"; // Ramanjeet Api
    }

    public function index(){
        if (is_logged_in()) {
            $response['header'] = 'Add Beneficiary';
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('bank_holder_name', 'Bank Holder Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('bank_account_no', 'Bank Account No.', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('ifsc', 'Bank IFSC', 'trim|required|xss_clean');
                $this->form_validation->set_rules('branch', 'Bank Branch', 'trim|required|xss_clean');
                $this->form_validation->set_rules('phone', 'Bank Register Phone No.', 'trim|required|xss_clean');
                $this->form_validation->set_rules('txn_password', 'Txn Password', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    if(preg_match('/^[6-9]{1}[0-9]{9}+$/', $data['phone'])){
                    $check = $this->User_model->get_single_record('tbl_users', array('user_id' => trim(addslashes($this->session->userdata['user_id']))), 'id,user_id,phone,master_key');
                        if($check['master_key'] == $data['txn_password']){
                            if(!empty($check)){
                                $beneficaryCheck = $this->User_model->get_single_record('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id']), 'ifnull(count(id),0) as ids');
                                if($beneficaryCheck['ids'] == 0){
                                    $add = ['user_id' => $this->session->userdata['user_id'],'beneficiary_bank' => $data['bank_name'], 'beneficiary_name' => $data['bank_holder_name'], 'beneficiary_account_no' => $data['bank_account_no'],'beneficiary_branch' => $data['branch'], 'beneficiary_ifsc' => $data['ifsc'], 'beneficiary_mobile' => $data['phone'],'account_ifsc' => $data['bank_account_no'].'_'.$data['ifsc'], 'created_at' => date('Y-m-d H:i:s')];
                                    $res = $this->User_model->add('tbl_add_beneficiary', $add);
                                        redirect('Member/IMPS/beneficiaryDetails');
                                    if($res){
                                        $this->session->set_flashdata('success', 'Beneficiary Added Successfully!.');
                                    }else{
                                        $this->session->set_flashdata('error', 'Server Not Responding, Please try again later!.');
                                    }
                                }else{
                                    $this->session->set_flashdata('error', 'Beneficiary Added Limit exhausted, Please contact too admin for more changes!.');
                                }
                            }else{
                                $this->session->set_flashdata('error', 'User ID Not Found!.');
                            }
                        }else{
                            $this->session->set_flashdata('error', 'Invaild Txn Password!.');
                        }
                    }else{
                        $this->session->set_flashdata('error', 'Please Enter Your Vaild Bank Registered Phone No.');
                    }
                }else{
                  $this->session->set_flashdata('error', validation_errors());
                }
            }
            $this->load->view('addBeneficiary',$response);
        }else{
            redirect('Member/Management/login');
        }
    }

    public function beneficiaryDetails(){
        if (is_logged_in()) {
            $response['header'] = 'Money Transfer';

            $this->load->view('beneficiaryDetails',$response);
        }else{
            redirect('Member/Management/login');
        }
    }

    public function moneyTransfer($id=''){
        if (is_logged_in()) {
            $response['header'] = 'Withdaw Money (IMPS)';
            $response['id'] = trim(addslashes($id));
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                    $data = $this->security->xss_clean($this->input->post());
                    // $this->form_validation->set_rules('otp', 'OTP', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                    $this->form_validation->set_rules('txn_password', 'Master Key', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $checkBeneficary = $this->User_model->get_single_record('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id'], 'id' => $response['id']), '*');
                        if(!empty($checkBeneficary)){
                            // if($data['otp'] == $_SESSION['verification_otp'] && !empty($_SESSION['verification_otp'])){
                                // $user_id = $data['user_id'];
                                $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id'], 'disabled' => 0, 'withdraw_status' => 0), '*');
                                $withdraw_amount = trim(addslashes($this->input->post('amount')));
                                $master_key = trim(addslashes($this->input->post('txn_password')));
                                
                                //$balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" AND type != "recharge_income"', 'ifnull(sum(amount),0) as balance');
                                $balance = $this->User_model->get_single_record('tbl_bank_details', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'totalBalance');
                                $directs = $this->User_model->get_single_record('tbl_users', ' sponser_id = "' . $this->session->userdata['user_id'] . '" AND paid_status > 0', 'count(id) as ids');
                                $today_money = $this->User_model->get_single_record('tbl_money_transfer', ' user_id = "' . $this->session->userdata['user_id'] . '" AND (status = "SUCCESS" OR status = "ACCEPTED") and date(created_at) = date(now())', '*');
                                if(empty($today_money)){
                                    if ($withdraw_amount >= 300 && $withdraw_amount <= 1000) {
                                        if($directs['ids'] >= 1){
                                        if ($withdraw_amount % 300 == 0) {
                                            if ($balance['totalBalance'] >= $withdraw_amount) {
                                                if ($user['master_key'] == $master_key AND $checkBeneficary['account_ifsc'] != '6244482379_IDIB000R072') {
                                                    // if($kyc_status['kyc_status'] == 2){
                                                        // $transfer_amount = (round($data['amount'] * 85 / 100) - 10); // 10% IMPS charges including admin+tds
                                                        // $transfer_amount = (round($data['amount']));
                                                        $tds = ($data['amount']*0.15);
                                                        $transfer_amount = (round($data['amount'] * 85 / 100));
                                                        $myorderid = $this->generate_order_id();
                                                        $ch = curl_init();
                                                        $timeout = 61;
                                                        //$b = explode('_',$beneficiry_id);
                                                        $callBackUrl = base_url('Member/IMPS/callBackUrl');
                                                        $paramList = array('apikey' => $this->api_token,'mobileno' => $checkBeneficary['beneficiary_mobile'], 'beneficiary_account_no' => $checkBeneficary['beneficiary_account_no'], 'beneficiary_ifsc' => $checkBeneficary['beneficiary_ifsc'], 'amount' => $transfer_amount, 'orderid' => $myorderid, 'purpose' => 'BONUS', 'remarks' => 'PSB', 'callbackurl' => $callBackUrl);
                                                        //print_r($paramList);
                                                        $jsondata = $this->curlSetup($paramList);
                                                        if(!empty($jsondata)){ 

                                                            if($jsondata['status'] != 'FAILED'){ 
                                                                $DirectIncome = array(
                                                                    'user_id' => $this->session->userdata['user_id'],
                                                                    'amount' => -$withdraw_amount,
                                                                    'type' => 'bank_transfer',
                                                                    'description' => 'Bank Transfer',
                                                                );
                                                                $this->User_model->add('tbl_withdraw_transaction', $DirectIncome);
                                                                $this->User_model->updateField('tbl_bank_details','totalBalance','totalBalance -'.$withdraw_amount,['user_id' => $this->session->userdata['user_id']]);
                                                            }

                                                            if($jsondata['status'] == 'ACCEPTED' || $jsondata['status'] == 'SUCCESS'){
                                                                $transactionArr = array(
                                                                    'user_id' => $this->session->userdata['user_id'],
                                                                    'beneficiaryid' => $jsondata['beneficiaryid'],
                                                                    'amount' => $transfer_amount,
                                                                    'status' => $jsondata['status'],
                                                                    'joloorderid' => $jsondata['txid'],
                                                                    'time' => $jsondata['time'],
                                                                    'desc' => $jsondata['desc'],
                                                                    'orderid' => $myorderid,
                                                                    'payable_amount' => $withdraw_amount,
                                                                    'tds' => $tds,
                                                                );
                                                                $this->User_model->add('tbl_money_transfer', $transactionArr);
                                                                // $message = 'Dear '.$user['name'].' your withdrawal Rs.'.$withdraw_amount.' have been successful credit into your Bank account. More Info: https://powersavingbank.com/';

                                                                $message = 'Dear '.$user['name'].' You have Successfully Received of amount Rs.'.$withdraw_amount.' For More Details Please Visit: https://powersavingbank.com/';
                                                               //notify_user($this->session->userdata['user_id'],$message,$temp_id='1407161518215297510');
                                                                // $this->session->set_flashdata('message', 'Transaction Completed Successfully');
                                                                $this->session->set_flashdata('success', 'Request Accepeted Successfully');
                                                            }else{
                                                                if($jsondata['error'] == 'Insufficient API balance'){
                                                                    $this->session->set_flashdata('error', 'Your Bank not responding. please try after later!');
                                                                }else{
                                                                    $this->session->set_flashdata('error', $jsondata['error']);
                                                                }
                                                            }
                                                            
                                                        }else{
                                                            $this->session->set_flashdata('error', 'IMPS Server Down, Please try again later!');   
                                                            // $countxx="0";//fake    
                                                        }
                                                    // }else{
                                                    //     $this->session->set_flashdata('message', 'You KYC is not approved,Please contact Admin');
                                                    // }
                                                } else {
                                                    $this->session->set_flashdata('error', 'Invalid Master Key');
                                                }
                                            } else {
                                                $this->session->set_flashdata('error', 'Insuffcient Balance');
                                            }
                                        } else {
                                            $this->session->set_flashdata('error', 'Withdraw Amount is multiple of 300');
                                        }
                                        } else {
                                            $this->session->set_flashdata('error', 'For Withdraw 1 direct required!');
                                        }
                                    } else {
                                        //$this->session->set_flashdata('error', 'Minimum Withdrawal Amount is Rs 300');
                                    }
                                }else{
                                    $this->session->set_flashdata('error', 'You Can Withdraw Only Once in a Day');
                                }
                            // }else{
                            //     $this->session->set_flashdata('error', 'Please enter correct OTP');
                            // }
                        }
                    } else {
                        $this->session->set_flashdata('error', validation_errors());
                    }
                }
                $response['withdraw'] = '300, Multiple Rs. 300 & Maximum Unlimited';

            $this->load->view('moneyTransfer',$response);
        }else{
            redirect('Member/Management/login');
        }

    }

    private function generate_order_id() {
        $order_id = rand(100000000, 999999999);
        $order = $this->User_model->get_single_record('tbl_money_transfer', array('orderid' => $order_id), 'orderid');
        if (!empty($order)) {
            return $this->generate_order_id();
        } else {
            return $order_id;
        }
    }


    private function curlSetup($paramList){
        if(!empty($paramList)){
            $apikey= $this->api_token;
            // $userid= $this->api_user_id;
            // $headerstring = "$userid|$apikey";
            // $hashedheaderstring = hash("sha512", $headerstring);
            $paramLists = $paramList;
            $payload = json_encode($paramLists, true);
            $url = "http://13.127.227.22/freeunlimited/v3/transfer.php";
            $header= array('Content-Type:application/json');
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            $response = curl_exec ($ch); 
            $err = curl_error($ch);
            curl_close($ch);
            return json_decode($response, true);
        }
    }

    


    public function callBackUrl(){
        //status=SUCCESS&operatortxnid=9001110002&joloorderid=Z123456789012345&userorderid=TEST123456
        $data = array();
        $res = array();
        $data['status'] = $this->input->post('status');
        $data['operatortxnid'] = $this->input->post('operatortxnid');
        $data['joloorderid'] = $this->input->post('joloorderid');
        $data['userorderid'] = $this->input->post('userorderid');
        $res = $this->User_model->update('tbl_money_transfer', array('orderid' => $data['userorderid']), $data);
        if($res){
            if($data['status'] == 'FAILED'){
                $transaction = $this->User_model->get_single_record('tbl_money_transfer', array('orderid' => $data['userorderid']), '*');
                $DirectIncome = array(
                    'user_id' => $transaction['user_id'],
                    'amount' => $transaction['payable_amount'],
                    'type' => 'bank_transfer',
                    'description' => 'Failed Bank Transaction',
                );
                $this->User_model->add('tbl_withdraw_transaction', $DirectIncome);
                $this->User_model->updateField('tbl_bank_details','totalBalance','totalBalance +'.$transaction['payable_amount'],['user_id' => $transaction['user_id']]);
            }
            $res['status'] = 'SUCCESS';
            $res['message'] = 'Request Updated Successfully';
        }else{
            $res['status'] = 'FAILED';
            $res['message'] = 'Error While Updating Request';
        }
        echo json_encode($res);
    }

    public function getOtp()
    {   
        if ($this->input->is_ajax_request()) {
            if ($this->input->server('REQUEST_METHOD') == 'GET') {
                $get = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'name');
                if(!empty($get)){
                    $_SESSION['verification_otp'] = rand(100000, 999999);
                    $this->session->mark_as_temp('verification_otp', 600);
                    $message = 'Dear '.$get['name'].', Your OTP is '.$this->session->userdata['verification_otp'].' Never share this OTP with anyone, this otp expire in 10 mintues. More Info: https://makeroyalworld.com/';
                    // $message = 'You OTP is '.$this->session->userdata['verification_otp'].' (One Time Password), this otp expire in 2 mintues!';
                    notify_user($this->session->userdata['user_id'], $message);
                    if($message){
                        $response['status'] = 1;
                        
                    }else{
                        $response['status'] = 0;
                    }
                }else{
                    $response['status'] = 0;
                }
            }
        }else{
            $response['status'] = 0;
        }

        echo json_encode($response);
    }

    

}