<script type="text/javascript" src="<?=PATH_URL.'assets/js/admin/'?>jquery.slugit.js"></script>
<script type="text/javascript" src="<?=PATH_URL.'assets/ckeditor/ckeditor.js'?>"></script>
<script type="text/javascript">
$(document).ready( function() {
	$("#titleAdmincp").slugIt({
		events: 'keyup blur',
		output: '#slugAdmincp',
		space: '-'
	});

	CKEDITOR.replace( 'content_vnAdmincp', {
        filebrowserBrowseUrl: '<?=PATH_URL?>assets/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '<?=PATH_URL?>assets/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: '<?=PATH_URL?>assets/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl: '<?=PATH_URL?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '<?=PATH_URL?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: '<?=PATH_URL?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    } );

    CKEDITOR.replace( 'content_enAdmincp', {
        filebrowserBrowseUrl: '<?=PATH_URL?>assets/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '<?=PATH_URL?>assets/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: '<?=PATH_URL?>assets/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl: '<?=PATH_URL?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '<?=PATH_URL?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: '<?=PATH_URL?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    } );
});

function save(){
	var options = {
		beforeSubmit:  showRequest,  // pre-submit callback 
		success:       showResponse  // post-submit callback 
    };
	$('#content_vnAdmincp').val(CKEDITOR.instances['content_vnAdmincp'].getData());
	$('#content_enAdmincp').val(CKEDITOR.instances['content_enAdmincp'].getData());
	$('#frmManagement').ajaxSubmit(options);
}

function showRequest(formData, jqForm, options) {
	var form = jqForm[0];

	<?php if($id==0){ ?>
        if($('#imageAdmincp').val() == ''){
            $('#txt_error').html('Please choose image.');
            show_perm_denied();
            return false;
        }
    <?php } ?>
	
	if(form.titleAdmincp.value == '' || form.cateAdmincp.value == '' || form.description_vnAdmincp.value == '' || $('#content_vnAdmincp').val() == '<br>' || $('#content_vnAdmincp').val() == '' || ($('#content_vnAdmincp').val().charCodeAt(0)==10 && isNaN($('#content_vnAdmincp').val().charCodeAt(1)))){
		$('#txt_error').html('Please enter information.');
		show_perm_denied();
		return false;
	}

	if(form.title_enAdmincp.value == '' || form.description_enAdmincp.value == '' || $('#content_enAdmincp').val() == '<br>' || $('#content_enAdmincp').val() == '' || ($('#content_enAdmincp').val().charCodeAt(0)==10 && isNaN($('#content_enAdmincp').val().charCodeAt(1)))){
		$('#txt_error').html('Please enter information.');
		show_perm_denied();
		return false;
	}

	// if(form.seo_titleAdmincp.value == '' || form.seo_keywordsAdmincp.value == '' || form.seo_descriptionAdmincp.value == ''){
	// 	$('#txt_error').html('Please enter SEO information.');
	// 	show_perm_denied();
	// 	return false;
	// }
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
							<label class="control-label col-md-2">Categories: <span class="required" aria-required="true">*</span></label>
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
							<label class="control-label col-md-2">Image (900x500): <span class="required" aria-required="true">*</span></label>
							<div class="col-md-3">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<?php if(isset($result->image)){ if($result->image!=''){ ?>
									<div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
										<img src="<?=resizeImage(PATH_URL.DIR_UPLOAD_NEWS.$result->image,150, 150)?>" />
									</div>
									<?php }} ?>
									<div class="input-group input-large">
										<div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
											<i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
											</span>
										</div>
										<span class="input-group-addon btn default btn-file">
										<span class="fileinput-new">
										Select file </span>
										<span class="fileinput-exists">
										Change </span>
										<input type="file" id="imageAdmincp" name="fileAdmincp[image]">
										</span>
										<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
										Remove </a>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Title: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><input value="<?php if(isset($result->title_vn)) { print $result->title_vn; }else{ print '';} ?>" type="text" name="titleAdmincp" id="titleAdmincp" class="form-control"/></div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Title_en: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><input value="<?php if(isset($result->title_en)) { print $result->title_en; }else{ print '';} ?>" type="text" name="title_enAdmincp" id="title_enAdmincp" class="form-control"/></div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Slug: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><input value="<?php if(isset($result->slug)) { print $result->slug; }else{ print '';} ?>" type="text" name="slugAdmincp" id="slugAdmincp" class="form-control"/></div>
						</div>
						<div class="form-group last">
							<label class="control-label col-md-2">Description: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><textarea name="description_vnAdmincp" id="description_vnAdmincp" cols="" rows="5" class="form-control"><?php if(isset($result->description_vn)) { print $result->description_vn; }else{ print '';} ?></textarea></div>
						</div>
						<div class="form-group last">
							<label class="control-label col-md-2">Description_en: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><textarea name="description_enAdmincp" id="description_enAdmincp" cols="" rows="5" class="form-control"><?php if(isset($result->description_en)) { print $result->description_en; }else{ print '';} ?></textarea></div>
						</div>

						<div class="form-group last">
							<label class="control-label col-md-2">Content: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><textarea name="content_vnAdmincp" id="content_vnAdmincp" cols="" rows="8"><?php if(isset($result->content_vn)) { print $result->content_vn; }else{ print '';} ?></textarea></div>
						</div>
						<div class="form-group last">
							<label class="control-label col-md-2">Content_en: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><textarea name="content_enAdmincp" id="content_enAdmincp" cols="" rows="8"><?php if(isset($result->content_en)) { print $result->content_en; }else{ print '';} ?></textarea></div>
						</div>

<!-- 						<div class="form-group">
							<label class="control-label col-md-2">SEO title: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><input value="<?php if(isset($result->seo_title)) { print $result->seo_title; }else{ print '';} ?>" type="text" name="seo_titleAdmincp" id="seo_titleAdmincp" class="form-control"/></div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">SEO keywords: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><input value="<?php if(isset($result->seo_keywords)) { print $result->seo_keywords; }else{ print '';} ?>" type="text" name="seo_keywordsAdmincp" id="seo_keywordsAdmincp" class="form-control"/></div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">SEO description: <span class="required" aria-required="true">*</span></label>
							<div class="col-md-10"><input value="<?php if(isset($result->seo_description)) { print $result->seo_description; }else{ print '';} ?>" type="text" name="seo_descriptionAdmincp" id="seo_descriptionAdmincp" class="form-control"/></div>
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