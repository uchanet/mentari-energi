
	<link rel="stylesheet" type="text/css" href="<?=site_url()?>assets/admin/css/forms/theme-checkbox-radio.css">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
						<div class="widget">
							<div class="widget-heading d-flex justify-content-between">
								<h5 class=""><?=$pagetitle?></h5>
								<a class="btn btn-primary" href="?act=add">Add</a>
							</div>

							<div class="widget-content">
								<div class="table-responsive">
								<form method="post" enctype="multipart/form-data">
									<input type="hidden" name="id" value="<?=((!empty($id)) ? $id : NULL);?>"/>
									<table class="table table-bordered mb-4 text-center">
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
											$query = $this->db->query("SELECT * FROM menu WHERE category = 1");
											foreach($query->getResultArray() as $key => $value) {
										?>
											<tr>
												<td><input type="hidden" name="url[<?=$key?>]" value="<?=$value['link'];?>"><?=$value['label'];?></input></td>
												<td><label class="new-control new-checkbox checkbox-primary"><input type="checkbox" name="access[<?=$key?>]" value="<?=$_GET['id']?>" class="new-control-input"  <?=(!empty(p($key, 0, $permission))) ? "checked" : NULL;?>><span class="new-control-indicator"></span>&zwnj;</label></td>
												<td><label class="new-control new-checkbox checkbox-primary"><input type="checkbox" name="create[<?=$key?>]" value="<?=$_GET['id']?>" class="new-control-input"  <?=(!empty(p($key, 1, $permission))) ? "checked" : NULL;?>><span class="new-control-indicator"></span>&zwnj;</label></td>
												<td><label class="new-control new-checkbox checkbox-primary"><input type="checkbox" name="modify[<?=$key?>]" value="<?=$_GET['id']?>" class="new-control-input"  <?=(!empty(p($key, 2, $permission))) ? "checked" : NULL;?>><span class="new-control-indicator"></span>&zwnj;</label></td>
											</tr>
										<?php
											}
										?>
										</tbody>
									</table>
									<button type="submit" class="btn btn-primary">Save</button>
								</form>
								</div>
							</div>
						</div>
					</div>
