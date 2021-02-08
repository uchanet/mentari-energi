<div class="breadcrumb-section jarallax pixels-bg" data-jarallax="" data-speed="0.6">
	<div class="container text-center">
		<h1>Team</h1>
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
<div class="section-block">
	<div class="container shadow p-3 mb-5 bg-white rounded">
		<div class="section-heading text-center">
			<small class="primary-color">Team</small>
			<h3 class="semi-bold mt-0">Our Team</h3>
			<div class="section-heading-line line-thin"></div>
		</div>
		<div class="row ">
			<?php
			$query = $this->db->table('user')->join('role', 'user.role = role.id')->where('role=3')->get();
			foreach ($query->getResult() as $row) {
			?>
				<div class="col-md-3 col-sm-6 " style=" border: 1px solid;border-radius: 1em; margin: 15px;">
					<div class="team-box-2">
						<img alt="" class="circled-border"  src="<?= site_url() ?>assets/images/profile/<?= $row->picture ?>">
						<div class="team-box-2-info">
							<h4><?= $row->name ?></h4>
							<h6><?= $row->bio ?></h6>
							<ul class="team-box-2-icon">
								<li>
									<a href="https://www.facebook.com/<?= $row->facebook ?>"><i class="fab fa-facebook-f"></i></a>
								</li>
								<li>
									<a href="https://ww.twitter.com/<?= $row->twitter ?>"><i class="fab fa-twitter"></i></a>
								</li>
								<li>
									<a href="mailto:<?= $row->email ?>"><i class="fa fa-envelope"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
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