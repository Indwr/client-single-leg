<?php include'header.php'; ?>
<style>
  .footer {
    position: fixed;
}
</style>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark"><?php echo $header; ?></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $header; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <!-- /.card-header -->
    <?php

        $response = $this->User_model->get_records('tbl_add_beneficiary',array('user_id' => $this->session->userdata['user_id']),'*');

                        
                        foreach ($response as $key => $record) {
                            ?>
                            <div class="row">
                            <div class="col-lg-4">
                            <div class="card bg-info">

                            <div class="card-body">
                            <h6 class="card-title text-white">Bank: <?php echo $record['beneficiary_bank']; ?></h6>


                            </div>
                            <ul class="list-group list-group-flush list shadow-none" style="color: #673499;">
                            <b><li class="list-group-item d-flex justify-content-between align-items-center">Account Holder Name: <?php echo $record['beneficiary_name']; ?></li></b>
                            <b><li class="list-group-item d-flex justify-content-between align-items-center">Account No.: <?php echo $record['beneficiary_account_no']; ?></li></b>
                            <b><li class="list-group-item d-flex justify-content-between align-items-center">IFSC Code: <?php echo $record['beneficiary_ifsc']; ?></li></b>
                            <b><li class="list-group-item d-flex justify-content-between align-items-center">Branch: <?php echo $record['beneficiary_branch']; ?></li></b>
                            <b><li class="list-group-item d-flex justify-content-between align-items-center">Registered Phone No.: <?php echo $record['beneficiary_mobile']; ?></li></b>
                            </ul>
                            <div class="card-body">
                            <a href="<?php echo base_url('Member/IMPS/moneyTransfer/'.$record['id']); ?>" class="btn btn-success">Withdraw</a>
                            </div>
                            </div>
                            </div>
                          </div>
                            
                            <?php
                        }
                        ?>

                    
              </div>

              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include'footer.php' ;?>
