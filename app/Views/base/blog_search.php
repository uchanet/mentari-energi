<div class="breadcrumb-section jarallax pixels-bg" data-jarallax="" data-speed="0.6">
	<div class="container text-center">
		<h1>Blog Search</h1>
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
<div class="section-block">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-12 col-12">
				<div class="section-heading text-left" style="margin-bottom:45px">
					<h4 class="semi-bold text-uppercase">Search Result</h4>
					<div class="section-heading-line line-thin"></div>
				</div>
				<div class="pl-30-md mt-15">
					<?php
					$uri = $this->request->uri->getSegment(3);

					use App\Models\Post;

					$post = new Post();
					$result = $post->like('content', $uri)->orLike('title', $uri)->orLike('tag', $uri)->orderBy('created', 'ASC')->paginate(5, 'search');
					$pager = $post->like('content', $uri)->orLike('title', $uri)->orLike('tag', $uri)->orderBy('created', 'ASC')->pager;
					if (empty($result)) {
						echo "Empty...";
					} else {
						foreach ($result as $row) {
					?>
							<div class="search-result">
								<a href="<?= site_url() ?>/blog/post/<?= $row['url'] ?>"><?= $row['title'] ?></a>
								<p><?= highlight_phrase(character_limiter(excerpt(strip_tags($row['content']), $uri), 200), $uri, '<b style="color:#990000;">', '</b>') ?></p>
							</div>
					<?php
						}
					}
					?>
					<div class="pagination mt-50 mb-20">
						<?= $pager->links('search', 'bootstrap_pagination') ?>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-12 col-12">
				<?php include "blog_sidebar.php"; ?>
			</div>
		</div>
	</div>
</div>