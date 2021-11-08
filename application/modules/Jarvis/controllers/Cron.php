<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
        date_default_timezone_set('Asia/Kolkata');
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
            echo 'Done';
        }else{
            echo'today cron already run';
        }
    }

    public function clubIncome(){
        $month = date('m',strtotime(date('Y-m-d').' - 1  months'));
        $users = $this->Main_model->get_records('tbl_users',['paid_status' => 1,'directs >=' => 3],'user_id,topup_date');
        $turnOver = $this->Main_model->get_single_record('tbl_users',['month(topup_date)' => $month,'paid_status' => 1],'ifnull(sum(package_amount),0) as turnover');
        if($turnOver['turnover'] > 0):
            foreach($users as $user):
                $date1 = date('Y-m-d H:i:s');
                $date2 = date('Y-m-d H:i:s',strtotime($user['topup_date'].' + 15 days'));
                $diff = strtotime($date2) - strtotime($date1);
                if($diff > 0):
                    $level1 = $this->Main_model->get_single_record('tbl_downline_count',['user_id' => $user['user_id'],'paid_status' => 1,'level' => 1],'count(id) as directs');
                    $level2 = $this->Main_model->get_single_record('tbl_downline_count',['user_id' => $user['user_id'],'paid_status' => 1,'level' => 2],'count(id) as directs');
                    $level3 = $this->Main_model->get_single_record('tbl_downline_count',['user_id' => $user['user_id'],'paid_status' => 1,'level' => 3],'count(id) as directs');
                    $i = 1;
                    if($level1['directs'] >= 3 && $level2['directs'] >= 9 && $level3['directs'] >= 27):
                        $clubAchiever1[$i] = $user;
                        $i++;
                    endif;
                    $j = 1;
                    if($level1['directs'] >= 5 && $level2['directs'] >= 25 && $level3['directs'] >= 125):
                        $clubAchiever2[$j] = $user;
                        $j++;
                    endif;
                endif;
            endforeach;
        else:
            echo 'last month business is '.$turnOver['turnover'].'<br>';
        endif;
        if(!empty($clubAchiever1)):
            $perID1 = ($turnOver['turnover']*0.15)/count($clubAchiever1);
            foreach($clubAchiever1 as $achiever1):
                $creditIncome1 = [
                    'user_id' => $achiever1['user_id'],
                    'amount' => $perID1,
                    'type' => 'club_income',
                    'description' => 'Club Income',
                ];
                $this->Main_model->add('tbl_income_wallet',$creditIncome1);
            endforeach;
        else:
            echo 'there is no user in Club <br>';
        endif;

        if(!empty($clubAchiever2)):
            $perID2 = ($turnOver['turnover']*0.1)/count($clubAchiever2);
            foreach($clubAchiever2 as $achiever2):
                $creditIncome2 = [
                    'user_id' => $achiever2['user_id'],
                    'amount' => $perID2,
                    'type' => 'club_income',
                    'description' => 'VIP Club Income',
                ];
                $this->Main_model->add('tbl_income_wallet',$creditIncome2);
            endforeach;
        else:
            echo 'there is no user in VIP Club';
        endif;
    }

    public function incomeTransfer(){
        $incomeArr = [
            1 => ['balance' => 75,'deduction' => 50,'withdraw' => 25],
            2 => ['balance' => 150,'deduction' => 100,'withdraw' => 50],
            3 => ['balance' => 300,'deduction' => 250,'withdraw' => 50],
            4 => ['balance' => 750,'deduction' => 500,'withdraw' => 250],
            5 => ['balance' => 1500,'deduction' => 1000,'withdraw' => 500],
            6 => ['balance' => 3000,'deduction' => 2500,'withdraw' => 500],
            7 => ['balance' => 7500,'deduction' => 5000,'withdraw' => 2500],
            8 => ['balance' => 15000,'deduction' => 10000,'withdraw' => 5000],
            9 => ['balance' => 30000,'deduction' => 20000,'withdraw' => 10000],
            10 => ['balance' => 60000,'deduction' => 30000,'withdraw' => 30000],
        ];
        $users = $this->Main_model->incomeTransfer();
        foreach($users as $user):
            $check = $this->Main_model->get_single_record('tbl_users',['user_id' => $user['user_id']],'upgrade_status');
            $arrKey = $check['upgrade_status'] + 1;
            if($user['balance'] >= $incomeArr[$arrKey]['balance']):
                pr($user);
                $upgradeDebit = [
                    'user_id' => $user['user_id'],
                    'amount' => -$incomeArr[$arrKey]['deduction'],
                    'type' => 'upgrade_deduction',
                    'description' => 'Deducted for upgrade',
                ];
                pr($upgradeDebit);
                $this->Main_model->add('tbl_income_wallet',$upgradeDebit);
                $withdrawDebit = [
                    'user_id' => $user['user_id'],
                    'amount' => -$incomeArr[$arrKey]['withdraw'],
                    'type' => 'withdraw_request',
                    'description' => 'Deducted for upgrade',
                ];
                pr($withdrawDebit);
                $this->Main_model->add('tbl_income_wallet',$withdrawDebit);
                $this->Main_model->updateField('tbl_bank_details','totalBalance','totalBalance +'.$incomeArr[$arrKey]['withdraw'],['user_id' => $user['user_id']]);
                $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['upgrade_status' => $arrKey]);
            endif;
        endforeach;
    }

    public function eligibleTask(){
        $this->Main_model->update('tbl_users',['task >' => 0],['task' => 0]);
    }

}
