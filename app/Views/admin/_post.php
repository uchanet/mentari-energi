					<script src="<?=site_url()?>assets/plugins/tinymce/tinymce.min.js"></script>
					<script src="<?=site_url()?>assets/plugins/fancybox/jquery.fancybox.min.js"></script>
					<link rel="stylesheet" href="<?=site_url()?>assets/plugins/fancybox/jquery.fancybox.min.css">
					<link rel="stylesheet" href="<?=site_url()?>assets/admin/css/forms/switches.css">
					<link rel="stylesheet" href="<?=site_url()?>assets/plugins/tags/tags.css">
					<script src="<?=site_url()?>assets/plugins/tags/tags.js"></script>


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
											<label for="url">URL</label>
											<input type="text" class="form-control" name="url" placeholder="URL" value="<?=((!empty($_POST['url'])) ? $_POST['url'] : ((!empty($url)) ? $url : NULL));?>" required>
										</div>
										<div class="form-group col-md-12">
											<label for="content">Content</label>
											<textarea id="tinymce" name="content"><?=((!empty($_POST['content'])) ? $_POST['content'] : ((!empty($content)) ? $content : NULL));?></textarea>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="picture">Picture</label>
												<div class="input-group">
													<input class="form-control" name="picture" id="picture" type="text" placeholder="Browse file..." value="<?=((!empty($_POST['picture'])) ? $_POST['picture'] : ((!empty($picture)) ? $picture : NULL));?>">
													<div class="input-group-append">
														<button data-fancybox data-type="iframe" data-src="<?=site_url()?>assets/plugins/filemanager/dialog.php?type=2&field_id=picture&relative_url=1&fldr=" class="iframe-btn input-group-text" type="button">Select</button>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group col-md-6">
											<label for="role">Category</label>
											<select name="category" class="custom-select" required>
											<?php
												$query = $this->db->query("select * from post_category order by id");
												if ((!empty($_POST['category'])) ? $_POST['category'] : ((!empty($category)) ? $category : NULL)){
													echo "<option value=''>Select...</option>";
													foreach ($query->getResult() as $row) {
														if ((!empty($_POST['category'])) ? $_POST['category'] : ((!empty($category)) ? $category : NULL) == $row->id){
															echo "<option value='".$row->id."' selected>".$row->title."</option>";
														} else {
															echo "<option value='".$row->id."'>".$row->title."</option>";
														}
													}
												} else {
													echo "<option value='' selected>Select...</option>";
													foreach ($query->getResult() as $row) {
														echo "<option value='".$row->id."'>".$row->title."</option>";
													}
												 }
											?>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label for="tag">Tag</label>
											<input type="text" class="form-control" name="tag" placeholder="Tag" data-role="tagsinput" value="<?=((!empty($_POST['tag'])) ? $_POST['tag'] : ((!empty($tag)) ? $tag : NULL));?>"></input>
										</div>
										<div class="form-group col-md-6">
											<label for="role">Active</label>
											<div class="ml-2 mt-2">
												<label class="switch s-icons s-outline s-outline-primary mr-2">
													<input name="active" type="checkbox" value="Y" <?=((!empty($_POST['active']) == 'Y' ) ? "checked" : ((!empty($active) == 'Y') ? "checked" : NULL));?>>
													<span class="slider round"></span>
												</label>
											</div>
										</div>
									</div>
									<button type="submit" class="btn btn-primary">Save</button> <a href='<?=current_url()?>' class="btn btn-outline-danger float-right">Cancel</a>
								</form>
							</div>
						</div>
					</div>

					<script type="text/javascript">
						tinymce.init({
							convert_urls : false,
							selector: "#tinymce",
							height: 600,
							content_style: 'p, ul, h1, h2, h3, h4, h5, h6 {margin: 0px;padding: 0px;} ul {margin-left: 2.5em}',
							plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak", "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking", "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"],
							toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
							toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
							image_advtab: true,
							external_filemanager_path: "<?=site_url()?>assets/plugins/filemanager/",
							filemanager_title: "Filemanager",
							external_plugins: {
								"filemanager": "<?=site_url()?>assets/plugins/filemanager/plugin.min.js"
							}
						})
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

							$("[data-fancybox]").fancybox({
								iframe : {
									css : {
										width : '100%',
										height : '100%',
									}
								}
							});

							function OnMessage(e) {
								var event = e.originalEvent;
								if (event.data.sender === 'responsivefilemanager') {
									if (event.data.field_id) {
										var fieldID = event.data.field_id;
										var url = event.data.url;
										$('#' + fieldID).val(url).trigger('change');
										$.fancybox.close();
										$(window).off('message', OnMessage);
									}
								}
							}

							$('.iframe-btn').on('click', function() {
								$(window).on('message', OnMessage);
							})

							$('#download-button').on('click', function() {
								ga('send', 'event', 'button', 'click', 'download-buttons');
							})

							$('.toggle').click(function() {
								var _this = $(this);
								$('#' + _this.data('ref')).toggle(200);
								var i = _this.find('i');
								if (i.hasClass('icon-plus')) {
									i.removeClass('icon-plus');
									i.addClass('icon-minus');
								} else {
									i.removeClass('icon-minus');
									i.addClass('icon-plus');
								}
							})
						})

						function open_popup(url) {
							var w = 880;
							var h = 570;
							var l = Math.floor((screen.width - w) / 2);
							var t = Math.floor((screen.height - h) / 2);
							var win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
						}
					</script>
