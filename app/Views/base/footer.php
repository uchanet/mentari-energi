<footer>
	<div class="footer-1">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-4 col-12">
					<a href="#"><img alt="logo" id="footer_logo" src="<?= site_url() ?>assets/images/<?= $config['sitelogo'] ?>"></a>
					<p class="mt-20"><?= $config['sitedescription'] ?></p>
					<ul class="social-links-footer">
						<li>
							<a href="https://www.facebook.com/<?= $config['sitefacebook'] ?>"><i class="fab fa-facebook"></i></a>
						</li>
						<li>
							<a href="https://www.twitter.com/<?= $config['sitetwitter'] ?>"><i class="fab fa-twitter"></i></a>
						</li>
						<li>
							<a href="https://www.instagram.com/<?= $config['siteinstagram'] ?>"><i class="fab fa-instagram"></i></a>
						</li>
						<li>
							<a href="https://www.linkedin.com/in/<?= $config['sitelinkedin'] ?>"><i class="fab fa-linkedin"></i></a>
						</li>
						<li>
							<a href="https://wa.me/<?= $config['sitephone'] ?>"><i class="fab fa-whatsapp"></i></a>
						</li>
					</ul>
				</div>
				<div class="col-md-4 col-sm-4 col-12">
					<h2>Extra Links</h2>
					<div class="row mt-25">
						<div class="col-md-6 col-sm-6">
							<ul class="footer-nav">
								<li>
									<a href="#">Link 1</a>
								</li>
								<li>
									<a href="#">Link 2</a>
								</li>
								<li>
									<a href="#">Link 3</a>
								</li>
							</ul>
						</div>
						<div class="col-md-6 col-sm-6">
							<ul class="footer-nav">
								<li>
									<a href="#">Link 4</a>
								</li>
								<li>
									<a href="#">Link 5</a>
								</li>
								<li>
									<a href="#">Link 6</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-12">
					<h2>Recent news</h2>
					<ul class="footer-news mt-25">
						<?php
						$query = $this->db->table('post')->where('active', 'Y')->orderBy('created', 'desc')->limit(2)->get();
						foreach ($query->getResult() as $row) {
						?>
							<li>
								<a href="<?= site_url() ?>blog/post/<?= $row->url ?>"><?= character_limiter(strip_tags($row->title), 60) ?></a> <strong><i class="fa fa-calendar"></i> <?= date("d M Y H:i", strtotime($row->created)) ?></strong>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="footer-1-bar">
				<p><?= COPYRIGHT ?> © <?= date('Y') ?>. All Rights Reserved.</p>
			</div>
		</div>
	</div>
</footer><a class="scroll-to-top" href="#"><i class="fas fa-chevron-up"></i></a>
<script src="<?= site_url() ?>assets/base/js/plugins.js"></script>
<script src="<?= site_url() ?>assets/base/js/Chart.bundle.js"></script>
<script src="<?= site_url() ?>assets/base/js/utils.js"></script>
<script src="<?= site_url() ?>assets/base/js/navigation.js"></script>
<script src="<?= site_url() ?>assets/base/js/navigation.fixed.js"></script>
<script src="<?= site_url() ?>assets/base/js/rev-slider/jquery.themepunch.tools.min.js"></script>
<script src="<?= site_url() ?>assets/base/js/rev-slider/jquery.themepunch.revolution.min.js"></script>
<script src="<?= site_url() ?>assets/base/js/rev-slider/revolution.extension.actions.min.js"></script>
<script src="<?= site_url() ?>assets/base/js/rev-slider/revolution.extension.carousel.min.js"></script>
<script src="<?= site_url() ?>assets/base/js/rev-slider/revolution.extension.kenburn.min.js"></script>
<script src="<?= site_url() ?>assets/base/js/rev-slider/revolution.extension.layeranimation.min.js"></script>
<script src="<?= site_url() ?>assets/base/js/rev-slider/revolution.extension.migration.min.js"></script>
<script src="<?= site_url() ?>assets/base/js/rev-slider/revolution.extension.parallax.min.js"></script>
<script src="<?= site_url() ?>assets/base/js/rev-slider/revolution.extension.navigation.min.js"></script>
<script src="<?= site_url() ?>assets/base/js/rev-slider/revolution.extension.slideanims.min.js"></script>
<script src="<?= site_url() ?>assets/base/js/rev-slider/revolution.extension.video.min.js"></script>
<script src="<?= site_url() ?>assets/base/js/main.js"></script>
<!-- JavaScript Bundle with Popper -->

<!-- bootstrap  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>