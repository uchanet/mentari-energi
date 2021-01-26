<div class="breadcrumb-section jarallax pixels-bg" data-jarallax="" data-speed="0.6">
	<div class="container text-center">
		<h1>Contact Us</h1>
		<ul>
			<li>
				<a href="/">Home</a>
			</li>
			<li>
				<a href="#"><?= $pagetitle ?></a>
			</li>
		</ul>
	</div>
</div>
<div class="section-block grey-bg">
	<div class="background-shape bs-right"></div>
	<div class="container ">
		<div class="row shadow p-3 mb-5 bg-white rounded">
			<div class="col-md-4 col-sm-4 col-12 ">
				<div class="section-heading">
					<h6 class="semi-bold">Visit our office at</h6>
					<ul class="grey-list mt-15">
						<li><i class="fa fa-map-marker-alt"></i> <?= $config['siteaddress'] ?></li>
					</ul>
					<div class="mt-40">
						<h6 class="semi-bold">Contact us</h6>
						<ul class="grey-list mt-15">
							<li><a href="tel:<?= $config['sitephone'] ?>"><i class="fa fa-phone"></i> <?= $config['sitephone'] ?></a></li>
							<li><a href="https://wa.me/<?= $config['sitephone'] ?>"><i class="fab fa-whatsapp"> <?= $config['sitephone'] ?></i></a></li>
							<li><a href="mailto:<?= $config['sitemail'] ?>"><i class="fa fa-envelope-open"></i> <?= $config['sitemail'] ?></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-8 col-sm-8 col-12">
				<div class="section-heading">
					<h6 class="semi-bold">Write us a message</h6>
				</div>
				<form class="primary-form-2 mt-15" method="post">
					<?php
					if ($this->session->message) {
					?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>Success!</strong> <?= $this->session->message ?>!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php
					}
					if ($message->getErrors()) {
					?>
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<strong>Failed to post a message!</strong> <?= $message->listErrors() ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php
					}
					?>
					<div class="row">
						<div class="col-sm-6 col-12">
							<input name="name" placeholder="Name*" type="text">
						</div>
						<div class="col-sm-6 col-12">
							<input name="email" placeholder="Email*" type="email">
						</div>
						<div class="col-12">
							<select name="subject">
								<!-- edit / tambah sesuai keperluan -->
								<option value="" selected>Subject...</option>
								<option value="Information">Information</option>
								<option value="Suggestion">Suggestion</option>
								<option value="Complaint">Complaint</option>
							</select>
						</div>
						<div class="col-12">
							<textarea name="message" placeholder="Your Message*"></textarea>
						</div>
					</div>
					<div class="row mt-15">
						<div class="col-sm-8">
							<div class="checkbox">
								<input id="checkbox_3" type="checkbox" required> <label for="checkbox_3">I’m not robot.</label>
							</div>
						</div>
						<div class="col-sm-4 text-right">
							<button class="button-md button-primary">Send Message</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div>

	<div id="mapid" style="height: 400px;"></div>
	<script>
		var mymap = L.map('mapid').setView([<?= $config['sitegeolocation'] ?>], 15);
		var marker = L.marker([<?= $config['sitegeolocation'] ?>]).addTo(mymap);
		marker.bindPopup("<b><?= $config['sitename'] ?></b><br><?= $config['siteaddress'] ?>").openPopup();

		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
			maxZoom: 18,
			attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
				'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
				'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
			id: 'mapbox/streets-v11',
			tileSize: 512,
			zoomOffset: -1
		}).addTo(mymap);
	</script>
</div>
<div class="section-block section-sm grey-bg">
	<div class="container">
		<div class="owl-carousel owl-theme clients clients-carousel">
			<?php
			$query = $this->db->table('client')->get();
			foreach ($query->getResult() as $row) {
			?>
				<div class="item"><img alt="partner-image" src="<?= site_url() ?>assets/images/client/<?= $row->picture ?>" title="<?= $row->title ?>"></div>
			<?php } ?>
		</div>
	</div>
</div>