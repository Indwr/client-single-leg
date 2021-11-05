<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index() {

    }
    
    public function remove_roi_level(){
        // die('Stop');
        ini_set('max_execution_time', 0); 
        $achievers = $this->Main_model->checkRoiLevel();
        foreach($achievers as $key => $ac){
            for($i=1;$i<=6;$i++){
                $users = $this->Main_model->get_single_record('tbl_roi',array('user_id' => $ac['user_id'],'level' => $i),'*');
                if(!empty($users)){
                    $date1 = date('Y-m-d H:i:s');
                    $date2 = date('Y-m-d H:i:s',strtotime($users['created_at'].'+ 72 hours'));
                    $diff = strtotime($date1) - strtotime($date2);
                    //echo $diff . 'level '.$i.'<br>';
                    if($diff > 0){
                        $this->lapsLevel($users['id'],$ac['user_id'],$i);
                    }
                }else{
                    $i = 6;
                }
            }
        }
    }

    public function lapsLevel($id,$user_id,$level){
        $legArr = $this->config->item('single_leg');
        foreach($legArr as $key => $la){
            if($level == $key){
                $userdata = $this->Main_model->get_single_record('tbl_users',array('user_id' => $user_id, 'paid_status >' => 0),'directs');
                if($userdata['directs'] < $la['total_directs']){
                    $this->Main_model->update('tbl_roi',array('id' => $id,'level' => $level),array('days' => 0));
                }
            }
        }
    }


    public function calculate_roi_users(){
        echo 'Start: '.date('H:i:s');
        $last_id = $this->Main_model->get_single_record_desc('tbl_users',array(),'id');
        $achievers = $this->Main_model->get_records('tbl_users', array('paid_status' => 1, 'total_user_after_paid >=' => 100), 'id,user_id,sponser_id,directs,total_user_after_paid,single_leg_status');
        $legArr = $this->config->item('single_leg');
        foreach($achievers as $key => $achiever){
            $directs = $this->Main_model->get_single_record('tbl_users', array('sponser_id' => $achiever['user_id'] , 'paid_status' => 1), 'ifnull(count(id),0) as directs');
            foreach($legArr as $key2 => $la){
                if($achiever['single_leg_status'] < $key2){
                    $new_id = $last_id['id'] - $achiever['id'];
                    //if($directs['directs'] >= $la['direct_sponser'] && ($achiever['total_user_after_paid']) >= $la['winning_team']){
                    if($achiever['total_user_after_paid'] >= $la['winning_team']){
                        $roi_user = $this->Main_model->get_single_record('tbl_roi', array('user_id' => $achiever['user_id'] , 'level' => $key2), '*');
                        if(empty($roi_user)){
                            $roiArr = array(
                                'user_id' => $achiever['user_id'],
                                'amount' => $la['amount'],
                                'type' => 'single_leg_income',
                                'remark' =>'Single Leg Income for '.$key2.' Level',
                                'level' => $key2,
                                'days' => $la['day'],
                            );
                            pr($roiArr);
                            echo date('H:i:s');
                            $this->Main_model->add('tbl_roi', $roiArr);
                            $this->Main_model->update('tbl_users', array('user_id' => $achiever['user_id']), array('single_leg_status' => $key2));
                        }
                    }
                }
            }
        }
        echo 'Done'.date('H:i:s');
    }


    public function credit_roi_income(){
        $cron = $this->Main_model->get_single_record('tbl_cron','  date(created_at) = date(now()) and cron_name = "credit_roi_income"' ,'*');
        if(empty($cron)){   
            $legArr = $this->config->item('single_leg');
            for ($i=1; $i < 14; $i++) {
                $achievers = $this->Main_model->get_records('tbl_roi', array('days >' => 0, 'level' => $i), '*');
                foreach($achievers as $key => $achiever){
                    $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => str_replace(' ','',$achiever['user_id'])), 'id,user_id,directs,single_leg_status,paid_status');

                    if($user['directs'] >= $legArr[$achiever['level']]['total_directs'] && $user['paid_status'] == 1){
                        $income = array(
                            'user_id' => $achiever['user_id'],
                            'amount' => $achiever['amount'],
                            'type' => $achiever['type'],
                            'description' => $achiever['remark'] .' At Day '.$achiever['days'],
                            'level' => $achiever['level'],
                        );

                        $this->Main_model->add('tbl_income_wallet', $income);
                       //}
                        pr($user);
                        $this->Main_model->update('tbl_roi', array('id' => $achiever['id']), array('days' => $achiever['days'] - 1));
                    // }
                }
            }
        }
            $this->Main_model->add('tbl_cron', array('cron_name' => 'credit_roi_income'));
            //$this->checkPoolEntry();
            echo 'Done';
        }else{
            echo'today cron already run';
        }
    }
    
}
