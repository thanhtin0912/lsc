<input type="hidden" value="<?php ($this->session->userdata('start'))? print $this->session->userdata('start') : print 0 ?>" id="start" />
<input type="hidden" value="<?=$default_func?>" id="func_sort" />
<input type="hidden" value="<?=$default_sort?>" id="type_sort" />
<div class="gr_perm_error" style="display:none;">
	<p><strong>FAILURE: </strong>Permission Denied.</p>
</div>
<div class="gr_perm_success" style="display:none;">
	<p><strong>SAVE SUCCESS.</strong></p>
</div>
<link rel="stylesheet" href="https://preview.keenthemes.com/metronic-v4/theme/assets/global/css/components.min.css">
<link rel="stylesheet" href="https://preview.keenthemes.com/metronic-v4/theme/assets/apps/css/todo.min.css">
<script type="text/javascript" src="<?= PATH_URL . 'assets/js/admin/' ?>table2csv.min.js"></script>
<style>
.mt-element-list .list-todo.mt-list-container ul>.mt-list-item>.list-todo-item {
    margin-left: 15px;
    display: inline-block;
    vertical-align: top;
    width: 85% !important;
    position: relative;
}
</style>
<script>
	function searchInvenToday(store, name){
		var el = $('a.reload').closest(".portlet").children(".portlet-body");
		var date = $('#report-date').val();
	
		$.post(root+module+'/ajaxLoadContent',{
			store : store,
			date: date,
			csrf_token: token_value
		},function(data){
			$('#data-table-report').show();
			$('.dataTables_wrapper').html(data);
			const button = `<button class="btn blue" type="button" onclick="searchInvenToday(${store}, '${name}')">Tìm kiếm</button>`
			$('#title-report').text('Báo cáo tồn kho - '+ name +' - ngày  ' + date );
			$('#search-report').html(button);
		});
	}
	function exportExcel() {
		// document.getElementsByClassName("table")[0].classList.remove("hidden");
		var date = new Date();
		$("#data-table").table2csv({
			filename: date + '.csv'
		});
		// document.getElementsByClassName("table")[0].classList+= " hidden";
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
	<div class="col-md-5">
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
								<li class="mt-list-item">
									<div class="list-todo-icon bg-white font-blue-steel">
										<i class="fa fa-database"></i>
									</div>
									<div class="list-todo-item blue-steel">
										<a class="list-toggle-container font-white collapsed" data-toggle="modal" href="#todo-task-modal" onclick="searchInvenToday(<?=$c->id; ?>, '<?=$c->name; ?>')">
											<div class="list-toggle done uppercase">
												<div class="list-toggle-title bold"><?=$c->name; ?></div>
												<div class="badge badge-default pull-right" style="height: 22px;"><i class="fa fa-arrow-right"></i></div>
											</div>
										</a>
									</div>
								</li>
							<?php }  ?>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
	<div class="col-md-7"  id="data-table-report" style="display:none">
		<div class="portlet light portlet-fit bordered">
			<div class="portlet box blue data-table">
				<div class="portlet-title">
					<div class="caption bold" ><span id="title-report"></span></div>
				</div>
				<div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6 d-flex">
                                <div class="input-group pr-2">
                                    <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" value="<?= date('Y-m-d'); ?>" id="report-date">
									<span class="input-group-btn" id="search-report">
                                       
                                    </span>
                                </div>
                                <button class="btn blue" type="button" onclick="exportExcel()">Xuất File</button>
                            </div>
                        </div>
                    </div>
					<div class="dataTables_wrapper">
												
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT-->
