<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/cork/ltr/demo4/auth_lockscreen_boxed.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 03 Apr 2020 07:20:08 GMT -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	<title>Password Recover - <?=$config['sitename']?></title>
	<link rel="icon" type="image/x-icon" href="<?=site_url()?>/assets/admin/img/favicon.ico"/>
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
	<link href="<?=site_url()?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=site_url()?>/assets/admin/css/plugins.css" rel="stylesheet" type="text/css" />
	<link href="<?=site_url()?>/assets/admin/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
	<!-- END GLOBAL MANDATORY STYLES -->
	<link rel="stylesheet" type="text/css" href="<?=site_url()?>/assets/admin/css/forms/theme-checkbox-radio.css">
	<link rel="stylesheet" type="text/css" href="<?=site_url()?>/assets/admin/css/forms/switches.css">
</head>
<body class="form no-image-content">
	

	<div class="form-container outer">
		<div class="form-form">
			<div class="form-form-wrap">
				<div class="form-container">
					<div class="form-content">

						<h1 class="">Create New Password</h1>

						<form class="text-left" method="post">
							<?php
								if ($_POST){
									if ($validation->getErrors()){
							?>
								<div class="alert alert-warning alert-dismissible fade show" role="alert">
									<strong>Failed to reset password!</strong> <?=$validation->listErrors()?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php
									}
								}
							?>
							<input type="hidden" name="code" value="<?=$_GET['code']?>">
							<div class="form">
								<div id="password-field" class="field-wrapper input mb-2">
									<div class="d-flex justify-content-between">
										<label for="password">NEW PASSWORD</label>
									</div>
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
									<input id="password" name="password" type="password" class="form-control" placeholder="New Password">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
								</div>
								
								
								<div id="password-field" class="field-wrapper input mb-2">
									<div class="d-flex justify-content-between">
										<label for="password">CONFIRM PASSWORD</label>
									</div>
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
									<input id="cpassword" name="cpassword" type="password" class="form-control" placeholder="Confirm Password">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-cpassword" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
								</div>
								<div class="d-sm-flex justify-content-between">
									<div class="field-wrapper">
										<button type="submit" class="btn btn-primary" value="">Change Password</button>
									</div>
								</div>

							</div>
						</form>

					</div>					
				</div>
			</div>
		</div>
	</div>

	
	<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
	<script src="<?=site_url()?>/assets/admin/js/libs/jquery-3.1.1.min.js"></script>
	<script src="<?=site_url()?>/assets/plugins/bootstrap/js/popper.min.js"></script>
	<script src="<?=site_url()?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	
	<!-- END GLOBAL MANDATORY SCRIPTS -->
	<script src="<?=site_url()?>/assets/admin/js/authentication/form-2.js"></script>

</body>

<!-- Mirrored from designreset.com/cork/ltr/demo4/auth_lockscreen_boxed.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 03 Apr 2020 07:20:08 GMT -->
</html>