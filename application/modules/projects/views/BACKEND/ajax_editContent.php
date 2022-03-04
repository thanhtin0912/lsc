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

	$('#content_vnAdmincp').liveEdit({
		height: 350,
		css: ['<?=PATH_URL?>assets/editor/bootstrap/css/bootstrap.min.css', '<?=PATH_URL?>assets/editor/bootstrap/bootstrap_extend.css','<?=PATH_URL?>assets/css/styles.css'] /* Apply bootstrap css into the editing area */,
		fileBrowser: '<?=PATH_URL?>assets/editor/assetmanager/asset.php',
		returnKeyMode: 3,
		groups: [
				["group1", "", ["Bold", "Italic", "Underline", "ForeColor", "RemoveFormat"]],
				["group2", "", ["Bullets", "Numbering", "Indent", "Outdent", "JustifyLeft", "JustifyCenter", "JustifyRight"]],
				["group3", "", ["Paragraph", "FontSize", "FontDialog", "TextDialog"]],
				["group4", "", ["LinkDialog", "ImageDialog", "TableDialog"]],
				["group5", "", ["Undo", "Redo", "FullScreen", "SourceDialog"]],
				["group6", "", ["Left", "Center", "Right"]]
				] /* Toolbar configuration */
	});
	$('#content_vnAdmincp').data('liveEdit').startedit();
	// english
	$('#content_enAdmincp').liveEdit({
		height: 350,
		css: ['<?=PATH_URL?>assets/editor/bootstrap/css/bootstrap.min.css', '<?=PATH_URL?>assets/editor/bootstrap/bootstrap_extend.css','<?=PATH_URL?>assets/css/styles.css'] /* Apply bootstrap css into the editing area */,
		fileBrowser: '<?=PATH_URL?>assets/editor/assetmanager/asset.php',
		returnKeyMode: 3,
		groups: [
				["group1", "", ["Bold", "Italic", "Underline", "ForeColor", "RemoveFormat"]],
				["group2", "", ["Bullets", "Numbering", "Indent", "Outdent", "JustifyLeft", "JustifyCenter", "JustifyRight"]],
				["group3", "", ["Paragraph", "FontSize", "FontDialog", "TextDialog"]],
				["group4", "", ["LinkDialog", "ImageDialog", "TableDialog"]],
				["group5", "", ["Undo", "Redo", "FullScreen", "SourceDialog"]],
				["group6", "", ["Left", "Center", "Right"]]
				] /* Toolbar configuration */
	});
	$('#content_enAdmincp').data('liveEdit').startedit();
});

function save(){
	var options = {
		beforeSubmit:  showRequest,  // pre-submit callback 
		success:       showResponse  // post-submit callback 
    };
	// $('#content_vnAdmincp').val($('#content_vnAdmincp').data('liveEdit').getXHTMLBody());
	// $('#content_enAdmincp').val($('#content_enAdmincp').data('liveEdit').getXHTMLBody());
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
    <?php if($id==0){ ?>
        if($('#imageAdmincp').val() == ''){
            $('#txt_error').html('Vui lòng chọn hình ảnh.');
            show_perm_denied();
            return false;
        }
    <?php } ?>
	if(form.projectbyAdmincp.value == '' || form.customerAdmincp.value == '' || form.locationAdmincp.value == '' || form.startdateAdmincp.value == ''){
		$('#txt_error').html('Please enter information.');
		show_perm_denied();
		return false;
	}
	if(form.name_vnAdmincp.value == '' || form.cateAdmincp.value == ''){
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
							<label class="control-label col-md-2">Danh mục: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-6">
								<select class="select form-control" data-live-search="true" data-size="8" name="cateAdmincp" id="cateAdmincp">
									<option value="">None</option>
									<?php foreach ($cates as $key => $cate): ?>
										<?php  
											$select = '';
											if($result->type == $cate->id){
												$select = 'selected="selected"';
											}
										?>
										<option value="<?= $cate->id; ?>" <?= $select; ?> ><?= $cate->name_vn; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Tên dự án _vn: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><input value="<?php if(isset($result->name_vn)) { print $result->name_vn; }else{ print '';} ?>" type="text" name="name_vnAdmincp" id="name_vnAdmincp" class="form-control"/></div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Tên dự án _en: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><input value="<?php if(isset($result->name_en)) { print $result->name_en; }else{ print '';} ?>" type="text" name="name_enAdmincp" id="name_enAdmincp" class="form-control"/></div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Slug: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><input value="<?php if(isset($result->slug)) { print $result->slug; }else{ print '';} ?>" type="text" name="slugAdmincp" id="slugAdmincp" class="form-control"/></div>
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
						<div class="form-group last">
							<label class="control-label col-md-2">Người thực hiện: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10">
								<input value="<?php if(isset($result->projectby)) { print $result->projectby; }else{ print '';} ?>" type="text" name="projectbyAdmincp" id="projectbyAdmincp" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<!--  -->
							<label class="control-label col-md-2">Khách hàng: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-3">
								<input value="<?php if(isset($result->customer)) { print $result->customer; }else{ print '';} ?>" type="text" name="customerAdmincp" id="customerAdmincp" class="form-control "/>
							</div>
							<label class="control-label col-md-2">Địa chỉ khách hàng: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-3">
								<input value="<?php if(isset($result->location)) { print $result->location; }else{ print '';} ?>" type="text" name="locationAdmincp" id="locationAdmincp" class="form-control "/>
							</div>
						</div>
						<div class="form-group">
							<!--  -->
							<label class="control-label col-md-2">Ngày bắt đầu: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-3">
								<input value="<?php if(isset($result->startdate)) { print $result->startdate; }else{ print '';} ?>" type="text" name="startdateAdmincp" id="startdateAdmincp" class="form-control "/>
							</div>
							<label class="control-label col-md-2">Ngày kết thúc: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-3">
								<input value="<?php if(isset($result->enddate )) { print $result->enddate; }else{ print '';} ?>" type="text" name="enddateAdmincp" id="enddateAdmincp" class="form-control "/>
							</div>
						</div>

<!-- 						<div class="form-group last">
							<label class="control-label col-md-2">Mô tả _vn: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><textarea name="description_vnAdmincp" id="description_vnAdmincp" cols="" rows="5" class="form-control"><?php if(isset($result->description_vn)) { print $result->description_vn; }else{ print '';} ?></textarea></div>
						</div>
						<div class="form-group last">
							<label class="control-label col-md-2">Mô tả _en: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><textarea name="description_enAdmincp" id="description_enAdmincp" cols="" rows="5" class="form-control"><?php if(isset($result->description_en)) { print $result->description_en; }else{ print '';} ?></textarea></div>
						</div> -->

						<div class="form-group last">
							<label class="control-label col-md-2">Thông tin chi tiết _vn: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><textarea name="content_vnAdmincp" id="content_vnAdmincp" cols="" rows="8"><?php if(isset($result->content_vn)) { print $result->content_vn; }else{ print '';} ?></textarea></div>
						</div>
						<div class="form-group last">
							<label class="control-label col-md-2">Thông tin chi tiết _en: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><textarea name="content_enAdmincp" id="content_enAdmincp" cols="" rows="8"><?php if(isset($result->content_en)) { print $result->content_en; }else{ print '';} ?></textarea></div>
						</div>

						<!-- <div class="form-group">
							<label class="control-label col-md-2">Phản hồi khách hàng (nếu có): <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><input value="<?php if(isset($result->comment)) { print $result->comment; }else{ print '';} ?>" type="text" name="commentAdmincp" id="commentAdmincp" class="form-control"/></div>
						</div> -->
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