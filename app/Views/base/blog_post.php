<div class="breadcrumb-section jarallax pixels-bg" data-jarallax="" data-speed="0.6">
	<div class="container text-center">
		<h1>Blog Post</h1>
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
	<div class="container ">
		<div class="row ">
			<div class="col-md-9 col-sm-12 col-12 ">
				<div class="blog-list shadow p-3 mb-5 bg-white rounded">
					<img alt="img" src="<?= site_url() ?>/assets/uploads/<?= $picture ?>" onerror="this.onerror=null;this.src='<?= site_url() ?>assets/images/blank.png'">
					<h4><a href="#"><?= $title ?></a></h4>
					<ul class="blog-list-info">
						<li><i class="ti-user"></i><span><?= $this->lib->getAuthor($author) ?></span></li>
						<li><i class="ti-calendar"></i><span><?= date("d M Y H:i", strtotime($created)) ?></span></li>
						<li><i class="ti-pin-alt"></i><span><?= $this->lib->getCategory($category) ?></span></li>
					</ul>
					<p class="mt-25"><?= $content ?></p>
					<div class="recent-post-tags mt-20">
						<?php
						$tags = explode(',', implode(',', array_unique(array_filter(explode(',', $tag)))));
						$total = count($tags);
						for ($i = 0; $i < $total; $i++) {
						?>
							<a class="button-tag semi-rounded" href="<?= site_url() ?>blog/tag/<?= $tags[$i] ?>"><?= humanize($tags[$i], '-') ?></a>
						<?php
						}
						?>
					</div>
					<div id="comment" class="blog-comments mt-50">
						<h3 class="blog-widget-title">All Comments</h3>
						<?php

						use App\Models\Comment;

						$comment = new Comment();
						$result = $comment->where('post', $id)->where('parent', 0)->orderBy('id', 'ASC')->paginate(5, 'comment');
						$pager = $comment->where('post', $id)->where('parent', 0)->orderBy('id', 'ASC')->pager;
						if ($result) {
							foreach ($result as $row) {
						?>
								<div class="blog-comment-user">
									<div class="row">
										<div class="col-md-1 hidden-sm-down pr-0"><img alt="user" src="<?= site_url() ?>assets/images/comment.png"></div>
										<div class="col-md-11 col-xs-12">
											<div class="comment-block clearfix">
												<h6><?= $row['name'] ?></h6><strong><a href="#reply" onclick="reply(<?= $row['id'] ?>)">Reply</a></strong>
												<p><?= $row['message'] ?></p>
												<p><small><?= date("d M Y H:i", strtotime($row['date'])); ?></small></p>
											</div>
										</div>
									</div>
									<?php
									$query = $this->db->table('post_comment')->where('parent', $row['id'])->get();
									foreach ($query->getResultArray() as $parent) {
									?>
										<div class="blog-comment-user ml-5">
											<div class="row">
												<div class="col-md-1 hidden-sm-down pr-0"><img alt="user" src="<?= site_url() ?>assets/images/comments.png"></div>
												<div class="col-md-11 col-xs-12">
													<div class="comment-block clearfix">
														<h6><?= $parent['name'] ?></h6><strong><a href="#reply" onclick="reply(<?= $row['id'] ?>)">Reply</a></strong>
														<p><?= $parent['message'] ?></p>
														<p><small><?= date("d M Y H:i", strtotime($parent['date'])); ?></small></p>
													</div>
												</div>
											</div>
										</div>
									<?php
									}
									?>
								</div>


						<?php
							}
						} else {
							echo "<p>No Comments</p>";
						}
						?>
						<div class="pagination mt-20 mb-20">
							<?= $pager->links('comment', 'bootstrap_pagination') ?>
						</div>
						<h3 id="reply" class="blog-widget-title">Your Comment</h3>
						<form method="post" class="primary-form-3 mt-20">
							<?php
							if (isset($this->session->message)) {
							?>
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									<ul><strong>Success!</strong>
										<li><?= $this->session->message ?></li>
									</ul>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php
							}
							if ($message->getErrors()) {
							?>
								<div class="alert alert-warning alert-dismissible fade show" role="alert">
									<strong>Failed to post a comment!</strong> <?= $message->listErrors() ?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php
							}
							?>
							<div class="row">
								<input name="id" type="hidden" value="<?= $id ?>">
								<input name="parent" type="hidden" value="">
								<?php
								if (!isset($this->session->username) && !isset($this->session->useremail)) {
								?>
									<div class="col-md-6 col-sm-6 col-12">
										<input name="name" placeholder="Name *" type="text">
									</div>
									<div class="col-md-6 col-sm-6 col-12">
										<input name="email" placeholder="E-mail *" type="email">
									</div>
								<?php
								}
								?>
								<div class="col-md-12">
									<textarea name="message" placeholder="Message *"></textarea>
								</div>
							</div>
							<div class="row mt-15">
								<div class="col-6">
									<div class="checkbox">
										<input id="checkbox_3" type="checkbox" required> <label for="checkbox_3">I’m not robot.</label>
									</div>
								</div>
								<div class="col-6 text-right">
									<button type="submit" class="button-sm button-primary">Post Comment</button>
								</div>
							</div>
							<script>
								function reply(id) {
									$('input[name="parent"').val(id);
								}
							</script>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-12 col-12 shadow-sm p-3 mb-5 bg-white rounded">
				<?php include "blog_sidebar.php"; ?>
			</div>
		</div>
	</div>
</div>