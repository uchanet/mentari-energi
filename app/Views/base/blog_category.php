<div class="breadcrumb-section jarallax pixels-bg" data-jarallax="" data-speed="0.6">
	<div class="container text-center">
		<h1>Blog Category</h1>
		<ul>
			<li>
				<a href="<?= site_url() ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url() ?>blog">Blog</a>
			</li>
			<li>
				<a href="javascript:void(0)"><?= $pagetitle ?></a>
			</li>
		</ul>
	</div>
</div>
<div class="section-block ">
	<div class="container shadow p-3 mb-5 bg-white rounded">
		<div class="row">
			<div class="col-md-9 col-sm-12 col-12">
				<div class="section-heading text-left" style="margin-bottom:45px">
					<h4 class="semi-bold text-uppercase">Category : <?= $this->request->uri->getSegment(3) ?></h4>
					<div class="section-heading-line line-thin"></div>
				</div>
				<div class="row ">
					<?php
					$uri = $this->request->uri->getSegment(3);

					use App\Models\Post;

					$post = new Post();
					$result = $post->select('post.*')->join('post_category', 'post.category = post_category.id')->where('post_category.url', $uri)->where('post.active', 'Y')->orderBy('created', 'ASC')->paginate(5, 'category');
					$pager = $post->select('post.*')->join('post_category', 'post.category = post_category.id')->where('post_category.url', $uri)->where('post.active', 'Y')->orderBy('created', 'ASC')->pager;
					if (empty($result)) {
						echo "Empty...";
					} else {
						foreach ($result as $row) {
					?>
							<div class="col-md-6 col-sm-6 col-12">
								<div class="blog-grid">
									<a href="<?= site_url() ?>blog/post/<?= $row['url'] ?>"><img alt="blog" src="<?= site_url() ?>/assets/thumbs/<?= $row['picture'] ?>" onerror="this.onerror=null;this.src='<?= site_url() ?>assets/images/blank.png'"></a>
									<div class="blog-team-box">
										<h6><?= date("d M Y H:i", strtotime($row['created'])) ?></h6>
									</div>
									<h4><a href="<?= site_url() ?>blog/post/<?= $row['url'] ?>"><?= character_limiter(strip_tags($row['title']), 60) ?></a></h4>
									<p><?= character_limiter(strip_tags($row['content']), 100) ?></p><a class="button-simple-primary mt-20" href="<?= site_url() ?>blog/post/<?= $row['url'] ?>">Read More <i class="fas fa-arrow-right"></i></a>
								</div>
							</div>
					<?php }
					} ?>
				</div>
				<div class="pagination mt-20 mb-20">
					<?= $pager->links('category', 'bootstrap_pagination') ?>
				</div>
			</div>
			<div class="col-md-3 col-sm-12 col-12">
				<?php include "blog_sidebar.php"; ?>
			</div>
		</div>
	</div>
</div>