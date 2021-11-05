<?php
// die();
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

class Cron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'security'));
    }

    public function index() {

    }

    public function singleLegIncome($level = '')
    {
        if($level > 0){
            $singleLeg = $this->config->item('single_leg');
            $users = $this->User_model->get_records('tbl_users', array('paid_status >' => 0, 'disabled' => 0, 'fake_id' => 0, 'total_user_after_paid >=' => 100, 'directs >' => 0), 'id,user_id,directs,total_user_after_paid');
            foreach ($users as $key => $value) {
                $team = $singleLeg[$level];
                
                if($team['team'] >= $value['total_user_after_paid']){
                    if($team['total_directs'] >= $value['directs']){
                        $totalLevelDay = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $value['user_id'], 'level' => $level, 'type' => 'single_leg_income'), 'ifnull(count(id),0) as totalLevelDay');
                        $levelDay = $totalLevelDay['totalLevelDay'];
                        $nowLevelDay = ($levelDay+1);
                        if($levelDay < $team['day']){
                            $checkIncome = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$value['user_id'].'" AND type = "single_leg_income" AND date(created_at) = date(NOW()) AND level = "'.$level.'"', 'ifnull(count(id),0) as checkIncome');
                            if($checkRoiLevel['checkIncome'] == 0){
                                $creditIncome = ['user_id' => $value['user_id'], 'amount' => $team['amount'], 'type' => 'single_leg_income', 'description' => 'Day '.$nowLevelDay.', Level '.$level, 'level' => $level,'created_at' => date('Y-m-d H:i:s')];
                                $this->User_model->add('tbl_income_wallet', $creditIncome);
                                pr($creditIncome);
                            }
                        }
                    }
                }
            }
        }

    }


    public function royaltyAchivers(){
        //die();
       $todayActive = $this->User_model->get_single_record('tbl_users','date(topup_date) = date(now())-1 AND paid_status = "1"' ,'ifnull(count(id),0) todayActive');

       $totalRoyaltyAchivers = $this->User_model->get_single_record('tbl_users', array('royalty_status' => 1),'ifnull(count(id),0) totalRoyaltyAchivers');

       pr($todayActive);

       pr($totalRoyaltyAchivers);
       echo'Total Income: '.$totalIncome = ($todayActive['todayActive']*25);

       echo'Credit Income: '.$creditIncome = $totalIncome/$totalRoyaltyAchivers['totalRoyaltyAchivers'];

       $achivers = $this->User_model->get_records('tbl_users',array('royalty_status' => 1),'*');
       foreach ($achivers as $key => $achiver) {
           $insert = ['user_id' => $achiver['user_id'], 'amount' => $creditIncome, 'type' => 'royalty_income', 'description' => 'Daily Royalty Income'];
           $this->User_model->add('tbl_income_wallet', $insert);
       }


    }

    public function leadershipAchievers()
    {
        //die();
       $todayActive = $this->User_model->get_single_record('tbl_users','date(topup_date) = date(now())-1 AND paid_status = "1"' ,'ifnull(sum(package_amount),0) todayActive');

       $totalRoyaltyAchivers = $this->User_model->get_single_record('tbl_users', array('leadership_status' => 1),'ifnull(count(id),0) totalRoyaltyAchivers');

       pr($todayActive);

       pr($totalRoyaltyAchivers);
       echo'Total Income: '.$totalIncome = ($todayActive['todayActive']*0.025);

       echo'Credit Income: '.$creditIncome = $totalIncome/$totalRoyaltyAchivers['totalRoyaltyAchivers'];
       $achivers = $this->User_model->get_records('tbl_users',array('leadership_status' => 1),'id,user_id,name');
       foreach ($achivers as $key => $achiver) {
           $insert = ['user_id' => $achiver['user_id'], 'amount' => $creditIncome, 'type' => 'leadership_income', 'description' => 'Daily Leadership Income'];
           $this->User_model->add('tbl_income_wallet', $insert);
           pr($insert);
       } 
    }


    public function checkLeadershipAchiver($value='')
    {
       $achivers = $this->User_model->get_records('tbl_users', array('directs >=' => 6, 'leadership_status' => 0, ), 'id,user_id,directs');
       foreach ($achivers as $key => $achiver) {
            $check = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $achiver['user_id'], 'directs >=' => 6), 'ifnull(count(id),0) as ids');
            if($check['ids'] >= 6){
                $finalAchiver[] = ['user_id' => $achiver['user_id']];
            }
       }

       if(!empty($finalAchiver)){
            foreach ($finalAchiver as $key => $value) {
                if($value['user_id'] != 'IPL2021'){
                    $set = ['leadership_status' => 1];
                    $this->User_model->update('tbl_users', array('user_id' => $value['user_id']), $set);
                    pr($value);
                }
            }
       }
    }

    

    
}
