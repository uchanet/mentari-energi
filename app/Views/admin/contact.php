
					<link rel="stylesheet" href="<?=site_url()?>assets/plugins/table/datatable/datatables.css">
					<link rel="stylesheet" href="<?=site_url()?>assets/admin/css/forms/theme-checkbox-radio.css">
					<link rel="stylesheet" href="<?=site_url()?>assets/plugins/table/datatable/dt-global_style.css">
					<link rel="stylesheet" href="<?=site_url()?>assets/plugins/table/datatable/custom_dt_custom.css">

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
						<div class="widget">
							<div class="widget-heading d-flex justify-content-between">
								<h5 class=""><?=$pagetitle?></h5>
							</div>

							<div class="widget-content">
								<div class="table-responsive mb-4 style-3">
									<table id="style-3" class="table style-3 table-hover">
										<thead>
											<tr>
												<th class="checkbox-column"></th>
												<th class="">Name</th>
												<th class="">Email</th>
												<th class="">Subject</th>
												<th class="">Date</th>
												<?=($this->lib->role('change')) ? '<th class="text-center no-sort"><a id="multi-delete" class="text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#alert" value="DELETE SELECTED"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2  delete-multiple"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></th>' : NULL?>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
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

					<!-- Modal -->
					<div class="modal fade" id="readMessage" tabindex="-1" role="dialog" aria-labelledby="title" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="subject"></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
									</button>
								</div>
								<div class="modal-body">
									<div class="text-small" id="from"></div>
									<div class="text-small" id="to"></div>
									<div class="text-small" id="email"></div>
									<div class="text-small" id="date"></div>
									<p class="modal-text mt-3" id="message"></p>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
									<a class="btn btn-primary" id="reply" href="">Reply</a>
								</div>
							</div>
						</div>
					</div>

					<script src="<?=site_url()?>assets/plugins/table/datatable/datatables.js"></script>
					<script>
						$(document).ready(function(){
							table = $('table').DataTable({
								"stateSave": false,
								"processing": true,
								"serverSide": true,
								"deferRender": true,
								"ajax": {
									"url": "contact_data",
									"type": "POST"
								},
								"pageLength": 10,
								"order": [[ 4, "desc" ]],
								"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
								"columnDefs":[{
										"targets":"no-sort", "width":"30px", "orderable":false
									},{
										"targets":0, "width":"30px", "orderable":false, render:function(e, a, t, n) {
										return'<label class="new-control new-checkbox checkbox-outline-info	m-auto">\n<input value="'+e+'" type="checkbox" class="new-control-input child-chk select-item">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
									}
								}],
								"oLanguage": {
									"oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
									"sInfo": "Showing page _PAGE_ of _PAGES_",
									"sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
									"sSearchPlaceholder": "Search...",
									"sLengthMenu": "Results :	_MENU_",
								},
								headerCallback:function(e, a, t, n, s) {
									e.getElementsByTagName("th")[0].innerHTML='<label class="new-control new-checkbox checkbox-outline-info m-auto">\n<input type="checkbox" class="new-control-input chk-parent select-all">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
								},
								drawCallback: function(settings) {
									$(document).on("click", "#delete", function(){
										$('input[name="item[]"]').val($(this).data('id'));
									})
									$(document).on("click", "#multi-delete", function(){
										event.preventDefault();
										var id = $(".select-item:checkbox:checked").map(function(){
											return $(this).val();
										}).get();
										$('input[name="item[]"]').val(id);
									})
								}
							})
							multiCheck(table);
							$(document).on("click", "#read", function(){
							   $('#reply').attr('href', 'contact?act=reply&id='+$(this).attr('data-id'));
							   $('#subject').html($(this).attr('data-subject'));
							   $('#from').html('From	: ' + $(this).attr('data-name') + ' • ' + $(this).attr('data-email'));
							   $('#to').html('To	&emsp; : ' + $(this).attr('data-mailto'));
							   $('#date').html('Date	&nbsp;: ' + $(this).attr('data-date'));
							   $('#message').html($(this).attr('data-message'));
							   //$('input[name="item"]').val($(this).attr('data-id'));
							});
						})
					</script>
