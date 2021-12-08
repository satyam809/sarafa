<!DOCTYPE html>
<?php
//////////////////////////////////// check admin login or not ///////////////////////////////////
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == '1') {
	redirect('admin/dashboard');
}
?>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>public/assets/images/site_imges/favicon.png">
	<title>Admin Panel | Sarafa Mart</title>
	<link href="<?php echo base_url(); ?>public/dist/css/style.min.css" rel="stylesheet">
	<!-- ================== GOOGLE FONTS ==================-->
</head>

<body>
	<div class="main-wrapper">
		<!-- ============================================================== -->
		<!-- Preloader - style you can find in spinners.css -->
		<!-- ============================================================== -->
		<div class="preloader">
			<div class="lds-ripple">
				<div class="lds-pos"></div>
				<div class="lds-pos"></div>
			</div>
		</div>

		<div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(<?php echo base_url(); ?>public/assets/images/big/auth-bg.jpg) no-repeat center center;">
			<div class="auth-box">
				<div id="loginform">
					<div class="logo">
						<span class="db"><img src="<?php echo base_url(); ?>public/assets/images/logo.png" alt="vruits" style="width: 147px;"/></span>
						<h3>Admin Panel</h3>
					</div>
					<!-- Form -->
					<div class="row">
						<div class="col-12">
							<form class="form-horizontal mt-3" method="POST" id="loginform" action="<?php echo base_url(); ?>admin/login">
								<!--<h5 class="sign-in-heading text-center m-b-20">Sign in to admin</h5>-->
								<?php if ($this->session->flashdata('admin_notfount') != '') { ?>
									<center>
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											<strong>Oh snap!</strong> <?php echo $this->session->flashdata('admin_notfount'); ?></a>.
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true" class="la la-close"></span>
											</button>
										</div>
									</center>
								<?php } else if ($this->session->flashdata('Invalid') != '') { ?>
									<center>
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											<strong>Oh snap!</strong> <?php echo $this->session->flashdata('Invalid'); ?></a>.
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true" class="la la-close"></span>
											</button>
										</div>
									</center>
								<?php } ?>
								<!--<div class="col-md-5">
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline4" name="chr_type" class="custom-control-input" value="N" checked="">
                <label class="custom-control-label" for="customRadioInline4">National</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline5" name="chr_type" class="custom-control-input" value="I">
                <label class="custom-control-label" for="customRadioInline5">International</label>
        </div>
    </div>-->

								<br>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
									</div>
									<input type="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" name="email" aria-describedby="basic-addon1" required="">
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
									</div>
									<input type="password" class="form-control form-control-lg" placeholder="Password" name="password" aria-label="Password" aria-describedby="basic-addon1" required="">
								</div>
								<!--<div class="form-group row">
		<div class="col-md-12">
			<div class="custom-control custom-checkbox">
				<input type="checkbox" class="custom-control-input" id="customCheck1">
				<label class="custom-control-label" for="customCheck1">Remember me</label>
				<a href="javascript:void(0)" id="forgot_pass" class="text-dark float-right"><i class="fa fa-lock mr-1"></i> Forgot pwd?</a>
			</div>
		</div>
	</div>-->
								<div class="form-group text-center">
									<div class="col-xs-12 pb-3">
										<button class="btn btn-block btn-lg btn-info" type="submit">Log In</button>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="forgotpassModal" class="modal fade in" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<!--  <div class="modal-header">
            <h5 class="modal-title">Forgotten Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="zmdi zmdi-close"></span>
            </button>
        </div> -->
					<div class="modal-body">
						<button type="button" class="close" data-dismiss="modal" onclick="resetfrm()">×</button>
						<h4 class="modal-title">Forgot Password</h4><br><br>
						<form class="sign-in-form" id="frm_forgotpass" action="<?= base_url(); ?>admin/forgotPassword">
							<!-- forget_password -->
							<p class="text-center text-muted">Please submit your registered email address. A message will be sent to registered email address generating to new password.</p>
							<div class="form-group">
								<label for="inputEmail" class="sr-only">Email address</label>
								<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required="">
							</div>
							<button class="btn btn-primary btn-rounded btn-floating btn-lg btn-block" type="submit">Send</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- All Required js -->
	<!-- ============================================================== -->
	<script src="<?php echo base_url(); ?>public/assets/libs/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap tether Core JavaScript -->
	<script src="<?php echo base_url(); ?>public/assets/libs/popper.js/dist/umd/popper.min.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- ============================================================== -->
	<!-- This page plugin js -->
	<!-- ============================================================== -->
	<script>
		$('[data-toggle="tooltip"]').tooltip();
		$(".preloader").fadeOut();
		// ============================================================== 
		// Login and Recover Password 
		// ============================================================== 
	</script>
	<script type="text/javascript">
		var siteurl = '<?= base_url(); ?>';
		$('#forgot_pass').click(function(e) {
			$("#forgotpassModal").slideUp();
			e.preventDefault();
			$('#forgotpassModal').modal('show');
		});

		$('#frm_forgotpass').submit(function(e) {
			e.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				type: "post",
				data: $(this).serialize(),
				success: function(result) {

					if (result == true) {
						alert("E-mail sent successfully.");
					} else {
						alert(result);
					}
				},
				error: function(error) {
					alert(error);
				}
			});
		})
	</script>
</body>

</html>