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
            $Beneficiary = $this->User_model->get_single_record('tbl_add_beneficiary',array('user_id' => $this->session->userdata['user_id']), 'ifnull(count(id),0) as ids');
            if($Beneficiary['ids'] == 0){
          ?>
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
                 <label>Bank Name <span class="text-danger">*</span></label>
                 <input type="text" id="default-datepicker" value="" name="bank_name" class="form-control" requried="true" placeholder="Enter Your Bank Name" required="">
                 <hr>
                 <label>Bank Holder Name <span class="text-danger">*</span></label>
                 <input type="text" id="default-datepicker" value="" name="bank_holder_name" class="form-control" requried="true" placeholder="Enter Your Bank Holder Name" required="">
                 <hr>
                 <label>Bank Account No. <span class="text-danger">*</span></label>
                 <input type="text" id="default-datepicker" value="" name="bank_account_no" class="form-control" requried="true" placeholder="Enter Your Bank Account No." required="">
                 <hr>
                 <label>Bank ISFC Code. <span class="text-danger">*</span></label>
                 <input type="text" id="default-datepicker" value="" name="ifsc" class="form-control" requried="true" placeholder="Enter Your Bank IFSC Code." required="">
                 <hr>
                 <label>Bank Branch. <span class="text-danger">*</span></label>
                 <input type="text" id="default-datepicker" value="" name="branch" class="form-control" requried="true" placeholder="Enter Your Bank Branch." required="">
                 <hr>
                 <label>Bank Registred Phone No. <span class="text-danger">*</span></label>
                 <input type="text" id="default-datepicker" value="" name="phone" class="form-control" requried="true" placeholder="Enter Your Bank Registred Phone No." required="">
                 <hr>
                 <label>Txn Password <span class="text-danger">*</span></label>
                 <input type="text" id="default-datepicker" value="" name="txn_password" class="form-control" requried="true" placeholder="Enter Txn Password" required="">
                 <hr>
                 <button type="submit" class="btn btn-primary shadow-primary px-5">Add Now</button>
               </div>
               </form>
            </div>
          </div>
          <?php 
        }else{
          redirect('Member/IMPS/beneficiaryDetails');
          // echo '<h3 class="text-danger"> You Already Added One Beneficiary <br><br>If You Want More Beneficiary Added Contact too Admin</h3>';
        }
          ?>
        </div>
  		

    <!-- End container-fluid-->
    
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

	

<script>
    // window.onload = function(){
    //     var id = document.getElementById("user_id").value; 
    //     if(id){
    //         checkUserID();
    //     }
    // };
    function newFunction(){
    var id = document.getElementById("user_id").value;
    fetch("<?php echo base_url('Member/Management/checkUser/')?>"+id, {
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
              document.getElementById("name").innerHTML = "<span class='text-danger'>Invaild User ID</span>";
              document.getElementById("user_id").value = "";
            }
        });
  }
</script>
<?php 
require_once 'footer.php';
?>
