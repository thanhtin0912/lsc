<input type="hidden" value="<?php ($this->session->userdata('start'))? print $this->session->userdata('start') : print 0 ?>" id="start" />

<div class="gr_perm_error" style="display:none;">
	<p><strong>FAILURE: </strong>Permission Denied.</p>
</div>
<div class="gr_perm_success" style="display:none;">
	<p><strong>SAVE SUCCESS.</strong></p>
</div>
<link rel="stylesheet" href="https://preview.keenthemes.com/metronic-v4/theme/assets/global/css/components.min.css">
<link rel="stylesheet" href="https://preview.keenthemes.com/metronic-v4/theme/assets/apps/css/todo.min.css">
<script type="text/javascript" src="<?= PATH_URL . 'assets/js/admin/' ?>jquery.form.js"></script>
<style>
.mt-element-list .list-todo.mt-list-container ul>.mt-list-item>.list-todo-item {
    margin-left: 15px;
    display: inline-block;
    vertical-align: top;
    width: 85% !important;
    position: relative;
}

#importControl {
    color: #fff;
    z-index: 99;
    font-size: 20px;
    background: #222;
    position: relative;
    right: 14px !important;
    bottom: 45px !important;
    border-radius: 3px !important;
}
</style>
<script type="text/javascript">
	function calculatorQuoteCustom(store){
		var store = $('#store').val();
		var rate = $('#rate').val();
		var from = $('#caledar_from').val();
		var to = $('#caledar_to').val();
		var days = $('#days').val();
		$.post(root+module+'/ajaxLoadContent',{
			rate : rate,
			from: from,
			to: to,
			days: days,
			store: store,
			csrf_token: token_value
		},function(data){
			$('#data-table-report').show();
			$('.dataTables_wrapper').html(data);
			document.getElementsByClassName("handle-control")[0].classList.remove("d-none");
			document.getElementsByClassName("dataTables_wrapper")[0].classList.remove("d-none");
		});
	}

	function loadFilter(store, name, from= '', to = '', days, isCustom = 0, rate = 0, storeId = 0){
			$('#data-table-report').show();
			$('#store').val(store);
			$('#rate').val(rate);
			$('#storeId').val(storeId);
			$('#caledar_from').val(from);
			$('#caledar_to').val(to);
			if (isCustom!=0) {
				$('#isCustom').parent("span").addClass('checked');
			} else {
				$('#isDefault').parent("span").addClass('checked');
			}
			// 
			$('#days').val(days);

			$('#title-report').text('Cài đặt định mức - ' + name);
			document.getElementsByClassName("dataTables_wrapper")[0].className += " d-none";
			document.getElementsByClassName("handle-control")[0].classList+= " d-none";
			
	}

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
			notify('danh sách định lượng đã được cập nhật .', 'success');
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
<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div class="modal fade" id="portlet-alert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Alert !!!</h4>
			</div>
			<div class="modal-body">
				Are you sure you want to delete the selected item?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn blue" onclick="deleteAll()">Delete</button>
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->


<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"><?=$module_name?></h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?=PATH_URL_ADMIN?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><?=$module_name?></li>
	</ul>
</div>
<!-- END PAGE HEADER-->
<div class="row">
    
</div>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-4">
		<div class="portlet light portlet-fit bordered">
			<div class="">
				<div class="mt-element-list">
					<div class="mt-list-head list-todo dark">
						<div class="list-head-title-container">
							<h3 class="list-title">Danh sách kho</h3>
						</div>
					</div>
					<div class="mt-list-container list-todo">
						<div class="list-todo-line red"></div>
						<ul>
							<?php foreach ($cates as $key => $c) { ?>
								<?php if (!$c->isMain) { ?>
								<li class="mt-list-item ">
									<div class="list-todo-icon bg-white font-blue-steel">
										<i class="fa fa-database"></i>
									</div>
									<div class="list-todo-item blue-steel">
										<a class="list-toggle-container font-white collapsed" data-toggle="modal" href="#todo-task-modal" 
										onclick="loadFilter('<?=$c->id; ?>','<?=$c->name; ?>', '<?=$c->fromDate; ?>', '<?=$c->toDate; ?>','<?=$c->days; ?>', '<?=$c->isCustom; ?>', '<?=$c->rate; ?>', '<?=$c->storeId; ?>')">
											<div class="list-toggle done uppercase">
												<div class="list-toggle-title bold"><?=$c->name; ?></div>
												<div class="badge badge-default pull-right" style="height: 22px;"><i class="fa fa-arrow-right"></i></div>
											</div>
										</a>
									</div>
								</li>
								<?php }  ?>
							<?php }  ?>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
	<div class="col-md-8"  id="data-table-report" style="display:none">
		<div class="portlet light portlet-fit bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-paper-plane font-green-haze"></i>
						<span class="caption-subject bold font-green-haze uppercase" id="title-report">Form Input</span>
					</div>
				</div>
				<div class="portlet-body form">
					<form id="frmManagement" action="<?=PATH_URL_ADMIN.$module.'/save/'?>" method="post" enctype="multipart/form-data" class="form-horizontal form-row-seperated">
        			<input type="hidden" value="<?=$this->security->get_csrf_hash()?>" id="csrf_token" name="csrf_token" />
					<input type="hidden" value="" id="store" name="storeAdmincp"/>
					<input type="hidden" value="" id="storeId" name="hiddenIdAdmincp"/>
					
					<div class="form-group">
						<label class="control-label col-md-3">Loại định mức:</label>
						<div class="col-md-9">
							<label class="radio-inline"><input type="radio" id="isDefault" name="isCustomAdmincp" value="0" > Mặc định</label>
							<label class="radio-inline"><input type="radio" id="isCustom" name="isCustomAdmincp" value="1" > Tự động</label>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Tỷ lệ :</label>
						<div class="col-md-9">
							<input type="text" class="form-control" placeholder="Tỷ lệ %" id="rate" name="rateAdmincp">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3">Khoản thời gian:</label>
						<div class="col-md-9">
							<div class="input-group date-picker input-daterange" data-date-format="yyyy-mm-dd" style="width: 100%;">
								<input onkeypress="return enterSearch(event)" id="caledar_from" type="text" placeholder="date" class="form-control" name="from">
								<span class="input-group-addon">to</span>
								<input onkeypress="return enterSearch(event)" id="caledar_to" type="text" placeholder="date" class="form-control" name="to">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Chọn nhanh ngày:</label>
						<div class="col-md-6">
							<select class="form-control" data-live-search="true" data-size="8" name="daysAdmincp" id="days">
								<option value="">None</option>
								<?php foreach ($days as $key => $c): ?>
									<option value="<?= $c->name; ?>"><?= $c->name; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-9">
								<button class="btn blue" type="button" onclick="calculatorQuoteCustom()">Xem</button>	
							</div>
						</div>
					</div>
					<div class="dataTables_wrapper form-actions">
											
					</div>
					<div id="importControl" style="position: fixed; right: 5px; opacity: 1; cursor: pointer;">
						<button class="btn blue btn-u-dark p-3 handle-control d-none"  type="button" onclick="save()">Áp dụng</button>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT-->
