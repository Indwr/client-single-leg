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
						<img src="<?php echo base_url(logo); ?>" />
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
					<?php echo form_open('', 'id="loginForm"'); ?>
					<div class="form-group">
						<div class="position-relative has-icon-left">
							<label for="exampleInputUsername" class="sr-only">User ID</label>
							<input type="text" id="user_id" name="user_id" class="form-control" placeholder="Enter Your Registered User ID">
							<div class="form-control-position">
								<i class="icon-user"></i>
							</div>
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success shadow-success btn-block waves-effect waves-light">SUBMIT</button>
					</div>
					<div class="form-group text-center">
						<hr>
						<h5>OR</h5>
						<a href="<?php echo base_url('Login') ?>" class="btn btn-info btn sm shadow-info btn-block waves-effect waves-light">LOGIN</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>
<script>
	const element = document.getElementById("loginForm");
	element.addEventListener('submit', event => {
		event.preventDefault();
		var formData = new FormData(element);
		// var object = {};
		// formData.forEach((value, key) => {object[key] = value});
		// var json = JSON.stringify(object);
		fetch("<?php echo base_url('Member/Profile/forgotPassword') ?>", {
				method: "POST",
				headers: {
					// "Content-Type": "application/json",
					// "Accept": "application/json",
					"X-Requested-With": "XMLHttpRequest"
				},
				body: formData,
			})
			.then(response => response.json())
			.then(result => {
				if (result.status == '1') {
					swal({
						title: "Success!",
						text: result.message,
						icon: "success",
					}).then(function() {
						window.location.href = result.url;
					});
				} else {
					swal({
						title: "Oops!",
						text: result.message,
						icon: "error",
						dangerMode: true,
					}).then(function() {
						window.location.reload();
					});
				}
			});
	});

	function getSessionData() {
		return document.getElementById("sessionData").value;
	}
	getSessionData();
</script>