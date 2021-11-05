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

			background-image: url('<?php echo base_url('Resource/App/Assets2/images/registerback.jpg'); ?>');

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
						<a href="<?php echo base_url(''); ?>"><img src="<?php echo base_url(logo); ?>" /></a>
					</div>
					<br>
					<h5 class="text-center"><?php echo $header; ?></h5>
					<?php
					if (!empty($this->session->flashdata('success'))) {
						echo '<div class="alert alert-success alert-dismissible" role="alert">
					    <button type="button" class="close" data-dismiss="alert">×</button>
					    <div class="alert-icon contrast-alert">
						 <i class="icon-check"></i>
					    </div>
					    <div class="alert-message">
					      <span><strong>Success!</strong> ' . $this->session->flashdata('success') . '</span>
					    </div>
	                  </div>';
					}
					if (!empty($this->session->flashdata('error'))) {
						echo '<div class="alert alert-danger alert-dismissible" role="alert">
					    <button type="button" class="close" data-dismiss="alert">×</button>
					    <div class="alert-icon contrast-alert">
						 <i class="icon-close"></i>
					    </div>
					    <div class="alert-message">
					      <span><strong>Error!</strong> ' . $this->session->flashdata('error') . '</span>
					    </div>
	                  </div>';
					}
					?>
					<div class="card-title text-uppercase text-center py-2"></div>
					<?php echo form_open(); ?>
					<div class="form-group">
						<div class="position-relative has-icon-left">
							<label for="exampleInputUsername" class="sr-only">Sponser ID</label>
							<input type="text" id="sponser_id" name="sponser_id" onblur="check()" class="form-control" style="border-radius: 20px;" placeholder="Sponser ID" value="<?php if (empty($_GET['id'])) {
																																														echo 'admin';
																																													} else {
																																														echo $_GET['id'];
																																													} ?>">
							<label id="name"> </label>
							<div class="form-control-position">
								<i class="icon-user"></i>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="position-relative has-icon-left">
							<label for="exampleInputUsername" class="sr-only">Name</label>
							<input type="text" id="" name="name" class="form-control" style="border-radius: 20px;" placeholder="Enter Name">
							<div class="form-control-position">
								<i class="icon-user"></i>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="position-relative has-icon-left">
							<label for="exampleInputPassword" class="sr-only">Email</label>
							<input type="email" id="password" name="email" class="form-control" style="border-radius: 20px;" placeholder="Enter Email">
							<div class="form-control-position">
								<i class="icon-lock"></i>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="position-relative has-icon-left">
							<label for="exampleInputPassword" class="sr-only">Phone No.</label>
							<input type="number" id="password" name="phone" class="form-control" style="border-radius: 20px;" placeholder="Enter Phone No">
							<div class="form-control-position">
								<i class="icon-lock"></i>
							</div>
						</div>
					</div>

					<div class="form-row mr-0 ml-0">
						<div class="form-group">
							<div class="icheck-material-primary">
								<input type="checkbox" id="terms" checked="" />
								<label for="user-checkbox">I have read the Terms & Conditions</label>
							</div>
						</div>
						<!-- <div class="form-group col-6 text-right">
			  <a href="">Reset Password</a>
			 </div> -->
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-success btn-block waves-effect waves-light" style="border-radius: 20px;">Register</button>
					</div>
					<div class="form-group text-center">
						<p class="text-muted">If You Allready Regiter ? <a href="<?php echo base_url('Member/Management/login'); ?>"> Sign in here</a></p>
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

</body>

</html>


<script>
	window.onload = function() {
		var id = document.getElementById("sponser_id").value;
		if (id) {
			check();
		}
	};

	function check() {
		var id = document.getElementById("sponser_id").value;
		fetch("<?php echo base_url('Member/Management/checkUser/') ?>" + id, {
				method: "GET",
				headers: {
					// "Content-Type": "application/json",
					// "Accept": "application/json",
					"X-Requested-With": "XMLHttpRequest"
				},
			})
			.then(response => response.json())
			.then(result => {
				if (result.status == '1') {
					console.log(result);
					// document.getElementById("name").innerHTML = result;
					document.getElementById("name").innerHTML = '<span class="text-success">' + result.name + '</span>';
				} else {
					document.getElementById("name").innerHTML = "<span class='text-danger'>Invaild Sponser ID</span>";
					document.getElementById("sponser_id").value = "";
				}
			});
	}

	function getSessionData() {
		return document.getElementById("sessionData").value;
	}
	getSessionData();
</script>