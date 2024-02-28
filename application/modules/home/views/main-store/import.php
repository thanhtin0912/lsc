<style > 
.import-page {
	position: relative;
    border-bottom: solid 2px #72c02c;
}
.import-page > a {
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
<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/sky-form.css">


<script type="text/javascript">
    $(document).ready(function() {
		$("input[type=number]").on('change',function(){
			var $button = $(this);
			if (parseFloat($button.parent().find('input').val()) < 0){
				$button.parent().find('input').val(0)
			}
            var qty = $button.parent().find('input').val();
            var oldInventory = $button.parent().find('input').data('inventory');
            $button.closest('tr').find('.label-u').text(parseFloat(oldInventory) + parseFloat(qty));
		});
		$('#flexInputAll').click(function() {
			if ($(this).is(':checked')) {
				const collection = document.querySelectorAll(".btn-import")
				for (let i = 0; i < collection.length; i++) {
					collection[i].className += " d-none";
				}
				document.getElementsByClassName("handle-control")[0].classList.remove("d-none")
			} else {
				const collection = document.querySelectorAll(".btn-import")
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
				$button.closest('tr').find('.label-u').text(parseFloat(oldInventory) + parseFloat(qty));
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
            $button.closest('tr').find('.label-u').text(parseFloat(oldInventory) + parseFloat(qty));
	});


	function saveInventory(proId){
        var url = '<?= PATH_URL ?>';
		var qty = $('#qty' + proId).val();
		if (qty && qty <=0) {
			notify('Số lượng sản phẩm chưa được nhập hoặc số lượng = 0.', 'danger');
			return false;
		}
		if (proId =='') {
			notify('Lỗi khi chưa được nhập.', 'danger');
			return false;
		}
		$('#qty' + proId).attr('disabled', true);
		$('#btn-save-' + proId).attr('disabled', true);		
        $.ajax({    
            type: 'POST',
            url:  url +'importInventory',
            data: {
                qty    : qty,
				productId : proId,
				csrf_token: $('#csrf_token').val()
            },           
            success: function(data) { 
                responseText = data.split(".");          
                if(responseText[0]=='success'){
					$('#csrf_token').val(responseText[1])
					notify('Sản phẩm đã được nhập kho.', 'success');
					setTimeout(function(){ 
						location.reload();
					}, 1500);
                } else {
					notify('Sản phẩm đã được nhập kho.', 'danger');
				}
            }     
        });	
    }

    function searchProduct(){
		console.log($("#csrf_token").val());
        $('#tableProduct').load('<?= PATH_URL ?>ajaxSearchImportProduct', {
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
			notify('<strong>'+responseText[1] + '</strong> Sản phẩm đã được nhập kho', 'success');
			setTimeout(function(){ 
				location.reload();
			}, 1500);
		} else {
			notify('Không Sản phẩm được nhập kho.', 'danger');
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


	function modalOpenImportString() {
		$('#modalImportString').modal('show');
		$('#content').val('')
	}

	function saveStringImportProduct () {
		var url = '<?= PATH_URL ?>';
		var mes = $("#content").val();
		if (mes == '') {
			notify('Vui lòng nhập nội dung tin nhắn .', 'danger');
			return false;
		}
		$('#btn-save-list-qty').attr('disabled', true);	
        $.ajax({    
            type: 'POST',
            url:  url +'formatStringImportProduct',
            data: {
                mes    : mes,
				csrf_token: $('#csrf_token').val()
            },           
            success: function(data) { 
                var responseText =  JSON.parse(data)     
                if(responseText['status'] == 1){
					notify('Với nội dung được nhập trên, đã có <strong>'+responseText['count'] + '</strong> sản phẩm nhập vào hệ thống.', 'success');
					$('#modalImportString').modal('hide');
					searchProduct();
                } else if (responseText['status'] == 2) {
                    notify(responseText['arrError'], 'danger');
                } else {
                    let arrError = responseText['arrError']
                    var note = mes
					for (let i = 0; i < arrError.length; i++) {
                        if (mes.indexOf(arrError[i])!=-1) {
                            note = note.replace(arrError[i], '<strong>'+arrError[i]+'</strong> sai cấu trúc');
                        }
                    }
                    $("#txtError").html(note.replaceAll("\n", "<br>"));
                    $("#txtError").show();
				}
                $('#csrf_token').val(responseText['token'])
                $('#btn-save-list-qty').attr('disabled', false);	
            }     
        });	
	}

</script>
<div class="col-md-12">
	<div class="profile-body p-0 p-md-4">
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
		<div class="panel panel-green margin-bottom-40">
			<div class="panel-heading d-flex justify-content-between">
				<h3 class="panel-title font-bold"><i class="fa fa-tasks"></i> Danh sách sản phẩm</h3>
				<button class="btn-u btn-u-xs btn-u-green" type="button" onclick="modalOpenImportString()">Nhập nhanh</button>
				<!--<div class="form-check">-->
				<!--	<input class="form-check-input" type="checkbox" value="" id="flexInputAll">-->
				<!--	<label class="form-check-label panel-title pl-4" for="flexCheckDefault">-->
				<!--		Nhập nhiều sản phẩm-->
				<!--	</label>-->
				<!--</div>-->
			</div>
			<form id="frmManagement" action="<?= PATH_URL ?>importListQtyPruoduct" method="post" enctype="multipart/form-data" class="form-horizontal form-row-seperated">
			<input type="hidden" value="<?=$this->security->get_csrf_hash()?>" name="csrf_token" />
			<table class="table import">
				<thead>
					<tr>
						<th width="20px">#</th>
						<th>Tên sản phẩm</th>
						<th class="hidden-xs">Ghi chú</th>
						<th>Tồn kho</th>
						<th width="180px">Nhập kho</th>
						<th class="text-center hidden-xs">Tồn dự tính</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="tableProduct" >
					<?php if ($products) {?>
					<?php foreach ($products as $key => $p) {?>
					<tr>
						<td><?= $key +1; ?></td>
						<td class="font-bold"><?= $p->name; ?></td>
						<td class="hidden-xs"><span id="note-<?=$p->id?>" ><?= $p->note; ?></span></td>
						<td class="new-inventory fa-2x font-bold"><?php if (($p->inventory*2)%2 > 0) { echo $p->inventory;} else {echo number_format($p->inventory,0);};?></td>
						<td>
							<button type="button" class="quantity-button hidden-xs" name="subtract" onclick="javascript: document.getElementById(&quot;qty<?=$p->id?>&quot;).value--;" value="-">-</button>
							<input type="number" min="0" tabindex="<?= $key +1;?>" onkeypress="return Enter(event,<?=$p->id?>)" name="qty<?=$p->id?>"  class="quantity-field" id="qty<?=$p->id?>" value="0" data-inventory="<?= $p->inventory;?>">
							<button type="button" class="quantity-button hidden-xs" name="add" onclick="javascript: document.getElementById(&quot;qty<?=$p->id?>&quot;).value++;" value="+">+</button>
						</td>
						<td class="text-center hidden-xs font-bold"><span class="label rounded label-u"></span></td>
						<td>
							<button class="btn-u btn-u-xs rounded-4x btn-u-green btn-import" id="btn-save-<?=$p->id?>" type="button" onclick="saveInventory(<?=$p->id?>)"><i class="fa fa-cloud-download"></i></button>
							<!-- <button class="btn-u btn-u-xs rounded-4x btn-u-green" type="button" onclick='loadData(<?=$p->id?>)'><i class="fa fa-pencil"></i></button> -->
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
	<button class="btn-u btn-u-xs btn-u-green p-3 handle-control d-none"  type="button" onclick="saveListQtyPruoduct()">Nhập tất cả</button>
</div>

<div class="modal lg fade" id="modalImportString" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-bold">Nhập nhanh sản phẩm kho</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="py-2 sky-form">
					<div class="alert alert-danger fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4>Cách nhập tin nhắn!</h4>
						<span><strong>Tên sản phẩm : Số lượng</strong></span><br>
						<strong>Ví dụ:  in Sticker: 1 </strong><br>
						<span>Nếu muốn nhập nhiều sản phẩm thì xuống hàng cho mỗi sản phẩm</span>
					</div>
					<fieldset>
						<section>
							<label class="label">Nhập tin nhắn:</label>
							<label class="textarea py-3">
								<textarea rows="12" name="info" placeholder="Nội dung" id="content"></textarea>
							</label>
						</section>
					</fieldset>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn-u rounded-4x btn-u-default" data-dismiss="modal">Thoát</button>
				<button type="button" class="btn-u rounded-4x btn-u-green" id="btn-save-list-qty" onclick="saveStringImportProduct()">Nhập</button>
			</div>
			<fieldset class=" mt-2">
				<div class="alert alert-danger fade in" id="txtError" style="display:none">
					
				</div>
			</fieldset>
		</div>
	</div>
</div>
