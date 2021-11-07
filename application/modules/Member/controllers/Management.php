<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Management extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
        date_default_timezone_set("Asia/Calcutta");
    }

    public function index()
    {
        if (is_logged_in()) {
            $response['header'] = 'Dashboard';
            $this->load->view('index', $response);
        } else {
            redirect('Member/Management/login');
        }
    }

    public function login()
    {
        $response['header'] = 'Member Login';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('username', 'User ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('passid', 'Password', 'trim|required|xss_clean');
            if ($this->form_validation->run() != FALSE) {
                $user_id = trim(addslashes($data['username']));
                $password = trim(addslashes($data['passid']));
                $check = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id, 'password' => $password), 'id,user_id,password,disabled');
                // print_r($check);
                // die();
                if (!empty($check)) {
                    if ($check['disabled'] == 0) {
                        if ($check['user_id'] == $user_id && $check['password'] == $password) {
                            $this->session->set_userdata('user_id', $user_id);
                            $this->session->set_userdata('role', 'M');
                            redirect('Member/Management/index');
                        } else {
                            $response['message'] = 'Invalid Login Credentials';
                        }
                    } else {
                        $response['message'] = 'Account Blocked!';
                    }
                } else {
                    $response['message'] = 'Invalid Login Credentials';
                }
            }
        }
        $this->load->view('login', $response);
    }

    public function logout()
    {
        $this->session->unset_userdata(array('user_id', 'role'));
        redirect('Member/Management/login');
    }

    public function checkUser($user_id = '')
    {
        if ($this->input->is_ajax_request()) {
            $user_id = trim(addslashes($user_id));
            if (preg_match("/[A-Za-z0-9]+/", $user_id) == TRUE && !empty($user_id)) {
                $check = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'name');
                if (!empty($check)) {
                    $response['name'] = $check['name'];
                    $response['status'] = 1;
                } else {
                    $response['name'] = 'Invaild User ID';
                    $response['status'] = 0;
                }
            } else {
                $response['name'] = 'Invaild User ID';
                $response['status'] = 0;
            }
        } else {
            $response['name'] = 'Invaild Request';
            $response['status'] = 0;
        }
        echo json_encode($response);
    }

    public function Register()
    {
        $response['header'] = 'Member Register';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('sponser_id', 'Sponser Id', 'required|trim|xss_clean');
            $this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean');
            $this->form_validation->set_rules('phone', 'Phone', 'required|min_length[10]|max_length[10]');
            if ($this->form_validation->run() != FALSE) {
                if (preg_match('/^[6-9]{1}[0-9]{9}+$/', $data['phone'])) {
                    $sponserCheck = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['sponser_id']), 'id,name');
                    if (!empty($sponserCheck)) {
                        $user_id = $this->randUser_id();
                        $password = rand(100000, 999999);
                        $txn_password = rand(1000, 9999);

                        $insert = $this->User_model->add('tbl_users', array(
                            'sponser_id' => trim(addslashes($data['sponser_id'])),
                            'name' => trim(addslashes($data['name'])),
                            'email' => trim(addslashes($data['email'])),
                            'phone' => trim(addslashes($data['phone'])),
                            'user_id' => $user_id,
                            'password' => $password,
                            'master_key' => $txn_password
                        ));

                        $insert2 = $this->User_model->add('tbl_bank_details', array(
                            'user_id' => trim(addslashes($user_id))
                        ));

                        if ($insert2) {
                            $this->add_counts($user_id, $user_id, $level = 1);
                            $sms_text = 'Dear ' . $data['name'] . ', Your Account Successfully created. User ID: ' . $user_id . ' Password: ' . $password . ' Txn Password: ' . $txn_password . ' For more detail visit ' . str_replace('/App', '', base_url());
                            //notify_user($user_id, $sms_text, $temp_id = '1407161548817194673');

                            $response['message'] = '<h5 class="text-success text-center">Dear ' . $data['name'] . ', Your Account Successfully created. </h5><br>User ID : ' . $user_id . '<br> Password: ' . $password . ' <br>Txn Password: ' . $txn_password . '<br>Phone No : ' . trim(addslashes($data['phone'])) . '<br>Sponser ID : ' . trim(addslashes($data['sponser_id'])) . '<br>';
                            $this->load->view('success', $response);
                        } else {
                            $this->session->set_flashdata('error', 'Error while registeration, please try again later!');
                            redirect('Member/Management/Register/');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Invaild Sponser ID');
                        redirect('Member/Management/Register/');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Please Enter Your Vaild Registered Phone No.');
                    redirect('Member/Management/Register/');
                }
            } else {
                $this->session->set_flashdata('error', validation_errors());
                redirect('Member/Management/Register/');
            }
        } else {
            $this->load->view('register', $response);
        }
    }


    private function add_counts($user_name = '', $downline_id = '', $level)
    {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'sponser_id,user_id');
        if ($user['sponser_id'] != '') {
            $downlineArray = array(
                'user_id' => $user['sponser_id'],
                'downline_id' => $downline_id,
                'position' => '',
                'level' => $level,
            );
            $this->User_model->add('tbl_downline_count', $downlineArray);
            $user_name = $user['sponser_id'];
            $this->add_counts($user_name, $downline_id, $level + 1);
        }
    }

    // public function password() {

    // $chars = array(
    //     'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
    //     'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
    //     'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
    //     'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
    //     '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' 

    // );

    // shuffle($chars);

    //     $num_chars = count($chars) - 56;
    //     $token = '';

    //     for ($i = 0; $i < $num_chars; $i++){ // <-- $num_chars instead of $len
    //         $token .= $chars[mt_rand(0, $num_chars)];
    //     }

    //     return $token;
    // }

    private function randUser_id()
    {

        $user_id = ''.rand(100000, 999999);
        $data = $this->User_model->get_records('tbl_users', array('user_id' => $user_id), '*');
        if (!empty($data)) {
            return $this->randUser_id();
        } else {
            return $user_id;
        }
    }

    public function fakeRegister()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('user_id', 'Sponser ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('pin_count', 'Pin Count', 'trim|numeric|required|xss_clean');
            if ($this->form_validation->run() != FALSE) {
                $check = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), 'id,user_id');
                if (!empty($check)) {
                    if ($data['pin_count'] <= 50) {
                        for ($i = 1; $i <= $data['pin_count']; $i++) {
                            $user_id = $this->randUser_id();
                            $password = rand(100000, 999999);
                            $txn_password = rand(1000, 9999);

                            $insert = $this->User_model->add('tbl_users', array(
                                'sponser_id' => trim(addslashes($data['user_id'])),
                                'name' => trim(addslashes($data['name'])) . ' ' . $i,
                                'email' => $data['name'] . '' . $i . '@gmail.com',
                                'phone' => '9111111111',
                                'user_id' => $user_id,
                                'password' => $password,
                                'master_key' => $txn_password,
                                'fake_id' => 1,
                            ));

                            $insert2 = $this->User_model->add('tbl_bank_details', array(
                                'user_id' => trim(addslashes($user_id))
                            ));

                            if ($insert2) {
                                $this->add_counts($user_id, $user_id, $level = 1);
                            }

                            $this->activateAccount($user_id);
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Register IDs Limit is 50 IDS');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Invaild Sponser ID');
                }
            }
            redirect('Member/Management/fakeRegister');
        }

        $this->load->view('Jarvis/fake_id_form');
    }


    private function activateAccount($user_id)
    {
        $topupData = array(
            'paid_status' => 1,
            'package_id' => 1,
            'package_amount' => 600,
            'topup_date' => date('Y-m-d H:i:s'),
        );
        $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'id,user_id,sponser_id');
        $this->User_model->update_directs($user['sponser_id']);
        $this->User_model->total_team_update($user['id']);
        // $this->User_model->upgrade_total_team_update($user['id']);
        $this->add_team_counts($user['user_id'], $user['user_id']);
    }


    private function add_team_counts($user_name = '', $downline_id = '')
    {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'sponser_id,user_id');
        if ($user['sponser_id'] != '') {
            $this->User_model->update_team_count('paid_team_count', $user['sponser_id']);
            $user_name = $user['sponser_id'];
            $this->add_team_counts($user_name, $downline_id);
        }
    }
}
