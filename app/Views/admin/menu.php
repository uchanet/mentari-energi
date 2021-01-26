
					<link rel="stylesheet" href="<?=site_url()?>assets/admin/css/components/tabs-accordian/custom-tabs.css">
					<link rel="stylesheet" href="<?=site_url()?>assets/admin/css/nestable.css">

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
						<div class="widget">
							<div class="widget-heading d-flex justify-content-between">
								<h5 class=""><?=$pagetitle?></h5>
							</div>

							<div class="widget-content px-2">
								<ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
								<?php
									$query = $this->db->query('select category from menu group by category');
									foreach ($query->getResult() as $data){
										if ($data->category == $category){
											$nav = " active";
										} else {
											$nav = "";
										}
										?>
								    <li class="nav-item">
								        <a class="nav-link<?=$nav?>" href="?id=<?=$data->category?>">Menu-<?=$data->category?></a>
								    </li>
								<?php } ?>
									<li class="nav-item">
											<a class="nav-link" href="?id=<?=$data->category+1?>"> + </a>
									</li>
								</ul>
								<div class="row">
									<div class="col-md-8">
										<input type="hidden" id="nestable-output">
										<menu id="nestable-menu" class="mt-0">
											<button class="btn btn-dark btn-sm" type="button" data-action="expand-all">Expand All</button>
											<button class="btn btn-dark btn-sm" type="button" data-action="collapse-all">Collapse All</button>
										</menu>
										<div class='dd' id="nestable">
											<?php
												$query = $this->db->query('select * from menu where category='.$category.' order by sort ASC');

												$ref   = [];
												$items = [];
												foreach ($query->getResult() as $data){
													$thisRef = &$ref[$data->id];
													$thisRef['id'] = $data->id;
													$thisRef['icon'] = $data->icon;
													$thisRef['link'] = $data->link;
													$thisRef['label'] = $data->label;
													$thisRef['parent'] = $data->parent;
													$thisRef['category'] = $data->category;

													if($data->parent == 0) {
														$items[$data->id] = &$thisRef;
													} else {
														$ref[$data->parent]['child'][$data->id] = &$thisRef;
													}
												}

												function get_menu($items,$class = 'dd-list') {
													$html = "<ol class=\"".$class."\" id=\"menu-id\">";
													foreach($items as $key=>$value) {
														$html.= '<li class="dd-item dd3-item" data-id="'.$value['id'].'" >
												<div class="dd-handle dd3-handle"></div>
												<div class="dd3-content"><span id="label_show'.$value['id'].'">'.$value['label'].'</span>
													<span class="span-right"><span id="link_show'.$value['id'].'">'.$value['link'].'</span> &nbsp;&nbsp;
													<a class="edit-button" id="'.$value['id'].'" label="'.$value['label'].'" link="'.$value['link'].'"  icon="'.$value['icon'].'"  category="'.$value['category'].'" ><i class="fa fa-pencil-alt"></i></a>
													<a class="del-button" id="'.$value['id'].'"><i class="fa fa-trash"></i></a></span>
												</div>';
														if(array_key_exists('child',$value)) {
															$html .= get_menu($value['child'],'dd-list');
														}
															$html .= "</li>";
													}
													$html .= "</ol>";
													return $html;
												}

												echo get_menu($items);
											?>
										</div>
									</div>
									<div class="col-md-4">
										<h5 class="m-2">Add New</h5>
										<form id="add" method="POST">
											<div class="row">
												<input type="hidden" id="id" name="id">
												<input type="hidden" id="category" name="category" value="<?=$category?>" />
												<div class="col-md-12">
													<div class="form-group">
														<input type="text" class="form-control" id="label" name="label" placeholder="Fill label" required>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<input type="text" class="form-control" id="link" name="link" placeholder="Fill link">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<input type="text" class="form-control" id="icon" name="icon" placeholder="Fill icon">
													</div>
												</div>
												<div class="col-md-12">
													<button class="btn btn-primary" type="submit">Submit</button> <button class="btn btn-outline-danger float-right" id="cancel">Cancel</button>
												</div>
											</div>
										</form>
									</div>
								</div>

							</div>
						</div>
					</div>

					<!-- Modal -->
					<div class="modal fade modal-notification" id="alert" tabindex="-1" role="dialog" aria-labelledby="alertLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document" id="alertLabel">
							<div class="modal-content">
								<form method="post">
									<div class="modal-body text-center">
										<p class="icon-content">
											<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
										</p>
										<h5 class="modal-text">Are you sure?</h5>
										<p>Do you really want to delete these records? This process cannot be undone.</p>
										<input name="item[]" type="hidden" value="">
									 </div>
									<div class="modal-footer justify-content-between">
										<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
										<button type="submit" class="btn btn-danger">Delete</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<script>
						$(document).ready(function() {
							var updateOutput = function(e) {
								var list = e.length ? e : $(e.target),
									output = list.data('output');
								if (window.JSON) {
									output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
								} else {
									output.val('JSON browser support required for this demo.');
								}
							};
							// activate Nestable for list 1
							$('#nestable').nestable({
								group: 1
							}).on('change', updateOutput);
							// output initial serialised data
							updateOutput($('#nestable').data('output', $('#nestable-output')));
							$('#nestable-menu').on('click', function(e) {
								var target = $(e.target),
									action = target.data('action');
								if (action === 'expand-all') {
									$('.dd').nestable('expandAll');
								}
								if (action === 'collapse-all') {
									$('.dd').nestable('collapseAll');
								}
							});
						});

						$(document).ready(function() {
							$("#load").hide();
							$("#add").submit(function() {
								$("#load").show();
								var dataString = $(this).serialize();
								$.ajax({
									type: "POST",
									url: "menu",
									data: dataString,
									dataType: "json",
									cache: false,
									success: function(data) {
										if (data.type == 'add') {
											$("#menu-id").prepend(data.menu);
										} else if (data.type == 'edit') {
											$('#label_show' + data.id).html(data.label);
											$('#link_show' + data.id).html(data.link);
											$('#' + data.id).attr({
												label:data.label,
												link:data.link,
												icon:data.icon,
												category:data.category,
											});
										}
										$('#label').val('');
										$('#link').val('');
										$('#icon').val('');
										$('#id').val('');
										$("#load").hide();
									},
									error: function(xhr, status, error) {
										alert(error);
									},
								});
								return false;
							});

							$('.dd').on('change', function() {
								$("#load").show();
								var dataString = {
									data: $("#nestable-output").val(),
								};
								$.ajax({
									type: "POST",
									url: "menu",
									data: dataString,
									cache: false,
									success: function(data) {
										$("#load").hide();
									},
									error: function(xhr, status, error) {
										alert(error);
									},
								});
							});

							$(document).on("click", ".del-button", function() {
								var x = confirm('Delete this menu?');
								var id = $(this).attr('id');
								if (x) {
									$("#load").show();
									$.ajax({
										type: "POST",
										url: "menu",
										data: {
											item: id
										},
										cache: false,
										success: function(data) {
											$("#load").hide();
											$("li[data-id='" + id + "']").remove();
										},
										error: function(xhr, status, error) {
											alert(error);
										},
									});
								}
							});

							$(document).on("click", ".edit-button", function() {
								var id = $(this).attr('id');
								var label = $(this).attr('label');
								var icon = $(this).attr('icon');
								var link = $(this).attr('link');
								var category = $(this).attr('category');
								$("#id").val(id);
								$("#label").val(label);
								$("#icon").val(icon);
								$("#link").val(link);
								$("#category").val(category);
							});

							$(document).on("click", "#reset", function() {
								$('#label').val('');
								$('#link').val('');
								$('#icon').val('');
								$('#id').val('');
								$('#category').val('');
							});
						});
					</script>
					<script src="<?=site_url()?>assets/admin/js/jquery.nestable.js"></script>
