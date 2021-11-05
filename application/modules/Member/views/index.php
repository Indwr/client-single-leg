	<?php
  require_once 'header.php';
  date_default_timezone_set('Asia/Kolkata');
  ?>
	<style>
	  .content-wrapper {
	    /*background-image: url('https://iplloot.com/App/uploads/ipl.jpg');*/
	    background-size: cover;
	    background-repeat: no-repeat;
	    background-position: center;
	  }

	  .card.gradient-ohhappiness.new {
	    height: 90px;
	    border-radius: 53px;
	    width: 364px;
	  }
	</style>

	<script>
	  function countdown(element, seconds) {
	    // Fetch the display element
	    var el = document.getElementById(element).innerHTML;

	    // Set the timer
	    var interval = setInterval(function() {
	      if (seconds <= 0) {
	        //(el.innerHTML = "level lapsed");
	        $('#' + element).text('Condition not cleared')

	        clearInterval(interval);
	        return;
	      }
	      var time = secondsToHms(seconds)
	      $('#' + element).text(time)

	      seconds--;
	    }, 1000);
	  }

	  function secondsToHms(d) {
	    d = Number(d);
	    var day = Math.floor(d / (3600 * 24));
	    var h = Math.floor(d % (3600 * 24) / 3600);
	    var m = Math.floor(d % 3600 / 60);
	    var s = Math.floor(d % 3600 % 60);

	    var dDisplay = day > 0 ? day + (day == 1 ? " day, " : " days, ") : "";
	    var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " hours, ") : "";
	    var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : " minutes, ") : "";
	    var sDisplay = s > 0 ? s + (s == 1 ? " second" : " seconds") : "";
	    var t = dDisplay + hDisplay + mDisplay + sDisplay;
	    return t;
	    // console.log(t)
	  }
	</script>
	<div class="clearfix"></div>
	<input type="hidden" value="<?= $_SESSION['user_id'] ?>" id="sessionData">
	<div class="content-wrapper">
	  <div class="container-fluid">
	    <div class="row">
	      <div class="col md-12">
	        <div class="col md-6">
	          <input type="text" class="form-control" value="<?php echo base_url('Register?id=' . $this->session->userdata['user_id']); ?>" id="myInput"><br>
	          <button onclick="myFunction()" class="btn btn-dark btn-sm">Copy Referral Link</button>
	          <a href="#" class="btn btn-primary btn-sm" download>Download Android App</a>

	          <!-- <a href="#" class="btn btn-info btn-sm">JOIN OUR TELEGRAM GROUP</a> -->

	        </div>
	      </div>
	    </div>

	    <div class="row mt-4">

	      <div class="col-12 col-lg-6 col-xl-3">
	        <div class="card gradient-ohhappiness new">
	          <div class="card-body">
	            <div class="media">
	              <div class="media-body text-left">
	                <h4 class="text-white"><?php echo strtoupper($user_info['user_id']); ?></h4>
	                <span class="text-white">USER ID</span>
	              </div>

	            </div>
	          </div>
	        </div>
	      </div>

	      <div class="col-12 col-lg-6 col-xl-3">
	        <div class="card gradient-ohhappiness new">
	          <div class="card-body">
	            <div class="media">
	              <div class="media-body text-left">
	                <h4 class="text-white"><?php echo strtoupper($user_info['name']); ?></h4>
	                <span class="text-white">USERNAME</span>
	              </div>

	            </div>
	          </div>
	        </div>
	      </div>

	      <div class="col-12 col-lg-6 col-xl-3">
	        <div class="card gradient-ohhappiness new">
	          <div class="card-body">
	            <div class="media">
	              <div class="media-body text-left">
	                <h4 class="text-white"><?php if ($user_info['paid_status'] > 0) {
                                            echo '<span class="">Active</span>  ';
                                          } else {
                                            echo '<label class="badge badge-danger">Inactive</label>';
                                          } ?><?php if ($user_info['paid_status'] > 0) {
                                                echo '  ' . currency_icon . $user_info['package_amount'];
                                              } ?></h4>
	                <span class="text-white">ID STATUS</span>
	              </div>

	            </div>
	          </div>
	        </div>
	      </div>

	      <div class="col-12 col-lg-6 col-xl-3">
	        <div class="card gradient-ohhappiness new">
	          <div class="card-body">
	            <div class="media">
	              <div class="media-body text-left">
	                <p><b>
	                    <font color="#fff">JOINING DATE:</font>
	                  </b>
	                  <font color="#fff"><?php echo $user_info['created_at']; ?></font>
	                </p>
	                <?php if ($user_info['paid_status'] > 0) { ?>
	                  <p><b>
	                      <font color="#fff">ACTIVATION DATE:</font>
	                    </b>
	                    <font color="#fff"><?php echo $user_info['topup_date']; ?></font>
	                  </p>
	                <?php } ?>
	              </div>

	            </div>
	          </div>
	        </div>
	      </div>


	      <div class="col-12 col-lg-6 col-xl-3">
	        <div class="card gradient-ohhappiness new">
	          <div class="card-body">
	            <div class="media">
	              <div class="media-body text-left">
	                <?php

                  $paidDirects = $this->User_model->get_single_record('tbl_users', 'sponser_id = "' . $this->session->userdata['user_id'] . '" AND paid_status > "0"', 'ifnull(count(id),0) as directs');
                  $totalDirects = $this->User_model->get_single_record('tbl_users', 'sponser_id = "' . $this->session->userdata['user_id'] . '" AND paid_status >= "0"', 'ifnull(count(id),0) as directs');
                  $unpaidDirects = $this->User_model->get_single_record('tbl_users', 'sponser_id = "' . $this->session->userdata['user_id'] . '" AND paid_status = "0"', 'ifnull(count(id),0) as directs');
                  ?>
	                <p><b>
	                    <font color="#fff">Total Direct:</font>
	                  </b>
	                  <font color="#fff"><?php echo $totalDirects['directs']; ?></font>
	                </p>
	                <?php if ($user_info['paid_status'] > 0) { ?>
	                  <p><b><label class="badge badge-success">Active: <?php echo $user_info['directs']; ?></label></b> <b><label class="badge badge-danger">Inactive: <?php echo $unpaidDirects['directs']; ?></label></b></p>
	                <?php } ?>
	              </div>

	            </div>
	          </div>
	        </div>
	      </div>



	      <div class="col-12 col-lg-6 col-xl-3">
	        <div class="card gradient-ohhappiness new">
	          <div class="card-body">
	            <div class="media">
	              <div class="media-body text-left">
	                <h4 class="text-white"><?php $totalDownline = $this->User_model->get_single_record('tbl_users', array(''), 'ifnull(count(id),0) as totalDownline');
                                          echo $totalDownline['totalDownline'];
                                          ?></h4>
	                <span class="text-white">PSB TOTAL DOWNLINE</span>
	              </div>

	            </div>
	          </div>
	        </div>
	      </div>

	      <div class="col-12 col-lg-6 col-xl-3">
	        <div class="card gradient-ohhappiness new">
	          <div class="card-body">
	            <div class="media">
	              <div class="media-body text-left">
	                <h4 class="text-white"><?php echo strtoupper($user_info['total_user_after_paid']); ?></h4>
	                <span class="text-white">SINGLE LEG DOWNLINE</span>
	              </div>

	            </div>
	          </div>
	        </div>
	      </div>






	      <div class="col-12 col-lg-6 col-xl-3">
	        <div class="card gradient-ohhappiness new">
	          <div class="card-body">
	            <div class="media">
	              <div class="media-body text-left">
	                <?php

                  $usedEpins = $this->User_model->get_single_record('tbl_epins', 'user_id = "' . $this->session->userdata['user_id'] . '" AND (status = "1" OR status = "2")', 'ifnull(count(id),0) as usedEpins');
                  $totalEpins = $this->User_model->get_single_record('tbl_epins', 'user_id = "' . $this->session->userdata['user_id'] . '" AND status >= "0"', 'ifnull(count(id),0) as totalEpins');
                  $transferEpins = $this->User_model->get_single_record('tbl_epins', 'user_id = "' . $this->session->userdata['user_id'] . '" AND status = "2"', 'ifnull(count(id),0) as transferEpins');
                  $avaliableEpins = $this->User_model->get_single_record('tbl_epins', 'user_id = "' . $this->session->userdata['user_id'] . '" AND status = "0"', 'ifnull(count(id),0) as avaliableEpins');
                  ?>
	                <p><b>
	                    <font color="#fff">Total E-Pins:</font>
	                  </b>
	                  <font color="#fff"><?php echo $totalEpins['totalEpins']; ?></font>
	                </p>

	                <p><b><label class="badge badge-success">Avaliable E-Pins: <?php echo $avaliableEpins['avaliableEpins']; ?></label>
	                    &nbsp;<label class="badge badge-danger">Used E-Pins: <?php echo $usedEpins['usedEpins']; ?></label>
	                    <!-- <label class="badge badge-danger">Transfer E-Pins: <?php //echo $transferEpins['transferEpins'];
                                                                              ?></label> -->
	                  </b></p>

	              </div>

	            </div>
	          </div>
	        </div>
	      </div>
	    </div>


	    <!-- <div class="card bg-skype">
                        <div class="card-body text-left p-3">
                            <span class="text-white">Income Details</span>
                        </div>
                    </div> -->
	    <!--Start Dashboard Content-->
	    <div class="row mt-4">

	      <div class="col-12 col-lg-6 col-xl-3">
	        <div class="card gradient-ohhappiness total">
	          <div class="card-body">
	            <div class="media">
	              <div class="media-body text-left">
	                <h4 class="text-white"><?php

                                          $totalIncome = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id'], 'amount >' => 0, 'type !=' => 'bank_transfer'), 'ifnull(sum(amount),0) as totalIncome');
                                          echo currency . number_format($totalIncome['totalIncome'], 2); ?></h4>
	                <span class="text-white"><b>Total Income</b></span>
	              </div>

	            </div>
	          </div>
	        </div>
	      </div>


	      <div class="col-12 col-lg-6 col-xl-3">
	        <div class="card gradient-ohhappiness">
	          <div class="card-body">
	            <div class="media">
	              <div class="media-body text-left">
	                <h4 class="text-white"><?php

                                          $totalIncome = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as totalIncome');
                                          echo currency . number_format($totalIncome['totalIncome'], 2); ?></h4>
	                <span class="text-white"><b>Avaliable Income</b></span>
	              </div>

	            </div>
	          </div>
	        </div>
	      </div>

	      <div class="col-12 col-lg-6 col-xl-3">
	        <div class="card gradient-ohhappiness">
	          <div class="card-body">
	            <div class="media">
	              <div class="media-body text-left">
	                <h4 class="text-white"><?php

                                          $totalIncome = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" AND date(created_at) = date(NOW()) AND amount > "0" AND type != "bank_transfer"', 'ifnull(sum(amount),0) as totalIncome');
                                          echo currency . number_format($totalIncome['totalIncome'], 2); ?></h4>
	                <span class="text-white"><b>Today Income</b></span>
	              </div>

	            </div>
	          </div>
	        </div>
	      </div>

	      <div class="col-12 col-lg-6 col-xl-3">
	        <div class="card gradient-ohhappiness">
	          <div class="card-body">
	            <div class="media">
	              <div class="media-body text-left">
	                <h4 class="text-white"><?php

                                          $totalIncome = $this->User_model->get_single_record('tbl_money_transfer', array('user_id' => $this->session->userdata['user_id'], 'status' => 'SUCCESS'), 'ifnull(sum(payable_amount),0) as totalIncome');
                                          echo currency . number_format($totalIncome['totalIncome'], 2); ?></h4>
	                <span class="text-white"><b>Total Withdraw</b></span>
	              </div>

	            </div>
	          </div>
	        </div>
	      </div>

	      <?php
        $incomes = $this->config->item('incomes');
        $colors = $this->config->item('colors');
        $i = 0;
        foreach ($incomes as $key => $value) {
          $totalAmount = $this->User_model->get_single_record('tbl_income_wallet', array('type' => $key, 'user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as totalAmount');
          echo '<div class="col-12 col-lg-6 col-xl-3">
          <div class="card gradient-' . $colors[$i] . '">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h4 class="text-white">' . currency . ' ' . number_format($totalAmount['totalAmount'], 2) . '</h4>
                <span class="text-white"><b>' . $value . '</b></span>
              </div>

            </div>
            </div>
          </div>
        </div>';
          $i++;
        }
        ?>

	    </div>
	    <!--End Row-->



	    <div class="row">
	      <div class="col-12 col-lg-6 col-xl-6">
	        <div class="card" style="height: 90%;">
	          <div class="card-header">
	            Royalty Achivers
	            <div class="card-action">


	            </div>
	          </div>
	          <div class="card-body">
	            <label class="badge badge-success">Royalty Achivers: </label> (Total: <?php
                                                                                    $royaltyAchivers = $this->User_model->get_single_record('tbl_users', array('royalty_status >' => 0), 'ifnull(count(id), 0) as ids');
                                                                                    echo $royaltyAchivers['ids'];
                                                                                    ?>)
	            <!-- <marquee> -->
	            <?php
              $royaltyAchivers = $this->User_model->get_records('tbl_users', array('royalty_status >' => 0), 'name');
              if (!empty($royaltyAchivers)) {
                foreach ($royaltyAchivers as $key => $royaltyAchiver) {
                  echo '<b>' . ($key + 1) . '.</b> ' . $royaltyAchiver['name'] . ', ';
                }
              }
              ?>
	            <!-- </marquee> -->
	            <!-- <br>
          <label class="badge badge-success">Leadership Achivers:</label> (Total: <?php
                                                                                  $leadership_status = $this->User_model->get_single_record('tbl_users', array('leadership_status >' => 0), 'ifnull(count(id), 0) as ids');
                                                                                  echo $leadership_status['ids'];
                                                                                  ?>) -->
	            <!-- <marquee> -->
	            <?php
              // $leadershipAchivers = $this->User_model->get_records('tbl_users', 'leadership_status > "0" ORDER by id DESC', 'name');
              //  if(!empty($leadershipAchivers)){
              //   foreach ($leadershipAchivers as $key => $leadershipAchiver) {
              //     echo '<b>'.($key+1).'.</b> '.$leadershipAchiver['name'].', ';
              //   }
              //  }
              ?>
	            <!-- </marquee> -->
	          </div>
	        </div>
	      </div>
	      <div class="col-12 col-lg-6 col-xl-6">
	        <div class="card" style="height: 90%;">
	          <div class="card-header">
	            Leadership Achivers
	            <div class="card-action">


	            </div>
	          </div>
	          <div class="card-body">
	            <label class="badge badge-success">Leadership Achivers:</label> (Total: <?php
                                                                                      $leadership_status = $this->User_model->get_single_record('tbl_users', array('leadership_status >' => 0), 'ifnull(count(id), 0) as ids');
                                                                                      echo $leadership_status['ids'];
                                                                                      ?>)
	            <!-- <marquee> -->
	            <?php
              $leadershipAchivers = $this->User_model->get_records('tbl_users', 'leadership_status > "0" ORDER by id DESC', 'name');
              if (!empty($leadershipAchivers)) {
                foreach ($leadershipAchivers as $key => $leadershipAchiver) {
                  echo '<b>' . ($key + 1) . '.</b> ' . $leadershipAchiver['name'] . ', ';
                }
              }
              ?>
	            <!-- </marquee> -->
	            <!-- <br>
          <label class="badge badge-success">Leadership Achivers:</label> (Total: <?php
                                                                                  $leadership_status = $this->User_model->get_single_record('tbl_users', array('leadership_status >' => 0), 'ifnull(count(id), 0) as ids');
                                                                                  echo $leadership_status['ids'];
                                                                                  ?>) -->
	            <!-- <marquee> -->
	            <?php
              // $leadershipAchivers = $this->User_model->get_records('tbl_users', 'leadership_status > "0" ORDER by id DESC', 'name');
              //  if(!empty($leadershipAchivers)){
              //   foreach ($leadershipAchivers as $key => $leadershipAchiver) {
              //     echo '<b>'.($key+1).'.</b> '.$leadershipAchiver['name'].', ';
              //   }
              //  }
              ?>
	            <!-- </marquee> -->
	          </div>
	        </div>
	      </div>
	    </div>
	    <!--End Row-->

	    <div class="row">
	      <div class="col-lg-12">
	        <div class="card">
	          <div class="card-header border-0">
	            Single Leg Plan
	            <div class="card-action">
	            </div>
	          </div>
	          <?php
            $singleLeg = $this->config->item('single_leg');
            ?>
	          <div class="table-responsive">
	            <table class="table align-items-center table-flush">
	              <thead>
	                <tr>
	                  <th>#</th>
	                  <th>Total Team</th>
	                  <th>Total Direct</th>
	                  <th>Amount</th>
	                  <th>Days</th>
	                  <th>Total Income</th>
	                  <th>Status</th>
	                  <th>Time Left</th>
	                </tr>
	              </thead>
	              <?php
                $roi = $this->User_model->get_records('tbl_roi', 'user_id = "' . $this->session->userdata['user_id'] . '"', '*');
                foreach ($singleLeg as $key => $value) {
                ?>
	                <tr>
	                  <td><?php echo ($key + 1) - 1; ?></td>
	                  <!-- <td><? php // echo (($key != 1) ? '+'.($value['team']) : ($value['team'])); 
                              ?></td> -->
	                  <td><?php echo $value['winning_team']; ?></td>
	                  <td><?php echo ($value['total_directs']); ?></td>
	                  <td><?php echo ($value['amount']); ?></td>
	                  <td><?php echo ($value['day']); ?></td>
	                  <td><?php echo ($value['amount'] * $value['day']); ?></td>
	                  <td><?php
                        if ($user_info['total_user_after_paid'] >= $value['winning_team']) {
                          echo '<label class="badge badge-success">Qualify</label>';
                        } else {
                          echo '<label class="badge badge-danger">Not Qualify</label>';
                        }
                        ?></td>
	                  <?php
                    echo '<td>';
                    if (is_array($roi)) {
                      foreach ($roi as $key2 => $r) {
                        // pr($r);
                        if ($r['level'] == $key) {
                          if ($user_info['directs'] < $value['total_directs']) {
                            $diff = strtotime('+72 hour', strtotime($r['created_at'])) - strtotime(date('Y-m-d H:i:s'));
                            echo '<p id="demo' . $key . '"></p>';
                            echo '<script> countdown("demo' . $key . '",' . $diff . ') </script>';
                          } else {
                            if ($r['days'] == 0) {
                              echo 'Level lapsed';
                            } else {
                              echo 'Condition cleared';
                            }
                          }
                        }
                      }
                    }
                    echo '</td>';
                    ?>

	                </tr>

	              <?php
                }
                ?>

	            </table>
	          </div>
	        </div>
	      </div>
	    </div>
	    <!--End Row-->





	    <!--End Dashboard Content-->

	  </div>
	  <!-- End container-fluid-->

	</div>
	<!--End content-wrapper-->
	<!--Start Back To Top Button-->
	<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
	<!--End Back To Top Button-->

	<div class="modal fade" id="bloodymodal" style="display: none;" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content gradient-scooter border-">
	      <div class="modal-header">
	        <h5 class="modal-title text-white"><?php echo title; ?></h5>
	        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	      </div>
	      <div class="modal-body text-white text-center">
	        <?php
          $popup = $this->User_model->get_single_record('tbl_popup', 'id > "0" ORDER by id DESC LIMIT 1', '*');
          if (!empty($popup)) {
            if ($popup['type'] == 'image') {
              echo '<img src="' . base_url('uploads/' . $popup['media']) . '" style="max-width: 100%; max-height:450px;">';
            } else {
              echo '<p>' . $popup['media'] . '</p>';
            }
          }
          ?><br><br>
	        <h4 class="text-warning text-center"><a class="text-warning" href="<?php echo base_url('uploads/Power Saving Bank App.apk'); ?>" download>Download Android App</a></h4>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<?php
  require_once 'footer.php';
  ?>
	<script type="text/javascript">
	  // $(window).on('load', function() {
	  //   $('#bloodymodal').modal('show');
	  // });
	  function getSessionData() {
	    return document.getElementById("sessionData").value;
	  }
	  getSessionData();
	  console.log(getSessionData())

	  function myFunction() {
	    var copyText = document.getElementById("myInput");
	    copyText.select();
	    copyText.setSelectionRange(0, 99999)
	    document.execCommand("copy");
	    alert("Share Linked Copied: " + copyText.value);
	  }
	</script>