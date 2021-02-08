<?php

use App\Libraries\Library;

$this->lib = new Library();
$this->session = session();
$this->db = \Config\Database::connect();
$this->request = \Config\Services::request();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title><?= $pagetitle ?> - <?= $config['sitename'] ?></title>
	<meta charset="UTF-8">
	<meta name="description" content="<?= (!empty($content) ? character_limiter(strip_tags($content)) : $config['sitedescription']) ?>">
	<meta name="keywords" content="<?= (!empty($tag) ? $tag : $config['sitetag']) ?>">
	<meta name="author" content="XqipCMS">
	<link href="<?= site_url() ?>assets/images/<?= $config['siteicon'] ?>" rel="shortcut icon">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<script src="<?= site_url() ?>assets/base/js/jquery.min.js"></script>
	<!-- <link href="<?= site_url() ?>assets/base/css/bootstrap.min.css" rel="stylesheet" type="text/css">  -->
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link href="<?= site_url() ?>assets/base/css/themify-icons.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?= site_url() ?>assets/plugins/fontawesome/css/all.min.css">
	<link href="<?= site_url() ?>assets/base/css/icomoon.css" rel="stylesheet" type="text/css">
	<link href="<?= site_url() ?>assets/base/css/plugins.css" rel="stylesheet" type="text/css">
	<link href="<?= site_url() ?>assets/base/css/animate.css" rel="stylesheet">
	<link href="<?= site_url() ?>assets/base/css/owl.carousel.css" rel="stylesheet">
	<link href="<?= site_url() ?>assets/base/css/rev-settings.css" rel="stylesheet">
	<link href="<?= site_url() ?>assets/base/css/styles-3.css" rel="stylesheet" type="text/css">
	<link href="<?= site_url() ?>assets/plugins/leaflet/leaflet.css" rel="stylesheet">
	<script src="<?= site_url() ?>assets/plugins/leaflet/leaflet.js"></script>
</head>

<body>
	<div id="preloader">
		<div class="lds-ellipsis">
			<div></div>
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>
	<!--<div class="hidden-md-down" id="top-bar">
			<div class="container">
				<div class="row">
					<div class="col-md-9 col-12">
						<ul class="top-bar-info">
							<li><a href="tel:<?= $config['sitephone'] ?>"><i class="fas fa-phone"></i> Phone: <?= $config['sitephone'] ?></a></li>
							<li><i class="fas fa-map-marker-alt"></i><?= $config['siteaddress'] ?></li>
							<li><a href="mailto:<?= $config['sitemail'] ?>"><i class="fa fa-envelope"></i>Email: <?= $config['sitemail'] ?></a></li>
						</ul>
					</div>
					<div class="col-md-3 col-12">
						<ul class="social-icons hidden-sm">
							<li>
								<a href="https://www.facebook.com/<?= $config['sitefacebook'] ?>"><i class="fab fa-facebook"></i></a>
							</li>
							<li>
								<a href="https://www.twitter.com/<?= $config['sitetwitter'] ?>"><i class="fab fa-twitter"></i></a>
							</li>
							<li>
								<a href="https://www.linkedin.com/in/<?= $config['sitelinkedin'] ?>"><i class="fab fa-linkedin"></i></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>-->
	<header id="nav-transparent">
		<nav class="container navigation" id="navigation4">
			<div class="nav-header">
				<a class="nav-brand" href="<?= site_url() ?>"><img alt="logo" class="main-logo" id="light_logo" src="<?= site_url() ?>assets/images/<?= $config['sitelogo'] ?>"> <img alt="logo" class="main-logo" id="main_logo" src="<?= site_url() ?>assets/images/<?= $config['sitelogo'] ?>"></a>
				<div class="nav-toggle"></div>
			</div>
			<div class="nav-menus-wrapper">
				<ul class="nav-menu align-to-right">
					<?php
					$menu = $this->db->table('menu')->where('category', 2)->orderBy('sort', 'ASC');
					$main_menu = $menu->where('parent', 0)->get();
					foreach ($main_menu->getResult() as $main) {
						echo sub_menu($menu, $main, "menu");
					}

					function sub_menu($menu, $main, $class = '', $active = '')
					{
						if ($menu->where('parent', $main->id)->countAllResults() > 0) {
							$sub_menu = $menu->where('parent', $main->id)->get();

							echo "<li><a href='" . site_url() . $main->link . "' target='" . $main->target . "'><i class='" . $main->icon . "'></i>" . $main->label . "</a>
									<ul class='nav-dropdown'>";
							foreach ($sub_menu->getResult() as $sub) {
								echo sub_menu($menu, $sub, "");
							}
							echo "</ul></li>";
						} else {
							echo "<li><a href='" . site_url() . $main->link . "' target='" . $main->target . "'><i class='" . $main->icon . "'></i>" . $main->label . "</a></li>";
						}
					}
					?>
				</ul>
			</div>
		</nav>
	</header>