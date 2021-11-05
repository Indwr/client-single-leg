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
                 <label>Current Password <span class="text-danger">*</span></label>
                 <input type="password" id="autoclose-datepicker" name="current_password" class="form-control" value="" requried="true" placeholder="Current Password" required="true">
                 <label class="text-danger"><?php echo form_error('current_password');?></label>
                 <hr>
                 <label>New Password <span class="text-danger">*</span></label>
                 <input type="password" id="autoclose-datepicker" name="new_password" class="form-control" value="" requried="true" placeholder="New Password" required="true">
                 <label class="text-danger"><?php echo form_error('new_password');?></label>
                 <hr>
                 <label>Verify New Password <span class="text-danger">*</span></label>
                 <input type="password" id="autoclose-datepicker" name="verify_new_password" class="form-control" value="" requried="true" placeholder="Verify New Password" required="true">
                 <label class="text-danger"><?php echo form_error('verify_new_password');?></label>
                 <hr>
                 <button type="submit" class="btn btn-primary shadow-primary px-5">Submit</button>
               </div>
               </form>
            </div>
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

