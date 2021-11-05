<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title><?php echo title . ' | ' . $header; ?></title>
	<!--favicon-->
	<link rel="icon" href="<?php echo base_url(logo); ?>" type="image/x-icon">
	<!-- Bootstrap core CSS-->
	<link href="<?php echo base_url('Resource/Member/assets/'); ?>css/bootstrap.min.css" rel="stylesheet" />
	<!-- animate CSS-->
	<link href="<?php echo base_url('Resource/Member/assets/'); ?>css/animate.css" rel="stylesheet" type="text/css" />
	<!-- Icons CSS-->
	<link href="<?php echo base_url('Resource/Member/assets/'); ?>css/icons.css" rel="stylesheet" type="text/css" />
	<!-- Custom Style-->
	<link href="<?php echo base_url('Resource/Member/assets/'); ?>css/app-style.css" rel="stylesheet" />
	<style>
		img {
			vertical-align: middle;
			border-style: none;
			width: 62%;
		}

		.card-body {
			-ms-flex: 1 1 auto;
			flex: 1 1 auto;
			padding: 1.25rem;
			background-color: #bac1d2;
		}

		body {

			background-image: url('<?php echo base_url('Resource/App/Assets2/images/loginback.jpg'); ?>');

		}
	</style>
</head>
<input type="hidden" value="<?= ($_SESSION['user_id'] ?? null) ?>" id="sessionData">

<body class="authentication-bg">
	<!-- Start wrapper-->
	<div id="wrapper">
		<div class="card card-authentication1 mx-auto my-5 animated zoomIn">
			<div class="card-body">
				<div class="card-content p-2">
					<div class="text-center">
						<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(logo); ?>" /></a>
					</div>
					<br>
					<?php

					if (!empty($message)) {
						echo '<div class="alert alert-danger alert-dismissible" role="alert">
				   <button type="button" class="close" data-dismiss="alert">×</button>
				    <div class="alert-icon">
					 <i class="icon-close"></i>
				    </div>
				    <div class="alert-message">
				      <span><strong>Error!</strong> ' . $message . '.</span>
				    </div>
                  </div>';
					}
					?>
					<div class="card-title text-uppercase text-center py-2"><?php echo $header; ?></div>
					<?php echo form_open(); ?>
					<div class="form-group">
						<div class="position-relative has-icon-right">
							<label for="exampleInputUsername" class="sr-only">User ID</label>
							<input type="text" id="user_id" name="username" class="form-control" style="border-radius: 20px;" placeholder="Enter User ID" value="admin">
							<div class="form-control-position">
								<i class="icon-user"></i>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="position-relative has-icon-right">
							<label for="exampleInputPassword" class="sr-only">Password</label>
							<input type="password" id="password" name="passid" style="border-radius: 20px;" class="form-control" placeholder="Enter Password" value="mlm_company">
							<div class="form-control-position">
								<i class="icon-lock"></i>
							</div>
						</div>
					</div>
					<div class="form-row mr-0 ml-0">
						<div class="form-group col-6">
							<div class="icheck-material-primary">
								<input type="checkbox" id="user-checkbox" checked="" />
								<label for="user-checkbox">Remember me</label>
							</div>
						</div>
						<div class="form-group col-6 text-right">
							<a href="<?php echo base_url('Member/Profile/forgotPassword'); ?>">Forgot Password</a>
						</div>
					</div>

					<div class="form-group">
						<button type="submit" style="border-radius: 20px;" class="btn btn-success btn-block waves-effect waves-light">Sign In</button>
					</div>
					<div class="form-group text-center">
						<p class="text-muted">Not a Member ? <a href="<?php echo base_url('Register'); ?>"> Sign Up here</a></p>
					</div>
					<div class="form-group text-center d-none">
						<hr>
						<h5>OR</h5>
					</div>
					<div class="form-group text-center d-none">
						<button type="button" class="btn btn-facebook shadow-facebook text-white btn-block waves-effect waves-light"><i class="fa fa-facebook-square"></i> Sign In With Facebook</button>
					</div>
					</form>
				</div>
			</div>
		</div>

		<!--Start Back To Top Button-->
		<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
		<!--End Back To Top Button-->
	</div>
	<!--wrapper-->

	<!-- Bootstrap core JavaScript-->
	<script src="<?php echo base_url('Resource/Member/assets/'); ?>js/jquery.min.js"></script>
	<script src="<?php echo base_url('Resource/Member/assets/'); ?>js/popper.min.js"></script>
	<script src="<?php echo base_url('Resource/Member/assets/'); ?>js/bootstrap.min.js"></script>
	<!-- waves effect js -->
	<script src="<?php echo base_url('Resource/Member/assets/'); ?>js/waves.js"></script>
	<!-- Custom scripts -->
	<script src="<?php echo base_url('Resource/Member/assets/'); ?>js/app-script.js"></script>

	<script>
		function getSessionData() {
			return document.getElementById("sessionData").value;
		}
		getSessionData();
	</script>
</body>

</html>