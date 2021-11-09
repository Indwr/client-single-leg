<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct(); 
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
        date_default_timezone_set('Asia/Kolkata');
    }

    public function index()
    {
        echo json_encode('working');
        exit;
    }

    public function getPosts()
    {
        $params = $this->security->xss_clean($this->input->get());
        $checkUserId = $this->Main_model->get_single_record('tbl_users', array('user_id' => $params['user_id']), 'id');
        if ($checkUserId == null or empty($checkUserId)) {
            $response = ['status' => 500, 'message' => 'User Id not exist please check and try again later..'];
            echo json_encode($response);
            exit();
        }
        $data = $this->Main_model->get_records('posts', ['isActive' => 1], '*');

        foreach ($data as $key => $value) {

            $getCheckLike = $this->db->query("CALL checkLike('" . $value['id'] . "','" . $value['user_id'] . "')");
            $res = $getCheckLike->result();
            //add this two line 
            $getCheckLike->next_result();
            $getCheckLike->free_result();
            $sData['id'] = $value['id'];
            $sData['profile_url'] =  $value['profile_url'];
            $sData['name'] = $value['name'];
            $sData['user_id'] = $value['user_id'];
            $sData['image'] = $value['image'];
            $sData['text'] = $value['text'];
            $sData['likes'] = $value['likes'];
            $sData['comments'] = $value['comments'];
            $sData['isActive'] = $value['isActive'];
            $sData['isLike'] = (count($res) > 0) ? $res[0]->isLike : 0;
            $sData['created_at'] = $value['created_at'];
            $sData['updated_at'] = $value['updated_at'];
            $dataa[] = $sData;
        }
        if ($dataa == null or empty($dataa)) {
            $response = ['status' => 200, 'message' => 'Posts not Found', 'data' => []];
            echo json_encode($response);
            exit();
        }
        $response = ['status' => 200, 'message' => 'Posts Found', 'data' => $dataa];
        echo json_encode($response);
        exit();
    }

    public function getComments()
    {
        $params = $this->security->xss_clean($this->input->get());
        $checkUserId = $this->Main_model->get_single_record('tbl_users', array('user_id' => $params['user_id']), 'id');
        if ($checkUserId == null or empty($checkUserId)) {
            $response = ['status' => 500, 'message' => 'User Id not exist please check and try again later..'];
            echo json_encode($response);
            exit();
        }
        $data = $this->Main_model->get_records('comments', ['isActive' => 1, 'post_id' => $params['post_id']], '*');
        if ($data == null or empty($data)) {
            $response = ['status' => 200, 'message' => 'Comment not Found', 'data' => []];
            echo json_encode($response);
            exit();
        }
        $response = ['status' => 200, 'message' => 'Posts Found', 'data' => $data];
        echo json_encode($response);
        exit();
    }

    public function createLike()
    {
        $params = $this->security->xss_clean($this->input->post());
        $this->form_validation->set_rules('islike', 'Like', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('post_id', 'Post Id', 'trim|required|xss_clean');
        if ($this->form_validation->run() != FALSE) {
            $checkUserId = $this->Main_model->get_single_record('tbl_users', array('user_id' => $params['user_id']), 'id');
            if ($checkUserId == null or empty($checkUserId)) {
                $response = ['status' => 500, 'message' => 'User Id not exist please check and try again later..'];
                echo json_encode($response);
                exit();
            }
            if ($params['islike'] == 1) {
                $isLike = true;
            } else {
                $isLike = false;
            }
            $this->Main_model->update_countForLike($params['user_id'], $params['post_id'], $isLike);
            if ($isLike === true) {
                $message = 'Liked';
                $likeData = 1;
            } else {
                $message = 'Disliked';
                $likeData = 0;
            }
            $getCheckLike = $this->db->query("CALL checkLike('" . $params['post_id'] . "','" . $params['user_id'] . "')");
            $res = $getCheckLike->result();
            //add this two line 
            $getCheckLike->next_result();
            $getCheckLike->free_result();
            //end of new code
            if (count($res) == 0) {
                $dataForLike = ['user_id' => $params['user_id'], 'post_id' => $params['post_id'], 'isLike' => $likeData];
                $this->Main_model->add('posts_like', $dataForLike);
            } else {
                $likeResult =  $res;
                $dataa = ['isLike' => $likeData];
                $this->Main_model->update('posts_like', ['user_id' => $params['user_id'], 'post_id' => $params['post_id']], $dataa);
            }
            $response = ['status' => 200, 'message' => 'Post has been ' . $message];
            echo json_encode($response);
            exit;
        }
    }

    public function createComment()
    {
        $params = $this->security->xss_clean($this->input->post());
        $this->form_validation->set_rules('comment', 'Comment', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('post_id', 'Post Id', 'trim|required|xss_clean');
        if ($this->form_validation->run() != FALSE) {
            $checkUserId = $this->Main_model->get_single_record('tbl_users', array('user_id' => $params['user_id']), 'id');
            if ($checkUserId == null or empty($checkUserId)) {
                $response = ['status' => 500, 'message' => 'User Id not exist please check and try again later..'];
                echo json_encode($response);
                exit();
            }
            $promoArr = array(
                'comment' => $params['comment'],
                'post_id' => $params['post_id'],
            );
            $res = $this->Main_model->add('comments', $promoArr);
            $this->Main_model->update_countForComment($params['user_id'], $params['post_id']);
            if ($res) {
                $response = ['status' => 200, 'message' => 'Comment has been added'];
                echo json_encode($response);
                exit;
            } else {
                $response = ['status' => 500, 'message' => 'Error While adding Comment please try again..'];
                echo json_encode($response);
                exit;
            }
        }
    }

    public function createPost()
    {
        $params = $this->security->xss_clean($this->input->post());
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['file_name'] = 'as' . time();
        $this->load->library('upload', $config);
        $this->form_validation->set_rules('text', 'Text', 'trim|xss_clean');
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|required|xss_clean');
        if ($this->form_validation->run() != FALSE) {
            // if (!$this->upload->do_upload('image')) {
            // $response = ['status' => 500, 'message' => $this->upload->display_errors()];
            // echo json_encode($response);
            // exit();
            // } else {
            $this->upload->do_upload('image');
            $checkUserId = $this->Main_model->get_single_record('tbl_users', array('user_id' => $params['user_id']), 'id,name,image');
            if ($checkUserId == null or empty($checkUserId)) {
                $response = ['status' => 500, 'message' => 'User Id not exist please check and try again later..'];
                echo json_encode($response);
                exit();
            }

            $data = array('upload_data' => $this->upload->data());
            $promoArr = array(
                'text' => $params['text'],
                'user_id' => $params['user_id'],
                'image' => (isset($_FILES['image']['size']) == 0) ? '' : 'uploads/' . $data['upload_data']['file_name'],
                'name' => $checkUserId['name'],
                'profile_url' => ($checkUserId['image'] == null) ? '' : $checkUserId['image'],
            );
            $res = $this->Main_model->add('posts', $promoArr);
            if ($res) {
                $response = ['status' => 200, 'message' => 'Post has been created'];
                echo json_encode($response);
                exit;
            } else {
                $response = ['status' => 500, 'message' => 'Error While creating Post please try again..'];
                echo json_encode($response);
                exit;
            }
            // }
        }
    }
    public function getIncomes()
    {
        $params = $this->security->xss_clean($this->input->get());
        $totalIncome = $this->Main_model->get_single_record('tbl_income_wallet', array('user_id' => $params['user_id'], 'amount >' => 0, 'type !=' => 'bank_transfer'), 'ifnull(sum(amount),0) as totalIncome');
        $userData = $this->Main_model->get_single_record('tbl_users', array('user_id' => $params['user_id']), 'id,name,image,sponser_id,package_amount,email');
        $sponsorName = $this->Main_model->get_single_record('tbl_users', array('user_id' => $userData['sponser_id']), 'name');
        $response['result'] = [

            'userData' => [
                'name' => $userData['name'],
                'memberRank' => 'Silver',
                'memberPackage' => '$' . $userData['package_amount'],
                'sponsorName' => $sponsorName['name'] ?? '',
                'email'     => $userData['email'] ?? '',
                'profile_url' => $userData['image'] ?? '',
            ],
            'incomes' => [
                [
                    'title' => 'Total Income',
                    'amount' => currency . number_format($totalIncome['totalIncome'], 2)
                ],
                [
                    'title' => 'Avaliable Income',
                    'amount' => currency . number_format($totalIncome['totalIncome'], 2)
                ],
                [
                    'title' => 'Today Income',
                    'amount' => currency . number_format($totalIncome['totalIncome'], 2)
                ],
                [
                    'title' => 'Total Withdraw',
                    'amount' => currency . number_format($totalIncome['totalIncome'], 2)
                ],
                [
                    'title' => 'Direct Income',
                    'amount' => currency . number_format($totalIncome['totalIncome'], 2)
                ],
                [
                    'title' => 'Level Income',
                    'amount' => currency . number_format($totalIncome['totalIncome'], 2)
                ],
                [
                    'title' => 'Single Leg Income',
                    'amount' => currency . number_format($totalIncome['totalIncome'], 2)
                ],
                [
                    'title' => 'Leadership Income',
                    'amount' => currency . number_format($totalIncome['totalIncome'], 2)
                ],
                [
                    'title' => 'Royalty Income',
                    'amount' => currency . number_format($totalIncome['totalIncome'], 2)
                ]

            ]

        ];
        echo json_encode($response);
        exit;
    }

    public function getRoutes()
    {
        $data['routes'] = [
            ['title' => 'Dashboard', 'isDropDown' => false, 'urls' => [['title' => 'Dashboard', 'url' => 'Member/Management/index']]],
            ['title' => 'Downline', 'isDropDown' => true, 'urls' => [['title' => 'All Directs', 'url' => 'Member/Downline/Index'], ['title' => 'Active Directs', 'url' => 'Member/Downline/Index/1'], ['title' => 'InActive Directs', 'url' => 'Member/Downline/Index/2']]],
            ['title' => 'Register', 'isDropDown' => false, 'urls' => [['title' => 'Register', 'url' => 'Register?id=admin']]],
            ['title' => 'Settings', 'isDropDown' => true, 'urls' => [['title' => 'Edit Profile', 'url' => 'Member/Profile/index'], ['title' => 'Change Password', 'url' => 'Member/Profile/changePassword'], ['title' => 'Change Txn password', 'url' => 'Member/Profile/changeTxnPassword']]],
            [
                'title' => 'Epin Management', 'isDropDown' => true, 'urls' => [
                    ['title' => 'Available E-Pins', 'url' => 'Member/Epin/AvailebleEpin'],
                    ['title' => 'Used E-Pins', 'url' => 'Member/Epin/epinHistory/1'],
                    ['title' => 'Transfer E-Pin Details', 'url' => 'Member/Epin/epinHistory/2'],
                    ['title' => 'Transfer E-Pins', 'url' => 'Member/Epin/Transfer_Epin']
                ]
            ],
            [
                'title' => 'Money Transfer', 'isDropDown' => true, 'urls' => [
                    ['title' => 'Add Beneficiary', 'url' => 'Member/IMPS/index'],
                    ['title' => 'Money Transfer', 'url' => 'Member/IMPS/beneficiaryDetails'],
                ]
            ],
            [
                'title' => 'Income Reports', 'isDropDown' => true, 'urls' => [
                    ['title' => 'Direct Income', 'url' => 'Member/Incomes/index/direct_income'],
                    ['title' => 'Level Income', 'url' => 'Member/Incomes/index/level_income'],
                    ['title' => 'Single Leg Income', 'url' => 'Member/Incomes/index/single_leg_income'],
                    ['title' => 'Leadership Income', 'url' => 'Member/Incomes/index/leadership_income'],
                    ['title' => 'Royalty Income', 'url' => 'Member/Incomes/index/royalty_income'],
                    ['title' => 'All Income Reports', 'url' => 'Member/Incomes/index'],
                ]
            ],
            [
                'title' => 'Logout', 'isDropDown' => false, 'urls' => [
                    ['title' => 'Logout', 'url' => 'Member/Management/logout']
                ]
            ],
        ];
        echo json_encode($data);
        exit;
    }

    public function getTimmer()
    {
        $params = $this->security->xss_clean($this->input->get());
        $checkUserId = $this->Main_model->get_single_record('tbl_users', array('user_id' => $params['user_id']), 'id,name,image,timmer');
        if ($checkUserId == null or empty($checkUserId)) {
            $response = ['status' => 500, 'message' => 'User Id not exist please check and try again later..'];
            echo json_encode($response);
            exit();
        }
        $timmer = $this->Main_model->get_single_record('settings', [], 'timmer');
        $extentedTime = date('Y-m-d H:i:s',strtotime($checkUserId['timmer'].' + '.$timmer['timmer'].' minutes'));
        $response['data'] = [
            'current_time' => date('Y-m-d H:i:s'),
            'user_time' => $checkUserId['timmer'],
            'extented_time' => $extentedTime,
        ];
        echo json_encode($response);
        // echo "<pre>";
        // print_r($timmer['timmer']);
        die();
    }

    public function cleanNow()
    {
        $params = $this->security->xss_clean($this->input->post());
        $checkUserId = $this->Main_model->get_single_record('tbl_users', array('user_id' => $params['user_id']), 'id,name,image,task');
        if ($checkUserId == null or empty($checkUserId)) {
            $response = ['status' => 500, 'message' => 'User Id not exist please check and try again later..'];
            echo json_encode($response);
            exit();
        }
        $this->Main_model->update('tbl_users', array('user_id' => $params['user_id']), ['timmer' => date('Y-m-d H:i:s'),'task' => ($checkUserId['task']+1)]);
        //Check how many times income has been received by any user
        if($checkUserId['task'] <= 5){
        // send self income 
            $selfCredit = [
                'user_id' => $params['user_id'],
                'amount' => 0.2,
                'type' => 'self_income',
                'description' => 'Self Income from task',
            ];
            $this->Main_model->add('tbl_income_wallet',$selfCredit);

            // Send Level Income if Sponsor and level users are eligible

            $this->levelIncome($params['user_id'],$params['user_id']);
        }
    }

    private function levelIncome($user_id,$linkedID){
        $amount = 0.2;
        $levelopen = 0;
        for($i=0;$i<20;$i++){
            if($i%3 == 0){ $levelopen += 1;}
            $incomeArr[$i] = ['amount' => $amount,'levelopen' => $levelopen];
            if($i <= 14){
                $amount = $amount - 0.01;
            }
        }
        foreach($incomeArr as $key => $income){
            $sponsor = $this->Main_model->get_single_record('tbl_users',['user_id' => $user_id],'sponser_id');
            if(!empty($sponsor['sponser_id'])){
                $userinfo = $this->Main_model->get_single_record('tbl_users',['user_id' => $sponsor['sponser_id']],'paid_status,upgrade_status');
                if($userinfo['paid_status'] == 1){
                    if($userinfo['upgrade_status'] >= $income['levelopen']){
                        $creditIncome = [
                            'user_id' => $sponsor['sponser_id'],
                            'amount' => $income['amount'],
                            'type' => 'level_income',
                            'description' => 'Level income from User '.$linkedID.' at level '.$key,
                        ];
                        $this->Main_model->add('tbl_income_wallet',$creditIncome);
                    }
                }
                $user_id = $sponsor['sponser_id'];
            }
        }
    }
    
}
