<style > 
.inventory-page {
	position: relative;
    border-bottom: solid 2px #72c02c;
}
.inventory-page > a {
	color: #72c02c;
}
.center {
	text-align: center;
}
.bold {
	font-weight: bold;
}
.font-14 {
	font-size: 16px
}

</style>

<div class="col-md-12">
	<div class="profile-body">
		<?php if(!empty($compare)) {?>
		<!--Basic Table-->
		<div class="panel panel-grey margin-bottom-40">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-tasks"></i> Danh sách sản phẩm</h3>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Tên sản phẩm</th>
						<?php if($stores) { ?>
						<?php foreach ($stores as $key => $s) { ?>
							<th class="center"><?=$s->name;?></th>
							<?php } ?>
						<?php } ?>
					</tr>
				</thead>
				<tbody id="tableProduct" >
					
						<?php foreach ($compare as $key => $p) {?>
						<tr>
							<td class="center"><?=$key+1;?></td>
							<td class="bold"><?=$p->productName;?></td>
							<?php foreach ($stores as $key => $s) { ?>
								<td class="sorting bold center font-14" ><?php $id = $s->id; echo $p->$id;?></td>
							<?php } ?>
						</tr>
						<?php } ?>
					
				</tbody>
			</table>
		</div>
		<!--End Basic Table-->
		<?php } else { ?>
			<div class="panel panel-grey margin-bottom-40">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-tasks"></i> Danh sách sản phẩm</h3>
			</div>
			<table class="table table-striped import">
				<thead>
					<tr>
						<th>#</th>
						<th>Tên sản phẩm</th>
						<?php if($stores) { ?>
						<?php foreach ($stores as $key => $s) { ?>
							<th class="center"><?=$s->name;?></th>
							<?php } ?>
						<?php } ?>
					</tr>
				</thead>
				<tbody id="tableProduct" >
					
					<div class="alert alert-warning fade in">
			            <strong>Không có sản phẩm nào được tìm thấy,</strong>
			        </div>
					
				</tbody>
			</table>
		</div>
		<?php }  ?>
	</div>
</div>