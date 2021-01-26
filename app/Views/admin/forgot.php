<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/cork/ltr/demo4/auth_pass_recovery_boxed.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 03 Apr 2020 07:20:08 GMT -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	<title>Password Recovery - <?=$config['sitename']?></title>
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

						<h1 class="">Password Recovery</h1>
						<p class="signup-link recovery">Enter your email and instructions will sent to you!</p>
						<form class="text-left" method="POST">
							<?php
								$session = session();
								if (!empty($session->emailsent)){
							?>
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									<strong>Check your email!</strong><ul><li> <?=$session->emailsent?></li></ul>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php
								}
								if (!empty($session->message)){
							?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<strong>Error!</strong><ul><li> <?=$session->message?></li></ul>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php
								}
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
								if (!empty($error)){
							?>
								<div class="alert alert-warning alert-dismissible fade show" role="alert">
									<strong>Failed!</strong><ul><li> <?=$error;?></li></ul>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php
								}
							?>
							<div class="form">

								<div id="email-field" class="field-wrapper input">
									<div class="d-flex justify-content-between">
										<label for="email">EMAIL</label>
									</div>
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
									<input id="email" name="email" type="text" class="form-control" value="" placeholder="Email">
								</div>

								<div class="d-sm-flex justify-content-between">

									<div class="field-wrapper">
										<button type="submit" class="btn btn-primary" value="">Reset</button>
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

<!-- Mirrored from designreset.com/cork/ltr/demo4/auth_pass_recovery_boxed.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 03 Apr 2020 07:20:08 GMT -->
</html>