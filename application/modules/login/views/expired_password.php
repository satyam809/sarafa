<html dir="ltr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>public/assets/images/site_imges/favicon.png">
	<title>Vruits</title>
	<style type="text/css">
	body {
		color: #3e5569;
	}
	.error-box {
		height: 100%;
		position: fixed;
		background: url(../../../../assets/images/background/error-bg.html) center center no-repeat #fff;
		width: 100%;
	}
	* {
		outline: 0;
	}
	*, ::after, ::before {
		box-sizing: border-box;
	}
	.error-box .error-body {
		padding-top: 5%;
	}
	.error-box .error-title {
		font-size: 210px;
		font-weight: 900;
		text-shadow: 4px 4px 0 #fff, 6px 6px 0 #343a40;
		line-height: 210px;
	}

	.text-danger {
		color: #fc5130  !important;
	}
	.text-uppercase {
		text-transform: uppercase !important;
	}
	.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
		margin-bottom: .5rem;
		font-family: inherit;
		font-weight: 700;
		line-height: 1.2;
		color: inherit;
	}
	.text-muted {
		color: #a1aab2 !important;
	}
	.mb-4, .my-4 {
		margin-bottom: 1.5rem !important;
	}
	dl, h1, h2, h3, h4, h5, h6, ol, p, pre, ul {
		margin-top: 0;
	}
	.text-center {
		text-align: center !important;
	}
	.btn-danger {
		color: #fff;
		background-color: #fc5130;
		border-color: #fc5130;
	}
	.btn:not(:disabled):not(.disabled), summary {
		cursor: pointer;
	}
	.btn-rounded {
		border-radius: 60px;
		padding: 7px 18px;
	}
	.cell, .v-middle td, .v-middle th, .vm.table td, .vm.table th, .waves-effect {
		vertical-align: middle;
	}
	.waves-effect {
		position: relative;
		cursor: pointer;
		display: inline-block;
		overflow: hidden;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		z-index: 1;
		will-change: opacity, transform;
		-webkit-transition: all .1s ease-out;
		-moz-transition: all .1s ease-out;
		-o-transition: all .1s ease-out;
		-ms-transition: all .1s ease-out;
		transition: all .1s ease-out;
	}
	a {
		text-decoration: none;
	}
</style>
</head>

<body>
	<div class="main-wrapper">
		<div class="preloader">
			<div class="lds-ripple">
				<div class="lds-pos"></div>
				<div class="lds-pos"></div>
			</div>
		</div>
		<div class="error-box">
			<div class="error-body text-center">
				<h3 class="text-uppercase error-subtitle">RESET LINK EXPIRED !</h3>
			</br>
			<p class="text-muted mt-4 mb-4">Sorry Your reset password link is expired , Please Try again !</p>
		</br>
		<a href="<?php echo base_url(); ?>" class="btn btn-danger btn-rounded waves-effect waves-light mb-5">Back to home</a>
	</div>
</div>
<script src="<?php echo base_url(); ?>public/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo base_url(); ?>public/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
	$('[data-toggle="tooltip"]').tooltip();
	$(".preloader").fadeOut();
</script>
</body>
</html>