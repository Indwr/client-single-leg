<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Incomes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
        date_default_timezone_set("Asia/Calcutta");
    }


    public function index($type='')
    {
        if (is_logged_in()) {
            if(empty($type)){
                $response['header'] = 'All Income Reports';
                $response['incomesData'] = $this->User_model->get_records('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id'], 'amount >' => 0), '*');
                $response['totalAmount'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id'], 'amount >' => 0), 'ifnull(sum(amount),0) as totalAmount');
            }else{
                $response['header'] = strtoupper(str_replace('_', ' ', $type));
                $response['incomesData'] = $this->User_model->get_records('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => trim(addslashes($type))), '*');
                $response['totalAmount'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => trim(addslashes($type))), 'ifnull(sum(amount),0) as totalAmount');
            }
            $this->load->view('incomes', $response);
        }else{
            redirect('Member/Management/login');
        }
    }


    
}