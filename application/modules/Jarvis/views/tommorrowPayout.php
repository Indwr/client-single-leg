<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tommorrow Payout users <?php echo $total_amount['total_amount']; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tommorrow Payout users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
               
              </div>
            <!-- </div> -->
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="tableView">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Directs</th>
                            
                            <th>Sponsor ID</th>
                            <th>Single Leg Status</th>
                            <!-- <th>E-wallet</th> -->
                            <th>Income</th>
                            <th>Joining Date</th>
                            <th>Withdraw Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i = 1;
                        foreach ($users as $key => $user) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $user['user_id']; ?></td>
                                <td><?php echo $user['name'] ; ?></td>
                                <td><?php echo $user['phone']; ?></td>
                                <td><?php echo $user['directs'];?></td>
                                <td><?php echo $user['sponser_id']; ?></td>
                                <td><?php echo $user['single_leg_status']; ?></td>
                                 <td><?php echo $user['total_amount']; ?></td> 
                                 <td><?php echo $user['created_at']; ?></td>
                                 <td><?php echo $user['withdraw_status'] == 1 ? '<span class="badge badge-danger">Close</span>' : '<span class="badge badge-success">Open</badge>'; ?></td>
                                 <td>
                                  <a href="<?php echo base_url('Jarvis/Management/user_login/'.$user['user_id']);?>" target="_blank">Login</a>/
                                  <a href="<?php echo base_url('Jarvis/Settings/EditUser/'.$user['user_id']);?>" target="_blank">Edit</a>/
                                  <?php if($user['withdraw_status'] == 0){ echo '<a href="'.base_url('Jarvis/Settings/stopUserWithdraw/'.$user['user_id']).'/1">Close Withdraw</a>';}else{ echo '<a href="'.base_url('Jarvis/Settings/stopUserWithdraw/'.$user['user_id']).'/0">Open Withdraw</a>';}?>
                                  /
                                  <!-- <a href="<?php // echo base_url('Jarvis/Settings/roi_setup/'.$user['user_id']);?>" target="_blank">ROI Setup</a>/ -->
                                  <?php
                                  if($user['disabled'] == 0)
                                    echo'<a class="blockUser" data-status="1" data-user_id="'.$user['user_id'].'">Block Now</a>';
                                  else
                                    echo'<a class="blockUser" data-status="0" data-user_id="'.$user['user_id'].'">UnBlock Now</a>';
                                  
                                  ?>
                                  
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>

                    </tbody>
                </table>
                <div class="row">
                  <div class="col-sm-12 col-md-5">
                    
                  </div>
                  <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="tableView_paginate">
                      
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include'footer.php' ?>
<script>
$(document).on('click','.blockUser',function(){
  var status = $(this).data('status');
  var user_id = $(this).data('user_id');
  var url = "<?php echo base_url('Jarvis/Management/blockStatus/');?>"+user_id + '/' + status;
  $.get(url,function(res){
    alert(res.message)
    if(res.success == 1)
      location.reload()
  },'json')
})
</script>