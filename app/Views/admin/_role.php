					<script src="<?=site_url()?>assets/plugins/tinymce/tinymce.min.js"></script>
					<script src="<?=site_url()?>assets/plugins/fancybox/jquery.fancybox.min.js"></script>
					<link rel="stylesheet" href="<?=site_url()?>assets/plugins/fancybox/jquery.fancybox.min.css">
					<link rel="stylesheet" href="<?=site_url()?>assets/admin/css/forms/switches.css">
					<link rel="stylesheet" href="<?=site_url()?>assets/admin/css/forms/theme-checkbox-radio.css">

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
									$lastid = $this->db->table('role')->selectMax('id')->get()->getRow()->id + 1;
								?>
									<input type="hidden" name="id" value="<?=((!empty($id)) ? $id : NULL);?>"/>
									<div class="form-row mb-4">
										<div class="form-group col-md-6">
											<label for="title">Level</label>
											<input type="text" class="form-control" value="<?=((!empty($id)) ? $id : $lastid);?>" readonly>
										</div>
										<div class="form-group col-md-6">
											<label for="title">Title</label>
											<input type="text" class="form-control" name="title" placeholder="Title" value="<?=((!empty($_POST['title'])) ? $_POST['title'] : ((!empty($title)) ? $title : NULL));?>" required>
										</div>
										<div class="form-group col-md-12">
											<label>Permission</label>
											<div class="table-responsive">
												<table class="table table-bordered text-center">
													<thead>
														<tr>
															<th>Menu</th>
															<th>Access</th>
															<th>Create</th>
															<th>Modify</th>
														</tr>
													</thead>
													<tbody>
													<?php
														function p($a, $b, $data){
															foreach(json_decode($data) as $c =>  $d) {
																if ($c == $a){
																	return $d[1][$b];
																};
															}
														}
														$query = $this->db->query("SELECT * FROM menu WHERE category=1 AND link!=''");
														foreach($query->getResultArray() as $key => $value) {
													?>
														<tr>
															<td><input type="hidden" name="url[<?=$key?>]" value="<?=$value['link'];?>"><?=$value['label'];?></input></td>
															<td><label class="new-control new-checkbox checkbox-primary"><input type="checkbox" name="access[<?=$key?>]" value="<?=((!empty($id)) ? $id : $lastid);?>" class="new-control-input" <?=(!empty($permission)) ? ((p($key, 0, $permission)) ? "checked" : NULL) : NULL;?>><span class="new-control-indicator"></span>&zwnj;</label></td>
															<td><label class="new-control new-checkbox checkbox-primary"><input type="checkbox" name="create[<?=$key?>]" value="<?=((!empty($id)) ? $id : $lastid);?>" class="new-control-input" <?=(!empty($permission)) ? ((p($key, 1, $permission)) ? "checked" : NULL) : NULL;?>><span class="new-control-indicator"></span>&zwnj;</label></td>
															<td><label class="new-control new-checkbox checkbox-primary"><input type="checkbox" name="modify[<?=$key?>]" value="<?=((!empty($id)) ? $id : $lastid);?>" class="new-control-input" <?=(!empty($permission)) ? ((p($key, 2, $permission)) ? "checked" : NULL) : NULL;?>><span class="new-control-indicator"></span>&zwnj;</label></td>
														</tr>
													<?php
														}
													?>
													</tbody>
												</table>
											</div>
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
								permalink = $(this).val();
								permalink = permalink.replace(/\s+/g,' ');
								$(this).val($(this).val().replace(/\W/g, ' '));
								$(this).val($(this).val().replace(/\s+/g, ''));
								var gappermalink = $(this).val();
							})
						})
					</script>
