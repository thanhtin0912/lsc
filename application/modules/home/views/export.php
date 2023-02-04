<style > 
.export-page {
	position: relative;
    border-bottom: solid 2px #72c02c;
}
.export-page > a {
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
				notify('Không thể xuất nhiều hơn tồn kho.', 'danger');
				return $button.parent().find('input').val(oldInventory); 
			}
            $button.closest('tr').find('.label-red').text(parseFloat(oldInventory) - parseFloat(qty));
		});

		$('#flexInputAll').click(function() {
			if ($(this).is(':checked')) {
				const collection = document.querySelectorAll(".btn-export")
				for (let i = 0; i < collection.length; i++) {
					collection[i].className += " d-none";
				}
				document.getElementsByClassName("handle-control")[0].classList.remove("d-none")
			} else {
				const collection = document.querySelectorAll(".btn-export")
				for (let i = 0; i < collection.length; i++) {
					collection[i].classList.remove("d-none")
				}
				document.getElementsByClassName("handle-control")[0].className += " d-none";
			}
		});

    });

    function Enter(e, id){
        if(e.keyCode == 13){ 
			if (!$('#flexInputAll').is(':checked')) {
				var $button = $(this);
				if (parseFloat($button.parent().find('input').val()) < 0){
					$button.parent().find('input').val(0)
				}
				var qty = $button.parent().find('input').val();
				var oldInventory = $button.parent().find('input').data('inventory');
				if (parseFloat(qty) >  parseFloat(oldInventory)){
					notify('Không thể xuất nhiều hơn tồn kho.', 'danger');
					return $button.parent().find('input').val(oldInventory); 
				}
				$button.closest('tr').find('.label-red').text(parseFloat(oldInventory) - parseFloat(qty));
				saveInventory(id);
			}
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
                notify('Không thể xuất nhiều hơn tồn kho.', 'danger');
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
			notify('Không thể xuất nhiều hơn tồn kho.', 'danger');
			return false;
		}
		$('#qty' + proId).attr('disabled', true);
		$('#btn-save-' + proId).attr('disabled', true);		
        $.ajax({    
            type: 'POST',
            url:  url +'exportInventory',
            data: {
                qty    : qty,
				productId : proId,
				csrf_token: $('#csrf_token').val()
            },           
            success: function(data) { 
                responseText = data.split(".");          
                if(responseText[0]=='success'){
					notify('Sản phẩm đã được xuất kho.', 'success');
					setTimeout(function(){ 
						searchProduct(); 
					}, 1500);
                } else {
					notify('Sản phẩm đã được xuất kho.', 'danger');
				}
            },
            error: function () {
            },
            async:false ,       
        });
		
    }

    function searchProduct(){
        $('#tableProduct').load('<?= PATH_URL ?>ajaxSearchExportProduct', {
			name: $('#seachProduct').val(),
            csrf_token: $("#csrf_token").val(),
        },function() {
        }); 
    }

	function saveListQtyPruoduct(){
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
		if(responseText[0]=='success'){
			notify('<strong>'+responseText[1] + '</strong> Sản phẩm đã được xuất kho', 'success');
			setTimeout(function(){ 
				location.reload();
			}, 1500);
		} else {
			notify('Không Sản phẩm được xuất kho.', 'danger');
		}
	}
	
	function loadData(proId){
        var url = '<?= PATH_URL ?>';	
        $.ajax({    
            type: 'POST',
            url:  url +'loadNoteProductofStore',
            data: {
				productId : proId,
				csrf_token: $('#csrf_token').val()
            },           
            success: function(data) { 
				var responseText = JSON.parse(data)
				if(responseText.return){
					var pro = responseText.data
					console.log(pro);
					$('#txtProductName').html(pro[0].name);
					$('#txtProductID').val(pro[0].productId);
					$('#txtNote').val(pro[0].note);
					$('#modalNote').modal('show');
				}
            }     
        });	
    }
	function saveNote(){
        var url = '<?= PATH_URL ?>';
		var note = $('#txtNote').val();
		if (note =='') {
			notify('Vui lòng nhập thông tin.', 'danger');
			return false;
		}	
        $.ajax({    
            type: 'POST',
            url:  url +'saveNoteInventory',
            data: {
                note    : note,
				productId : $('#txtProductID').val(),
				csrf_token: $('#csrf_token').val()
            },           
            success: function(data) { 
                var responseText = JSON.parse(data)         
                if(responseText.return){
					$('#modalNote').modal('hide');
					$('#csrf_token').val(responseText.csrf_hash)
					$('#note-'+$('#txtProductID').val()).html(responseText.data)
					notify('Thông tin đã được cập nhật.', 'success');
                } else {
					notify('Thông tin không thể cập nhật.', 'danger');
				}
            }     
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
					<button class="btn-u" type="button" onclick="searchProduct()"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</div>

		<!--Basic Table-->
		<div class="panel panel-grey margin-bottom-40">
			<div class="panel-heading d-flex justify-content-between">
				<h3 class="panel-title font-bold"><i class="fa fa-tasks"></i> Danh sách sản phẩm</h3>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="" id="flexInputAll">
					<label class="form-check-label panel-title pl-4" for="flexCheckDefault">
						Nhập nhiều sản phẩm
					</label>
				</div>
			</div>
			<form id="frmManagement" action="<?= PATH_URL ?>exportListQtyPruoduct" method="post" enctype="multipart/form-data" class="form-horizontal form-row-seperated">
			<input type="hidden" value="<?=$this->security->get_csrf_hash()?>" name="csrf_token" />
			<table class="table table-striped import">
				<thead>
					<tr>
						<th>#</th>
						<th>Tên sản phẩm</th>
						<th>Ghi chú</th>
						<th>Tồn kho</th>
						<th width="180px">Xuất kho</th>
						<th class="text-center">Tồn dự tính</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="tableProduct" >
					<?php if ($products) {?>
					<?php foreach ($products as $key => $p) {?>
					<tr>
						<td><?= $key +1; ?></td>
						<td class="font-bold"><?= $p->name; ?></td>
						<td><span id="note-<?=$p->id?>" ><?= $p->note; ?></span></td>
						<td class="new-inventory fa-2x font-bold"><?= $p->inventory;?></td>
						<td>
							<button type="button" class="quantity-button" name="subtract" onclick="javascript: document.getElementById(&quot;qty<?=$p->id?>&quot;).value--;" value="-">-</button>
							<input type="number" min="0" tabindex="<?= $key +1;?>" onkeypress="return Enter(event,<?=$p->id?>)" name="qty<?=$p->id?>"  class="quantity-field" id="qty<?=$p->id?>" value="0" data-inventory="<?= $p->inventory;?>">
							<button type="button" class="quantity-button" name="add" onclick="javascript: document.getElementById(&quot;qty<?=$p->id?>&quot;).value++;" value="+">+</button>
						</td>
						<td class="text-center font-bold"><span class="label rounded label-red"></span></td>
						<td>
						    <button class="btn-u btn-u-xs rounded-4x btn-u-dark btn-export" id="btn-save-<?=$p->id?>" type="button" onclick="saveInventory(<?=$p->id?>,<?= $p->inventory;?>)"><i class="fa fa-cloud-upload"></i></button>
						    <button class="btn-u btn-u-xs rounded-4x btn-u-dark" type="button" onclick='loadData(<?=$p->id?>)'><i class="fa fa-pencil"></i></button>
						</td>
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

<div id="importControl" style="position: fixed; right: 5px; opacity: 1; cursor: pointer;">
	<button class="btn-u btn-u-xs btn-u-dark p-3 handle-control d-none"  type="button" onclick="saveListQtyPruoduct()">Nhập tất cả</button>
</div>