<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Epin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
        date_default_timezone_set("Asia/Calcutta");
    }

    public function index(){
        if (is_logged_in()) {
            $response['header'] = 'Availeble E-Pins'; 
            $response['users'] = $this->User_model->get_records('tbl_epins', array('user_id' => $this->session->userdata['user_id'],'status' => 0), '*');
          
            $this->load->view('availableEpins',$response);
        }else{
            redirect('Member/Management/login');
        }
    }

   

    public function Transfer_Epin(){
      if (is_logged_in()) {
          $Response['header'] = 'Transfer Epins';
          if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->security->xss_clean($this->input->post());
             $this->form_validation->set_rules('user_id','User Id','required|trim|xss_clean');
             $this->form_validation->set_rules('txn_pass','Txn Password','required|trim|xss_clean');
             $this->form_validation->set_rules('numbr_epins','NOP (Number of Epins)','required|trim|numeric|xss_clean');
                if($this->form_validation->run() != FALSE){
                  $data['numbr_epins'] = trim(addslashes($data['numbr_epins']));
                  $user = $this->User_model->get_single_record('tbl_users',array('user_id' => $this->session->userdata('user_id')),'user_id,master_key');
                  $user1 = $this->User_model->get_single_record('tbl_epins',array('user_id' => $this->session->userdata('user_id'),'status' => 0),'count(epin) as epins');
                  
                       if($data['txn_pass'] == $user['master_key']){
                           if($user1['epins'] >= $data['numbr_epins'] && $data['numbr_epins'] > 0 && !empty($data['numbr_epins'])){
                              if($data['numbr_epins'] <= 30){
                                for ($i=1; $i <= $data['numbr_epins'] ; $i++) { 

                                  $user2 = $this->User_model->get_single_record('tbl_epins',array('user_id' => $this->session->userdata('user_id'),'status' => 0),'*');

                                  $this->User_model->update('tbl_epins',array('user_id' => $this->session->userdata('user_id'),'id' => $user2['id']),['status' => '2', 'used_for' => $data['user_id']]);

                                  // $this->User_model->update('tbl_epins',array('user_id' => $data['user_id']),['epin' => $this->randEpin(), 'sender_id' => $this->session->userdata['user_id']]);
                                  $add = ['user_id' => trim(addslashes($data['user_id'])), 'epin' => $this->randEpin(), 'sender_id' => $this->session->userdata['user_id'], 'amount' => $user2['amount']];
                                  $this->User_model->add('tbl_epins', $add);

                                }
                                  $this->session->set_flashdata('success','E-pin Transfer Successfully!');
                              }else{
                                $this->session->set_flashdata('error','Only 30 Epins Limit one time!');
                              }
                           }else{
                               $this->session->set_flashdata('error','Insufficient Epins!');
                            }
                       }else{
                           $this->session->set_flashdata('error','TXN Password is Not Matched!');
                       }
                }else{
                  $this->session->set_flashdata('error',validation_errors());
                }
          } 
              $this->load->view('transferEpin',$Response);
        }else{
            redirect('Member/Management/login');
        }
    }

    public function randEpin(){

      $epin = strtoupper(md5(rand(1000000,9999999)));
      $data = $this->User_model->get_records('tbl_epins',array('epin' => $epin),'*');
        if(!empty($data)){
          return $this->randEpin();
        }else{
          return $epin;
          }

  }

  public function AvailebleEpin(){
    if (is_logged_in()) {

        $response['header'] = 'Availeble E-Pins';
        $response['users'] = $this->User_model->get_records('tbl_epins',array('user_id' => $this->session->userdata('user_id'),'status' => 0),'*');
        $this->load->view('availableEpins',$response);

    }else{
       redirect('Member/Management/login');
      }

  }

  public function epinHistory($status){
       if (is_logged_in()) {
            $response = array();
            if ($status == 1)
                $response['header'] = 'Used E-Pins';
            elseif ($status == 2)
                $response['header'] = 'Transfer E-Pins';
            $config['base_url'] = base_url() . 'Member/Epin/epinHistory/' . $status;
            $config['total_rows'] = $this->User_model->get_sum('tbl_epins', array('status' => $status), 'ifnull(count(id),0) as sum');
            $config ['uri_segment'] = 5;
            $config['per_page'] = 50;
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(5);
            $response['segament'] = $segment;
            $response['records'] = $this->User_model->get_limit_records('tbl_epins', array('status' => $status), '*', $config['per_page'], $segment);
            $this->load->view('epinHistory', $response);
        }else{
            redirect('Member/Management/login');
        }

  }

    
}