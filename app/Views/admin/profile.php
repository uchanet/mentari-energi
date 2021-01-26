
					<link rel="stylesheet" href="<?=site_url()?>assets/admin/css/users/user-profile.css">
					<link rel="stylesheet" href="<?=site_url()?>assets/admin/css/components/timeline/custom-timeline.css">
					<link rel="stylesheet" href="<?=site_url()?>assets/admin/css/elements/custom-pagination.css">

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
						<div class="row">
						<div class="user-profile layout-spacing col-md-4">
							<div class="widget-content widget-content-area">
								<div class="d-flex justify-content-between">
									<h3 class="">Profile</h3>
									<?php
										if ($this->session->userid == $id){
											echo '<a href="'.site_url().'admin/profile?act=edit" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>';
										} else {
											echo '<a href="'.site_url().'admin/profile?act=edit&id='.$username.'" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>';
										}
									?>
								</div>
								<div class="text-center user-info">
									<img src="<?=site_url()?>assets/images/profile/<?=$picture?>" alt="avatar">
									<p class=""><?=$name?></p>
								</div>
								<div class="user-info-list">

									<div class="">
										<ul class="contacts-block list-unstyled">
											<li class="contacts-block__item">
												Role : <?=$this->lib->getRole($role)?>
											</li>
											<li class="contacts-block__item">
												Registered : <?=$registered?>
											</li>
											<li class="contacts-block__item">
												Email : <a href="mailto:example@mail.com"><?=$email?></a>
											</li>
										</ul>
									</div>									
								</div>
							</div>
						</div>

						<div class="education layout-spacing col-md-8">
							<div class="widget-content widget-content-area">
								<h3 class="">Post</h3>
								<div class="timeline-simple">
									<div class="timeline-list">
								<?php
									use App\Models\Post;
									$post = new Post();
									$result = $post->select('post.*, user.picture as pic, user.name as name')->join('user', 'post.author = user.id')->where('author', $id)->orderBy('created', 'ASC')->paginate(5, 'blog');
									$pager = $post->select('post.*, user.picture as pic')->join('user', 'post.author = user.id')->where('author', $id)->orderBy('created', 'ASC')->pager;
									foreach ($result as $row) {
								?>
										<div class="timeline-post-content">
											<div class="user-profile">
												<img src="<?=site_url()?>assets/images/profile/<?=$row['pic']?>" class="">
											</div>
											<div class="">
												<h4><?=$row['name']?></h4>
												<p class="meta-time-date"><?=date("d M Y H:i", strtotime($row['created']))?></p>
												<div class="mt-0 mb-4">
													<div class="modern-timeline-preview text-center"><a href="<?=site_url()?>blog/post/<?=$row['url']?>"><img class="w-100 text-center" src="<?=site_url()?>/assets/thumbs/<?=$row['picture']?>" onerror="this.onerror=null;this.src='<?=site_url()?>assets/images/blank.png'"></a></div>
													<h6 class="mt-2"><a href="<?=site_url()?>blog/post/<?=$row['url']?>"><?=character_limiter(strip_tags($row['title']), 60)?></a></h6>
													<p class="post-text"><?=character_limiter(strip_tags($row['content']), 300)?> <a class="button-simple mt-15" href="<?=site_url()?>blog/post/<?=$row['url']?>">Continue Reading <i class="fa fa-arrow-right primary-color"></i></a></p>
												</div>
											</div>
										</div>
								<?php } ?>
									</div>
									<div class="pagination-custom_solid">
										<?=$pager->links('blog', 'profile')?>
									</div>
								</div>
							</div>
						</div>

					</div>
					</div>
