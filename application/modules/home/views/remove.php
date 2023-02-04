<style > 
.remove-page {
	position: relative;
    border-bottom: solid 2px #72c02c;
}
.remove-page > a {
	color: #72c02c;
}
</style>

<script type="text/javascript">
    $(document).ready(function() {
		$("input[type=number]").on('change',function(){
			var $button = $(this);
			if (parseFloat($button.parent().find('input').val()) < 0){
				$button.parent().find('input').val(0)
			}
            var qty = $button.parent().find('input').val();
            var oldInventory = $button.parent().find('input').data('inventory');
			if (parseFloat(qty) >  parseFloat(oldInventory)){
				notify('Không thể hủy nhiều hơn tồn kho.', 'danger');
				return $button.parent().find('input').val(oldInventory); 
			}
            $button.closest('tr').find('.label-red').text(parseFloat(oldInventory) - parseFloat(qty));
		});
    });
    function Enter(e, id){
        if(e.keyCode == 13){ 
			var $button = $(this);
			if (parseFloat($button.parent().find('input').val()) < 0){
				$button.parent().find('input').val(0)
			}
            var qty = $button.parent().find('input').val();
            var oldInventory = $button.parent().find('input').data('inventory');
			if (parseFloat(qty) >  parseFloat(oldInventory)){
                notify('Không thể hủy nhiều hơn tồn kho.', 'danger');
				return $button.parent().find('input').val(oldInventory); 
			}
            $button.closest('tr').find('.label-red').text(parseFloat(oldInventory) - parseFloat(qty));
            saveInventory(id);
        }
    }
	$(document).on('click', '.quantity-button', function() {
            var $button = $(this);
			if (parseFloat($button.parent().find('input').val()) < 0){
				$button.parent().find('input').val(0)
			}
            var qty = $button.parent().find('input').val();
            var oldInventory = $button.parent().find('input').data('inventory');
			if (parseFloat(qty) >  parseFloat(oldInventory)){
                notify('Không thể hủy nhiều hơn tồn kho.', 'danger');
				return $button.parent().find('input').val(oldInventory); 
			}
            $button.closest('tr').find('.label-red').text(parseFloat(oldInventory) - parseFloat(qty));
	});
	
	function saveInventory(proId, oldInven){
        var url = '<?= PATH_URL ?>';
		var qty = $('#qty' + proId).val();
		if (qty && qty <=0) {
			notify('Số lượng sản phẩm chưa được nhập hoặc số lượng = 0.', 'danger');
			return false;
		}
		if (proId =='') {
			notify('Lỗi cập nhật dữ liệu.', 'danger');
			return false;
		}
		if (parseFloat(oldInven) < parseFloat(qty)) {
			notify('Không thể hủy nhiều hơn tồn kho.', 'danger');
			return false;
		}
		$('#qty' + proId).attr('disabled', true);
		$('#btn-save-' + proId).attr('disabled', true);		
        $.ajax({    
            type: 'POST',
            url:  url +'removeInventory',
            data: {
                qty    : qty,
				productId : proId,
				csrf_token: $('#csrf_token').val()
            },           
            success: function(data) { 
                responseText = data.split(".");          
                if(responseText[0]=='success'){
					notify('Sản phẩm đã được hủy kho.', 'success');
					setTimeout(function(){ 
						searchProduct(); 
					}, 1500);
                } else {
					notify('Sản phẩm đã được hủy kho.', 'danger');
				}
            },
            error: function () {
            },
            async:false ,       
        });
		
    }

    function searchProduct(){
        $('#tableProduct').load('<?= PATH_URL ?>ajaxSearchRemoveProduct', {
			name: $('#seachProduct').val(),
            csrf_token: $("#csrf_token").val(),
        },function() {
        }); 
    }
</script>
<div class="col-md-12">
	<div class="profile-body">
		<div class="col-md-8 col-md-offset-2 margin-bottom-20" >
			<h2 style="text-align: center;">Tìm kiếm sản phẩm</h2>
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Tên sản phẩm ..." id="seachProduct">
				<span class="input-group-btn">
					<button class="btn-u btn-u-red" type="button" onclick="searchProduct()"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</div>

		<!--Basic Table-->
		<div class="panel panel-red margin-bottom-40">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-tasks"></i> Danh sách sản phẩm</h3>
			</div>
			<table class="table table-striped import">
				<thead>
					<tr>
						<th>#</th>
						<th>Tên sản phẩm</th>
						<th class="hidden-sm">Đơn vị</th>
						<th>Tồn kho</th>
						<th width="180px">Xuất kho</th>
						<th class="text-center">Tồn dự tính</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="tableProduct" >
					<?php if ($productsIsRemove) {?>
					<?php foreach ($productsIsRemove as $key => $p) {?>
					<tr>
						<td><?= $key +1; ?></td>
						<td class="font-bold"><?= $p->name; ?></td>
						<td class="hidden-sm"><?= $p->unit; ?></td>
						<td class="new-inventory"><?= $p->inventory;?></td>
						<td>
							<button type="button" class="quantity-button" name="subtract" onclick="javascript: document.getElementById(&quot;qty<?=$p->id?>&quot;).value--;" value="-">-</button>
							<input type="number" min="0" onkeypress="return Enter(event,<?=$p->id?>)"  class="quantity-field" id="qty<?=$p->id?>" value="0" data-inventory="<?= $p->inventory;?>">
							<button type="button" class="quantity-button" name="add" onclick="javascript: document.getElementById(&quot;qty<?=$p->id?>&quot;).value++;" value="+">+</button>
						</td>
						<td class="text-center font-bold"><span class="label rounded label-red"></span></td>
						<td><button class="btn-u btn-u-xs rounded-4x btn-u-red" id="btn-save-<?=$p->id?>" type="button" onclick="saveInventory(<?=$p->id?>,<?= $p->inventory;?>)">Hủy</button></td>
					</tr>
					<?php } ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<!--End Basic Table-->

	</div>
</div>