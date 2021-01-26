<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v7.0&appId=390768251612626&autoLogAppEvents=1"></script>
					<div class="blog-post-right">
						<div id="search-input">
							<form action="<?=site_url()?>blog/search" method="POST">
								<div class="input-group">
									<input class="form-control input-sn" name="search" placeholder="Search..." type="text" required>
									<span class="input-group-btn"><button class="btn btn-info btn-md" type="submit"><span class="input-group-btn"><i class="fa fa-search"></i></span></button></span>
								</div>
							</form>
						</div>
<?php
		if ($this->db->table('sponsor')->where('active', 'Y')->countAllResults() > 0){
?>

<h4 class="blog-widget-title">Sponsor</h4>
<div class="background-center jarallax" data-jarallax="" data-speed="0.6">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-12">
				<div class="owl-carousel owl-theme testmonials-carousel-2 p-0 mt-20">
				<?php
					$query = $this->db->query("select * from sponsor where expire >= NOW() AND active='Y'");
					foreach ($query->getResult() as $row){
				?>
					<div class="testmonial-item">
						<a href="<?=$row->link?>" target="_BLANK">
							<img alt="partner-image" src="<?=site_url()?>assets/images/sponsor/<?=$row->picture?>" title="<?=$row->title?>">
							<h4><?=$row->title?></h4>
						</a>
					</div>
				<?php
					}
				?>
				</div>
			</div>
		</div>
</div>
						<?php
		}
		?>
						<h4 class="blog-widget-title">Categories</h4>
						<div class="blog-post-categories mt-20">
							<ul>
							<?php
								$db = \Config\Database::connect();
								function categorycount($db, $data){
									$builder = $db->table('post')->where('category', $data)->where('active', 'Y');
									return $builder->countAllResults();
								}
								$builder = $db->table('post_category')->orderBy('id', 'ASC');
								$result = $builder->get();
								foreach ($result->getResult() as $row) {
							?>
								<li>
									<a href="<?=site_url()?>blog/category/<?=$row->url?>"><?=$row->title?><span><?=categorycount($db, $row->id)?></span></a>
								</li>
							<?php
								}
							?>
							</ul>
						</div>
						<h4 class="blog-widget-title">Top News</h4>
						<div class="top-news mt-20">
							<?php
								$builder = $db->table('post')->where('active', 'Y')->limit(5)->orderBy('view', 'DESC');
								$result = $builder->get();
								foreach ($result->getResult() as $row) {
							?>
							<div class="top-news-info">
								<div class="row">
									<div class="col-md-4 col-sm-4 col-4 pr-0"><a href="<?=site_url()?>blog/post/<?=$row->url?>"><img alt="img" src="<?=site_url()?>/assets/thumbs/<?=$row->picture?>" onerror="this.onerror=null;this.src='<?=site_url()?>assets/images/blank.png'"></a></div>
									<div class="col-md-8 col-sm-8 col-8">
										<h3><a href="<?=site_url()?>blog/post/<?=$row->url?>"><?=character_limiter(strip_tags($row->title), 60)?></a></h3>
										<h6><?=date("d-M-Y", strtotime($row->created));?></h6>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
						<h4 class="blog-widget-title">Tags</h4>
						<div class="recent-post-tags mt-20">
							<?php
								$builder = $db->table('post')->select('tag')->where('tag !=', '')->where('active', 'Y')->orderBy('tag', 'asc');
								$result = $builder->get();
								$tags = "";
								foreach ($result->getResult() as $row) {
									$tags .= $row->tag . ",";
								}
								$tag = explode(',', implode(',', array_unique(array_filter(explode(',', $tags)))));
								$total = count($tag);
								for($i=0; $i<$total; $i++){
							?>
								<a class="button-tag semi-rounded" href="<?=site_url()?>blog/tag/<?=$tag[$i]?>"><?=humanize($tag[$i], '-')?></a>
							<?php
								}
							?>
						</div>
						<h4 class="blog-widget-title">Share Links</h4>
						<div class="blog-post-follow mt-20">
							<ul>
								<li class="social-link">
									<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=current_url()?>" class="fb-xfbml-parse-ignore"><i class="fab fa-facebook-f"></i></a>
								</li>
								<li class="social-link">
									<a href="#"><i class="fab fa-youtube"></i></a>
								</li>
								<li class="social-link">
									<a href="https://twitter.com/intent/tweet?text=<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>"><i class="fab fa-twitter"></i></a>
								</li>
								<li class="social-link">
									<a href="#"><i class="fab fa-pinterest"></i></a>
								</li>
								<li class="social-link">
									<a href="#"><i class="fab fa-behance"></i></a>
								</li>
							</ul>
						</div>
					</div>