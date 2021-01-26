<?php
	use App\Libraries\Library;
	use App\Models\Admin_model;
	$this->lib = new Library();
	$this->admin = new Admin_model();
	$this->session = session();
	$this->db = \Config\Database::connect();
	$this->request = \Config\Services::request();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	<title><?=$pagetitle?> - <?=$config['sitename']?></title>
	<link rel="icon" type="image/x-icon" href="<?=site_url()?>assets/images/<?=$config['siteicon']?>"/>

	<script src="<?=site_url()?>assets/admin/js/libs/jquery-3.1.1.min.js"></script>
	<script src="<?=site_url()?>assets/admin/js/loader.js"></script>

	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link rel="stylesheet" href="<?=site_url()?>assets/admin/css/loader.css">
	<link rel="stylesheet" href="<?=site_url()?>assets/admin/css/font.css">
	<link rel="stylesheet" href="<?=site_url()?>assets/plugins/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?=site_url()?>assets/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=site_url()?>assets/admin/css/plugins.css">
	<link rel="stylesheet" href="<?=site_url()?>assets/admin/css/dashboard/dash_1.css">
	<!-- END GLOBAL MANDATORY STYLES -->
	
	<!--  BEGIN CUSTOM STYLE FILE  -->
	<link rel="stylesheet" href="<?=site_url()?>assets/admin/css/custom.css">
	<!--  END CUSTOM STYLE FILE  -->
</head>
<body>
	<!-- BEGIN LOADER -->
	<div id="load_screen"> <div class="loader"> <div class="loader-content">
		<div class="spinner-grow align-self-center"></div>
	</div></div></div>
	<!--  END LOADER -->

	<!--  BEGIN NAVBAR  -->
	<div class="header-container fixed-top">
		<header class="header navbar navbar-expand-sm">

			<ul class="navbar-item theme-brand flex-row  text-center">
				<!--<li class="nav-item theme-logo">
					<a href="<?=site_url()?>admin">
						<img src="<?=site_url()?>assets/images/<?=$config['sitelogo']?>" class="navbar-logo" alt="logo">
					</a>
				</li>-->
				<li class="nav-item theme-text">
					<a href="<?=site_url()?>admin" class="nav-link"> <?=$config['sitename']?> </a>
				</li>
			</ul>

			<ul class="navbar-item flex-row ml-md-auto">

				<li class="nav-item dropdown message-dropdown">
					<a href="javascript:void(0);" class="nav-link dropdown-toggle" id="messageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
					</a>
					<div class="dropdown-menu p-0 position-absolute" aria-labelledby="messageDropdown">
						<div class="">
						<?php
							$query = $this->db->query("select * from contact where seen='N' order by date desc limit 3");
							if (empty($query->getResult())){
								echo "<div class='text-center'>Empty!</div>";
							} else {
							foreach ($query->getResult() as $row){
						?>
							<a href="<?=site_url()?>admin/contact" class="dropdown-item">
								<div class="">
									<div class="media">
										<div class="media-body">
											<div class="">
												<h5 class="usr-name"><?=$row->name?> (<?=$row->email?>)</h5>
												<p class="msg-title"><?=$row->subject?></p>
												<span><?=character_limiter(strip_tags($row->message), 50)?></span>
											</div>
										</div>
									</div>

								</div>
							</a>
						<?php }} ?>
						</div>
					</div>
				</li>

				<li class="nav-item dropdown notification-dropdown">
					<a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
					</a>
					<div class="dropdown-menu position-absolute" aria-labelledby="notificationDropdown">
						<div class="notification-scroll">
						<?php
							$query = $this->db->query("select * from post_comment join post on post_comment.post=post.id where seen='N' order by post_comment.date desc limit 3");
							if (empty($query->getResult())){
								echo "<div class='text-center'>Empty!</div>";
							} else {
							foreach ($query->getResult() as $row){
						?>
							<a href="<?=site_url()?>admin/comment">
								<div class="dropdown-item">
									<div class="media">
										<div class="media-body">
											<div class="notification-para"><span class="user-name"><?=$row->name?></span> comment on <?=$row->title?>.</div>
										</div>
									</div>
								</div>
							</a>
						<?php }} ?>
						</div>
					</div>
				</li>

				<li class="nav-item dropdown user-profile-dropdown">
					<a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<img src="<?=site_url()?>assets/images/profile/<?=$this->session->userpicture?>" alt="avatar">
					</a>
					<div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
						<div class="">
							<div class="dropdown-item">
							<a class="" href="<?=site_url()?>admin/profile">
								<div class="row">
									<div class="col-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
								</div>
									<div class="col-8" style="padding-left: 0;padding-riht: 0;">
										<?=$this->session->username?>
										<br>
										<?=$this->session->useremail?>
									</div>
								</div>
								</a>
							</div>
							<div class="dropdown-item">
								<a class="" href="<?=site_url()?>admin/profile?act=edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> Edit Profile</a>
							</div>
							<div class="dropdown-item">
								<a class="" href="<?=site_url()?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg> FrontEnd</a>
							</div>
							<div class="dropdown-item">
								<a class="" href="<?=site_url()?>admin/logout"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> Sign Out</a>
							</div>
						</div>
					</div>
				</li>

			</ul>
		</header>
	</div>
	<!--  END NAVBAR  -->

	<!--  BEGIN NAVBAR  -->
	<div class="sub-header-container">
		<header class="header navbar navbar-expand-sm">
			<a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

			<ul class="navbar-nav flex-row">
				<li>
					<div class="page-header">

						<nav class="breadcrumb-one" aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?=site_url()?>admin">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page"><span><?=$pagetitle?></span></li>
							</ol>
						</nav>

					</div>
				</li>
			</ul>
		</header>
	</div>
	<!--  END NAVBAR  -->

	<!--  BEGIN MAIN CONTAINER  -->
	<div class="main-container" id="container">

		<div class="overlay"></div>
		<div class="search-overlay"></div>

		<!--  BEGIN SIDEBAR  -->
		<div class="sidebar-wrapper sidebar-theme">

			<nav id="sidebar">
				<div class="shadow-bottom"></div>
				<ul class="list-unstyled menu-categories" id="accordionExample">
				<?php
					function rolemenu($data = null, $m, $k)
					{
						foreach($m as $value) {
							if ($value[0] == $data){
								if ($value[1][0] == $k){
									return true;
								}
							}
						}
					}

					$menu = $this->db->table('menu')->where('category', 1)->orderBy('sort', 'ASC');
					$main_menu = $menu->where('parent', 0)->get();
					$role = $this->admin->getData('role', $this->session->userrole)['permission'];
					foreach ($main_menu->getResult() as $main) {
						echo sub_menu($menu, $main, "menu", "", json_decode($role), $this->session->userrole);
					}
					
					function sub_menu($menu, $main, $class = '', $active = '', $x, $z){
						if (uri_string() == $main->link){
							$active = "aria-expanded='true' data-active='true'";
						}
						if ($menu->where('parent', $main->id)->countAllResults() > 0) {
							$sub_menu = $menu->where('parent', $main->id)->get();

							echo "<li class='$class'><a $active data-toggle='collapse' href='#m".$main->id."' class='dropdown-toggle'><div><i class='" . $main->icon . "'></i>" . $main->label . "</div><div><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-right'><polyline points='9 18 15 12 9 6'></polyline></svg></div></a>
									<ul class='collapse submenu list-unstyled' id='m".$main->id."' data-parent='#m".$main->id."'>";
							foreach ($sub_menu->getResult() as $sub) {
								if (rolemenu($sub->link, $x, $z)){
									echo sub_menu($menu, $sub, "", "", $x, $z);
								}
							}
							echo "</ul>
								</li>";
						} else {
							if (rolemenu($main->link, $x, $z)){
								echo "<li class='$class'><a $active aria-expanded='false' href='".site_url().$main->link."' class='dropdown-toggle' target='".$main->target."'><div><i class='" . $main->icon . "' aria-hidden='true'></i>" . $main->label . "</div></a></li>";
							}
						}
					}
				?>
				</ul>
			</nav>

		</div>
		<!--  END SIDEBAR  -->

		<!--  BEGIN CONTENT AREA  -->
		<div id="content" class="main-content">
			<div class="layout-px-spacing">

				<div class="row layout-top-spacing">

				<?php
					if (!empty($this->session->success)){
				?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Success!</strong><ul><li> <?=$this->session->success?></li></ul>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php
					}
					if (!empty($this->session->error)){
				?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Error!</strong><ul><li> <?=$this->session->error?></li></ul>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php
					}
				?>