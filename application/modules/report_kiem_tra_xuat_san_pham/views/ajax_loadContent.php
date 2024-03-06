<script type="text/javascript">token_value = '<?=$this->security->get_csrf_hash()?>';</script>
<div class="dataTables_wrapper no-footer">
	<?php if($result){ ?>
		<div class="row">
			<div class="col-md-5 col-sm-12">
				<?php if(($start+$per_page)<$total){ ?>
				<div class="dataTables_info" style="padding-left:0;margin-top:3px">Showing <?=$start+1?> to <?=$start+$per_page?> of <?=$total?> entries</div>
				<?php }else{ ?>
				<div class="dataTables_info" style="padding-left:0;margin-top:3px">Showing <?=$start+1?> to <?=$total?> of <?=$total?> entries</div>
				<?php } ?>
			</div>

			<div class="col-md-7 col-sm-12">
				<div class="dataTables_paginate paging_bootstrap_full_number" style="margin-top:3px">
					<ul class="pagination" style="visibility: visible;">
						<?=$this->adminpagination->create_links();?>
					</ul>
				</div>
			</div>
		</div>
	<?php } ?>
	
	<div class="table-scrollable">
	
		<table class="table table-striped table-bordered table-hover dataTable no-footer">
			<thead>
				<tr role="row">
					<th class="center sorting_disabled" width="35">No.</th>
					<th class="sorting" onclick="sort('phone')" id="phone">Tên sản phẩm</th>
					<th class="center sorting" onclick="sort('name')" id="name" >Số lượng</th>
					<th class="sorting" onclick="sort('email')" id="email">Ngày kiểm tra</th>
					<th class="center sorting" onclick="sort('storeId')" id="storeId" >Cửa hàng</th>
					<th class="center sorting" width="80" onclick="sort('created')" id="created">Created</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if($result){
						$i=0;
						foreach($result as $k=>$v){
							if($v->delete==0){
				?>
				<tr class="item_row<?=$i?> gradeX <?php ($k%2==0) ? print 'odd' : print 'even' ?>" role="row">
					<td class="center"><?=$k+1+$start?></td>
					<td><?=$v->productName?></td>
					<td class="center"><?=$v->value?></td>
					<td><?=$v->checkDate?></td>
					<td class="center"><?=$v->storeName?></td>
					<td class="center"><?=date('d-m-Y H:i:s',strtotime($v->created))?></td>
				</tr>
				<?php $i++;}
				else{?>
					<tr style="background:#c6c6c6;" class="item_row<?=$i?> gradeX" role="row">
					<td class="center"><?=$k+1+$start?></td>
					<td><?=$v->productName?></td>
					<td><?=$v->value?></td>
					<td><?=$v->checkDate?></td>
					<td><?=$v->storeName?></td>
					<td class="center"><?=date('d-m-Y H:i:s',strtotime($v->created))?></td>
				</tr>
				<?php $i++;}
				}}else{ ?>
				<tr class="gradeX odd" role="row">
					<td class="center no-record" colspan="20">No record</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

	<?php if($result){ ?>
	<div class="row">
		<div class="col-md-5 col-sm-12">
			<?php if(($start+$per_page)<$total){ ?>
			<div class="dataTables_info" style="padding-left:0;margin-top:3px">Showing <?=$start+1?> to <?=$start+$per_page?> of <?=$total?> entries</div>
			<?php }else{ ?>
			<div class="dataTables_info" style="padding-left:0;margin-top:3px">Showing <?=$start+1?> to <?=$total?> of <?=$total?> entries</div>
			<?php } ?>
		</div>

		<div class="col-md-7 col-sm-12">
			<div class="dataTables_paginate paging_bootstrap_full_number" style="margin-top:3px">
				<ul class="pagination" style="visibility: visible;">
					<?=$this->adminpagination->create_links();?>
				</ul>
			</div>
		</div>
	</div>
	<?php } ?>
</div>