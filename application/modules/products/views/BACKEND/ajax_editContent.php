<script type="text/javascript" src="<?=PATH_URL.'assets/js/admin/'?>jquery.slugit.js"></script>
<script type="text/javascript" src="<?=PATH_URL.'assets/editor/scripts/innovaeditor.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'assets/editor/scripts/innovamanager.js'?>"></script>
<script type="text/javascript">
$(document).ready( function() {
	$("#nameAdmincp").slugIt({
		events: 'keyup blur',
		output: '#slugAdmincp',
		space: '-'
	});
	$(function () {
		$('select[multiple].active.3col').multiselect({
			columns: 2,
			placeholder: 'Add topping',
			search: true,
			searchOptions: {
				'default': 'Search topping'
			},
			selectAll: true,
		});
	});
});



function save(){
	
	var options = {
		beforeSubmit:  showRequest,  // pre-submit callback 
		success:       showResponse  // post-submit callback 
    };
	$('#frmManagement').ajaxSubmit(options);
}
function showRequest(formData, jqForm, options) {
	var form = jqForm[0];

	if(form.codeAdmincp.value != ''){
		$("#codeAdmincp").val($("#codeAdmincp").val().replace(/\s\s/g, ''));
		$("#codeAdmincp").val($("#codeAdmincp").val().replace(/[<\!\>\?\@\#\$\%\^\&\*\"\'\[\]\{\}\=\𠮷\𠀋\𡈽\𠮟\𣘺\𡌛\𡢽\𡸴\𣜿]/g, ''));
	}

	if(form.nameAdmincp.value == ''  || form.unitAdmincp.value == '' || form.cateAdmincp.value == ''){
		$('#txt_error').html('Please enter information.');
		show_perm_denied();
		return false;
	}
}

function showResponse(responseText, statusText, xhr, $form) {
	var module_url = '<?=PATH_URL_ADMIN.$module?>';
	responseText = responseText.split(".");
	token_value  = responseText[1];
	$('#csrf_token').val(token_value);
	if(responseText[0]=='success'){
		show_perm_success();
	}
	if(responseText[0]=='redirect'){
		window.location = module_url;
	}
	
	if(responseText[0]=='error-title-exists'){
		$('#txt_error').html('Name Product already exists.');
		show_perm_denied();
		return false;
	}

	if(responseText[0]=='error-slug-exists'){
		$('#txt_error').html('Slug already exists.');
		show_perm_denied();
		return false;
	}

	if(responseText[0]=='permission-denied'){
		$('#txt_error').html('Permission denied.');
		show_perm_denied();
		return false;
	}
}

</script>
<style>
.input-group {
    float: left;
    padding-right: 20px;
}
</style>

<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"><?=$this->session->userdata('Name_Module')?></h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?=PATH_URL_ADMIN?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?=PATH_URL_ADMIN.$module?>"><?=$this->session->userdata('Name_Module')?></a><i class="fa fa-angle-right"></i></li>
		<li><?php ($this->uri->segment(4)=='') ? print 'Add new' : print 'Edit' ?></li>
	</ul>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
                    <i class="icon-paper-plane font-green-haze"></i>
                    <span class="caption-subject bold font-green-haze uppercase">Form Input</span>
                </div>
			</div>
			
			<div class="portlet-body form">
				<div class="form-body notification" style="display:none">
					<div class="alert alert-success" style="display:none">
						<strong>Success!</strong> The page has been saved.
					</div>
					
					<div class="alert alert-danger" style="display:none">
						<strong>Error!</strong> <span id="txt_error"></span>
					</div>
				</div>
				
				<!-- BEGIN FORM-->
				<form id="frmManagement" action="<?=PATH_URL_ADMIN.$module.'/save/'?>" method="post" enctype="multipart/form-data" class="form-horizontal form-row-seperated">
					<input type="hidden" value="<?=$this->security->get_csrf_hash()?>" id="csrf_token" name="csrf_token" />
					<input type="hidden" value="<?=$id?>" name="hiddenIdAdmincp" />

					<div class="portlet-body">
						<div class="row">
							<div class="col-md-2 col-sm-2 col-xs-2">
								<ul class="nav nav-tabs tabs-left">
									<li class="active">
										<a href="#tab1" data-toggle="tab"><span class ="caption-subject font-green-haze bold uppercase"> Sản phẩm </span></a>
									</li>
									<li>
										<a href="#tab2" data-toggle="tab"><span class ="caption-subject font-green-haze bold uppercase"> Định mức đại lý </span></a>
									</li>

								</ul>
							</div>
							<div class="col-md-10 col-sm-10 col-xs-10">
								<div class="tab-content">
									<div class="tab-pane active" id="tab1">
										<div class="form-body">
											<div class="form-group">
												<label class="control-label col-md-2">Status:</label>
												<div class="col-md-10">
													<label class="radio-inline"><input type="radio" name="statusAdmincp" value="0" <?= isset($result->status) ? $result->status == 0 ? 'checked' : '' : '' ?> > Blocked</label>
													<label class="radio-inline"><input type="radio" name="statusAdmincp" value="1" <?= isset($result->status) ? $result->status == 1 ? 'checked' : '' : 'checked' ?> > Approved</label>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-2">Danh mục: <span class="required" aria-required="true">*</span></label>
												<div class="col-md-6">
													<select class="bs-select form-control" data-live-search="true" data-size="8" name="cateAdmincp" id="cateAdmincp">
														<option value="">None</option>
														<?php foreach ($cates as $key => $cate): ?>
															<?php  
																$select = '';
																if (isset($result->type)) {
																	if($result->type == $cate->id){
																		$select = 'selected="selected"';
																	}
																}
															?>
															<option value="<?= $cate->id; ?>" <?= $select; ?> ><?= $cate->name; ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<!--  -->
												<label class="control-label col-md-2">Tên: <span class="required" aria-required="true">*</span></label>
												<div class="col-md-8">
													<input value="<?php if(isset($result->name)) { print $result->name; }else{ print '';} ?>" type="text" name="nameAdmincp" id="nameAdmincp" class="form-control"/>
												</div>
											</div>
											<div class="form-group">
												<!--  -->
												<label class="control-label col-md-2">Code: <span class="required" aria-required="true">*</span></label>
												<div class="col-md-3">
													<input value="<?php if(isset($result->code)) { print $result->code; }else{ print '';} ?>" type="text" name="codeAdmincp" id="codeAdmincp" class="form-control"/>
												</div>
												<label class="control-label col-md-2">Sắp xếp: <span class="required" aria-required="true">*</span></label>
												<div class="col-md-3">
													<input value="<?php if(isset($result->order)) { print $result->order; }else{ print '';} ?>" type="text" name="orderAdmincp" id="orderAdmincp" class="form-control"/>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-2">Slug: <span class="required" aria-required="true">*</span></label>
												<div class="col-md-8"><input value="<?php if(isset($result->slug)) { print $result->slug; }else{ print '';} ?>" type="text" name="slugAdmincp" id="slugAdmincp" class="form-control"/></div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-2">Đơn vị tính: <span class="required" aria-required="true">*</span></label>
												<div class="col-md-3">
													<select class="bs-select form-control" data-live-search="true" data-size="8" name="unitAdmincp" id="unitAdmincp">
														<option value="">None</option>
														<?php foreach ($units as $key => $unit): ?>
															<?php  
																$select = '';
																if (isset($result->type)) {
																	if(strcmp($result->unit, $unit->name) === 0){
																		$select = 'selected="selected"';
																	}
																}
															?>
															<option value="<?= $unit->name; ?>" <?= $select; ?> ><?= $unit->name; ?></option>
														<?php endforeach; ?>
													</select>
												</div>
												<label class="control-label col-md-2">Cho phép xem tồn:</label>
												<div class="col-md-3">
													<label class="radio-inline"><input type="radio" name="viewAllAdmincp" value="0" <?= isset($result->viewAll) ? $result->viewAll == 0 ? 'checked' : '' : 'checked' ?> > Không</label>
													<label class="radio-inline"><input type="radio" name="viewAllAdmincp" value="1" <?= isset($result->viewAll) ? $result->viewAll == 1 ? 'checked' : '' : '' ?> > Có</label>
												</div>
											</div>
											
											<div class="form-group">
												<label class="control-label col-md-2">Cho phép hủy:</label>
												<div class="col-md-3">
													<label class="radio-inline"><input type="radio" name="cancelAdmincp" value="0" <?= isset($result->is_remove) ? $result->is_remove == 0 ? 'checked' : '' : 'checked' ?> > Không</label>
													<label class="radio-inline"><input type="radio" name="cancelAdmincp" value="1" <?= isset($result->is_remove) ? $result->is_remove == 1 ? 'checked' : '' : '' ?> > Có</label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-2">Cho phép tỷ lệ định mức cho cửa hàng:</label>
												<div class="col-md-3">
													<label class="radio-inline"><input type="radio" name="isRateStoreAdmincp" value="0" <?= isset($result->isRateStore) ? $result->isRateStore == 0 ? 'checked' : '' : 'checked' ?> > Không</label>
													<label class="radio-inline"><input type="radio" name="isRateStoreAdmincp" value="1" <?= isset($result->isRateStore) ? $result->isRateStore == 1 ? 'checked' : '' : '' ?> > Có</label>
												</div>
												<label class="control-label col-md-2">Nhập tỷ lệ (%):</label>
												<div class="col-md-3"><input value="<?php if(isset($result->rateStore)) { print $result->rateStore; }else{ print '';} ?>" type="text" name="rateStoreAdmincp" id="rateStoreAdmincp" class="form-control"/></div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-2">Cho phép tỷ lệ định mức cho kho chính:</label>
												<div class="col-md-3">
													<label class="radio-inline"><input type="radio" name="isRateStoreMainAdmincp" value="0" <?= isset($result->isRateStoreMain) ? $result->isRateStoreMain == 0 ? 'checked' : '' : 'checked' ?> > Không</label>
													<label class="radio-inline"><input type="radio" name="isRateStoreMainAdmincp" value="1" <?= isset($result->isRateStoreMain) ? $result->isRateStoreMain == 1 ? 'checked' : '' : '' ?> > Có</label>
												</div>
												<label class="control-label col-md-2">Nhập tỷ lệ (%):</label>
												<div class="col-md-3"><input value="<?php if(isset($result->rateStoreMain)) { print $result->rateStoreMain; }else{ print '';} ?>" type="text" name="rateStoreMainAdmincp" id="rateMainStoreAdmincp" class="form-control"/></div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-2">Cho phép chia tỷ số kho chính:</label>
												<div class="col-md-3">
													<label class="radio-inline"><input type="radio" name="isEffectStoreMainAdmincp" value="0" <?= isset($result->isEffectStoreMain) ? $result->isEffectStoreMain == 0 ? 'checked' : '' : 'checked' ?> > Không</label>
													<label class="radio-inline"><input type="radio" name="isEffectStoreMainAdmincp" value="1" <?= isset($result->isEffectStoreMain) ? $result->isEffectStoreMain == 1 ? 'checked' : '' : '' ?> > Có</label>
												</div>
												<label class="control-label col-md-2">Nhập tỷ số:</label>
												<div class="col-md-3"><input value="<?php if(isset($result->effectStoreMain)) { print $result->effectStoreMain; }else{ print '';} ?>" type="text" name="effectStoreMainAdmincp" id="effectStoreMainAdmincp" class="form-control"/></div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-2">Cửa hàng áp dụng: <span class="required" aria-required="true">*</span></label>
												<div class="col-md-5">
													<select class="3col active" multiple="multiple" name="useStoreAdmincp[]" >
														<?php foreach ($stores as $key => $s) { ?>
															<?php  
																$select = '';
																if (isset($result->useStore) && $result->useStore!='') {
																	$storeSelected = explode(',', $result->useStore);
																	// $storeSelected = unserialize($result->useStore);
																	if(in_array($s->id, $storeSelected)){
																		$select = 'selected="selected"';
																	}
																}
																echo $select;
															?>
															<option value="<?= $s->id; ?>" <?= $select; ?> ><?= $s->name; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="form-group ">
												<label class="control-label col-md-2">Mô tả phẩm: <span class="required" aria-required="true">*</span></label>
												<div class="col-md-8"><textarea name="descriptionAdmincp" id="descriptionAdmincp" cols="" rows="5" class="form-control"><?php if(isset($result->description)) { print $result->description; }else{ print '';} ?></textarea></div>
											</div>

 
											<div class="form-group">
												<label class="control-label col-md-2">Hình đại diện(400x180): <span class="required" aria-required="true">*</span></label>
												<div class="col-md-3">
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<?php if(isset($result->image)){ if($result->image!=''){ ?>
														<div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
															<img src="<?=resizeImage(PATH_URL.DIR_UPLOAD_PRODUCT.$result->image,150, 150)?>" />
														</div>
														<?php }} ?>
														<div class="input-group input-large fallback">
															<div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
																<i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
																</span>
															</div>
															<span class="input-group-addon btn default btn-file">
															<span class="fileinput-new">
															Chọn image </span>
															<span class="fileinput-exists">
															Change </span>
															<input type="file" id="imageAdmincp" name="fileAdmincp[image]">
															</span>
															<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
															xóa </a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab2">
										<div class="form-body">
										<?php if($quotes) { ?>
											<?php $checkQuoteExist = array(); ?>	
											<?php foreach ($quotes as $key => $quote){
												array_push($checkQuoteExist, $quote->storeId); 
											} ?>
										<?php } ?>
										<?php foreach ($stores as $key => $store){ ?>
											<?php if($quotes) { ?>
												<?php if (in_array($store->id, $checkQuoteExist)) { ?>
													<?php foreach ($quotes as $key => $quote){ ?>
														<?php if($store->id == $quote->storeId) { ?>
															<div class="form-group">
																<label class="control-label col-md-2"><?=$store->name;?>: <span class="required" aria-required="true">*</span></label>
																<div class="col-md-4">
																	<input value="<?= $quote->value;?>" type="text" name="storeAdmincp[<?= $store->id;?>]" id="storeAdmincp" class="form-control"/>
																</div>
															</div>	
														<?php } ?>
													<?php } ?>
												<?php } else { ?>
													<div class="form-group">
														<!--  -->
														<label class="control-label col-md-2"><?=$store->name;?>: <span class="required" aria-required="true">*</span></label>
														<div class="col-md-4">
															<input type="text" name="storeAdmincp[<?=$store->id;?>]" id="storeAdmincp" class="form-control"/>
														</div>
													</div>
												<?php } ?>
											<?php } else { ?>			
											<div class="form-group">
												<!--  -->
												<label class="control-label col-md-2"><?=$store->name;?>: <span class="required" aria-required="true">*</span></label>
												<div class="col-md-4">
													<input type="text" name="storeAdmincp[<?=$store->id;?>]" id="storeAdmincp" class="form-control"/>
												</div>
											</div>
											<?php } ?>	
										<?php } ?>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-9">
								<button onclick="save()" type="button" class="btn green" id="btnsave"><i class="fa fa-pencil"></i> Save</button>
								<a href="<?=PATH_URL_ADMIN.$module.'/#/back'?>"><button type="button" class="btn default">Cancel</button></a>
							</div>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END PAGE CONTENT-->
