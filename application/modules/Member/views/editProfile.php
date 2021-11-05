<?php 
require_once 'header.php';?>
<style>
  .footer {
    position: fixed;
}
</style>

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"><?php echo $header;?></h4>
	   </div>
     
     </div>
     </div>
    <!-- End Breadcrumb-->
     <div class="row">
        <div class="col-lg-8">
        	<?php 
        	if(!empty($this->session->flashdata('success'))){
	        	echo '<div class="alert alert-success alert-dismissible" role="alert">
					    <button type="button" class="close" data-dismiss="alert">×</button>
					    <div class="alert-icon contrast-alert">
						 <i class="icon-check"></i>
					    </div>
					    <div class="alert-message">
					      <span><strong>Success!</strong> '.$this->session->flashdata('success').'</span>
					    </div>
	                  </div>';
	        }
	        if(!empty($this->session->flashdata('error'))){
	            echo '<div class="alert alert-danger alert-dismissible" role="alert">
					    <button type="button" class="close" data-dismiss="alert">×</button>
					    <div class="alert-icon contrast-alert">
						 <i class="icon-close"></i>
					    </div>
					    <div class="alert-message">
					      <span><strong>Error!</strong> '.$this->session->flashdata('error').'</span>
					    </div>
	                  </div>';
              }
        	?>
          <div class="card">
            <div class="card-header text-uppercase"><?php echo $header;?></div>
             <div class="card-body">
               <?php echo form_open();?>
                 <label>User ID</label>
                 <input type="text" id="default-datepicker" value="<?php echo strtoupper($user_info['user_id']);?>" class="form-control" readonly="true" requried="true">
                 <hr>
                 <label>Sponser ID</label>
                 <input type="text" id="default-datepicker" value="<?php echo strtoupper($user_info['sponser_id']);?>" class="form-control" readonly="true" requried="true">
                 <hr>
                 <label>Name</label>
                 <input type="text" id="autoclose-datepicker" class="form-control" value="<?php echo strtoupper($user_info['name']);?>" readonly="true" requried="true">
                 <hr>
                 <label>Phone</label>
                 <input type="text" id="autoclose-datepicker" class="form-control" value="<?php echo strtoupper($user_info['phone']);?>" readonly="true" requried="true">
                 <hr>
                 <label>Email</label>
                 <input type="text" name="email" id="autoclose-datepicker" class="form-control" value="<?php echo strtoupper($user_info['email']);?>" requried="true">
                 <hr>
                 <label>Country*</label>
                 <input type="text" id="autoclose-datepicker" name="country" class="form-control" value="<?php echo strtoupper($user_info['country']);?>" requried="true">
                 <label class="text-danger"><?php echo form_error('country');?></label>
                 <hr>
                 <label>City*</label>
                 <input type="text" id="autoclose-datepicker" name="city" class="form-control" value="<?php echo strtoupper($user_info['city']);?>" requried="true">
                 <label class="text-danger"><?php echo form_error('city');?></label>
                 <hr>
                 <label>State*</label>
                 <input type="text" id="autoclose-datepicker" name="state" class="form-control" value="<?php echo strtoupper($user_info['state']);?>" requried="true">
                 <label class="text-danger"><?php echo form_error('state');?></label>
                 <hr>
                 <button type="submit" class="btn btn-primary shadow-primary px-5">Submit</button>
               </div>
               </form>
            </div>
          </div>
        </div>
  		</div>
	

    <!-- End container-fluid-->
    
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

	

<?php 
require_once 'footer.php';
?>

