<div class="breadcrumb-section jarallax pixels-bg" data-jarallax="" data-speed="0.6">
	<div class="container text-center">
		<h1>Blog List</h1>
		<ul>
			<li>
				<a href="index.html">Home</a>
			</li>
			<li>
				<a href="#">Pages</a>
			</li>
			<li>
				<a href="blog-list.html">Blog List</a>
			</li>
		</ul>
	</div>
</div>
<div class="section-block shadow-sm p-3 mb-5 bg-white rounded">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-12 col-12">
				<div class="section-heading text-left">
					<h4 class="semi-bold">Recent Post</h4>
					<div class="section-heading-line line-thin"></div>
				</div>
				<div class="cases-md">
					<div class="row mt-30">
						<?php

						use App\Models\Post;

						$post = new Post();
						$result = $post->orderBy('created', 'ASC')->where('active', 'Y')->paginate(5, 'blog');
						$pager = $post->orderBy('created', 'ASC')->where('active', 'Y')->pager;
						foreach ($result as $row) {
						?>
							<div class="col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="service-box-2">
									<div class="service-box-2-icon">
										<a href="blog/post/<?= $row['url'] ?>"><i class="fas fa-arrow-right"></i></a>
									</div><img alt="img" src="<?= site_url() ?>/assets/thumbs/<?= $row['picture'] ?>" onerror="this.onerror=null;this.src='<?= site_url() ?>assets/images/blank.png'">
									<div class="service-box-2-overlay">
										<div class="service-box-2-text">
											<h6><a href="blog/post/<?= $row['url'] ?>"><?= character_limiter(strip_tags($row['title']), 50) ?></a></h6>
											<h4><?= character_limiter(strip_tags($row['content']), 100) ?></h4>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="pagination mt-20 mb-20">
						<?= $pager->links('blog', 'bootstrap_pagination') ?>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-12 col-12">
				<?php include "blog_sidebar.php"; ?>
			</div>
		</div>
	</div>
</div>