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


          $epinBalance = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'status' => 0), 'ifnull(count(id),0) as epinBalance');
        	?>
          <div class="card">
            <div class="card-header text-uppercase"><?php echo $header.' <label class="badge badge-success">(Total Avaliable Epins: '.$epinBalance['epinBalance'].')</label>';?></div>
             <div class="card-body">
               <?php echo form_open();?>
                 <label>User ID <span class="text-danger">*</span></label>
                 <input type="text" id="user_id" value="PSB" onblur="newFunction()" name="user_id" value="" class="form-control" requried="true" placeholder="Enter User ID" required="ture">
                 <label id="name"> </label>
                 <hr>
                 <label>NOP (Number of E-Pins) <span class="text-danger">*</span></label>
                 <input type="number" name="numbr_epins" value="" class="form-control" requried="true" placeholder="Enter Number of E-Pins" required="ture">
                 <hr>
                 <label>Txn Password <span class="text-danger">*</span></label>
                 <input type="text" name="txn_pass" value="" class="form-control" requried="true" placeholder="Enter Txn Password" required="ture">
                 <hr>
                 <button type="submit" class="btn btn-primary shadow-primary px-5">Submit</button>
               </div>
               </form>
            </div>
        </div>
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
