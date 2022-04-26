<script type="text/javascript" src="<?=PATH_URL.'assets/js/admin/'?>jquery.slugit.js"></script>
<script type="text/javascript" src="<?=PATH_URL.'assets/editor/scripts/innovaeditor.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'assets/editor/scripts/innovamanager.js'?>"></script>
<script type="text/javascript">
$(document).ready( function() {
	$("#name_vnAdmincp").slugIt({
		events: 'keyup blur',
		output: '#slugAdmincp',
		space: '-'
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

	<?php if($id==0){ ?>
        if($('#avataAdmincp').val() == ''){
            $('#txt_error').html('Vui lòng chọn hình ảnh.');
            show_perm_denied();
            return false;
        }
    <?php } ?>
	if(form.name_vnAdmincp.value == ''){
		$('#txt_error').html('Please enter information.');
		show_perm_denied();
		return false;
	}

	if(form.name_enAdmincp.value == '' ){
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
		$('#txt_error').html('Title already exists.');
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
								<label class="radio-inline"><input type="radio" name="statusAdmincp" value="0" <?= isset($result->status) ? $result->status == 0 ? 'checked' : '' : '' ?> > Blocked</label>
								<label class="radio-inline"><input type="radio" name="statusAdmincp" value="1" <?= isset($result->status) ? $result->status == 1 ? 'checked' : '' : 'checked' ?> > Approved</label>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">HighLight:</label>
							<div class="col-md-10">
								<label class="radio-inline"><input type="radio" name="highlightAdmincp" value="0" <?= isset($result->status) ? $result->status == 0 ? 'checked' : '' : '' ?> > Blocked</label>
								<label class="radio-inline"><input type="radio" name="highlightAdmincp" value="1" <?= isset($result->status) ? $result->status == 1 ? 'checked' : '' : 'checked' ?> > Approved</label>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Name _vn: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><input value="<?php if(isset($result->name_vn)) { print $result->name_vn; }else{ print '';} ?>" type="text" name="name_vnAdmincp" id="name_vnAdmincp" class="form-control"/></div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Name _en: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><input value="<?php if(isset($result->name_en)) { print $result->name_en; }else{ print '';} ?>" type="text" name="name_enAdmincp" id="name_enAdmincp" class="form-control"/></div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Slug: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><input value="<?php if(isset($result->slug)) { print $result->slug; }else{ print '';} ?>" type="text" name="slugAdmincp" id="slugAdmincp" class="form-control"/></div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Type:</label>
							<div class="col-md-10">
								<label class="radio-inline"><input type="radio" name="typeAdmincp" value="0" <?= isset($result->type) ? $result->type == 0 ? 'checked' : '' : '' ?> > Hình ảnh</label>
								<label class="radio-inline"><input type="radio" name="typeAdmincp" value="1" <?= isset($result->type) ? $result->type == 1 ? 'checked' : '' : 'checked' ?> > Video</label>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Hình đại diện(800x500): <span class="required" aria-required="true">*</span></label>
							<div class="col-md-3">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<?php if(isset($result->avata)){ if($result->avata!=''){ ?>
									<div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
										<img src="<?=resizeImage(PATH_URL.DIR_UPLOAD_PROJECTS.$result->avata,150, 150)?>" />
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
										<input type="file" id="avataAdmincp" name="fileAdmincp[avata]">
										</span>
										<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
										xóa </a>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Hình ảnh chi tiết (800x500): <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<?php if(isset($result->images)){ if($result->images!=''){ ?>

									<?php $resultImages = unserialize($result->images)?>
									<?php foreach ($resultImages as $key => $v): ;?>
                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
											<img src="<?=resizeImage(PATH_URL.DIR_UPLOAD_PROJECTS.$v,150, 150)?>" />
										</div>
                                    <?php endforeach ?>
									<?php }} ?>
									<div class="input-group input-large fallback">
										<div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
											<i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
											</span>
										</div>
										<span class="input-group-addon btn default btn-file">
										<span class="fileinput-new">
										Chọn images </span>
										<span class="fileinput-exists">
										Thay đổi </span>
										<input type="file" id="imageAdmincp" name="images[]" multiple>
										</span>
										<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
										Xóa </a>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group" >
							<label class="control-label col-md-2">Link video (youtube): <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><input value="<?php if(isset($result->urlVideo)) { print $result->urlVideo; }else{ print '';} ?>" type="text" name="urlVideoAdmincp" id="urlVideoAdmincp" class="form-control"/></div>
						</div>
						<div class="form-group last">
							<label class="control-label col-md-2">Mô tả _vn: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><textarea name="description_vnAdmincp" id="description_vnAdmincp" cols="" rows="5" class="form-control"><?php if(isset($result->description_vn)) { print $result->description_vn; }else{ print '';} ?></textarea></div>
						</div>
						<div class="form-group last">
							<label class="control-label col-md-2">Mô tả _en: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><textarea name="description_enAdmincp" id="description_enAdmincp" cols="" rows="5" class="form-control"><?php if(isset($result->description_en)) { print $result->description_en; }else{ print '';} ?></textarea></div>
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