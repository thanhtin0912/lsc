<style > 
.move-page {
	position: relative;
    border-bottom: solid 2px #72c02c;
}
.move-page > a {
	color: #72c02c;
}
</style>

<div class="col-md-12">
	<div class="profile-body">
		<div class="col-md-8 col-md-offset-2 margin-bottom-20" >
			<h2 style="text-align: center;">Lịch sử chuyển hàng</h2>
		</div>

		<!--Basic Table-->
		<div class="panel panel-grey margin-bottom-40">
			<div class="panel-heading d-flex justify-content-between">
				<h3 class="panel-title font-bold"><i class="fa fa-tasks"></i> Danh sách</h3>
			</div>
			<form id="frmManagement" action="<?= PATH_URL ?>exportListQtyPruoduct" method="post" enctype="multipart/form-data" class="form-horizontal form-row-seperated">
			<input type="hidden" value="<?=$this->security->get_csrf_hash()?>" name="csrf_token" />
			<table class="table table-striped import">
				<thead>
					<tr>
						<th>#</th>
						<th>Tên sản phẩm</th>
						<th>Số lượng</th>
						<th>Chuyển đến CH</th>
						<th class="text-center">Trạng thái</th>
						<th>Ngày chuyển</th>
					</tr>
				</thead>
				<tbody id="tableProduct" >
					<?php if ($history) {?>
					<?php foreach ($history as $key => $p) {?>
					<tr>
						<td><?= $key +1; ?></td>
						<td class="font-bold font-bold"><span><?= $p->product_name; ?></span></td>
						<td class="new-inventory "><?= $p->qty;?></td>
                        <td class="font-bold font-bold"><span><?= $p->store_name; ?></span></td>
                        <?php if ($p->status != 1) {?>
						<td class="text-center font-bold"><span class="label rounded label-red">Chờ xác nhận</span></td>
                        <?php } else {?>
                        <td class="text-center font-bold"><span class="label rounded label-u">Đã xác nhận</span></td>
                        <?php }?>
						<td class="font-bold font-bold"><span><?= $p->created; ?></span></td>
					</tr>
					<?php } ?>
					<?php } ?>
				</tbody>
			</table>
			</form>
		</div>
		<!--End Basic Table-->
	</div>
</div>
