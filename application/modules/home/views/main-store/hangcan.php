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
.btn-default {
    color: #333;
	border: none !important;
}
.btn-default:hover {
    color: #007bff !important;
	font-weight: bold;
	background-color: #e6e6e600 !important;
}
</style>
<script type="text/javascript">
	function sortArr(row) {
		let arr = <?php echo json_encode($products) ?>;
		let newArr = Object.values(arr);
		if (row == 1) {
			newArr.sort(function(a, b) {
				return parseFloat(a.id) - parseFloat(b.id);
			});
		} else if (row == 2) {
			newArr.sort(function(a, b) {
				return parseFloat(a.name) - parseFloat(b.name);
			});
		} else if (row == 3) {
			newArr.sort(function(a, b) {
				return parseFloat(b.percen) - parseFloat(a.percen);
			});
		} else {
			newArr.sort(function(a, b) {
				return parseFloat(b.effect) - parseFloat(a.effect);
			});
		}
		var str = '' ;
		newArr.forEach(arr => {
			let classBG = "";
			if(arr.notify) {
				classBG = "color-up"
			}
			str += '<tr class="'+ classBG +'">';
			str += '<td class="center">'+ (arr.id) +'</td>';
			str += '<td class="font-bold">' + arr.name + '</td>';
			str += '<td class="center fa-1x font-bold">' + arr.percen + '</td>';
			str += '<td class="center fa-1x font-bold">' + arr.effect + '</td>';
			str += '<td class="center fa-1x font-bold">' + arr.quote + '</td>';
			str += '<td class="center fa-1x font-bold">' + arr.inventory + '</td>';
			str += '<td class="center fa-1x font-bold">' + (arr.quote - arr.inventory) + '</td>';
			str += '</tr>';
		});
		$('#tableProduct').children().remove();
        $('#tableProduct').append(str);
	}
</script>
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
						<th width="20px"><button type="button" class="btn btn-default" onclick="sortArr(1)">STT<i class="fa fa-angle-down"></i></button></th>
						<th><button type="button" class="btn btn-default" onclick="sortArr(2)">Sản phẩm<i class="fa fa-angle-down"></i></button></th>
						<th><button type="button" class="btn btn-default" onclick="sortArr(3)">Cần Hàng(%) <i class="fa fa-angle-down"></i></button></th>
						<th><button type="button" class="btn btn-default" onclick="sortArr(4)">Tỷ số <i class="fa fa-angle-down"></i></button></th>
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

