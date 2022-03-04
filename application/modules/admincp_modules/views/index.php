<input type="hidden" value="<?php ($this->session->userdata('start'))? print $this->session->userdata('start') : print 0 ?>" id="start" />
<input type="hidden" value="<?=$default_func?>" id="func_sort" />
<input type="hidden" value="<?=$default_sort?>" id="type_sort" />
<div class="gr_perm_error" style="display:none;">
	<p><strong>FAILURE: </strong>Permission Denied.</p>
</div>
<div class="gr_perm_success" style="display:none;">
	<p><strong>SAVE SUCCESS.</strong></p>
</div>

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
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-sharp">
                    <i class="icon-puzzle font-red-flamingo"></i>
                    <span class="caption-subject bold font-red-flamingo uppercase"> Search Form</span>
                </div>
                <div class="actions">
	                <a href="javascript:;" onclick="searchContent(0)" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-search"></i> Search</a>
	            </div>
			</div>
			
			<div class="portlet-action">
				<div class="table-toolbar" style="margin-bottom:0">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<form class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-2 control-label">Module:</label>
									<div class="col-sm-4"><input onkeypress="return enterSearch(event)" type="text" class="form-control" id="search_module_name"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Create Date:</label>
									<div class="col-sm-4">
										<div class="input-group date-picker input-daterange" data-date-format="yyyy/mm/dd" style="width: 100%;">
											<input onkeypress="return enterSearch(event)" id="caledar_from" type="text" class="form-control" name="from">
											<span class="input-group-addon">to</span>
											<input onkeypress="return enterSearch(event)" id="caledar_to" type="text" class="form-control" name="to">
										</div>
									</div>
									<label class="col-sm-2 control-label">Status:</label>
									<div class="col-sm-4">
										<label class="radio-inline"><input onclick="searchContent(0)" type="radio" name="search_status" value="2" checked> All</label>
										<label class="radio-inline"><input onclick="searchContent(0)" type="radio" name="search_status" value="0"> Blocked</label>
										<label class="radio-inline"><input onclick="searchContent(0)" type="radio" name="search_status" value="1"> Approved</label>
                                    </div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-sharp">
                    <i class="icon-speech font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> List Data</span>
                </div>
                <div class="actions">
                	<select id="per_page" class="form-control input-sm input-circle input-inline" onchange="searchContent(0,this.value)">
						<option value="10">10 records</option>
						<option value="20">20 records</option>
						<option value="50">50 records</option>
						<option value="100">100 records</option>
					</select>
	                <a href="javascript:;" onclick="searchContent(0)" class="btn btn-info btn-circle btn-sm"><i class="fa fa-spinner"></i> Reload</a>
	            	<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""></a>
	            </div>
			</div>
			<div class="portlet-body" style="padding-top:5px;padding-bottom:9px;"></div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END PAGE CONTENT-->