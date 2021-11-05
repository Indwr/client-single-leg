<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Register Fake Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Register Fake Users</li>
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
                            <label>Sponser Id</label>
                            <input type="text" id="userId" name="user_id" class="form-control" value="<?php echo set_value('user_id')?>" placeholder="Sponser ID"/>
                            <label class="text-danger" id="UserName"><?php echo form_error('user_id');?></label>
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo set_value('name')?>" placeholder="Name" />
                            <label class="text-danger"><?php echo form_error('name');?></label>
                        </div>
                       
                        <div class="form-group">
                            <label>No. of Ids</label>
                            <input type="number" name="pin_count" class="form-control" value="<?php echo set_value('epins')?>" placeholder="No. of Ids" />
                            <label class="text-danger"><?php echo form_error('pin_count');?></label>
                        </div>
                        
                            <button type="submit" class="btn btn-success pull-right">Register</button>
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