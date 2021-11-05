<?php include_once'header.php';
  
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Beneficary</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/Management/Index');?>">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <?php echo form_open('',array('id' => 'walletForm'));?>
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <div class="form-group">
                <label>User ID</label>
                <input type="text" class="form-control" value="<?php echo $data['user_id'];?>" readonly="true" disabled>
                <span class="text-danger"><?php echo form_error('user_id')?></span>
                <span id="errorMessage"></span>
            </div>
            <div class="form-group">
                <label>Bank Name</label>
                <input type="text" class="form-control" name="beneficiary_bank" value="<?php echo $data['beneficiary_bank'];?>" required="true"/>
                <span class="text-danger"><?php echo form_error('beneficiary_bank')?></span>
            </div>
            <div class="form-group">
                <label>Bank Holder Name</label>
                <input type="text" class="form-control" name="beneficiary_name" value="<?php echo $data['beneficiary_name'];?>"  required="true"/>
                <span class="text-danger"><?php echo form_error('beneficiary_name')?></span>
            </div>
            <div class="form-group">
                <label>Bank A/C No.</label>
                <input type="text" class="form-control" name="beneficiary_account_no" value="<?php echo $data['beneficiary_account_no'];?>" required="true"/>
                <span class="text-danger"><?php echo form_error('beneficiary_account_no')?></span>
            </div>
            <div class="form-group">
                <label>Bank IFSC</label>
                <input type="text" class="form-control" name="beneficiary_ifsc" value="<?php echo $data['beneficiary_ifsc'];?>" required="true"/>
                <span class="text-danger"><?php echo form_error('beneficiary_ifsc')?></span>
            </div>
            <div class="form-group">
                <label>Account No./IFSC</label>
                <input type="text" class="form-control" name="account_ifsc" value="<?php echo $data['account_ifsc'];?>" required="true"/>
                <span class="text-danger"><?php echo form_error('account_ifsc')?></span>
            </div>
            <div class="form-group">
                <label>Bank Branch</label>
                <input type="text" class="form-control" name="beneficiary_branch" value="<?php echo $data['beneficiary_branch'];?>" required="true"/>
                <span class="text-danger"><?php echo form_error('beneficiary_branch')?></span>
            </div>
            <div class="form-group">
                <label>Register Phone</label>
                <input type="text" class="form-control" name="beneficiary_mobile" value="<?php echo $data['beneficiary_mobile'];?>" required="true"/>
                <span class="text-danger"><?php echo form_error('beneficiary_mobile')?></span>
            </div>
            <div class="form-group">
                <label>TXN Password</label>
                <input type="text" class="form-control" name="txn_password" value="" required="true"/>
                <span class="text-danger"><?php echo form_error('txn_password')?></span>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Submit</button>
            </div>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include_once'footer.php'; ?>
<script>
  $(document).on('blur','#user_id',function(){
    var user_id = $(this).val();
    var url  = '<?php echo base_url("Jarvis/Management/get_user/")?>'+user_id;
    $.get(url,function(res){
      $('#errorMessage').html(res);
    })
  })
  $(document).on('submit','#walletForm',function(){
      if (confirm('Do you want to Edit this beneficary?')) {
           yourformelement.submit();
       } else {
           return false;
       }
  })
</script>