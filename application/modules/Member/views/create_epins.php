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

        echo 'Generate Pins';
        $balance = $this->User_model->get_single_record('tbl_bank_details',array('user_id' => $this->session->userdata['user_id']), 'totalBalance');
        ?></h4>
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
            <div class="card-header text-uppercase"><?php echo 'Generate Epins';?> </div>
            <?php echo form_open();?>
                <div class="card-body">
                    <label class="badge badge-success">Avaliable Balance: Rs. <?php echo $balance['totalBalance']; ?>/-</label><hr>
                    <label>No of Pins</label>
                    <input type="number" name="pin_count" class="form-control" requried="true">
                    <hr>
                    <label>Amount</label>
                    <select name="pin_amount" class="form-control">
                        <?php foreach($packages as $p):?>
                            <option value="<?php echo $p['price'];?>"><?php echo $p['price'];?></option>
                        <?php endforeach;?>
                    </select>
                    <hr>
                    <label>Txn Password</label>
                    <input type="text" id="autoclose-datepicker" class="form-control" name="master_key" value="" requried="true">
                    <hr>
                
                    <button type="submit" class="btn btn-primary shadow-primary px-5">Generate Pins</button>
                </div>
            </form>
            </div>
          </div>
        </div>
        </div>
    </div>
    </div>
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<?php 
require_once 'footer.php';
?>