<div class="breadcrumb-section jarallax pixels-bg" data-jarallax="" data-speed="0.6">
	<div class="container text-center">
		<h1><?= $title ?></h1>
		<ul>
			<li>
				<a href="/">Home</a>
			</li>
			<li>
				<a href="#">Page</a>
			</li>
			<li>
				<a href="#"><?= $title ?></a>
			</li>
		</ul>
	</div>
</div>
<div class="section-block">
	<div class="container shadow-lg p-3 mb-5 bg-white rounded">
		<div class="row">
			<div class="col-md-10 col-sm-12 col-12 offset-md-1">
				<div class="blog-list">
					<img class="mb-4" alt="img" src="<?= site_url() ?>/assets/uploads/<?= $picture ?>">
					<p class="mt-25"><?= $content ?></p>
				</div>
			</div>
		</div>
	</div>
</div>