<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Generate Epins</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Generate Epins</li>
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
                            <label>User Id</label>
                            <input type="text" id="sponser_id" name="user_id" onblur="check()" class="form-control" value="<?php echo set_value('user_id')?>" placeholder="User ID"/>
                            <label id="name"><?php echo form_error('user_id');?></label>
                        </div>
                        <div class="form-group">
                            <label>Pin Amount</label>
                            <select class="form-control" name="pin_amount">
                                <?php 
                                foreach($packages as $key => $package)
                                    echo'<option value="'.$package['price'].'">'.$package['title'].'</option>';
                                ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('pin_amount');?></span>
                        </div>
                        <div class="form-group">
                            <label>No. of Epins</label>
                            <input type="number" name="pin_count" class="form-control" value="<?php echo set_value('epins')?>"/>
                            <label class="text-danger"><?php echo form_error('pin_count');?></label>
                        </div>
                        <div class="form-group">
                            <label>Txn Pin</label>
                            <input type="number" name="master_key" class="form-control" value="<?php echo set_value('master_key')?>"/>
                            <label class="text-danger"><?php echo form_error('master_key');?></label>
                        </div>
                        <!-- <div class="form-group">
                                                    <label>OTP</label>
                                                    <input type="password" class="form-control" name="otp" placeholder="Enter OTP" value="" required="">
                                                    <span class="text-danger"><?php //echo form_error('otp')?></span><br>
                                                    <a href="<?php //echo base_url('Admin/Settings/adminLoginOtp')?>" class="btn btn-success btn-sm">Get OTP</a>
                                                </div>
                        <div class="form-group"> -->
                            <button type="submit" class="btn btn-success pull-right">Create</button>
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

      </div>
    </div>
  </div>
<?php include'footer.php' ?>
<script>
    window.onload = function(){
        var id = document.getElementById("sponser_id").value; 
        if(id){
            check();
        }
    };
    function check(){
    var id = document.getElementById("sponser_id").value;
    fetch("<?php echo base_url('Member/Management/checkUser/'); ?>"+id, {
            method: "GET",
            headers: {
              // "Content-Type": "application/json",
              // "Accept": "application/json",
              "X-Requested-With": "XMLHttpRequest"
            },
        })
        .then(response => response.json())
        .then(result => {
            if(result.status == '1'){
            console.log(result);
              // document.getElementById("name").innerHTML = result;
              document.getElementById("name").innerHTML = '<span class="text-success">'+result.name+'</span>';
            }else{
              document.getElementById("name").innerHTML = "<span class='text-danger'>Invaild Sponser ID</span>";
              document.getElementById("sponser_id").value = "";
            }
        });
  }
</script>