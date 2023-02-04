<input type="hidden" value="<?php ($this->session->userdata('start'))? print $this->session->userdata('start') : print 0 ?>" id="start" />
<div class="gr_perm_error" style="display:none;">
	<p><strong>FAILURE: </strong>Permission Denied.</p>
</div>
<div class="gr_perm_success" style="display:none;">
	<p><strong>SAVE SUCCESS.</strong></p>
</div>
<link href="<?= PATH_URL . 'assets/css/admin/' ?>bootstrap-table.min.css" rel="stylesheet" type="text/css"/>
<style> 

.fixed-table-container tbody td {
	border-left: none ! important;
	font-size: 16px;
	padding: 10px;
}
.first-store {
	background-color: #52d609;
}
.first-store-under{
	background-color: #d6cc09;
}
</style>


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
	<div class="col-md-10">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-sharp">
                    <i class="icon-puzzle font-red-flamingo"></i>
                    <span class="caption-subject bold font-red-flamingo uppercase">So sánh tồn kho các đại lý</span>
                </div>
			
				<div class="bootstrap-table">
					<div class="fixed-table-toolbar"></div>
					<div class="fixed-table-container" style="height: 499px; padding-bottom: 40px;">
						<div class="fixed-table-header" style="margin-right: 0px;">
							<table class="table table-hover">
								<thead class="bold">
									<tr >
										<th data-field="id" tabindex="0" width="5%">
											<div class="th-inner">No.</div>
											<div class="fht-cell"></div>
										</th>
										<th width="20%" data-field="name" tabindex="0">
											<div class="th-inner">Sản phẩm</div>
											<div class="fht-cell" ></div>
										</th>
										<?php if($stores) { ?>
											<?php foreach ($stores as $key => $s) { ?>
										<th style="" data-field="price" tabindex="0">
											<div class="th-inner center"><?=$s->name;?></div>
											<div class="fht-cell" ></div>
										</th>
											<?php } ?>
										<?php } ?>
									</tr>
								</thead>
							</table>
						</div>
						<div class="fixed-table-body">
							<div class="fixed-table-loading" style="top: 41px; display: none;">Loading, please wait...</div>
							<table data-toggle="table" data-url="../assets/global/plugins/bootstrap-table/data/data1.json" data-height="599" class="table table-hover" style="margin-top: -40px;">
								<thead>
									<tr>
									<th data-field="id" tabindex="0" width="5%">
											<div class="th-inner">No.</div>
											<div class="fht-cell"></div>
										</th>
										<th data-field="name" tabindex="0" width="20.5%">
											<div class="th-inner">Sản phẩm</div>
											<div class="fht-cell"></div>
										</th>
										<?php if($stores) { ?>
											<?php foreach ($stores as $key => $s) { ?>
										<th style="" data-field="price" tabindex="0">
											<div class="th-inner center"><?=$s->name;?></div>
											<div class="fht-cell"></div>
										</th>
											<?php } ?>
										<?php } ?>
									</tr>
								</thead>
								<tbody>
									<?php if($compare) { ?>
										<?php foreach ($compare as $key => $p) { ?>
										<tr>
											<td class="center"><?=$key+1;?></td>
											<td class="bold"><?=$p->productName;?></td>
											<?php foreach ($stores as $key => $s) { ?>
												<td class="sorting bold center <?php if($key==0){echo "first-store";} ?>" ><?php $id = $s->id; echo $p->$id;?></td>
											<?php } ?>
										</tr>
										<?php } ?>
									<?php } ?>
								</tbody>
							</table>
						</div>	
					</div>
				</div>
			</div>
		</div>
		<!-- estimatesOrder -->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-sharp">
                    <i class="icon-puzzle font-red-flamingo"></i>
                    <span class="caption-subject bold font-red-flamingo uppercase">So sánh hàng cần </span>
                </div>
			
				<div class="bootstrap-table">
					<div class="fixed-table-toolbar"></div>
					<div class="fixed-table-container" style="height: 499px; padding-bottom: 40px;">
						<div class="fixed-table-header" style="margin-right: 0px;">
							<table class="table table-hover">
								<thead>
									<tr>
										<th data-field="id" tabindex="0" width="5%">
											<div class="th-inner">No.</div>
											<div class="fht-cell"></div>
										</th>
										<th width="20%" data-field="name" tabindex="0">
											<div class="th-inner">Sản phẩm</div>
											<div class="fht-cell" ></div>
										</th>
										<th data-field="name" tabindex="0" width="10%">
											<div class="th-inner center">Tổng hàng</div>
											<div class="fht-cell"></div>
										</th>
										<?php if($stores) { ?>
											<?php foreach ($stores as $key => $s) { ?>
										<th style="" data-field="price" tabindex="0">
											<div class="th-inner center"><?=$s->name;?></div>
											<div class="fht-cell" ></div>
										</th>
											<?php } ?>
										<?php } ?>
									</tr>
								</thead>
							</table>
						</div>
						<div class="fixed-table-body">
							<div class="fixed-table-loading" style="top: 41px; display: none;">Loading, please wait...</div>
							<table data-toggle="table" data-url="../assets/global/plugins/bootstrap-table/data/data1.json" data-height="599" class="table table-hover" style="margin-top: -40px;">
								<thead>
									<tr>
									<th data-field="id" tabindex="0" width="5%">
											<div class="th-inner">No.</div>
											<div class="fht-cell"></div>
										</th>
										<th data-field="name" tabindex="0" width="20.5%">
											<div class="th-inner">Sản phẩm</div>
											<div class="fht-cell"></div>
										</th>
										<th data-field="name" tabindex="0" width="10%">
											<div class="th-inner">Tổng hàng</div>
											<div class="fht-cell"></div>
										</th>
										<?php if($stores) { ?>
											<?php foreach ($stores as $key => $s) { ?>
										<th style="" data-field="price" tabindex="0">
											<div class="th-inner center"><?=$s->name;?></div>
											<div class="fht-cell"></div>
										</th>
											<?php } ?>
										<?php } ?>
									</tr>
								</thead>
								<tbody>
									<?php if($estimatesOrder) { ?>
										<?php foreach ($estimatesOrder as $key => $p) { ?>
										<tr>
											<td class="center"><?=$key+1;?></td>
											<td class="bold" ><?=$p->productName;?></td>
											<td class="bold center <?php if($p->estimates >= 0){echo "first-store";} else { echo "first-store-under";} ?>"><?=$p->estimates;?></td>
											<?php foreach ($stores as $key => $s) { ?>
												<td class="sorting bold center <?php $id = $s->id; if($p->$id < 0){echo "first-store-under";} ?>"><?php $id = $s->id; echo $p->$id;?></td>
											<?php } ?>
										</tr>
										<?php } ?>
									<?php } ?>
								</tbody>
							</table>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT-->