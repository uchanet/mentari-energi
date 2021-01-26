<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	<title>Login - <?=$config['sitename']?></title>
	<link rel="icon" type="image/x-icon" href="<?=site_url()?>/assets/admin/img/favicon.ico"/>

	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,600,700">
	<link rel="stylesheet" href="<?=site_url()?>/assets/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=site_url()?>/assets/admin/css/plugins.css">
	<link rel="stylesheet" href="<?=site_url()?>/assets/admin/css/authentication/form-2.css">
	<!-- END GLOBAL MANDATORY STYLES -->

	<link rel="stylesheet" href="<?=site_url()?>/assets/admin/css/forms/theme-checkbox-radio.css">
	<link rel="stylesheet" href="<?=site_url()?>/assets/admin/css/forms/switches.css">
</head>
<body class="form">

	<div class="form-container outer">
		<div class="form-form">
			<div class="form-form-wrap">
				<div class="form-container">
					<div class="form-content">

						<h1 class="">Sign In</h1>
						<p class="">Log in to your account to continue.</p>

						<form class="text-left" method="post">
							<?php
								$session = session();
								if (!empty($session->newpassword)){
							?>
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									<strong>Success!</strong><ul><li> <?=$session->newpassword?></li></ul>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php
								}
								if ($validation->getErrors()){
							?>
								<div class="alert alert-warning alert-dismissible fade show" role="alert">
									<strong>Failed to login!</strong> <?=$validation->listErrors()?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php
								}
								if (!empty($error)){
							?>
								<div class="alert alert-warning alert-dismissible fade show" role="alert">
									<strong>Failed to login!</strong><ul><li> <?=$error;?></li></ul>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php
								}
							?>
							<div class="form">

								<div id="username-field" class="field-wrapper input">
									<label for="username">USERNAME</label>
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
									<input id="username" name="username" type="text" class="form-control" placeholder="e.g John_Doe" tabindex="1">
								</div>

								<div id="password-field" class="field-wrapper input mb-2">
									<div class="d-flex justify-content-between">
										<label for="password">PASSWORD</label>
										<a href="forgot" class="forgot-pass-link">Forgot Password?</a>
									</div>
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
									<input id="password" name="password" type="password" class="form-control" placeholder="Password" tabindex="2">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
								</div>
								<div class="d-sm-flex justify-content-between">
									<div class="field-wrapper">
										<button type="submit" class="btn btn-primary" value="" tabindex="3">Log In</button>
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
</html>