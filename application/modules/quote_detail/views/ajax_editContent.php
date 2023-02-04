<script type="text/javascript">

function save(){
	var options = {
		beforeSubmit:  showRequest,  // pre-submit callback 
		success:       showResponse  // post-submit callback 
    };
	$('#frmManagement').ajaxSubmit(options);
}

function showRequest(formData, jqForm, options) {
	var form = jqForm[0];

	if(form.nameAdmincp.value == '' || form.valueAdmincp.value == '' || form.fromAdmincp.value == '' || form.toAdmincp.value == '' || form.productAdmincp.value == '' || form.storeAdmincp.value == '' ){
		$('#txt_error').html('Please enter data.');
		show_perm_denied();
		return false;
	}

}

function showResponse(responseText, statusText, xhr, $form) {
	responseText = responseText.split(".");
	token_value  = responseText[1];
	$('#csrf_token').val(token_value);
	if(responseText[0]=='success'){
		show_perm_success();
	}

	if(responseText[0]=='permission-denied'){
		$('#txt_error').html('Permission denied.');
		show_perm_denied();
		return false;
	}
	
	if(responseText[0]=='error-phone-exists'){
		$('#txt_error').html('name already exists.');
		show_perm_denied();
		$('#nameAdmincp').focus();
		return false;
	}
}

</script>
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
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-2">Status:</label>
							<div class="col-md-10">
								<label class="radio-inline"> <input type="radio" name="statusAdmincp" value="0" <?php if(isset($result->status)){ if($result->status== 0){ ?>checked="checked"<?php }}else{ ?>checked <?php } ?> > Block </label>
								<label class="radio-inline"> <input type="radio" name="statusAdmincp" value="1" <?php if(isset($result->status)){ if($result->status== 1){ ?>checked="checked"<?php }}else{ ?>checked <?php } ?> > Approved </label>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Sản phẩm: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-8">
								<select class="bs-select form-control" data-live-search="true" data-size="8" name="productAdmincp" id="productAdmincp">
									<option value="">None</option>
									<?php foreach ($products as $key => $pro): ?>
										<?php  
											$select = '';
											if (isset($result->productId)) {
												if($result->productId == $pro->id){
													$select = 'selected="selected"';
												}
											}
										?>
										<option value="<?= $pro->id; ?>" <?= $select; ?> ><?= $pro->name; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Lý do : <span class="required" aria-required="true">*</span></label>
							<div class="col-md-8"><input value="<?php if(isset($result->name)) { print $result->name; }else{ print '';} ?>" type="text" name="nameAdmincp" id="nameAdmincp" class="form-control"/></div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Định mức mong muốn: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-3"><input value="<?php if(isset($result->value)) { print $result->value; }else{ print '';} ?>" type="text" name="valueAdmincp" id="valueAdmincp" class="form-control"/></div>

							<label class="control-label col-md-2">Cửa hàng: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-3">
								<select class="select form-control" data-live-search="true" data-size="8" name="storeAdmincp" id="storeAdmincp">
									<option value="">None</option>
									<?php foreach ($cates as $key => $cate): ?>
										<?php  
											$select = '';
											if (isset($result->storeId)) {
												if($result->storeId == $cate->id){
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
							<label class="col-sm-2 control-label">Thời gian áp dụng:</label>
							<div class="col-sm-4">
								<div class="input-group date-picker input-daterange" data-date-format="yyyy-mm-dd" style="width: 100%;">
									<input value="<?php if(isset($result->from)) { print $result->from; }else{ print '';} ?>" id="caledar_from" type="text" class="form-control" name="fromAdmincp">
									<span class="input-group-addon">to</span>
									<input value="<?php if(isset($result->to)) { print $result->to; }else{ print '';} ?>" id="caledar_to" type="text" class="form-control" name="toAdmincp">
								</div>
							</div>
						</div>

					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-9">
								<button onclick="save()" type="button" class="btn green"><i class="fa fa-pencil"></i> Save</button>
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