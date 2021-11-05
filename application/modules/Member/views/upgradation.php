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
                 <input type="text" id="user_id" value="" onblur="newFunction()" name="user_id" class="form-control" requried="true" placeholder="Enter User ID">
                  <label id="name"> </label>
                  <hr>
                 <label>Package</label>
                 <select class="form-control" id="input-6" name="package_id" >
                  <?php
                    //foreach($packages as $key => $value){
                      echo '<option value="2">Upgrade Your Account for Double Leg Rs. 1000/-</option>';
                    //}
                  ?>
                 </select>
                 <hr>
                 <label>Epin</label>
                 <input type="text" id="default-datepicker" value="<?php echo $epin;?>" class="form-control" name="epin" readonly="true" requried="true">
                 <hr>
                 <label>Txn Password</label>
                 <input type="text" id="default-datepicker" value="" name="txn_password" class="form-control" requried="true" placeholder="Enter Txn Password">
                 <hr>
                 <button type="submit" class="btn btn-primary shadow-primary px-5">Upgrade Now</button>
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
