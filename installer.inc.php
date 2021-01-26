<?php

	$minPHPVersion = '7.2';
	if (phpversion() < $minPHPVersion)
	{
		die("Your PHP version must be {$minPHPVersion} or higher to run CodeIgniter. Current version: " . phpversion());
	}
	unset($minPHPVersion);

	set_time_limit(120);

	if ($_POST){
		$file = fopen(".env", "w") or die("Unable to open file!");
		$content = "#--------------------------------------------------------------------
# Example Environment Configuration file
#
# This file can be used as a starting point for your own
# custom .env files, and contains most of the possible settings
# available in a default install.
#
# By default, all of the settings are commented out. If you want
# to override the setting, you must un-comment it by removing the '#'
# at the beginning of the line.
#--------------------------------------------------------------------

#--------------------------------------------------------------------
# ENVIRONMENT
#--------------------------------------------------------------------

CI_ENVIRONMENT = development

#--------------------------------------------------------------------
# APP
#--------------------------------------------------------------------

app.baseURL = '".$_POST['url']."'
# app.forceGlobalSecureRequests = false

# app.sessionDriver = 'CodeIgniter\Session\Handlers\FileHandler'
# app.sessionCookieName = 'ci_session'
# app.sessionSavePath = NULL
# app.sessionMatchIP = false
# app.sessionTimeToUpdate = 300
# app.sessionRegenerateDestroy = false

# app.cookiePrefix = ''
# app.cookieDomain = ''
# app.cookiePath = '/'
# app.cookieSecure = false
# app.cookieHTTPOnly = false

# app.CSRFProtection  = false
# app.CSRFTokenName   = 'csrf_test_name'
# app.CSRFCookieName  = 'csrf_cookie_name'
# app.CSRFExpire      = 7200
# app.CSRFRegenerate  = true
# app.CSRFExcludeURIs = []

# app.CSPEnabled = false

#--------------------------------------------------------------------
# DATABASE
#--------------------------------------------------------------------

database.default.hostname = ".$_POST['dbhost']."
database.default.database = ".$_POST['dbname']."
database.default.username = ".$_POST['dbuser']."
database.default.password = ".$_POST['dbpass']."
database.default.DBDriver = MySQLi

# database.tests.hostname = localhost
# database.tests.database = ci4
# database.tests.username = root
# database.tests.password = root
# database.tests.DBDriver = MySQLi

#--------------------------------------------------------------------
# CONTENT SECURITY POLICY
#--------------------------------------------------------------------

# contentsecuritypolicy.reportOnly = false
# contentsecuritypolicy.defaultSrc = 'none'
# contentsecuritypolicy.scriptSrc = 'self'
# contentsecuritypolicy.styleSrc = 'self'
# contentsecuritypolicy.imageSrc = 'self'
# contentsecuritypolicy.base_uri = null
# contentsecuritypolicy.childSrc = null
# contentsecuritypolicy.connectSrc = 'self'
# contentsecuritypolicy.fontSrc = null
# contentsecuritypolicy.formAction = null
# contentsecuritypolicy.frameAncestors = null
# contentsecuritypolicy.mediaSrc = null
# contentsecuritypolicy.objectSrc = null
# contentsecuritypolicy.pluginTypes = null
# contentsecuritypolicy.reportURI = null
# contentsecuritypolicy.sandbox = false
# contentsecuritypolicy.upgradeInsecureRequests = false

#--------------------------------------------------------------------
# HONEYPOT
#--------------------------------------------------------------------

#  honeypot.hidden = 'true'
#  honeypot.label = 'Fill This Field'
#  honeypot.name = 'honeypot'
#  honeypot.template = '<label>{label}</label><input type=\"text\" name=\"{name}\" value=\"\"/>'";

		$con = @new mysqli($_POST['dbhost'],$_POST['dbuser'],$_POST['dbpass'],$_POST['dbname']);

		if ($con->connect_errno) {
			echo "Failed to connect to MySQL: " . $con->connect_errno;
			echo "<br/>Error: " . $con->connect_error;
		}

		$templine = '';
		$lines = file('assets/ci4.sql');
		foreach ($lines as $line) {
			if (substr($line, 0, 2) == '--' || $line == '')
				continue;

			$templine .= $line;
			if (substr(trim($line), -1, 1) == ';') {
				$con->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . $con->error() . '<br /><br />');
				$templine = '';
			}
		}


		fwrite($file, $content);
		fclose($file);
		rename("index.php","installer.inc.php");
		rename("index.inc.php","index.php");
		header("Location: /");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	<title>Installer | XqipCMS</title>
	<link rel="icon" type="image/x-icon" href="assets/admin/img/favicon.ico"/>
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/admin/css/plugins.css" rel="stylesheet" type="text/css" />
	<!-- END GLOBAL MANDATORY STYLES -->
	
	<!--  BEGIN CUSTOM STYLE FILE  -->
	<link href="assets/admin/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/jquery-step/jquery.steps.css">
	<style>
		#formValidate .wizard > .content {min-height: 25em;}
		#example-vertical.wizard > .content {min-height: 24.5em;}
	</style>
	<!--  END CUSTOM STYLE FILE  -->
</head>
<body data-spy="scroll" data-target="#navSection" data-offset="100">

	<!--  BEGIN MAIN CONTAINER  -->
	<div class="main-container" id="container">

		<div class="overlay"></div>
		<div class="search-overlay"></div>

		<!--  BEGIN CONTENT AREA  -->
		<div class="container mt-5">
				<div class="container" style="max-width: 600px;">

					<div class="row" id="cancel-row">

						<div class="col-lg-12 layout-spacing">
							<div class="statbox widget box box-shadow">
								<div class="widget-header">
									<div class="row">
										<div class="col-xl-12 col-md-12 col-sm-12 col-12">
											<h4>XqipCMS Installer</h4>
										</div>
									</div>
								</div>
								<div class="widget-content widget-content-area">
									<form method="post">
									<div id="example-basic">
										<h3>Basic</h3>
										<section>
											<div class="form-group">
												<label for="url">Site URL</label>
												<input type="text" class="form-control" name="url" placeholder="Site URL" value="<?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]".str_replace('/install.php', '', $_SERVER['REQUEST_URI'])?>">
											</div>
										</section>
										<h3>Database</h3>
										<section>
											<div class="form-group">
												<label for="url">Database Host</label>
												<input type="text" class="form-control" name="dbhost" placeholder="Database Host" value="localhost">
											</div>
											<div class="form-group">
												<label for="url">Database User</label>
												<input type="text" class="form-control" name="dbuser" placeholder="Database User">
											</div>
											<div class="form-group">
												<label for="url">Database Password</label>
												<input type="text" class="form-control" name="dbpass" placeholder="Database Password">
											</div>
											<div class="form-group">
												<label for="url">Database Name</label>
												<input type="text" class="form-control" name="dbname" placeholder="Database Name">
											</div>
										</section>
									</div>
									</form>
								</div>
							</div>
						</div>

					</div>

				</div>
			</div>
			<div class="footer-wrapper">
				<div class="footer-section f-section-1">
					<p class="">Copyright © <?=date('Y')?> <a target="_blank" href="https://www.xqip.net">Xqip</a>, All rights reserved.</p>
				</div>
				<div class="footer-section f-section-2">
					<p class="">Codeigniter 4.0.4</p>
				</div>
			</div>

		<!--  END CONTENT AREA  -->
	</div>
	<!-- END MAIN CONTAINER -->

	<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
	<script src="assets/admin/js/libs/jquery-3.1.1.min.js"></script>
	<script src="assets/plugins/bootstrap/js/popper.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="assets/admin/js/app.js"></script>

	<script>
		$(document).ready(function() {
			$('a[href="#finish"]').click(function(){
				$('form').submit();
			})
			App.init();
		});
	</script>
	<script src="assets/plugins/highlight/highlight.pack.js"></script>
	<script src="assets/admin/js/custom.js"></script>
	<!-- END GLOBAL MANDATORY SCRIPTS -->

	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="assets/admin/js/scrollspyNav.js"></script>
	<script src="assets/plugins/jquery-step/jquery.steps.min.js"></script>
	<script src="assets/plugins/jquery-step/custom-jquery.steps.js"></script>
	<!-- END PAGE LEVEL SCRIPTS -->	
</body>
</html>