<?php include_once'header.php'; ?>
<style>
  h3 a {
      color: white;
  }
  a h3 {
      color: white;
  }
  .income {
    background: #343a40;
    color: #fff;
    height: 47px;
    padding: 6px;
    padding-left: 23px;
}
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1 class="m-0 text-dark">Starter Page</h1>
                </div>
                <div class="col-sm-4">
                    <?php
                    // if($withdraw_status['withdraw_status'] == 0){
                    //     echo '<a href="'.base_url('Jarvis/Settings/withdrawonoff/1').'" class="btn btn-danger btn-sm">Click here for Closed Withdraw</a>';
                    // }else{
                    //     echo '<a href="'.base_url('Jarvis/Settings/withdrawonoff/0').'" class="btn btn-success btn-sm">Click here for On Withdraw</a>';
                    // }
                    
                    ?>

                    <?php 


                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'http://login.smsmedia.org:8381/app/miscapi/35F95958509F3E/getBalance/true/',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'GET',
                      
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);
                    $data =  json_decode($response, true);

                    echo '<h5> API SMS LEFT: '.($data[0]['BALANCE']).'</h5>';
                    ?>
                </div><!-- /.col -->
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <h3 class="income">Company Payout</h3>
            <div class="row">
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <a href="<?php echo base_url('Jarvis/Withdraw/incomeLedgar');?>"><h3>Total Payout</h3></a>
                            <p>Total : <?php echo number_format($total_payout,2);?></p>
                            <p>Total IMPS: <?php echo number_format($total_imps,2);?></p>
                            <p>Total Pending IMPS: <?php echo number_format($pending_total_imps,2);?></p>
                            <p>Pending Payout: <?php echo number_format($total_payout - $total_imps,2);?></p>
                            
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div>
                </div>
            </div>
            <h3 class="income d-none">Income Summary</h3>
            <div class="row d-none">
                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <!-- <div class="small-box bg-success">
                        <div class="inner">
                            <a href="<?php// echo base_url('Jarvis/Withdraw/income/single_leg_income');?>"><h3>Single leg Income</h3></a>
                            <p>Total : <?php// echo number_format($single_leg,2);?></p>

                            <?php
                           // $yesterdayIncome = $this->Main_model->get_single_record('tbl_income_wallet', 'type ="single_leg_income" AND date(created_at) = date(NOW())-1','ifnull(sum(amount),0) as yesterdayIncome');
                            ?>
                            <p>Yesterday Total : <?php //echo number_format($yesterdayIncome['yesterdayIncome'],2);?></p>

                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div> -->
                </div>


                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <!-- <div class="inner">
                            <a href="<?php //echo base_url('Jarvis/Withdraw/income/double_leg_income');?>"><h3>Double leg Income</h3></a>
                            <p>Total : <?php// $doubleLeg = $this->Main_model->get_single_record('tbl_income_wallet', 'type ="double_leg_income"','ifnull(sum(amount),0) as doubleLeg');
                           // echo number_format($doubleLeg['doubleLeg'], 2);?></p>

                            <?php
                            //$doubleLeg = $this->Main_model->get_single_record('tbl_income_wallet', 'type ="double_leg_income" AND date(created_at) = date(NOW())-1','ifnull(sum(amount),0) as doubleLeg');
                            ?>
                            <p>Yesterday Total : <?php //echo number_format($doubleLeg['doubleLeg'],2);?></p>

                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div> -->

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <!-- <div class="inner">
                            <a href="<?php //echo base_url('Jarvis/Withdraw/income/direct_income');?>"><h3>Direct Income</h3></a>
                            <p>Total : <?php //echo number_format($direct_income,2);?></p>

                            <?php
                            //$yesterdayIncome = $this->Main_model->get_single_record('tbl_income_wallet', 'type ="direct_income" AND date(created_at) = date(NOW())-1','ifnull(sum(amount),0) as yesterdayIncome');
                            ?>
                            <p>Yesterday Total : <?php //echo number_format($yesterdayIncome['yesterdayIncome'],2);?></p>

                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>
 -->
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                   <!--  <div class="small-box bg-success">
                        <div class="inner">
                            <a href="<?php// echo base_url('Jarvis/Withdraw/income/direct_income');?>"><h3>Level Income</h3></a>
                            <p>Total : <?php //echo number_format($level_income,2);?></p>

                            <?php
                           // $yesterdayIncome = $this->Main_model->get_single_record('tbl_income_wallet', 'type ="level_income" AND date(created_at) = date(NOW())-1','ifnull(sum(amount),0) as yesterdayIncome');
                            ?>
                            <p>Yesterday Total : <?php //echo number_format($yesterdayIncome['yesterdayIncome'],2);?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div> -->
                </div>
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                   <!--  <div class="small-box bg-success">
                        <div class="inner">
                            <a href="<?php //echo base_url('Jarvis/Withdraw/income/royalty_income');?>"><h3>Royalty Income</h3></a>
                            <p>Total : <?php ///echo number_format($royalty_income,2);?></p>

                            <?php
                            //$yesterdayIncome = $this->Main_model->get_single_record('tbl_income_wallet', 'type ="royalty_income" AND date(created_at) = date(NOW())-1','ifnull(sum(amount),0) as yesterdayIncome');
                            ?>
                            <p>Yesterday Total : <?php //echo number_format($yesterdayIncome['yesterdayIncome'],2);?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div> -->
                </div>
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                   <!--  <div class="small-box bg-success">
                        <div class="inner">
                            <a href="<?php //echo base_url('Jarvis/Withdraw/income/leadership_income');?>"><h3>Leadership Income</h3></a>
                            <p>Total : <?php //echo number_format($leadership_income,2);?></p>

                            <?php
                            //$yesterdayIncome = $this->Main_model->get_single_record('tbl_income_wallet', 'type ="leadership_income" AND date(created_at) = date(NOW())-1','ifnull(sum(amount),0) as yesterdayIncome');
                            ?>
                            <p>Yesterday Total : <?php //echo number_format($yesterdayIncome['yesterdayIncome'],2);?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div> -->
                </div>

                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <!-- <div class="small-box bg-success">
                        <div class="inner">
                            <a href="<?php //echo base_url('Jarvis/Withdraw/income/non_working_income');?>"><h3>Non-Working Income</h3></a>
                            <p>Total : <?php //echo number_format($non_working_income,2);?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div> -->
                </div>
            </div>
            <h3 class="income">Company Details</h3>
<div class="row">
                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><a href="<?php echo base_url('Jarvis/Management/users/');?>">Total Users</a></h3>
                            <p>Total : <?php echo $total_users;?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><a href="<?php echo base_url('Jarvis/Management/totalUsers/');?>">Total Main Users</a></h3>
                            <p>Total : <?php echo $total_main_users;?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><a href="<?php echo base_url('Jarvis/Management/today_main_paid_users'); ?>">Total Main Paid Users</a></h3>
                            <p>Total : <?php 
                            $totalPaidMain = $this->Main_model->get_single_record('tbl_users', array('paid_status >' => 0, 'fake_id' => 0), 'ifnull(count(id),0) as totalPaidMain');

                            echo $totalPaidMain['totalPaidMain'];?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><a href="<?php echo base_url('Jarvis/Management/today_main_paid_users'); ?>">Today Main Paid Users</a></h3>
                            <p>Total : <?php 
                            $todayMainPaid = $this->Main_model->get_single_record('tbl_users', 'date(topup_date) = date(NOW()) AND paid_status > "0" AND fake_id = "0"', 'ifnull(count(id),0) as todayMainPaid');

                            echo $todayMainPaid['todayMainPaid'];?></p>

                            <p>Yesterday Total : <?php 
                            $todayMainPaid = $this->Main_model->get_single_record('tbl_users', 'date(topup_date) = date(NOW())-1 AND paid_status > "0" AND fake_id = "0"', 'ifnull(count(id),0) as todayMainPaid');

                            echo $todayMainPaid['todayMainPaid'];?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><a href="#">Today All Paid Users</a></h3>
                            <p>Total : <?php 
                            $todayMainPaid = $this->Main_model->get_single_record('tbl_users', 'date(topup_date) = date(NOW()) AND paid_status > "0"', 'ifnull(count(id),0) as todayMainPaid');

                            echo $todayMainPaid['todayMainPaid'];?></p>

                            <p>Yesterday Total : <?php 
                            $todayMainPaid = $this->Main_model->get_single_record('tbl_users', 'date(topup_date) = date(NOW())-1 AND paid_status > "0"', 'ifnull(count(id),0) as todayMainPaid');

                            echo $todayMainPaid['todayMainPaid'];?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><a href="#">Total Fake Users</a></h3>
                            <p>Total : <?php echo $fake_users;?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->

            
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <a href="<?php echo base_url('Jarvis/Management/paidUsers/');?>"><h3>Paid Users</h3></a>
                            <p class="mb-0">Total : <?php echo $paid_users;?></p>
                          </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><a href="<?php echo base_url('Jarvis/Management/today_joinings/');?>">Today Joined Users</a></h3>
                            <p class="mb-0">Total Main : <?php 
                            $todayMainPaid = $this->Main_model->get_single_record('tbl_users', 'date(created_at) = date(NOW()) AND fake_id = "0"', 'ifnull(count(id),0) as todayMainPaid');
                            echo $todayMainPaid['todayMainPaid'];?></p>
                            <p class="mb-0">Total Fake : <?php 
                            $todayMainPaid = $this->Main_model->get_single_record('tbl_users', 'date(created_at) = date(NOW()) AND fake_id = "1"', 'ifnull(count(id),0) as todayMainPaid');
                            echo $todayMainPaid['todayMainPaid'];?></p>
                             <p class="mb-0">Total Joining: <?php echo $today_joined_users;?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>

               <!--  <div class="col-lg-4 col-12">
                   
                    <div class="small-box bg-info">
                        <div class="inner">
                            <a href="<?php //echo base_url('Jarvis/Management/today_joinings/');?>"><h3>Today All Joined Users</h3></a>
                            <p class="mb-0">Total : <?php //echo $today_joined_users;?></p>
                          </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>

                    </div>
                </div>
 -->
                

                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <a href="#"><h3>Blocked Users</h3></a>
                            <p class="mb-0">Total : <?php echo $total_blocked_users;?></p>
                          </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>

                    </div>
                </div>


            </div>
            <h3 class="income">Other Details</h3>
<div class="row">

                <!-- ./col -->
                <div class="col-lg-4 col-12 d-none">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Payout</h3>
                            <p class="mb-0">Direct Payout.: <?php echo abs(number_format($direct_income_withdraw_request,2));?></p>
                            <p class="mb-0">Total Payout : <?php echo number_format($total_income_generated,2);?></p>
                            <p class="mb-0">Converted to Ewallet : <?php echo number_format($income_transfer_wallet,2);?></p>
                            <p class="mb-0">Payout Withdraw Request : <?php echo number_format($total_withdraw,2);?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-12" style="display:none;">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>E-Wallet</h3>
                            <p class="mb-0">Wallet Bal.: <?php //echo $total_sent_fund;?></p>
                            <p class="mb-0">Income Generated Fund : <?php //echo $income_generated_fund;?></p>
                            <p class="mb-0">Available fund in user Balance: <?php //echo $user_available_balance;?></p>
                            <p class="mb-0">Used : <?php //echo $used_fund;?></p>
                            <p>Requested : <?php //echo $requested_fund;?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>E-Pins</h3>
                            <p class="mb-0">Total Pins: <?php echo $total_epins;?></p>
                            <p class="mb-0">Available Pins: <?php echo $available_epins;?></p>
                            <p class="mb-0">Used Pins: <?php echo $used_epins;?></p>
                            <p class="mb-0" style="color:white"> <a href="<?php echo base_url('Jarvis/Withdraw/income/pin_generation')?>">Pin Generation: <?php echo abs($pin_generation / 770);?></a></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-12 d-none">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>E-Mail</h3>
                            <p class="mb-0">Total : 0</p>
                            <p class="mb-0">Read : 0</p>
                            <p>Unread : 0</p>
                        
                        </div>
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<?php include_once'footer.php'; ?>
