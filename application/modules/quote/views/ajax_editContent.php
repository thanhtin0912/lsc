<script type="text/javascript" src="<?= PATH_URL . 'assets/js/admin/' ?>table2csv.min.js"></script>
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

function exportExcel() {
	document.getElementsByClassName("table")[0].classList.remove("hidden");
	var date = new Date();
	$("#tab").table2csv({
		filename: date + '.csv'
	});
	document.getElementsByClassName("table")[0].classList+= " hidden";
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
				<div class="float-right">
					<button onclick="exportExcel()" type="button" class="btn green"><i class="fa fa-pencil"></i> Xuất File</button>
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

						<div class="form-group">
							<label class="control-label col-md-2">Status:</label>
							<div class="col-md-10">
								<label class="radio-inline"> <input type="radio" name="statusAdmincp" value="0" <?php if(isset($result->status)){ if($result->status== 0){ ?>checked="checked"<?php }}else{ ?>checked <?php } ?> > Block </label>
								<label class="radio-inline"> <input type="radio" name="statusAdmincp" value="1" <?php if(isset($result->status)){ if($result->status== 1){ ?>checked="checked"<?php }}else{ ?>checked <?php } ?> > Approved </label>
							</div>
						</div>

						<?php foreach ($results as $key => $p) { ?>
							<div class="form-group">
								<label class="control-label col-md-2"><?= $p->name;?> : </label>
								<div class="col-md-2"><input value="<?= $p->value;?>" type="text" name="valueAdmincp[<?= $p->id;?>]" class="form-control"/></div>
								<label class="control-label col-md-2">Update: <?= $p->updated;?>  </label>
								<label class="control-label col-md-2">Tối thiểu : </label>
								<div class="col-md-2"><input value="<?= $p->valueMin;?>" type="text" name="valueMinAdmincp[<?= $p->id;?>]"  class="form-control"/></div>
							</div>
						<?php } ?>
						
						<table id="tab" class="table hidden">
							<tr>
								<th>Tên</th>
								<th>Định lượng</th>
							</tr>
							<?php foreach ($results as $key => $p) { ?>
							<tr>
								<td><?= $p->name;?></td>
								<td><?= $p->value;?></td>
							</tr>
							<?php } ?>
						</table>
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