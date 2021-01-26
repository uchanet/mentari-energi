					<script src="<?=site_url()?>assets/plugins/tinymce/tinymce.min.js"></script>
					<script src="<?=site_url()?>assets/plugins/fancybox/jquery.fancybox.min.js"></script>
					<link rel="stylesheet" href="<?=site_url()?>assets/plugins/fancybox/jquery.fancybox.min.css">
					<link rel="stylesheet" href="<?=site_url()?>assets/plugins/flatpickr/flatpickr.css">
					<link rel="stylesheet" href="<?=site_url()?>assets/plugins/flatpickr/custom-flatpickr.css">
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
									<input type="hidden" name="id" value="<?=((!empty($id)) ? $id : NULL);?>"/>
									<div class="form-row mb-4">
										<div class="form-group col-md-6">
											<label for="title">Title</label>
											<input type="text" class="form-control" name="title" placeholder="Title" value="<?=((!empty($_POST['title'])) ? $_POST['title'] : ((!empty($title)) ? $title : NULL));?>" required>
										</div>
										<div class="form-group col-md-6">
											<label for="link">Link</label>
											<input type="text" class="form-control" name="link" placeholder="Link" value="<?=((!empty($_POST['link'])) ? $_POST['link'] : ((!empty($link)) ? $link : NULL));?>" required>
										</div>
										<div class="form-group col-md-6">
											<label for="picture">Picture</label>
											<div class="custom-file mb-3">
												<input type="file" class="custom-file-input" name="picture" id="picturelabel">
												<input type="hidden" name="oldpicture" value="<?=(!empty($picture)) ? $picture : NULL;?>">
												<label class="custom-file-label" for="picturelabel"></label>
											</div>
										</div>
												<div class="form-group col-md-6">
													<label for="active">Active</label>
													<div class="row">
														<div class="col-3">
															<div class="ml-2 mt-2">
																<label class="switch s-icons s-outline  s-outline-primary">
																	<input id="active" type="checkbox" class="form-control" name="active" value="Y" <?=((!empty($_POST['active']) == 'Y' ) ? "checked" : ((!empty($active) == 'Y') ? "checked" : NULL));?>>
																	<span class="slider round"></span>
																</label>
															</div>
														</div>
														<div class="col-9">
															<input type="text" class="form-control flatpickr flatpickr-input active" id="expire" name="expire" placeholder="Select Date.." value="<?=(!empty($expire)) ? $expire : NULL;?>">
														</div>
													</div>
												</div>
									</div>
									<button type="submit" class="btn btn-primary">Save</button> <a href='<?=current_url()?>' class="btn btn-outline-danger float-right">Cancel</a>
								</form>
							</div>
						</div>
					</div>

					<script src="<?=site_url()?>assets/plugins/flatpickr/flatpickr.js"></script>
					<script>
						$(".custom-file-input").on("change", function() {
							var fileName = $(this).val().split("\\").pop();
							$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
						})
						flatpickr("#expire", {enableTime: true, dateFormat: "Y-m-d H:i",});
					</script>