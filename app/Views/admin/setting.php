<link rel="stylesheet" href="<?= site_url() ?>assets/plugins/flatpickr/flatpickr.css">
<link rel="stylesheet" href="<?= site_url() ?>assets/plugins/flatpickr/custom-flatpickr.css">
<link rel="stylesheet" href="<?= site_url() ?>assets/admin/css/forms/switches.css">
<link rel="stylesheet" href="<?= site_url() ?>assets/plugins/tags/tags.css">
<script src="<?= site_url() ?>assets/plugins/tags/tags.js"></script>

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
	<div class="widget">
		<div class="widget-heading d-flex justify-content-between">
			<h5 class=""><?= $pagetitle ?></h5>
		</div>

		<div class="widget-content">
			<form method="post" enctype="multipart/form-data">
				<ul class="nav nav-tabs mb-3 mt-3" id="simpletab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="contact-tab" data-toggle="tab" href="#config" role="tab" aria-controls="contact" aria-selected="false">Mail</a>
					</li>
				</ul>
				<div class="tab-content mb-4" id="simpletabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="sitename">Site Name</label>
								<input type="text" class="form-control" name="sitename" placeholder="Site Name" value="<?= (!empty($sitename)) ? $sitename : NULL; ?>" required>
							</div>
							<div class="form-group col-md-6">
								<label for="sitemaintenance">Site Maintenance</label>
								<div class="row">
									<div class="col-3">
										<div class="ml-2 mt-2">
											<label class="switch s-icons s-outline  s-outline-primary">
												<input id="sitemaintenance" type="checkbox" class="form-control" name="sitemaintenance" value="Y" <?= (!empty($sitemaintenance == 'Y')) ? "checked" : NULL; ?>>
												<span class="slider round"></span>
											</label>
										</div>
									</div>
									<div class="col-9">
										<input type="text" class="form-control flatpickr flatpickr-input active" id="sitemaintenancedate" name="sitemaintenancedate" placeholder="Select Date.." value="<?= (!empty($sitemaintenancedate)) ? $sitemaintenancedate : NULL; ?>">
									</div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label for="sitedescription">Site Description</label>
								<textarea type="text" class="form-control" name="sitedescription" placeholder="Site Description" required><?= (!empty($sitedescription)) ? $sitedescription : NULL; ?></textarea>
							</div>
							<div class="form-group col-md-6">
								<label for="sitetag">Site Tag</label>
								<input type="text" class="form-control" name="sitetag" placeholder="Site Tag" data-role="tagsinput" value="<?= (!empty($sitetag)) ? $sitetag : NULL; ?>" required></input>
							</div>
							<div class="form-group col-md-6">
								<label for="siteicon">Site Icon</label>
								<div class="custom-file mb-3">
									<input type="file" class="custom-file-input" name="siteicon" id="siteiconlabel">
									<label class="custom-file-label" for="siteiconlabel"><?= (!empty($siteicon)) ? $siteicon : "Choose file"; ?></label>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label for="sitelogo">Site Logo</label>
								<div class="custom-file mb-3">
									<input type="file" class="custom-file-input" name="sitelogo" id="sitelogolabel">
									<label class="custom-file-label" for="sitelogolabel"><?= (!empty($sitelogo)) ? $sitelogo : "Choose file"; ?></label>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="sitemail">Site Email</label>
								<input type="text" class="form-control" name="sitemail" placeholder="Site Email" value="<?= (!empty($sitemail)) ? $sitemail : NULL; ?>" required>
							</div>
							<div class="form-group col-md-6">
								<label for="sitephone">Site Phone</label>
								<input type="text" class="form-control" name="sitephone" placeholder="Site Phone" value="<?= (!empty($sitephone)) ? $sitephone : NULL; ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="sitetag">Site Address</label>
								<input type="text" class="form-control" name="siteaddress" placeholder="Site Address" value="<?= (!empty($siteaddress)) ? $siteaddress : NULL; ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="sitegeolocation">Site Geolocation</label>
								<input type="text" class="form-control" name="sitegeolocation" placeholder="Site Geolocation" value="<?= (!empty($sitegeolocation)) ? $sitegeolocation : NULL; ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="sitefacebook">Site Facebook</label>
								<input type="text" class="form-control" name="sitefacebook" placeholder="Site Facebook" value="<?= (!empty($sitefacebook)) ? $sitefacebook : NULL; ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="siteinstagram">Site Instagram</label>
								<input type="text" class="form-control" name="siteinstagram" placeholder="Site siteinstagram" value="<?= (!empty($siteinstagram)) ? $siteinstagram : NULL; ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="sitetwitter">Site Twitter</label>
								<input type="text" class="form-control" name="sitetwitter" placeholder="Site Twitter" value="<?= (!empty($sitetwitter)) ? $sitetwitter : NULL; ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="sitelinkedin">Site Linkedin</label>
								<input type="text" class="form-control" name="sitelinkedin" placeholder="Site Linkedin" value="<?= (!empty($sitelinkedin)) ? $sitelinkedin : NULL; ?>">
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="config" role="tabpanel" aria-labelledby="contact-tab">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="smtphost">SMTP Host</label>
								<input type="text" class="form-control" name="smtphost" placeholder="SMTP Host" value="<?= (!empty($smtphost)) ? $smtphost : NULL; ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="smtpport">SMTP Port</label>
								<input type="text" class="form-control" name="smtpport" placeholder="SMTP Port" value="<?= (!empty($smtpport)) ? $smtpport : NULL; ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="smtpuser">SMTP User</label>
								<input type="text" class="form-control" name="smtpuser" placeholder="SMTP User" value="<?= (!empty($smtpuser)) ? $smtpuser : NULL; ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="smtppassword">SMTP Password</label>
								<input type="text" class="form-control" name="smtppassword" placeholder="SMTP Password" value="<?= (!empty($smtppassword)) ? $smtppassword : NULL; ?>">
							</div>
						</div>
					</div>
				</div>
				<button id="submit" type="submit" class="btn btn-primary mt-3">Save</button>
			</form>
		</div>
	</div>
</div>

<script src="<?= site_url() ?>assets/plugins/flatpickr/flatpickr.js"></script>
<script>
	$('#submit').click(function() {
		$('input:invalid').each(function() {
			// Find the tab-pane that this element is inside, and get the id
			var $closest = $(this).closest('.tab-pane');
			var id = $closest.attr('id');

			// Find the link that corresponds to the pane and have it show
			$('.nav a[href="#' + id + '"]').tab('show');

			// Only want to do it once
			return false;
		});
	});
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	})
	flatpickr("#sitemaintenancedate", {
		enableTime: true,
		dateFormat: "Y-m-d H:i",
	});
</script>