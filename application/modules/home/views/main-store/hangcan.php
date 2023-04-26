<style > 
.main-page {
	position: relative;
    border-bottom: solid 2px #72c02c;
}
.main-page > a {
	color: #72c02c;
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
.color-up{
    background-color: #F1C40F;
}
.fa-1x {
    font-size: 16px
}
</style>

<div class="col-md-12">
	<div class="profile-body p-0 p-md-4">
        <div class="col-md-8 col-md-offset-2 margin-bottom-20" >
			<h2 style="text-align: center;">DỰ ĐOÁN CẦN HÀNG KHO TỔNG</h2>
		</div>
		<!--Basic Table-->
		<div class="panel panel-green margin-bottom-40">
			<table class="table import">
				<thead>
					<tr>
						<th width="20px">STT</th>
						<th>Sản phẩm</th>
						<th>Cần Hàng(%)</th>
						<th>Tỷ số</th>
						<th>Định mức</th>
						<th>Tồn kho</th>
						<th>Cần Hàng</th>
						
					</tr>
				</thead>
				<tbody id="tableProduct" >
                    <?php if($products) { ?>
                        <?php foreach ($products as $key => $p) { ?>
                        <tr class="<?php if($p->notify){echo "color-up";}?>">
                            <td class="center"><?=$key+1;?></td>
                            <td class="font-bold"><?=$p->name;?></td>
                            <td class="center fa-1x font-bold"><?= $p->percen; ?></td>
                            <td class="center fa-1x font-bold"><?= $p->effect; ?></td>
                            <td class="center fa-1x font-bold"><?=$p->quote;?></td>
                            <td class="center fa-1x font-bold"><?=$p->inventory;?></td>
                            <td class="center fa-1x font-bold "><?= $p->quote - $p->inventory;?></td>
                            
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

