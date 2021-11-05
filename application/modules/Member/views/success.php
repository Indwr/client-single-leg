<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title><?php echo title.' | '.$header;?></title>
  <!--favicon-->
  <link rel="icon" href="<?php echo base_url(logo);?>" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url('Resource/Member/assets/');?>css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="<?php echo base_url('Resource/Member/assets/');?>css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="<?php echo base_url('Resource/Member/assets/');?>css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="<?php echo base_url('Resource/Member/assets/');?>css/app-style.css" rel="stylesheet"/>
  <style>
  	img {
    vertical-align: middle;
    border-style: none;
    width: 62%;
}
  </style>
</head>

<body class="authentication-bg">
 <!-- Start wrapper-->
 <div id="wrapper">
	<div class="card card-authentication1 mx-auto my-5 animated zoomIn">
		<div class="card-body">
		 <div class="card-content p-2">
		  <div class="text-center">
		 		<img src="<?php echo base_url(logo);?>"/>
		 	</div>
		 	<br>
		 	
		  <div class="card-title text-uppercase text-center py-2"><?php echo $header; ?></div>
		    
		    <?php  if(!empty($message)){ echo $message; }else{ echo 'Invaild Request!';} ?>

		   </div>
		  </div>
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('Resource/Member/assets/');?>js/jquery.min.js"></script>
  <script src="<?php echo base_url('Resource/Member/assets/');?>js/popper.min.js"></script>
  <script src="<?php echo base_url('Resource/Member/assets/');?>js/bootstrap.min.js"></script>
  <!-- waves effect js -->
  <script src="<?php echo base_url('Resource/Member/assets/');?>js/waves.js"></script>
  <!-- Custom scripts -->
  <script src="<?php echo base_url('Resource/Member/assets/');?>js/app-script.js"></script>
	
</body>

</html>
