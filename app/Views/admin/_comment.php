					<script src="<?=site_url()?>assets/plugins/tinymce/tinymce.min.js"></script>
					<script src="<?=site_url()?>assets/plugins/fancybox/jquery.fancybox.min.js"></script>
					<link rel="stylesheet" href="<?=site_url()?>assets/plugins/fancybox/jquery.fancybox.min.css">
					<link rel="stylesheet" href="<?=site_url()?>assets/admin/css/forms/switches.css">

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
						<div class="widget">
							<div class="widget-heading d-flex justify-content-between">
								<h5 class=""><?=$pagetitle?></h5>
							</div>

							<div class="widget-content">
								<form method="post" enctype="multipart/form-data">
								<?php
									if ($validation->getErrors()){
								?>
									<div class="alert alert-warning alert-dismissible fade show" role="alert">
										<strong>Error!</strong> <?=$validation->listErrors()?>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								<?php
									}
									if (!empty($error)){
								?>
									<div class="alert alert-warning alert-dismissible fade show" role="alert">
										<strong>Error!</strong><ul><li> <?=$error;?></li></ul>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								<?php
									}
								?>
									<input type="hidden" name="post" value="<?=((!empty($post)) ? $post : NULL);?>"/>
									<input type="hidden" name="parent" value="<?=((!empty($parent)) ? $parent : NULL);?>"/>
									<div class="form-row mb-4">
										<div class="form-group col-md-12">
											<blockquote class="blockquote">
												<?php
													$result = $this->db->query("SELECT * FROM post WHERE id='".$post."'");
													foreach($result->getResult() as $data) {
														$title = $data->title;
													}
												?>
												<p class="d-inline"><?=((!empty($message)) ? $message : NULL);?></p>
												<small><?=$name;?> (<?=$email;?>) on <cite title="Source Title"><?=$title;?></cite></small>
											</blockquote>
										</div>
										<div class="form-group col-md-12">
											<label for="message">Reply</label>
											<textarea class="form-control" name="message" placeholder="Reply"><?=((!empty($_POST['message'])) ? $_POST['message'] : NULL);?></textarea>
										</div>
									</div>
									<button type="submit" class="btn btn-primary">Save</button> <a href='<?=current_url()?>' class="btn btn-outline-danger float-right">Cancel</a>
								</form>
							</div>
						</div>
					</div>

					<script type="text/javascript">
						var exit = false;
						$("form").submit(function(){
							exit = true;
						})
						$(window).on("beforeunload", function() {
							if (!exit) {
								return "Are you sure? You didn't finish the form!";
							}
						})
						$(document).ready(function($) {
							$('input[name="title"').on('input', function() {
								var permalink;
								permalink = $.trim($(this).val());
								permalink = permalink.replace(/\s+/g,' ');
								$('input[name="url"').val(permalink.toLowerCase());
								$('input[name="url"').val($('input[name="url"').val().replace(/\W/g, ' '));
								$('input[name="url"').val($.trim($('input[name="url"').val()));
								$('input[name="url"').val($('input[name="url"').val().replace(/\s+/g, '-'));
								var gappermalink = $('input[name="url"').val();
							})

							$('input[name="url"').on('input', function() {
								var permalink;
								permalink = $(this).val();
								permalink = permalink.replace(/\s+/g,' ');
								$(this).val(permalink.toLowerCase());
								$(this).val($(this).val().replace(/\W/g, ' '));
								$(this).val($(this).val().replace(/\s+/g, '-'));
								var gappermalink = $(this).val();
							})
						})
					</script>
