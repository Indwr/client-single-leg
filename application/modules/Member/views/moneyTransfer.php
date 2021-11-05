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
		    <h4 class="page-title"><?php 

        echo $header;
        $balance = $this->User_model->get_single_record('tbl_income_wallet',array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as balance');
        ?></h4>
        <label class="badge badge-info">Minimum Withdrawal: Rs. 300/-</label>
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
            <div class="card-header text-uppercase"><?php echo $header;?> </div>
             <div class="card-body">
            <label class="badge badge-success">Avaliable Balance: Rs. <?php echo $balance['balance']; ?>/-</label>
               <?php echo form_open();

               $get = $this->User_model->get_single_record('tbl_add_beneficiary', array('id' => trim(addslashes($id))), 'beneficiary_account_no');

               $withdraw_status = $this->User_model->get_single_record('tbl_admin', array('id' => 1), 'withdraw_status');

                // $ips = 0;
                //   if($ips == 1){
                   if(date('H:i') >= '14:00' AND date('H:i') <= '17:00' AND date('D') != 'Sun'){
                      if($withdraw_status['withdraw_status'] == 0){
                         if(!empty($get)){
                         if($user_info['withdraw_status'] == 0){
                         ?>
                          <label>Bank Account</label>
                          <input type="text" id="default-datepicker" value="<?php echo $get['beneficiary_account_no']; ?>" class="form-control" requried="true" readonly="" required="">
                          <hr>
                          <label>Amount</label>
                          <input type="text" id="default-datepicker" name="amount" value="" class="form-control" requried="true">
                          <hr>
                           
                          <label>Txn Password</label>
                          <input type="text" id="autoclose-datepicker" class="form-control" name="txn_password" value="" requried="true">
                          <hr>
                          <!-- <label>OTP <span class="text-danger">*</span></label>
                          <input type="text" id="autoclose-datepicker" class="form-control" name="otp" requried="true">
                          <br>
                          <button type="button" onclick="getOtp()" id="get_otp" class="btn btn-primary btn-sm shadow-primary px-5">GET OTP</button>
                          <hr> -->
                           
                          <button type="submit" class="btn btn-primary shadow-primary px-5">Withdraw Now</button>
                         </div>
                         </form>
                         <?php 

                         }else{
                              echo '<label class="badge badge-danger">Withdrawal Closed!</label>';
                         }

                         }else{
                              echo '<label class="badge badge-danger">Beneficiary Account Not Found!</label>';
                         }
                       }else{
                          echo '<label class="badge badge-danger">Withdraw Closed!</label>';
                       }
                    }else{
                        echo '<label class="badge badge-danger">Withdrawal Open 02:00PM to 05:00PM (Monday to Saturday)!</label>';
                   }
                 // }else{
                 //        echo '<label class="badge badge-danger">Due to today bank holiday, bank not accept our payments so tommorow withdraw open 12 NOON to 6 PM. Thanks for your Love and Support MRW!</label>';
                 //   }

               ?>
            </div>
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

<script>
function getOtp(){
fetch("<?php echo base_url('Member/IMPS/getOtp') ?>", {
method: "GET",
headers: {
"Content-Type": "application/json",
"Accept": "application/json",
"X-Requested-With": "XMLHttpRequest"
},
})
.then(response => response.json())
.then(result => {
// console.log(result);
if(result.status == '1'){
document.getElementById("get_otp").style.display = "none";
alert('OTP send on your registred mobile no.!');
}else{
alert('Sorry Please try again later!');
}
});
}

</script>