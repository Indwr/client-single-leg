<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Activation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
        date_default_timezone_set("Asia/Calcutta");
    }

    // public function accountActive(){
    //     if(is_logged_in()){
    //         $response['header'] = 'Account Activation';
    //         $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
    //         if ($this->input->server('REQUEST_METHOD') == 'POST') {
    //             // $this->session->set_flashdata('message', 'Please Wait!');
    //             $data = $this->security->xss_clean($this->input->post());
    //             $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
    //             $this->form_validation->set_rules('epin', 'Epin', 'trim|required|xss_clean');
    //             $this->form_validation->set_rules('txn_pass', 'Txn Password', 'trim|required|xss_clean');
    //             if ($this->form_validation->run() != FALSE) {
    //                 $user_id = $data['user_id'];
    //                 $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
    //                 $pin_status = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'epin' => $data['epin']), '*');
    //                 if (!empty($pin_status)) {
    //                     $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
    //                     if (!empty($user)) {
    //                         if ($pin_status['status'] == 0) {
    //                             if ($user['paid_status'] == 0) {
    //                                 $topupData = array(
    //                                     'paid_status' => 1,
    //                                     'package_id' => $data['package_id'],
    //                                     'package_amount' => $package['price'],
    //                                     'topup_date' => date('Y-m-d H:i:s'),
    //                                     // 'capping' => $package['capping'],
    //                                 );
    //                                 $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
    //                                 $this->User_model->update('tbl_epins', array('id' => $pin_status['id']), array('used_for' => $user['user_id'], 'status' => 1));
    //                                 $this->User_model->update_directs($user['sponser_id']);
    //                                 $this->User_model->total_team_update($user['id']);
    //                                 // $this->calculate_waste_points();
    //                                 $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs,paid_status');
    //                                 if($sponser['paid_status'] == 1){
    //                                     $DirectIncome = array(
    //                                         'user_id' => $user['sponser_id'],
    //                                         'amount' => $package['direct_income'],
    //                                         'type' => 'direct_income',
    //                                         'description' => 'Direct Income from Activation of Member ' . $user_id,
    //                                     );
    //                                     $this->User_model->add('tbl_income_wallet', $DirectIncome);
    //                                 }
    //                                 $this->level_income($sponser['sponser_id'], $user['user_id'], $package['level_income']);
    //                                 $this->add_team_counts($user['user_id'], $user['user_id']);
    //                                 $this->royaltyAchiever($user['sponser_id']);
    //                                 redirect('Dashboard/Settings/epins/0');
    //                                 $this->session->set_flashdata('message', 'Account Activated Successfully');
    //                             } else {
    //                                 $this->session->set_flashdata('message', 'This Account Already Acitvated');
    //                             }
    //                         } else {
    //                             $this->session->set_flashdata('message', 'Expired Epin');
    //                         }
    //                     } else {
    //                         $this->session->set_flashdata('message', 'Invalid User ID');
    //                     }
    //                 } else {
    //                     $this->session->set_flashdata('message', 'This Pin is not valid for you');
    //                 }
    //             }
    //         }
    //         $response['available_pins'] = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'status' => 0), 'ifnull(count(id),0) as available_pins');
    //         $response['packages'] = $this->User_model->get_records('tbl_package', array(), '*');
    //         // $response['epin'] = $epin;
    //          $this->load->view('activationform',$response);
    //     }else{
    //         redirect('Dashboard/User/login');
    //     }
    // }

    public function accountActive($epin=''){
        if (is_logged_in()) {
            $response['epin'] = trim(addslashes($epin));
            $response['header'] = 'Activate Account'; 
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('epin', 'Epin', 'trim|required|xss_clean');
                $this->form_validation->set_rules('txn_password', 'Txn Password', 'trim|required|xss_clean');
                $this->form_validation->set_rules('package_id', 'Package ID', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = trim(addslashes($data['user_id']));
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $activatorData = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $pin_status = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'epin' => trim(addslashes($data['epin'])), 'status' => 0), '*');
                    if (!empty($pin_status)) {
                        $response['package'] = $this->User_model->get_single_record('tbl_package', array('id' => trim(addslashes($data['package_id']))), '*');
                        $package = $response['package'];
                        if (!empty($user)) {
                           if ($pin_status['status'] == 0) {
                                if ($user['paid_status'] == 0 && $pin_status['amount'] == $package['price']) { 
                                    if ($activatorData['master_key'] == trim(addslashes($data['txn_password']))) { 
                                        $topupData = array(
                                                'paid_status' => 1,
                                                'package_id' => $package['id'],
                                                'package_amount' => $package['price'],
                                                'topup_date' => date('Y-m-d H:i:s'),
                                            );
                                            $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                            $this->User_model->update('tbl_epins', array('id' => $pin_status['id']), array('used_for' => $user['user_id'], 'status' => 1));
                                            $this->User_model->update_directs($user['sponser_id']);
                                            $this->User_model->update('tbl_downline_count', array('downline_id' => $user_id),['paid_status' => 1,'amount' => $package['price'],'activeDate' => date('Y-m-d H:i:s')]);
                                            //$this->User_model->total_team_update($user['id']);
                                            // $this->User_model->upgrade_total_team_update($user['id']);
                                            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), '*');
                                            

                                            if($sponser['paid_status'] == 1){
                                                $DirectIncome = array(
                                                    'user_id' => $user['sponser_id'],
                                                    'amount' => $package['direct_income'],
                                                    'type' => 'direct_income',
                                                    'description' => 'Direct Income from Activation of Member ' . $user_id,
                                                );
                                                $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                            }
                                            //$this->level_income($sponser['sponser_id'], $user['user_id'], $package['level_income']);
                                            $this->add_team_counts($user['user_id'], $user['user_id']);
                                            $this->fastIncome($user['sponser_id']);
                                            //$this->royaltyAchiever($user['sponser_id']);
                                            $this->session->set_flashdata('success', 'Account Activated Successfully');
                                            redirect('Member/Epin/AvailebleEpin');
                                    }else {
                                        $this->session->set_flashdata('error', 'Invaild Txn Password!');
                                    }
                                }else {
                                    $this->session->set_flashdata('error', 'This Account Already Activated');
                                }
                                ///// Upgrade process

                                // if ($user['paid_status'] == 0 && $pin_status['amount'] == 599 && $pin_status['status'] == 0) { 
                                //     if ($activatorData['master_key'] == trim(addslashes($data['txn_password']))) {

                                //     $sponserCheck = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs,paid_status,upgrade_status,upgrade_total_user_after_paid');
                                //         if($sponserCheck['upgrade_status'] == 1){
                                //             $topupData = array(
                                //                     'paid_status' => 1,
                                //                     'package_id' => 1,
                                //                     'package_amount' => 600,
                                //                     'topup_date' => date('Y-m-d H:i:s'),
                                //                 );
                                //                 $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                //                 $this->User_model->update('tbl_epins', array('id' => $pin_status['id']), array('used_for' => $user['user_id'], 'status' => 1));
                                //                 // $this->User_model->update_directs($user['sponser_id']);
                                //                 $this->User_model->upgrade_update_directs($user['sponser_id']);
                                //                 $this->User_model->total_team_update($user['id']);
                                //                 $this->User_model->upgrade_total_team_update($user['id']);
                                                

                                //                 $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs,paid_status');
                                //                 if($sponser['paid_status'] == 1){
                                //                     $DirectIncome = array(
                                //                         'user_id' => $user['sponser_id'],
                                //                         'amount' => '60',
                                //                         'type' => 'super_direct_income',
                                //                         'description' => 'Direct Income from Activation of Member ' . $user_id,
                                //                     );
                                //                     $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                //                 }
                                //                 $this->level_income($sponser['sponser_id'], $user['user_id'], $package['level_income']);
                                //                 $this->add_team_counts($user['user_id'], $user['user_id']);
                                //                 $this->royaltyAchiever($user['sponser_id']);
                                //                 $this->session->set_flashdata('success', 'Account Activated Successfully');
                                //                 redirect('Member/Epin/AvailebleEpin');
                                //         }else {
                                //             $this->session->set_flashdata('error', 'Your sponsor is not upgraded!');
                                //         }
                                //     }else {
                                //         $this->session->set_flashdata('error', 'Invaild Txn Password!');
                                //     }
                                // }else {
                                //     $this->session->set_flashdata('error', 'This Account Already Activated!');
                                // }
                            } else {
                                $this->session->set_flashdata('error', 'Expired Epin');
                            }
                        }else {
                           $this->session->set_flashdata('error', 'Invalid User ID');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'This Pin is not valid for you');
                    }
                }else{
                  $this->session->set_flashdata('error', validation_errors());
                }
            }
            
            $response['available_pins'] = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'status' => 0), 'ifnull(count(id),0) as available_pins');
            $epinDetails = $this->User_model->get_single_record('tbl_epins', array('epin' => $response['epin'], 'status' => 0), '*');
            $response['packages'] = $this->User_model->get_records('tbl_package', array('price' => $epinDetails['amount']), '*');
            $this->load->view('activation',$response);
        }else{
            redirect('Member/Management/login');
        }
    }

    // public function test(){
    //     $this->fastIncome('admin');
    // }

    private function fastIncome($user_id){
        $user = $this->User_model->get_single_record('tbl_users',['paid_status' => 1,'directs >=' => 10,'fastIncome <' => 100,'user_id' => $user_id],'user_id,topup_date,fastIncome');
        if(!empty($user['user_id'])):
            $date1 = date('Y-m-d H:i:s');
            $date2 = date('Y-m-d H:i:s',strtotime($user['topup_date'].' + 30 days'));
            $date3 = date('Y-m-d H:i:s',strtotime($user['topup_date'].' + 20 days'));
            $date4 = date('Y-m-d H:i:s',strtotime($user['topup_date'].' + 10 days'));
            $diff1 = strtotime($date2) - strtotime($date1);
            $diff2 = strtotime($date3) - strtotime($date1);
            $diff3 = strtotime($date4) - strtotime($date1);
            if($diff1 > 0):
                $direct = $this->User_model->get_single_record('tbl_users',['sponser_id' => $user['user_id'],'topup_date >=' => $user['topup_date'],'topup_date <=' => $date2],'count(id) as direct');
                $amount = 100 - $user['fastIncome'];
                if($direct['direct'] == 30){
                    $creditIncome = [
                        'user_id' => $user['user_id'],
                        'amount' => $amount,
                        'type' => 'fast_income',
                        'description' => 'Fast Income at 30 directs',
                    ];
                    $this->User_model->add('tbl_income_wallet',$creditIncome);
                    $this->User_model->update('tbl_users',['user_id' => $user['user_id']],['fastIncome' => ($user['fastIncome']+$amount)]);
                }
            endif; 
            if($diff2 > 0):
                $amount = 60 - $user['fastIncome'];
                $direct = $this->User_model->get_single_record('tbl_users',['sponser_id' => $user['user_id'],'topup_date >=' => $user['topup_date'],'topup_date <=' => $date3],'count(id) as direct');
                if($direct['direct'] == 20){
                    $creditIncome = [
                        'user_id' => $user['user_id'],
                        'amount' => $amount,
                        'type' => 'fast_income',
                        'description' => 'Fast Income at 20 directs',
                    ];
                    $this->User_model->add('tbl_income_wallet',$creditIncome);
                    $this->User_model->update('tbl_users',['user_id' => $user['user_id']],['fastIncome' => ($user['fastIncome']+$amount)]);
                }
            endif; 
            if($diff3 > 0):
                $direct = $this->User_model->get_single_record('tbl_users',['sponser_id' => $user['user_id'],'topup_date >=' => $user['topup_date'],'topup_date <=' => $date4],'count(id) as direct');
                if($direct['direct'] == 10){
                    $creditIncome = [
                        'user_id' => $user['user_id'],
                        'amount' => 25,
                        'type' => 'fast_income',
                        'description' => 'Fast Income at 10 directs',
                    ];
                    $this->User_model->add('tbl_income_wallet',$creditIncome);
                    $this->User_model->update('tbl_users',['user_id' => $user['user_id']],['fastIncome' => '25']);
                }
            endif; 
        endif;
    }


    public function accountUpgrade($epin=''){
        if (is_logged_in()) {
            $response['epin'] = trim(addslashes($epin));
            $response['header'] = 'Upgrade Account for Start Double Leg'; 
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('epin', 'Epin', 'trim|required|xss_clean');
                $this->form_validation->set_rules('txn_password', 'Txn Password', 'trim|required|xss_clean');
                $this->form_validation->set_rules('package_id', 'Package ID', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = trim(addslashes($data['user_id']));
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $activatorData = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $pin_status = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'epin' => trim(addslashes($data['epin'])), 'status' => 0), '*');
                    if (!empty($pin_status)) {
                        $response['package'] = $this->User_model->get_single_record('tbl_package', array('id' => trim(addslashes($data['package_id']))), '*');
                        $package = $response['package'];
                        if(!empty($user)) {
                            if($pin_status['status'] == 0 && $pin_status['amount'] == 1000) {
                                if ($user['paid_status'] == 0){
                                    $this->session->set_flashdata('error', 'This Account not eligible for upgrade, Please Activate Your Account!');
                                }else{
                                    if ($user['paid_status'] == 1 && $user['upgrade_status'] == 0) { 
                                        if ($activatorData['master_key'] == trim(addslashes($data['txn_password']))) { 
                                            $topupData = array(
                                                'upgrade_status' => 1,
                                                'upgrade_date' => date('Y-m-d H:i:s'),
                                            );
                                            $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                            $this->User_model->update('tbl_epins', array('id' => $pin_status['id']), array('used_for' => $user['user_id'], 'status' => 1));
                                            // $this->User_model->update_directs($user['sponser_id']);
                                            // $this->User_model->total_team_update($user['id']);

                                            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs,paid_status');
                                            if($sponser['paid_status'] == 1){
                                                $DirectIncome = array(
                                                    'user_id' => $user['sponser_id'],
                                                    'amount' => '60',
                                                    'type' => 'super_direct_income',
                                                    'description' => 'Super Direct Income from Upgrade of Member ' . $user_id,
                                                );
                                                $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                            }
                                            // $super_level_income = '50,30,20,10,5';
                                            // $this->super_level_income($sponser['sponser_id'], $user['user_id'], $super_level_income);
                                            // $this->add_team_counts($user['user_id'], $user['user_id']);
                                            // $this->royaltyAchiever($user['sponser_id']);
                                            $this->session->set_flashdata('success', 'Account Activated Successfully');
                                            redirect('Member/Epin/AvailebleEpin');
                                        }else {
                                            $this->session->set_flashdata('error', 'Invaild Txn Password!');
                                        }
                                    }else {
                                        $this->session->set_flashdata('error', 'This Account is Already Upgraded!');
                                    }
                                }
                            } else {
                                $this->session->set_flashdata('error', 'Expired/Invaild Epin');
                            }
                        }else {
                           $this->session->set_flashdata('error', 'Invalid User ID');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'This Pin is not valid for you');
                    }
                }else{
                  $this->session->set_flashdata('error', validation_errors());
                }
            }
            
            $response['available_pins'] = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'status' => 0), 'ifnull(count(id),0) as available_pins');
            $response['packages'] = $this->User_model->get_records('tbl_package', array(), '*');
            $this->load->view('upgradation',$response);
        }else{
            redirect('Member/Management/login');
        }
    }

    private function super_level_income($sponser_id, $activated_id, $package_income) {
        $incomes = explode(',', $package_income);
        foreach ($incomes as $key => $income) {
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status');
            if (!empty($sponser)) {
                if ($sponser['paid_status'] == 1) {
                    $LevelIncome = array(
                        'user_id' => $sponser['user_id'],
                        'amount' => $income,
                        'type' => 'super_level_income',
                        'description' => 'Super Level Income from Upgrade of Member ' . $activated_id . ' At level ' . ($key + 2),
                    );
                    $this->User_model->add('tbl_income_wallet', $LevelIncome);
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
    }

    private function level_income($sponser_id, $activated_id, $package_income) {

        $incomes = [];
        //$incomes = explode(',', $package_income);
        foreach ($incomes as $key => $income) {
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status');
            if (!empty($sponser)) {
                if ($sponser['paid_status'] == 1) {
                    $LevelIncome = array(
                        'user_id' => $sponser['user_id'],
                        'amount' => $income,
                        'type' => 'level_income',
                        'description' => 'Level Income from Activation of Member ' . $activated_id . ' At level ' . ($key + 2),
                    );
                    $this->User_model->add('tbl_income_wallet', $LevelIncome);
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
    }

     private function add_team_counts($user_name = '', $downline_id = '') {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'sponser_id,user_id');
        if ($user['sponser_id'] != '') {
            $this->User_model->update_team_count('paid_team_count', $user['sponser_id']);
            $user_name = $user['sponser_id'];
            $this->add_team_counts($user_name, $downline_id);
        }
    }

    private function royaltyAchiever($user_id){
        $userData = $this->User_model->get_single_record('tbl_users',['user_id' => $user_id],'directs,topup_date');
        $date1 = date('Y-m-d H:i:s');
        $date2 = date('Y-m-d H:i:s',strtotime($userData['topup_date'].'+10 days'));
        $diff = strtotime($date2) - strtotime($date1);
        if($diff > 0){
            if($userData['directs'] >= 50){
                $this->User_model->update('tbl_users',['user_id' => $user_id],['royalty_status' => 1]);
            }
        }
    }


    
}