<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Send SMS</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Send SMS</li>
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
              <!-- /.card-header -->
              <div class="card-body">
                  <h3><?php echo $this->session->flashdata('message');?></h3>
                    <?php echo form_open();?>
                        

                        <div class="form-group">
                            <label>Phone No's.</label>
                            <input type="text" name="contacts" class="form-control" value="<?php echo set_value('contacts')?>" placeholder="Phone No's" />
                            <label class="text-danger"><?php echo form_error('contacts');?></label>
                        </div>
                       
                        <div class="form-group">
                            <label>Message</label>
                            <textarea name="message" class="form-control"><?php echo set_value('message')?>Single Leg Plan / Joining 499 / Direct Income 50 / IMPS WITHDRAWAL / 101% LEGAL  https://rozicash.com/Dashboard/User/Register/?sponser=RC162990   M: 70098-16732</textarea>
                            <label class="text-danger"><?php echo form_error('message');?></label>
                        </div>
                        
                            <button type="submit" class="btn btn-success pull-right">Send</button>
                        </div>
                    <?php echo form_close();?>
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
    $(document).on('blur','#userId',function (res){
        var user_id = $(this).val();
        var url = '<?php echo base_url("Dashboard/User/get_user/")?>' + user_id;
        $.get(url , function(res){
            $('#UserName').html(res)
        })
    })
</script>