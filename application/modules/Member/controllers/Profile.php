<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
        date_default_timezone_set("Asia/Calcutta");
    }


    public function index()
    {
        if (is_logged_in()) {
            $response['header'] = 'Edit Profile';
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
                $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
                $this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $country = trim(addslashes($data['country']));
                    $city = trim(addslashes($data['city']));
                    $state = trim(addslashes($data['state']));
                    $check = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id');
                    if(!empty($check)){
                        $set = ['country' => $country, 'city' => $city, 'state' => $state];
                        $res = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), $set);
                        if($res){
                            $this->session->set_flashdata('success', 'Profile Updated Successfully!');
                        }else{
                            $this->session->set_flashdata('error', 'Error while update profile!');
                        }
                    }else{
                        $this->session->set_flashdata('error', 'User not found!');
                    }
                }else{
                    $this->session->set_flashdata('error', validation_errors());
                }
            }
            $this->load->view('editProfile', $response);
        }else{
            redirect('Member/Management/login');
        }
    }


    public function changePassword()
    {
        if (is_logged_in()) {
            $response['header'] = 'Change Password';
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('current_password', 'Current Passord', 'trim|required|xss_clean');
                $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[4]|xss_clean');
                $this->form_validation->set_rules('verify_new_password', 'Verify New Password', 'trim|required|min_length[4]|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $current_password = trim(addslashes($data['current_password']));
                    $check = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id'], 'password' => $current_password), 'id,user_id');
                    if(!empty($check)){
                        if($data['new_password'] == $data['verify_new_password']){
                            $set = ['password' => $data['verify_new_password']];
                            $res = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), $set);
                            if($res){
                                $this->session->set_flashdata('success', 'Password Change Successfully!');
                            }else{
                                $this->session->set_flashdata('error', 'Error while change password!');
                            }
                        }else{
                            $this->session->set_flashdata('error', 'New Password & Verify Password Not Matched!');
                        }
                    }else{
                        $this->session->set_flashdata('error', 'Current Password Not Matched!');
                    }
                }else{
                    $this->session->set_flashdata('error', validation_errors());
                }
            }
            $this->load->view('changePassword', $response);
        }else{
            redirect('Member/Management/login');
        }
    }


    public function changeTxnPassword()
    {
        if (is_logged_in()) {
            $response['header'] = 'Change Txn Password';
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('current_password', 'Current Txn Passord', 'trim|required|xss_clean');
                $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[4]|xss_clean');
                $this->form_validation->set_rules('verify_new_password', 'Verify New Password', 'trim|required|min_length[4]|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $current_password = trim(addslashes($data['current_password']));
                    $check = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id'], 'master_key' => $current_password), 'id,user_id');
                    if(!empty($check)){
                        if($data['new_password'] == $data['verify_new_password']){
                            $set = ['master_key' => $data['verify_new_password']];
                            $res = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), $set);
                            if($res){
                                $this->session->set_flashdata('success', 'Txn Password Change Successfully!');
                            }else{
                                $this->session->set_flashdata('error', 'Error while change Txn Password!');
                            }
                        }else{
                            $this->session->set_flashdata('error', 'New Txn Password & Verify Txn Password Not Matched!');
                        }
                    }else{
                        $this->session->set_flashdata('error', 'Current Txn Password Not Matched!');
                    }
                }else{
                    $this->session->set_flashdata('error', validation_errors());
                }
            }
            $this->load->view('changeTxnPassword', $response);
        }else{
            redirect('Member/Management/login');
        }
    }

    public function forgotPassword(){
	$response['header'] = 'Forgot Password';
		if($this->input->is_ajax_request()){
			if ($this->input->server('REQUEST_METHOD') == 'POST') {
				$data = $this->security->xss_clean($this->input->post());
				$this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
				if ($this->form_validation->run() != FALSE) {
					$user = $this->User_model->get_single_record('tbl_users', array('user_id' => trim(addslashes($data['user_id'])), 'user_id !=' => 'admin'), 'phone,id,user_id,email,master_key,password,name');
						if (!empty($user)) {
							$message = "Dear " . $user['name'] . ' password for Your Account is ' . $user['password'] . ' and Txn. Password is '.$user['master_key'].' ' . base_url();
							$response['message'] = 'One Time Password Sent on Your Phone Please check';
							notify_user($user['user_id'], $message);
							//$this->session->set_flashdata('message', 'Password Sent On Your Registered Phone Number');
							$responseData['status'] = '1';
							$responseData['message'] = 'Password Sent On Your Registered Phone Number';
							$responseData['url'] = base_url('Member/Profile/forgotPassword');
						} else {
				//$this->session->set_flashdata('message', 'Invalid User ID');
						$responseData['status'] = '0';
						$responseData['message'] = 'Invalid User ID';
						}
				}else{
			//$this->session->set_flashdata('message', validation_errors());
				$responseData['status'] = '0';
				$responseData['message'] = validation_errors();
				}
			}
			echo json_encode($responseData);
		}else{
		  $this->load->view('forgotpassword', $response);
		}
	}


	public function Tree($user_id) {
        if (is_logged_in()) {
            $response['header'] = 'Tree';
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            $response['users'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $user_id), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            foreach ($response['users'] as $key => $directs) {
                $response['users'][$key]['sub_directs'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $directs['user_id']), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            }
            $this->load->view('tree', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function permotion2(){
        $users = $this->User_model->get_records('tbl_users2', 'phone > 0 AND phone != "9111111111" AND phone != "9111115911" AND phone != "9855022229" AND phone != "1234567890" AND phone != "123123123" AND phone != "9063992233" AND phone != "9518005200" AND phone != "9437194898" AND phone != "9681065337" AND phone != "8058457476" AND phone != "9437194898" AND phone != "8058430583" AND phone != "9051635350" AND phone != "9034660224" AND phone != "7024140044" AND phone != "8839891411" AND phone != "8319499274" AND phone != "9694218938" AND phone != "8187034882" AND phone != "9337989816" AND phone != "9518005200" AND phone != "8058745208" AND phone != "7891979760" AND phone != "9063992233" AND phone != "8187034882" AND phone != "8827975493" AND phone != "7690053202" AND phone != "7878794497" AND phone != "9914122229" AND phone != "9913234424" and id > 59 AND phone NOT LIKE "%2222%"', 'user_id,name,phone');
        foreach ($users as $key => $value) {
            extract($value);
            $phone = str_replace('+91', '', $phone);
            $noCount = strlen($phone);
            if($noCount == 10){
                $check = $this->User_model->get_single_record('permotion2', 'phone = "'.$phone.'"', 'count(id) as ids');
                $check2 = $this->User_model->get_single_record('tbl_users', 'phone = "'.$phone.'"', 'count(id) as ids');
                if($check['ids'] == 0){
                    if($check2['ids'] == 0){
                        if(preg_match('/^[6-9]{1}[0-9]{9}+$/', $phone)){
                            $array = ['user_id' => $user_id, 'name' => $name, 'phone' => $phone, 'url' => 'GOLDSTAR'];
                            $this->User_model->add('permotion2', $array);
                            pr($array);
                        }
                    }
                }
            }
        }
    }


    public function permotion(){
        $users = $this->User_model->get_records('tbl_users2', 'phone > 0 AND phone != "9111111111" AND phone != "9111115911" AND phone != "9855022229" AND phone != "1234567890" AND phone != "123123123" AND phone != "9063992233" AND phone != "9518005200" AND phone != "9437194898" AND phone != "9681065337" AND phone != "8058457476" AND phone != "9437194898" AND phone != "8058430583" AND phone != "9051635350" AND phone != "9034660224" AND phone != "7024140044" AND phone != "8839891411" AND phone != "8319499274" AND phone != "9694218938" AND phone != "8187034882" AND phone != "9337989816" AND phone != "9518005200" AND phone != "8058745208" AND phone != "7891979760" AND phone != "9063992233" AND phone != "8187034882" AND phone != "8827975493" AND phone != "7690053202" AND phone != "7878794497" AND phone != "9914122229" AND phone != "9913234424" and id > 0 AND phone NOT LIKE "%2222%"', 'user_id,name,phone');
        foreach ($users as $key => $value) {
            extract($value);
            $phone = str_replace('+91', '', $phone);
            $noCount = strlen($phone);
            if($noCount == 10){
                $check = $this->User_model->get_single_record('permotion', 'phone = "'.$phone.'"', 'count(id) as ids');
                $check2 = $this->User_model->get_single_record('tbl_users', 'phone = "'.$phone.'"', 'count(id) as ids');
                if($check['ids'] == 0){
                    if($check2['ids'] == 0){
                        if(preg_match('/^[6-9]{1}[0-9]{9}+$/', $phone)){
                            $array = ['user_id' => $user_id, 'name' => $name, 'phone' => $phone, 'url' => 'kaziranga'];
                            $this->User_model->add('permotion', $array);
                            pr($array);
                        }
                    }
                }
            }
        }
    }

    public function sendPermotionMsg(){
        $users = $this->User_model->get_records('permotion', 'status = "0" AND url = "kaziranga" LIMIT 100', 'id,phone,name');
        foreach ($users as $key => $value) {
            extract($value);
            // $message = "DEAR User, NEW SINGLE PLAN LAUNCH/DIRECT INCOME RS. 50/- IMPS WITHDRAWAL/JOINING RS. 600/- TO UNLIMITED EARNING M. 77174-45219 VISIT NOW: https://bit.ly/3xTYELF";

            $message = "DEAR User,New Earning Platform Single Leg Plan/JOINING 600 / Direct 50 Total Earning 240000 Hurry Up Join Fast M: 77174-45219 / Link: https://bit.ly/3xTYELF PSB";
             // / 6283835386
            $msg = urlencode($message);
             //echo $url = "http://login.smsmedia.org:8381/app/smsapi/index.php?key=35F95958509F3E&campaign=10427&routeid=100990&type=text&contacts=".$phone."&senderid=Growth&msg=".$msg."&template_id=1407161884913083446";

             echo $url = "http://login.smsmedia.org:8381/app/smsapi/index.php?key=35F95958509F3E&campaign=10427&routeid=100990&type=text&contacts=".$phone."&senderid=Growth&msg=".$msg."&template_id=1407162566012839843";

            // echo $url = "http://login.smsmedia.org:8381/app/smsapi/index.php?key=35F95958509F3E&campaign=10427&routeid=100990&type=text&contacts=7532035000&senderid=Growth&msg=".$msg."&template_id=1407161884913083446";
            echo '<br>';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            $data = curl_exec($ch);
            curl_close($ch);
            $sms_data = array('user_id' => 'PERMOTION', 'message' => $msg, 'response' => $data);
            $this->User_model->add('tbl_sms_counter', $sms_data);
            $run = $this->User_model->update('permotion', array('id' => $id), array('status' => 1));
        }
    }
    
}