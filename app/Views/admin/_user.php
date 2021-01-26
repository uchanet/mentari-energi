<link rel="stylesheet" href="<?= site_url() ?>assets/plugins/dropify/dropify.min.css">
<link rel="stylesheet" href="<?= site_url() ?>assets/admin/css/users/account-setting.css">
<link rel="stylesheet" href="<?= site_url() ?>assets/admin/css/forms/switches.css">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
	<div class="widget">
		<div class="widget-heading d-flex justify-content-between">
			<h5 class=""><?= $pagetitle ?></h5>
		</div>

		<div class="widget-content">
			<form method="post" enctype="multipart/form-data">
				<?php
				if ($validation->getErrors()) {
				?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error!</strong> <?= $validation->listErrors() ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php
				}
				if (!empty($emailExist) || !empty($usernameExist)) {
				?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error!</strong>
						<ul>
							<?php if (!empty($emailExist)) {
								echo "<li> " . $emailExist . "</li>";
							} ?>
							<?php if (!empty($usernameExist)) {
								echo "<li> " . $usernameExist . "</li>";
							} ?>
						</ul>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php
				}
				?>
				<input type="hidden" name="id" value="<?= ((!empty($id)) ? $id : NULL); ?>" />
				<div class="form-row mb-4">
					<div class="form-group col-md-12">
						<label for="name">Profile Picture</label>
						<input type="file" name="picture" id="input-file-max-fs" class="dropify" data-default-file="<?= site_url() ?>assets/images/profile/<?= ((!empty($_POST['picture'])) ? $_POST['picture'] : ((!empty($picture)) ? $picture : NULL)); ?>" data-max-file-size="2M" />
					</div>
					<div class="form-group col-md-6">
						<label for="name">Full Name</label>
						<input type="text" class="form-control" name="name" placeholder="Full Name" value="<?= ((!empty($_POST['name'])) ? $_POST['name'] : ((!empty($name)) ? $name : NULL)); ?>" required>
					</div>
					<div class="form-group col-md-6">
						<label for="username">Username</label>
						<input type="text" class="form-control" name="username" placeholder="Username" value="<?= ((!empty($_POST['username'])) ? $_POST['username'] : ((!empty($username)) ? $username : NULL)); ?>" required>
					</div>
					<div class="form-group col-md-6">
						<label for="email">Email</label>
						<input type="email" class="form-control" name="email" placeholder="Email" value="<?= ((!empty($_POST['email'])) ? $_POST['email'] : ((!empty($email)) ? $email : NULL)); ?>" required>
					</div>
					<div class="form-group col-md-6">
						<label for="password">Password</label>
						<input type="password" class="form-control" name="password" placeholder="Password" value="" <?= ((!empty($_POST['password'])) ? $_POST['password'] : ((!empty($password)) ? NULL : 'required')); ?>>
					</div>
					<div class="form-group col-md-6">
						<label for="bio">Biography</label>
						<input type="text" class="form-control" name="bio" placeholder="Biography" value="<?= ((!empty($_POST['bio'])) ? $_POST['bio'] : ((!empty($bio)) ? $bio : NULL)); ?>">
					</div>
					<div class="form-group col-md-6">
						<label for="facebook">Facebook</label>
						<input type="text" class="form-control" name="facebook" placeholder="Facebook" value="<?= ((!empty($_POST['facebook'])) ? $_POST['facebook'] : ((!empty($facebook)) ? $facebook : NULL)); ?>">
					</div>
					<div class="form-group col-md-6">
						<label for="twitter">Twitter</label>
						<input type="text" class="form-control" name="twitter" placeholder="Twitter" value="<?= ((!empty($_POST['twitter'])) ? $_POST['twitter'] : ((!empty($twitter)) ? $twitter : NULL)); ?>">
					</div>
					<?php
					if ($this->session->userrole == 1) {
						if ($this->session->userid !== isset($_GET['id'])) {
							if ($this->session->username !== isset($_GET['id'])) {
					?>
								<div class="form-group col-md-6">
									<label for="role">Role</label>
									<select name="role" class="custom-select" required>
										<?php
										$query = $this->db->query("select * from role order by id");
										if ((!empty($_POST['name'])) ? $_POST['name'] : ((!empty($name)) ? $name : NULL)) {
											echo "<option value=''>Select...</option>";
											foreach ($query->getResult() as $row) {
												if ((!empty($_POST['role'])) ? $_POST['role'] : ((!empty($role)) ? $role : NULL) == $row->id) {
													echo "<option value='" . $row->id . "' selected>" . $row->title . "</option>";
												} else {
													echo "<option value='" . $row->id . "'>" . $row->title . "</option>";
												}
											}
										} else {
											echo "<option value='' selected>Select...</option>";
											foreach ($query->getResult() as $row) {
												echo "<option value='" . $row->id . "'>" . $row->title . "</option>";
											}
										}
										?>
									</select>
								</div>
								<div class="form-group col-md-6">
									<label for="role">Active</label>
									<div class="col-lg-3 col-md-3 col-sm-4 col-6">
										<label class="switch s-icons s-outline  s-outline-primary my-2">
											<input name="active" type="checkbox" value="Y" <?= ((!empty($_POST['active']) == 'Y') ? "checked" : ((!empty($active) == 'Y') ? "checked" : NULL)); ?>>
											<span class="slider round"></span>
										</label>
									</div>
								</div>
					<?php
							}
						}
					}
					?>
				</div>
				<button type="submit" class="btn btn-primary">Save</button> <a href='<?= current_url() ?>' class="btn btn-outline-danger float-right">Cancel</a>
			</form>
		</div>
	</div>
</div>

<script src="<?= site_url() ?>assets/plugins/dropify/dropify.min.js"></script>
<script src="<?= site_url() ?>assets/plugins/blockui/jquery.blockUI.min.js"></script>
<script src="<?= site_url() ?>assets/admin/js/users/account-settings.js"></script>
<script>
	var exit = false;
	$("form").submit(function() {
		exit = true;
	})
	$(window).on("beforeunload", function() {
		if (!exit) {
			return "Are you sure? You didn't finish the form!";
		}
	})
</script>